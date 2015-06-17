<?php

namespace app\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;
use yii\web\Session;
use app\modules\sale\models\SaleConstants;
use app\components\controller\BaseController;
use app\models\common\JsonObj;
use yii\helpers\Json;
use app\models\system\SysFeedback;

class SysFeedbackController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionCreate() {
		$model = new SysFeedback ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			$model->feedback_date = date ( SaleConstants::$date_format, time () );
			$model->ip_address = \Yii::$app->request->userIP;
			if ($model->save ()) {
				$json = new JsonObj ( 1, '反馈成功。', $vip_db );
				echo (Json::encode ( $json ));
				return;
			} else {
				$json = new JsonObj ( - 1, '反馈失败。', $vip_db );
				echo (Json::encode ( $json ));
				return;
			}
		} else {
			$json = new JsonObj ( - 1, '反馈失败。', $vip_db );
			echo (Json::encode ( $json ));
			return;
		}
	}
}
