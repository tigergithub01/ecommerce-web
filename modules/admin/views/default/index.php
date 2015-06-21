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
    <title>管理后台</title>
    <link href="<?=\Yii::getAlias('@web/css/admin_index.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=\Yii::getAlias('@web/css/layout-default.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>  
    <!--[if IE 7]>
    <link href="<?=\Yii::getAlias('@web/css/Font-Awesome-3.2.1/css/font-awesome-ie7.min.css')?>" rel="stylesheet" type="text/css"/>   
    <![endif]-->
    <script src="<?=\Yii::getAlias('@web/js/jquery-1.11.3.min.js')?>" type="text/javascript"></script>
    <script src="<?=\Yii::getAlias('@web/js/jquery.layout-latest.js')?>" type="text/javascript"></script>
    <style type='text/css'>
        .submenu {display: none;}
        .ui-layout-center {overflow:hidden;}
    </style>
    <script type="text/javascript">
        function ifrrize(){
            var size=$('#centerifr').parent();           
            $('#centerifr').css({height:size.innerHeight()-2});
        }
            
        $(document).ready(function () {
            $('body').layout({ applyDemoStyles: false,
               north__resizable:true,
               spacing_open:1,
               west:{size:188},
               north:{spacing_open:0},
               center:{
                   onresize:ifrrize,
                   onshow_end:function(){ }
            }
            });
            
            var currentUl=null;
            
            $("li.menu1").click(function(){                
            }).children("a").click(function(){
                var cu=$(this).next("ul");
                
                if(currentUl && cu!=currentUl){
                    currentUl.slideToggle("fast",function(){
                        currentUl=cu;
                        currentUl.slideToggle("fast");
                    });                    
                }else{
                    currentUl=cu;
                    currentUl.slideToggle("fast"); 
                }  
                
                return false;
            });
            
            ifrrize();
            
        });

    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="ui-layout-center">
    <iframe name='centerifr' id='centerifr' style='width:100%;border:0px;' src="<?=Url::to(['web-part'])?>" frameborder="0"></iframe>
</div>
<div class="ui-layout-north">
 <div id='top_wrap'>
        <img src="<?=\Yii::getAlias('@web/images/logo.png')?>" style="max-height: 100%;">
        <div style="float: right;margin-right:25px;padding:3px 15px;border-radius: 10px;background-color:#03537b;margin-top:25px;">
            <i class="icon-user"></i>&nbsp;<?=yii::$app->user->identity->user_id?>(<?=yii::$app->user->identity->user_name?>)&nbsp;<i style="color:#fff;">|</i>&nbsp;
            <?=Html::a('主页', ['index'],['target'=>'_top'])?>&nbsp;<i style="color:#fff;">|</i>&nbsp;
            <?=Html::a('退出', ['logout'],['target'=>'_top'])?>
        </div>
    </div>
</div>

    <div class="ui-layout-west">
        <div style='background-color:#3c95c8;height:40px;line-height: 40px;color:#fff;padding-left:30px;font-size:14px;font-weight:bold;border-top:2px solid #5ab8ef;'>
            <span class='mnav'>菜单导航</span></div>
        <ul>
            <li class='menu1'><a href=""><span class="m11">产品管理</span></a>
                <ul class="submenu">
                    <li><a href="<?=Url::to(['product/product-type/'])?>"><span class="m2">产品类别</span></a></li>
                    <li><a href="<?=Url::to(['product/product/'])?>"><span class="m2">产品列表</span></a></li>                    
                </ul>
            </li>
            <li class='menu1'><a href=""><span class="m11">会员管理</span></a>
                <ul class="submenu">                   
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">会员列表</span></a></li>
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">会员反馈</span></a></li>
                    
                </ul>
            </li>
            <li class='menu1'><a href=""><span class="m11">订单管理</span></a>
                <ul class="submenu">
                    <li><a href="<?=Url::to(['order/so-sheet'])?>"><span class="m2">销售订单</span></a></li>
                    <li><a href="<?=Url::to(['order/out-stock-sheet'])?>"><span class="m2">发货单</span></a></li>                
                    <li><a href="<?=Url::to(['order/return-sheet'])?>"><span class="m2">退货单</span></a></li>                
                    <li><a href="<?=Url::to(['order/refund-sheet'])?>"><span class="m2">退款单</span></a></li>                    
                </ul>
            </li>
            <!--
            <li class='menu1'><a href=""><span class="m11">财务管理</span></a>
                <ul class="submenu">                   
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">会员分润计算</span></a></li>
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">会员提现流水</span></a></li>
                    
                </ul>
            </li>
            <li class='menu1'><a href=""><span class="m11">查询与统计</span></a>
                <ul class="submenu">                   
                    <li><a href="<?=Url::to(['vip/so-sheet'])?>"><span class="m2">订单明细</span></a></li>                    
                </ul>
            </li>-->
            <li class='menu1'><a href=""><span class="m11">基础资料</span></a>
                <ul class="submenu">                   
                    <li><a href="<?=Url::to(['basic/pay-type'])?>"><span class="m2">支付信息</span></a></li>
                    <li><a href="<?=Url::to(['basic/delivery-type'])?>"><span class="m2">配送信息</span></a></li>
                    <li><a href="<?=Url::to(['basic/province'])?>"><span class="m2">区域信息</span></a></li>                    
                </ul>
            </li>
            <!--
            <li class='menu1'><a href=""><span class="m11">系统设置</span></a>
                <ul class="submenu">                   
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">用户信息</span></a></li>
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">角色信息</span></a></li>
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">密码修改</span></a></li>
                    <li><a href="<?=Url::to(['vip/vip'])?>"><span class="m2">操作日志</span></a></li>
                    
                </ul>
            </li>
            -->
        </ul>
    </div>


  

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
