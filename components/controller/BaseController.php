<?php

namespace app\components\controller;

use Yii;
use yii\web\Controller;
use app\components\filters\VipAuthFilter;
use app\modules\sale\models\SaleConstants;
use app\models\system\VipOperationLog;
use yii\helpers\ArrayHelper;

/**
 *
 * @author Tiger-guo
 *         write log information information
 */
class BaseController extends Controller {
	/* public function behaviors() {
	 return [ 
	 'auth' => [ 
	 'class' => VipAuthFilter::className () 
	 ] 
	 ];
	 } */
	public function beforeAction($action) {
		// TODO:
		/* var_dump($_REQUEST);
		 $parameters = "";
		 foreach ($_REQUEST as $key => $value) {
		 $parameters= $parameters. '['.$key.'=>'.$value.']';
		 }
		 echo $parameters;
		 // 		var_dump(Yii::$app->request->queryString);
		 var_dump($action->id);
		 var_dump($action->controller->module->id);
		 var_dump($action->controller->id);
		 var_dump(Yii::$app->controller->module->id);
		 var_dump(Yii::$app->controller->id);
		 var_dump(Yii::$app->requestedRoute);
		 var_dump(Yii::$app); */
		Yii::trace ( 'BaseController beforeAction:' . date ( SaleConstants::$date_format, time () ) );
		
		$session = Yii::$app->session;
		$session->open ();
		$vip = $session->get ( SaleConstants::$session_vip );
		$model = new VipOperationLog ();
		if (isset ( $vip )) {
			$model->vip_id = $vip ['id'];
		}
		// $model->module_id=
		$model->op_date = date ( SaleConstants::$date_format, time () );
		$model->op_ip_addr = Yii::$app->request->userIP;
		
		// op_browser_type
		$userAgent = Yii::$app->request->userAgent;
		$model->op_browser_type =empty($userAgent)?null:$userAgent;
		yii::trace($model->op_browser_type);
		
		//phone_model
		$op_phone_model = isset ( $_REQUEST ['phone_model'] ) ? $_REQUEST ['phone_model'] : null;
		$model->op_phone_model = $op_phone_model;
		$model->op_url = Yii::$app->request->absoluteUrl;
		
		// op_desc
		$parameters = json_encode ( $_REQUEST );
		$model->op_desc = $parameters;
		$model->op_action = Yii::$app->requestedRoute;
		// os_type
		$op_os_type = isset ( $_REQUEST ['os_type'] ) ? $_REQUEST ['os_type'] : null;
		$model->op_os_type = $op_os_type;
		$model->op_method = Yii::$app->request->method;
		$model->op_module=$action->controller->module->id;
		$model->op_controller=$action->controller->id;
		$model->op_view = $action->id;
		
		//app_ver
		$op_app_ver = isset ( $_REQUEST ['app_ver'] ) ? $_REQUEST ['app_ver'] : null;
		$model->op_app_ver = $op_app_ver;
		
		//app_type_id
		$app_type_id = isset ( $_REQUEST ['app_type_id'] ) ? $_REQUEST ['app_type_id'] : null;
		if(!empty($app_type_id)){
			$model->app_type_id = $app_type_id;
		}		
		
		if(!$model->save ()){
			Yii::trace ( 'VipOperationLog save errors:' );
			Yii::error($model->errors);
		}
		
		// var_dump ( $action );
		// var_dump ( Yii::$app->request->userIP );
		// var_dump ( Yii::$app->request->userAgent );
		// var_dump ( Yii::$app->request->absoluteUrl );
		// var_dump ( Yii::$app->request->method );
		// var_dump ( Yii::$app->request->params );
		
		return parent::beforeAction ( $action );
	}
	public function afterAction($action, $result) {
		// TODO:
		// insert data into table
		return parent::afterAction ( $action, $result );
	}
}
