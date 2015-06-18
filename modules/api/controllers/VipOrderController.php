<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\models\product\Product;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\common\JsonObj;
use app\components\controller\BaseController;
use yii\db\ActiveQuery;
use app\modules\api\controllers\BaseApiController;
use app\models\vip\Vip;
use app\modules\api\service\VipService;
use app\models\order\SoSheet;

class VipOrderController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$status = isset ( $_REQUEST ['status'] ) ? $_REQUEST ['status'] : null;
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		
		// create query
		$query = new \yii\db\ActiveQuery ( 'app\models\order\SoSheet' );
		
		$query->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] );
		// add condition
		if (! empty ( $status )) {
			$query->andWhere ( 'status = :status', [ 
					':status' => $status 
			] );
		}
		
		$orderList = $query->all ();
		
		/* $array = ArrayHelper::toArray ( $orderList, [
		 'app\models\product\Product' => [
		 'id',
		 'code',
		 'name',
		 'type_id',
		 'price',
		 'description'
		 ]
		 ] ); */
		
		$json = new JsonObj ( 1, null, $orderList );
		echo (Json::encode ( $json ));
	}
	public function actionGroupIndex() {
		$status = isset ( $_REQUEST ['status'] ) ? $_REQUEST ['status'] : null;
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$vipService = new VipService ();
		$subVipList = $vipService->getChildern ( $vip_id );
		if (empty ( $subVipList )) {
			$json = new JsonObj ( 1, null, null );
			echo (Json::encode ( $json ));
			return;
		}
		
		$vip_id_array = array ();
		foreach ( $subVipList as $value ) {
			$vip_id_array [] = $value->id;
			// $vip_ids = $vip_ids.','.($value->id);
		}
		$vip_ids = implode ( ',', $vip_id_array );
		// create query
		$query = new \yii\db\ActiveQuery ( 'app\models\order\SoSheet' );
		/* $vip_ids = ArrayHelper::toArray ( $subVipList, [
		 'app\models\vip\Vip' => [
		 'id',
		 ]
		 ] ); */
		if (! empty ( $vip_id_array )) {
			$query->where ( 'vip_id in (' . $vip_ids . ')' );
		}
		// add condition
		if (! empty ( $status )) {
			$query->andWhere ( 'status = :status', [ 
					':status' => $status 
			] );
		}
		
		$orderList = $query->all ();
		
		/* $array = ArrayHelper::toArray ( $orderList, [
		 'app\models\product\Product' => [
		 'id',
		 'code',
		 'name',
		 'type_id',
		 'price',
		 'description'
		 ]
		 ] ); */
		
		$json = new JsonObj ( 1, null, $orderList );
		echo (Json::encode ( $json ));
	}
}
