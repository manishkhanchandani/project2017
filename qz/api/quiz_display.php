<?php require_once('../../Connections/conn.php'); ?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

try {

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
  }
  return $theValue;
}
}

//44: contract, 45, criminal, 46, torts, 47 1980 paper
//http://localhost/project2017/qz/api/quiz_display.php?category_id=44,45,46,47
$category_id = !empty($_GET['category_id']) ? $_GET['category_id'] : null;
$categorySql = '1';
$categorySql2 = '1';
if (!empty($category_id)) {
	$arr = explode(',', $category_id);
	if (!empty($arr)) {
		$arr2 = array();
		foreach ($arr as $k => $v) {
			$arr2[] = GetSQLValueString(trim($v), 'int');
		}
		$str = implode(',', $arr2);
		$categorySql .= ' AND category_id IN ('.$str.')';
		$categorySql2 .= ' AND cat_id IN ('.$str.')';
	}
}

$limit = !empty($_GET['limit']) ? $_GET['limit'] : 7;
$order = !empty($_GET['order']) ? $_GET['order'] : ' RAND()';
$allFields = !empty($_GET['allFields']) ? $_GET['allFields'] : false;

//$order = " id ASC";

mysql_select_db($database_conn, $conn);
$query_rsDisplay = "SELECT * FROM qz_questions WHERE $categorySql order by $order LIMIT $limit";
$rsDisplay = mysql_query($query_rsDisplay, $conn) or die(mysql_error());
$row_rsDisplay = mysql_fetch_assoc($rsDisplay);
$totalRows_rsDisplay = mysql_num_rows($rsDisplay);

$colname_rsCategories = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsCategories = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsCategories = "SELECT * FROM qz_categories WHERE $categorySql2";
$rsCategories = mysql_query($query_rsCategories, $conn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

$return = array();
$catDisplay = '';
if ($totalRows_rsCategories > 0) {
	do { 
		$return['categories'][] = $row_rsCategories;
		$catDisplay[] = $row_rsCategories['category'];
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
} // Show if recordset not empty
$return['displayCategory'] = implode(', ', $catDisplay);
function replaceMe($str) {
	$remove_character = array("\n", "\r\n", "\r");
	$str = str_replace($remove_character , '<br />', $str);
	$remove_character = array("<br /><br />");
	return $str = str_replace($remove_character , '<br />', $str);
}
if ($totalRows_rsDisplay > 0) {
	do { 
		$row_rsDisplay['question'] = replaceMe($row_rsDisplay['question']);
		$row_rsDisplay['explanation'] = replaceMe($row_rsDisplay['explanation']);
		$return['data'][] = !empty($allFields) ? $row_rsDisplay : array('id' => $row_rsDisplay['id'], 'category_id' => $row_rsDisplay['category_id']);
} while ($row_rsDisplay = mysql_fetch_assoc($rsDisplay));
} // Show if recordset not empty 

mysql_free_result($rsDisplay);

mysql_free_result($rsCategories);

} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}

echo json_encode($return);

?>
