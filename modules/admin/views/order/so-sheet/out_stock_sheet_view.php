<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<script type="text/javascript">
    $('.submitOutStockButton').click(function(){            
            if(!window.confirm('确定发货完成后，将不能修改本发货单')){
                return false;
            }
            var id=$(this).attr("disabled",true).html('确认状态中...').attr("data-outStockID");           
            var sender=$(this);
            $.ajax({
                url:"<?=Url::to(['order/out-stock-sheet/confirm-out-stock'])?>",
                data:{'_csrf':"<?=Yii::$app->request->getCsrfToken()?>",id:id},
                method:"post",
                success:function(){
                    alert("发货已经完成！");
                    location.reload(true);
                }
            });
            return false;
    });
</script>
<?php
if($model->status==3002){
?>
<p>
    <a href='<?= Url::to(['order/out-stock-sheet/create', 'order_id' => $model->id]) ?>' class='button_link'>填写新发货单</a>
</p>
<?php } ?>
<?php

$outStockSheetList = $model->outStockSheetList;
if ($outStockSheetList) {
    foreach ($outStockSheetList as $item) {
        ?>
        <div style="border:5px solid #f1f1f1;margin-bottom: 20px;">
            <table class='list-view'>                        
                <thead>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <ul>
                                <li><span class="lt1">发货单号：</span><?= $item->code ?></li>
                                <li><span class="lt1">运费：</span><?= Yii::$app->formatter->asDecimal($item->deliver_fee, 2) ?></li>
                                <li><span class="lt1">快递单号：</span><?= $item->delivery_no ?></li>
                                <li><span class="lt1">下单时间：</span><?= $item->sheet_date ?></li>
                                <li><span class="lt1">状态：</span><?= $item->statusData->pa_val ?></li>
                                <li><span class="lt1">备注：</span><?= $item->memo ?></li>                                    
                            </ul> 
                            <p style="padding:5px 20px;">
                                <?php
                                if ($item->status == 4001) {
                                    echo Html::a('修改发货单', ['order/out-stock-sheet/update', 'id' => $item->id], ['class' => 'button_link']);
                                    echo "&nbsp;&nbsp;";
                                    echo "<a href='#' class='button_link submitOutStockButton' data-outStockID='".$item->id."'>确认本次发货完成</a>";
                                }
                                if ($item->status == 4002 && $model->status==3007) {
                                    echo Html::a('填写退货单', ['order/return-sheet/create', 'out_id' => $item->id], ['class' => 'button_link']);
                                }
                                ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>产品</th>
                        <th style="width:150px;">发货数量</th>
                    </tr>
                </thead>
                <?php foreach ($item->getDetial1() as $detail) { ?>                        
                    <tr>
                        <td><?= Html::a($detail['productName'], ['product/product/view', 'id' => $detail['product_id']], ['target' => '_blank']) ?></td>
                        <td><?= $detail['out_quantity'] ?></td>
                    </tr>
                <?php } ?>
            </table>

            <!--退货单-->
            <?=
            $this->render('return_sheet_view', [
                'model' => $model,               
                'out_id' => $item->id,
            ])
            ?>
        </div>

    <?php }
} ?>