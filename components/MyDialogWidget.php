<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;


class MydialogWidget extends Widget
{
    public $title;
    public $id='bi0';
   
    public function init()
    {        
        parent::init();        
        ob_start();
    }

    public function run()
    {        
        $content = ob_get_clean();
        return $this->render('Mydialog',[
            'title'=>$this->title,
            'id'=>$this->id,
            'content'=>$content
                ]);
    }
}

?>