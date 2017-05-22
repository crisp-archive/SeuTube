<?php
define("INNER_ACCESS","1");
include_once("t_header.php");
include_once("mblog.php");
$uid=$_GET['u'];
$p=$_GET['p'];

if($u<=0 || $u==null)
	header("Location: index.php");

$sb=new st_mblog($uid);
$max=$sb->get_listened_num();
if($max%10==0)
	$mp = $max/10;
else
	$mp = (int)($max/10)+1;
if($p<=0 || $p>$mp || $p==null)
	$p=1;
$start=($p-1)*10;
?>
<div id="content">
<?php
$sql="select * from st_friends where uid=$uid order by fid limit $start,10";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
	$fuid=$row['fuid'];
	$smb=new st_mblog($fuid);
	$smb->get_mb_info();
	echo '<div id="mb_m">';
	echo '<div id="mb_icon">';
	echo "<img src=\"$smb->icon\" />&nbsp;";
	echo '</div>';
	echo '<div id="mb_name">';
	echo '<div id="mb_nm">';
	echo $smb->mb_name;
	echo '</div>';
	echo '<div id="mb_at">';
	echo "<a href=\"$host_name/t/u/$smb->uid\">@$smb->username</a>";
	echo '</div>';
	echo '<div id="mb_briefinfo">';
	$a=$smb->get_broadcast_num();
	$b=$smb->get_listener_num();
	$c=$smb->get_listened_num();
	echo "<div>广播 <a href=\"$host_name/t/broadcast/$fuid\">$a</a></div>";
	echo "<div>听众 <a href=\"$host_name/t/follower/$fuid\">$b</a></div>";
	echo "<div>收听 <a href=\"$host_name/t/following/$fuid\">$c</a></div>";
	echo '</div>';
	echo '</div>';
	echo '<div id="mb_m_right">';
	echo '<div id="mb_m_bio">';
	echo '<b>介绍:&nbsp;</b>';
	echo $smb->mb_bio;
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
?>
</div>
<div id="page_controller">
<?php
	$np=$p+1;
	$pp=$p-1;
	if($mp!=1)
	{
		if($p!=1)
			echo "<a href=\"$host_name/following.php?u=$uid&p=$pp\">上一页</a>";
		if($p!=$mp)
			echo "<a href=\"$host_name/following.php?u=$uid&p=$np\">下一页</a>";
	}
?>
</div>
<?php
include_once("footer.php");
?>