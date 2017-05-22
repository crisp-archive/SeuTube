<?php
define("INNER_ACCESS","1");
include("$host_name/header.php");
?>
<div id="content">
	<div id="hal">
		<div id="hal_menu_list">
			<div id="hal_menu">
				<div class="hal_button">
					<input type="button" value="随机播放" class="hal_button" onclick="window.location.href='randomplay.php';" />
					<input type="button" value="本周人气" id="hal_button1" onmouseover="change_style(1)" />
					<input type="button" value="本月人气" id="hal_button2" onmouseover="change_style(2)" />
					<input type="button" value="历史人气" id="hal_button3" onmouseover="change_style(3)" />
				</div>
			</div>
			<div id="hal_list">
				<?php
				for($i=0;$i<10;$i++)
				{
					echo "<div id=\"hal_list_item$i\" class=\"hal_list_item\" onclick=\"play($i);\" onmouseover=\"preview($i);\" ></div>\n";
					echo "<div id=\"hal_vid$i\" class=\"hal_vid\"></div>\n";
					echo "<div id=\"hal_desc$i\" class=\"hal_desc\"></div>\n";
				}
				?>
			</div>
		</div>
		<div id="hal_preview">
			<div id="hal_title">
			</div>
			<div id="hal_img">
			</div>
			<div id="hal_desc">
			</div>
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
document.onload=init();

function init()
{
	change_style(1);	
}

function play(i)
{
	vid=document.getElementById("hal_vid"+i).innerHTML;
	window.location.href="<?php echo $host_name;?>/play/"+vid;
}

function preview(i)
{
	title=document.getElementById("hal_list_item"+i).innerHTML;
	document.getElementById("hal_title").innerHTML=title;
	vid=document.getElementById("hal_vid"+i).innerHTML;
	desc=document.getElementById("hal_desc"+i).innerHTML;
	document.getElementById("hal_img").innerHTML="<a href=\"player.php?vid="+vid+"\"><img src=\"thumbs/t"+vid+".gif\"></img></a>";
	document.getElementById("hal_desc").innerHTML=desc;
	for(j=0;j<10;j++)
	{
		if(j==i)
			document.getElementById("hal_list_item"+j).className="hal_list_item_hover";
		else
			document.getElementById("hal_list_item"+j).className="hal_list_item";
	}
}

function getMonthly()
{
	var url="<?php echo $host_name;?>/ajax_monthly_top.php?rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showMonthly;
	http.send(null);
}

function showMonthly()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			for(i=0;i<10;i++)
			{
				c=document.getElementById("hal_list_item"+i).innerHTML="";
				c=document.getElementById("hal_vid"+i).innerHTML="";
				c=document.getElementById("hal_desc"+i).innerHTML="";
			}
			for(i=0;i<10;i++)
			{
				var c=document.getElementById("hal_list_item"+i);
				var vid=http.responseXML.getElementsByTagName("vid"+i)[0].firstChild.nodeValue;
				var title=http.responseXML.getElementsByTagName("title"+i)[0].firstChild.nodeValue;
				var desc=http.responseXML.getElementsByTagName("desc"+i)[0].firstChild.nodeValue;
				c.innerHTML=title;
				c=document.getElementById("hal_vid"+i);
				c.innerHTML=vid;
				c=document.getElementById("hal_desc"+i);
				c.innerHTML=desc;
			}
		}
		else
		{
			alert("loading...");
		}
	}
}

function getWeekly()
{
	var url="<?php echo $host_name;?>/ajax_weekly_top.php?rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showWeekly;
	http.send(null);
}

function showWeekly()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			for(i=0;i<10;i++)
			{
				c=document.getElementById("hal_list_item"+i).innerHTML="";
				c=document.getElementById("hal_vid"+i).innerHTML="";
				c=document.getElementById("hal_desc"+i).innerHTML="";
			}
			for(i=0;i<10;i++)
			{
				var c;
				var vid=http.responseXML.getElementsByTagName("vid"+i)[0].firstChild.nodeValue;
				var title=http.responseXML.getElementsByTagName("title"+i)[0].firstChild.nodeValue;
				var desc=http.responseXML.getElementsByTagName("desc"+i)[0].firstChild.nodeValue;
				c=document.getElementById("hal_list_item"+i);
				c.innerHTML=title;
				c=document.getElementById("hal_vid"+i);
				c.innerHTML=vid;
				c=document.getElementById("hal_desc"+i);
				c.innerHTML=desc;
			}
		}
		else
		{
			alert("loading...");
		}
	}
}

function getHistory()
{
	var url="<?php echo $host_name;?>/ajax_history_top.php?rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showHistory;
	http.send(null);
}

function showHistory()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			for(i=0;i<10;i++)
			{
				c=document.getElementById("hal_list_item"+i).innerHTML="";
				c=document.getElementById("hal_vid"+i).innerHTML="";
				c=document.getElementById("hal_desc"+i).innerHTML="";
			}
			for(i=0;i<10;i++)
			{
				var c=document.getElementById("hal_list_item"+i);
				var vid=http.responseXML.getElementsByTagName("vid"+i)[0].firstChild.nodeValue;
				var title=http.responseXML.getElementsByTagName("title"+i)[0].firstChild.nodeValue;
				var desc=http.responseXML.getElementsByTagName("desc"+i)[0].firstChild.nodeValue;
				c.innerHTML=title;
				c=document.getElementById("hal_vid"+i);
				c.innerHTML=vid;
				c=document.getElementById("hal_desc"+i);
				c.innerHTML=desc;
			}
		}
		else
		{
			alert("loading...");
		}
	}
}

function change_style(i)
{
	if(i==1)
	{
		document.getElementById("hal_button1").className="hal_button_hover";
		document.getElementById("hal_button2").className="hal_button";
		document.getElementById("hal_button3").className="hal_button";
		getWeekly();
	}
	if(i==2)
	{
		document.getElementById("hal_button1").className="hal_button";
		document.getElementById("hal_button2").className="hal_button_hover";
		document.getElementById("hal_button3").className="hal_button";
		getMonthly();
	}
	if(i==3)
	{
		document.getElementById("hal_button1").className="hal_button";
		document.getElementById("hal_button2").className="hal_button";
		document.getElementById("hal_button3").className="hal_button_hover";
		getHistory();
	}
}

</script>
<?php
include_once("tag_cloud.php");
include_once("footer.php");
?>