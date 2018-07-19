<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$return = array();
$return['success'] = 1;
$return['totalRows'] = 0;
$return['data'] = null;

$node_type_id = !empty($_GET['type_id']) ? $_GET['type_id'] : 1;

try {
    if (empty($_GET['id'])) {
        throw new Exception('Missing subject id');    
    }
	include('../../functions.php');
    mysql_select_db($database_conn, $conn);
    $query_nodes = "SELECT * FROM baby_bar_nodes as n INNER JOIN baby_bar_node_types as nt on n.node_type_id = nt.node_type_id WHERE n.subject_id = ".GetSQLValueString($_GET['id'], 'int')." and n.node_type_id = ".GetSQLValueString($node_type_id, 'int')." ORDER BY n.sorting ASC";
    $rsNodes = mysql_query($query_nodes, $conn) or die(mysql_error());
    $row_rsNodes = mysql_fetch_assoc($rsNodes);
    $totalRows_rsNodes = mysql_num_rows($rsNodes);
    
    $return['totalRows'] = $totalRows_rsNodes;

    if ($totalRows_rsNodes > 0) { // Show if recordset not empty 
        do {
            $return['data'][] = $row_rsNodes;
        } while ($row_rsNodes = mysql_fetch_assoc($rsNodes)); 
    } // Show if recordset not empty
    mysql_free_result($rsNodes);
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
