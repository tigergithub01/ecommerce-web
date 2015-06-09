<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\SoContactPersonForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\basic\Province;
use app\models\basic\City;
use app\models\basic\District;
use yii\helpers\ArrayHelper;

class VipOrderController extends \yii\web\Controller {
	public $enableCsrfValidation = false;
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	
	public function actionView() {
		return $this->render ( 'view' );
	}
	
	public function actionContact() {
		$model = new SoContactPersonForm ();
		
		//province
		$provinces=Province::find()->all();
		$provinces_map = ArrayHelper::map($provinces, 'id', 'name');
		
		//city
		$cities=City::find()->all();
		$cities_map = ArrayHelper::map($cities, 'id', 'name');
		
		//District
		$districts=District::find()->all();
		$districts_map = ArrayHelper::map($districts, 'id', 'name');
		
		
		if ($model->load ( Yii::$app->request->post () ) && $model->validate()) {
			return $this->redirect ( [ 
					'/sale/vip-order/confirm' 
			] );
		} else {
			return $this->render ( 'contact', [ 
					'model' => $model ,
					'provinces'=>$provinces_map,
					'cities'=>$cities_map,
					'districts'=>$districts_map,
			] );
		}
		return $this->render ( 'contact', [ 
				'model' => $model 
		] );
	}
	public function actionConfirm() {
		return $this->render ( 'confirm' );
	}
}
