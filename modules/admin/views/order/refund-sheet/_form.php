<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\basic\Parameter;
use app\models\order\RefundSheet;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$statusArray=ArrayHelper::map(Parameter::find()->where(['type_id'=>6])->asArray()->all(),'id', 'pa_val');
$returnSheet=ArrayHelper::map($model->getAssociateReturnSheet(),'id','code');
$returnSheet=ArrayHelper::merge([''=>''],$returnSheet);
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
       
    });
</script>

<?php if($model->errors){
    echo Html::errorSummary($model,['header'=>'输入有误，请检查：','class'=>'error-summary']);     
}?>
<div class="product-type-form">    
    
    <?php $form = ActiveForm::begin([
        'id'=>'form1'        
    ]); ?>
    
    <?=Html::activeHiddenInput($model, 'order_id')?>
   
    <table class="table_edit">
        <tr>
            <td class="td-column">关联的退货单号</td>
            <td>                 
                <?=Html::activeDropDownList($model, 'return_id',$returnSheet,['class'=>'form-select'])?>
            </td>
        </tr>
         <tr>
            <td class="td-column">待退款金额</td>
            <td>                 
                <?=Html::activeTextInput($model, 'need_return_amt',['class'=>'form-input'])?>                
            </td>
        </tr>
        <tr>
            <td class="td-column">实际退款金额</td>
            <td>                 
                <?=Html::activeTextInput($model, 'return_amt',['class'=>'form-input'])?>                
            </td>
        </tr>
        <tr>
            <td class="td-column">状态</td>
            <td><?=Html::activeDropDownList($model, 'status',$statusArray,['class'=>'form-select'])?></td>
        </tr>
        <tr>
            <td class="td-column">结算状态</td>
            <td><?=Html::activeDropDownList($model, 'settle_flag',RefundSheet::settleFlagArray(),['class'=>'form-select'])?></td>
        </tr>
        <tr>
            <td class="td-column">备注</td>
            <td><?=Html::activeTextarea($model, 'memo',['class'=>'form-input form-textarea','maxlength' => 400])?></td>
        </tr>       
    </table>
    
<p class="center">
    <?php if($model->isNewRecord || $model->status!=6002 || !$model->settle_flag){
        echo Html::submitButton($model->isNewRecord ? '确定' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ','onclick'=>'']);
    }else{
         echo "退款单已经完成，无法修改";
     }?>
</p>
    <?php ActiveForm::end(); ?>

</div>