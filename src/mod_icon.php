<?php
define("INNER_ACCESS","1");
include_once("config.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login.php");
}
else
{
	$su->get_user_info_by_id();
	include_once("header.php");
}
 ?>
<div id="content">
	<div id="user_panel_title">
	修改头像
	</div>
	<div id="user_panel">
		<form method="post" action="<?php echo $host_name;?>/update_icon.php" name="mod_icon">
			<div id="user_panel_legend">
				<div>您现在的头像链接为</div>
				<div><br></div>
				<div>请输入您的新的头像链接</div>
			</div>
			<div id="user_panel_disp">
				<div><?php echo $su->icon;?></div>
				<div><br></div>
				<div><input name="icon_modify" type="text" /></div>
				<div><br></div>
				<div>
					<input type="submit" value="修改">
					<input type="reset" value="重填">
				</div>
			</div>
	</div>

              
<?php
include_once("footer.php");
?>
