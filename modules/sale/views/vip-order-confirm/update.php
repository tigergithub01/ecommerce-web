<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单确认";
/* $this->registerCssFile ( 'css/sale/header.css', [ 
 'position' => \yii\web\View::POS_HEAD 
 ] ); */

$this->registerCssFile ( 'css/sale/product.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/bootstrap.css' );
$this->registerJsFile('js/sale/jquery.blockUI.js', [
		'position' => \yii\web\View::POS_END
]);

?>


<div class="vip-order-contact-form wrapper" style="margin: 10px;">
	

	<?php $form = ActiveForm::begin(['action'=>['/sale/vip-order/submit'],'options' => ['class' => 'form-vertical'],]); ?>
	<section>
		<div style="cursor: pointer;">
			<hr class="gray_solid">			
		<?php if($address_count==0){?>
			<div style="text-align:center;">
				您还没收收货地址
				 <?= Html::a('新建收货地址', ['/sale/vip-address/create', 'orderId' => $soSheet->id], ['class' => 'btn btn-primary']) ?>
			</div>
		<?php }else{?>
			<?php if (empty($vipAddress)){?>
				<div style="text-align:center;">
					<?= Html::a('请选择收货地址', ['/sale/vip-address/index', 'orderId' => $soSheet->id], ['class' => 'btn btn-primary']) ?>
				</div>
			<?php }else {?>
			<div style="float: right;">
			<?= Html::a('修改收货地址', ['/sale/vip-address/index', 'orderId' => $soSheet->id], ['class' => 'btn btn-primary']) ?>
			</div>
				<div><?=$vipAddress['name']?></div>
			<div><?=$vipAddress['phone_number']?></div>
			<div>
			<?php
				$address = $vipAddress->areaSort;
				echo $address ['provnce'] . $address ['city'] . $address ['district']?>
			</div>
			
			<?php }?>
		<?php }?>
		
		
			<div class="page_go"
				style="float: right; position: absolute; right: 1em; width: 10px;"></div>
		</div>
	</section>
	<div style="height: 10px; background: #f3f1ef none repeat scroll 0 0;">

	</div>


	<section>
		<div class="so_sheet_detail" style="margin-top: 20px;">
		<?php foreach ($soSheet->soDetailList as $i=>$soDetail) {?>
			<!-- 
			<input type="hidden" name="detailList[<?=$i?>][product_id]"
				value="<?php echo $soDetail['product_id']?>"> <input type="hidden"
				name="detailList[<?=$i?>][quantity]"
				value="<?php echo $soDetail['quantity']?>"> <input type="hidden"
				name="detailList[<?=$i?>][price]"
				value="<?php echo $soDetail['price']?>"> <input type="hidden"
				name="detailList[<?=$i?>][amount]"
				value="<?php echo $soDetail['amount']?>">
			 -->	
			<div class="order_item_bar">
				<div class="info_block">
					<div class="img" style="width: 80px;">
						<a
							href="<?=Url::toRoute(['/sale/product/view','id'=>$soDetail['product_id']])?>">
					<?php if(isset($soDetail->product->primaryPhoto)){?>
						<img style="height: 70px; width: 70px;"
							src="<?php echo Url::toRoute(['/sale/product-photo/view','id'=>$soDetail['product']['primaryPhoto']['id']])?>">
					<?php }else{?>
						<img style="height: 70px; width: 70px;" src="">
					<?php }?>
				</a>
					</div>
					<div class="info_title">
						<div class="name"><?php echo $soDetail->product['name'] ?></div>
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
			<hr class="gray_solid">
		<?php }?>
	</div>
	</section>


	<!-- 
	
	<div class="form-group">
        <?php echo Html::submitButton('提交订单', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;'])?>
        <?php /*echo Html::button('下一步',['class' => 'btn btn-primary','id'=>'btn_submit_contact','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
    </div>
    -->

	<div class="goods_btn_bar bottom_bar" style="float: right;">
		<input type="hidden" name="draft_order_id" value="<?=  $soSheet['id']?>">
		<input type="submit" class="buy_button1 buy"
			style="float: right; margin: 0" value="提交订单">
		<div
			style="width: 30%; height: 40px; line-height: 40px; float: right; text-align: right; margin: 0; padding-right: 5px; /*background:rgba(0, 0, 0, 0.8) none repeat scroll 0 0;*/ color: white;">
			实付款：￥<span><?php echo round($soSheet->order_amt,2)?></span>
		</div>



	</div>
	 

    <?php ActiveForm::end(); ?>
    
	

</div>




<script type="text/javascript">
$(function(){
	$("#btn_submit_contact").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/confirm'])?>';	
	});

	$("form").submit(function(){
		$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
		return true;
	});
});	
</script>


