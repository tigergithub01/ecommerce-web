<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\components\filters\AuthFilter;
use app\components\controller\BaseController;
use app\modules\sale\models\SaleConstants;
use app\models\common\JsonObj;
use yii\helpers\Json;

class BaseApiController extends BaseController {
	/* public function behaviors() {
		return [ 
				'auth' => [ 
						'class' => AuthFilter::className () 
				] 
		];
	} */
	public function beforeAction($action) {
		$session = Yii::$app->session;
		$session->open ();
		$vip = $session->get ( SaleConstants::$session_vip );
		if (empty ( $vip ) || !isset($vip)) {
			echo (Json::encode ( new JsonObj ( - 100, '请先登录。', null ) ));
			return false;
		}
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		return parent::afterAction ( $action, $result );
	}
}
