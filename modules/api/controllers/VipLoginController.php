<?php

namespace app\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;
use yii\web\Session;
use app\modules\sale\models\SaleConstants;
use app\components\controller\BaseController;
use app\models\common\JsonObj;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\system\PhoneVerifyCode;

class VipLoginController extends BaseController {
	public $enableCsrfValidation = false;
	public function actionAjaxIndex() {
		$model = new VipForm ( [ 
				'scenario' => 'login' 
		] );
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			// find vip from vip_no
			$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
			if (empty ( $vip_db )) {
				$json = new JsonObj ( - 1, '您输入的手机号码还没有注册', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				if ($vip_db->status == 0) {
					$model->addError ( 'password', '账户已停用' );
					$json = new JsonObj ( - 1, '账户已停用', null );
					echo (Json::encode ( $json ));
					return;
				} else if (! ($vip_db->password == md5 ( $model->password ))) {
					$model->addError ( 'password', '您输入的密码不正确' );
					$json = new JsonObj ( - 1, '您输入的密码不正确', null );
					echo (Json::encode ( $json ));
					return;
				} else {
					$vip_db->last_login_date = date ( SaleConstants::$date_format, time () );
					$vip_db->update ();
					
					// get $parent_vip_no from db
					$parent_vip = Vip::findOne ( $vip_db->parent_id );
					if (empty ( $parent_vip )) {
						$vip_db ['parent_vip_no'] = null;
					} else {
						$vip_db ['parent_vip_no'] = $parent_vip->id;
					}
					
					$session = Yii::$app->session;
					if (! ($session->isActive)) {
						$session->open ();
					}
					$session->set ( SaleConstants::$session_vip, $vip_db );
					$session->timeout = 1 * 24 * 60;
					
					// output json result
					$array = ArrayHelper::toArray ( $vip_db, [ 
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
									'parent_vip_no' 
							] 
					] );
					
					$json = new JsonObj ( 1, '登录成功。', $array );
					echo (Json::encode ( $json ));
					return;
				}
			}
		} else {
			$json = new JsonObj ( - 1, '数据验证失败，登录不成功。', null );
			echo (Json::encode ( $json ));
			return;
		}
		
		/* if ($model->load(Yii::$app->request->post()) && $model->save()) {
		 return $this->redirect(['view', 'id' => $model->id]);
		 } else {
		 return $this->render('create', [
		 'model' => $model,
		 ]);
		 } */
	}
	
	/**
	 * logout
	 *
	 * @return \yii\web\Response
	 */
	public function actionAjaxLogout() {
		$session = Yii::$app->session;
		$vip = $session->remove ( SaleConstants::$session_vip );
		$json = new JsonObj ( 1, '退出登录成功。', null );
		echo (Json::encode ( $json ));
		return;
	}
	
	public function actionUpdatePwd() {
		$model = new VipForm ( [ 
				'scenario' => 'update_pwd' 
		] );
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			// find vip from vip_no
			$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
			if (empty ( $vip_db )) {
				$json = new JsonObj ( - 1, '您输入的手机号码还没有注册', null );
				echo (Json::encode ( $json ));
				return;
			} else {
				if ($vip_db->status == 0) {
					$model->addError ( 'password', '账户已停用' );
					$json = new JsonObj ( - 1, '账户已停用', null );
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
				
				//update password
				$vip_db->password = md5 ( $model->password );
				//TODO:should check update method executed successfully or not.
				$vip_db->update ();
				
				$json = new JsonObj ( 1, '密码修改成功。', null );
				echo (Json::encode ( $json ));
				return;
			}
		} else {
			$json = new JsonObj ( - 1, '数据验证失败，密码修改不成功。', null );
			echo (Json::encode ( $json ));
			return;
		}
	}
	
	
}
