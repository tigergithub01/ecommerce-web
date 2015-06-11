<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;

class VipRegisterController extends \yii\web\Controller {
	public function actionIndex() {
		//app\modules\sale\models
		
		$model = new VipForm ( [ 
				'scenario' => 'register' 
		] );
		if ($model->load ( Yii::$app->request->post () )) {
			$vip = new Vip ();
			$vip->vip_no = $model->vip_no;
			$vip->password = $model->password;
			$vip->status = 1;
			
			//TODO:for date field
			$time = time ();
			$vip->register_date = date('Y-m-d H:i:s',time());
			
			
			//check vip_no is been registed or not
			$vip_db = Vip::find()->where('vip_no=:vip_no',[':vip_no'=>$model->vip_no])->one();
			if(isset($vip_db)){
				$model->addError('vip_no','手机号码'+$model->vip_no+'已经被占用');
				return $this->render ( 'index', [
						'model' => $model
				] );
			}
			
			/* if(!$vip->validate()){
// 				var_dump($vip->getErrors('vip_no'));
				$model->addError('vip_no',$vip->getErrors('vip_no')[0]);
				return $this->render ( 'index', [
						'model' => $model
				] );
			}else{ */
				if (!$vip->save()) {
					return $this->render ( 'index', [
							'model' => $model
					] );
				} else {
					return $this->redirect(['/sale/vip-center/index']);
				}
			/* }  */
			
		} else {
			return $this->render ( 'index', [ 
					'model' => $model 
			] );
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
