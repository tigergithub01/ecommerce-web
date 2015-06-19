<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\order\SoSheet;
use app\models\order\OutStockSheet;
use app\models\order\ReturnSheet;
use app\models\order\RefundSheet;


$this->title = '主页';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">

</script>
<style type="text/css">
    .web_part {border:1px solid #dde5e4;height:277px;margin-bottom:20px;width:49%;}
    .web_part_title {background-color:#f2f7f7;height:29px;line-height:29px;font-weight: bold;padding-left:15px;}
    .web_part_more { float:right;color:#003eff;padding-right:15px;}
    .web_part li { padding:3px 10px;list-style-type:disc;}
    .web_part li a {color:#7a7a7a;font-weight: bold;font-size:14px;}
    .web_part li .li_date {color:#ccc;margin-left:20px;font-size:12px;font-weight: normal;float:right;}
</style>

<div class="web_part float-left">
    <div class="web_part_title">
        <?=Html::a('更多',['order/so-sheet'],['class'=>'web_part_more'])?>
        最新订单
    </div>
    <ul>
        <?php foreach (SoSheet::find()->select('id,code,order_date')->orderBy('id desc')->limit(10)->all() as $value) {
            echo "<li><a href=".Url::to(['order/so-sheet/view','id'=>$value['id']]).">".$value['code']."</a><span class='li_date'>".$value['order_date']."</span></li>";
        }?>        
    </ul>
</div>

<div class="web_part float-right">
    <div class="web_part_title">
        <?=Html::a('更多',['order/out-stock-sheet'],['class'=>'web_part_more'])?>
        最新发货单
    </div>
    <ul>
        <?php foreach (OutStockSheet::find()->select('id,code,sheet_date')->orderBy('id desc')->limit(10)->all() as $value) {
            echo "<li><a href=".Url::to(['order/out-stock-sheet/update','id'=>$value['id']]).">".$value['code']."</a><span class='li_date'>".$value['sheet_date']."</span></li>";
        }?>
    </ul>
</div>

<div class="web_part float-left">
    <div class="web_part_title">
        <?=Html::a('更多',['order/return-sheet'],['class'=>'web_part_more'])?>
        最新退款单
    </div>
    <ul>
        <?php foreach (ReturnSheet::find()->select('id,code,sheet_date')->orderBy('id desc')->limit(10)->all() as $value) {
            echo "<li><a href=".Url::to(['order/return-sheet/update','id'=>$value['id']]).">".$value['code']."</a><span class='li_date'>".$value['sheet_date']."</span></li>";
        }?>
    </ul>
</div>

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
