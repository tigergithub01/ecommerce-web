<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\AdInfo;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\modules\sale\models\SaleConstants;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class AdInfoController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$dataList = AdInfo::find ()->all ();
		if (! empty ( $dataList )) {
			foreach ( $dataList as $value ) {
				/* $value->url = \Yii::$app->request->hostInfo . Url::toRoute ( [ 
						'/api/ad-info/ad-url/',
						'image_url' => $value ['image_url'] 
				] ); */
				$value->url = Url::toRoute ( [
						'/api/ad-info/ad-url/',
						'image_url' => $value ['image_url']
				],true );
			}
		}
		$array = ArrayHelper::toArray ( $dataList, [ 
				'app\models\system\AdInfo' => [ 
						'id',
						'image_url',
						'url',
						'sequence_id',
						'redirect_url' 
				] 
		] );
		
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
	public function actionView() {
		$id = $_REQUEST ['id'];
		$model = AdInfo::findOne ( $id );
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	public function actionAdUrl() {
		$image_url = $_REQUEST ['image_url'];
		
		// TODO:photo should be store in other directory
		$path = SaleConstants::$ad_path . $image_url;
		
		header ( 'Content-Type:image/jpeg' );
		readfile ( $path );
	}
}
