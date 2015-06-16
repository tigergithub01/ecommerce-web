<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\models\product\Product;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\common\JsonObj;
use app\components\controller\BaseController;

class ProductController extends BaseController {
	
	/**
	 * product list
	 */
	public function actionIndex() {
		// $productList = Product::find ()->all ();
		$product_id = 2;
		$productList = Product::find ()->where ( 'id=:product_id', [ 
				":product_id" => $product_id 
		] )->andWhere ( 'name like :name', [ 
				':name' => '%%' 
		] )->orderBy ( [ 
				'price' => SORT_ASC 
		] )->offset ( 0 )->limit ( 10 )->all ();
		
		// $productList = Product::findAll(['id'=>1]);
		// echo(Json::encode($productList[]));
		
		/* $connection = Yii::$app->db;
		 $command = $connection->createCommand ( "select * from t_product" );
		 $model = $command->query (); */
		
		// echo (Json::encode ( $productList ));
		
		$array = ArrayHelper::toArray ( $productList, [ 
				'app\models\product\Product' => [ 
						'id',
						'code',
						'name',
						'type_id',
						'price',
						'description' 
				] 
		] );
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
		
		// return $this->render('index');
	}
	
	/**
	 * product detail 
	 * @param string $id
	 */
	public function actionView($id = null) {
		header ( "Content-type:json/application;charset=utf-8" );
		$model = Product::findOne ( $id );
		if ($model === null) {
			// throw new NotFoundHttpException ();
			echo (Json::encode ( new JsonObj ( - 1, 'NotFoundHttpException', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
		
		// return $this->render('index');
	}
}
