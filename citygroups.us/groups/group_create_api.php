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
	if (empty($_SESSION['MM_UserId'])) {
		throw new Exception('Empty user details');
	}
	if (empty($_POST['location'])) {
		throw new Exception('Empty Location');
	}
	if (empty($_POST['lat'])) {
		throw new Exception('Empty lat');
	}
	if (empty($_POST['lng'])) {
		throw new Exception('Empty lng');
	}
	if (empty($_POST['city'])) {
		throw new Exception('Empty city');
	}
	if (empty($_POST['addr'])) {
		throw new Exception('Empty addr');
	}
	require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'groups'.DIRECTORY_SEPARATOR.'group_func.php');

	$uid = !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : 0;
	$return['data'] = $group->createNewGroup($_POST['location'], $uid, $_POST['lat'], $_POST['lng'], $_POST['country'], $_POST['state'], $_POST['county'], $_POST['city'], $_POST['addr']);
	
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
?>
