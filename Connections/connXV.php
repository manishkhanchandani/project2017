<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connXV = "localhost";
$database_connXV = "xv";
$username_connXV = "root";
$password_connXV = "";
$connXV = mysql_connect($hostname_connXV, $username_connXV, $password_connXV) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_connXV);
?>