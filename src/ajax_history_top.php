<?xml version="1.0" encoding="gb2312"?>
<?php
header('Content-Type: text/xml');
?>
<movies>
<?php
define("INNER_ACCESS","1");
include("db/config.php");	
$sql="select * from st_movie order by pop desc limit 0,10";
$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result))
{
	$vid=$row['vid'];
	$title=$row['title'];
	$desc=$row['description'];
	echo "<vid$i>$vid</vid$i>\n";
	echo "<title$i><![CDATA[$title]]></title$i>\n";
	echo "<desc$i><![CDATA[$desc]]></desc$i>\n";
	$i++;
}
?>
</movies>
