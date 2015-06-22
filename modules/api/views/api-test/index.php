<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);

//$this->registerCssFile('css/sale/bootstrap.css');
//$this->registerCssFile('css/sale/buserInfo.css');
//$this->registerCssFile('css/sale/jNotify.css');


//$this->registerJsFile('js/sale/public.js');
//$this->registerJsFile('js/sale/jNotify.js');
//$this->registerJsFile('js/sale/spin.js');
//$this->registerJsFile('js/sale/common.js');
//$this->registerJsFile("js/jquery/jquery-1.8.2.min.js",['position' => \yii\web\View::POS_HEAD]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="js/jquery/jquery-1.8.2.min.js"></script>
    <?php $this->head()?>
    
    <script type="text/javascript">

	function testRegister(){
		$.post('<?php echo Url::toRoute(['/api/vip-register/ajax-index'])?>', 
                {
					'VipForm[vip_no]':'13724346629',
					'VipForm[password]':'123456',
					'VipForm[parent_vip_no]':'13724346624',
					'VipForm[verifyCode]':'2344',
            }, function(data) {
                console.debug(data);
        });
	}	

	function testLogin(){
		$.post('<?php echo Url::toRoute(['/api/vip-login/ajax-index'])?>', 
                {
					'VipForm[vip_no]':'13724346621',
					'VipForm[password]':'123456',
            }, function(data) {
                console.debug(data);
        });
	}

	function testLoginOut(){
		$.post('<?php echo Url::toRoute(['/api/vip-login/ajax-logout'])?>', 
                {
					
            }, function(data) {
                console.debug(data);
        });
	}

	function testPhoneVerifyCodeCreate(){
		$.post('<?php echo Url::toRoute(['/api/sms/create'])?>', 
                {
					'PhoneVerifyCode[phone_number]':'13724346621',
					'PhoneVerifyCode[verify_code]':'111111',
					'PhoneVerifyCode[sms_content]':'test',
            }, function(data) {
                console.debug(data);
        });
	}

	function testUpdatePwd(){
		$.post('<?php echo Url::toRoute(['/api/vip-login/update-pwd'])?>', 
                {
					'VipForm[vip_no]':'13724346621',
					'VipForm[password]':'123456',
					'VipForm[verifyCode]':'111111',
            }, function(data) {
                console.debug(data);
        });
	}


	function testUpdateVipBankCard(){
		$.post('<?php echo Url::toRoute(['/api/vip-bank/update'])?>', 
                {
					'id':'7',
					'VipBankcard[vip_id]':'24',
					'VipBankcard[card_no]':'123456',
					'VipBankcard[bank_id]':'2',
					'VipBankcard[branch_name]':'4444',
					'VipBankcard[open_addr]':'666666',
            }, function(data) {
                console.debug(data);
        });
	}

	function testCreateVipWithdrawFlow(){
		$.post('<?php echo Url::toRoute(['/api/vip-withdraw-flow/create'])?>', 
                {
					'VipWithdrawFlow[amount]':'51',
            }, function(data) {
                console.debug(data);
        });
	}


    </script>
</head>
<body>
<?php $this->beginBody() ?>
	<input type="button" value="注册" onclick="testRegister()">
	<input type="button" value="登录" onclick="testLogin()">
	<input type="button" value="退出登录" onclick="testLoginOut()">
	<input type="button" value="修改密码" onclick="testUpdatePwd()">
	<input type="button" value="插入验证码" onclick="testPhoneVerifyCodeCreate()">
	<input type="button" value="修改银行卡信息" onclick="testUpdateVipBankCard()">
	<input type="button" value="提现申请" onclick="testCreateVipWithdrawFlow()">

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
