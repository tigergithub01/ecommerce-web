<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\SoContactPersonForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\basic\Province;
use app\models\basic\City;
use app\models\basic\District;
use yii\helpers\ArrayHelper;
use app\modules\sale\controllers\BaseSaleController;
use app\models\common\JsonObj;
use app\modules\sale\models\SaleConstants;
use yii\helpers\Json;
use app\models\order\SoSheet;
use app\models\order\SoDetail;
use app\modules\admin\controllers\product\ProductTypeController;
use app\models\product\Product;
use app\models\order\app\models\order;
use app\models\vip\Vip;
use app\modules\api\utils\SheetCodeGenUtil;
use app\models\order\SoContactPerson;


class VipOrderController extends BaseSaleController {
	public function beforeAction($action) {
		$session = Yii::$app->session;
		$vip = $session->get ( SaleConstants::$session_vip );
		if (empty ( $vip )) {
			return $this->redirect ( [ 
					'/sale/vip-login/index' 
			] );
		}
		return parent::beforeAction ( $action );
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
	public function actionAddContact() {
		// initiate product information
		$product_id = $_REQUEST ['product_id'];
		$product = Product::findOne ( $product_id );
		if (empty ( $product )) {
			throw new NotFoundHttpException ();
		}
		
		// province
		$provinces = Province::find ()->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$provinces_map = ArrayHelper::map ( $provinces, 'id', 'name' );
		// city
		// $cities = City::find ()->all ();
		// $cities_map = ArrayHelper::map ( $cities, 'id', 'name' );
		
		// District
		// $districts = District::find ()->all ();
		// $districts_map = ArrayHelper::map ( $districts, 'id', 'name' );
		
		// create SoContactPersonForm information
		$model = new SoContactPersonForm ();
		
		// TODO:buy one product,should be mutipy products
		$soDetail = new SoDetail ();
		$soDetail->product_id = $product_id;
		$soDetail->quantity = 1;
		$soDetail->price = $product->price;
		$soDetail->amount = ($soDetail->quantity) * ($soDetail->price);
		
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			
			// order must have product
			$detailList = $_POST ['detailList'];
			if (empty ( $detailList )) {
				return $this->render ( 'contact', [ 
						'model' => $model,
						'provinces' => $provinces_map,
						'cities' => [ ],
						'districts' => [ ],
						'soDetail' => $soDetail 
				] );
			}
			
			// save order in transation
			$connection = Yii::$app->db;
			$trans = $connection->beginTransaction ();
			try {
				
				// pre process order detail list
				$order_amt = 0;
				$order_quantity = 0;
				foreach ( $detailList as $value ) {
					$order_quantity = ($order_quantity + $value ['quantity']);
					$order_amt = ($order_amt + $value ['amount']);
				}
				
				// save sale order
				$soSheet = new SoSheet ();
				// 销售订单
				$soSheet->sheet_type_id = 1;
				$soSheet->code = SheetCodeGenUtil::getCode ( $soSheet->sheet_type_id );
				$vip = $_SESSION [SaleConstants::$session_vip];
				$soSheet->vip_id = $vip ['id'];
				$soSheet->order_amt = $order_amt;
				$soSheet->order_quantity = $order_quantity;
				// 待支付
				$soSheet->status = 3001;
				// not settled
				$soSheet->settle_flag = 0;
				$soSheet->order_date = date ( SaleConstants::$date_format, time () );
				$orderId = null;
				if ($soSheet->save ()) {
					// $orderId = $soSheet->primaryKey;
					$orderId = $soSheet->attributes ['id'];
				} else {
					Yii::trace ( '$soSheet->save() errors' );
					Yii::trace ( $soSheet->getErrors () );
					return $this->render ( 'contact', [ 
							'model' => $model,
							'provinces' => $provinces_map,
							'cities' => [ ],
							'districts' => [ ],
							'soDetail' => $soDetail 
					] );
				}
				
				// save orderDetail
				foreach ( $detailList as $value ) {
					$soDetail = new SoDetail ();
					$soDetail->product_id = $value ['product_id'];
					$soDetail->quantity = $value ['quantity'];
					$soDetail->price = $value ['price'];
					$soDetail->amount = $value ['amount'];
					$soDetail->order_id = $orderId;
					// TODO:when save failed ,should show errors.
					$soDetail->save ();
				}
				
				//save order delivery information
				$soContactPerson = new SoContactPerson;
				$soContactPerson->order_id = $orderId;
				$soContactPerson->name=$model->name;
				$soContactPerson->phone_number = $model->phone_number;
				$soContactPerson->province_id = $model->province_id;
				$soContactPerson->city_id = $model->city_id;
				$soContactPerson->district_id = $model->district_id;
				$soContactPerson->detail_address = $model->detail_address;
				if(!$soContactPerson->save()){
					Yii::trace ( '$soContactPerson->save() errors' );
					Yii::trace ( $soContactPerson->getErrors () );
					$trans->rollBack();
					return $this->render ( 'contact', [
							'model' => $model,
							'provinces' => $provinces_map,
							'cities' => [ ],
							'districts' => [ ],
							'soDetail' => $soDetail
					] );
				}
				
				
				//commit
				$trans->commit ();
				
				// TODO:should be render,not be redirect.
				return $this->redirect ( [ 
						'/sale/vip-order/confirm',
						'orderId' => $orderId 
				] );
			} catch ( Exception $e ) {
				$trans->rollBack ();
				throw $e;
			}
		} else {
			return $this->render ( 'contact', [ 
					'model' => $model,
					'provinces' => $provinces_map,
					'cities' => [ ],
					'districts' => [ ],
					'soDetail' => $soDetail 
			] );
		}
	}
	private function getSheetCode($sheetTypeId) {
	}
	
	/**
	 * find cities by province_id
	 *
	 * @param string $province_id        	
	 */
	public function actionFindCities() {
		// city
		$province_id = $_REQUEST ['province_id'];
		$cities = City::find ()->where ( 'province_id=:province_id', [ 
				':province_id' => $province_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$json = new JsonObj ( 1, null, $cities );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * find districts by city_id
	 *
	 * @param string $city_id        	
	 */
	public function actionFindDistricts() {
		// city
		$city_id = $_REQUEST ['city_id'];
		$districts = District::find ()->where ( 'city_id=:city_id', [ 
				':city_id' => $city_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$json = new JsonObj ( 1, null, $districts );
		echo (Json::encode ( $json ));
	}
	public function actionConfirm() {
		// submit order
		$orderId = $_REQUEST ['orderId'];
		$soSheet = SoSheet::findOne ( $orderId );
		if (empty ( $soSheet )) {
			throw new NotFoundHttpException ();
		}
		//get sale order detail list
		$soDetailList = SoDetail::find ()->where ( 'order_id=:order_id', [ 
				':order_id' => $orderId 
		] )->all ();
		if(!empty($soDetailList)){
			foreach ($soDetailList as $soDetail) {
				$product = Product::findOne($soDetail->product_id);
				$soDetail->product = $product;
			}
		}
		$soSheet->soDetailList = $soDetailList;
		
		//get vip information
		$vip = Vip::findOne($soSheet['vip_id']);
		$soSheet->vip = $vip;	
		
		//get contact information
		$soContactPerson = SoContactPerson::find()->where('order_id=:order_id',[':order_id'=>$orderId])->one();
		if($soContactPerson!=null){
			$province = Province::findOne($soContactPerson->province_id);
			$city = City::findOne($soContactPerson->city_id);
			$district = District::findOne($soContactPerson->district_id);
			
			$soContactPerson->province = $province;
			$soContactPerson->city = $city;
			$soContactPerson->district = $district;
		}
		
		$soSheet->soContactPerson = $soContactPerson;
		
		$pay_type_id = isset($_POST['pay_type_id']) ? $_POST['pay_type_id'] : null;
		if(empty($pay_type_id)){
			return $this->render ( 'confirm', [
					'model' => $soSheet
			] );
		}else{
			//post pay information to third paty system.
// 			$soSheet->pay_type_id=$pay_type_id;
			
			return $this->render ( 'confirm', [
				'model' => $soSheet
			] );
		}
	}
	
	
	function actionSubmit(){
		
	}
}
