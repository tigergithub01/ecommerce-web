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
use app\modules\api\controllers\BaseApiController;
use app\models\vip\Vip;
use app\models\vip\VipBankcard;
use app\models\basic\BankInfo;

class VipBankController extends BaseApiController {
	public $enableCsrfValidation = false;
	/**
	 * product list
	 */
	public function actionIndex() {
	}
	public function actionView() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$model = VipBankcard::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->one ();
		if ($model === null) {
			// throw new NotFoundHttpException ();
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		
		// get bank_name
		$bankInfo = BankInfo::findOne ( $model->bank_id );
		$model->bank_name = $bankInfo->name;
		
		// output json result
		$array = ArrayHelper::toArray ( $model, [ 
				'app\models\vip\VipBankcard' => [ 
						'id',
						'vip_id',
						'card_no',
						'bank_id',
						'branch_name',
						'open_addr',
						'bank_name' 
				] 
		] );
		
		$json = new JsonObj ( 1, null, $array );
		echo (Json::encode ( $json ));
	}
	public function actionCreate() {
		$model = new VipBankcard ();
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$json = new JsonObj ( 1, '保存成功。', $model );
			echo (Json::encode ( $json ));
			return;
		} else {
			$json = new JsonObj ( - 1, '保存失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	public function actionUpdate() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = VipBankcard::findOne ( $id );
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$json = new JsonObj ( 1, '保存成功。', $model );
			echo (Json::encode ( $json ));
			return;
		} else {
			$json = new JsonObj ( - 1, '保存失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	public function actionBankList() {
		$model = BankInfo::find ()->all ();
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
