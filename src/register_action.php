<?php 
session_start();
define("INNER_ACCESS","1");
include_once("config.php");
include_once("db/user.php");

$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$email    = $_POST['email'];
$check	  = $_POST['checkcode'];

$is_error=0;
$desc="����<br>";

// first test whether fill all the bla
if ($email == "")
{
	$is_error=1;
	$desc=$desc."�������䲻��Ϊ��<br>";
}
if ($check == "")
{
	$is_error=1;
	$desc=$desc."��֤�벻��Ϊ��<br>";
}
// test its size
if (strlen($password) > 16 || strlen($password)<6)
{
	$is_error=1;
	$desc=$desc."����Ҫ��6-16λ֮�䣡<br>";
}
if (strlen($username) < 5 || strlen($username) > 16)
{
	$is_error=1;
	$desc=$desc."�û���Ҫ��5-16λ֮�䣡<br>";
}

if ($password != $confirmpassword)
{
	$is_error=1;
	$desc=$desc."���벻һ�£�<br>";
}
if ($check != $_SESSION[check_pic])
{
	$is_error=1;
	$desc=$desc."��֤���������<br>";
}
// then check wheter it legal
$unchars = "^[A-Za-z_-]";
if(!ereg("$unchars",$username))
{
	$is_error=1;
	$desc=$desc."�û��������Ƿ��ַ�<br>";
}
$pwchars = "^[A-Za-z0-9_-]";
if(!ereg("$pwchars",$password))
{
	$is_error=1;
	$desc=$desc."��������Ƿ��ַ�<br>";
}
$emchars="^[[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-\.]+$";
if(!ereg("$emchars",$email))
{
	$is_error=1;
	$desc=$desc."��Чemail��ַ<br>";
}

if($is_error==1)
{
	header("Location:$host_name/redirect.php?msg=$desc&text=����ע��ҳ��&link=$host_name/register.php");
}
else
{
	$su=new st_user(0,$username,md5($password));
	$su->email=$email;
	$su->mb_name=$username;
	$su->mb_bio="nothing";
	if(!$su->is_name_exist())
		header("Location:$host_name/redirect.php?msg=�û����ѱ�������ע��!&text=����ע��ҳ��&link=$host_name/register.php");
	else
	{
		if($su->register_user())
		{
			$su->login();
			header("Location:$host_name/redirect.php?msg=ע��ɹ�!ϵͳ���Զ���¼&text=������ҳ&link=$host_name/index.php");
		}
		else
		{  
			header("Location:$host_name/redirect.php?msg=ע��ʧ��!&text=����ע��ҳ��&link=$host_name/register.php");
		}
	}
}
?>