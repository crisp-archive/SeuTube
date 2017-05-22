<?php
$db_server   = "localhost";
$db_username = "root";
$db_password = "seutube";
$db_database = "seutube";

$db_conn = mysql_connect($db_server,$db_username,$db_password) or die ($couldNotConnectMysql); 
mysql_select_db($db_database,$db_conn) or die ($couldNotOpenDatabase);
?>
