<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sale\controllers\BaseSaleController;
use app\models\order\ShoppingCart;

class VipCartController extends BaseSaleController {
	public function actionIndex() {
		$vipOrderService = new VipOrderService ();
		$vip = $_SESSION [SaleConstants::$session_vip];
		
		
		
		ShoppingCart::find()->all();
		
		return $this->render ( 'index' );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
}
