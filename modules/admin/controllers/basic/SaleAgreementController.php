<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\system\SaleAgreement;
use yii\web\NotFoundHttpException;
use app\modules\admin\controllers\MyController;

/**
 * AdInfoController implements the CRUD actions for AdInfo model.
 */
class SaleAgreementController extends MyController {

    /**
     * Lists all AdInfo models.
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index', [
                    'model' => SaleAgreement::find()->one()
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
     * Creates a new AdInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SaleAgreement();       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
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
            $logData = ['op_desc' => '修改销售协议', 'op_data' => json_encode($model->attributes, JSON_UNESCAPED_UNICODE)];
            $this->logAdmin($logData);
           return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);       
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SaleAgreement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
