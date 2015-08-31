<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\order\SoSheet */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/jquery.easytabs.min.js');
?>
<style type="text/css">    
    .td-column{ width:150px;}
    .productList { width:100%;border-collapse:collapse;border:1px solid #DEDEDE;}
    .productList td {text-align:center;border:1px solid #DEDEDE;}
    .productList th {background-color:#F0F0F0;}
    .list-view {width:100%; border-collapse:collapse;margin:auto;border: 1px solid #c3c3be; }
    .list-view thead th {background-color:#f6f8f9;height: 25px;line-height:25px;}
    .list-view td {border: 1px solid #c3c3be;padding:5px;text-align:center; }
    .lt1 { width:100px;color:#666666;display: inline-block;text-align: right;}
</style>
<script type="text/javascript">
    $(function () {
        $('#tab-container').bind('easytabs:ajax:beforeSend',function(event, clicked, targetPanel){
            targetPanel.html("正在加载数据...");
        });
        
        $('#tab-container').easytabs({
            'animate':false
        });
        
    })
</script>
<div class="so-sheet-view">

    <div class='clearfix h1div'>
        <div class='float-right'>           
            <a href='<?= Url::to(['index']) ?>' class='button_link'><i class=' icon-angle-left'></i>返回列表</a>
        </div>        
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <div id="tab-container" class="tab-container">
        <ul class='etabs'>
            <li class='tab'><a href="#tabs1">基本信息</a></li>
            <li class='tab'><a href="<?=Url::to(['out-stock-sheet','id'=>$model->id])?>" data-target="#tabs2">发货单</a></li>
            <!--<li class='tab'><a href="#tabs3">退货单</a></li>-->
            <li class='tab'><a href="<?=Url::to(['refund-sheet','id'=>$model->id])?>" data-target="#tabs4">退款单</a></li>
        </ul>
        <p></p>
        <div class="m" id="tabs1">
            <div class="mt">订单信息</div>
            <div class="mc">
                <div>
                    <h3>订单基本信息</h3>
                    <table class="table_view">
                        <tr>
                            <td class="td-column">编号</td>
                            <td><?= $model->code ?></td>                       
                        </tr>
                        <tr>
                            <td class="td-column">状态</td>
                            <td><?php
                                $h = "{status}";
                                switch ($model['status']) {
                                    case 3001://待支付
                                        $h = '<span class="msg msg_danger"><i class="icon-credit-card icon-large"></i>{status}</span>';
                                        break;
                                    case 3002://待发货
                                        $h = '<span class="msg msg_warning"><i class="icon-truck icon-large"></i>{status}</span>&nbsp;';
                                        $h.=Html::a('发货(填写发货单)', ['order/out-stock-sheet/create', 'order_id' => $model->id], ['class' => 'button_link']);
                                        break;
                                    case 3003://待收货
                                        $h = '<span class="msg msg_info"><i class="icon-volume-up icon-large"></i>{status}</span>';
                                        break;
                                    case 3004://待评价
                                        $h = '<span class="msg msg_info"><i class="icon-comments icon-large"></i>{status}</span>';
                                        break;
                                    case 3005://已完成
                                        $h = '<span class="msg msg_success"><i class="icon-ok icon-large"></i>{status}</span>';
                                        break;
                                    case 3006://已关闭
                                        $h = '<span class="msg msg_primary"><i class="icon-lock icon-large"></i>{status}</span>';
                                        break;
                                    case 3007://待退货
                                        $h = '<span class="msg msg_warning"><i class="icon-bolt icon-large"></i>{status}</span>&nbsp;';
                                        $h.=Html::a('退货', ['return_sheet', 'id' => $model->id], ['class' => 'button_link']);
                                        break;
                                    case 3008://待退款
                                        $h = '<span class="msg msg_warning"><i class="icon-money icon-large"></i>{status}</span>&nbsp;';
                                        $h.=Html::a('退款', ['refund_sheet', 'id' => $model->id], ['class' => 'button_link']);
                                        break;
                                }

                                $h = str_replace('{status}', $model['orderStatus']['pa_val'], $h);
                                echo $h;
                                ?>

                            </td>                       
                        </tr>
                        <tr>
                            <td class="td-column">结算状态</td>
                            <td><?= $model->getSettleFlagText() ?></td>                       
                        </tr>
                        <tr>
                            <td class="td-column">金额</td>                        
                            <td class="red" style="font-size:18px;">￥<?= sprintf('%.2f', $model['order_amt']) ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">产品数量</td>
                            <td><?= $model->order_quantity ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">运费</td>                       
                            <td class="red" style="font-size:18px;">￥<?= sprintf('%.2f', $model['deliver_fee']) ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">下单会员</td>
                            <td>
                                <?=Html::a($model['vip']['name']."(".$model['vip']['vip_no'].")",['vip/vip/view','id'=>$model['vip']['id']],['target'=>'_blank'])?>                                
                            </td>
                        </tr>
                        <tr>
                            <td class="td-column">客户留言</td>
                            <td><?= Html::encode($model->message) ?></td>
                        </tr>
                    </table>
                </div>

                <div>
                    <h3>付款信息</h3>
                    <table class="table_view">
                        <tr>
                            <td class="td-column">支付方式</td>
                            <td><?= $model['payType']['name'] ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">付款金额</td>
                            <td class="red" style="font-size:18px;">￥<?= sprintf('%.2f', $model['pay_amt']) ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">交易号</td>
                            <td><?= $model['trade_no'] ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">交易状态</td>
                            <td><?= $model['trade_status'] ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">付款时间</td>
                            <td><?= $model['pay_date'] ?></td>
                        </tr>                    
                    </table>
                </div>
                <div>
                    <h3>退款信息</h3>
                    <table class="table_view">
                        <tr>
                            <td class="td-column">退款金额</td>
                            <td><?= $model['return_amt'] ?></td>
                        </tr>
                        <tr>
                            <td class="td-column">退款日期</td>
                            <td><?= $model['return_date'] ?></td>
                        </tr>                                       
                    </table>
                </div>
                <div>
                    <h3>产品清单</h3>
                    <table class="productList" cellspacing="0" cellpadding="4">
                        <tr>
                            <th style="width:200px;">商品编号</th>
                            <th>商品名称</th>
                            <th style="width:200px;">单格</th>
                            <th style="width:150px;">数量</th>
                            <th style="width:200px;">价格</th>
                        </tr>
                        <?php foreach ($model->productItems as $key => $item) { ?>
                            <tr>
                                <td><?= $item['product']['code'] ?></td>
                                <td><?= $item['product']['name'] ?></td>
                                <td class="red">￥<?= sprintf('%.2f', $item['price']) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td class="red">￥<?= sprintf('%.2f', $item['amount']) ?></td>                       
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php if (isset($model['delivery'])) { ?>
                    <div>
                        <h3>快递信息</h3>
                        <table class="table_view">
                            <tr>
                                <td class="td-column">配送方式</td>
                                <td><?= $model['delivery']['name'] ?></td>
                            </tr>
                            <tr>
                                <td class="td-column">配送编码</td>
                                <td><?= $model['delivery']['code'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="productList" cellspacing="0" cellpadding="4">
                                        <tr>
                                            <th style="width:200px;">收货人姓名</th>
                                            <th style="width:200px;">手机号码</th>
                                            <th style="text-align:left;">地址</th>                                  
                                        </tr>                            
                                        <?php foreach ($model->contactPerson as $key => $item) { ?>
                                            <tr>
                                                <td><?= $item['name'] ?></td>
                                                <td><?= $item['phone_number'] ?></td>                                       
                                                <td style="text-align:left;"><?= $item['detail_address'] ?></td>                                                       
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- 发货单 -->
        <div id="tabs2">
            
        </div>

        <div id="tabs3">
           
        </div>

        <div id="tabs4">
 <!--退款单-->
           
        </div>
    </div>




</div>