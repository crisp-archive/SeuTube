<?php
define("INNER_ACCESS","1");
include_once("header.php");
include_once("db/movie.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=�û�δ��¼&text=�����¼&link=$host_name/login.php");
}
$vid=$_GET['vid'];
$sm=new st_movie();
$sm->vid=$vid;
$sm->get_movie_info();
?>
	<div id="content">
		<div id="fav_area">
		�޸���Ƶ��Ϣ
		</div>
		<div id="fav_area">
				<form name="file" enctype="multipart/form-data" action="<?php echo $host_name;?>/mod_movie_action.php" method="post">
					<div class="upload_item">
						<label for="title">��Ƶ����</label><br>
						<input name="title" type="text" size="42" value="<?php echo $sm->title; ?>"/>
					</div>
					<div class="upload_item">
						<label for="title">��Ƶ����</label><br>
						<textarea name="desc" rows="4" cols="40"><?php echo $sm->desc;?></textarea>
					</div>
					<div><input name="vid" type="hidden" value="<?php echo $sm->vid;?>"></div>
					<div><input name="submit" type="submit" value="ȷ���޸�"></div>
				</form>
		</div>
	</div>
<?php
include_once("footer.php");
?>
