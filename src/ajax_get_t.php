<?xml version="1.0" encoding="gb2312"?>
<page>
<?php
header('Content-Type: text/xml');
define("INNER_ACCESS","1");
include_once("db/user.php");
include_once("db/config.php");
include_once("mblog.php");
$uid=$_GET["u"];
$p=$_GET['p'];

$smb=new st_mblog($uid);
$smb->get_mb_info();
$vpp=10;
	
$s=($p-1)*$vpp;
$sql="select * from st_mblog where uid=$uid order by tid desc limit $s,$vpp";
echo $sql;
$result=mysql_query($sql);
$c=0;

for($i=1;$i<=$vpp;$i++)
{
	if($row=mysql_fetch_array($result))
	{
		$uid=$row['uid'];
		$su=new st_user($uid,"","");
		$su->get_user_info_by_id();
		$username=$su->username;
		$img=$su->icon;
		$t=$row['t'];
		$ts=$row['ts'];
		$tid=$row['tid'];
		$c++;
	}
	else
	{
		$uid="";
		$username="";
		$t="";
		$ts="";
		$img="";
	}
	echo "<uid$i>$uid</uid$i>";
	echo "<username$i>$username</username$i>";
	echo "<img$i>$img</img$i>";
	echo "<t$i><![CDATA[$t]]></t$i>";
	echo "<ts$i>$ts</ts$i>";
	echo "<tid$i>$tid</tid$i>";
}
echo "<count>$c</count>";
?>
</page>
