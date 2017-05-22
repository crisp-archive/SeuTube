<?xml version="1.0" encoding="gb2312"?>
<delete>
<result>
<?php
header('Content-Type: text/xml');
include_once("config.php");
include_once("db/user.php");
include_once("db/config.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$tid=$_GET["tid"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header($host_name);
}
else
{
	$sql="delete from st_mblog where uid=$uid and tid=$tid";
	echo mysql_query($sql);
}
?>
</result>
</delete>