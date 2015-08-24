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
use app\models\system\Parameter;
use app\modules\api\service\VipOrderService;

class VipOrderController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$status = isset ( $_REQUEST ['status'] ) ? $_REQUEST ['status'] : null;
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['$order_direction'] ) ? $_REQUEST ['$order_direction'] : null;
		
		$vipList = array();
		$vip = new Vip();
		$vip->id = $vip_id;
		$vipList[]=$vip;
		
		$array = $this->getVipList($vipList, $status, $vip_id, $offset, $limit, $order_column, $order_direction);
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
	
	
	private function getVipList($vipList,$status,$vip_id,$offset,$limit,$order_column,$order_direction){
		$vip_id_array = array ();
		foreach ( $vipList as $value ) {
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
		
		// order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [
					$order_direction => $yii_sql_order
			] );
		}
		
		// add pager
		$query->offset ( $offset )->limit ( $limit );
		
		$orderList = $query->all ();
		
		foreach ( $orderList as $soSheet ) {
				
			// get vip information
			$vip = Vip::findOne ( $soSheet ['vip_id'] );
			$soSheet->vip_no = $vip->vip_no;
				
			// get order status for display
			$order_status = Parameter::findOne ( $soSheet ['status'] );
			$soSheet->order_status_val = $order_status->pa_val;
		}
		
		$array = ArrayHelper::toArray ( $orderList, [
				'app\models\order\SoSheet' => [
						'id',
						'code',
						'vip_id',
						'order_amt',
						'order_quantity',
						'deliver_fee',
						'status',
						'settle_flag',
						'order_date',
						'pay_type_id',
						'pay_amt',
						'pay_date',
						'order_status_val',
						'vip_no',
				]
		] );
		return $array;
	}
	
	public function actionGroupIndex() {
		$status = isset ( $_REQUEST ['status'] ) ? $_REQUEST ['status'] : null;
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['$order_direction'] ) ? $_REQUEST ['$order_direction'] : null;
		
		$vipService = new VipService ();
		$subVipList = $vipService->getChildern ( $vip_id );
		if (empty ( $subVipList )) {
			$json = new JsonObj ( 1, null, null );
			echo (Json::encode ( $json ));
			return;
		}
		
		$array = $this->getVipList($subVipList, $status, $vip_id, $offset, $limit, $order_column, $order_direction);
		
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
	
	public function actionView($id=null){
		$vipOrderService = new VipOrderService();
		$soSheet = $vipOrderService->getOrder($id);
		$json = new JsonObj ( 1, null, $soSheet );
		echo (Json::encode ( $json ));
	}
}
