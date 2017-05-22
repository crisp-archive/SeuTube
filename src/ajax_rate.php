<?xml version="1.0" encoding="gb2312"?>
<movie>
<result>
<?php
header('Content-Type: text/xml');
include_once("/db/user.php");
	
$vid=$_GET['vid'];
$rate=$_GET['value'];
if($rate>5 || $rate<=0 )
	header("Location:index.php");

$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:/redirect.php?msg=用户未登录&text=点这登录&link=login.php");
}
else
{
	$sql="select * from st_rates where vid=$vid and uid=$uid";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	if(!$row)
	{
		$sql="insert into st_rates values(0,$vid,$uid,$rate)";
		mysql_query($sql);
		echo 1;
	}
	else
	{
		echo 0;
	}
}

?>
</result>
</movie>