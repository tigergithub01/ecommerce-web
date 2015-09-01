<?php

namespace app\modules\admin\controllers\finance;

use Yii;
use app\models\finance\VipWithdrawFlow;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;


/**
 * VipWithdrawFlowController implements the CRUD actions for VipWithdrawFlow model.
 */
class VipWithdrawFlowController extends MyController
{
    
    /**
     * Lists all VipWithdrawFlow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=VipWithdrawFlow::find()->joinWith('vip')->orderBy(['id'=>SORT_DESC]);
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VipWithdrawFlow model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * 提交提现申请
     */
    public function actionWithdraw(){
        $id=Yii::$app->request->post('id');
        $redirectUrl=Yii::$app->request->post('redirectUrl');
        $model=$this->findModel($id);
        $model->withdraw();
        
        $logData=['op_desc'=>'去结算','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
        
        $this->ShowMessage('去结算成功，状态已经改成结算中', $redirectUrl);
        
    }
    
    /**
     * 确认提现
     */
     public function actionConfirmWithdraw(){
        $id=Yii::$app->request->post('id');
        $redirectUrl=Yii::$app->request->post('redirectUrl');
        $model=$this->findModel($id);
        $model->confirmWithdraw();
        
        $logData=['op_desc'=>'结算完成','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
        
        $this->ShowMessage('结算完成，状态已经改完已结算。', $redirectUrl);
        
    }


    /**
     * Finds the VipWithdrawFlow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VipWithdrawFlow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VipWithdrawFlow::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}