<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use app\models\product\Product;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\common\JsonObj;
use app\components\controller\BaseController;
use yii\db\ActiveQuery;

class ProductController extends BaseController {
	
	/**
	 * product list
	 */
	public function actionIndex() {
		// $productList = Product::find ()->all ();
		$product_name = isset ( $_REQUEST ['product_name'] ) ? $_REQUEST ['product_name'] : '';
		$product_type_id = isset ( $_REQUEST ['product_type_id'] ) ? $_REQUEST ['product_type_id'] : null;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['$order_direction'] ) ? $_REQUEST ['$order_direction'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 2;
		
		//create query
		$query = new \yii\db\ActiveQuery ( 'app\models\product\Product' );
		
		//add condition
		$query->where ( 'name like :name', [ 
				':name' => '%' . $product_name . '%' 
		] );
		
		if (! empty ( $product_type_id )) {
			$query->andWhere ( 'type_id = :type_id', [ 
					':type_id' => $product_type_id 
			] );
		}
		
		//order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [ 
					$order_direction => $yii_sql_order 
			] );
		}
		
		//add pager
		$query->offset ( $offset )->limit ( $limit );
		
		$productList = $query->all ();
		
		/* $productList = Product::find ()->where ( 'id=:product_id', [ 
		 ":product_id" => $product_id 
		 ] )->andWhere ( 'name like :name', [ 
		 ':name' => '%'.$product_name.'%' 
		 ] )->orderBy ( [ 
		 'price' => SORT_ASC 
		 ] )->offset ( 0 )->limit ( 10 )->all (); */
		
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
	public function actionView() {
		// 		header ( "Content-type:json/application;charset=utf-8" );
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = Product::findOne ( $id );
		if ($model === null) {
			// throw new NotFoundHttpException ();
			echo (Json::encode ( new JsonObj ( - 1, '产品不存在。', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
		
		// return $this->render('index');
	}
}
