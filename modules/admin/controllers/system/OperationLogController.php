<?php

namespace app\modules\admin\controllers\system;

use Yii;
use app\models\system\OperationLog;
use app\models\system\AdminOperationLog;
use app\modules\admin\controllers\MyController;



class OperationLogController extends MyController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex($name='')
    {

        $params=[];
        
        return $this->render('index', [
            'dataProvider' => AdminOperationLog::getList($params),
        ]);
    }

  
}
