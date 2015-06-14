<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * tiger.guo use svn
 * @since 2.0
 */
class ZTreeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web'; 
    public $css = [
        'css/zTree/zTreeStyle.css'
    ];
    public $js = [
    	'js/jquery.ztree.all-3.5.min.js',    	
    ];
    public $depends = [
       'yii\web\JqueryAsset'
    ];
}
