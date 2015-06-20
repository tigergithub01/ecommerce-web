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

class ProductController extends BaseController {
	
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
