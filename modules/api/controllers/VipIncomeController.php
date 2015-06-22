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
use app\models\finance\VipWithdrawFlow;
use app\modules\api\service\VipIncomeService;

class VipIncomeController extends BaseApiController {
	public $enableCsrfValidation = false;
	public function actionIndex() {
	}
	public function actionView() {
		$vip_id = isset ( $_REQUEST ['vip_id'] ) ? $_REQUEST ['vip_id'] : null;
		$vipIncomeService = new VipIncomeService ();
		$model = $vipIncomeService->getVipIncome ( $vip_id );
		if ($model === null) {
			echo (Json::encode ( new JsonObj ( - 1, '数据不存在。', null ) ));
			return;
		}
		
		$json = new JsonObj ( 1, null, $model );
		echo (Json::encode ( $json ));
	}
}
