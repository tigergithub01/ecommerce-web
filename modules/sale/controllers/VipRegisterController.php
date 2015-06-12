<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\vip\Vip;

class VipRegisterController extends \yii\web\Controller {
	/**
	 * register
	 * @return Ambigous <string, string>|\yii\web\Response
	 */
	public function actionIndex() {
		// app\modules\sale\models
		$model = new VipForm ( [ 
				'scenario' => 'register' 
		] );
		if ($model->load ( Yii::$app->request->post () )) {
			$vip = new Vip ();
			$vip->vip_no = $model->vip_no;
			$vip->password = md5 ( $model->password );
			$vip->status = 1;
			
			// TODO:for date field
// 			$time = time ();
			$vip->register_date = date (SaleConstants::$date_format, time () );
			
			// check vip_no is been registed or not
			$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
			if (! empty ( $vip_db )) {
				$model->addError ( 'vip_no', '手机号码' . ($model->vip_no) . '已经被占用' );
				return $this->render ( 'index', [ 
						'model' => $model 
				] );
			}
			
			// check recommend vip_no is exsits or not
			$parent_vip_db = Vip::find ()->where ( 'vip_no=:parent_vip_no', [ 
					':parent_vip_no' => $model->parent_vip_no 
			] )->one ();
			if (empty ( $parent_vip_db )) {
				$model->addError ( 'parent_vip_no', '推荐人手机号码' . ($model->parent_vip_no) . '不存在' );
				return $this->render ( 'index', [ 
						'model' => $model 
				] );
			} else {
				$vip->parent_id = $parent_vip_db->id;
			}
			
			if (! $vip->save ()) {
				return $this->render ( 'index', [ 
						'model' => $model 
				] );
			} else {
				$session = Yii::$app->session;
				if(!$session->isActive){
					$session->open();
				}
				$session->set(SaleConstants::$session_vip, $vip_db);
				return $this->redirect ( [ 
						'/sale/vip-center/index' 
				] );
			}
		} else {
			return $this->render ( 'index', [ 
					'model' => $model 
			] );
		}
	}
}
