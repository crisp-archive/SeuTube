<?php
include_once("config.php");
include_once("db/config.php");
include_once("db/user.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$fid=$_GET['fid'];
if($fid==null || $fid=="")
	$fid=1;

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:$host_name/redirect.php?msg=�û�δ��¼&text=�����¼&link=$host_name/login.php");
}
else
{
	$sql="delete from st_favs where fid=$fid and uid=$uid";
	$result=mysql_query($sql);
	echo $sql;
	if($result==1)
		header("Location:$host_name/redirect.php?msg=ɾ���ɹ�&text=�����ҵ��ղ�&link=$host_name/my_fav.php");
	else
		header("Location:$host_name/redirect.php?msg=�����ˣ�&text=�����ҵ��ղ�&link=$host_name/my_fav.php");
}
?>
