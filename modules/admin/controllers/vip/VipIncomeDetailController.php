<?php

namespace app\modules\admin\controllers\vip;


use app\models\vip\Vip;
use app\models\finance\VipIncomeDetail;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


/**
 * VipController implements the CRUD actions for Vip model.
 */
class VipIncomeDetailController extends \app\modules\admin\controllers\MyController
{
   

    /**
     * Lists all Vip models.
     * @return mixed
     */
    public function actionIndex($vip_id)
    {
        $query=VipIncomeDetail::find()->joinWith(['vip','subVip','product'])->where(['vip_id'=>$vip_id]);
       
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort'=>[
                'defaultOrder'=>['id'=>SORT_DESC]
            ],            
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
     * Finds the Vip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VipIncomeDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
