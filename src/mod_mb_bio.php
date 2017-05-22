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
	header("Location:$host_name/redirect.php?msg=用户未登录&text=点这登录&link=$host_name/login");
}
else
{
	$su->get_user_info_by_id();
	include_once("header.php");
}
 ?>
<div id="content">
	<div id="user_panel_title">
	修改微博个人介绍
	</div>
	<div id="user_panel">
		<form method="post" action="<?php echo $host_name;?>/update_mb_bio.php">
			<div id="user_panel_legend">
				<div>您现在的个人介绍为</div>
				<div><br></div>
				<div>请输入您的新个人介绍</div>
			</div>
			<div id="user_panel_disp">
				<div><?php echo $su->mb_bio;?></div>
				<div><br></div>
				<div>
					<textarea name="mb_bio" type="text" cols="40" rows="3"></textarea>
				</div>
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
