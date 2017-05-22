<?xml version="1.0" encoding="gb2312"?>
<post>
	<result>
<?php
header('Content-Type: text/xml');
define("INNER_ACCESS","1");
include_once("db/user.php");
include_once("db/config.php");
include_once("mblog.php");
include_once("config.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$su=new st_user($uid,$username,$password);
if($su->check_status())
{
	$su->get_user_info_by_id();
}
else
	header("Location:index.php");

$t=$_GET['t'];
$t=str_replace("'","'",$t);
$t=str_replace("<","&lt;",$t);
$t=str_replace(">","&gt;",$t);
$smb=new st_mblog($uid);
echo $smb->post($t);
?>
	</result>
</post>
