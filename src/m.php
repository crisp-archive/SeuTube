<?php
define("INNER_ACCESS","1");
include_once("config.php");
include_once("t_header.php");
include_once("db/user.php");
include_once("mblog.php");
$uid=$_GET['u'];
$curuid=$_COOKIE['uid'];
$smb=new st_mblog($uid);
$smb->get_mb_info();
?>
<div id="content">
	<div id="loading">
		<img src="<?php echo $host_name;?>/images/loading.gif" alt="" />
	</div>
	<div id="mb_m">
		<div id="mb_icon">
			<img src="<?php echo $smb->icon; ?>" />&nbsp;
		</div>
		<div id="mb_name">
			<div id="mb_nm">
				<?php echo $smb->mb_name; ?>
			</div>
			<div id="mb_at">
				<a href="<?php echo $host_name;?>/t/u/<?php echo $smb->uid; ?>">@<?php echo $smb->username; ?></a>
			</div>
			<div id="mb_briefinfo">
				<div>广播 <a href="<?php echo $host_name;?>/t/broadcast/<?php echo $uid;?>"><?php echo $smb->get_post_num(); ?></a></div>
				<div>听众 <a href="<?php echo $host_name;?>/t/follower/<?php echo $uid;?>"><?php echo $smb->get_listener_num(); ?></a></div>
				<div>收听 <a href="<?php echo $host_name;?>/t/following/<?php echo $uid;?>"><?php echo $smb->get_listened_num(); ?></a></div>
			</div>
		</div>
		<div id="mb_m_right">
			<div id="mb_m_bio">
				<b>介绍:&nbsp;</b>
				<?php echo $smb->mb_bio; ?>
			</div>
			<?php
			if($uid!=$curuid)
			{
				echo '<div id="mb_listen">';		
				echo '<input id="unlisten" name="unlisten" type="button" value="取消收听" onClick="unmake();">';
				echo '<input id="listen" name="listen" type="button" value="收听" onClick="make();">';
				echo '</div>';
			}
			?>
		</div>
	</div>
</div>
<script language="javascript">
function getXMLHttp()
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("您的浏览器不支持AJAX！");
				return false;
			}
		}
    }
	return xmlHttp;
}

var http=getXMLHttp();
var nowop=<?php
if($smb->is_friends($curuid,$uid))
	echo '0';
else
	echo '1';
?>;

document.onload=change();

function change()
{
	document.getElementById("loading").style.display="none";
	if(nowop==0)
	{
		document.getElementById("listen").style.display="none";
		document.getElementById("unlisten").style.display="block";
	}
	else
	{
		document.getElementById("listen").style.display="block";
		document.getElementById("unlisten").style.display="none";
	}
}

function make()
{
	var url="<?php echo $host_name;?>/ajax_friend.php?op=1&u=<?php echo $curuid;?>&f=<?php echo $uid;?>&rand="+parseInt(Math.random()*10000000);
	nowop=0;
	http.open("GET",url,true);
	http.onreadystatechange=showResult;
	http.send(null);
}

function unmake()
{
	var url="<?php echo $host_name;?>/ajax_friend.php?op=0&u=<?php echo $curuid;?>&f=<?php echo $uid;?>&rand="+parseInt(Math.random()*10000000);
	nowop=1;
	http.open("GET",url,true);
	http.onreadystatechange=showResult;
	http.send(null);
}

function showResult()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var result=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(result==1)
			{
				change();
			}
			else
				alert("操作失败！请重试或联系管理员。");
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}
	
</script>
<?php
include_once("footer.php");
?>