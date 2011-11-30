<?php

class ImageText
{
    static public function createTextImage($width, $height, $text){
        header('Content-Type: image/png');
        $img = @imagecreatetruecolor($width, $height);
        
        $bgColor = imagecolorallocate($img, 255, 255, 255);
        $textColor = imagecolorallocate($img, 0, 0, 0);
        $fontSize = 11;
        $fontName = "./arial.ttf";
        
        imagefilledrectangle($img, 0, 0, $width, $height, $bgColor);
        
        $fontSizeBounds = imagettfbbox($fontSize, 0, $fontName, $text);
        $lineSize = $fontSizeBounds[4];
        $lineHeight = abs($fontSizeBounds[5]);
        $x = (int)(($width - $lineSize) / 2);
        $y = (int)(($height - $lineHeight) / 2);
        imagettftext($img, $fontSize, 0, $x, $y, $textColor, $fontName, $text);
        
        imagepng($img);
        imagedestroy($img);
    }
}

?>