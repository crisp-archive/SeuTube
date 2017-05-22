<?php
define("INNER_ACCESS","1");
include_once("config.php");
include_once("db/config.php");
while(1)
{
	$sql="select * from st_movie order by rand() limit 1";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	if($rn=$row['vid'])
	{
		header("Location:$host_name/play/$rn");
		break;
	}
	else
		continue;
}
?>