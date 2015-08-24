<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单支付";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/payment.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerJsFile('js/sale/jquery.blockUI.js', [
		'position' => \yii\web\View::POS_END
]);
$this->registerCssFile ( 'js/sale/jNotify/core/jNotify.jquery.css', [
		'position' => \yii\web\View::POS_END
] );
$this->registerJsFile ( "js/sale/jNotify/core/jNotify.jquery.min.js", [
		'position' => \yii\web\View::POS_END
] );

?>


<div class="vip-center-form wrapper" style="margin: 10px;">
	<div class="payment_info_bar">
		<div class="item">
			<span class="tag">收货人</span><span class="content"><?php echo $model['soContactPerson']['name']?> <?php echo $model['soContactPerson']['phone_number']?></span>
		</div>
		<hr class="gray_solid">
		<div class="item">
			<span class="tag">收货地址</span><span class="content"><?php echo $model['soContactPerson']['province']['name'].$model['soContactPerson']['city']['name'].$model['soContactPerson']['district']['name'].$model['soContactPerson']['detail_address']?></span>
		</div>
	</div>
	<form action="<?php echo Url::toRoute('/sale/alipay-direct/alipayapi')?>" method="post" class="ajaxForm" id="order_pay_form" target="_blank">
		<input type="hidden" name="_csrf" value="<?= @Yii::$app->request->csrfToken ?>"/>
		<div class="payment_info_bar">
			<div class="item">
				<span class="tag">订单号</span><span class="content"><?php echo $model['code']?></span>
			</div>
			<hr class="gray_solid">
			<div class="item">
				<span class="tag">交易金额</span><span class="content price">￥<?php echo round($model['order_amt'],2) /*floor($model['order_amt']*100)/100*/ ?></span>
			</div>
		</div>
		<div class="payment_info_bar">
			<div class="item">
				<span class="img"><img src="images/sale/icon_alipay.png"></span> <a
					class="checkbox right <?php if ($model['pay_type_id']==1) echo 'checkbox_checked' ?>" href="javascript:void(0)" id="btn_alipay"></a>
			</div>
			<hr class="gray_solid">
			<div class="item">
				<span class="img"><img src="images/sale/icon_weixin.jpg"></span> <a
					class="checkbox right <?php if ($model['pay_type_id']==2) echo 'checkbox_checked' ?>" href="javascript:void(0)" id="btn_weixin"></a>
			</div>
		</div>
		<div class="payment_btn_bar">
			<!-- 
			<input type="submit" class="submit" value="确认支付"/>
			 -->
			<input id="btn_submit_pay" type="button" class="submit" value="确认支付"/>
			<input id="pay_type_id" type="hidden" value="<?php echo $model['pay_type_id']?>"> 
			
			<!--  
			<input name="PayInfo[pay_type_id]" id="pay_type_id" type="hidden" value="<?php echo $model['pay_type_id']?>"> 
			<input name="PayInfo[WIDout_trade_no]"  value="<?php echo $model['code']?>" type="hidden"/>
			<input name="PayInfo[WIDsubject]" value="<?php echo $product['name']?>" type="hidden"/>
			<input name="PayInfo[WIDtotal_fee]"  value="<?php echo $model['order_amt']?>" type="hidden"/>
			<input name="PayInfo[WIDbody]"  value="" type="hidden"/>
			<input name="PayInfo[WIDshow_url]" value="<?php echo  Yii::$app->request->hostInfo.URL::toRoute(['/sale/product/view','id'=>$product['id']])?>" type="hidden"/>
			-->
			
			<!-- 
			<input name="PayInfo_pay_type_id" id="pay_type_id" type="hidden" value="<?php echo $model['pay_type_id']?>"> 
			<input name="PayInfo_WIDout_trade_no"  id="WIDout_trade_no" value="<?php echo $model['code']?>" type="hidden"/>
			<input name="PayInfo_WIDsubject" id="WIDsubject" value="<?php echo $product['name']?>" type="hidden"/>
			<input name="PayInfo_WIDtotal_fee" id="WIDtotal_fee"  value="<?php echo $model['order_amt']?>" type="hidden"/>
			<input name="PayInfo_WIDbody" id="WIDbody" value="" type="hidden"/>
			<input name="PayInfo_product_id" id="product_id" value="<?php echo $product['id']?>" type="hidden"/>
			<input name="PayInfo_WIDshow_url" id="WIDshow_url" value="<?php echo  Yii::$app->request->hostInfo.URL::toRoute(['/sale/product/view','id'=>$product['id']])?>" type="hidden"/>
			-->
			
		</div>
	</form>

</div>

<style type="text/css">
</style>



<script type="text/javascript">
$(function(){
	$('a.checkbox').click(function(){
		$('a.checkbox').removeClass('checkbox_checked');
		$(this).addClass('checkbox_checked');
		if($(this).attr('id')=='btn_alipay'){
			$('#pay_type_id').val(1);
		}else if($(this).attr('id')=='btn_weixin'){
			$('#pay_type_id').val(2);
		}
		
	});

	$('#btn_submit_pay').click(function(){
		if($('a.checkbox_checked').length==0){
			jNotify('请选择支付方式.');
			//alert('请选择支付方式.');	
			return false;
		}else{
			if($('#pay_type_id').val()==1){
				//alipay direct
				var url = '<?php echo Url::toRoute(['/sale/alipay-direct/alipayapi','order_id'=>$model['id']])?>'+'&pay_type_id='+$('#pay_type_id').val();

				//alipay wap direct
				//var url = '<?php echo Url::toRoute(['/sale/alipay-wap-direct/alipayapi','order_id'=>$model['id']])?>'+'&pay_type_id='+$('#pay_type_id').val();
				
				window.location.href=url;
			}else if($('#pay_type_id').val()==2){
				//wxpay
				var app_browse_type = $("#app_browse_type").val();
				if(app_browse_type==1){
					//android of app
					if(androidJs!=null){
						androidJs.wxPay('<?=$model['id']?>');
					}
				}else if(app_browse_type==2){
					//ios of app
					
				}else{
					var url = '<?php echo Url::toRoute(['/sale/wxpay/jsapi','order_id'=>$model['id']])?>'+'&pay_type_id='+$('#pay_type_id').val();
					window.location.href=url;
				}				
			}
		}
		//$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /> 请稍等...</span>' });
	});

	/*
	$('#order_pay_form').submit(function(){
		if($('a.checkbox_checked').length==0){
			jNotify('请选择支付方式.');
			//alert('请选择支付方式.');	
			return false;
		}else{
			if($('#pay_type_id').val()==1){
				var url = '&pay_type_id='+$('#pay_type_id').val();
				//alipay direct
				$("#order_pay_form").attr('action','<?php echo Url::toRoute(['/sale/alipay-direct/alipayapi','order_id'=>$model['id']])?>'+url);
				
				//alipay wap direct
				//$("#order_pay_form").attr('action','<?php echo Url::toRoute(['/sale/alipay-wap-direct/alipayapi','order_id'=>$model['id']])?>'+url);
			}else if($('#pay_type_id').val()==2){
				//wxpay
				var app_browse_type = $("#app_browse_type").val();
				if(app_browse_type==1){
					//android of app
					if(androidJs!=null){
						androidJs.wxPay('<?=$model['id']?>');
					}
				}else if(app_browse_type==2){
					//ios of app
					
				}else{
					var url = '&pay_type_id='+$('#pay_type_id').val();
					$("#order_pay_form").attr('action','<?php echo Url::toRoute(['/sale/wxpay/jsapi','order_id'=>$model['id']])?>'+url);
				}				
			}
		}
		//$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /> 请稍等...</span>' });
	});
	*/
	
});


</script>


