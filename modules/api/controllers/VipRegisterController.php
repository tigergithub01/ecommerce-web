<?php

namespace app\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;
use app\modules\sale\models\SaleConstants;
use app\models\system\PhoneVerifyCode;
use app\components\controller\BaseController;
use app\models\common\JsonObj;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class VipRegisterController extends BaseController {
	public $enableCsrfValidation = false;
	
	public function actionAjaxIndex() {
		$session = Yii::$app->session;
		$session->open ();
		
		// start register
		$model = new VipForm ( [ 
				'scenario' => 'register' 
		] );
		if ($model->load ( Yii::$app->request->post () ) && $model->validate()) {
			$vip = new Vip ();
			$vip->vip_no = $model->vip_no;
			$vip->password = md5 ( $model->password );
			$vip->status = 1;
			
			// TODO:for date field
			// $time = time ();
			$vip->register_date = date ( SaleConstants::$date_format, time () );
			
			// check vip_no is been registed or not
			$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
			if (! empty ( $vip_db )) {
				$json = new JsonObj ( - 1, '手机号码' . ($model->vip_no) . '已经被占用', null );
				echo (Json::encode ( $json ));
				return;
			}
			
			// validate verifyCode from database
			$phoneVerifyCodeModel = PhoneVerifyCode::find ()->where ( 'phone_number=:phone_number', [ 
					':phone_number' => $model->vip_no 
			] )->orderBy ( [ 
					'sent_time' => SORT_DESC 
			] )->offset ( 0 )->limit ( 1 )->one ();
			if (empty ( $phoneVerifyCodeModel )) {
				$json = new JsonObj ( - 1, '手机验证码输入错误。', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				// verifyCode is correct or not
				if ($phoneVerifyCodeModel->verify_code != $model->verifyCode) {
					$json = new JsonObj ( - 1, '手机验证码输入错误。', null );
					echo (Json::encode ( $json ));
					return;
				}
				
				// verifyCode expired or not
				$startdate = $phoneVerifyCodeModel->sent_time;
				$enddate = date ( SaleConstants::$date_format, time () );
				$minute = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) % 86400 / 60 );
				if ($minute > 5) {
					if ($phoneVerifyCodeModel->verify_code != $model->verifyCode) {
						$json = new JsonObj ( - 1, '手机验证码输入错误,手机验证码5分钟内有效。', null );
						echo (Json::encode ( $json ));
						return;
					}
				}
			}
			// check recommend vip_no is exsits or not
			$parent_vip_db = Vip::find ()->where ( 'vip_no=:parent_vip_no', [ 
					':parent_vip_no' => $model->parent_vip_no 
			] )->one ();
			if (empty ( $parent_vip_db )) {
				$json = new JsonObj ( - 1, '推荐人手机号码' . ($model->parent_vip_no) . '未注册。', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				$vip->parent_id = $parent_vip_db->id;
			}
			
			if (! $vip->save ()) {
				$json = new JsonObj ( - 1, '数据验证失败，注册不成功。', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				$session->set ( SaleConstants::$session_vip, $vip );
				$session->timeout=1*24*60;
				
				$array = ArrayHelper::toArray ( $vip, [
						'app\models\vip\Vip' => [
								'id',
								'vip_no',
								'name',
								'id_card',
								'last_login_date',
								'password',
								'parent_id',
								'email',
								'email_verify_flag',
								'status',
								'register_date',
								'parent_vip_no',
						]
				] );
				$json = new JsonObj ( 1, '注册成功。', $array );
				echo (Json::encode ( $json ));
				return;
			}
		} else {
			$json = new JsonObj ( - 1, '数据验证失败，注册不成功。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	
	/* public function actionCheckRegistered(){
		
	} */
}
