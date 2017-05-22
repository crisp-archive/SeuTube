<?php
include_once("config.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
	
define("INNER_ACCESS","1");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name");
}
else
{
	$newemail = $_POST['email_modify'];
	
	$emchars="^[[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-\.]+$";
	if(ereg("$emchars",$newemail))
	{
		$su->get_user_info_by_id();
		$su->email=$newemail;
		$su->update_user_info();
		header("Location:$host_name/setting");
	}
	else
		header("Location:$host_name/redirect.php?msg=不符合email格式&link=$host_name/setting/email&text=重新修改");
}
 ?>