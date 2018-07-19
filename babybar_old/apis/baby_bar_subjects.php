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
$return['data'] = array();

try {
	include('../../functions.php');
    mysql_select_db($database_conn, $conn);
    $query_rsSubjects = "SELECT * FROM baby_bar_subjects WHERE is_visible = 1 ORDER BY subject_id ASC";
    $rsSubjects = mysql_query($query_rsSubjects, $conn) or die(mysql_error());
    $row_rsSubjects = mysql_fetch_assoc($rsSubjects);
    $totalRows_rsSubjects = mysql_num_rows($rsSubjects);
    
    $return['totalRows'] = $totalRows_rsSubjects;
    
    if ($totalRows_rsSubjects > 0) { // Show if recordset not empty 
        do {
            $return['data'][$row_rsSubjects['subject_year']][] = $row_rsSubjects;
        } while ($row_rsSubjects = mysql_fetch_assoc($rsSubjects)); 
    } // Show if recordset not empty 
    
    mysql_free_result($rsSubjects);
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
