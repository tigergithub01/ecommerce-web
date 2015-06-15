<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\api\service\VipOrderService;

class AlipayDirectController extends \yii\web\Controller {
	public $layout = false;
	public function actionIndex() {
		return $this->render ( 'index' );
		// return $this->renderPartial('index');
	}
	public function actionAlipayapi() {
		// update order pay $pay_type_id & $pay_amt
		$out_trade_no = $_POST ['WIDout_trade_no'];
		$total_fee = $_POST ['WIDtotal_fee'];
		
		$service = new VipOrderService ();
		$service->executeOrderPayApplyAlipay ( $out_trade_no, $total_fee );
		
		return $this->render ( 'alipayapi' );
	}
	public function actionNotify() {
		return $this->render ( 'notify_url' );
	}
	public function actionReturn() {
		return $this->render ( 'return_url.' );
	}
}
