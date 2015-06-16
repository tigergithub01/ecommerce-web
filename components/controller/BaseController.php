<?php

namespace app\components\controller;

use Yii;
use yii\web\Controller;
use app\components\filters\VipAuthFilter;

/**
 * 
 * @author Tiger-guo
 * write log information information
 */
class BaseController extends Controller {
	/* public function behaviors() {
		return [ 
				'auth' => [ 
						'class' => VipAuthFilter::className () 
				] 
		];
	} */
	public function beforeAction($action) {
		// TODO:
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		return parent::afterAction ( $action, $result );
	}
}
