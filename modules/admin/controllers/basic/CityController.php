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
class CityController extends MyController
{
    

    /**
     * Lists all PayType models.
     * @return mixed
     */
    public function actionIndex($province_id,$name=null)
    {
        $query= \app\models\basic\City::find();        
        if(!empty($province_id)){
            $query->where(["province_id"=>$province_id]);
        }
        if(!empty($name)){
            $query->where(" name like concat('%',:name,'%')", [':name'=>$name]);
        }
        
        $provinceModel=Province::findOne($province_id);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>50,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'provinceModel'=>$provinceModel,
        ]);
    }
}
