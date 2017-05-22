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
$desc="错误！<br>";

// first test whether fill all the bla
if ($email == "")
{
	$is_error=1;
	$desc=$desc."电子邮箱不能为空<br>";
}
if ($check == "")
{
	$is_error=1;
	$desc=$desc."验证码不能为空<br>";
}
// test its size
if (strlen($password) > 16 || strlen($password)<6)
{
	$is_error=1;
	$desc=$desc."密码要在6-16位之间！<br>";
}
if (strlen($username) < 5 || strlen($username) > 16)
{
	$is_error=1;
	$desc=$desc."用户名要在5-16位之间！<br>";
}

if ($password != $confirmpassword)
{
	$is_error=1;
	$desc=$desc."密码不一致！<br>";
}
if ($check != $_SESSION[check_pic])
{
	$is_error=1;
	$desc=$desc."验证码输入错误！<br>";
}
// then check wheter it legal
$unchars = "^[A-Za-z_-]";
if(!ereg("$unchars",$username))
{
	$is_error=1;
	$desc=$desc."用户名包含非法字符<br>";
}
$pwchars = "^[A-Za-z0-9_-]";
if(!ereg("$pwchars",$password))
{
	$is_error=1;
	$desc=$desc."密码包含非法字符<br>";
}
$emchars="^[[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-\.]+$";
if(!ereg("$emchars",$email))
{
	$is_error=1;
	$desc=$desc."无效email地址<br>";
}

if($is_error==1)
{
	header("Location:$host_name/redirect.php?msg=$desc&text=返回注册页面&link=$host_name/register.php");
}
else
{
	$su=new st_user(0,$username,md5($password));
	$su->email=$email;
	$su->mb_name=$username;
	$su->mb_bio="nothing";
	if(!$su->is_name_exist())
		header("Location:$host_name/redirect.php?msg=用户名已被其他人注册!&text=返回注册页面&link=$host_name/register.php");
	else
	{
		if($su->register_user())
		{
			$su->login();
			header("Location:$host_name/redirect.php?msg=注册成功!系统会自动登录&text=返回主页&link=$host_name/index.php");
		}
		else
		{  
			header("Location:$host_name/redirect.php?msg=注册失败!&text=返回注册页面&link=$host_name/register.php");
		}
	}
}
?>