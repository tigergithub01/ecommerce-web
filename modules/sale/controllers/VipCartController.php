<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\sale\controllers\BaseSaleController;

class VipCartController extends BaseSaleController {
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionView() {
		return $this->render ( 'view' );
	}
}
