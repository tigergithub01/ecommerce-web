<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\vip\VipAddress */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile ( 'css/sale/bootstrap.css' );
?>


<div class="vip-address-form" style="padding: 2px;">
	<a href="<?= Url::toRoute(['/sale/vip-center/index'])?>">个人中心</a>-><a
		href="<?= Url::toRoute(['/sale/vip-address/index'])?>">收货地址列表</a>
	<hr>
    <?php $form = ActiveForm::begin(); ?>
    
	
	<?= $form->field($model, 'name')->textInput(['maxlength' => 10,'placeholder'=>'请输入姓名'])?>
	    
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 11,'placeholder'=>'请输入手机号码'])?>
    
    <?=$form->field ( $model, 'province_id' )->dropDownList ( $provinces, [ 'prompt' => '--请选择收货省份--','style' => 'width:100%' ] )?>
                                              
    <?=$form->field ( $model, 'city_id' )->dropDownList ( $cities, [ 'prompt' => '--请选择收货城市--','style' => 'width:100%' ] )?>   
                                              
    <?=$form->field ( $model, 'district_id' )->dropDownList ( $districts, [ 'prompt' => '--请选择所属片区--','style' => 'width:100%' ] )?>                                                                                   
    
	<?= $form->field($model, 'detail_address')->textInput(['maxlength' => 200,'placeholder'=>'请输入详细地址'])?>
    
    是否默认收货地址？<?= $form->field($model, 'default_flag')->radioList(['1'=>'是','0'=>'否'])?>
    
    <?= $form->field($model, 'status')->hiddenInput()?>
    
    <input type="hidden" name="orderId" value="<?=$orderId?>">

    <div class="form-group">
    	<?php if (empty($orderId)){?>
    		<?= Html::submitButton($model->isNewRecord ? '新增收货地址' : '更新收货地址', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>'width:100%'])?>
    	<?php }else{?>
    		<?= Html::submitButton('确定', ['class' => 'btn btn-primary','style'=>'width:100%'])?>
    	<?php }?>
        
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


	$('#vipaddress-province_id').change(function(){
		$("#vipaddress-city_id option[value!='']").remove();	
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-order/find-cities'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
			    province_id:$('#vipaddress-province_id').val(),
		    	//'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
			    	
				    $.each(data.value,function(i,v){
				    	$('#vipaddress-city_id').append("<option value='"+v.id+"'>"+v.name+"</option>");	
				    });
			    }
		    }  
		}); 
	});


	$('#vipaddress-city_id').change(function(){
		$("#vipaddress-district_id option[value!='']").remove();		
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-order/find-districts'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	city_id:$('#vipaddress-city_id').val(),
		    	},     
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
				    $.each(data.value,function(i,v){
				    	$('#vipaddress-district_id').append("<option value='"+v.id+"'>"+v.name+"</option>");	
				    });
			    }
		    	
		    }  
		}); 
	});
	 
});


</script>