<?php

namespace app\modules\admin\controllers\order;

use Yii;
use app\models\order\SoSheet;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SoSheetController implements the CRUD actions for SoSheet model.
 */
class SoSheetController extends MyController
{
    

    /**
     * Lists all SoSheet models.
     * @return mixed
     */
    public function actionIndex($code="",$status=null)
    {
        $query=SoSheet::find()->joinWith('orderStatus',true);
        if(!empty($code)){
            $query->where(['code'=>$code]);
        }
        if($status){
            $query->andWhere(['status'=>$status]);
        }
        
        $row=$query->all();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>['id'=>SORT_DESC]
            ],
            'pagination'=>[
                'pagesize'=>10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoSheet model.
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
     * Creates a new SoSheet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SoSheet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $logData=['op_desc'=>'添加发货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SoSheet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $logData=['op_desc'=>'修改发货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SoSheet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $logData=['op_desc'=>'删除发货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $model->delete();
        $this->logAdmin($logData);
        return $this->redirect(['index']);
    }


    /**
     * Finds the SoSheet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SoSheet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SoSheet::findOne($id)) !== null) {             
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionRefundSheet($id){
        $model=SoSheet::findOne($id);        
        return $this->renderPartial('refund_sheet_view', [
            'model'=>$model
        ]);
    }
    
    public function actionOutStockSheet($id){
        $model=SoSheet::findOne($id);        
        return $this->renderPartial('out_stock_sheet_view', [
            'model'=>$model
        ]);
    }
}
