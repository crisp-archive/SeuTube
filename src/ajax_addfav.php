<?xml version="1.0" encoding="gb2312"?>
<fav>
<result>
<?php
header('Content-Type: text/xml');
include_once("config.php");
include_once("db/user.php");
include_once("db/config.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("/");
}
else
{
	$sql="insert into st_favs values(0,$uid,$vid)";
	$result=mysql_query($sql);
	if($result==1)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}
?>
</result>
</fav>