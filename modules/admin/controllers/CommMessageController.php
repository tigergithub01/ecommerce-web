<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;


class CommMessageController extends Controller
{
    public function actionIndex()
    {      
        $this->layout=false;
        return $this->render('index');
    }
    
    public function actionShow($msg,$redirectUrl="",$duration=5){
        $this->layout=false;
        return $this->render('show',[
            'msg'=>$msg,
            'duration'=>$duration,
            'redirectUrl'=>$redirectUrl,
        ]);
        
    }
    
   
}