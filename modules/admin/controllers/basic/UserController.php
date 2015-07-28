<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\basic\User;
use app\modules\admin\controllers\MyController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\basic\UserChangePasswordForm;

class UserController extends MyController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->status=1;
        
        $c=$model->load(Yii::$app->request->post());
        $model->password=md5($model->password);
        $model['create_user_id']=Yii::$app->user->identity->id;
        $model['create_date']=date(Yii::$app->params['date_format'],time());
        
        if ($c && $model->save()) {
            $roles=Yii::$app->request->post("userRoles",[]);
            $model->setUserRoles($roles);
            $logData = ['op_desc' => '添加用户', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model['update_user_id']=Yii::$app->user->identity->id;
        $model['update_date']=date(Yii::$app->params['date_format'],time());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $roles=Yii::$app->request->post("userRoles",[]);
            $model->setUserRoles($roles);
            $logData = ['op_desc' => '修改用户', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $c=$model->load(Yii::$app->request->post());
        $model->password=md5($model->password);
        $model['update_user_id']=Yii::$app->user->identity->id;
        $model['update_date']=date(Yii::$app->params['date_format'],time());
        
        if ($c && $model->save()) {    
            $logData = ['op_desc' => '用户修改密码', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('change-password', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $logData = ['op_desc' => '删除用户', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  
    
    /**
     * 修改当前用户的密码    
     */
    public function actionChangeMyPassword(){
        $model=new UserChangePasswordForm();
        $model->id=Yii::$app->user->identity->id;
        $msg=null;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            $msg="修改成功";
            $logData = ['op_desc' => '登录用户修改密码'];
            $this->logAdmin($logData);
        }
        
         return $this->render('change-my-password', [
                'model' => $model,
             'msg'=>$msg,
            ]);
    }
}
