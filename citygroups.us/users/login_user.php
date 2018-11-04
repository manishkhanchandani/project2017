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
	
	
	$loginFormAction = $_SERVER['PHP_SELF'];
	if (isset($_GET['accesscheck'])) {
	  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
	  $return['PrevUrl'] = $_GET['accesscheck'];
	}
	
	if (isset($_POST['username'])) {
	  $loginUsername=$_POST['username'];
	  $password=$_POST['password'];
	  $MM_fldUserAuthorization = "access_level";
	  $MM_redirectLoginSuccess = "../index.php";
	  $MM_redirectLoginFailed = "login.php";
	  $MM_redirecttoReferrer = true;
	  mysql_select_db($database_conn, $conn);
		
	  $LoginRS__query=sprintf("SELECT * FROM users_auth WHERE email='%s' AND password='%s' AND webReference='%s'",
	  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password), WEBREFERENCE);
	   
	  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
	  $loginFoundUser = mysql_num_rows($LoginRS);
	  if ($loginFoundUser) {
		
		$rec = mysql_fetch_array($LoginRS);
		
		//declare two session variables and assign them
		$_SESSION['MM_UserGroup'] = $rec['access_level'];
		$_SESSION['MM_Username'] = $rec['display_name'];
		$_SESSION['MM_Email'] = $rec['email'];
		$_SESSION['MM_UserId'] = $rec['user_id'];
		$_SESSION['MM_DisplayName'] = $rec['display_name'];
		$_SESSION['MM_ProfileImg'] = $rec['profile_img'];
		$_SESSION['MM_UID'] = $rec['uid'];
		$_SESSION['MM_LoggedInTime'] = $rec['logged_in_time'];
		$_SESSION['MM_ProfileUID'] = $rec['profile_uid'];     
		
		
		$time = time() + (60* 60* 24 * 7);
		$suffix = '_V1';
		setcookie('MM_Username'.$suffix, $_SESSION['MM_Username'], $time, '/');
		setcookie('MM_Email'.$suffix, $_SESSION['MM_Email'], $time, '/');
		setcookie('MM_UserGroup'.$suffix, $_SESSION['MM_UserGroup'], $time, '/');
		setcookie('MM_UserId'.$suffix, $_SESSION['MM_UserId'], $time, '/');
		setcookie('MM_DisplayName'.$suffix, $_SESSION['MM_DisplayName'], $time, '/');
		setcookie('MM_ProfileImg'.$suffix, $_SESSION['MM_ProfileImg'], $time, '/');
		setcookie('MM_UID'.$suffix, $_SESSION['MM_UID'], $time, '/');
		setcookie('MM_LoggedInTime'.$suffix, $_SESSION['MM_LoggedInTime'], $time, '/');
		setcookie('MM_ProfileUID'.$suffix, $_SESSION['MM_ProfileUID'], $time, '/');    
	  }
	  else {
		throw new Exception('Login Failed, please try with different username and password.');
	  }
	}
} catch(Exception $e) {
	$return['success'] = 0;
	$return['error'] = $e->getMessage();
}
echo json_encode($return);
?>
