<?xml version="1.0" encoding="gb2312"?>
<movie>
<rate>
<?php
header('Content-Type: text/xml');
include_once("config.php");
include_once("db/movie.php");
include_once("db/config.php");
	
$vid=$_GET['vid'];
$sm=new st_movie();
$sm->vid=$vid;
$sm->get_movie_info();
echo $sm->get_rate();
?>
</rate>
</movie>