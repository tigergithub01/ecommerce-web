<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\basic\Province;
use app\modules\admin\controllers\MyController;
use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;


/**
 * PayTypeController implements the CRUD actions for PayType model.
 */
class ProvinceController extends MyController
{
    

    /**
     * Lists all PayType models.
     * @return mixed
     */
    public function actionIndex($name=null)
    {
        $query=  Province::find();
        if(!empty($name)){
            $query->where(" name like concat('%',:name,'%')", [':name'=>$name]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>50,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
