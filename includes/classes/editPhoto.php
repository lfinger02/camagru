<?php

    $imgTemp = $_POST['imageTempUrl'];
    $sticker = $_POST['imageChoosen'];
    
    

    $image = new Imagick();
    $image->readImage("../../images/captures/screenshot.jpg");


$watermark = new Imagick();
$watermark->readImage("../../images/stickers/$sticker");


$watermarkResizeFactor = 2;


$img_Width = $image->getImageWidth();
$img_Height = $image->getImageHeight();
$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();


$watermark->scaleImage($watermark_Width / $watermarkResizeFactor, $watermark_Height / $watermarkResizeFactor);


$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();


$x = 0;
$y = ($img_Height - $watermark_Height);


$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, 0, 0);


//header("Content-Type: image/" . $image->getImageFormat());
echo "<img class='checkImage' src='images/uploads/goat_watermark.JPEG'/>";


$image->writeImage("../../images/uploads/goat_watermark." . $image->getImageFormat());/**/

unlink("../../images/captures/screenshot.jpg");

?>