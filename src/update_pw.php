<?php
include_once("config.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
define("INNER_ACCESS","1");
include_once("/db/user.php");
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
	$newpw = $_POST['new_pw'];
	$confirmpw = $_POST['confirm_pw'];
	$PassWordChars = "^[A-Za-z0-9_-]";
	if(ereg("$PassWordChars",$newpw) && $newpw==$confirmpw && strlen($newpw)>=6 && strlen($newpw)<=16)
	{
		$su->get_user_info_by_id();
		$su->password=md5($newpw);
		$su->update_user_info();
		setcookie("password",md5($newpw),time()+60*60*24*30);
		header("Location:$host_name/setting");
	}
	else
	{
		header("Location:$host_name/redirect.php?msg=密码不符合标准&text=重新修改&link=$host_name/setting/pass");
	}
}
 
  
  ?>