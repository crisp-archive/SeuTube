<?php
define("INNER_ACCESS","1");
include_once("config.php");
include_once("t_header.php");
include_once("db/config.php");
include_once("mblog.php");
$uid=$_GET["u"];
?>
<div id="content">
	<div id="loading">
		<img src="<?php echo $host_name;?>/images/loading.gif" alt="" />
	</div>
<?php
for($i=1;$i<=10;$i++)
{
	echo "<div id=\"mb$i\" class=\"mb_obj\">\n";
	echo "<div id=\"tid$i\" class=\"mb_tid\"></div>\n";
	echo "<div id=\"icon$i\" class=\"mb_t_icon\"></div>\n";
	echo "<div id=\"mbut$i\" class=\"mb_t_ut\">\n";
	echo "<div id=\"u$i\" class=\"mb_t_name\"></div>\n";
	echo "<div id=\"t$i\" class=\"mb_t_text\"></div>\n";
	echo "</div>\n";
	echo "<div id=\"ts$i\" class=\"mb_t_optime\"></div>\n";
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
	var url="<?php echo $host_name;?>/ajax_get_t.php?u="+<?php echo $uid; ?>+"&p="+page+"&rand="+parseInt(Math.random()*10000000);
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
				var tid=http.responseXML.getElementsByTagName("tid"+i)[0].firstChild.nodeValue;
				c=document.getElementById("tid"+i);
				c.innerHTML=tid;
				c=document.getElementById("icon"+i);
				c.innerHTML="<img src=\""+img+"\">";
				c=document.getElementById("u"+i);
				c.innerHTML="<a href=\"<?php echo $host_name;?>/t/u/"+uid+"\">"+username+"</a>";
				c=document.getElementById("t"+i);
				c.innerHTML=t;
				c=document.getElementById("ts"+i);
				c.innerHTML=ts;
				c.innerHTML+="<div><a href=\"javascript:drop("+i+");\">删除</a></div>";
				<?php
				$cur_uid=$_COOKIE["uid"];
				if($uid!=$cur_uid)
				{
					echo "c.style.display=\"none\";";
				}
				?>
			}
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}

function drop(i)
{
	if(confirm("确认删除这条微博?"))
	{
		var tid=document.getElementById("tid"+i).innerHTML;
		var url="<?php echo $host_name;?>/ajax_delete_t.php?tid="+tid+"&rand="+parseInt(Math.random()*10000000);
		http.open("GET",url,true);
		http.onreadystatechange=showDelete;
		http.send(null);
	}
}

function showDelete()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var result=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(result==1)
				alert("删除成功!");
			else
				alert("删除失败!");
			show();
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