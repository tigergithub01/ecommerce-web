<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\MyDialogWidget;

\app\assets\ZTreeAsset::register($this);

?>
<script type="text/javascript">
    $(function(){
        $("#form1").validate({
            debug: false,
            onfocusout: function (element) {
                $(element).valid();
            },
            errorElement: 'label',
            errorClass: 'has-error',           
            errorPlacement: function(error, element) {
                if(element.attr("name") == 'data[captcha]') {
                    error.insertAfter("#captcha_msg");
                } else {
                    error.insertAfter(element);
                }
            },           
            messages:{
                "ProductType[name]":{required:"产品名称不能为空"}
            }
        });
    });
</script>
<div class="product-type-form">    
    
    <?php $form = ActiveForm::begin([
        'id'=>'form1'        
    ]); ?>
    <table class="table_edit">
        <tr>
            <td class="td-column" style="width:150px;"><?=Html::activeLabel($model, 'name')?></td>
            <td><?=Html::activeTextInput($model, 'name',['class'=>'form-input required','maxlength'=>60,'minlength'=>2])?>
                <?=Html::error($model, 'name',['tag'=>'label','class'=>'has-error'])?>                
            </td>
        </tr>
         <tr>
            <td class="td-column"><?=Html::activeLabel($model, 'parent_id')?></td>
            <td>
                <?=Html::activeTextInput($parentModel, 'name',['readonly'=>'readonly','class'=>'form-input','name'=>'parentTypeName','id'=>'parentTypeText'])?> 
                <?=Html::activeHiddenInput($model, 'parent_id',['class'=>'form-input'])?>
                <a href="#" style="color:#00b0df;" data-mydialog-target="#mw1" class="mydialog-trigger"><i class=" icon-folder-open"></i>选取分类</a>
            </td>
        </tr>
         <tr>
            <td class="td-column"><?=Html::activeLabel($model, 'description')?></td>
            <td><?=Html::activeTextInput($model, 'description',['class'=>'form-input','maxlength' => 600])?></td>
        </tr>
        <tr>
            <td class="td-column">&nbsp;</td>
            <td>
                <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'button_link' : 'btn btn-primary ']) ?>
            </td>
        </tr>
    </table>
    
    <div class="form-group">
        
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php MyDialogWidget::begin(['id'=>'mw1','title'=>'上一级']);?>
<div id="treeParent" class="ztree" style="height:300px;overflow:auto"></div>
<div style="text-align:center;">
    <a href="javascript:getProductType();" class="btn">确 定</a>
    <a href="#" class="btn btn_gray unblockui-trigger">取 消</a>
</div>
<?php MyDialogWidget::end();?>
<script type="text/javascript">
    var treeobj=null;
    
    $(function(){
        var setting = {
            async: {
                    enable: true,
                    url:"<?=Url::to(['product/product-type/get-json'])?>",
                    type:"get",
                    autoParam:['id=parent_id'],
                    otherParam:{}                    
            }
        };

    
        treeobj=$.fn.zTree.init($("#treeParent"), setting);
    });
    
    function getProductType(){
        var c=treeobj.getSelectedNodes();
        if(c.length>0){
            $("#producttype-parent_id").val(c[0]['id']);
            $("#parentTypeText").val(c[0]['name']);
            $.unblockUI();
        }
        
    }
</script>
