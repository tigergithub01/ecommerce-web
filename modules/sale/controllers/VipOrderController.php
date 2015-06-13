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
use app\modules\sale\controllers\BaseSaleController;
use app\models\common\JsonObj;
use app\modules\sale\models\SaleConstants;
use yii\helpers\Json;

class VipOrderController extends BaseSaleController {
	public function beforeAction($action) {
		$session = Yii::$app->session;
		$vip = $session->get ( SaleConstants::$session_vip );
		if (empty ( $vip )) {
			return $this->redirect ( [ 
					'/sale/vip-login/index' 
			] );
		}
		return parent::beforeAction ( $action );
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
	public function actionAddContact() {
		$product_id = $_REQUEST['product_id'];
		
		$model = new SoContactPersonForm ();
		
		// province
		$provinces = Province::find ()->orderBy(['name' => SORT_ASC])->all ();
		$provinces_map = ArrayHelper::map ( $provinces, 'id', 'name' );
		// city
// 		$cities = City::find ()->all ();
// 		$cities_map = ArrayHelper::map ( $cities, 'id', 'name' );
		
		// District
// 		$districts = District::find ()->all ();
// 		$districts_map = ArrayHelper::map ( $districts, 'id', 'name' );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			return $this->redirect ( [ 
					'/sale/vip-order/confirm' 
			] );
		} else {
			return $this->render ( 'contact', [ 
					'model' => $model,
					'provinces' => $provinces_map,
					'cities' => [],
					'districts' => [] 
			] );
		}
		return $this->render ( 'contact', [ 
				'model' => $model,
				'product_id'=>$product_id,
		] );
	}
	
	/**
	 * find cities by province_id
	 * 
	 * @param string $province_id        	
	 */
	public function actionFindCities() {
		// city
		$province_id = $_REQUEST['province_id'];
		$cities = City::find ()->where ( 'province_id=:province_id', [ 
				':province_id' => $province_id 
		] )->orderBy(['name' => SORT_ASC])->all ();
		$json = new JsonObj ( 1, null, $cities );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * find districts by city_id
	 * 
	 * @param string $city_id        	
	 */
	public function actionFindDistricts() {
		// city
		$city_id = $_REQUEST['city_id'];
		$districts = District::find ()->where ( 'city_id=:city_id', [ 
				':city_id' => $city_id 
		] )->orderBy(['name' => SORT_ASC])->all ();
		$json = new JsonObj ( 1, null, $districts );
		echo (Json::encode ( $json ));
	}
	
	public function actionConfirm() {
		//submit order
		
		
		return $this->render ( 'confirm' );
	}
}
