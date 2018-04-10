<?php

header("Content-Type:image/png");
//GD 函数库    关于函数操作的图像函数
//创建一个画板
$width=180;
$height=40;
$image=imagecreatetruecolor($width,$height);
//创建一个颜色   mt_rand随机颜色
function getcolor($type="l"){
    global $image;
    if($type==="l"){
        return imagecolorallocate($image,mt_rand(120,255),mt_rand(120,255),mt_rand(120,255));
    }else{
        return imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
    }
}
//填充颜色  资源 绘制的起始位置
imagefill($image,0,0,getcolor());
//添加线条
for($i=0;$i<10;$i++){
    imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getcolor());
}
//添加像素点
for($i=0;$i<50;$i++){
    imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getcolor());
}
//添加字母
$str="qwuertypkjhgfASDWEFRTHYUJKLQXCVBNdsazxbcnvm47258369";
session_start();
$code="";
$len=strlen($str);
for($i=0;$i<4;$i++){
    $pos=mt_rand(0,$len-1);
//    substr进行截取
    $letter=substr($str,$pos,1);
    $code.=strtoupper($letter);
    imagettftext($image,mt_rand(25,35),mt_rand(-15,15),
        $i*40,mt_rand(30,40),getcolor("h"),"font.TTF",$letter);
}
$_SESSION["code"]=$code;
//用当前的图像资源生成一张图片
imagepng($image);
//销毁资源
imagedestroy($image);
