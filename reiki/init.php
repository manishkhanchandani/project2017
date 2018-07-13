<?php
if (empty($_SESSION['MM_UserId']) && !empty($_COOKIE['MM_UserId'])) {
	$_SESSION['MM_Username'] = $_COOKIE['MM_Username'];
	$_SESSION['MM_Email'] = $_COOKIE['MM_Email'];
    $_SESSION['MM_UserGroup'] = $_COOKIE['MM_UserGroup'];
	$_SESSION['MM_UserId'] = $_COOKIE['MM_UserId'];
	$_SESSION['MM_DisplayName'] = $_COOKIE['MM_DisplayName'];
	$_SESSION['MM_ProfileImg'] = $_COOKIE['MM_ProfileImg'];
	$_SESSION['MM_UID'] = $_COOKIE['MM_UID'];
	$_SESSION['MM_LoggedInTime'] = $_COOKIE['MM_LoggedInTime'];
	$_SESSION['MM_ProfileUID'] = $_COOKIE['MM_ProfileUID'];
}

if (!function_exists('pr')) {
	function pr($d) {
		echo '<pre>';
		print_r($d);
		echo '</pre>';
	}
}
?>