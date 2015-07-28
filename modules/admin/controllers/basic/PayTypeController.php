<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\basic\PayType;
use app\modules\admin\controllers\MyController;
use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;


/**
 * PayTypeController implements the CRUD actions for PayType model.
 */
class PayTypeController extends MyController
{
    

    /**
     * Lists all PayType models.
     * @return mixed
     */
    public function actionIndex($name=null)
    {
        $query=PayType::find()->orderBy('id desc');
        if(!empty($name)){
            $query->where(" name like concat('%',:name,'%')", [':name'=>$name]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PayType model.
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
     * Creates a new PayType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PayType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $logData=['op_desc'=>'添加支付方式','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PayType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $logData=['op_desc'=>'修改支付方式','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PayType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $logData=['op_desc'=>'删除支付方式','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PayType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PayType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PayType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
