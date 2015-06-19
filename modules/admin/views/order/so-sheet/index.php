<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\basic\Parameter;
use yii\helpers\ArrayHelper;

$statusArray=ArrayHelper::merge([''=>''],ArrayHelper::map(Parameter::find()->where(['type_id'=>3])->all(), 'id', 'pa_val'));
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '销售订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}
</script>

       
    <div class='clearfix h1div'>
        <div class='float-right'>            
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
    
<div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>
            订单编号：
            <?=Html::input('text', 'code',yii::$app->request->get('code'),['class'=>'form-input'])?>  
            状态：
            <?=Html::dropDownList('status', Yii::$app->request->get('status',''), $statusArray,['class'=>'form-select'])?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
    </div>

    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'options'=>['class'=>'grid-view'],
        'dataProvider' => $dataProvider,
        'columns' => [            
            [
                'label'=>'订单编号',
                'format'=>'raw',
                'value'=>function($model, $key, $index, $column){
                    $h='<strong>'.$model->code.'</strong>';                    
                    return $h;
                }
            ],
            [
                'label'=>'订单金额',
                'format'=>'raw',
                'value'=>function($model){                    
                    return '<span class="red">￥'.Yii::$app->formatter->asDecimal($model->order_amt,2)."</span>";
                }
            ],           
            'order_date',
            [
                'label'=>'状态',
                'format'=>'raw',
                'value'=>function($model){
                    $h="{status}";
                    switch ($model['status']){
                        case 3001://待支付
                            $h='<span class="msg msg_danger"><i class="icon-credit-card icon-large"></i>{status}</span>';
                            break;
                        case 3002://待发货
                             $h='<span class="msg msg_warning"><i class="icon-truck icon-large"></i>{status}</span>';
                            break;
                        case 3003://待收货
                            $h='<span class="msg msg_info"><i class="icon-volume-up icon-large"></i>{status}</span>';
                            break;
                        case 3004://待评价
                            $h='<span class="msg msg_info"><i class="icon-comments icon-large"></i>{status}</span>';
                            break;
                        case 3005://已完成
                            $h='<span class="msg msg_success"><i class="icon-ok icon-large"></i>{status}</span>';
                            break;
                        case 3006://已关闭
                            $h='<span class="msg msg_primary"><i class="icon-lock icon-large"></i>{status}</span>';
                            break;
                        case 3007://待退货
                            $h='<span class="msg msg_warning"><i class="icon-bolt icon-large"></i>{status}</span>';
                            break;
                        case 3008://待退款
                            $h='<span class="msg msg_warning"><i class="icon-money icon-large"></i>{status}</span>';
                            break;
                    }
                    
                    $h=  str_replace('{status}', $model['orderStatus']['pa_val'], $h);
                    
                    return $h;
                }
            ],
            [
                'label'=>'操作',
                'attribute'=>'id',
                'format'=>'raw',
                'value'=> function($model,$key,$index,$column){
                    $h=[Html::a('查看详情', Url::to(['view','id'=>$model->id]))];                    
                    return implode('<span class="link_split">|</span>', $h);
                }
            ],
        ],
    ]); ?>


