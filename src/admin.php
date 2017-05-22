<?php
include_once("header.php");
?>
<div id="content">
	<div id="admin_content">
	<form method="post" action="admin_action.php">
		<div id="admin_pass">
			管理员密码
			<input type="password" name="pw" size="8" />
			<input type="submit" value="执行" />
		</div>
		<div class="admin_obj">
			删除视频: 视频ID
			<input type="number" name="vid" size="2" />
		</div>
		<div class="admin_obj">
			清除留言: 留言ID
			<input type="number" name="gid" size="2" />
		</div >
		<div class="admin_obj">
			清除微博: 微博ID
			<input type="number" name="tid" size="2" />
		</div>
		<div class="admin_obj">
			删除用户: 用户ID
			<input type="number" name="uid" size="2" />
		</div>
	</form>
	</div>
</div>
<?php
include_once("footer.php");
?>