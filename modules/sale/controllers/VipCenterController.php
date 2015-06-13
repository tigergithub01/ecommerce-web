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

class VipCenterController extends BaseSaleController {
	/**
	 * vip center rights
	 * (non-PHPdoc)
	 * @see \app\modules\sale\controllers\BaseSaleController::beforeAction()
	 */
	public function beforeAction($action) {
		$session = Yii::$app->session;
		/* if(!($session->isActive)){
		 return $this->redirect(['/sale/vip-login/index']);
		 } */
		$vip = $session->get ( SaleConstants::$session_vip );
		// Yii::trace('print current vip') ;
		// Yii::trace($vip) ;
		if (empty ( $vip )) {
			return $this->redirect ( [ 
					'/sale/vip-login/index' 
			] );
		}
		return parent::beforeAction ( $action );
	}
	
	/**
	 * vip center main page
	 * @return Ambigous <string, string>
	 */
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionView() {
		$current_vip = $_SESSION[SaleConstants::$session_vip];
		if($current_vip->parent_id!=null){
			$parent_vip = Vip::findOne($current_vip->parent_id);
			$current_vip->parent_vip_no = $parent_vip->vip_no;
		}
		return $this->render ( 'view', [ 
				'model' => $_SESSION[SaleConstants::$session_vip] 
		] );
	}
	
	
	
}
