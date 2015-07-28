<?php

namespace app\modules\admin\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\system\AdminOperationLog;

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
    
    public function ShowMessage($msg,$redirectUrl=null,$duration=5){
        if(!$redirectUrl){
            $redirectUrl=$_SERVER['HTTP_REFERER'];
        }
        
        $this->redirect(['comm-message/show',
            'msg'=>$msg,
            'redirectUrl'=>$redirectUrl,
            'duration'=>$duration,
        ]);
    }
    
    /**
     * 记录后台操作log
     * @param type $data
     */
    public function logAdmin($data){           
        $model=new AdminOperationLog();
        $model->attributes=[
            'user_id'=>Yii::$app->user->identity->id,
            'controller'=>$this->id,
            'action'=>$this->action->id,
            'op_data'=>'',
            'op_date'=>date(Yii::$app->params['date_format'],time()),
            'op_ip_addr'=>Yii::$app->request->userIP,
            'op_browser_type'=>Yii::$app->request->userAgent,
            'op_url'=>Yii::$app->request->url,
            'op_desc'=>'',
        ];
        
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $model->$key=$value;
            }
        }
       
        
        $model->save(false);
    }
}
