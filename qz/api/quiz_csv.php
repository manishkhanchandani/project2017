<?php require_once('../../Connections/conn.php'); ?>
<?php
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
		//$return['categories'][] = $row_rsCategories;
		$catDisplay[] = $row_rsCategories['displayCategory'];
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
} // Show if recordset not empty

//$return['displayCategory'] = implode(', ', $catDisplay);
function replaceMe($str) {
	$remove_character = array("\n", "\r\n", "\r");
	$str = str_replace($remove_character , '<br />', $str);
	$remove_character = array("<br /><br />");
	return $str = str_replace($remove_character , '<br />', $str);
}

function replaceMe2($str) {
	$remove_character = array(" ");
	$str = str_replace($remove_character , '_', $str);
	return strtolower($str);
}
$cat = replaceMe2(implode(', ', $catDisplay));


$return[] = array('Question', 'Question Type (multiple-choice or multi-select)', 'Answer Option 1', 'Answer Option 2', 'Answer Option 3', 'Answer Option 4', 'Answer Option 5', 'Answer Option 6', 'Correct Response', 'Explanation', 'Knowledge Area');
if ($totalRows_rsDisplay > 0) {
	do { 
		$row_rsDisplay['question'] = ($row_rsDisplay['question']);
		$row_rsDisplay['explanation'] = ($row_rsDisplay['explanation']);
		$answers = json_decode($row_rsDisplay['answers']);
		//$return['data'][] = !empty($allFields) ? $row_rsDisplay : array('id' => $row_rsDisplay['id'], 'category_id' => $row_rsDisplay['category_id']);
		$return[] = array($row_rsDisplay['question'], 'multiple-choice', $answers[0], $answers[1], $answers[2], $answers[3], '', '', $row_rsDisplay['correct']+1, $row_rsDisplay['explanation'], $row_rsDisplay['topic'] );

} while ($row_rsDisplay = mysql_fetch_assoc($rsDisplay));
} // Show if recordset not empty 

mysql_free_result($rsDisplay);

mysql_free_result($rsCategories);

} catch(Exception $e) {
	echo $e->getMessage();
	exit;
}
if (empty($_GET['category_id'])) {
	echo 'no cat';
	exit;
}		
$fp = fopen('files/file_'.$cat.'.csv', 'w');

foreach ($return as $fields) {
    fputcsv($fp, $fields);
}
//http://localhost/project2017/qz/api/quiz_csv.php?category_id=47&limit=1000&order=id%20ASC&allFields=1
fclose($fp);
echo '<pre>';
		print_r($return);
		exit;
?>
