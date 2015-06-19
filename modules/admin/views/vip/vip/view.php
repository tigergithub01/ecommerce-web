<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\vip\Vip */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '会员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/jquery.easytabs.min.js');
?>
<style type="text/css">
    .td-column { width:180px;}
    .productList { width:100%;border-collapse:collapse;border:1px solid #DEDEDE;}
    .productList td {text-align:center;border:1px solid #DEDEDE;}
    .productList th {background-color:#F0F0F0;}
    .card_digital {font-weight: bold;color:#ff0000;font-family: Arial;font-size: 30px;}
</style>
<script type="text/javascript">
$(function(){
    $('#tab-container').easytabs({'animate':false});
})
</script>
<div class="vip-view">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <?= Html::a('<i class="icon-pencil"></i>修改', ['update', 'id' => $model->id], ['class' => 'button_link btn-primary']) ?>
            <?= Html::a('<i class="icon-plus-sign"></i>添加', ['create'], ['class' => 'button_link btn-primary']) ?>            
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回列表</a>
        </div>        
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
    
    <div id="tab-container" class="tab-container">
        <ul class='etabs'>
            <li class='tab'><a href="#tab_main">基本信息</a></li><li class='tab'><a href="#tab_bank">信行卡信息</a></li><li class='tab'><a href="#tab_sc">收藏信息</a></li><li class='tab'><a href="#tab_addr">收货地址</a></li>
        </ul>
        <div id="tab_main">
            <p></p>
            <?= DetailView::widget([
                'options'=>['class'=>'table_view'],
                'template' => "<tr><td class='td-column'>{label}</td><td>{value}</td></tr>",
                'model' => $model,
                'attributes' => [
                    'id',
                    'vip_no',
                    'name',
                    'id_card',
                    'last_login_date',                   
                    [
                        'label'=>'上级会员',
                        'format'=>'raw',
                        'value'=>$model->getParentName()
                    ],
                    'email:email',
                    [
                        'label'=>'安全邮箱是否已验证',
                        'format'=>'raw',
                        'value'=>($model->email_verify_flag?"<span class='msg_ok'><i class='icon-ok'></i>已验证</span>":"<span class='msg_forbid'><i class=' icon-remove'></i>未验证</span>")
                    ],
                    [
                        'label'=>'状态',
                        'format'=>'raw',
                        'value'=>($model->status?"<span class='msg_ok'><i class='icon-ok'></i>正常</span>":"<span class='msg_forbid'><i class=' icon-lock'></i>禁用</span>")
                    ],
                    'register_date',
                ],
            ]) ?>
        </div>
        <div id="tab_bank">
            <p></p>           
            <?php if(isset($model['bankCard'])) { ?>
            <table class="productList" cellspacing="0" cellpadding="4">
                    <tr>
                        <th style="width:200px;">银行卡号</th>
                        <th>开会银行</th>
                        <th >支行</th>
                        <th>开会地</th>                        
                    </tr>
                <?php foreach($model['bankCard'] as $key=>$item){ ?>
                    <tr>
                        <td class="card_digital"><?=$item['card_no']?></td>
                        <td><?=$item['bankInfo']['name']?></td>                       
                        <td><?=$item['branch_name']?></td>
                        <td><?=$item['open_addr']?></td>
                                            
                    </tr>
                <?php } ?>
                </table>            
            <?php }?>
        </div>
        <div id="tab_sc">
            <p></p>           
            <?php if(isset($model['productCollection'])) { ?>
            <table class="productList" cellspacing="0" cellpadding="4">
                    <tr>
                        <th >产品</th>
                        <th style="width:200px;">收藏时间</th>                                             
                    </tr>
                <?php foreach($model['productCollection'] as $key=>$item){ ?>
                    <tr>                        
                        <td><?=Html::a($item['productInfo']['name'], ['product/product/view','id'=>$item['productInfo']['id']], ['target'=>'_blank'])?></td>                       
                        <td><?=$item['collect_date']?></td>                       
                    </tr>
                <?php } ?>
                </table>            
            <?php }?>
        </div>
        <div id="tab_addr">
            <p></p>           
            <?php if(isset($model['addressInfo'])) { ?>
            <table class="productList" cellspacing="0" cellpadding="4">
                    <tr>
                        <th >收货人名称</th>
                        <th >手机号码</th>
                        <th >地区</th>
                        <th >详细地址</th>
                        <th style="width:200px;">默认地址</th>                                             
                    </tr>
                <?php foreach($model['addressInfo'] as $key=>$item){ ?>
                    <tr>                        
                        <td><?=$item['name']?></td>                       
                        <td><?=$item['phone_number']?></td>
                        <td><?=implode('/',$item->getAreaSort())?></td>
                        <td><?=$item['detail_address']?></td>                      
                        <td><?=$item['default_flag']?"<span class='msg_ok'><i class='icon-ok'></i></span>":""?></td>                      
                    </tr>
                <?php } ?>
                </table>            
            <?php }?>
        </div>
        
    </div>
    
    

</div>
