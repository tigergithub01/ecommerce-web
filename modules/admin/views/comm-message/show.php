<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <base target='centerifr'>
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>消息</title>   
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>  
    <!--[if IE 7]>
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome-ie7.min.css')?>" rel="stylesheet" type="text/css"/>   
    <![endif]-->
    <script src="<?=\Yii::getAlias('@web/js/jquery-1.11.3.min.js')?>" type="text/javascript"></script>  
    <style type='text/css'>
        html,body{
            padding:0px;
            margin:0px;
            font-family: "STHeiti","Microsoft YaHei";
        }
        .message_wrap{
            width:500px;
            margin:100px auto;
            border:1px solid #b3cbce;            
        }
        .message_title{
            font-size:14px;
            padding:0px 15px;
            height:35px;
            line-height: 35px;
            
             /* fallback */
            background-color: #b3cbce;            

            /* Safari 4-5, Chrome 1-9 */
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#b3cbce), to(#dbeff2));

            /* Safari 5.1, Chrome 10+ */
            background: -webkit-linear-gradient(top, #b3cbce, #dbeff2);

            /* Firefox 3.6+ */
            background: -moz-linear-gradient(top, #b3cbce, #dbeff2);

            /* IE 10 */
            background: -ms-linear-gradient(top, #b3cbce, #dbeff2);

            /* Opera 11.10+ */
            background: -o-linear-gradient(top, #b3cbce, #dbeff2);
  
        }
        .message_content{
            font-size:12px;
            padding:15px;
            min-height: 50px;
        }
    </style>
  <script type="text/javascript">
var url="<?=$redirectUrl?>";
var duration=<?=$duration?>*1000;


var at=window.setInterval(function(){
    duration=duration-1000;   
    document.getElementById('s_d').innerHTML=duration/1000;
    if(duration==0){
        window.clearInterval(at);
        if(url!=""){
            window.location.href=url;
        }
    }
},1000);
</script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="message_wrap">

    <div class='message_title'>信息</div>
    <div class='message_content'>
        <?=Html::encode($msg)?>
        <p>
            <a target='_self' href='<?=$redirectUrl?>'>浏览器自动在<strong id='s_d'><?=$duration?></strong>秒后返回页面，如果没有返回，请按这里</a>
        </p>
    </div>


</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
