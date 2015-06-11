<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\components\filters\AuthFilter;

class BaseApiController extends Controller {
	public function behaviors() {
		return [ 
				'auth' => [ 
						'class' => AuthFilter::className () 
				] 
		];
	}
	public function beforeAction($action) {
		// TODO:
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		return parent::afterAction ( $action, $result );
	}
}
