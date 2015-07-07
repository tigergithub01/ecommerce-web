<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\basic\User;

/* @var $this yii\web\View */
/* @var $model app\models\basic\DeliveryType */

$this->title = '修改密码';
$this->params['breadcrumbs'][] ='修改密码';

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
                'UserChangePasswordForm[confirmPassword]':"输入的密码不一致"
            }
        });
    });
</script>

<div class="delivery-type-update">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    

    <div class="delivery-type-form">

        <?php
            echo Html::errorSummary($model, ['header' => '输入有误，请检查：', 'class' => 'error-summary']);        
        ?>

        <?php $form = ActiveForm::begin([
                'id'=>'form1',
        ]);
        ?>
        
        <table class="table_edit">
            <tr>
                <td class="td-column" style="width:200px;">旧密码</td>
                <td class="">
                    <?= Html::activePasswordInput($model, 'oldPassword',['class' => 'form-input required']) ?>
                </td>
            </tr>
            <tr>
                <td class="td-column">新密码</td>
                <td class=""><?= Html::activePasswordInput($model, 'newPassword',['class' => 'form-input required']) ?></td>
            </tr>
            <tr>
                <td class="td-column">确认密码</td>
                <td class="">
                    <?= Html::activePasswordInput($model, 'confirmPassword',['class' => 'form-input required','equalTo'=>'#userchangepasswordform-newpassword']) ?>
                </td>
            </tr>           
<!--            <tr>
                <td class="td-column">密码</td>
                <td class="">
                    <?= Html::input('password','User[newPassword]', '',['class' => 'form-input required','id'=>'user-password']) ?>
                </td>
            </tr>
            <tr>
                <td class="td-column">确认密码</td>
                <td class=""><?= Html::input('password','confpassword','', ['maxlength' => 60, 'class' => 'form-input required','equalTo'=>'#user-password']) ?></td>
            </tr> -->
        </table>
        <p class="center">
            <?= Html::submitButton('修改', ['class' => 'btn btn_large']) ?>
        </p>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<?php if($msg) { ?>
    <script>
        alert("修改成功");
        </script>
    <?php }?>

