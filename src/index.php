<?php
define("INNER_ACCESS","1");
include_once("db/config.php");
include_once("db/user.php");
include_once("header.php");
include_once("config.php");
$uid=$_COOKIE["uid"];
$su=new st_user($uid,$username,$password);
if($su->get_user_info_by_id()==0)
	$vpp=$su->video_per_page;
else
	$vpp=10;
$sql="select max(vid) from st_movie";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$max=$row['max(vid)'];
if($max%$vpp==0)
	$mp = $max/$vpp;
else
	$mp = (int)($max/$vpp)+1;

$p=$_GET['p'];
if(!isset($p)||$p==null||$p<=0||$p>$mp)
	$p=1;
$start=($p-1)*$vpp;
?>
<div id="content">
<?php
$sql="select * from st_movie order by vid desc limit $start,$vpp";
$result=mysql_query($sql);

while($row=mysql_fetch_array($result))
{
	$vid=$row['vid'];
	$uid=$row['uid'];
	$ts =$row['upload_ts'];
	$title =$row['title'];
	$desc =$row['description'];
	$pop =$row['pop'];
	
	$title=str_replace("'","'",$title);
	$title=str_replace("<","&lt;",$title);
	$title=str_replace(">","&gt;",$title);
	$desc=str_replace("'","'",$desc);
	$desc=str_replace("<","&lt;",$desc);
	$desc=str_replace(">","&gt;",$desc);
	
	$su->uid=$uid;
	$su->get_user_info_by_id();
	echo "<div id=\"video_obj\" class=\"video_obj\">\n";
	echo "<div id=\"preview\" class=\"video_preview\"><a href=\"$host_name/play/$vid\"><img src=\"$host_name/thumbs/t$vid.gif\"></a></div>\n";
	echo "<div class=\"video_content\">\n";
	echo "<div id=\"title\" class=\"video_title\"><a href=\"$host_name/play/$vid\">$title</a></div>\n";
	echo "<div id=\"tspop\" class=\"video_info\">$su->username 上传于$ts, $pop 观看</div>\n";
	echo "<div id=\"desc\" class=\"video_desc\">$desc</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

// add the page controllers
?>
</div>
<div id="page_controller">
<?php
	$np=$p+1;
	$pp=$p-1;
	if($mp!=1)
	{
		if($p!=1)
			echo "<a href=\"$host_name/index/$pp\">上一页</a>";
		if($p!=$mp)
			echo "<a href=\"$host_name/index/$np\">下一页</a>";
	}
?>
</div>
<?php include_once("footer.php"); ?>
