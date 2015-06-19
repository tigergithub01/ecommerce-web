<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
            messages:{
                "Vip[vip_no]":{required:"会员手机号码不能为空"},
                "Vip[name]":{required:"姓名不能为空"}
            }
        });
    });
</script>
<div class="vip-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form1',
        'enableClientValidation'=>true,
        ]); ?>

    <?php if($model->errors){
    echo Html::errorSummary($model,['header'=>'输入有误，请检查：','class'=>'error-summary']);     
}?>
    <table class="table_edit">
        <tr>
            <td class="td-column" style="width:200px;">会员手机号码</td>
            <td class="">
                <?=Html::activeInput('text', $model, 'vip_no',['class'=>'form-input required']) ?> 
                <?php if($model->isNewRecord) {?><span class="input-tip">初始密码为手机后面后6位</span><?php }?>
            </td>
        </tr>
        <tr>
            <td class="td-column">姓名</td>
            <td class=""><?=Html::activeInput('text', $model, 'name',['maxlength' => 60,'class'=>'form-input required']) ?></td>
        </tr>               
        <tr>
            <td class="td-column">身份证</td>
            <td class="">
                <?=Html::activeInput('text', $model, 'id_card',['class'=>'form-input']) ?>                
            </td>
        </tr>
        <tr>
            <td class="td-column">安全邮箱</td>
            <td class=""><?=Html::activeInput('text', $model, 'email',['maxlength' => 20,'class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">会员状态</td>
            <td class=""><?=Html::activeDropDownList($model, 'status',[1=>'正常',0=>'停用'],['class'=>'form-select']) ?></td>
        </tr>        
   </table>
    <p class="center">
     <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
</p>

    <?php ActiveForm::end(); ?>

</div>
