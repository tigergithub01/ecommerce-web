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
    
    public function actionWithdraw(){
        $id=Yii::$app->request->post('id');
        $redirectUrl=Yii::$app->request->post('redirectUrl');
        $model=$this->findModel($id);
        $model->withdraw();
        
        $this->ShowMessage('结算成功，已经改变了状态。', $redirectUrl);
        
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