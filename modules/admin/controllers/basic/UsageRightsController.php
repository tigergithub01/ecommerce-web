<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\system\UsageRights;
use yii\web\NotFoundHttpException;
use app\modules\admin\controllers\MyController;

/**
 * AdInfoController implements the CRUD actions for AdInfo model.
 */
class UsageRightsController extends MyController {

    /**
     * Lists all AdInfo models.
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index', [
                    'model' => UsageRights::find()->one()
        ]);
    }

    /**
     * Displays a single AdInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
    

    /**
     * Updates an existing AdInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $logData = ['op_desc' => '修改注册使用权', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
           return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Finds the AdInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UsageRights::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
