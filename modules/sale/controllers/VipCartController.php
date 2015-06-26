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
use app\modules\api\service\VipCartService;
use app\modules\sale\models\SaleConstants;

class VipCartController extends BaseSaleController {
	public function actionIndex() {
		$vipCartService = new VipCartService ();
		$vip = $_SESSION [SaleConstants::$session_vip];
		$detailList = $vipCartService->getShoppingCartList ( $vip->id );
		return $this->render ( 'index', [ 
				'detailList' => $detailList 
		] );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
}
