<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connMain = "localhost";
$database_connMain = "alaw";
$username_connMain = "root";
$password_connMain = "";
//$connMain = mysql_connect($hostname_connMain, $username_connMain, $password_connMain) or trigger_error(mysql_error(),E_USER_ERROR);

//mysql_select_db($database_connMain, $connMain) or die('could not select db: '.mysql_error());
$dsn_connMain = 'mysql:dbname='.$database_connMain.';host='.$hostname_connMain;

//adodb try
//define('BASE_DIR', dirname(__FILE__));

include(BASE_DIR.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'adodb'.DIRECTORY_SEPARATOR.'adodb.inc.php');

$ADODB_CACHE_DIR = BASE_DIR.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'cache/adodb_cache';
$connMainAdodb = ADONewConnection('mysqli');
$connMainAdodb->Connect($hostname_connMain, $username_connMain, $password_connMain, $database_connMain);

//$connAdodb->LogSQL();
?>