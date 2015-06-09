<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "注册";

$this->registerCssFile('css/sale/bootstrap.css');
?>

<header>
	<div class="button"><a class="back" href="javascript:window.history.back();"><img src="images/sale/btn_back.png">返回</a></div>
	<div class="title">注册</div>
	<div class="button"></div>
</header>
<div class="vip-login-form" style="margin: 10px;">
    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'vip_no')->textInput(['maxlength' => 10,'placeholder'=>'请输入您的手机号码'])?>
    
    <div style="display: block;overflow: hidden;">
     	<div style="float:left;width:300px;">
	    <?= $form->field($model, 'verifyCode')->textInput(['maxlength' => 10,'placeholder'=>'请输入验证码'])?>
	    </div>
	    <div style="float:left;width:200px;margin-left: 10px">
	    <?= Html::button('获取验证码',['class' => 'btn btn-primary','id'=>'btn_get_verfityCode'])?>
	    </div>
    </div>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 16,'placeholder'=>'请设置6~16位密码'])?>
    
    <?= $form->field($model, 'parent_vip_no')->passwordInput(['maxlength' => 10,'placeholder'=>'请输入推荐手机号码'])?>

    
    <div class="form-group">
        <?= Html::submitButton('注册', ['class' => 'btn btn-primary','style'=>'width:100%']) ?>
        <?php /*echo Html::button('下载APP',['class' => 'btn btn-primary','id'=>'btn_download_app','style'=>'width:100%;margin-top:10px;'])*/?>
        <?=Html::a('下载APP',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style type="text/css">
/* ------------------------------------------------ 头部 ------------------------------------ */
@media screen and (max-width: 380px) {
	html{
		font-size: 10px;
	}
}
@media screen and (min-width: 380px) and (max-width:500px) {
	html{
		font-size: 12px;
	}
}
@media screen and (min-width: 500px) and (max-width:650px) {
	html{
		font-size: 13px;
	}
}
@media screen and (min-width: 650px) {
	html{
		font-size: 14px;
	}
}
header{
	background: #337ab7;
	color: white;
	text-align: center;
	margin: 0px;
	padding: 0px;
	display: table;
	width: 100%;
}
header .button, .title{
	display: table-cell;
	height: 50px;
	overflow: hidden;
	margin: 0px;
	padding: 0px;
	vertical-align: middle;
}
header .button{
	width: 27%;
	height: 50px;
}
header .title{
	width: 46%;
	font-size: 1.8rem;
	margin-top: 0px;
	line-height: 50px;
}
header .button .back{
	overflow: hidden;
	display: table-cell;
	text-decoration: none;
	color: white;
	font-size: 1.6rem;
	padding: 2px 0px 0px 0px;
}
header .button .back img{
	border: none;
	width: 26px;
	height: auto;
	padding: 0px 0px 0px 10px;
	vertical-align: middle;
}
/* ------------------------------------------------ 头部 ------------------------------------ */
</style>

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
		console.debug('btn_get_verfityCode clicked');	
		alert('xx');
	});
});


</script>


<script type="text/javascript">
/*
	var button = $('.btn_s');
	var click = 60;
	button.click(function(){
		//jSuccess(123, {TimeShown : 400});
		//jError(123); 
		var mobile = $('.mobile').val();
		if(click<60){
			jError("还没到60秒！");
			return ;
		}
		//提交数据
		$.ajax({
			type:'get',//可选get
			url:"/wap.php/user/logsms.html",//这里是接收数据的PHP程序
			data:'mobile='+mobile,//传给PHP的数据，多个参数用&连接
			dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			success:function(r){
				if(r.status == '10000'){
					jSuccess(r.info, {TimeShown : 400});
					var set= setInterval(function(){
						button.text(click+'秒重新获取');
						button.addClass('verify-code-disabled');
						if(click==0){
							button.text('获取验证码');
							button.removeClass('verify-code-disabled');
							clearInterval(set);
							click=60;
							return;
						}
						click = click-1;
					}, 1000);
				}else{
					jError(r.info); 
				}
				//这里是ajax提交成功后，PHP程序返回的数据处理函数。info是返回的数据，数据类型在dataType参数里定义！
			},
			error:function(){
				jError("提交失败！"); 
			}
		})
	});*/
</script>