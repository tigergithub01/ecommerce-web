<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\modules\sale\models\SaleConstants;
use app\models\system\SaleAgreement;
use app\models\system\UsageRights;
use app\components\controller\BaseController;
use app\models\system\EarnGuild;

class EarnGuildController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionView() {
// 		$this->layout = false;
		$model = EarnGuild::find ()->one ();
		return $this->render ( 'view', [ 
				'model' => $model 
		] );
	}
}
