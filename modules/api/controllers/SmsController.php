<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\modules\api\controllers\BaseApiController;
use app\components\controller\BaseController;

class SmsController extends BaseController {
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionReg() {
		// Yii::$app->session
		// echo Yii::$app->session['send_code'];
		// var_dump(Yii::$app->session);
		$session = Yii::$app->session;
		$session->open ();
		$_SESSION ['send_code'] = '6666';
		$session->close ();
		
		// echo $_REQUEST['r'];
		// echo Yii::$app->request->get('r');
		
		// echo $_REQUEST['send_code'];
		return $this->render ( 'reg' );
	}
	public function actionSms() {
		return $this->render ( 'sms' );
	}
}
