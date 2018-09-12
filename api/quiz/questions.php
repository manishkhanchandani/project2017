<?php require_once('../../Connections/conn.php'); ?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

try {

if (empty($_GET['cat_id'])) {
	throw new Exception('missing category id');
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
    case "int2":
      $theValue = ($theValue != "") ? $theValue : "NULL";
      break;
  }
  return $theValue;
}
}
?>
<?php
$orderby = 'ORDER BY id ASC';
if (!empty($_GET['orderby'])) {
	switch ($_GET['orderby']) {
		case 'random':
			$orderby = 'ORDER BY RAND()';
			break;
	}
}
mysql_select_db($database_conn, $conn);
$query_rsCategories = sprintf("select * from qz_questions where category_id IN (%s) $orderby", GetSQLValueString($_GET['cat_id'], 'int2'));
$rsCategories = mysql_query($query_rsCategories, $conn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

$return = array();
$return['success'] = 1;
$return['total'] = $totalRows_rsCategories;
if ($totalRows_rsCategories > 0) {
do { 
$row_rsCategories['answers'] = json_decode($row_rsCategories['answers'], 1);
$return['data'][] = $row_rsCategories;
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories)); 
}

} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}

echo json_encode($return);
mysql_free_result($rsCategories);
?>
