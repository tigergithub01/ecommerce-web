<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\controllers\BaseApiController;

class ApiTestController extends BaseApiController {
	public $layout = false;
	public $enableCsrfValidation = false;
	
	
	public function actionIndex() {
		$this->layout=false;
		return $this->render ( 'index' );
	}
}
