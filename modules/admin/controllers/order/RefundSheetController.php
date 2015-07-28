<?php

namespace app\modules\admin\controllers\order;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\order\RefundSheet;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;
use app\modules\api\utils\SheetCodeGenUtil;


class RefundSheetController extends MyController
{
    public function actionIndex($code='',$status=null){
       $query= RefundSheet::find()->joinWith(['statusData']);
        if(!empty($code)){
            $query->where(['code'=>$code]);
        }
        if($status){
            $query->andWhere(['status'=>$status]);
        }
       
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
    public function actionCreate($order_id=null)
    {
        
        $model = new RefundSheet();
        
        if(Yii::$app->request->isGet){
            $model->order_id=$order_id;
        }
        
        $v=$model->load(Yii::$app->request->post());       
        $model['sheet_type_id']=4;
        $model['code']=SheetCodeGenUtil::getCode(4);
        $model['user_id']=Yii::$app->user->identity->id;
        $model['sheet_date']=date(Yii::$app->params['date_format'],time());
            
        if ($v && $model->save()){
            $logData=['op_desc'=>'添加退款单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['order/so-sheet/view', 'id' => $model->order_id]); 
        }
        else{
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
        
        $v=$model->load(Yii::$app->request->post());        
        $model['user_id']=Yii::$app->user->identity->id;  
            
        if ($v && $model->save()){
            $logData=['op_desc'=>'修改退款单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
            return $this->redirect(['order/so-sheet/view', 'id' => $model->order_id]); 
        }
        else{
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
        $logData=['op_desc'=>'删除退款单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
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
        if (($model = RefundSheet::findOne($id)) !== null) {             
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConfirmFinish(){
        $request=Yii::$app->request;
        $id=$request->post("id");
        ReturnSheet ::updateStatus($id,5002);
        $logData=['op_desc'=>'审核退款单','op_data'=>"id:$id,status:5002"];
        $this->logAdmin($logData);
        return \yii\helpers\Json::encode(['err'=>0,'msg'=>'ok']);  
    }
}
