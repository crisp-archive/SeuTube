<?php
define("INNER_ACCESS","1");	
include_once("config.php");
include_once("db/config.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$vid=$_GET['vid'];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login.php");
}
else
{
	$sql="delete from st_movie where vid=$vid and uid=$uid";
	$result=mysql_query($sql);
	if($result)
		header("Location:$host_name/redirect.php?msg=删除成功&text=点这返回我的视频&link=$host_name/my_movies.php");
	else
		header("Location:$host_name/redirect.php?msg=删除失败&text=点这返回我的视频&link=$host_name/my_movies.php");
}
?>