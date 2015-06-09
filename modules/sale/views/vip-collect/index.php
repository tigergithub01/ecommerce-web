<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "我的收藏";

$this->registerCssFile ( 'css/sale/common.css' );
$this->registerCssFile ( 'css/sale/favorite.css' );
?>


<div class="vip-login-form" style="margin: 5px;">
	<section data-role="body" class="section-body" id="0"
		style="display: block;">
		<div class="nav-content">
			<ul id="goods-list">
				<li>
					<div class="img-wrap">
						<a
							href="<?=Url::toRoute(['/sale/product/view'])?>"><img
							src="%E6%88%91%E7%9A%84%E6%94%B6%E8%97%8F%E5%95%86%E5%93%81_files/s_55239527bef52.jpg"></a>
					</div>
					<p class="title">中大鳄鱼男士鞋春夏季新品潮流鞋子白运动休闲板鞋男韩版防滑透气</p>
					<p class="price">
						<span class="num-price"><i>¥</i>213.00</span>
					</p>
				</li>
				<li>
					<div class="img-wrap">
						<a
							href="<?=Url::toRoute(['/sale/product/view'])?>"><img
							src="%E6%88%91%E7%9A%84%E6%94%B6%E8%97%8F%E5%95%86%E5%93%81_files/s_55239527bef52.jpg"></a>
					</div>
					<p class="title">中大鳄鱼男士鞋春夏季新品潮流鞋子白运动休闲板鞋男韩版防滑透气</p>
					<p class="price">
						<span class="num-price"><i>¥</i>213.00</span>
					</p>
				</li>
			</ul>
			<ul id="goods-list">
				<li>
					<div class="img-wrap">
						<a
							href="<?=Url::toRoute(['/sale/product/view'])?>"><img
							src="%E6%88%91%E7%9A%84%E6%94%B6%E8%97%8F%E5%95%86%E5%93%81_files/s_55239527bef52.jpg"></a>
					</div>
					<p class="title">中大鳄鱼男士鞋春夏季新品潮流鞋子白运动休闲板鞋男韩版防滑透气</p>
					<p class="price">
						<span class="num-price"><i>¥</i>213.00</span>
					</p>
				</li>
				<li>
					<div class="img-wrap">
						<a
							href="<?=Url::toRoute(['/sale/product/view'])?>"><img
							src="%E6%88%91%E7%9A%84%E6%94%B6%E8%97%8F%E5%95%86%E5%93%81_files/s_55239527bef52.jpg"></a>
					</div>
					<p class="title">中大鳄鱼男士鞋春夏季新品潮流鞋子白运动休闲板鞋男韩版防滑透气</p>
					<p class="price">
						<span class="num-price"><i>¥</i>213.00</span>
					</p>
				</li>
			</ul>
		</div>
	</section>

</div>






<script type="text/javascript">
$(function(){
	$("#btn_get_verfityCode").click(function(){
		console.debug('btn_get_verfityCode clicked');	
		alert('xx');
	});

	$("#btn_download_app").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/download-app/index'])?>';	
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
