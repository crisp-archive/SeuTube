<?php
define("INNER_ACCESS","1");
include_once("t_header.php");
include_once("config.php");
?>
	<div id="content">
		<div id="search_frm">
			<form name="search_frm" action="<?php echo $host_name;?>/search_action.php" method="post">
			<table>
				<tr>
					<td>请输入要找的微博名称或账号</td>
					<td><input type="text" name="keyword" size="30" /></td>
				</tr>
				<tr>
					<td>选择搜索类型</td>
					<td>
						<input name="type" type="radio" value="5" checked="1">名称</input>
						<input name="type" type="radio" value="6">账号</input>
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