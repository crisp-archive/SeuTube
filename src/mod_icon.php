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
	header("Location:$host_name/redirect.php?msg=�û�δ��¼&text=�����¼&link=$host_name/login.php");
}
else
{
	$su->get_user_info_by_id();
	include_once("header.php");
}
 ?>
<div id="content">
	<div id="user_panel_title">
	�޸�ͷ��
	</div>
	<div id="user_panel">
		<form method="post" action="<?php echo $host_name;?>/update_icon.php" name="mod_icon">
			<div id="user_panel_legend">
				<div>�����ڵ�ͷ������Ϊ</div>
				<div><br></div>
				<div>�����������µ�ͷ������</div>
			</div>
			<div id="user_panel_disp">
				<div><?php echo $su->icon;?></div>
				<div><br></div>
				<div><input name="icon_modify" type="text" /></div>
				<div><br></div>
				<div>
					<input type="submit" value="�޸�">
					<input type="reset" value="����">
				</div>
			</div>
	</div>

              
<?php
include_once("footer.php");
?>
