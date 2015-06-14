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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web'; 
    public $css = [
        'css/admin_site.css',
        'css/Font-Awesome-3.2.1/css/font-awesome.min.css',        
    ];
    public $js = [
    	'js/jquery-validation/jquery.validate.min.js',
    	'js/jquery-validation/additional-methods.min.js',
    	'js/jquery-validation/localization/messages_zh.js',
    	'js/comm.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',        
//         'yii\bootstrap\BootstrapAsset',
    ];
}
