<?php
define("INNER_ACCESS","1");
include("header.php");
$uid=$_COOKIE["uid"];
$username=$_COOKIE["username"];
$password=$_COOKIE["password"];

$su=new st_user($uid,$username,$password);
if(!$su->check_status())
{
	header("Location:/redirect.php?msg=用户未登录&text=点这登录&link=login.php");
}
?>
	<div id="content">
		<div id="upload_obj">
			<div id="upload_text">
				<p>
				1.支持所有主流视频格式，大小限制为 1000MB。<br><br>
				2.可选择完善标签信息，以方便搜索分类。标签通过空格分隔，每个标签不可超过32个字符。<br><br>
				</p>
			</div>
			<div id="upload_field">
				<form name="file" enctype="multipart/form-data" action="upload_action.php" method="post" onsubmit="return showbar()">
					<div class="upload_item">
						<label for="title">视频标题</label><br>
						<input id="title" name="title" type="text" size="42" onkeydown="validate();" onkeypress="validate();" onkeyup="validate();"/>
					</div>
					<div class="upload_item">
						<label for="desc">视频描述</label><br>
						<textarea id="desc" name="desc" rows="4" cols="40" onkeydown="validate();" onkeypress="validate();" onkeyup="validate();"></textarea>
					</div>
					<div class="upload_item">
						<label for="tags">标签TAGS</label><br>
						<input name="tags" type="text" size="42" />
					</div>
					<div class="upload_item">
						<label for="file">浏览文件</label><br>
						<input id="file" name="file" type="file" />
						<input id="submit" type="submit" value="确认" />
					</div>
					<div id="upload_progress">
						<div id="up">
							<div>正在上传...<img src="images/progressbar.gif" border="0">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div id="upload_validate">
				<br /><br />
				<div id="title_validate"></div>
				<br /><br />
				<div id="desc_validate"></div>
			</div>
		</div>
		<script language="javascript">
		document.getElementById("up").style.display="none";
		function showbar()
		{
			if(validate())
			{
				document.getElementById("up").style.display="inline";
				return true;
			}
			else
			{
				document.getElementById("up").style.display="none";
				return false;
			}
		}
		
		function validate()
		{
			var ret=false;
			var title=document.getElementById("title");
			if(title.value.length==0)
			{
				ret=false;
				document.getElementById("title_validate").innerHTML="标题不可为空";
			}
			else if(title.value.length>50)
			{
				ret=false;
				document.getElementById("title_validate").innerHTML="标题要在50字以内";
			}
			else
			{
				ret=true;
				document.getElementById("title_validate").innerHTML="";
			}
			var desc=document.getElementById("desc");
			if(desc.value.length==0)
			{
				ret=false;
				document.getElementById("desc_validate").innerHTML="介绍不可为空";
			}
			else if(desc.value.length>140)
			{
				ret=false;
				document.getElementById("desc_validate").innerHTML="介绍要在140字以内";
			}
			else
			{
				ret=true;
				document.getElementById("desc_validate").innerHTML="";
			}
			return ret;
		}
		</script>
	</div>
<?php
include("footer.php");
?>
