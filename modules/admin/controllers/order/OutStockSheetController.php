<?php

namespace app\modules\admin\controllers\order;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\order\OutStockSheet;
use app\models\order\OutStockDetail;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;
use app\modules\api\utils\SheetCodeGenUtil;

/**
 * SoSheetController implements the CRUD actions for SoSheet model.
 */
class OutStockSheetController extends MyController
{
    public function actionIndex($code="",$status=null)
    {
        $query=  OutStockSheet::find()->joinWith(['statusData','deliveryInfo']);
        if(!empty($code)){
            $query->where(['t_out_stock_sheet.code'=>$code]);
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
        
        $model = new OutStockSheet();
      
        if(Yii::$app->request->isGet){
            $model->order_id=$order_id;
        }
        
        $v=$model->load(Yii::$app->request->post());
        $orderModel=  \app\models\order\SoSheet::findOne($model->order_id);
        
        if(!$orderModel){
            echo "无效的订单";
            exit;
        }
        
        if($orderModel->status!==3002){
            echo "订单在该状态下无法进行发货操作";
            exit;
        }
        
        
        if ($v) {
            //发货单
            $model['sheet_type_id']=2;
            $model['code']=SheetCodeGenUtil::getCode(2);
            $model['user_id']=Yii::$app->user->identity->id;
            $model['sheet_date']=date(Yii::$app->params['date_format'],time());
            
            $transaction=\Yii::$app->db->beginTransaction();
            $v=$osd_id=$model->save();
           
            if($v){
                //发货单明细               
                foreach (Yii::$app->request->post('OutStockDetail') as $i => $value) {
                    $ms=new OutStockDetail();
                    $ms->attributes=$value;
                    $ms['out_id']=$model->id;
                    $v=$v && $ms->save();
                }                
            }
            
            if($v){
                $transaction->commit();
            }else{
                $transaction->rollBack();
            }
        }           
        
        if($v){
            return $this->redirect(['order/so-sheet/view', 'id' => $model->order_id]); 
        }
        else{
            return $this->render('create', [
                'model' => $model               
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
        $orderModel=  \app\models\order\SoSheet::findOne($model->order_id);
        
        if(!$orderModel){
            echo "无效的订单";
            exit;
        }
        
        if($orderModel->status!==3002){
            echo "订单在该状态下无法进行发货操作";
            exit;
        }
        
        
        if ($v) {
            //发货单
            $model['user_id']=Yii::$app->user->identity->id;          
            
            $transaction=\Yii::$app->db->beginTransaction();
            $v=$osd_id=$model->save();
           
            if($v){
                //发货单明细               
                foreach (Yii::$app->request->post('OutStockDetail') as $i => $value) {
                    $ms=new OutStockDetail();
                    if($value['id']>0){
                        $ms=  OutStockDetail::findOne($value['id']);
                    }
                    $ms->attributes=$value;
                    $ms['out_id']=$model->id;
                    $v=$v && $ms->save();
                } 
                
                //删除
                $deleteItem=Yii::$app->request->post('removeid');
                if(!empty($deleteItem)){
                    foreach ($deleteItem as $value) {                       
                        OutStockDetail::deleteAll('id=:id',[':id'=>$value]);
                    }
                }
            }
            
            if($v){
                $transaction->commit();
            }else{
                $transaction->rollBack();
            }
        }           
        
        if($v){
            return $this->redirect(['order/so-sheet/view', 'id' => $model->order_id]); 
        }
        else{
            return $this->render('create', [
                'model' => $model               
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
        $this->findModel($id)->delete();

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
        if (($model = OutStockSheet::findOne($id)) !== null) {             
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConfirmOutStock(){
        $request=Yii::$app->request;
        $id=$request->post("id");
        OutStockSheet::updateStatus($id,4002);
        
        return \yii\helpers\Json::encode(['err'=>0,'msg'=>'ok']);        
    }
}
