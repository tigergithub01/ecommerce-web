<?php

namespace app\modules\admin\controllers\basic;

use Yii;
use app\models\system\Role;
use app\modules\admin\controllers\MyController;
use yii\data\ActiveDataProvider;


class RoleController extends MyController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex($name='')
    {
        $query=Role::find();
        if(!empty($name)){
            $query->where(" name like concat('%',:name,'%')",[':name'=>$name]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

  
}
