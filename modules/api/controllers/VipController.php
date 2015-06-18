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
use app\modules\sale\models\VipForm;

class VipController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
	}
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = Vip::findOne ( $id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
	public function actionUpdate() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = Vip::findOne ( $id );
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
	public function actionUpdatePwd() {
		// 		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = new VipForm ( [ 
				'scenario' => 'update_pwd' 
		] );
		$model->load ( Yii::$app->request->post () );
		if ($model->validate ()) {
			// 			$vip = new Vip ();
			$vip = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] );
			$vip->password = $model->password;
			
			//update password
			if ($vip->update ( true, [ 
					'password' 
			] )) {
				$json = new JsonObj ( 1, '保存成功。', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				$json = new JsonObj ( - 1, '保存失败。', null );
				echo (Json::encode ( $json ));
				return;
			}
		} else {
			$json = new JsonObj ( - 1, '数据验证失败。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	
	/**
	 * get children vips 
	 * //TODO:
	 */
	public function actionChildren() {
	}
}
