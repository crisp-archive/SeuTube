<?php
$msg=$_GET['msg'];
$text=$_GET['text'];
$link=$_GET['link'];

define("INNER_ACCESS","1");
include_once("header.php");
echo '<div id="redirect_area">';
echo "��ʾ:$msg<br>";
echo "��ת��: <a href=\"$link\">$text</a><br>";
echo '</div>';
include_once("footer.php");
?>
