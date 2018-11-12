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
try {

	include('../init.php');
	
	
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
?>
