<?php
// prevent outer access of some pages
define("INNER_ACCESS","1");

$vid=$_GET["vid"];
include_once("header.php");
include_once("config.php");
include_once("db/movie.php");
include_once("db/user.php");

$sm=new st_movie();
$sm->vid=$vid;
$m=$sm->get_movie_info();

if($m==0)
{	
	// if success get uid, then get username
	$su=new st_user($sm->uid,"","");
	$m=$su->get_user_info_by_id();
	if($m==0)
	{
		$name=$su->username;
		$sm->update_movie_pop();
	}
}

?>

<div id="content">
	<div id="loading">
		<img src="<?php echo $host_name; ?>/images/loading.gif" alt="" />
	</div>
	<div id="player_obj">
	<div id="player_area">
		<video src="<?php echo $host_name."/video/v$vid.webm";?>" width="770" height="420" controls="controls" preload="preload">
			您的浏览器不支持HTML5! 
		</video>
	</div>
	
	<div id="player_vinfo">
		<div id="player_title">
			<?php echo $sm->title; ?>
		</div>
		<div id="player_author">
			<div>上传&nbsp;<?php echo "<a href=\"$host_name/t/u/$su->uid\">$name</a>"; ?></div>
			<div>时间&nbsp;<?php echo $sm->upload_ts; ?></div>
			<div>观看&nbsp;<?php echo $sm->pop; ?></div>
			<span id="rate">评分&nbsp;<?php echo $sm->get_rate();?></span>
			<span>
				<a href="javascript:rate(1);"><img src="<?php echo $host_name; ?>/images/star.gif"></a>
				<a href="javascript:rate(2);"><img src="<?php echo $host_name; ?>/images/star.gif"></a>
				<a href="javascript:rate(3);"><img src="<?php echo $host_name; ?>/images/star.gif"></a>
				<a href="javascript:rate(4);"><img src="<?php echo $host_name; ?>/images/star.gif"></a>
				<a href="javascript:rate(5);"><img src="<?php echo $host_name; ?>/images/star.gif"></a>
			</span>
		</div>
		<div id="player_desc">
			<?php echo $sm->desc; ?>
		</div>
		<div id="player_share">
			<a href="javascript:addfav();">收藏</a>
			<a href="javascript:share();">分享</a>
			<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?btn=r2.gif" charset="utf-8"></script>
		</div>
		<div id="player_tags">
			<?php
			if($sm->tags!=null)
				echo '标签: ';
			foreach( $sm->tags as $tag)
			{
				echo "<a href=\"$host_name/search_engine.php?page=1&keyword=$tag&type=4\">$tag</a>&nbsp;";
			}
			?>
		</div>
	</div>
	</div>
<?php
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];
$su=new st_user($uid,$username,$password);
echo '<div id="gb_area">';
if($su->check_status())
{
	echo '<div id="gb_count"></div>';
	echo '<div id="gb_input">';
	echo '<textarea onkeydown="count();" onkeypress="count();" onkeyup="count();" id="inputarea" type="text" cols="35" rows="4"></textarea>';
	echo '<input id="gb_post" type="button" value="发布" onClick="post();">';
	echo '<input type="reset" value="重写"> ';
	echo '</div>';
	echo '</div>';
	$islogin=1;
	// add into RECENT LIST
	$sql="select * from st_recent where uid=$su->uid";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$vrq=array();
	for($i=0;$i<10;$i++)
	{
		array_push($vrq, $row["v$i"]);
	}
	if(end($vrq)!=$vid)
	{
		array_shift($vrq);
		array_push($vrq,$vid);
		$sql="update st_recent set v0=$vrq[0],v1=$vrq[1],v2=$vrq[2],v3=$vrq[3],v4=$vrq[4],v5=$vrq[5],v6=$vrq[6],v7=$vrq[7],v8=$vrq[8],v9=$vrq[9] where uid=$su->uid";
		mysql_query($sql);
	}
}
for($i=1;$i<=10;$i++)
{
	echo "<div id=\"gb$i\" class=\"gb_obj\">\n";
	echo "<div id=\"u$i\" class=\"gb_name\"></div>\n";
	echo "<div id=\"t$i\" class=\"gb_text\"></div>\n";
	echo "<div id=\"ts$i\" class=\"gb_optime\"></div>\n";
	echo "</div>\n";
	$islogin=0;
}
?>
	<div id="page_ctrl">
		<input class="button" type="button" value="首页" onClick="homepage();" />
		<input class="button" type="button" value="上一页" onClick="prevpage();" />
		<input class="button" type="button" value="下一页" onClick="nextpage();" />
		<input class="button" type="button" value="顶端" onClick="self.scrollTo(0,0);" />
	</div>
	<br>
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
var page=1;
var islogin=<?php echo $islogin;?>;
var vid=<?php echo $vid; ?>;
var maxpage=<?php
$sql="select count(*) from st_gbook where vid=$vid";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$max=$row['count(*)'];
if($max%10==0)
  echo $max/10;
else
  echo (int)($max/10)+1;
?>;
document.onload=init();

function init()
{
	show();
	if(islogin==1)
		count();
	document.getElementById("loading").style.display="none";
}

function count()
{
	var max=140;
	var s=document.getElementById("inputarea").value.length;

	document.getElementById("gb_count").innerHTML="还能输入"+(140-s)+"字";
	if(s==0)
		document.getElementById("gb_post").disabled=true;
	else
		document.getElementById("gb_post").disabled=false;
	
	if(s>140)
	{
		document.getElementById("gb_count").innerHTML="已经超过字数限制，超过部分将不会被显示!";
	}
}

function show()
{
	var url="<?php echo $host_name; ?>/ajax_getgb.php?v="+<?php echo $vid; ?>+"&p="+page+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showPage;
	http.send(null);
}

function post()
{
	var text=document.getElementById("inputarea").value;
	inputarea.value="";
	var url="<?php echo $host_name; ?>/ajax_postgb.php?t="+text+"&vid="+<?php echo $vid;?>+"&rand="+parseInt(Math.random()*10000000);
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
				count();
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
			var i;
			if(count==0)
				document.getElementById("page_ctrl").style.display="none";
			else
				document.getElementById("page_ctrl").style.display="block";
			for(i=1;i<=10;i++)
			{
				if(i<=count)
					document.getElementById("gb"+i).style.display="block";
				else
					document.getElementById("gb"+i).style.display="none";
			}
			for(i=1;i<=10;i++)
			{
				var c;
				var uid=http.responseXML.getElementsByTagName("uid"+i)[0].firstChild.nodeValue;
				var username=http.responseXML.getElementsByTagName("username"+i)[0].firstChild.nodeValue;
				c=document.getElementById("u"+i);
				c.innerHTML="<a href=\"<?php echo $host_name;?>/t/u/"+uid+"\">"+username+"</a>";
				var t=http.responseXML.getElementsByTagName("t"+i)[0].firstChild.nodeValue;
				c=document.getElementById("t"+i);
				c.innerHTML=t;
				var ts=http.responseXML.getElementsByTagName("ts"+i)[0].firstChild.nodeValue;
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
	if(page<maxpage)
	{
		page++;
		show();
		self.scrollTo(0,0);
	}
}

function share()
{
	var url="<?php echo $host_name; ?>/ajax_share.php?vid=<?php echo $vid; ?>&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showShareResult;
	http.send(null);
}

function showShareResult()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var result=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(result==1)
			{
				alert("分享到微博成功！");
			}
			else
			{
				alert("分享失败！用户请登录！");
			}
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}

function rate(value)
{
	var url="<?php echo $host_name; ?>/ajax_rate.php?vid="+<?php echo $vid; ?>+"&value="+value+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showRateResult;
	http.send(null);
}

function showRateResult()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var result=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(result==1)
			{
				alert("评分成功！");
				getrate();
			}
			else
			{
				alert("您已经评过分了！");
			}
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}

function getrate()
{
	var url="<?php echo $host_name; ?>/ajax_getrate.php?vid="+<?php echo $vid; ?>+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showRate;
	http.send(null);
}

function showRate()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var rate=http.responseXML.getElementsByTagName("rate")[0].firstChild.nodeValue;
			var c=document.getElementById("rate");
			c.innerHTML="评分 "+rate;
		}
		else
		{
			document.getElementById("loading").style.display="block";
		}
	}
}

function addfav()
{
	var url="<?php echo $host_name; ?>/ajax_addfav.php?vid="+<?php echo $vid; ?>+"&rand="+parseInt(Math.random()*10000000);
	http.open("GET",url,true);
	http.onreadystatechange=showFavResult;
	http.send(null);
}

function showFavResult()
{
	if(http.readyState==4)
	{
		if(http.status==200)
		{
			var result=http.responseXML.getElementsByTagName("result")[0].firstChild.nodeValue;
			if(result==1)
			{
				alert("收藏成功！");
				isfav();
			}
			else
			{
				alert("收藏失败！用户请登录！");
			}
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