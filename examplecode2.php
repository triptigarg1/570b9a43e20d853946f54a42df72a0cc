<?php

// developed captcha code

session_start();
header ('Content-type: image/png');

if(isset($_SESSION['amped_captcha']))
{
unset($_SESSION['amped_captcha']); // destroy the session if already there
}

//removed L, l, o , 0 to avoid user's confusion
$string1="abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVXYZ";
$string2="23456789";
$string=$string1.$string2;
$string= str_shuffle($string);
$random_text= substr($string,0,4); // change the number to change number of chars

$_SESSION['amped_captcha'] =$random_text; 

$im = @ImageCreate (80, 30) // create image.
or die ("Cannot Initialize new GD image stream");
$background_color = ImageColorAllocate ($im, 204, 204, 204); // set color of background of the image
$text_color = ImageColorAllocate ($im, 51, 51, 255);  // set color of the text to display in the image.
ImageString($im,5,5,2,$_SESSION['amped_captcha'],$text_color);  

imagejpeg ($im); 

imagedestroy($im); // Memory allocation for the image is removed. 

?>