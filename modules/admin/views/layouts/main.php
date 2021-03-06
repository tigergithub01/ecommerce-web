<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
app\assets\Ie7Asset::register($this);
//app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>   
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <?= Breadcrumbs::widget([       
        'homeLink'=>['label'=>'','url'=>'#'],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    
    <div class='content_wrap' style='padding:10px;'>
        <?=$content?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
