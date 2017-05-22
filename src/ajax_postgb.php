<?xml version="1.0" encoding="gb2312"?>
<post>
	<result>
<?php
header('Content-Type: text/xml');
define("INNER_ACCESS","1");
include_once("db/user.php");
include_once("db/config.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$su=new st_user($uid,$username,$password);
if($su->check_status())
{
	$su->get_user_info_by_id();
	$t=$_GET['t'];
	$vid=$_GET['vid'];
	$st=str_replace("'","'",$t);
	$sql="insert into st_gbook values(null,$vid,$su->uid,'$st',null)";
	$result=mysql_query($sql);
	echo $result;
}
else
	echo 0;
?>
	</result>
</post>
