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
use app\models\finance\VipIncome;
use app\models\finance\VipIncomeDetail;

class VipIncomeDetailController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$dataList = VipIncomeDetail::find ()->where('vip_id=:vip_id',[':vip_id'=>$vip_id])->all();
		echo (Json::encode ( new JsonObj ( 1, null, $dataList ) ));
		return;
	}
	public function actionView() {
		$id = isset ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : null;
		$model = VipIncome::findOne ( $id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
