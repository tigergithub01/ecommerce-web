<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "登录";
?>

<div data-role="container" class="body userLogin">
	<header data-role="header"> </header>
	<section data-role="body" class="section-body">
		
		 <form action="<?= Url::toRoute('vip-login/index')?>" class="form-wrap ajax-form" method="post">
			<fieldset>
				<div class="field">
					<input name="VipLoginForm[username]" class="mobile" 
						placeholder="请输入手机号" data-role="mobile" type="tel">
				</div>
				<div class="field">
					<input name="VipLoginForm[password]" class="mobile" 
						placeholder="请输入密码" data-role="mobile" type="tel">
				</div>
				
				<div class="btn-wrap">
					<input name="submit" class="btn btn-orange" id="submit" value="登录"
						type="submit"> <input name="url"
						value="L3dhcC5waHAvd2ViL2dvb2RzL2dpZC8xMjg5MS5odG1s" type="hidden">
				</div>
			</fieldset>
		</form>
	</section>
</div>


<script type="text/javascript">
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
	});
</script>
