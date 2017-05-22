<?xml version="1.0" encoding="gb2312"?>
<response>
<url>
<?php
header('Content-Type: text/xml');
$url=$_GET["url"];
include_once("db/config.php");
include_once("config.php");
$sql="select max(uid) from st_url";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$max=$row["max(uid)"];
$max+=1;
$hex=dechex($max);
$len=strlen($hex);
if($len<6)
{
	for($i=0;$i<6-$len;$i++)
		$fix.="0";
	$fix.=$hex;
}
echo $host_name."/url/".$fix."\n";
?>
</url>
<result>
<?php
if(ereg("((http|https|ftp|telnet|news):\/\/)?([a-z0-9_\-\/\.]+\.[][a-z0-9:;&#@=_~%\?\/\.\,\+\-]+)",$url))
{
	$sql="insert into st_url values(0,'$url')";
	$result=mysql_query($sql);
	echo $result."\n";
}
else
	echo "0\n";
?>
</result>
</response>