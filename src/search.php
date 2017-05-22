<?php
define("INNER_ACCESS","1");
include_once("header.php");
include_once("config.php");
?>
	<div id="content">
		<div id="search_frm">
			<form name="search_frm" action="<?php echo $host_name;?>/search_action.php" method="post">
			<table>
				<tr>
					<td>输入要搜索的内容</td>
					<td><input type="text" name="keyword" size="30" /></td>
				</tr>
				<tr>
					<td>选择搜索类型</td>
					<td>
						<input name="type" type="radio" value="1" checked="1">标题</input>
						<input name="type" type="radio" value="2">内容</input>
						<input name="type" type="radio" value="3">作者</input>
						<input name="type" type="radio" value="4">标签</input>
					</td>
				</tr>
				<tr>
					<td><input name="submit" type="submit" value="搜索" /></td>
				</tr>
				</table>
			</div>
		</form>
	</div>
<?php
include_once("footer.php");
?>