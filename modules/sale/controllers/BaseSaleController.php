<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\web\Controller;
use app\components\filters\VipAuthFilter;

class BaseSaleController extends Controller {
	public function behaviors() {
		return [ 
				'auth' => [ 
						'class' => VipAuthFilter::className () 
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
