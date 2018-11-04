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
	
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

if (!function_exists('isAuthorized')) {
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
}

$MM_restrictGoTo = "xxxx";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  throw new Exception('User not logged in');
}

$colname_rsEdit = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM users_auth WHERE user_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

mysql_free_result($rsEdit);
$return['request'] = array('profile_uid' => $_POST["profile_uid"], 'uid' => $_POST["uid"], 'user_id' => $_SESSION['MM_UserId']);
if ((isset($_POST["profile_uid"])) && isset($_POST["uid"])) {
	$_SESSION['MM_ProfileUID'] = $_POST['profile_uid'];
	$_SESSION['MM_UID'] = $_POST['uid'];
	$time = time() + (60* 60* 24 * 7);
	$suffix = '_V1';
	setcookie('MM_UID'.$suffix, $_SESSION['MM_UID'], $time, '/');
	setcookie('MM_ProfileUID'.$suffix, $_SESSION['MM_ProfileUID'], $time, '/');
	
  $updateSQL = sprintf("UPDATE users_auth SET profile_uid=%s, uid=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['profile_uid'], "text"),
                       GetSQLValueString($_POST['uid'], "text"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
?>
