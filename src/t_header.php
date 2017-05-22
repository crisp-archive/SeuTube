<?php
// prevent outer access of some pages
include_once("config.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<?php echo $host_name;?>/style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo $host_name;?>/images/favicon.ico" type="image/x-icon" /> 
<link rel="shortcut icon" href="<?php echo $host_name;?>/images/favicon.ico" type="image/x-icon" />
<title>
SeuTube - 视频微博
</title>
</head>
<body>
<div id="mainframe">
	<div id="header">
		<span id="logo">
			<a href="<?php echo $host_name;?>"><img src="<?php echo $host_name;?>/images/logo.jpg" /></a>
		</span>
		<span id="navi">
			<div id="button">
		<?php
		include_once("db/user.php");
		$uid=$_COOKIE["uid"];
		$username=$_COOKIE["username"];
		$password=$_COOKIE["password"];
		$su=new st_user($uid,$username,$password);
		if(!$su->check_status())
		{
			header("Location:$host_name");
		}
		else
		{
			$su->get_user_info_by_id();
		}
		?>		
				<a href="<?php echo $host_name;?>">返回主页</a>
				<a href="<?php echo $host_name;?>/t/index">我的微博</a>
				<a href="<?php echo $host_name;?>/t/broadcast">广播大厅</a>
				<a href="<?php echo $host_name;?>/t/find">找人</a>
				<a href="<?php echo $host_name;?>/setting">设置</a>
			</div>
		</span>
	</div>
