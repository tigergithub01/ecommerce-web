<?php

namespace app\modules\sale\controllers;

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


class VipLoginController extends BaseController
{
	
	/**
	 * login
	 * @return Ambigous <string, string>|\yii\web\Response
	 */
    public function actionIndex()
    {
    	$model = new VipForm(['scenario' => 'login']);
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		//find vip from vip_no
    		$vip_db = Vip::find ()->where ( 'vip_no=:vip_no', [ 
					':vip_no' => $model->vip_no 
			] )->one ();
    		if(empty($vip_db)){
    			$model->addError ( 'vip_no', '您输入的手机号码还没有注册' );
    			return $this->render ( 'index', [
    					'model' => $model
    			] );
    		}else{
    			if($vip_db->status==0){
					$model->addError ( 'vip_no', '账户已停用' );
					return $this->render ( 'index', [
    						'model' => $model
    				] );
				}else if (!($vip_db->password==md5($model->password))){
    				$model->addError ( 'password', '您输入的密码不正确' );
    				return $this->render ( 'index', [
    						'model' => $model
    				] );
    			}else{
    				$vip_db->last_login_date=date ( SaleConstants::$date_format, time () );
    				$vip_db->update();
    				
    				$session = Yii::$app->session;
    				if(!($session->isActive)){
    					$session->open();
    				}
    				$session->set(SaleConstants::$session_vip, $vip_db);
    				$session->timeout=1*24*60;
    				
    				return $this->redirect(['/sale/vip-center/index']);
    			}
    		}
    	} else {
    		return $this->render('index', [
    				'model' => $model,
    		]);
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
    public function actionLogout(){
    	$session = Yii::$app->session;
		$vip = $session->remove(SaleConstants::$session_vip);
    	return $this->redirect(['index']);
    }
    

}
