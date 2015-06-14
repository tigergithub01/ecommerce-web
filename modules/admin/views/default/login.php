<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;

$this->title = '请登录';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="<?php echo \Yii::getAlias('@web/js/jquery-1.11.3.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo \Yii::getAlias('@web/js/jquery-validation/jquery.validate.min.js')?>"></script>
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>  
    <!--[if IE 7]>
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome-ie7.min.css')?>" rel="stylesheet" type="text/css"/>   
    <![endif]-->
    <style>
        body {margin:0px;padding:0px;font-size:14px;background-color:#3E718F;}        
       .form-group { padding:10px;border:1px solid #dbdbdb; width:300px;height: 30px;line-height:30px;background-color:#fff;margin-bottom:-1px;}
       .form-group input { width:250px;height: 100%;line-height: 100%;border-width:0px;outline-width: 0px;padding-left:10px;}
       .fg1 { border-radius: 5px 5px 0px 0px;}
       .fg2 { border-radius: 0px 0px 5px 5px;}
       .fg3 { border-width:0px;padding:0px;background-color:transparent;margin:0px;margin-top:15px;}
       .button { display: block;margin:auto; width:100%;border:0px;background-color:#1B9AF7;height: 30px;line-height: 30px;border-radius: 5px;color:#fff;}
       .t2 i {color:#1B9AF7;}
       .vcode { vertical-align: top;}
       .has-error { border-color:#ff0000;}
       .error-summary {list-style-type: none;color:#ff0000;}
       .error-summary li { font-size:12px;padding:2px 5px;}
    </style>
    <script>        
    function getcode(){
        $("#vccode").attr("src","<?=Url::toRoute('default/captcha')?>&c="+(new Date()).getTime());
    }
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div style="background-color:#FDFDFD;color:#8C8A85;width:350px;margin:auto;margin-top:10%;padding:30px;">
        <div style="width:90%;margin:auto;">
            <?php $form = ActiveForm::begin([

            ]); ?>
               
                <div class="form-group fg1 <?php if(isset($model->errors['userId'])){ echo 'has-error';}?>">
                    <span class="t2"><i class="icon-user icon-large"></i>                        
                        <input type="text" name="AdminLoginForm[userId]" id="userId" placeholder="用户名" value='<?=Html::encode($model->userId)?>'>
                    </span>
                </div>                
                <div class="form-group <?php if(isset($model->errors['password'])){ echo 'has-error';}?>">
                    <span class="t2"><i class="icon-lock icon-large"></i><input type="password" name="AdminLoginForm[password]" id="password" placeholder="密码"></span>
                </div>
                <div class="form-group fg2 <?php if(isset($model->errors['verifyCode'])){ echo 'has-error';}?>">
                    <span class="t2">
                        <i class="icon-picture icon-large"></i><input type="text" name="AdminLoginForm[verifyCode]" id="verifyCode" placeholder="验证码" style="width:180px;" value='<?=Html::encode($model->verifyCode)?>'>
                        
                        <?php echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'default/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'class'>='vcode','name'=>'verifyCode' ,'style'=>'cursor:pointer;vertical-align:top;'],'template'=>'{image}']); ?>
                    </span>
                </div>
                <div  class="form-group fg3">
                    <input type="submit" name="dosubmit" id="dosubmit" class="button" value='登 录'>
                </div>
                <ul class='error-summary'>
                <?php foreach($model->errors as $error){ ?>
                    <li><?=$error[0]?></li>
               <?php } ?>
                </ul>
            <?php ActiveForm::end(); ?>
            
        </div>
        </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>