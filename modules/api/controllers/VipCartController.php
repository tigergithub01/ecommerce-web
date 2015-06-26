<?php

namespace app\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\api\controllers\BaseApiController;
use app\models\order\ShoppingCart;
use app\models\order\app\models\order;
use app\modules\sale\models\SaleConstants;
use app\models\common\JsonObj;
use yii\helpers\Json;

class VipCartController extends BaseApiController {
	public function actionCreate() {
		$model = new ShoppingCart ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			$vip = $_SESSION [SaleConstants::$session_vip];
			$product_id = $model->product_id;
			$price = $model->price;
			$quantity = $model->quantity;
			
			$modelDb = ShoppingCart::find ()->where ( 'vip_id=:vip_id', [ 
					':vip_id' => $vip->id 
			] )->andWhere('product_id=:product_id',[':product_id'=>$product_id])->one();
			if (empty ( $modelDb )) {
				$model->vip_id = $vip ['id'];
				$model->amount = $quantity * $price;
				$model->create_date = date ( SaleConstants::$date_format, time () );
				if ($model->save ()) {
					$json = new JsonObj ( 1, '保存成功。', $model );
					echo (Json::encode ( $json ));
					return;
				} else {
					$json = new JsonObj ( - 1, '保存失败。', null );
					echo (Json::encode ( $json ));
					return;
				}
			} else {
				$quantity = $quantity + $modelDb->quantity;
				$price = $model->price;
				$modelDb->quantity = $quantity;
				$modelDb->price = $price;
				$modelDb->amount = $quantity * $price;
				$modelDb->update_date = date ( SaleConstants::$date_format, time () );
				if ($modelDb->update ()) {
					$json = new JsonObj ( 1, '保存成功。', $modelDb );
					echo (Json::encode ( $json ));
					return;
				} else {
					$json = new JsonObj ( - 1, '保存失败。', null );
					echo (Json::encode ( $json ));
					return;
				}
			}
		} else {
			$json = new JsonObj ( - 1, '保存失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	
	/**
	 * Updates an existing VipWithdrawFlow model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = ShoppingCart::findOne ( $id );
		$model->update_date = date ( SaleConstants::$date_format, time () );
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$json = new JsonObj ( 1, '保存成功。', $model );
			echo (Json::encode ( $json ));
			return;
		} else {
			$json = new JsonObj ( - 1, '保存失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	
	/**
	 * Deletes an existing VipWithdrawFlow model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = ShoppingCart::findOne ( $id );
		$status = $model->delete ();
		
		// TODO:should return delete status
		$json = new JsonObj ( 1, '删除成功。', $status );
		echo (Json::encode ( $json ));
		return;
	}
	
	/**
	 * Deletes an existing VipWithdrawFlow model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionClear() {
		// $id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$vip = $_SESSION [SaleConstants::$session_vip];
		$deletedCount = ShoppingCart::deleteAll ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip->id 
		] );
		// TODO:should return delete status
		$json = new JsonObj ( 1, '删除成功。', $deletedCount );
		echo (Json::encode ( $json ));
		return;
	}
}
