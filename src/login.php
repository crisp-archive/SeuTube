<?php
session_start();
define("INNER_ACCESS","1");
include("config.php");
include("header.php");
?>
<div id="login_frm">
	<div id="login_legend">
	еЫКХ<br><br>
	УмТы<br><br>
	бщжЄТы<br><img src='<?php echo $host_name;?>/check_img.php'>
	</div>
	<div id="login_table">
		<form action="<?php echo $host_name; ?>/login_action.php" method="post" name="loginfrm">
			<input id="login_table_size" type="text" name="username" size="20" /><br><br>
			<input id="login_table_size" type="password" name="password" size="20" /><br><br>
			<input id="login_table_size" type="text" name="checkcode" size="20" /><br><br>
			<input type="submit" name="submit" value="ЕЧТМ" />
		</form>
	</div>
</div>
<?php
include("footer.php");
?>