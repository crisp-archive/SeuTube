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
	$vpp = $_POST['vpp_modify'];

	$su->get_user_info_by_id();
	$su->video_per_page=$vpp;
	$su->update_user_info();
	
	header("Location:$host_name/setting");
}
 ?>