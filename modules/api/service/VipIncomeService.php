<?php

namespace app\modules\api\service;

use Yii;
use app\models\vip\Vip;
use app\models\system\Parameter;
use app\modules\sale\models\SaleConstants;
use yii\helpers\ArrayHelper;
use app\models\finance\VipIncome;

class VipIncomeService {
	public function getVipIncome($vip_id) {
		$model = VipIncome::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->one ();
		if ($model === null) {
			return null;
		}
		
		// balance = total - approving - rest
		/* VipWithdrawFlow::find ()->where ( 'vip_id=:vip_id', [ 
		 ':vip_id' => $vip_id 
		 ] )->andWhere ( 'status=0' )->all (); */
		$approving_amt = (new \yii\db\Query ())->select ( 'sum(amount) as amount' )->from ( 't_vip_withdraw_flow' )->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->andWhere ( 'status=0' )->one ();
		
// 		$model->can_settle_amt = ($model->amount) - $approving_amt ['amount'] - ($model->settled_amt);
		$model->can_settle_amt = ($model->can_settle_amt) - $approving_amt ['amount'];
		$model->can_withdraw_amt = ($model->can_withdraw_amt) - $approving_amt ['amount'];
		return $model;
	}
	
	public function getVipIncomeDB($vip_id) {
		$model = VipIncome::find ()->where ( 'vip_id=:vip_id', [
				':vip_id' => $vip_id
		] )->one ();
		if ($model === null) {
			return null;
		}
		return $model;
	}
}