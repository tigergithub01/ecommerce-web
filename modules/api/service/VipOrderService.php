<?php

namespace app\modules\api\service;

use Yii;
use app\models\order\SoContactPerson;
use app\models\order\SoSheet;
use app\models\order\SoDetail;
use app\models\product\Product;
use app\models\vip\Vip;
use app\models\basic\Province;
use app\models\basic\City;
use app\models\basic\District;
use app\modules\api\models\OrderNumForm;

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
				$soDetail->product = $product;
			}
		}
		$soSheet->soDetailList = $soDetailList;
		
		// get vip information
		$vip = Vip::findOne ( $soSheet ['vip_id'] );
		$soSheet->vip = $vip;
		
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
	
	function getOrderList($vip_id, $status_id) {
		$dataList = SoSheet::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->andWhere ( 'status=:status', [ 
				':status' => $status_id 
		] )->all ();
		if(!empty($dataList)){
			foreach ($dataList as $soSheet) {
				$orderId = $soSheet['id'];
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
				$soSheet->soDetailList = $soDetailList;;
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