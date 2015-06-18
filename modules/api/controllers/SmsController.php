<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\modules\api\controllers\BaseApiController;
use app\components\controller\BaseController;
use app\models\system\PhoneVerifyCode;
use app\models\common\JsonObj;
use yii\helpers\Json;
use app\modules\sale\models\SaleConstants;

class SmsController extends BaseController {
	public $enableCsrfValidation = false;
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
	public function actionCreate() {
		$model = new PhoneVerifyCode ();
		if ($model->load ( Yii::$app->request->post () )) {
			$model->sent_time = date ( SaleConstants::$date_format, time () );
			if ($model->save ()) {
				$json = new JsonObj ( 1, '保存成功。', $model );
				echo (Json::encode ( $json ));
			} else {
				$json = new JsonObj ( - 1, '保存失败。', null );
				echo (Json::encode ( $json ));
			}
		} else {
			$json = new JsonObj ( - 1, '数据验证失败。', null );
			echo (Json::encode ( $json ));
		}
	}
}
