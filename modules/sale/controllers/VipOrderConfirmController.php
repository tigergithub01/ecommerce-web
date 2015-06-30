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
use app\models\order\SoSheetDraft;
use app\models\order\SoDetailDraft;
use app\models\vip\VipAddress;

class VipOrderConfirmController extends BaseSaleController {
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	/* public function actionIndex($status = null) {
	 $vipOrderService = new VipOrderService ();
	 $vip = $_SESSION [SaleConstants::$session_vip];
	 $orderList = $vipOrderService->getOrderList ( $vip->id, $status );
	 return $this->render ( 'index', [ 
	 'orderList' => $orderList 
	 ] );
	 } */
	public function actionUpdate($orderId) {
		// $address_id = isset ( $_REQUEST ['address_id'] ) ? $_REQUEST ['address_id'] : null;
		$vip = $_SESSION [SaleConstants::$session_vip];
		$vipOrderService = new VipOrderService ();
		$soSheet = $vipOrderService->getOrderDraft ( $orderId );
		$address_count = (new yii\db\Query ())->select ( 'count(1)' )->from ( 't_vip_address' )->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip ['id'] 
		] )->andWhere('status=1') ->createCommand ()->queryScalar ();
		// $query = (new yii\db\Query());
		// $query->createCommand()->queryScalar();
		// if($soSheet->address_id)
		$vipAddress = VipAddress::findOne ( $soSheet->address_id );
		return $this->render ( 'update', [ 
				'soSheet' => $soSheet,
				'vipAddress' => $vipAddress,
				'address_count' => $address_count 
		] );
	}
	public function actionCreate() {
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
			// $soDetail ['product_name'] = $product->name;
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
			$soSheet = new SoSheetDraft ();
			// 销售订单-草稿
			$soSheet->vip_id = $vip ['id'];
			$soSheet->order_amt = $order_amt;
			$soSheet->order_quantity = $order_quantity;
			$soSheet->order_date = date ( SaleConstants::$date_format, time () );
			
			// setup default vip address
			$vipAddress = VipAddress::find ()->where ( 'vip_id=:vip_id', [ 
					':vip_id' => $vip ['id'] 
			] )->andWhere ( 'default_flag=1' )->andWhere('status=1')->one ();
			if (! empty ( $vipAddress )) {
				$soSheet->address_id = $vipAddress->id;
			}
			
			$orderId = null;
			if ($soSheet->save ()) {
				// $orderId = $soSheet->primaryKey;
				$orderId = $soSheet->attributes ['id'];
			} else {
				// throw exception
				// Yii::trace ( '$soSheet->save() errors' );
				// Yii::trace ( $soSheet->getErrors () );
				/* return $this->render ( 'confirm', [ 
				 'contactPersonForm' => $contactPersonForm,
				 'provinces' => $provinces_map,
				 'cities' => [ ],
				 'districts' => [ ],
				 'detailList' => $detailList 
				 ] ); */
				throw new Exception ( '购买出错' );
			}
			
			// save orderDetail
			foreach ( $detailList as $value ) {
				$soDetail = new SoDetailDraft ();
				$soDetail->product_id = $value ['product_id'];
				$soDetail->quantity = $value ['quantity'];
				$soDetail->price = $value ['price'];
				$soDetail->amount = $value ['amount'];
				$soDetail->order_id = $orderId;
				// TODO:when save failed ,should show errors.
				if (! $soDetail->save ()) {
					$trans->rollBack ();
					throw new Exception ( '购买出错' );
				}
			}
			// TODO:save invoice detail information
			
			// commit
			$trans->commit ();
			
			// TODO:should be render,not be redirect.
			return $this->redirect ( [ 
					'/sale/vip-order-confirm/update',
					'orderId' => $orderId 
			] );
		} catch ( Exception $e ) {
			$trans->rollBack ();
			throw $e;
		}
	}
}
