<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\order\RefundSheet;

//$refundsheet=RefundSheet::findAll(['order_id'=>$model->id]);
$refundsheet=RefundSheet::find()->with("statusData")->where(['order_id'=>$model->id])->all();

?>

<script type="text/javascript">
$(function(){
    $(".submitReturnSheetDetail").click(function(){
        if(!window.confirm('确定退货完成后，将不能修改退货单')){
            return false;
        }
            
        var sender=$(this);
        var id=sender.attr("data-detail-id");         
        sender.html("正在修改状态...").attr("disabled",true);
        
        $.post("<?=Url::to(['order/refund_sheet/confirm-finish'])?>",{id:id},function(){
            alert("状态修改完毕");
            window.location.reload(true);
        });
        return false;
    });
});
</script>

<a href='<?= Url::to(['order/refund-sheet/create','order_id'=>$model->id]) ?>' class='button_link'>填写新退款单</a>

<!-- 退款单 -->
<div style="margin:10px auto;"> 

    <table class="productList" cellspacing="0" cellpadding="4">
        <tr>
            <th style="width:150px;">退款单号</th>
            <th style="width:150px;">待退款金额</th>
            <th style="width:150px;">实际退款金额</th>
            <th style="width:150px;">下单时间</th>
            <th style="width:100px;">状态</th>
            <th style="width:100px;">结算状态</th>
            <th >备注</th>
            <th style="width:150px;">操作</th>
        </tr>
        <?php foreach ($refundsheet as $key => $item) {  ?>
            <tr>
                <td><?= $item['code'] ?></td>
                <td><?= sprintf('%.2f',$item['need_return_amt']) ?></td>
                <td><?= sprintf('%.2f',$item['return_amt']) ?></td>
                <td><?= $item['sheet_date'] ?></td>
                <td><?= $item['statusData']["pa_val"] ?></td>
                <td><?= $item->settleFlagTxt ?></td>               
                <td><?= $item['memo'] ?></td>
                <td>
                    <?php
                    if($item->status!=6002 || !$item->settle_flag){
                        echo Html::a('修改',['order/refund-sheet/update','id'=>$item->id], ['class'=>'button_link']);
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
