<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "remote-mysql4.servage.net";
$database_conn = "10000projects";
$username_conn = "10000projects";
$password_conn = "passwords123";
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conn, $conn) or die("error in selecting db");

$time = time()-(60*10);
mysql_query("update procentris_users set logged_in = 0 where logged_in_time <= '".$time."'") or die(mysql_error());

if($_SESSION['MM_Username']) {
	mysql_query("update `procentris_users` set logged_in = 1, logged_in_time = '".time()."' where username = '".$_SESSION['MM_Username']."'") or die('Error in line '.__LINE__.' of File '.__FILE__.': '.mysql_error());
} 
/*
$details = var_export($_GET,1);
$details .= "\r\n";
$details .= var_export($_POST,1);
$details .= "\r\n";
$details .= var_export($_SERVER,1);
$details .= "\r\n";
$details .= var_export($_ENV,1);
$details .= "\r\n";
$details .= var_export($_SESSION,1);
$details .= "\r\n";
$details .= var_export($_COOKIE,1);
$details .= "\r\n";
$details = addslashes(stripslashes($details));
mysql_query("insert into procentris_logs set username = '".$_SESSION['MM_Username']."', details = '".$details."', ip = '".$_SERVER['REMOTE_ADDR']."', page = '".$_SERVER['REQUEST_URI']."'") or die("error");
*/
?>