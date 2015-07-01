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
use app\models\common\JsonObj;
use yii\helpers\Json;

class VipCartController extends BaseSaleController {
	public function actionIndex() {
		$vipCartService = new VipCartService ();
		$vip = $_SESSION [SaleConstants::$session_vip];
		$detailList = $vipCartService->getShoppingCartList ( $vip->id );
		$total_amt = 0;
		$total_quantity = 0;
		foreach ( $detailList as $shoppingCart ) {
			$order_amt = $shoppingCart->product ['price'] * $shoppingCart ['quantity'];
			$total_quantity = ($total_quantity + $shoppingCart ['quantity']);
			$total_amt = ($total_amt + $order_amt);
		}
		return $this->render ( 'index', [ 
				'detailList' => $detailList,
				'total_amt' => $total_amt,
				'total_quantity' => $total_quantity 
		] );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
	public function actionAjaxUpdate() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = ShoppingCart::findOne ( $id );
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$json = new JsonObj ( 1, $model, null );
			echo (Json::encode ( $json ));
			return;
		} else {
			$json = new JsonObj ( - 1, '更新失败', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	public function actionAjaxDelete() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = ShoppingCart::findOne ( $id );
		if ($model != null) {
			if ($model->delete ()) {
				$json = new JsonObj ( 1, $id, null );
				echo (Json::encode ( $json ));
				return;
			} else {
				$json = new JsonObj ( - 1, '删除失败', null );
				echo (Json::encode ( $json ));
				return;
			}
		}
		$json = new JsonObj ( 1, null, null );
		echo (Json::encode ( $json ));
		return;
	}
}
