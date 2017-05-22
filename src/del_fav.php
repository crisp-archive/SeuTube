<?php
include_once("config.php");
include_once("db/config.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$fid=$_GET['fid'];
if($fid==null || $fid=="")
	$fid=1;

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login.php");
}
else
{
	$sql="delete from st_favs where fid=$fid and uid=$uid";
	$result=mysql_query($sql);
	echo $sql;
	if($result==1)
		header("Location:$host_name/redirect.php?msg=删除成功&text=返回我的收藏&link=$host_name/my_fav.php");
	else
		header("Location:$host_name/redirect.php?msg=出错了！&text=返回我的收藏&link=$host_name/my_fav.php");
}
?>
