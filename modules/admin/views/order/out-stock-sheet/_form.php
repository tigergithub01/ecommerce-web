<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\MyDialogWidget;

\app\assets\ZTreeAsset::register($this);
$statusArray=  \app\models\basic\Parameter::find()->where(['type_id'=>4])->asArray()->all();
$statusArray=ArrayHelper::map($statusArray, 'id', 'pa_val');
?>
<style type='text/css'>
    .tpdetail {width:100%;border-collapse:collapse;}
    .tpdetail td {text-align: center;padding:5px;}
    
</style>
<script type="text/javascript">
    $(function(){
        $("#form1").validate({
            debug: false,
            onfocusout: function (element) {
                $(element).valid();
            },
            errorElement: 'label',
            errorClass: 'has-error'
        });        
              
        $("#tpdetail").on('click',".remove_product",function(){
            if(!window.confirm("确认要移除这个货物？")){
                return false;
            }
            var id=$(this).attr("data-remove-id");
          
            if(id){
                //删除的列表清单
                var r=$("#ReturnDetailDeleteItemID").clone();
                r.removeAttr('id').attr("name","removeid[]").val(id);
                console.log(r);
                r.appendTo($("#ditemco"));
            }
            
            $(this).parents("tr:first").remove();
            return false;
        });
        
        $(".add_product").click(function(){   
            var data_key=$(this).attr("data-key");
            if($("#tpdetail tr[data-key="+data_key+"]").length>0){
                alert("已在退货清单中");
                return ;
            }
            var tr=$(this).parents("tr:first").clone();
            tr.find("a.add_product").addClass('remove_product').removeClass('add_product').html("删除");
            tr.appendTo("#tpdetail");
        });
        
        $("#tpdetail input[data-max-number]").blur(function(){
            var v=$(this).val();
            var maxnum=$(this).attr("data-max-number");
            if(v==0 || v>maxnum){
                alert("无效的数量");
                $(this).val(maxnum);
                $(this).focus();
            }
        }).keydown(function(e){
            if(e.keyCode==13){
                return false;
            }
        });
    });
</script>

<?php if($model->errors){
    echo Html::errorSummary($model,['header'=>'输入有误，请检查：','class'=>'error-summary']);     
}?>
<div class="product-type-form">    
    
    <?php $form = ActiveForm::begin([
        'id'=>'form1'        
    ]); ?>
    <input type="hidden"  id="ReturnDetailDeleteItemID">
    <div id="ditemco"></div>
    <?=Html::activeHiddenInput($model, 'order_id')?>    
    <table class="table_edit">       
         <tr>
            <td class="td-column">运费</td>
            <td>                 
                <?=Html::activeTextInput($model, 'deliver_fee',['class'=>'form-input'])?>                
            </td>
        </tr>
         <tr>
            <td class="td-column">快递单号</td>
            <td>                 
                <?=Html::activeTextInput($model, 'delivery_no',['class'=>'form-input'])?>                
            </td>
        </tr>
        <tr>
            <td class="td-column">状态</td>
            <td><?=Html::activeDropDownList($model, 'status',$statusArray,['class'=>'form-select'])?></td>
        </tr>
        <tr>
            <td class="td-column">备注</td>
            <td><?=Html::activeTextarea($model, 'memo',['class'=>'form-input form-textarea','maxlength' => 400])?></td>
        </tr>       
    </table>
    
    <div class="m">
        <div class="mt">
             <a href="#" data-mydialog-target="#mw1" class="mydialog-trigger float-right">添加发货商品</a>
            发货产品清单
        </div>
        <div class="mc">
            <table class='tpdetail' id='tpdetail'>
                <thead>
                    <tr>
                        <th>产品</th>
                        <th>数量</th>
                    </tr>
                </thead>
                <?php 
                $_products=[];
                
                if($model->isNewRecord){ 
                    $_products=$model->getProducts();
                }else{
                    $_products=$model->getSheetDetailProducts();
                }
                
                 foreach ($_products as $key => $item) { ?>
                    <tr data-key="<?=$item['product_id']?>">
                        <td>
                            <input type='hidden' name='OutStockDetail[<?=$item['product_id']?>][id]' value='<?=$item['id']?>'>
                            <input type='hidden' name='OutStockDetail[<?=$item['product_id']?>][product_id]' value='<?=$item['product_id']?>'>
                            <input type='hidden' name='OutStockDetail[<?=$item['product_id']?>][order_quantity]' value='<?=$item[$model->isNewRecord?'quantity':'order_quantity']?>'>
                            <?=Html::a($item['productName'], ['product/product/view','id'=>$item['product_id']],['target'=>'_blank']) ?>
                        </td>
                        <td>
                            <?php if($model->isNewRecord){ ?>
                            <input type='text' name='OutStockDetail[<?=$item['product_id']?>][out_quantity]' class='form-input center' style='width:50px;' value='<?= $item['quantity'] ?>' data-max-number='<?= $item['quantity'] ?>'>
                            <?php } else { ?>
                            <input type='text' name='OutStockDetail[<?=$item['product_id']?>][out_quantity]' class='form-input center' style='width:50px;' value='<?= $item['out_quantity'] ?>' data-max-number='<?= $item['out_quantity'] ?>'>
                            <?php } ?>
                            <a href='#' class='remove_product' data-remove-id="<?=isset($item['id'])?$item['id']:0?>">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
<p class="center">
    <?php
     if($model->status==4001 || $model->isNewRecord){        
        echo Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ;
     }
     else{
         echo "改退货单已经完成，不允许修改";
     }
?>
</p>
    <?php ActiveForm::end(); ?>

</div>

<?php MyDialogWidget::begin(['id' => 'mw1', 'title' => '添加发货商品', 'options' => ['style' => 'width:500px;']]); ?>
<div style="height:300px;overflow:auto">
    <table class='tpdetail' id="cycle_table">
        <thead>
            <tr>
                <th>产品</th>
                <th>数量</th>
            </tr>
        </thead>
        <?php foreach ($model->getProducts() as $key => $item) { ?>
            <tr data-key="<?=$item['product_id']?>">
                <td>
                    <input type='hidden' name='OutStockDetail[<?= $item['product_id'] ?>][id]' value='0'>
                    <input type='hidden' name='OutStockDetail[<?= $item['product_id'] ?>][product_id]' value='<?= $item['product_id'] ?>'>
                    <input type='hidden' name='OutStockDetail[<?= $item['product_id'] ?>][order_quantity]' value='<?= $item['quantity'] ?>'>
                    <?= Html::a($item['productName'], ['product/product/view', 'id' => $item['product_id']], ['target' => '_blank']) ?>
                </td>
                <td>
                    <input type='text' name='OutStockDetail[<?= $item['product_id'] ?>][out_quantity]' class='form-input center' style='width:50px;' value='<?= $item['quantity'] ?>' data-max-number='<?= $item['quantity'] ?>'>
                    <a href='#' class='add_product' data-key="<?=$item['product_id']?>">确定</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php MyDialogWidget::end(); ?>