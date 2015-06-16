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
use app\modules\sale\models\SaleConstants;
use app\models\vip\VipProductCollect;
use yii\helpers\Json;
use app\models\common\JsonObj;

class VipCollectController extends BaseSaleController {
	
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	
	/**
	 * collect producct
	 */
	public function actionAdd() {
		$product_id = $_REQUEST ['product_id'];
		$model = new VipProductCollect ();
		$model->product_id = $product_id;
		$current_vip = $_SESSION [SaleConstants::$session_vip];
		$model->vip_id = $current_vip->id;
		$model->collect_date = date ( SaleConstants::$date_format, time () );
		if ($model->save ()) {
			$json = new JsonObj ( 1, null, null );
		} else {
			$json = new JsonObj ( - 1, '产品收藏失败', null );
		}
		echo (Json::encode ( $json ));
	}
	
	/**
	 * collect producct
	 */
	public function actionDel() {
		$product_id = $_REQUEST ['product_id'];
		$current_vip = $_SESSION [SaleConstants::$session_vip];
		$rows = VipProductCollect::deleteAll ( 'product_id=:product_id and vip_id=:vip_id', [ 
				':product_id' => $product_id,':vip_id'=>$current_vip->id 
		] );
		$json = new JsonObj ( 1, null, null );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * collect producct
	 */
	public function actionIndex() {
		$vip_id = $current_vip = $_SESSION [SaleConstants::$session_vip] ['id'];
		$dataList = VipProductCollect::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->all ();
		return $this->render ( 'index', [ 
				'dataList' => $dataList 
		] );
	}
}
