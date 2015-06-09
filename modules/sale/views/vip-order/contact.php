<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "收货详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/payment.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/common.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile('css/sale/bootstrap.css');
?>


<div class="vip-order-detail-form" style="margin: 10px;">
	<?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'name')->textInput(['maxlength' => 10,'placeholder'=>'请输入姓名'])?>
    
    <?= $form->field($model, 'phone_number')->passwordInput(['maxlength' => 10,'placeholder'=>'请输入手机号码'])?>
    
    
    
	<?= $form->field($model, 'detail_address')->passwordInput(['maxlength' => 200,'placeholder'=>'请输入详细地址'])?>
    
    <div class="form-group">
        <?php /*Html::submitButton('注册', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;'])*/ ?>
        <?php echo Html::button('下一步',['class' => 'btn btn-primary','id'=>'btn_submit_contact','style'=>'width:100%;margin-top:10px;height:60px;'])?>
    </div>

    <?php ActiveForm::end(); ?>
    
	<div class="payment_info_bar">
		<div class="item input_block">
			<span class="label left">收货人</span>
			<span class="content left"><input name="name" class="text" placeholder="请输入姓名" type="text"></span>
		</div>
		<hr class="gray_solid">
		<div class="item input_block">
			<span class="label left">手机号</span>
			<span class="content left">
				<input name="mobile" class="text" maxlength="11" placeholder="请输入手机号码" type="tel">
			</span>
		</div>
		<hr class="gray_solid">
		<div class="item input_block">
			<span class="label">选择省</span>
			<span class="content">
			<a class="btn-select">
				<span class="cur-select"></span>
				<select class="select" id="select1" name="province" data-default=""><option selected="selected" value="北京">北京</option><option value="上海">上海</option><option value="天津">天津</option><option value="重庆">重庆</option><option value="四川">四川</option><option value="贵州">贵州</option><option value="云南">云南</option><option value="西藏">西藏</option><option value="河南">河南</option><option value="湖北">湖北</option><option value="湖南">湖南</option><option value="广东">广东</option><option value="广西">广西</option><option value="陕西">陕西</option><option value="甘肃">甘肃</option><option value="青海">青海</option><option value="宁夏">宁夏</option><option value="新疆">新疆</option><option value="河北">河北</option><option value="山西">山西</option><option value="内蒙古">内蒙古</option><option value="江苏">江苏</option><option value="浙江">浙江</option><option value="安徽">安徽</option><option value="福建">福建</option><option value="江西">江西</option><option value="山东">山东</option><option value="辽宁">辽宁</option><option value="吉林">吉林</option><option value="黑龙江">黑龙江</option><option value="海南">海南</option><option value="台湾">台湾</option><option value="香港">香港</option><option value="澳门">澳门</option></select>
			</a>
			<img class="icon" src="images/sale/icon_go.png">
			</span>
		</div>
		<hr class="gray_solid">
		<div class="item input_block">
			<span class="label">选择市</span>
			<span class="content">
			<a class="btn-select">
				<span class="cur-select"></span>
				<select class="select" id="select2" name="city" data-default=""><option selected="selected" value="市辖区">市辖区</option><option value="县">县</option></select>
			</a>
			<img class="icon" src="images/sale/icon_go.png">
			</span>
		</div>
		<hr class="gray_solid">
		<div class="item input_block">
			<span class="label">选择区</span>
			<span class="content">
			<a class="btn-select">
				<span class="cur-select"></span>
				<select class="select" id="select3" name="area" data-default=""><option selected="selected" value="东城区">东城区</option><option value="西城区">西城区</option><option value="崇文区">崇文区</option><option value="宣武区">宣武区</option><option value="朝阳区">朝阳区</option><option value="丰台区">丰台区</option><option value="石景山区">石景山区</option><option value="海淀区">海淀区</option><option value="门头沟区">门头沟区</option><option value="房山区">房山区</option><option value="通州区">通州区</option><option value="顺义区">顺义区</option><option value="昌平区">昌平区</option><option value="大兴区">大兴区</option><option value="怀柔区">怀柔区</option><option value="平谷区">平谷区</option></select>
			</a>
			<img class="icon" src="images/sale/icon_go.png">
			</span>
		</div>
		<hr class="gray_solid">
		<div class="item input_block">
			<span class="label left">地址</span>
			<span class="content left">
				<input name="address" class="text" placeholder="请输入详细地址" type="text">
			</span>
		</div>
	</div>
	
	<!-- 
	<div class="payment_info_bar">
		<div class="item input_block">
			<span class="label left">留言</span>
			<span class="content left">
				<textarea class="textarea" name="message" placeholder="想说点什么？"></textarea>
			</span>
			<input name="goods" id="goods" value="[{&quot;gsid&quot;:&quot;338238&quot;,&quot;num&quot;:1,&quot;size&quot;:0}]" type="hidden">
			<input name="ubid" id="ubid" value="658" type="hidden">
		</div>
	</div>
	 -->
	<div class="payment_btn_bar">
		<!-- 
		<button class="submit">下一步</button>
		 -->
		<?=Html::a('下一步',['/sale/vip-order/confirm'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])?>
	</div>

</div>

<style type="text/css">
<!--
.control-label {
	display: block;
}
-->
</style>



<script type="text/javascript">
$(function(){
	$("#btn_submit_contact").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/confirm'])?>';	
	});		
});


</script>


