<?php require_once('../Connections/conn.php'); ?>
<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

if (empty($_GET['account'])) {
	exit;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

//save.php?account=1&symbol=EURUSD&ticket=1&price=2&sl=3&tp=4&type=open&order_type=0
  $insertSQL = sprintf("INSERT INTO fx_history (account_number, ticket, price, tp, sl, history_type, symbol, order_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['account'], "text"),
                       GetSQLValueString($_GET['ticket'], "int"),
                       GetSQLValueString($_GET['price'], "double"),
                       GetSQLValueString($_GET['tp'], "double"),
                       GetSQLValueString($_GET['sl'], "double"),
                       GetSQLValueString($_GET['type'], "text"),
                       GetSQLValueString($_GET['symbol'], "text"),
                       GetSQLValueString($_GET['order_type'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());


echo 'done';
?>