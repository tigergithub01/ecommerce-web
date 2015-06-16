<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\sale\controllers\BaseSaleController;
use app\models\product\ProductPhoto;
use app\modules\sale\models\SaleConstants;
use app\components\controller\BaseController;

class ProductPhotoController extends BaseController {
	public function actionView() {
		$id = $_REQUEST ['id'];
		$model = ProductPhoto::findOne ( $id );
		
		// TODO:photo should be store in other directory
		$path = SaleConstants::$product_path . ($model->url);
		
		header ( 'Content-Type:image/jpeg' );
		readfile ( $path );
	}
	
	public function actionIndex() {
		$product_id = $_REQUEST ['product_id'];
		$dataList = ProductPhoto::find ()->where ( 'product_id=:product_id', [ 
				':product_id' => $product_id 
		]);
		
		
		/* echo Yii::$app->basePath;
		 echo Yii::$app->getRuntimePath();
		 //得到当前url
		 echo Yii::$app->request->url;
		 //得到当前home url
		 echo Yii::$app->homeUrl;
		 echo dirname(Yii::app()->BasePath);
		 echo $_SERVER['DOCUMENT_ROOT']; */
		
		/* return $this->render ( 'view', [
		 'dataList' => $dataList
		 ] ); */
	}
}
