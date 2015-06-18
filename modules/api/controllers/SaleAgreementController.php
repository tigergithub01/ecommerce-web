<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\AdInfo;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\modules\sale\models\SaleConstants;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\system\SaleAgreement;
use app\models\system\UsageRights;
use app\components\controller\BaseController;

class SaleAgreementController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionView() {
		$model = SaleAgreement::find()->one();
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	public function actionViewRights() {
		$model = UsageRights::find()->one();
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
