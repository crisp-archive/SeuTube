<?php 
session_start();
define("INNER_ACCESS","1");
include("header.php");
include("config.php");
?>
	<div id="reg_frm">
		<div id="reg_legend">
			<div class="reg_legend_item">�û���</div>
			<div class="reg_legend_item">��������</div>
			<div class="reg_legend_item">ȷ������</div>
			<div class="reg_legend_item">��������</div>
			<div class="reg_legend_item">��֤��<br><img src='<?php echo $host_name;?>/check_img.php'></div>
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
					<input type="submit" name="Submit" value="ע��" />
					<input type="reset" name="Submit2" value="����" />
				</div>
			</form>
		</div>
		<div id="reg_tip">
			<div class="reg_tip_item">�û���������5--16λ��Ӣ��,�»���,����</div>
			<div class="reg_tip_item">��¼����Ϊ6-16λ</div>
		</div>
	</div>
<?php
include("footer.php");
?>

