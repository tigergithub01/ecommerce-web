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
use yii\helpers\ArrayHelper;
use app\models\finance\VipIncome;
use app\modules\sale\models\SaleConstants;
use app\modules\api\utils\SheetCodeGenUtil;
use app\modules\api\service\VipIncomeService;
use app\models\vip\VipBankcard;

/**
 * VipWithdrawFlowController implements the CRUD actions for VipWithdrawFlow model.
 */
class VipWithdrawFlowController extends BaseApiController {
	public $enableCsrfValidation = false;
	
	/**
	 * Lists all VipWithdrawFlow models.
	 * 
	 * @return mixed
	 */
	public function actionIndex() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['order_direction'] ) ? $_REQUEST ['order_direction'] : null;
		
		$query = new \yii\db\ActiveQuery ( 'app\models\finance\VipWithdrawFlow' );
		$query->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] );
		
		//set default value
		if (empty ( $order_column )) {
			$order_column='apply_date';
			$order_direction='desc';
		}
		
		// order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [ 
					$order_column => $yii_sql_order 
			] );
		}
		
		// add pager
		$query->offset ( $offset )->limit ( $limit );
		
		$dataList = $query->all ();
		
		/* $dataList = VipWithdrawFlow::find ()->where ( 'vip_id=:vip_id', [ 
		 ':vip_id' => $vip_id 
		 ] )->all (); */
		echo (Json::encode ( new JsonObj ( 1, null, $dataList ) ));
		return;
	}
	
	/**
	 * Displays a single VipWithdrawFlow model.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = VipWithdrawFlow::findOne ( $id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		
		/* $array = ArrayHelper::toArray ( $model, [
		 'app\models\finance\VipWithdrawFlow' => [
		 'id',
		 'statusName',
		 ]
		 ] ); */
		
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * Creates a new VipWithdrawFlow model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @return mixed
	 */
	public function actionCreate() {
		$connection = Yii::$app->db;
		$trans = $connection->beginTransaction ();
		try {
			$vipWithdrawFlow = new VipWithdrawFlow ();
			$vipWithdrawFlow->load ( Yii::$app->request->post () );
			
			// 提现申请金额不能大于可申请金额
			$vipIncomeService = new VipIncomeService ();
			$vip = $_SESSION [SaleConstants::$session_vip];
			$vip_id = $vip->id;
			
			//必须先完善银行卡信息
			$vipBankcard  =  VipBankcard::findOne(['vip_id'=>$vip_id]);
			if(empty($vipBankcard)){
				$json = new JsonObj ( - 1, '请先完善银行卡信息。', null );
				echo (Json::encode ( $json ));
				return;
			}
			
			$vipIncome = $vipIncomeService->getVipIncome ( $vip_id );
			if(empty($vipIncome)){
				$json = new JsonObj ( - 1, '可提现金额为零。', null );
				echo (Json::encode ( $json ));
				return;
			}
			
			$amount = $vipWithdrawFlow->amount;
			if ($amount < 50) {
				$json = new JsonObj ( - 1, '提现金额应大于等于50元。', null );
				echo (Json::encode ( $json ));
				return;
			}
			
			$amount = $vipWithdrawFlow->amount;
			if ($amount > ($vipIncome->can_withdraw_amt)) {
				$json = new JsonObj ( - 1, '最大可提现金额为'.round($vipIncome->can_withdraw_amt,2)+'元。', null );
				echo (Json::encode ( $json ));
				return;
			}
			
			// save withdraw flow
			// 提现申请单
			$vipWithdrawFlow->sheet_type_id = 5;
			$vipWithdrawFlow->code = SheetCodeGenUtil::getCode ( $vipWithdrawFlow->sheet_type_id );
			
			$vipWithdrawFlow->vip_id = $vip ['id'];
			$vipWithdrawFlow->apply_date = date ( SaleConstants::$date_format, time () );
			// 结算状态
			$vipWithdrawFlow->status = 0;
			$orderId = null;
			if (! $vipWithdrawFlow->save ()) {
				$trans->rollBack ();
			}
			
			//update $vipIncome
// 			$vipIncome->can_settle_amt = 
			/* $vipIncomeDB = $vipIncomeService->getVipIncomeDB($vip_id);
			$vipIncomeDB->can_settle_amt = $vipIncomeDB->can_settle_amt - $amount;
			$vipIncomeDB->can_withdraw_amt = $vipIncomeDB->can_withdraw_amt - $amount;
			$vipIncomeDB->settled_amt = $vipIncomeDB->settled_amt + $amount; 
			$vipIncomeDB->update();
			*/
			
			// commit
			$trans->commit ();
			
			// $vipWithdrawFlow = VipWithdrawFlow::findOne($vipWithdrawFlow->primaryKey);
			
			$array = ArrayHelper::toArray ( $vipWithdrawFlow, [ 
					'app\models\finance\VipWithdrawFlow' => [ 
							'id',
							'sheet_type_id',
							'code',
							'apply_date',
							'vip_id',
							'amount',
							'settled_amt',
							'settled_date',
							'status' 
					] 
			] );
			$json = new JsonObj ( 1, '保存成功。', $array );
			echo (Json::encode ( $json ));
			return;
		} catch ( Exception $e ) {
			$trans->rollBack ();
			// throw $e;
			$json = new JsonObj ( - 1, '保存失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
		// return $this->redirect(['view', 'id' => $model->id]);
	}
	
	/**
	 * Updates an existing VipWithdrawFlow model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
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
	 * 
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
	 * 
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
