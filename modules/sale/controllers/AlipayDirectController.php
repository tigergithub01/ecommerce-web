<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\api\service\VipOrderService;
use app\modules\sale\controllers\BaseSaleController;
use app\modules\sale\models\SaleConstants;
use app\components\controller\BaseController;
use app\models\finance\PayInfo;
use yii\helpers\Url;

class AlipayDirectController extends BaseController {
	public $layout = false;
	public function beforeAction($action) {
		return parent::beforeAction ( $action );
	}
	public function actionIndex() {
		return $this->render ( 'index' );
		// return $this->renderPartial('index');
	}
	public function actionAlipayapi() {
		$session = Yii::$app->session;
		$vip = $session->get ( SaleConstants::$session_vip );
		if (empty ( $vip )) {
			return $this->redirect ( [
					'/sale/vip-login/index'
			] );
		}
		$pay_type_id= $_REQUEST ['pay_type_id'];
		if (empty ( $pay_type_id )) {
			throw new NotFoundHttpException ( '付款方式不能为空' );
		}
		
		$vipOrderService = new VipOrderService ();
		$orderId= $_REQUEST ['order_id'];
		$soSheet = $vipOrderService->getOrder ( $orderId );
		if (empty ( $soSheet )) {
			throw new NotFoundHttpException ( '订单不存在' );
		}
		$soDetailList = $soSheet->soDetailList;
		if(empty($soDetailList)){
			throw new NotFoundHttpException ( '此订单无购买产品信息' );
		}
		
		//generate pay information
		$soDetail = $soDetailList [0];
		$product = $soDetail->product;
		$WIDout_trade_no = $soSheet ['code'];
		$WIDsubject = $product['name'];
		$WIDtotal_fee = $soSheet['order_amt'];
		$WIDbody = '';
		$model = new PayInfo();
		$model->pay_type_id = $pay_type_id;
		$model->WIDout_trade_no = $WIDout_trade_no;
		$model->WIDsubject = $WIDsubject;
		$model->WIDtotal_fee = $WIDtotal_fee;
		$model->WIDbody = $WIDbody;
		$WIDshow_url = Yii::$app->request->hostInfo.URL::toRoute(['/sale/product/view','id'=>$product['id']]);
		$model->WIDshow_url = $WIDshow_url;
		$model->order_id = $soSheet['id'];
		// 		$model->open_id = $_REQUEST['open_id'];
		//execute save order,update order pay $pay_type_id & $pay_amt
		$service = new VipOrderService ();
		$service->executeOrderPayApplyAlipay ( $model->WIDout_trade_no, $soSheet['order_amt'] );
		// 		return $this->render ( 'jsapi' );
		return $this->render ( 'alipayapi',['model'=>$model] );
	}
	public function actionNotify() {
		return $this->render ('notify_url');
	}
	public function actionReturn() {
		return $this->render ('return_url');
	}
}
