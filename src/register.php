<?php 
session_start();
define("INNER_ACCESS","1");
include("header.php");
include("config.php");
?>
	<div id="reg_frm">
		<div id="reg_legend">
			<div class="reg_legend_item">用户名</div>
			<div class="reg_legend_item">输入密码</div>
			<div class="reg_legend_item">确认密码</div>
			<div class="reg_legend_item">电子邮箱</div>
			<div class="reg_legend_item">验证码<br><img src='<?php echo $host_name;?>/check_img.php'></div>
		</div>
		<div id="reg_table">
			<form id="reg_form" name="form1" method="post" action="<?php echo $host_name;?>/register_action.php">
				<div class="reg_field_item">
					<input id="reg_table_size" name="username" type="text" size="16"/>
				</div>
				<div class="reg_field_item">
					<input id="reg_table_size" name="password" type="password" size="16" />
				</div>
				<div class="reg_field_item">
					<input id="reg_table_size" name="confirmpassword" type="password" size="16"/>
				</div>
				<div class="reg_field_item">
					<input id="reg_table_size" name="email" type="text" size="32"/>
				</div>
				<div class="reg_field_item">
					<input id="reg_table_size" name="checkcode" type="text" size="8" />
				</div>
				<div class="reg_field_item">
					<input type="submit" name="Submit" value="注册" />
					<input type="reset" name="Submit2" value="重填" />
				</div>
			</form>
		</div>
		<div id="reg_tip">
			<div class="reg_tip_item">用户名可以是5--16位的英文,下划线,减号</div>
			<div class="reg_tip_item">登录密码为6-16位</div>
		</div>
	</div>
<?php
include("footer.php");
?>

