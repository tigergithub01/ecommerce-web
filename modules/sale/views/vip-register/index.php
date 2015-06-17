<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "注册";

$this->registerCssFile('css/sale/bootstrap.css');
$this->registerCssFile('css/sale/headerBar.css');
?>

<header>
	<div class="button"><a class="back" href="javascript:window.history.back();"><img src="images/sale/btn_back.png">返回</a></div>
	<div class="title">注册</div>
	<div class="button"></div>
</header>
<div class="vip-login-form" style="margin: 5px;">
    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'vip_no')->textInput(['maxlength' => 11,'placeholder'=>'请输入您的手机号码'])?>
    
    <div style="display: block;overflow: hidden;">
     	<div style="float:left;width:150px;">
	    <?= $form->field($model, 'verifyCode')->textInput(['maxlength' => 10,'placeholder'=>'请输入验证码'])?>
	    </div>
	    <div style="float:left;width:200px;margin-left: 5px">
	    <?= Html::button('获取验证码',['class' => 'btn btn-primary','id'=>'btn_get_verfityCode'])?>
	    </div>
    </div>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 16,'placeholder'=>'请设置6~16位密码'])?>
    
    <?= $form->field($model, 'parent_vip_no')->textInput(['maxlength' => 11,'placeholder'=>'请输入推荐手机号码'])?>

    
    <div class="form-group">
        <?= Html::submitButton('注册', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;']) ?>
        <?php echo Html::button('下载APP',['class' => 'btn btn-primary','id'=>'btn_download_app','style'=>'width:100%;margin-top:10px;height:60px;'])?>
        <?php /*Html::a('下载APP',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])*/?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<style type="text/css">
<!--
.control-label {
	display: none;
}
-->
</style>


<script type="text/javascript">
$(function(){
	$("#btn_get_verfityCode").click(function(){
		$.post('<?php echo Url::toRoute(['/api/sms/sms'])?>', 
                {mobile:jQuery.trim($('#vipform-vip_no').val()),
            send_code:<?php echo $_SESSION['send_code'];?>,
            '_csrf':'<?= @Yii::$app->request->csrfToken ?>'	
            }, function(msg) {
// 			console.debug(msg);
			if(msg=='提交成功'){
				RemainTime();
				alert('短信验证码已经发送');
			}else{
				alert(jQuery.trim(unescape(msg)));
			}
        });
	});

	$("#btn_download_app").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/download-app/index'])?>';	
	});
});

var iTime = 59;
var Account;
function RemainTime(){
	$("#btn_get_verfityCode").attr('disabled',true);
// 	document.getElementById('btn_get_verfityCode').disabled = true;
	var iSecond,sSecond="",sTime="";
	if (iTime >= 0){
		iSecond = parseInt(iTime%60);
		iMinute = parseInt(iTime/60)
		if (iSecond >= 0){
			if(iMinute>0){
				sSecond = iMinute + "分" + iSecond + "秒";
			}else{
				sSecond = iSecond + "秒";
			}
		}
		sTime=sSecond;
		if(iTime==0){
			clearTimeout(Account);
			sTime='获取手机验证码';
			iTime = 59;
// 			document.getElementById('btn_get_verfityCode').disabled = false;
			$("#btn_get_verfityCode").attr('disabled',false);
		}else{
			Account = setTimeout("RemainTime()",1000);
			iTime=iTime-1;
		}
	}else{
		sTime='没有倒计时';
	}
	$("#btn_get_verfityCode").text(sTime);
// 	document.getElementById('btn_get_verfityCode').value = sTime;
}	


</script>


