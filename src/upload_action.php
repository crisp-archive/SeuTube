<?php
include_once("config.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
define("INNER_ACCESS","1");
include_once("db/movie.php");
include_once("mblog.php");

if( $_FILES['file']['error']==0 )
{
	$sm=new st_movie();
	$sm->uid=$_COOKIE["uid"];
	$sm->title=str_replace("'","'",$_POST["title"]);
	$sm->desc=str_replace("'","'",$_POST["desc"]);
	$sm->tags=explode(" ",$_POST["tags"]);
	// set current vid
	$sql="select max(vid) from st_movie";
	$result = mysql_query($sql);
	if($row = mysql_fetch_array($result))
	{
		$vid=$row["max(vid)"];
		$sm->vid=$vid+1;
	}
	else
		$sm->vid=1;
	
	$vf = "video\\v$sm->vid.webm";
	$file_name_array = explode(".",$_FILES['file']['name']); 
	$ext = end($file_name_array);
	$in = "temp\\".time().".".$ext; 
	unlink($in);
	unlink($vf);
	move_uploaded_file(($_FILES['file']['tmp_name']), $in); 
	// convert to flv
	$cmd="bin\\ffmpeg.exe -i $in -ar 22050 -threads 2 $vf 2>&1";
	$fh = popen( $cmd, "r" );
	while( fgets( $fh ) ){}
	pclose($fh);
	$fs=filesize($vf);
	if($fs==false || $fs==0 || $fs==null)
	{
		unlink($vf);
		unlink($in);
		header("Location:$host_name/redirect.php?msg=$cmd 因为格式不支持导致转换失败!&text=返回上传&link=$host_name/upload.php");
	}
	else
	{
		if($sm->ss=="" || $sm->ss==null)
			$sm->ss="3";
		$tf = "thumbs\\t$sm->vid.gif";
		unlink($tf);
		$cmd = "bin\\ffmpeg.exe -i $in -ss 1 -pix_fmt rgb24 -vframes 1 -s 480x320 $tf 2>&1";
		$fh = popen( $cmd, "r" );
		while( fgets( $fh ) ) { }
		pclose($fh);
		unlink($in);
		$sm->add_movie();
		$smb=new st_mblog($sm->uid);
		$smb->post("上传了视频$sm->title, <a href=\"$host_name/play/$sm->vid\">欢迎观看</a>");
		header("Location:$host_name/redirect.php?msg=上传并转换成功!&text=进入视频播放页&link=$host_name/play/$sm->vid");
	}
}
else
{
	$error="上传错误！错误代码：".$_FILES['file']['error'];
	header("Location:$host_name/redirect.php?msg=$error&text=返回上传&link=$host_name/upload.php");
}
?>