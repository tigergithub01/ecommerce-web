<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "产品详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/goods.css',['position' => \yii\web\View::POS_HEAD] );

?>


<div class="vip-center-form" style="margin: 10px;">
	 <div class="goods_info_bar">
		<div class="title">
              <span class="btl">丽瓦丽干红</span>
              <span class="scr"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/order_02.png" class="fav_goods" id="caocao_pic" onclick="change_pic()"><em id="fav_count">0</em></span>
        </div>
        
		<div class="sale_info">
			<span class="price">售价：<span class="value">￥368.00</span></span>
         </div>
       
        <div class="sale_info">
			<span class="yunfei">运费：<span>免运费</span></span>
			<!--<span class="sale">销量0笔</span>-->
		</div>
		
        <hr class="gray_solid">
	</div>
		
	<div class="standard_bar">
       
		<div class="panel">
            
			<div class="standard">
				<div class="color row">
					<div class="thumb"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/s_552394a32bea8.jpg"></div>
					<div class="info">
						<span class="price">￥<span class="s_price">368.00</span></span><span class="gray"><!--（库存<span class="s_stock">200</span>件）--></span><br>
						<span class="gray">请选择规格</span>
					</div>
					<div class="btn_close"> <a href="javascript:void(0)"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_close.png"></a></div>
				</div>
			<!--规格类型-->
        <div id="hqwznr">
				<div class="shuxing">规格</div>
					<div class="yansxz">
						<div class="xzys active" data-id="" data-price="368.00" data-stock="200">
								<a class="" href="javascript:void(0)"></a>
							</div>					</div>
				
          <div class="number_bar">
						<div class="calc">
							<span class="buynber">数量：</span>
							<label class="tag"></label>
							<span class="counter">
								<a class="reduce" href="javascript:void(0)"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_calc_reduce.png"></a>
								<input class="num" value="1" name="num" id="number" type="text">
								<a class="add" href="javascript:void(0)"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_calc_add.png"></a>
							</span>
							<span class="stock">(库存<span class="s_stock">200</span>件)</span>
							<input value="12891" name="gid" id="gid" type="hidden">
							<input value="56765" name="usid" id="usid" type="hidden">
						</div>
					</div>
				</div>
			<!----------->
       		
							<div class="size center">
					<button class="button primary btn-sure" data-oper="buy">立刻购买</button>
				</div>			</div>
		</div>
		<div class="bg"></div>
	</div>
	
    
    
    
	<div class="goods_detail_bar">
		<div class="tab">
			<!----<a class="item_full left" data-target="detail_block" href="javascript:void(0)">图文详情</a>----->
			
			<a class="item rborder active" data-target="detail_block" href="javascript:void(0)">图文详情</a>
			<a class="item" data-target="comment_block" href="javascript:void(0)">用户评价<span class="danger">（0）</span></a>
			
		</div>
		<div class="detail_block">
			<div class="detail_content">
				波尔多AOC  
法国酒庄原瓶原装进口，绝无中间环节
入口圆润，也适合初学人士
产品详情：
名称：德拉贝尔干红  葡萄酒产地：法国．波尔多（法定产区）   参考年份：２０１１
葡萄品种：美乐，赤霞珠      等级：ＡＯP　　　      橡木桶陈酿：９个月    
容量：７５０ml            酒精度：13%    　      产品类型： 干型红葡萄酒  
香气：水果与植物气息        口感：口感圆润柔和，单宁细腻 　　　　　     　      
适饮温度：  16°C~18°C     贮藏温度：10°C~18°C避光卧放   
醒酒时间：  30分钟以上      生产商：SBE达克戴斯酒厂  
配餐建议：可配川菜、烤鸭、烧肉、火腿、牛排、野味……
品尝纪录：单宁柔和易饮，入口圆润，酒体适中，余味立体、丰富。			</div>
			<div class="img_block" id="aa2">
				<img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/552394a32bea8.jpg"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/552394c15d671.jpg"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/552394e343f37.jpg"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/552394f63d976.jpg"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/5523950b479ea.jpg"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/552395258824e.jpg">			</div>
		</div>
        
		<!---------------------评价---------------------------->
     <div class="comment_block">
			<div class="status" id="Menuaa">
				<a class="btn active" href="javascript:void(0)" onclick="comment_switch(this)" data-level="0" data-count="0">全部</a>
				<a class="btn" href="javascript:void(0)" onclick="comment_switch(this)" data-level="1" data-count="0"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_good.png"><span>好评（0）</span></a>
				<a class="btn" href="javascript:void(0)" onclick="comment_switch(this)" data-level="2" data-count="0"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_normal.png"><span>中评（0）</span></a>
				<a class="btn" href="javascript:void(0)" onclick="comment_switch(this)" data-level="3" data-count="0"><img src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_bad.png"><span>差评（0）</span></a>
			</div>
			<div class="comment_list"><!--暂无更多评论--></div>
		</div>
        
        
	</div>
	<div class="open_bar">
		<div class="content">平台自带强大的供应商系统，可以让你0库存、免发货，还可以发展连锁分店，收益多多，赶快来开免费微店吧！</div>
		  <!----------------------------开店star----------------------------------->
      <!----<div class="bottom-nav">
                    <ul>
                        <li><a href="/wap.php/web/index/usid/56765.html">店铺首页</a></li>
                        <li><a href="/wap.php/user/index/usid/56765.html">个人中心</a></li>
                        <li class="qubian"><a href="/wap.php/reg/index/invite_mobile/13724346621" target="_blank">免费开云商店</a></li>
                    </ul>
       </div>---->
       
       <!-- 
      <div class="goods_btn_mfkysd"><a href="http://ysk.xmgapay.com/wap.php/reg/index/invite_mobile/13724346621" target="_blank">免费开云商微店</a></div>
       -->          
    <!----------------------------开店end----------------------------------->
	</div>
	<div id="img_view_bar" class="img_view_bar">
		<div class="img_view_bar_bg"></div>
		<div class="img_view_bar_container"></div>
		<!-- 
		<div class="img_view_bar_btn_left"><a href="javascript:void(0)"><img src="/static/wap/images/btn_left.png" /></a></div>
		<div class="img_view_bar_btn_right"><a href="javascript:void(0)"><img src="/static/wap/images/btn_right.png" /></a></div>
		 -->
	</div>
	<div class="goods_btn_placeholder_bar"></div>
	<div class="goods_btn_bar">
		<!-- 非供应商的商品 -->
        <a class="man_button" href="<?=Url::toRoute(['/sale/vip-center/index'])?>"><img src="images/sale/icon_man.png"></a>
		<a class="cart_button" href="<?=Url::toRoute(['/sale/vip-cart/index'])?>"><img src="images/sale/icon_cart.png"></a>
		<a class="buy_button1 buy" href="<?=Url::toRoute(['/sale/vip-order/contact'])?>">立即购买</a>	</div>

</div>

<style type="text/css">
/* ------------------------------------------------ 头部 ------------------------------------ */

header{
	background: #337ab7;
	color: white;
	text-align: center;
	margin: 0px;
	padding: 0px;
	display: table;
	width: 100%;
}

/* ------------------------------------------------ 头部 ------------------------------------ */
</style>



<script type="text/javascript">
$(function(){
	// 详情页tab按钮
	$(document).on("click", ".tab .item", function(e){
		$(".tab .item").removeClass("active");
		var target = $(this).addClass("active").data("target");
		$(".detail_block").hide();
		$(".comment_block").hide();
		$("." + target).show();
	});
	
		// 详情页评价按钮
	$(document).on("click", ".status .item", function(e){
		$(".status .btn").removeClass("active");
		var target = $(this).addClass("active").data("target");
		$(".detail_block").hide();
		$(".comment_block").hide();
		$("." + target).show();
	});
});


</script>


