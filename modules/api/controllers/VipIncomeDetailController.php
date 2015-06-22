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
use app\models\finance\VipIncome;
use app\models\finance\VipIncomeDetail;
use app\models\order\SoSheet;

class VipIncomeDetailController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['$order_direction'] ) ? $_REQUEST ['$order_direction'] : null;
		
		$query = new \yii\db\ActiveQuery ( 'app\models\finance\VipIncomeDetail' );
		$query->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] );
		
		// order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [
					$order_direction => $yii_sql_order
			] );
		}
		
		// add pager
		$query->offset ( $offset )->limit ( $limit );
		
		$dataList = $query->all ();
		
		/* $dataList = VipIncomeDetail::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->all (); */
		
		
		foreach ( $dataList as $value ) {
			$sub_vip_id = $value->sub_vip_id;
			$order_id = $value->order_id;
			$product_id = $value->product_id;
			
			if (! empty ( $sub_vip_id )) {
				$sub_vip = Vip::findOne ( $sub_vip_id );
				$value->sub_vip_no = $sub_vip->vip_no;
			}
			
			if (! empty ( $order_id )) {
				$soSheet = SoSheet::findOne ( $order_id );
				$value->order_code = $soSheet->code;
			}
			
			if (! empty ( $product_id )) {
				$product = Product::findOne ( $product_id );
				$value->product_name = $product->name;
			}
		}
		
		$array = ArrayHelper::toArray ( $dataList, [ 
				'app\models\finance\VipIncomeDetail' => [ 
						'id',
						'order_id',
						'product_id',
						'vip_id',
						'sub_vip_id',
						'amount',
						'sub_vip_no',
						'order_code',
						'product_name' 
				] 
		] );
		
		echo (Json::encode ( new JsonObj ( 1, null, $array ) ));
		return;
	}
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = VipIncomeDetail::findOne ( $id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$sub_vip_id = $model->sub_vip_id;
		$order_id = $model->order_id;
		$product_id = $model->product_id;
			
		if (! empty ( $sub_vip_id )) {
			$sub_vip = Vip::findOne ( $sub_vip_id );
			$model->sub_vip_no = $sub_vip->vip_no;
		}
			
		if (! empty ( $order_id )) {
			$soSheet = SoSheet::findOne ( $order_id );
			$model->order_code = $soSheet->code;
		}
			
		if (! empty ( $product_id )) {
			$product = Product::findOne ( $product_id );
			$model->product_name = $product->name;
		}
		
		$array = ArrayHelper::toArray ( $model, [
				'app\models\finance\VipIncomeDetail' => [
						'id',
						'order_id',
						'product_id',
						'vip_id',
						'sub_vip_id',
						'amount',
						'sub_vip_no',
						'order_code',
						'product_name'
				]
		] );
		
		
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
}
