<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sale\controllers\BaseSaleController;
use app\models\product\Product;
use app\models\product\ProductPhoto;
use app\modules\sale\models\SaleConstants;
use app\components\controller\BaseController;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\common\JsonObj;

class ProductController extends BaseController {
	/**
	 * product list
	 */
	public function actionIndex() {
		// $productList = Product::find ()->all ();
		$product_name = isset ( $_REQUEST ['product_name'] ) ? $_REQUEST ['product_name'] : '';
		$show_in_homepage = isset ( $_REQUEST ['show_in_homepage'] ) ? $_REQUEST ['show_in_homepage'] : '';
		$product_type_id = isset ( $_REQUEST ['product_type_id'] ) ? $_REQUEST ['product_type_id'] : null;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['order_direction'] ) ? $_REQUEST ['order_direction'] : null;
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
	
		// create query
		$query = new \yii\db\ActiveQuery ( 'app\models\product\Product' );
	
		// add condition
		$query->where ( 'name like :name', [
				':name' => '%' . $product_name . '%'
		] );
	
		if (! empty ( $product_type_id )) {
			$query->andWhere ( 'type_id = :type_id', [
					':type_id' => $product_type_id
			] );
		}
	
		if (! empty ( $show_in_homepage )) {
			$query->andWhere ( 'show_in_homepage = :show_in_homepage', [
					':show_in_homepage' => $show_in_homepage
			] );
		}
	
	
		// order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [
					$order_column => $yii_sql_order
			] );
		}
	
		// add pager
		$query->offset ( $offset )->limit ( $limit );
	
		$productList = $query->all ();
	
		foreach ($productList as $product) {
			$productPhoto = ProductPhoto::find ()->where ( 'product_id=:product_id', [
					':product_id' => $product ['id']
			] )->andWhere ( 'primary_flag=1' )->one ();
			if(!empty($productPhoto)){
				$product->primaryPhoto = $productPhoto;
				$product->primaryPhoto_url = $productPhoto->url;
			}
		}
	
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
	
		/* $array = ArrayHelper::toArray ( $productList, [
		'app\models\product\Product' => [
		'id',
						'code',
						'name',
							'type_id',
							'price',
							'description',
									'status',
									'stock_quantity',
									'safety_quantity',
						'primaryPhoto_url',
				]
					] );
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json )); */
			
			return $this->render ( 'index', [
					'productList' => $productList,
			] );
	}
	public function actionView() {
		$product_id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		
		$model = Product::findOne ( $product_id );
		if (empty ( $model )) {
			throw new NotFoundHttpException ();
		}
		
		$photoList = ProductPhoto::find ()->where ( 'product_id=:product_id', [ 
				':product_id' => $product_id 
		] )->all ();
		
		return $this->render ( 'view', [ 
				'model' => $model,
				'photoList' => $photoList 
		] );
	}
}
