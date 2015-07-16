<?php

namespace app\modules\admin\controllers\system;

use Yii;
use app\models\system\VipOperationLog;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\admin\controllers\MyController;

/**
 * AdInfoController implements the CRUD actions for AdInfo model.
 */
class VipOperationLogController extends MyController {

    /**
     * Lists all AdInfo models.
     * @return mixed
     */
    public function actionIndex() {
        $query=VipOperationLog::find()->joinWith(['vip','module'])->orderBy(['id' => SORT_DESC]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
     * Finds the AdInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SysFeedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
