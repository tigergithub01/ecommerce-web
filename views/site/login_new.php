<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '请登录';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <script type="text/javascript" src="<?=\Yii::getAlias('@web/js/jquery-1.11.3.min.js')?>"></script>   
    <link href="css/Font-Awesome-3.2.1/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <title><?= Html::encode($this->title) ?></title>  
    <style>
        body {margin:0px;padding:0px;font-size:14px;}
       .form-group { padding:10px;}
       .button { display: block;margin:auto; width:100%;border:0px;background-color:#1B9AF7;height: 30px;line-height: 30px;border-radius: 5px;color:#fff;}
    </style>
</head>
<body>
    <div style="background-color:#FDFDFD;color:#8C8A85;width:500px;margin:auto;margin-top:10%;">
        <div style="width:90%;margin:auto;">
            <?php $form = ActiveForm::begin([

            ]); ?>

            <?= $form->field($model, 'userId',['template'=>'{label}{input}<i class="icon-user"></i>{error}']) ?>

            <?= $form->field($model, 'password',['template'=>'{label}{input}<i class="icon-key"></i>{error}'])->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>


                <input type="submit" class="button" value="登录">

            <?php ActiveForm::end(); ?>
        </div>
        </div>
</body>
</html>


