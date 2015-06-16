<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sale\controllers\BaseSaleController;
use yii\web\Session;
use app\models\vip\Vip;
use app\modules\sale\models\SaleConstants;
use app\modules\api\service\VipOrderService;
use app\modules\api\service\app\modules\api\service;

class VipCenterController extends BaseSaleController {
	/**
	 * vip center rights
	 * (non-PHPdoc)
	 * 
	 * @see \app\modules\sale\controllers\BaseSaleController::beforeAction()
	 */
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	
	/**
	 * vip center main page
	 * 
	 * @return Ambigous <string, string>
	 */
	public function actionIndex() {
		$current_vip = $_SESSION [SaleConstants::$session_vip];
		$service = new VipOrderService ();
		$orderCountList = $service->getOrderCountByStatus ( $current_vip->id );
// 		var_dump($orderCountList);
		return $this->render ( 'index', [ 
				'orderCountList' => $orderCountList 
		] );
	}
	public function actionView() {
		$current_vip = $_SESSION [SaleConstants::$session_vip];
		if ($current_vip->parent_id != null) {
			$parent_vip = Vip::findOne ( $current_vip->parent_id );
			$current_vip->parent_vip_no = $parent_vip->vip_no;
		}
		return $this->render ( 'view', [ 
				'model' => $_SESSION [SaleConstants::$session_vip] 
		] );
	}
}
