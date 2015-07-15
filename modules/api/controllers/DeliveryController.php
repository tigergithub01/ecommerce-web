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
use app\models\order\SoSheet;
use yii\helpers\ArrayHelper;

class DeliveryController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
	}
	
	public function actionRead(){
// 		$url = 'http://localhost:8085/index.php?r=api/delivery/view';
		$url = Yii::$app->request->hostInfo.'/index.php?r=api/delivery/view';
// 		echo Yii::$app->request->hostInfo.'/index.php?r=api/delivery/view';
// 		echo Yii::$app->homeUrl.'?r=api/delivery/view';
		
		$content =  file_get_contents($url); 
		var_dump(json_decode($content)) ;
		//TODO:do something.
	}
	
	public function actionView() {
		$dataList = SoSheet::find ()->where ( 'status=:status', [ 
				':status' => SoSheet::$so_status_need_receive 
		])->all();
		foreach ( $dataList as $soSheet ) {
			//TODO:
			//1、call actionViewDeliveryResult
			//2、if the goods is received ,the change order's status.
		}
		
		if ($dataList === null) {
			// throw new NotFoundHttpException ();
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$array = ArrayHelper::toArray($dataList,[
				'app\models\order\SoSheet' => [
						'id',
						'code',
						'vip_id',
						'order_amt',
						'order_quantity',
						'deliver_fee',
						'status',
						'settle_flag',
						'order_date',
						'pay_type_id',
						'pay_amt',
						'pay_date',
						'order_status_val',
						'vip_no',
				]
		]); 
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
	
	/**
	 * http://www.kuaidi100.com/openapi/
	 * http://api.kuaidi100.com/api?id=[]&com=[]&nu=[]&valicode=[]&show=[0|1|2|3]&muti=[0|1]&order=[desc|asc]
	 */
	private function actionViewDeliveryResult() {
		// 身份授权key，请 快递查询接口 进行申请（大小写敏感）
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		// 要查询的快递公司代码，不支持中文，对应的公司代码见
		$com = isset ( $_REQUEST ['com'] ) ? $_REQUEST ['com'] : null;
		// 要查询的快递单号，请勿带特殊符号，不支持中文（大小写不敏感）
		$nu = isset ( $_REQUEST ['nu'] ) ? $_REQUEST ['nu'] : null;
		/* 返回类型：
		 0：返回json字符串，
		 1：返回xml对象，
		 2：返回html对象，
		 3：返回text文本。
		 如果不填，默认返回json字符串。 */
		$show = 'json';
		
		/* 返回信息数量：
		 1:返回多行完整的信息，
		 0:只返回一行信息。
		 不填默认返回多行。 */
		$muti = 1;
		
		/* 排序：
		 desc：按时间由新到旧排列，
		 asc：按时间由旧到新排列。
		 不填默认返回倒序（大小写不敏感） */
		$order = 'desc';
	}
}
