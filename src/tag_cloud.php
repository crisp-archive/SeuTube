<?php
include_once("config.php");
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
define("INNER_ACCESS","1");
include("db/config.php");
$sql="select distinct * from st_tags order by rand() limit 50";
$result=mysql_query($sql);
$c=0;
$tags=array();
$tags_id=array();
while($row=mysql_fetch_array($result))
{
	$tags_id[$c]=$row['tid'];
	$tags[$c]=$row['tag'];
	$c++;
}
?>
<div id="tag_cloud">
<div id="cloud_title">±Í«©‘∆<input type="button" value="À¢–¬" onclick="window.location.reload()"></div>
<?php
for($i=0;$i<$c;$i++)
{
	$left=rand(20,70);
	$top=rand(85,110);
	$bgcolor="#";
	for($j=0;$j<6;$j++)
		$bgcolor.=dechex(rand(0,15));
	$style="position:absolute;top:$top%;left:$left%;width:100px;height:30px;color:black;background-color:$bgcolor;";
	$tag=$tags[$i];
	$click="window.location.href='$host_name/search_engine.php?page=1&keyword=$tag&type=4'";
	echo "<div id=\"cloud_tag$i\" class=\"tag_cloud\" style=\"$style\" onclick=\"$click\" onmouseover=\"hover($i)\" >\n";
	echo $tag;
	echo "</div>\n";
}
?>
</div>
<script language="javascript">
function hover(i)
{
	for(j=0;j<<?php echo $c;?>;j++)
	{
		if(j==i)
			document.getElementById("cloud_tag"+j).style.zIndex=10;
		else
			document.getElementById("cloud_tag"+j).style.zIndex=1;
	}
}
</script>