<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\controller\BaseController;
use yii\helpers\Url;

class WxpaySdkController extends BaseController {
	public $layout = false;
	public $enableCsrfValidation = false;
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}	
	
	public function actionNotify() {
		/* $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		var_dump($xml); */
		return $this->render ( 'notify' );
	}
}
