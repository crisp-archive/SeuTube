<?php
include_once("header.php");
include_once("config.php");
$vid=$_POST["vid"];
$gid=$_POST["gid"];
$uid=$_POST["uid"];
$tid=$_POST["tid"];
$pw=$_POST["pw"];
if($pw!=$admin_pass)
	header("Location: $host_name");

include_once("db/config.php");
$sql="delete from st_movie where vid=$vid";
mysql_query($sql);
$sql="delete from st_mblog where tid=$tid";
mysql_query($sql);
$sql="delete from st_gbook where nid=$gid";
mysql_query($sql);
$sql="delete from st_user where uid=$uid";
mysql_query($sql);

header("Location: $host_name/admin");
?>