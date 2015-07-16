<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Url;

class MyController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login','captcha'],
                'rules' => [
                    [                       
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback'=>function(){
                    $this->redirect(['default/login','redirectUrl'=>  Url::to()]);                    
                }
            ],
           
        ]; 
    }
    
    public function ShowMessage($msg,$redirectUrl,$duration=5){
        $this->redirect(['comm-message/show',
            'msg'=>$msg,
            'redirectUrl'=>$redirectUrl,
            'duration'=>$duration,
        ]);
    }
}
