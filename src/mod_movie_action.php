<?php
define("INNER_ACCESS","1");	
include_once("config.php");
include_once("db/movie.php");
include_once("db/user.php");
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
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$vid=$_POST['vid'];
	
	$e=0;
	
	if(strlen($title)==0)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=���ⲻ��Ϊ�գ�&text=���������޸�&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($desc)==0)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=��������Ϊ�գ�&text=���������޸�&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($title)>140)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=���ⲻ�ɳ���140���ַ���&text=���������޸�&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(strlen($desc)>140)
	{
		$e=1;
		header("Location:$host_name/redirect.php?msg=�������ɳ���140���ַ���&text=���������޸�&link=$host_name/mod_movie.php?vid=$vid");
	}
	if(!$e)
	{
		$sql="update st_movie set title='$title',description='$desc' where vid=$vid and uid=$uid";
		$result=mysql_query($sql);
		if($result)
			header("Location:$host_name/redirect.php?msg=�޸ĳɹ�&text=�����ҵ���Ƶ&link=$host_name/user/movie");
		else
			header("Location:$host_name/redirect.php?msg=�޸�ʧ��&text=�����ҵ���Ƶ&link=$host_name/user/movie");
	}
}
?>