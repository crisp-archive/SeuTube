<?php
include_once("header.php");
?>
<div id="content">
	<div id="admin_content">
	<form method="post" action="admin_action.php">
		<div id="admin_pass">
			����Ա����
			<input type="password" name="pw" size="8" />
			<input type="submit" value="ִ��" />
		</div>
		<div class="admin_obj">
			ɾ����Ƶ: ��ƵID
			<input type="number" name="vid" size="2" />
		</div>
		<div class="admin_obj">
			�������: ����ID
			<input type="number" name="gid" size="2" />
		</div >
		<div class="admin_obj">
			���΢��: ΢��ID
			<input type="number" name="tid" size="2" />
		</div>
		<div class="admin_obj">
			ɾ���û�: �û�ID
			<input type="number" name="uid" size="2" />
		</div>
	</form>
	</div>
</div>
<?php
include_once("footer.php");
?>