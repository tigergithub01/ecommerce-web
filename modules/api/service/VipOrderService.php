<?php

namespace app\modules\api\service;

use Yii;
use app\models\order\SoContactPerson;
use app\models\order\SoSheet;
use app\models\order\SoDetail;
use app\models\product\Product;
use app\models\product\ProductPhoto;
use app\models\vip\Vip;
use app\models\basic\Province;
use app\models\basic\City;
use app\models\basic\District;
use app\modules\api\models\OrderNumForm;
use app\models\system\Parameter;

class VipOrderService {
	public function getOrder($orderId) {
		$soSheet = SoSheet::findOne ( $orderId );
		
		// get sale order detail list
		$soDetailList = SoDetail::find ()->where ( 'order_id=:order_id', [ 
				':order_id' => $orderId 
		] )->all ();
		if (! empty ( $soDetailList )) {
			foreach ( $soDetailList as $soDetail ) {
				$product = Product::findOne ( $soDetail->product_id );
				
				// get main photo
				$productPhoto = ProductPhoto::find ()->where ( 'product_id=:product_id', [ 
						':product_id' => $product ['id'] 
				] )->andWhere ( 'primary_flag=1' )->one ();
				$product->primaryPhoto = $productPhoto;
				
				$soDetail->product = $product;
			}
		}
		$soSheet->soDetailList = $soDetailList;
		
		// get vip information
		$vip = Vip::findOne ( $soSheet ['vip_id'] );
		$soSheet->vip = $vip;
		
		// get order status for display
		$order_status = Parameter::findOne ( $soSheet ['status'] );
		$soSheet->order_status = $order_status;
		
		// get contact information
		$soContactPerson = SoContactPerson::find ()->where ( 'order_id=:order_id', [ 
				':order_id' => $orderId 
		] )->one ();
		if ($soContactPerson != null) {
			$province = Province::findOne ( $soContactPerson->province_id );
			$city = City::findOne ( $soContactPerson->city_id );
			$district = District::findOne ( $soContactPerson->district_id );
			
			$soContactPerson->province = $province;
			$soContactPerson->city = $city;
			$soContactPerson->district = $district;
		}
		$soSheet->soContactPerson = $soContactPerson;
		
		return $soSheet;
	}
	
	/**
	 * get order list by vip and status
	 *
	 * @param unknown $vip_id        	
	 * @param unknown $status_id        	
	 * @return NULL
	 */
	function getOrderList($vip_id, $status_id) {
		$dataList = null;
		if (empty ( $status_id )) {
			$dataList = SoSheet::find ()->where ( 'vip_id=:vip_id', [ 
					':vip_id' => $vip_id 
			] )->orderBy ( [ 
					'order_date' => SORT_DESC 
			] )->all ();
		} else {
			$dataList = SoSheet::find ()->where ( 'vip_id=:vip_id', [ 
					':vip_id' => $vip_id 
			] )->andWhere ( 'status=:status', [ 
					':status' => $status_id 
			] )->orderBy ( [ 
					'order_date' => SORT_DESC 
			] )->all ();
		}
		
		if (! empty ( $dataList )) {
			foreach ( $dataList as $soSheet ) {
				$orderId = $soSheet ['id'];
				
				// get order status for display
				$order_status = Parameter::findOne ( $soSheet ['status'] );
				$soSheet->order_status = $order_status;
				
				// get sale order detail list
				$soDetailList = SoDetail::find ()->where ( 'order_id=:order_id', [ 
						':order_id' => $orderId 
				] )->all ();
				if (! empty ( $soDetailList )) {
					foreach ( $soDetailList as $soDetail ) {
						$product = Product::findOne ( $soDetail->product_id );
						$soDetail->product = $product;
					}
				}
				$soSheet->soDetailList = $soDetailList;
				;
			}
		}
		return $dataList;
	}
	
	/**
	 * getOrderCountByStatus
	 *
	 * @param unknown $vip_id        	
	 * @return \yii\db\DataReader
	 */
	function getOrderCountByStatus($vip_id) {
		$connection = Yii::$app->db;
		$command = $connection->createCommand ( "select a.id,a.pa_val,count(b.id) count from t_parameter a left join (select * from t_so_sheet where vip_id=:vip_id) b on (a.id = b.status) where a.type_id = :param_type_id  group by a.id,a.pa_val order by a.seq_id", [ 
				':param_type_id' => 3,
				':vip_id' => $vip_id 
		] );
		$data_list = $command->queryAll ();
		return $data_list;
	}
}