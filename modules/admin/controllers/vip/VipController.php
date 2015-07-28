<?php

namespace app\modules\admin\controllers\vip;

use Yii;
use app\models\vip\Vip;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VipController implements the CRUD actions for Vip model.
 */
class VipController extends \app\modules\admin\controllers\MyController
{
   

    /**
     * Lists all Vip models.
     * @return mixed
     */
    public function actionIndex($name='',$vip_no='')
    {
        $query=Vip::find();
        if(!empty($name)){
            $query->where("name like concat('%',:name,'%')",[':name'=>$name]);
        }
        if(!empty($vip_no)){
            $query->andWhere(['vip_no'=>$vip_no]);
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

    /**
     * Displays a single Vip model.
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
     * Creates a new Vip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vip();
        $model->register_date=date('YmdHms',time());
        $model->password=md5(substr($model->vip_no,-6));
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $logData=['op_desc'=>'添加会员','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
                    
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $logData=['op_desc'=>'修改会员','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $logData=['op_desc'=>'删除会员','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $model->delete();
        $this->logAdmin($logData);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Vip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
