<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connMain = "216.170.119.150";
$database_connMain = "prjs";
$username_connMain = "user";
$password_connMain = "qHw4RT75cT3j3DTR";
//$connMain = mysql_connect($hostname_connMain, $username_connMain, $password_connMain) or trigger_error(mysql_error(),E_USER_ERROR);

//mysql_select_db($database_connMain, $connMain) or die('could not select db: '.mysql_error());
$dsn_connMain = 'mysql:dbname='.$database_connMain.';host='.$hostname_connMain;

//adodb try
define('BASE_DIR', dirname(__FILE__));

include(BASE_DIR.'/libraries/adodb/adodb.inc.php');

$ADODB_CACHE_DIR = BASE_DIR.'/cache/adodb_cache';
$connMainAdodb = ADONewConnection('mysqli');
$connMainAdodb->Connect($hostname_connMain, $username_connMain, $password_connMain, $database_connMain);

//$connAdodb->LogSQL();
