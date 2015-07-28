<?php

namespace app\modules\admin\controllers\system;

use Yii;
use app\models\system\AdInfo;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\modules\admin\controllers\MyController;

/**
 * AdInfoController implements the CRUD actions for AdInfo model.
 */
class AdInfoController extends MyController {

    /**
     * Lists all AdInfo models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => AdInfo::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
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
        $model = new AdInfo();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->file = $im = UploadedFile::getInstance($model, 'file');
            $model->image_url = " ";
            if ($im && ($model->image_url = $im->baseName) && $model->validate()) {
                $f = date('YmdHms') . rand(1000, 9999) . '.' . $im->extension;
                $newfileName = Yii::getAlias('@webroot/upload/ad') . DIRECTORY_SEPARATOR . $f;
                $im->saveAs($newfileName);
                $model->image_url = $f;

                //生成缩略图
                $th = new \app\components\Thumb();
                $th->scaleImage($newfileName, $newfileName, 220);
            }

            if ($model->save(false)) {
                $logData=['op_desc'=>'添加广告','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
                $this->logAdmin($logData);
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
        $oldimage = $model['image_url'];
        $newfileName = "";

        if ($model->load(Yii::$app->request->post())) {
            $model->file = $im = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                
                if ($im) {
                    $f = date('YmdHms') . rand(1000, 9999) . '.' . $im->extension;
                    $newfileName = Yii::getAlias('@webroot/upload/ad') . DIRECTORY_SEPARATOR . $f;
                    if ($im->saveAs($newfileName)) {
                        $model->image_url = $f;
                        //生成缩略图
                        $th = new \app\components\Thumb();
                        $th->scaleImage($newfileName, $newfileName, 220);
                    }
                }


                if ($model->save(false)) {
                    $logData=['op_desc'=>'修改广告','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
                    $this->logAdmin($logData);
            
                    if ($im) {
                        @unlink(Yii::getAlias('@webroot/upload/ad') . DIRECTORY_SEPARATOR . $oldimage);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
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
        @unlink(Yii::getAlias('@webroot/upload/ad/') . $model->image_url);
        $model->delete();
        $logData=['op_desc'=>'删除广告','op_data'=>json_encode($model->attributes,JSON_UNESCAPED_UNICODE)];
        $this->logAdmin($logData);

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
        if (($model = AdInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
