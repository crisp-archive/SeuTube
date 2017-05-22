<?php
session_start();
for($i=0;$i<4;$i++)
{
	$rand.=dechex(rand(1,15));
}
$_SESSION[check_pic]=$rand;
$im = imagecreatetruecolor(100,30);
$bg = imagecolorallocate($im,0,0,0);
$rc = imagecolorallocate($im,255,255,255);
imagestring($im,5,rand(3,70),rand(3,15),$rand,$rc);
header("Content-Type: image/jpeg");
imagejpeg($im);
?>