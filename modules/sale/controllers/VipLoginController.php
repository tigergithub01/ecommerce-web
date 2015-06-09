<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;


class VipLoginController extends \yii\web\Controller
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
    	
//     	$vips = Vip::find()->all();
//     	var_dump($vips);
    	//app\modules\sale\models
    	$model = new VipForm(['scenario' => 'login']);
    	if ($model->load(Yii::$app->request->post())) {
//     		Yii::$app->session
// 			$_SESSION[]
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
    
    public function actionLogout(){
    	//TODO:clear session
    	return $this->redirect(['index']);
    }
    

}
