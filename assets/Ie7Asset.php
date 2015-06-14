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
class Ie7Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web'; 
    public $css = [      
       'css/Font-Awesome-3.2.1/css/font-awesome-ie7.min.css',        
    ];
    public $js = [
    		
    ];
    public $cssOptions=[
        'condition' => 'gte IE 7'
    ];
    public $depends = [
      
    ];
}
