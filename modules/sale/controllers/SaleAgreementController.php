<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\modules\sale\models\SaleConstants;
use app\models\system\SaleAgreement;
use app\models\system\UsageRights;
use app\components\controller\BaseController;

class SaleAgreementController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionView() {
// 		$this->layout = false;
		$model = SaleAgreement::find ()->one ();
		return $this->render ( 'view', [ 
				'model' => $model 
		] );
	}
	public function actionViewRights() {
		$model = UsageRights::find ()->one ();
		return $this->render ( 'view-rights', [ 
				'model' => $model 
		] );
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
