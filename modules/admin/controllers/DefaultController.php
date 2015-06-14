<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminLoginForm;
use yii\filters\AccessControl;

class DefaultController extends Controller
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
                    $this->redirect(['default/login']);                    
                }
            ],
           
        ]; 
    }
    
    public function actions()
    {
        return [
             'captcha' => [
                 'class' => 'yii\captcha\CaptchaAction',
                 'maxLength' => 5,
                 'minLength' => 5,
                 'width'=>80,
                 'height'=>38
             ],
         ];
     }
     
    public function actionIndex()
    {      
        $this->layout=false;
        return $this->render('index');
    }
    
    public function actionLogin(){
        
        $this->layout=false;
        $model=new AdminLoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            
           $redirectUrl= Yii::$app->request->get("redirectUrl","");
           if(!empty($redirectUrl)){
               header("location:".$redirectUrl);
               exit;
           }
           return $this->redirect(['default/index']);
            
        }else{
            return $this->render('login',['model'=>$model]);
        }
    }
    
    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(['default/login']);
    }
}
