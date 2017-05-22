<?php
define("INNER_ACCESS","1");
include_once("header.php");
include_once("config.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$page=$_GET['page'];
if($page==null || $page=="")
	$page=1;
	
$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login");
}
else
{
	$count=0;
	$sql="select count(*) from st_favs where uid=$uid";
	$result=mysql_query($sql);
	if($row=mysql_fetch_array($result))
		$count=$row['count(*)'];
	echo '<div id="content>">';
	if( $count!=0)
	{
		
		if($count%15)
			$tp=$count/15;
		else
			$tp=$count/15+1;
		
		$start=($page-1)*15;
		$sql="select st_movie.vid,st_movie.title,st_favs.fid from st_movie,st_favs where st_favs.uid=$uid and st_favs.vid=st_movie.vid order by st_favs.fid desc limit $start,15";
		$result=mysql_query($sql);
		echo '<div id="fav_area">';
		echo "我的收藏($count)";
		echo '</div>';
		
		echo '<div id="fav_area">';
		while($row=mysql_fetch_array($result))
		{
			$title=$row['title'];
			$vid=$row['vid'];
			$fid=$row['fid'];
			echo '<div class="fav_obj">';
			echo "<a href=\"$host_name/play/$vid\">$title</a>[<a href=\"$host_name/del_fav.php?fid=$fid\">删除</a>]";
			echo '</div>';
		}
		echo '</div>';
		echo '<div id="page_ctrl">';
		if($page!=1)
		{
			$a=$page-1;
			echo "<a href=\"$host_name/user/favorite/$a\">上一页</a>";
		}
		if($page<$tp)
		{
			$a=$page+1;
			echo "<a href=\"$host_name/user/favorite/$a\">下一页</a>";
		}
		echo '</div>';
	}
	else
	{
		echo '<div id="fav_area">';
		echo "没有收藏";
		echo '</div>';
	}
	echo '</div>';
	include_once("footer.php");
}
?>