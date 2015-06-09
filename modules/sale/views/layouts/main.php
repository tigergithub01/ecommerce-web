<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);

//$this->registerCssFile('css/sale/bootstrap.css');
//$this->registerCssFile('css/sale/buserInfo.css');
//$this->registerCssFile('css/sale/jNotify.css');


//$this->registerJsFile('js/sale/public.js');
//$this->registerJsFile('js/sale/jNotify.js');
//$this->registerJsFile('js/sale/spin.js');
//$this->registerJsFile('js/sale/common.js');
$this->registerJsFile("js/jquery/jquery-1.8.2.min.js",['position' => \yii\web\View::POS_HEAD]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>

<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
