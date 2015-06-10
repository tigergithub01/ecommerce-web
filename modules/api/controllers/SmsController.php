<?php

namespace app\modules\api\controllers;

use yii\web\Controller;

class SmsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionReg()
    {
    	return $this->render('reg');
    }
    
    public function actionSms()
    {
    	return $this->render('sms');
    }
}
