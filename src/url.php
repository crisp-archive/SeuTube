<?php
$go=$_GET['go'];
include_once("db/config.php");
$uid=hexdec($go);
$sql="select url from st_url where uid=$uid";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$url=$row["url"];
echo "redirecting to ".$url."\n";
header("Location:$url");
?>