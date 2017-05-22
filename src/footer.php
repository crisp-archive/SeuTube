<?php
// prevent outer access of some pages
if(!defined("INNER_ACCESS"))
	header("Location:$host_name");
include_once("config.php");
?>
	<div id="footer">
		<div>
			Copyright &copy; 2010 <a href="<?php echo $host_name; ?>/about">关于我们</a>
		</div>
		<div id="validator">
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img src="<?php echo $host_name;?>/images/vcss-blue.gif" alt="Valid CSS!"/></a>
			<a href="http://validator.w3.org/check?uri=referer">
			<img src="<?php echo $host_name;?>/images/valid-xhtml10.png" alt="Valid XHTML!"/></a>
		</div>
	</div>
</div>
</body>
</html>
