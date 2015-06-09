<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class VipRegisterController extends \yii\web\Controller
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
    	//app\modules\sale\models
    	$model = new VipForm(['scenario' => 'register']);
    	if ($model->load(Yii::$app->request->post())) {
//     		return $this->goBack();
    		return $this->redirect(['/sale/vip-center/index']);
    	} else {
    		//$model->addError('password','用户名或密码不正确');
    		return $this->render('index', [
    				'model' => $model,
    		]);
    	}
    	
    	/* if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		return $this->redirect(['view', 'id' => $model->id]);
    	} else {
    		return $this->render('create', [
    				'model' => $model,
    		]);
    	} */
    	
    }
    
   

}
