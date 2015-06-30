<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "收货详情";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/payment.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/common.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/bootstrap.css' );
$this->registerCssFile ( 'css/sale/order.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/goods.css', [
		'position' => \yii\web\View::POS_HEAD
] );

?>


<div class="vip-order-contact-form" style="margin: 10px;">
	

	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-vertical'],]); ?>
	<section>
	<div>
		<input type="radio" name="contact_type">使用新收货地址 <input type="radio"
			name="contact_type">使用已有收货地址
	</div>
	<div class="so_sheet_contact_person">
	    <?= $form->field($contactPersonForm, 'name')->textInput(['maxlength' => 10,'placeholder'=>'请输入姓名'])?>
	    
	    <?= $form->field($contactPersonForm, 'phone_number')->textInput(['maxlength' => 11,'placeholder'=>'请输入手机号码'])?>
	    
	    <?=$form->field ( $contactPersonForm, 'province_id' )->dropDownList ( $provinces, [ 'prompt' => '--请选择收货省份--','style' => 'width:100%' ] )?>
	                                              
	    <?=$form->field ( $contactPersonForm, 'city_id' )->dropDownList ( $cities, [ 'prompt' => '--请选择收货城市--','style' => 'width:100%' ] )?>   
	                                              
	    <?=$form->field ( $contactPersonForm, 'district_id' )->dropDownList ( $districts, [ 'prompt' => '--请选择所属片区--','style' => 'width:100%' ] )?>                                                                                   
	    
		<?=$form->field($contactPersonForm, 'detail_address')->textInput(['maxlength' => 200,'placeholder'=>'请输入详细地址'])?>
	</div>
	<div>
		<input type="checkbox" name="contact_type" checked="checked">添加到收货地址 <input
			type="checkbox" name="contact_type" checked="checked">设为默认收货地址
	</div>
</section>
	<div style="height: 10px;background-color:silver;">
		
	</div>
	

	<section>
	<div>
		订单总金额：<span style="color: red;font-size: 1.6rem;">￥2556.00</span>
	</div>
	<div class="so_sheet_detail" style="margin-top: 20px;">
		<?php foreach ($detailList as $i=>$soDetail) {?>
			<input type="hidden" name="detailList[<?=$i?>][product_id]"
			value="<?php echo $soDetail['product_id']?>"> <input type="hidden"
			name="detailList[<?=$i?>][quantity]"
			value="<?php echo $soDetail['quantity']?>"> <input type="hidden"
			name="detailList[<?=$i?>][price]"
			value="<?php echo $soDetail['price']?>"> <input type="hidden"
			name="detailList[<?=$i?>][amount]"
			value="<?php echo $soDetail['amount']?>">
		<div class="order_item_bar">
			<div class="info_block">
				<div class="img" style="width: 80px;">
					<a
						href="<?=Url::toRoute(['/sale/product/view','id'=>$soDetail['product_id']])?>">
					<?php if(isset($soDetail['primaryPhoto_id'])){?>
						<img style="height: 70px; width: 70px;"
						src="<?php echo Url::toRoute(['/sale/product-photo/view','id'=>$soDetail['primaryPhoto_id']])?>">
					<?php }else{?>
						<img style="height: 70px; width: 70px;" src="">
					<?php }?>
				</a>
				</div>
				<div class="info_title">
					<div class="name"><?php echo $soDetail['product_name'] ?></div>
					<div class="standard">
						数量：<span><?php echo $soDetail['quantity']?></span>
					</div>
					<div class="price1">￥<?php echo round($soDetail['price'],2)?></div>
				</div>
				<!---------------
				<div class="info_price">
					<div class="price">￥213.00</div>
					<div class="num">×1</div>
				</div>
                ----------------->
			</div>
		</div>
		
		<?php }?>
	</div>
</section>



	
	<div class="form-group">
        <?php echo Html::submitButton('提交订单', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;'])?>
        <?php /*echo Html::button('下一步',['class' => 'btn btn-primary','id'=>'btn_submit_contact','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
    </div>
    
	<!-- 
	<div class="goods_btn_bar" style="float: right;">
		<div style="float: left;text-align: right;">订单金额￥<span>255</span></div>
		
		<input type="submit" class="buy_button1 buy" style="float: right;" value="提交订单">
			
	</div>
	 -->

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
	$("#btn_submit_contact").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/confirm'])?>';	
	});		


	$('#socontactpersonform-province_id').change(function(){
// 		console.debug('socontactpersonform-province_id changed.');
		$("#socontactpersonform-city_id option[value!='']").remove();	
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-order/find-cities'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
			    province_id:$('#socontactpersonform-province_id').val(),
		    	//'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
			    	
				    $.each(data.value,function(i,v){
				    	$('#socontactpersonform-city_id').append("<option value='"+v.id+"'>"+v.name+"</option>");	
				    });
			    }
		    }  
		}); 
	});


	$('#socontactpersonform-city_id').change(function(){
		$("#socontactpersonform-district_id option[value!='']").remove();		
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-order/find-districts'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	city_id:$('#socontactpersonform-city_id').val(),
		    	},     
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
				    $.each(data.value,function(i,v){
				    	$('#socontactpersonform-district_id').append("<option value='"+v.id+"'>"+v.name+"</option>");	
				    });
			    }
		    	
		    }  
		}); 
	});
	 
});


</script>


