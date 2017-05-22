<?xml version="1.0" encoding="gb2312"?>
<?php
header('Content-Type: text/xml');
?>
<movies>
<?php
define("INNER_ACCESS","1");
include_once("db/config.php");
$sql="select * from st_movie where to_days(now())-to_days(upload_ts)<=7 order by pop desc limit 0,10";
$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result))
{
	$vid=$row['vid'];
	$title=$row['title'];
	$desc=$row['description'];
	echo "<vid$i>$vid</vid$i>";
	echo "<title$i><![CDATA[$title]]></title$i>\n";
	echo "<desc$i><![CDATA[$desc]]></desc$i>\n";
	$i++;
}
?>
</movies>
