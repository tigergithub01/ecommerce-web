<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class VipOrderController extends \yii\web\Controller
{
	public $enableCsrfValidation = false;
	
	public function behaviors()
	{
		return [
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'delete' => ['post'],
						],
				],
		];
	}
	
    public function actionIndex()
    {
    	return $this->render('index');
    }
    
    
    public function actionView()
    {
    	return $this->render('view');
    }
    
    public function actionContact()
    {
    	return $this->render('contact');
    }
    
    public function actionConfirm()
    {
    	return $this->render('confirm');
    }
    
    
    

}
