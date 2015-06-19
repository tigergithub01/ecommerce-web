<?php
    use yii\helpers\Html;

\app\assets\BlockUIAsset::register($this);    
  
foreach ($options as $key=>$value) {}
?>
<script type="text/javascript">

</script>

<div id="<?=$id?>" class="mydialog" <?php foreach ($options as $key=>$value) { echo $key."=".$value." ";} ?>>
    <div class="mydialog-title clearfix">
        <a href="javascript:void(0);" class="mydialog-close unblockui-trigger" title="关闭窗口"></a>
        <?=Html::encode($title)?>        
    </div>
    
    <div class="mydialog-content">
        <?=$content?>
    </div>
    
</div>
