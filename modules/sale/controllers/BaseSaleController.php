<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\web\Controller;
use app\components\controller\BaseController;
use app\modules\sale\models\SaleConstants;

class BaseSaleController extends BaseController {
	public function beforeAction($action) {
		$session = Yii::$app->session;
		$vip = $session->get ( SaleConstants::$session_vip );
		if (empty ( $vip ) || !isset($vip)) {
			return $this->redirect ( [ 
					'/sale/vip-login/index' 
			] );
		}
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		return parent::afterAction ( $action, $result );
	}
}
