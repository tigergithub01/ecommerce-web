<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\finance\VipWithdrawFlow;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\controller\BaseController;
use app\models\common\JsonObj;
use yii\helpers\Json;

/**
 * VipWithdrawFlowController implements the CRUD actions for VipWithdrawFlow model.
 */
class VipWithdrawFlowController extends BaseApiController {
	public $enableCsrfValidation = false;
	
	/**
	 * Lists all VipWithdrawFlow models.
	 * @return mixed
	 */
	public function actionIndex() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$dataList = VipWithdrawFlow::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->all ();
		echo (Json::encode ( new JsonObj ( 1, null, $dataList ) ));
		return;
	}
	
	/**
	 * Displays a single VipWithdrawFlow model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = VipWithdrawFlow::findOne ( $id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * Creates a new VipWithdrawFlow model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$connection = Yii::$app->db;
		$trans = $connection->beginTransaction ();
		try {
			// save withdraw flow
			$vipWithdrawFlow = new VipWithdrawFlow ();
			$vipWithdrawFlow->load ( Yii::$app->request->post () );
			// 提现申请单
			$vipWithdrawFlow->sheet_type_id = 5;
			$vipWithdrawFlow->code = SheetCodeGenUtil::getCode ( $vipWithdrawFlow->sheet_type_id );
			$vip = $_SESSION [SaleConstants::$session_vip];
			$vipWithdrawFlow->vip_id = $vip ['id'];
			$vipWithdrawFlow->apply_date = date ( SaleConstants::$date_format, time () );
			// 结算状态
			$vipWithdrawFlow->status = 0;
			$orderId = null;
			if (! $vipWithdrawFlow->save ()) {
				$trans->rollBack ();
			}			
			// commit
			$trans->commit ();
			$json = new JsonObj ( 1, '保存成功。', $model );
			echo (Json::encode ( $json ));
			return;
		} catch ( Exception $e ) {
			$trans->rollBack ();
			// 			throw $e;
			$json = new JsonObj ( - 1, '保存失败。', $model );
			echo (Json::encode ( $json ));
			return;
		}
		//             return $this->redirect(['view', 'id' => $model->id]);
	}
	
	/**
	 * Updates an existing VipWithdrawFlow model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Deletes an existing VipWithdrawFlow model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the VipWithdrawFlow model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return VipWithdrawFlow the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = VipWithdrawFlow::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
