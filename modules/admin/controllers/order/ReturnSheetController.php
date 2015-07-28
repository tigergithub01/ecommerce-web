<?php

namespace app\modules\admin\controllers\order;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\order\OutStockSheet;
use app\models\order\ReturnSheet;
use app\models\order\ReturnDetail;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;
use app\modules\api\utils\SheetCodeGenUtil;

/**
 * SoSheetController implements the CRUD actions for SoSheet model.
 */
class ReturnSheetController extends MyController
{
    public function actionIndex($code='',$status=null){
       $query= ReturnSheet::find()->joinWith(['statusType']);
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
    public function actionCreate($out_id=null)
    {
        
        $model = new ReturnSheet();
        
        if(Yii::$app->request->isGet){
            $model->out_id=$out_id;
        }
        
        $v=$model->load(Yii::$app->request->post());
        $outStockSheetModel= OutStockSheet::findOne($model->out_id);
        
        if(!$outStockSheetModel){
            echo "无效的出货单号";
            exit;
        }
        
        if ($v) {
            //退货单
            $model['sheet_type_id']=3;
            $model['code']=SheetCodeGenUtil::getCode(3);
            $model['order_id']=$outStockSheetModel->order_id;
            $model['user_id']=Yii::$app->user->identity->id;
            $model['sheet_date']=Yii::$app->formatter->asDate('now', 'yyyy-MM-dd HH::mm::ss');
            
            $transaction=\Yii::$app->db->beginTransaction();
            $v=$model->save();           
            if($v){
                //退货单明细               
                foreach (Yii::$app->request->post('ReturnDetail') as $i => $value) {
                    $ms=new ReturnDetail();
                    $ms->attributes=$value;
                    $ms['return_id']=$model->id;
                    $v=$v && $ms->save();
                }                
            }
            
            if($v){
                $transaction->commit();
                $logData=['op_desc'=>'添加退货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
            }else{
                $transaction->rollBack();
            }
        }           
        
        if($v){
            return $this->redirect(['order/so-sheet/view', 'id' => $outStockSheetModel->order_id]); 
        }
        else{
            return $this->render('create', [
                'model' => $model,
                'outStockSheetModel'=>$outStockSheetModel
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
        $outStockSheetModel= OutStockSheet::findOne($model->out_id);
       
        if(Yii::$app->request->isPost && $model->status!=5001){
            echo "改状态下不允许修改退货单[5001]";
            exit;
        }
        
        if ($v) {
            
            //退货单           
            $model['user_id']=Yii::$app->user->identity->id;
            $model['sheet_date']=Yii::$app->formatter->asDate('now', 'yyyy-MM-dd HH::mm::ss');
            
            $transaction=\Yii::$app->db->beginTransaction();
            $v=$model->save();           
            if($v){
                //添加，修改退货单明细
                $rdForm=Yii::$app->request->post('ReturnDetail');
                foreach ($rdForm as $i => $value) {
                    $ms=new ReturnDetail();
                    if($value['id']>0){
                        $ms=ReturnDetail::findOne($value['id']);
                    }
                    $ms->attributes=$value;
                    $ms['return_id']=$model->id;
                    $v=$v && $ms->save();
                }
                //删除
                $deleteItem=Yii::$app->request->post('removeid');
                if(!empty($deleteItem)){
                    foreach ($deleteItem as $value) {                       
                        ReturnDetail::deleteAll('id=:id',[':id'=>$value]);
                    }
                }
            }
            
            if($v){
                $transaction->commit();
                $logData=['op_desc'=>'更新退货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
            }else{
                $transaction->rollBack();
            }            
           
            return $this->redirect(['order/so-sheet/view', 'id' => $outStockSheetModel->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'outStockSheetModel'=>$outStockSheetModel
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
        $logData=['op_desc'=>'删除退货单','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
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
        if (($model = ReturnSheet::findOne($id)) !== null) {             
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConfirmFinish(){
        $request=Yii::$app->request;
        $id=$request->post("id");
        ReturnSheet ::updateStatus($id,5002);
        $logData=['op_desc'=>'审核退货单','op_data'=>"id:$id,status:5002"];
        $this->logAdmin($logData);
        
        return \yii\helpers\Json::encode(['err'=>0,'msg'=>'ok']);  
    }
}
