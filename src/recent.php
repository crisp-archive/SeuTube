<?php
define("INNER_ACCESS","1");
include_once("header.php");
include_once("db/config.php");
include_once("db/movie.php");
include_once("config.php");
?>
<div id="content">
	<div id="about_content">
		<b>最近播放</b>
	</div>
	<div id="about_content">
	<?php
	$uid=$_COOKIE["uid"];
	$username=$_COOKIE["username"];
	$password=$_COOKIE["password"];
	$su=new st_user($uid,$username,$password);
	if(!$su->check_status())
	{
		header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login");
	}
	else
	{
		$sql="select * from st_recent where uid=$su->uid";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		for($i=0;$i<10;$i++)
		{
			if($row["v$i"]!=0)
			{
				echo "<div>";
				$sm=new st_movie();
				$sm->vid=$row["v$i"];
				$sm->get_movie_info();
				echo "<a href=\"$host_name/play/$sm->vid\">$sm->title</a>";
				echo "</div>";
			}
		}
	}
	?>
	</div>
</div>
<?php
include_once("footer.php");
?>