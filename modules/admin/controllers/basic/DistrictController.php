<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\basic\District;
use app\modules\admin\controllers\MyController;
use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;


/**
 * PayTypeController implements the CRUD actions for PayType model.
 */
class DistrictController extends MyController
{
    

    /**
     * Lists all PayType models.
     * @return mixed
     */
    public function actionIndex($city_id,$name=null)
    {
        $city_model=  \app\models\basic\City::findOne($city_id);
        $parameter=[':city_id'=>$city_id];
        $where='where b.id=:city_id';
        
        if(!empty($name)){
            $where.=" and b.name like concat('%',:name,'%')";
            $parameter[':name']=$name;
        }
        
        $count=Yii::$app->db->createCommand("select count(*) from t_province a inner join t_city b on a.id=b.province_id
inner join t_district c on b.id=c.city_id ".$where,$parameter)->queryScalar();
        
        $sql="select a.id as province_id,a.name as province_name,b.id as city_id,b.name as city_name,c.name from t_province a inner join t_city b on a.id=b.province_id
inner join t_district c on b.id=c.city_id ".$where;       
        
        $dataProvider = new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'params'=>$parameter,
            'totalCount' => (int)$count,
            'pagination'=>[
                'pagesize'=>50,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'city_model'=>$city_model,
        ]);
    }
}
