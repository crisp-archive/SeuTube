<?php
define("INNER_ACCESS","1");
include_once("t_header.php");
include_once("config.php");
include_once("db/user.php");
include_once("db/config.php");
include_once("mblog.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$su=new st_user($uid,$username,$password);
if($su->check_status())
{
	$su->get_user_info_by_id();
	$smb=new st_mblog($uid);
	$smb->get_mb_info();
}
else
	header("Location:$host_name;");
?>
	<div id="content">
		<div id="loading">
			<img src="<?php echo $host_name;?>/images/loading.gif" alt="" />
		</div>
		<div id="mb_nav">
			<div id="mb_nleft">
				<div id="mb_head">
				说点什么？
				<input id="mb_bc" type="button" value="发布" onClick="post();">
				[<a href="<?php echo $host_name."/url/short";?>" target="_blank">短网址</a>]
				</div>
				<div id="mb_input">
					<textarea onkeydown="count();" onkeypress="count();" onkeyup="count();" id="inputarea" name="bc_text" type="text" cols="35" rows="4"></textarea>
				</div>
				<div id="mb_count">
				</div>
			</div>
			<div id="mb_user">
				<div id="mb_name_icon">
					<div id="mb_name">
						<div id="mb_nm">
							<?php echo $smb->mb_name; ?>
						</div>
						<div id="mb_at">
							<a href="<?php echo $host_name;?>/t/u/<?php echo $smb->uid; ?>">@<?php echo $su->username; ?></a>
						</div>
						<div id="mb_briefinfo">
							<div>广播 <a href="<?php echo $host_name;?>/t/broadcast/<?php echo $uid;?>"><?php echo $smb->get_post_num(); ?></a></div>
							<div>听众 <a href="<?php echo $host_name;?>/t/follower/<?php echo $uid;?>"><?php echo $smb->get_listener_num(); ?></a></div>
							<div>收听 <a href="<?php echo $host_name;?>/t/following/<?php echo $uid;?>"><?php echo $smb->get_listened_num(); ?></a></div>
						</div>
					</div>
					<div id="mb_icon">
						<img src="<?php echo $smb->icon; ?>" />
					</div>
				</div>
				<div id="mb_bio">
					<b>介绍:</b>
					<?php echo $smb->mb_bio; ?>
				</div>
			</div>
		</div>
<?php
for($i=1;$i<=$smb->mb_num;$i++)
{
	echo "<div id=\"mb$i\" class=\"mb_obj\">\n";
	echo "<div id=\"icon$i\" class=\"mb_t_icon\"></div>\n";
	echo "<div id=\"mbut$i\" class=\"mb_t_ut\">\n";
	echo "<div id=\"u$i\" class=\"mb_t_name\"></div>\n";
	echo "<div id=\"t$i\" class=\"mb_t_text\"></div>\n";
	echo "</div>\n";
	echo "<div id=\"opts$i\" class=\"mb_t_optime\">\n";
	echo "<div id=\"ts$i\"></div>\n";
	echo "<div id=\"op$i\"></div>\n";
	echo "</div>\n";
	echo "</div>\n";
}
?>
	</div>
	<div id="page_ctrl">
		<input class="button" type="button" value="首页" onClick="homepage();" />
		<input class="button" type="button" value="上一页" onClick="prevpage();" />
		<input class="button" type="button" value="下一页" onClick="nextpage();" />
		<input class="button" type="button" value="顶端" onClick="self.scrollTo(0,0);" />
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

var page=1;
var vpp=<?php echo $smb->mb_num; ?>;
var maxpage=<?php
if($smb->get_broadcast_num()%$smb->mb_num==0) 
	echo (int)($smb->get_broadcast_num()/$smb->mb_num);
else
	echo (int)($smb->get_broadcast_num()/$smb->mb_num)+1;
?>;
var http=getXMLHttp();
document.onload=init();

function count()
{
	var max=140;
	var s=document.getElementById("inputarea").value.length;
	document.getElementById("mb_count").innerHTML="还能输入"+(140-s)+"字";
	if(s==0)
		document.getElementById("mb_bc").disabled=true;
	else
		document.getElementById("mb_bc").disabled=false;
	
	if(s>140)
	{
		document.getElementById("mb_count").innerHTML="已经超过字数限制，超过部分将不会被显示!";
	}
}
	
function init()
{
	count();
	show();
	document.getElementById("loading").style.display="none";
}

function show()
{
	var url="<?php echo $host_name;?>/ajax_get.php?u="+<?php echo $uid; ?>+"&p="+page+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showPage;
	http.send(null);
}

function reply(username)
{
	document.getElementById("inputarea").value="To:@"+username+" ";
	count();
	self.scrollTo(0,0);
}

function repost(username,t)
{
	document.getElementById("inputarea").value="Re:@"+username+" "+t;
	count();
	self.scrollTo(0,0);
}

function post()
{
	var text=document.getElementById("inputarea").value;
	document.getElementById("inputarea").value="";
	var url="<?php echo $host_name;?>/ajax_post.php?t="+text+"&rand="+parseInt(Math.random()*10000000);
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
				show();
			}
			else
				alert("发布失败！请重试或联系管理员。");
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}
	
function showPage()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var count=http.responseXML.getElementsByTagName("count")[0].firstChild.nodeValue;
			for(i=1;i<=vpp;i++)
			{
				if(i<=count)
					document.getElementById("mb"+i).style.display="block";
				else
					document.getElementById("mb"+i).style.display="none";
			}
			var i;
			for(i=1;i<=vpp;i++)
			{
				var img=http.responseXML.getElementsByTagName("img"+i)[0].firstChild.nodeValue;
				var uid=http.responseXML.getElementsByTagName("uid"+i)[0].firstChild.nodeValue;
				var username=http.responseXML.getElementsByTagName("username"+i)[0].firstChild.nodeValue;
				var t=http.responseXML.getElementsByTagName("t"+i)[0].firstChild.nodeValue;
				var ts=http.responseXML.getElementsByTagName("ts"+i)[0].firstChild.nodeValue;
				var tid=http.responseXML.getElementsByTagName("tid"+i)[0].firstChild.nodeValue;
				c=document.getElementById("icon"+i);
				c.innerHTML="<img src=\""+img+"\">";
				c=document.getElementById("u"+i);
				c.innerHTML="<a href=\"<?php echo $host_name;?>/t/u/"+uid+"\">"+username+"</a>";
				c=document.getElementById("t"+i);
				c.innerHTML=t;
				c=document.getElementById("ts"+i);
				c.innerHTML=ts;
				c=document.getElementById("op"+i);
				c.innerHTML="<a href=\"javascript:repost('"+username+"','"+escape(t)+"');\">转发</a>&nbsp;<a href=\"javascript:reply('"+username+"');\">回复</a>";
			}
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}

function homepage()
{
	page=1;
	show();
	self.scrollTo(0,0);
}

function prevpage()
{
	if(page>1)
	{
		page--;
		show();
		self.scrollTo(0,0);
	}
}

function nextpage()
{
	if(page<maxpage)
	{
		page++;
		show();
		self.scrollTo(0,0);
	}
}

</script>
<?php
include("footer.php");
?>