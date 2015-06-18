<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\AdInfo;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\models\system\EarnGuild;
use app\components\controller\BaseController;

class EarnGuildController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$dataList = EarnGuild::find ()->all ();
		$json = new JsonObj ( 1, null, $dataList );
		echo (Json::encode ( $json ));
	}
	public function actionView() {
		$id = $_REQUEST ['id'];
		$model = EarnGuild::findOne ( $id );
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
