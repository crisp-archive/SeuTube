<?xml version="1.0" encoding="gb2312"?>
<?php
header('Content-Type: text/xml');
?>
<page>
<?php
define("INNER_ACCESS","1");
include_once("db/user.php");
include_once("db/config.php");
$vid=$_GET["v"];
$p=$_GET['p'];
if(!isset($p))
	$p=1;
$s=($p-1)*10;
$sql="select * from st_gbook where vid=$vid order by nid desc limit $s,10";
$result=mysql_query($sql);
$c=0;

for($i=1;$i<=10;$i++)
{
	if($row=mysql_fetch_array($result))
	{
		$uid=$row['uid'];
		$su=new st_user($uid,"","");
		$su->get_user_info_by_id();
		$username=$su->username;
		$t=$row['content'];
		$ts=$row['ts'];
		$c++;
	}
	else
	{
		$u="";
		$t="";
		$ts="";
		$img="";
	}
	echo "<uid$i>$uid</uid$i>\n";
	echo "<username$i>$username</username$i>\n";
	echo "<t$i>$t</t$i>\n";
	echo "<ts$i>$ts</ts$i>\n";
}
echo "<count>$c</count>\n";
?>
</page>
