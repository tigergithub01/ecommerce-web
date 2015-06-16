<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\components\filters\AuthFilter;
use app\components\controller\BaseController;

class BaseApiController extends BaseController {
	/* public function behaviors() {
		return [ 
				'auth' => [ 
						'class' => AuthFilter::className () 
				] 
		];
	} */
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		return parent::afterAction ( $action, $result );
	}
}
