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


class VipLoginController extends BaseController
{
	
	public $enableCsrfValidation = false;
	
    public function actionAjaxIndex()
    {
    	$model = new VipForm(['scenario' => 'login']);
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		//find vip from vip_no
    		$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
    		if(empty($vip_db)){
    			$json = new JsonObj ( - 1, '您输入的手机号码还没有注册', null );
    			echo (Json::encode ( $json ));
    			return;
    		}else{
    			if(!($vip_db->password==md5($model->password))){
    				$model->addError ( 'password', '您输入的密码不正确' );
    				$json = new JsonObj ( - 1, '您输入的密码不正确', null );
    				echo (Json::encode ( $json ));
    				return;
    			}else{
    				$vip_db->last_login_date=date ( SaleConstants::$date_format, time () );
    				$vip_db->update();
    				
    				$session = Yii::$app->session;
    				if(!($session->isActive)){
    					$session->open();
    				}
    				$session->set(SaleConstants::$session_vip, $vip_db);
    				$session->timeout=1*24*60;
    				
    				$json = new JsonObj ( 1, '登录成功。', $vip_db );
    				echo (Json::encode ( $json ));
    				return;
    			}
    		}
    	} else {
    		$json = new JsonObj ( - 1, '数据验证失败，注登录成功。', null );
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
     * @return \yii\web\Response
     */
    public function actionAjaxLogout(){
    	$session = Yii::$app->session;
		$vip = $session->remove(SaleConstants::$session_vip);
		$json = new JsonObj ( 1, '退出登录成功。', null );
		echo (Json::encode ( $json ));
		return;
    }
    

}
