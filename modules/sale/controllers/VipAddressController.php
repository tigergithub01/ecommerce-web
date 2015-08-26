<?php

namespace app\modules\sale\controllers;

use Yii;
use app\models\vip\VipAddress;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sale\controllers\BaseSaleController;
use app\models\basic\Province;
use app\models\basic\City;
use app\models\basic\District;
use app\models\common\JsonObj;
use yii\helpers\ArrayHelper;
use app\modules\sale\models\SaleConstants;
use app\models\order\SoSheetDraft;

/**
 * VipAddressController implements the CRUD actions for VipAddress model.
 */
class VipAddressController extends BaseSaleController {
	/* public function behaviors()
	 {
	 return [
	 'verbs' => [
	 'class' => VerbFilter::className(),
	 'actions' => [
	 'delete' => ['post'],
	 ],
	 ],
	 ];
	 } */
	
	/**
	 * Lists all VipAddress models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		/* $dataProvider = new ActiveDataProvider ( [ 
		 'query' => VipAddress::find () 
		 ] ); */
		$orderId = isset ( $_REQUEST ['orderId'] ) ? $_REQUEST ['orderId'] : null;
		$vip = $_SESSION [SaleConstants::$session_vip];
		$dataList = VipAddress::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip ['id'] 
		] )->andWhere ( 'status=1' )->all ();
		
		return $this->render ( 'index', [
				// 'dataProvider' => $dataProvider,
				'dataList' => $dataList,
				'orderId'=>$orderId,
		] );
	}
	
	/**
	 * 
	 * @return Ambigous <string, string>
	 */
	public function actionSelect($id) {
		/* $dataProvider = new ActiveDataProvider ( [
		 'query' => VipAddress::find ()
		] ); */
		$orderId = isset ( $_REQUEST ['orderId'] ) ? $_REQUEST ['orderId'] : null;
		SoSheetDraft::updateAll(['address_id' => $id], 'id=:id',[":id"=>$orderId]);
		return $this->redirect ( [
				'/sale/vip-order-confirm/update','orderId'=>$orderId
		] );
	}
	
	/**
	 * Displays a single VipAddress model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	
	/**
	 * Creates a new VipAddress model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$orderId = isset ( $_REQUEST ['orderId'] ) ? $_REQUEST ['orderId'] : null;
		$model = new VipAddress ();
		$provinces = Province::find ()->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$provinces_map = ArrayHelper::map ( $provinces, 'id', 'name' );
		
		$vip = $_SESSION [SaleConstants::$session_vip];
		$model->vip_id = $vip->id;
		$model->default_flag = 0;
		$model->status = 1;
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			
			if($model->default_flag==1){
				//update other vip address is not default
				VipAddress::updateAll(['default_flag' => 0], 'vip_id=:vip_id and id<>:id',[":vip_id"=>$vip->id,":id"=>$model->id]);
			}
			
			if(empty($orderId)){
				return $this->redirect ( [
						'index'
				] );
			}else{
				SoSheetDraft::updateAll(['address_id' => $model->primaryKey], 'id=:id',[":id"=>$orderId]);
				return $this->redirect ( [
						'/sale/vip-order-confirm/update','orderId'=>$orderId
				] );
			}
			
		} else {
			return $this->render ( 'create', [ 
					'model' => $model,
					'provinces' => $provinces_map,
					'cities' => [ ],
					'districts' => [ ],
					'orderId'=>$orderId 
			] );
		}
	}
	
	/**
	 * Updates an existing VipAddress model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$orderId = isset ( $_REQUEST ['orderId'] ) ? $_REQUEST ['orderId'] : null;
		$model = $this->findModel ( $id );
		
		// $provinces
		$provinces = Province::find ()->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$provinces_map = ArrayHelper::map ( $provinces, 'id', 'name' );
		
		// $cities
		$province_id = $model->province_id;
		$cities = City::find ()->where ( 'province_id=:province_id', [ 
				':province_id' => $province_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$cities_map = ArrayHelper::map ( $cities, 'id', 'name' );
		
		// $cities
		$city_id = $model->city_id;
		$districts = District::find ()->where ( 'city_id=:city_id', [ 
				':city_id' => $city_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$districts_map = ArrayHelper::map ( $districts, 'id', 'name' );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			// return $this->redirect(['update', 'id' => $model->id]);
			/* return $this->redirect ( [ 
					'index' 
			] ); */
			$vip = $_SESSION [SaleConstants::$session_vip];
			if($model->default_flag==1){
				//update other vip address is not default
				VipAddress::updateAll(['default_flag' => 0], 'vip_id=:vip_id and id<>:id',[":vip_id"=>$vip->id,":id"=>$model->id]);
			}
			
			if(empty($orderId)){
				return $this->redirect ( [
						'index'
				] );
			}else{
				SoSheetDraft::updateAll(['address_id' => $model->id], 'id=:id',[":id"=>$orderId]);
				return $this->redirect ( [
						'/sale/vip-order-confirm/update','orderId'=>$orderId
				] );
			}
		} else {
			return $this->render ( 'update', [ 
					'model' => $model,
					'provinces' => $provinces_map,
					'cities' => $cities_map,
					'districts' => $districts_map,
					'orderId'=>$orderId
			] );
		}
	}
	
	/**
	 * Deletes an existing VipAddress model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete($id) {
		$model = $this->findModel ( $id );
		$model->status = 0;
		$model->update ();
		// $this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the VipAddress model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return VipAddress the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = VipAddress::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/**
	 * find cities by province_id
	 *
	 * @param string $province_id        	
	 */
	public function actionFindCities() {
		// city
		$province_id = $_REQUEST ['province_id'];
		$cities = City::find ()->where ( 'province_id=:province_id', [ 
				':province_id' => $province_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
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
		$city_id = $_REQUEST ['city_id'];
		$districts = District::find ()->where ( 'city_id=:city_id', [ 
				':city_id' => $city_id 
		] )->orderBy ( [ 
				'name' => SORT_ASC 
		] )->all ();
		$json = new JsonObj ( 1, null, $districts );
		echo (Json::encode ( $json ));
	}
}
