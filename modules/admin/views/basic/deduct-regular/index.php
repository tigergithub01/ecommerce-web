<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分润规则管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-type-index">
    <script type="text/javascript">
        function submitSearch() {
            document.getElementById('form_search').submit();
        }        
       
    </script>
    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?= Url::to(['update','id'=>$model->id]) ?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>修改</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 
    
    <?= DetailView::widget([
        'options'=>['class'=>'table_view'],
         'template' => "<tr><td class='td-column' style='width:150px;'>{label}</td><td>{value}</td></tr>",
        'model' => $model,
        'attributes' => [
            'deduct_level1',
            'deduct_level2',
            'deduct_level3',
            'deduct_level4',            
        ],
    ]) 
        ?>

    

</div>
