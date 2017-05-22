<?php
define("INNER_ACCESS","1");	
include_once("config.php");
include_once("db/movie.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login");
}
else
{
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$vid=$_POST['vid'];
	
	$e=0;
	
	if(strlen($title)==0)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=标题不可为空！&text=返回重新修改&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($desc)==0)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=描述不可为空！&text=返回重新修改&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($title)>140)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=标题不可超过140个字符！&text=返回重新修改&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($desc)>140)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=描述不可超过140个字符！&text=返回重新修改&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(!$e)
	{
		$sql="update st_movie set title='$title',description='$desc' where vid=$vid and uid=$uid";
		$result=mysql_query($sql);
		if($result)
			header("Location:$host_name/redirect.php?msg=修改成功&text=返回我的视频&link=$host_name/user/movie");
		else
			header("Location:$host_name/redirect.php?msg=修改失败&text=返回我的视频&link=$host_name/user/movie");
	}
}
?>