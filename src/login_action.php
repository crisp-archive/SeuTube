<?php
session_start();
include_once("config.php");
include_once("db/user.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");

$username = $_POST["username"];
$password = md5($_POST["password"]);
$check	  = $_POST['checkcode'];

$su=new st_user($uid,$username,$password);
if($su->login() && $_SESSION[check_pic]==$check)
{
	header("Location:$host_name");
}
else
{
	$su->logoff();
	if( $_SESSION[check_pic]==$check)
		header("Location:$host_name/redirect.php?msg=�û����������벻��ȷ&text=���µ�¼&link=$host_name/login.php");
	else
		header("Location:$host_name/redirect.php?msg=��֤�����&text=���µ�¼&link=$host_name/login.php");
}
?>