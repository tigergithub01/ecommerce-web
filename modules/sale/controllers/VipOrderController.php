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
use app\models\vip\Vip;
use app\modules\api\utils\SheetCodeGenUtil;
use app\models\order\SoContactPerson;
use app\modules\api\service\VipOrderService;
use app\modules\api\service\app\modules\api\service;
use app\models\order\ShoppingCart;
use app\models\product\ProductPhoto;

class VipOrderController extends BaseSaleController {
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	public function actionIndex($status = null) {
		$vipOrderService = new VipOrderService ();
		$vip = $_SESSION [SaleConstants::$session_vip];
		$orderList = $vipOrderService->getOrderList ( $vip->id, $status );
		return $this->render ( 'index', [ 
				'orderList' => $orderList 
		] );
	}
	public function actionView($orderId) {
		$vipOrderService = new VipOrderService ();
		$soSheet = $vipOrderService->getOrder ( $orderId );
		return $this->render ( 'view', [ 
				'model' => $soSheet 
		] );
	}
	public function actionConfirm() {
		// initiate product information
		/* $product_id = isset ( $_REQUEST ['product_id'] ) ? $_REQUEST ['product_id'] : null;
		 $quantity = isset ( $_REQUEST ['quantity'] ) ? $_REQUEST ['quantity'] : 1; */
		
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
		$contactPersonForm = new SoContactPersonForm ();
		
		// TODO:buy one product,should be mutipy products
		/* $price = $product->price;
		 $soDetail = new SoDetail ();
		 $soDetail->product_id = $product_id;
		 $soDetail->quantity = 1;
		 //TODO:should get discount price
		 $soDetail->price = $price;
		 $soDetail->amount = $quantity * $price; */
		
		// vip information
		$vip = $_SESSION [SaleConstants::$session_vip];
		// $detailList = array();
		$detailList = isset ( $_REQUEST ['detailList'] ) ? $_REQUEST ['detailList'] : null;
		
		// empty throw error
		if (! empty ( $detailList )) {
			// pre process $detailList
			foreach ( $detailList as $i => $soDetail ) {
				$checked = $soDetail ['checked'];
				if ($checked != 1) {
					unset ( $detailList [$i] );
				}
			}
		}
		
		// empty throw error
		if (empty ( $detailList )) {
			throw new NotFoundHttpException ( '请选择要购买的产品' );
		}
		
		foreach ( $detailList as $i => $soDetail ) {
			$quantity = $soDetail ['quantity'];
			$product = Product::findOne ( $soDetail ['product_id'] );
			$soDetail ['product_name'] = $product->name;
			$soDetail ['price'] = $product->price;
			$soDetail ['amount'] = $quantity * $soDetail ['price'];
			
			// get main photo
			$productPhoto = ProductPhoto::find ()->where ( 'product_id=:product_id', [ 
					':product_id' => $product ['id'] 
			] )->andWhere ( 'primary_flag=1' )->one ();
			// $product->primaryPhoto = $productPhoto;
			
			if ($productPhoto != null) {
				$soDetail ['primaryPhoto_id'] = $productPhoto->id;
			}
			$detailList [$i] = $soDetail;
			// $soDetail->setProduct($product);
		}
		
		/* $product = Product::findOne ( $product_id );
		 if (empty ( $product )) {
		 throw new NotFoundHttpException ();
		 } */
		
		// add product to cart
		/* $shoppingCart = new ShoppingCart();
		 $shoppingCart->vip_id = $vip ['id'];
		 $shoppingCart->product_id=$product_id;
		 $shoppingCart->quantity = $quantity;
		 //TODO:should get discount price
		 $shoppingCart->price = $product->price;
		 $shoppingCart->amount = $quantity * $price;
		 $shoppingCart->create_date = date ( SaleConstants::$date_format, time () );
		 $shoppingCart->save(); */
		
		if ($contactPersonForm->load ( Yii::$app->request->post () ) && $contactPersonForm->validate ()) {
			// order must have product
			
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
					return $this->render ( 'confirm', [ 
							'contactPersonForm' => $contactPersonForm,
							'provinces' => $provinces_map,
							'cities' => [ ],
							'districts' => [ ],
							'detailList' => $detailList 
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
				
				// save order delivery information
				$soContactPerson = new SoContactPerson ();
				$soContactPerson->order_id = $orderId;
				$soContactPerson->name = $contactPersonForm->name;
				$soContactPerson->phone_number = $contactPersonForm->phone_number;
				$soContactPerson->province_id = $contactPersonForm->province_id;
				$soContactPerson->city_id = $contactPersonForm->city_id;
				$soContactPerson->district_id = $contactPersonForm->district_id;
				$soContactPerson->detail_address = $contactPersonForm->detail_address;
				if (! $soContactPerson->save ()) {
					Yii::trace ( '$soContactPerson->save() errors' );
					Yii::trace ( $soContactPerson->getErrors () );
					$trans->rollBack ();
					return $this->render ( 'confirm', [ 
							'contactPersonForm' => $contactPersonForm,
							'provinces' => $provinces_map,
							'cities' => [ ],
							'districts' => [ ],
							'detailList' => $detailList 
					] );
				}
				
				// TODO:save invoice detail information
				
				// commit
				$trans->commit ();
				
				// TODO:should be render,not be redirect.
				return $this->redirect ( [ 
						'/sale/vip-order/pay',
						'orderId' => $orderId 
				] );
			} catch ( Exception $e ) {
				$trans->rollBack ();
				throw $e;
			}
		} else {
			return $this->render ( 'confirm', [ 
					'contactPersonForm' => $contactPersonForm,
					'provinces' => $provinces_map,
					'cities' => [ ],
					'districts' => [ ],
					'detailList' => $detailList 
			] );
		}
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
	public function actionPay() {
		// submit order
		$orderId = $_REQUEST ['orderId'];
		$vipOrderService = new VipOrderService ();
		$soSheet = $vipOrderService->getOrder ( $orderId );
		/* $soSheet = SoSheet::findOne ( $orderId );
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
		 $soSheet->soContactPerson = $soContactPerson; */
		
		// echo \Yii::$app->request->hostInfo;
		// echo $_SERVER['SERVER_NAME'];
		// echo $_SERVER['SERVER_PORT'];
		// echo $_SERVER['HTTP_HOST'];
		// echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		// echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		
		// confirm pay type
		$pay_type_id = isset ( $_POST ['pay_type_id'] ) ? $_POST ['pay_type_id'] : null;
		if (empty ( $pay_type_id )) {
			
			$soDetailList = $soSheet->soDetailList;
			$soDetail = $soDetailList [0];
			$product = $soDetail->product;
			
			return $this->render ( 'pay', [ 
					'model' => $soSheet,
					'product' => $product 
			] );
		} else {
			// post pay information to third paty system.
			// $soSheet->pay_type_id=$pay_type_id;
			return $this->render ( 'pay', [ 
					'model' => $soSheet 
			] );
			
			/* return $this->render ( 'sale/alipay-direct/index', [
			 'WIDout_trade_no'=>$soSheet->code,
			 ] ); */
			
			// Yii::$app->response->redirect($url)
			/* return $this->redirect( '/sale/alipay-direct/index', [
			 'WIDout_trade_no'=>$soSheet->code,
			 ] ); */
		}
	}
	function actionSubmit() {
	}
}
