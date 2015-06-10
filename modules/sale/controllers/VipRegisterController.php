<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;


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
    		
    		$vip = new Vip();
    		$vip->vip_no=$model->vip_no;
    		$vip->password=$model->password;
    		$vip->status=1;
    		 
    		//TODO:for date field
    		$time = time();
    		$vip->register_date=$time;    		
    		
    		$connection = Yii::$app->db;
    		$trans=$connection->beginTransaction();
    		try {
    			$vip = new Vip();
    			$vip->vip_no=$model->vip_no;
    			$vip->password=$model->password;
    			$vip->status=1;
    			
    			//TODO:for date field
    			$time = time();
    			$vip->register_date=$time;
    			if(!$vip->validate()){
    			 //echo 'validate error';
    			 return;
    			}
    			if(!$vip->save()){
    				//echo 'validate error';
    				$trans->rollBack();
    				
    			}
    			$trans->commit();
    		} catch (\Exception $e) {
    			$trans->rollBack();
    			throw $e;
    		}
    		return $this->redirect(['/sale/vip-center/index']);
    	} else {
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
