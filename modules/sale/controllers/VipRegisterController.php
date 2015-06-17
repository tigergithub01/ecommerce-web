<?php

namespace app\modules\sale\controllers;

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

class VipRegisterController extends BaseController {
	/**
	 * register
	 *
	 * @return Ambigous <string, string>|\yii\web\Response
	 */
	public function actionIndex() {
		$parent_vip_no = isset ( $_REQUEST ['parent_vip_no'] ) ? $_REQUEST ['parent_vip_no'] : null;
		
		// start session
		$session = Yii::$app->session;
		// if (! $session->isActive) {
		$session->open ();
		// }
		$_SESSION ['send_code'] = $this->random ( 6, 1 );
		
		// start register
		$model = new VipForm ( [ 
				'scenario' => 'register' 
		] );
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
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
				$model->addError ( 'vip_no', '手机号码' . ($model->vip_no) . '已经被占用' );
				return $this->render ( 'index', [ 
						'model' => $model,
						'parent_vip_no' => $parent_vip_no 
				] );
			}
			
			// validate verifyCode from session
			if (empty ( $_SESSION ['mobile'] ) or empty ( $_SESSION ['mobile_code'] ) or $model->vip_no != $_SESSION ['mobile'] or $model->verifyCode != $_SESSION ['mobile_code']) {
				$model->addError ( 'verifyCode', '手机验证码输入错误。' );
				return $this->render ( 'index', [ 
						'model' => $model,
						'parent_vip_no' => $parent_vip_no 
				] );
			}
			
			// validate verifyCode from database
			$phoneVerifyCodeModel = PhoneVerifyCode::find ()->where ( 'phone_number=:phone_number', [ 
					':phone_number' => $model->vip_no 
			] )->orderBy ( [ 
					'sent_time' => SORT_DESC 
			] )->offset ( 0 )->limit ( 1 )->one ();
			if (empty ( $phoneVerifyCodeModel )) {
				$model->addError ( 'verifyCode', '手机验证码输入错误。' );
				return $this->render ( 'index', [ 
						'model' => $model,
						'parent_vip_no' => $parent_vip_no 
				] );
			} else {
				// verifyCode is correct or not
				if ($phoneVerifyCodeModel->verify_code != $model->verifyCode) {
					$model->addError ( 'verifyCode', '手机验证码输入错误。' );
					return $this->render ( 'index', [ 
							'model' => $model,
							'parent_vip_no' => $parent_vip_no 
					] );
				}
				
				// verifyCode expired or not
				$startdate = $phoneVerifyCodeModel->sent_time;
				$enddate = date ( SaleConstants::$date_format, time () );
				$minute = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) % 86400 / 60 );
				if ($minute > 5) {
					$model->addError ( 'verifyCode', '手机验证码输入错误,手机验证码5分钟内有效。' );
					return $this->render ( 'index', [ 
							'model' => $model,
							'parent_vip_no' => $parent_vip_no 
					] );
				}
			}
			
			// check recommend vip_no is exsits or not
			$parent_vip_db = Vip::find ()->where ( 'vip_no=:parent_vip_no', [ 
					':parent_vip_no' => $model->parent_vip_no 
			] )->one ();
			if (empty ( $parent_vip_db )) {
				$model->addError ( 'parent_vip_no', '推荐人手机号码' . ($model->parent_vip_no) . '不存在' );
				return $this->render ( 'index', [ 
						'model' => $model,
						'parent_vip_no' => $parent_vip_no 
				] );
			} else {
				$vip->parent_id = $parent_vip_db->id;
			}
			
			if (! $vip->save ()) {
				return $this->render ( 'index', [ 
						'model' => $model,
						'parent_vip_no' => $parent_vip_no 
				] );
			} else {
				$session->set ( SaleConstants::$session_vip, $vip );
				return $this->redirect ( [ 
						'/sale/vip-center/index' 
				] );
			}
		} else {
			return $this->render ( 'index', [ 
					'model' => $model,
					'parent_vip_no' => $parent_vip_no 
			] );
		}
	}
	private function random($length = 6, $numeric = 0) {
		PHP_VERSION < '4.2.0' && mt_srand ( ( double ) microtime () * 1000000 );
		if ($numeric) {
			$hash = sprintf ( '%0' . $length . 'd', mt_rand ( 0, pow ( 10, $length ) - 1 ) );
		} else {
			$hash = '';
			$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
			$max = strlen ( $chars ) - 1;
			for($i = 0; $i < $length; $i ++) {
				$hash .= $chars [mt_rand ( 0, $max )];
			}
		}
		return $hash;
	}
}
