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
	header("Location:$host_name/redirect.php?msg=�û�δ��¼&text=�����¼&link=$host_name/login");
}
else
{
	$su->get_user_info_by_id();
	$smb=new st_mblog($uid);
	$smb->get_mb_info();
	echo '<div id="content">';
		
	echo '<div id="user_panel_title">';
	echo "<a href=\"$host_name/user/recent\">�������</a> ";
	echo "<a href=\"$host_name/user/movie\">�ҵ���Ƶ</a> ";
	echo "<a href=\"$host_name/user/favorite\">�ҵ��ղ�</a> ";
	echo "<a href=\"$host_name/t/index\">�ҵ�΢��</a> ";
	echo "<a href=\"$host_name/upload.php\">�ϴ���Ƶ</a> ";
	echo "<a href=\"$host_name/logoff\">�˳���¼</a>";
	echo '</div>';
		
	echo '<div id="user_panel">';
		
	echo '<div id="user_panel_legend">';
	echo '<div>�û���</div>';
	echo '<div>����</div>';
	echo '<div>��������</div>';
	echo '<div>ÿҳ��Ƶ��</div>';
	echo '<div>ע��ʱ��</div>';
	echo '<div>΢������</div>';
	echo '<div>ÿҳ΢����</div>';
	echo '<div>���˽���</div>';
	echo "<div><br><br></div>";
	echo '<div>ͷ��</div>';
	echo '</div>';
		
	echo '<div id="user_panel_button">';
	echo "<div><br></div>";
	echo "<div>[<a href=\"$host_name/setting/pass\">�޸�</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/email\">�޸�</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/vnum\">�޸�</a>]</div>";
	echo "<div><br></div>";
	echo "<div>[<a href=\"$host_name/setting/name\">�޸�</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/mnum\">�޸�</a>]</div>";
	echo "<div>[<a href=\"$host_name/setting/bio\">�޸�</a>]</div>";
	echo "<div><br><br></div>";
	echo "<div>[<a href=\"$host_name/setting/icon\">�޸�</a>]</div>";
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
