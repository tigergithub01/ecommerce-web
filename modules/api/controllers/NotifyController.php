<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\system\Notification;
use app\modules\api\controllers\BaseApiController;
use yii\helpers\Json;
use app\models\common\JsonObj;
use app\components\controller\BaseController;

class NotifyController extends BaseController {
	public $enableCsrfValidation = false;
	
	public function actionIndex() {
		$offset = isset ( $_REQUEST ['offset'] ) ? $_REQUEST ['offset'] : 0;
		$limit = isset ( $_REQUEST ['page_count'] ) ? $_REQUEST ['page_count'] : 15;
		$order_column = isset ( $_REQUEST ['order_column'] ) ? $_REQUEST ['order_column'] : null;
		$order_direction = isset ( $_REQUEST ['$order_direction'] ) ? $_REQUEST ['$order_direction'] : null;
		
		$query = new \yii\db\ActiveQuery ( 'app\models\system\Notification' );
		
		// order
		$yii_sql_order = (empty ( $order_direction ) or $order_direction == 'asc') ? SORT_ASC : SORT_DESC;
		if (! empty ( $order_column )) {
			$query->orderBy ( [
					$order_direction => $yii_sql_order
			] );
		}
		
		// add pager
		$query->offset ( $offset )->limit ( $limit );
		
		$dataList = $query->all ();
		
		$json = new JsonObj ( 1, null, $dataList );
		echo (Json::encode ( $json ));
	}
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = Notification::findOne ( $id );
		if ($model === null) {
			// throw new NotFoundHttpException ();
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
