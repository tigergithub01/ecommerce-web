<?php

/* 
 * 生成缩略图类
 * jim
 * 2015-07-08
 */

namespace app\components;

//$th=new Thumb();
//$file="E:\ymz\pic\IMG_20140502_184748.jpg";
//$file="E:\ymz\pic\scale.JPG";
//$dest="E:\ymz\pic\scale.JPG";
//$th->scaleImage($file,$dest,220);

class Thumb {
    
    function __construct(){
        
    }
    
    public function scaleImage($file,$dest, $max = 400) {       
         
        $info = getimagesize($file);
        $w=$info[0];
        $h=$info[1];
        
        //指定缩放出来的最大的宽度（也有可能是高度）
        if($w<$max && $h<$max){
            $w = $info[0];
            $h = $info[1];
        }
        elseif ($w > $h) {
            $w = $max;
            $h = $h * ($max / $info[0]);
        } else {
            $h = $max;
            $w = $w * ($max / $info[1]);
        }
       
        //创建画布
        $hb = imagecreatetruecolor($w, $h);
        $img = $this->getImageCreator($file);
        imagecopyresampled($hb, $img, 0, 0, 0, 0, $w, $h, imagesx($img), imagesy($img));

        if (substr($info['mime'], -4) == 'jpeg') {
            imagejpeg($hb, $dest,100);
        }

        if (substr($info['mime'], -3) == 'png') {
            imagepng($hb, $dest,0);
        }

        imagedestroy($hb);
        imagedestroy($img);
    }
    
    public function resizeImage($file, $width, $height = 0) {
        //根据最大值为300，算出另一个边的长度，得到缩放后的图片宽度和高度
        $info = getimagesize($file);
        $nw = $info[0];
        $nh = $info[1];

        if ($width > 0 && $height > 0) {
            $w = $width;
            $h = $height;
        } else if ($width > 0 && $height == 0) {
            $w = $width;
            $h = $nh * ($w / $nw);
        } else if ($height > 0 && $width == 0) {
            $h = $height;
            $w = $nw * ($h / $nh);
        }

        $hb = imagecreatetruecolor($w, $h);
        $img = $this->getImageCreator($file);
        imagecopyresampled($hb, $img, 0, 0, 0, 0, $w, $h, imagesx($img), imagesy($img));

        if (substr($info['mime'], -4) == 'jpeg') {
            imagejpeg($hb, $file);
        }

        if (substr($info['mime'], -3) == 'png') {
            imagepng($hb, $file);
        }

        imagedestroy($hb);
        imagedestroy($img);
    }

    public function getImageCreator($file) {
        $info = getimagesize($file);
        if ($info) {
            $mine = $info['mime'];

            if (substr($mine, -4) == 'jpeg') {
                return imagecreatefromjpeg($file);
            }

            if (substr($mine, -3) == 'png') {
                return imagecreatefrompng($file);
            }
        }

        return null;
    }
}