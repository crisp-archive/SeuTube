<?php 
define("INNER_ACCESS","1");

include_once("config.php");
include_once("header.php");
include_once("db/user.php");
include_once("db/config.php");
include_once("mblog.php");

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
	$su->get_user_info_by_id();
	$smb=new st_mblog($uid);
	$smb->get_mb_info();
	echo '<div id="content">';
		
	echo '<div id="user_panel_title">';
	echo "<a href=\"$host_name/user/recent\">最近播放</a> ";
	echo "<a href=\"$host_name/user/movie\">我的视频</a> ";
	echo "<a href=\"$host_name/user/favorite\">我的收藏</a> ";
	echo "<a href=\"$host_name/t/index\">我的微博</a> ";
	echo "<a href=\"$host_name/upload.php\">上传视频</a> ";
	echo "<a href=\"$host_name/logoff\">退出登录</a>";
	echo '</div>';
		
	echo '<div id="user_panel">';
		
	echo '<div id="user_panel_legend">';
	echo '<div>用户名</div>';
	echo '<div>密码</div>';
	echo '<div>电子邮箱</div>';
	echo '<div>每页视频数</div>';
	echo '<div>注册时间</div>';
	echo '<div>微博名称</div>';
	echo '<div>每页微博数</div>';
	echo '<div>个人介绍</div>';
	echo "<div><br><br></div>";
	echo '<div>头像</div>';
	echo '</div>';
		
	echo '<div id="user_panel_button">';
	echo "<div><br></div>";
	echo "<div>[<a href=\"$host_name/setting/pass\">修改</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/email\">修改</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/vnum\">修改</a>]</div>";
	echo "<div><br></div>";
	echo "<div>[<a href=\"$host_name/setting/name\">修改</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/mnum\">修改</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/bio\">修改</a>]</div>";
	echo "<div><br><br></div>";
	echo "<div>[<a href=\"$host_name/setting/icon\">修改</a>]</div>";
	echo '</div>';
		
	echo '<div id="user_panel_disp">';
	echo "<div>$su->username</div>";
	echo "<div>******</div>";
	echo "<div>$su->email</div>";
	echo "<div>$su->video_per_page</div>";
	echo "<div>$su->ts</div>";
	echo "<div>$su->reg_date</div>";
	echo "<div>$smb->mb_name</div>";
	echo "<div>$smb->mb_num</div>";
	echo "<div id=\"user_panel_intro\">$smb->mb_bio</div>";
	echo "<div id=\"user_panel_img\"><a href=\"$su->icon\"><img src=\"$su->icon\" /></a></div>";
	echo '</div>';
	echo '</div>';
	echo '</div>';
		
	include_once("footer.php");
}
?>
