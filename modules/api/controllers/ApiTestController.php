<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\controllers\BaseApiController;
use app\components\controller\BaseController;

class ApiTestController extends /* BaseApiController */ BaseController{
	public $layout = false;
	public $enableCsrfValidation = false;
	
	
	public function actionIndex() {
		$this->layout=false;
		return $this->render ( 'index' );
	}
}
