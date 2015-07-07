<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\order\SoSheet;
use app\models\order\OutStockSheet;
use app\models\order\ReturnSheet;
use app\models\order\RefundSheet;


$this->title = '主页';
$this->params['breadcrumbs'][] = $this->title;

//待发货订单数
$order_fh=SoSheet::find()->where(['status'=>3002])->count();
//待退货订单数
$order_th=SoSheet::find()->where(['status'=>3007])->count();
//待退款订单数
$order_tk=SoSheet::find()->where(['status'=>3008])->count();

?>
<script type="text/javascript">

</script>
<style type="text/css">
    .web_part {border:1px solid #dde5e4;height:277px;margin-bottom:20px;width:49%;}
    .width100 {width:auto;}
    .web_part_title {background-color:#f2f7f7;height:29px;line-height:29px;font-weight: bold;padding-left:15px;}
    .web_part_more { float:right;color:#003eff;padding-right:15px;}
    .web_part li { padding:3px 10px;list-style-type:disc;}
    .web_part li a {color:#7a7a7a;font-weight: bold;font-size:14px;}
    .web_part li .li_date {color:#ccc;margin-left:20px;font-size:12px;font-weight: normal;float:right;}
    .web_part_content {padding:15px;}
    .number {font-size:20px;margin:0px 10px;}
</style>

<div class="web_part width100">
    <div class="web_part_title">        
        订单信息
    </div>
    <div class="web_part_content">
        <p>待发货订单:<?=Html::a($order_fh, ['order/so-sheet/index','status'=>3002],['class'=>'red number'])?></p>
        <p>待退货订单:<?=Html::a($order_th, ['order/so-sheet/index','status'=>3007],['class'=>'red number'])?></p>
        <p>待退款订单:<?=Html::a($order_tk, ['order/so-sheet/index','status'=>3008],['class'=>'red number'])?></p>
        
    </div>
</div>

<!--

<div class="web_part float-right">
    <div class="web_part_title">
        <?=Html::a('更多',['order/refund-sheet'],['class'=>'web_part_more'])?>
        最新退款单
    </div>
    <ul>
        <?php foreach (RefundSheet::find()->select('id,code,sheet_date')->orderBy('id desc')->limit(10)->all() as $value) {
            echo "<li><a href=".Url::to(['order/refund-sheet/update','id'=>$value['id']]).">".$value['code']."</a><span class='li_date'>".$value['sheet_date']."</span></li>";
        }?>
    </ul>
</div>
-->
