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
					<td>������Ҫ�ҵ�΢�����ƻ��˺�</td>
					<td><input type="text" name="keyword" size="30" /></td>
				</tr>
				<tr>
					<td>ѡ����������</td>
					<td>
						<input name="type" type="radio" value="5" checked="1">����</input>
						<input name="type" type="radio" value="6">�˺�</input>
					</td>
				</tr>
				<tr>
					<td><input name="submit" type="submit" value="����" /></td>
				</tr>
				</table>
			</div>
		</form>
	</div>
<?php
include_once("footer.php");
?>