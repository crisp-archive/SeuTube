<?php
include_once("header.php");
?>
<div id="content">	
	<div id="about_content">
		<div id="url_short">
			网址缩减器
			<input type="text" id="url" size="50">
			<input type="button" value="缩减!" onclick="shorten();">
			<div id="url_result">
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

function shorten()
{
	var a=document.getElementById("url").value;
	if(a=="" || a==null)
		return;
	var url="<?php echo $host_name;?>/ajax_shorten.php?url="+escape(a)+"&rand="+parseInt(Math.random()*10000000);
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
			var c=document.getElementById("url_result");
			var u=http.responseXML.getElementsByTagName("url")[0].firstChild.nodeValue;
			var r=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(r==1)
				c.innerHTML=u;
			else if(r==0)
				c.innerHTML="无效的地址!";
			else
				c.innerHTML="发生错误!";
		}
		else
		{
			alert("loading...");
		}
	}
}
</script>
<?php
include_once("footer.php");
?>