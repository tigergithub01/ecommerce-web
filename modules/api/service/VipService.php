<?php

namespace app\modules\api\service;

use Yii;
use app\models\vip\Vip;
use app\models\system\Parameter;
use app\modules\sale\models\SaleConstants;
use yii\helpers\ArrayHelper;

class VipService {
	public function getChildern($vip_id) {
		$vip = Vip::findOne ( $vip_id );
		$allSubList = array ();
		$index = 0;
		$this->getChildernList ( $vip, $allSubList, $index );
		return $allSubList;
		
		/* $allSubList = array();
		 $vip  = Vip::findOne($vip_id);
		 $dataList = Vip::find()->where('parent_id=:parent_id',[':parent_id'=>$vip_id])->all();
		 // 		ArrayHelper::toArray($object);
		 if(!empty($dataList)){
		 foreach ($dataList as $vip) {
		 $this->getChildern($vip->id);
		 }
		 }else{
		 $allSubList[]=$vip;
		 } */
		return $allSubList;
	}
	private function getChildernList($vip, &$allSubList, &$index) {
		$dataList = Vip::find ()->where ( 'parent_id=:parent_id', [ 
				':parent_id' => $vip->id 
		] )->all ();
		// ArrayHelper::toArray($object);
		/* if(empty($dataList)){
		 $allSubList[] = $vip;
		 }else{
		 foreach ($dataList as $vip) {
		 $this->getChildernList($vip,$allSubList);
		 }
		 } */
		if (empty ( $dataList )) {
			// $vip->level = $index;
		} else {
			foreach ( $dataList as $vip ) {
				$allSubList [] = $vip;
				$vip->level = $index;
				$this->getChildernList ( $vip, $allSubList, $index );
			}
			$index = $index + 1;
		}
	}
}