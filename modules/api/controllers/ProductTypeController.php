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
use app\models\product\ProductType;

class ProductTypeController extends BaseController {
	public $enableCsrfValidation = false;
	/**
	 * product type list
	 */
	public function actionIndex() {
		$model = ProductType::find ()->all ();
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	
}
