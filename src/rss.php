<?xml version="1.0" encoding="gbk"?> 
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/"
>
<channel> 
<?php
include_once("config.php");
include_once("db/movie.php");
?>
<title>SeuTube最新视频</title> 
<link><?php echo $host_name;?></link>
<description>SeuTube最新上传视频</description>
<language>zh-cn</language> 
<copyright>&copy; 2010, SeuTube.com.</copyright>
<pubDate><?php echo date("D, d M Y H:i:s")." GMT"; ?></pubDate>
<lastBuildDate><?php echo date("D, d M Y H:i:s")." GMT"; ?></lastBuildDate>
<?php
$sql="select max(DATE_FORMAT(upload_ts,'%Y-%m-%d')) from st_movie";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$date=$row["max(DATE_FORMAT(upload_ts,'%Y-%m-%d'))"];
$sql="select * from st_movie where DATE_FORMAT(upload_ts,'%Y-%m-%d')='$date'";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{
	echo "<item id=\"$c\">\n";
	$t=$row['title'];
	$d=$row['description'];
	$vid=$row['vid'];
	$ts=$row['upload_ts'];
	echo "<title><![CDATA[$t]]></title>\n";
	echo "<description><![CDATA[$d]]></description>\n";
	echo "<link>$host_name/play/$vid</link>\n";
	echo "<pubData>$ts</pubData>\n";
	echo "</item>\n";
	$c++;
}
?>
</channel>
</rss>