<?php
define("INNER_ACCESS","1");
include_once("t_header.php");
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
	header("Location:$host_name");
?>
<div id="content">
	<div id="loading">
		<img src="<?php echo $host_name;?>/images/loading.gif" alt="" />
	</div>
<?php
for($i=1;$i<=$smb->mb_num;$i++)
{
	echo "<div id=\"mb$i\" class=\"mb_obj\">";
	echo "<div id=\"icon$i\" class=\"mb_t_icon\"></div>";
	echo "<div id=\"mbut$i\" class=\"mb_t_ut\">";
	echo "<div id=\"u$i\" class=\"mb_t_name\"></div>";
	echo "<div id=\"t$i\" class=\"mb_t_text\"></div>";
	echo "</div>";
	echo "<div id=\"ts$i\" class=\"mb_t_optime\"></div>";
	echo "</div>";
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
var vpp=10;
var http=getXMLHttp();
document.onload=init();
	
function init()
{
	show();
	document.getElementById("loading").style.display="none";
}

function show()
{
	var url="<?php echo $host_name;?>/ajax_getall.php?p="+page+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showPage;
	http.send(null);
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
				c=document.getElementById("icon"+i);
				c.innerHTML="<img src=\""+img+"\">";
				c=document.getElementById("u"+i);
				c.innerHTML="<a href=\"<?php echo $host_name;?>/t/u/"+uid+"\">"+username+"</a>";
				c=document.getElementById("t"+i);
				c.innerHTML=t;
				c=document.getElementById("ts"+i);
				c.innerHTML=ts;
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
	page++;
	show();
	self.scrollTo(0,0);
}

</script>
<?php
include_once("footer.php");
?>