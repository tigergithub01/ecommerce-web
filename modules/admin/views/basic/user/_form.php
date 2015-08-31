<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\basic\User;

$roles=\app\models\system\Role::find()->select(['id','name'])->asArray()->all();
$myroles=$model->getRoleList();

foreach($myroles as $item){
    foreach ($roles as &$r) {
        if($item['id']==$r['id']){
            $r['checked']=true;
            break;
        }
    }
}

/* @var $this yii\web\View */
/* @var $model app\models\basic\DeliveryType */
/* @var $form yii\widgets\ActiveForm */
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
                
            }
        });
    });
</script>
<div class="delivery-type-form">

    <?php
    if ($model->errors) {
        echo Html::errorSummary($model, ['header' => '输入有误，请检查：', 'class' => 'error-summary']);
    }
    ?>
    
    <?php $form = ActiveForm::begin([
            'id'=>'form1',
    ]);
    ?>

    <table class="table_edit">
        <tr>
            <td class="td-column" style="width:200px;">登录账号</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'user_id', ['class' => 'form-input required']) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column">姓名</td>
            <td class=""><?= Html::activeInput('text', $model, 'user_name', ['maxlength' => 60, 'class' => 'form-input required']) ?></td>
        </tr>
        <?php if($model->isNewRecord){?>
        <tr>
            <td class="td-column">密码</td>
            <td class="">
                <?= Html::input('password','User[password]', '',['class' => 'form-input required','id'=>'user-password']) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column">确认密码</td>
            <td class=""><?= Html::input('password','confpassword','', ['maxlength' => 60, 'class' => 'form-input required','equalTo'=>'#user-password']) ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td class="td-column">状态</td>
            <td class="">
                <?= Html::activeDropDownList($model, 'status', User::getUserStatusMeta(), ['class' => 'form-select']) ?>
            </td>
        </tr>
        <!--
        <tr>
            <td class="td-column">角色</td>
            <td>
                <?php foreach($roles as $_r){?>
                <label><input type="checkbox" name="userRoles[]" value="<?=$_r['id']?>" <?=isset($_r['checked'])?"checked=''":""?>><?=$_r['name']?></label>
                <?php } ?>
            </td>
        </tr>
        -->
    </table>
    <p class="center">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
