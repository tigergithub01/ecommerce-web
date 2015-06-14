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
class BlockUIAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web'; 
    public $css = [
        
    ];
    public $js = [
    	'js/jquery.blockUI.js',
    	'js/mydialog.js',
    ];
    public $depends = [
       'yii\web\JqueryAsset'
    ];
}
