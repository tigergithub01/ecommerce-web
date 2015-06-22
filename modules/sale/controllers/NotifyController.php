<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\Notificatioin;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\components\controller\BaseController;

class NotifyController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = Notificatioin::findOne ( $id );
		return $this->render ( 'view', [ 
				'model' => $model 
		] );
	}
}
