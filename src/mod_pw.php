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
	include_once("/header.php");
}
 ?>
<div id="content">
	<div id="user_panel_title">
	修改密码
	</div>
	<div id="user_panel">
		<form method="post" action="<?php echo $host_name;?>/update_pw.php" name="mod_pw">
			<div id="user_panel_legend">
				<div>请输入您的新密码</div>
				<div><br></div>
				<div>请确认您的新密码</div>
			</div>
			<div id="user_panel_disp">
				<div><input name="new_pw" type="password" /></div>
				<div><br></div>
				<div><input name="confirm_pw" type="password" /></div>
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


