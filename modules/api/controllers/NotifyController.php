<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\Notificatioin;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\components\controller\BaseController;

class NotifyController extends BaseController {
	public function actionIndex() {
		$dataList = Notificatioin::find ()->all ();
		$json = new JsonObj ( 1, null, $dataList );
		echo (Json::encode ( $json ));
	}
	public function actionView() {
		$id = $_REQUEST ['id'];
		$model = Notificatioin::findOne ( $id );
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
