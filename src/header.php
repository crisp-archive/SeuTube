<?php
// prevent outer access of some pages
include_once("config.php");
include_once("db/user.php");
include_once("db/config.php");

if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="gb2312">
<link href="<?php echo $host_name; ?>/style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="<?php echo $host_name; ?>/images/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="<?php echo $host_name; ?>/images/favicon.ico" type="image/x-icon"/>
<title>
SeuTube|Next Generation Video Share
</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19525109-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="mainframe">
	<div id="header">
		<span id="logo">
			<a href="<?php echo $host_name; ?>"><img src="<?php echo $host_name; ?>/images/logo.jpg" alt="SeuTube Logo"/></a>
		</span>
		<span id="navi">
			<div id="button">
				<span class="menu_item"><a href="<?php echo $host_name; ?>">主页</a></span>
				<span class="menu_item"><a href="<?php echo $host_name; ?>/have_a_look">随便看看</a></span>
				<span class="menu_item"><a href="<?php echo $host_name; ?>/search">搜索</a></span>
		<?php
		$uid=$_COOKIE["uid"];
		$username=$_COOKIE["username"];
		$password=$_COOKIE["password"];
		$su=new st_user($uid,$username,$password);
		if($su->check_status())
		{
			echo '<span class="menu_item">';
			echo "<a href=\"$host_name/t/index\">微博</a></span>";
			echo '<span class="menu_item">';
			echo "<a href=\"$host_name/setting\">$username</a></span>";
			$su->get_user_info_by_id();
			$vpp=$su->video_per_page;
			echo '<span class="menu_item">';
			echo "<a href=\"$host_name/logoff\">退出</a></span>";
		}
		else
		{
			echo '<span class="menu_item">';
			echo "<a href=\"$host_name/login\">登录</a></span>";
			echo '<span class="menu_item">';
			echo "<a href=\"$host_name/register\">注册</a></span>";
			$vpp=10;
		}
		?>	
			<span id="menu_rss"><input type="button" id="menu_rss" value="RSS" onclick="window.location.href='<?php echo $host_name; ?>/rss';" /></span>
			</div>
		</span>
	</div>
