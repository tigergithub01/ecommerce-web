<?php

use yii\helpers\Html;
use yii\helpers\Url;

//退货单
$returnSheetList = $model->returnSheetList;

$myReturnSheet=[];
foreach ($returnSheetList as $value) {
    if($value['out_id']==$out_id){
        $myReturnSheet[]=$value;       
    }
}
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
        
        $.post("<?=Url::to(['order/return-sheet/confirm-finish'])?>",{id:id},function(){
            alert("状态修改完毕");
            window.location.reload(true);
        });
        return false;
    });
});
</script>


<!-- 退货单 -->
<div style="margin:10px auto;background-color:#FAFAFA;">
<?php if(!empty($myReturnSheet)){ ?>

<?php } ?>  

<?php foreach($myReturnSheet as $item) { ?>       
            <table class='list-view'>
                <caption style="text-align: left;">
                    <ul>
                        <li>退货单号：<?= $item->code ?></li>                       
                        <li>退货金额：<?= Yii::$app->formatter->asDecimal($item->return_amt, 2) ?></li>
                        <li>下单时间：<?= $item->sheet_date ?></li>
                        <li>状态：<?= $item->statusData['pa_val'] ?></li>
                        <li>备注：<?= $item->memo ?></li>
                        <li style="padding:5px 20px;">
                            <?php if($item->status==5001){
                                echo Html::a('修改退货单', ['order/return-sheet/update', 'id' => $item->id], ['class'=>'button_link']);
                                echo "&nbsp;&nbsp;";
                                echo Html::a('确认完成', ['order/return-sheet/update', 'id' => $item->id], ['class'=>'button_link submitReturnSheetDetail','data-detail-id'=>$item->id]);
                            }?>                            
                        </li>
                    </ul>                        
                </caption>
                <thead>
                    <tr>
                        <th>产品</th>
                        <th style="width:150px;">发货数量</th>
                        <th style="width:150px;">退货数量</th>
                    </tr>
                </thead>
                <?php foreach ($item->getDetial() as $detail) { ?>                        
                    <tr>
                        <td><?= Html::a($detail['productName'], ['product/product/view', 'id' => $detail['product_id']], ['target' => '_blank']) ?></td>
                        <td><?= $detail['out_quantity'] ?></td>
                        <td><?= $detail['return_quantity'] ?></td>
                    </tr>
                <?php } ?>
            </table>

<?php }?>
</div>
