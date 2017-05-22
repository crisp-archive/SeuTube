<?php
include_once("config.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$su=new st_user($uid,$username,$password);
$su->logoff();

header("Location:$host_name");
?>