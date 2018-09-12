<?php require_once('../../Connections/conn.php'); ?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

try {
?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsCategories = "select c1.*, c2.category as category2, c2.cat_id as cat_id2, c2.parent_id as parent_id2, c2.displayCategory as displayCategory2,
(select count(q.id) from qz_questions as q WHERE q.category_id = c1.cat_id) as cnt 
from qz_categories as c1 
LEFT JOIN qz_categories as c2 ON c1.parent_id = c2.cat_id 
ORDER BY c1.category ASC";
$rsCategories = mysql_query($query_rsCategories, $conn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

$return = array();
$return['success'] = 1;
$return['total'] = $totalRows_rsCategories;
if ($totalRows_rsCategories > 0) {
do { 

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
