<?xml version="1.0" encoding="gb2312"?>
<fav>
<result>
<?php
include_once("config.php");
include_once("db/user.php");
include_once("db/movie.php");
include_once("t/mblog.php");

header('Content-Type: text/xml');
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	echo 0;
}
else
{
	$vid=$_GET['vid'];
	$sm=new st_movie();
	$sm->vid=$vid;
	$sm->get_movie_info();
	$smb=new st_mblog($sm->uid);
	$result=$smb->post("分享视频$sm->title, <a href=\"$host_name/play/$sm->vid\">点这观看</a>");
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