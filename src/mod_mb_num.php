<?php
define("INNER_ACCESS","1");
include_once("config.php");
include_once("db/user.php");
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
	include_once("header.php");
	$smb=new st_mblog($uid);
	$smb->get_mb_info();
}
 ?>
<div id="content">
	<div id="user_panel_title">
	修改每页微博数
	</div>
	<div id="user_panel">
		<form method="post" action="<?php echo $host_name;?>/update_mb_num.php">
			<div id="user_panel_legend">
				<div>您现在的每页微博数</div>
				<div><br></div>
				<div>您偏爱的每页微博数</div>
			</div>
			<div id="user_panel_disp">
				<div><?php echo $smb->mb_num;?></div>
				<div><br></div>
				<div>
					<select name="mb_num">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
					</select>
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
