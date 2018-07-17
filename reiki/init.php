<?php
$suffix = '_V1';
if (empty($_SESSION['MM_UserId']) && !empty($_COOKIE['MM_UserId'.$suffix])) {
	$_SESSION['MM_Username'] = $_COOKIE['MM_Username'.$suffix];
	$_SESSION['MM_Email'] = $_COOKIE['MM_Email'.$suffix];
    $_SESSION['MM_UserGroup'] = $_COOKIE['MM_UserGroup'.$suffix];
	$_SESSION['MM_UserId'] = $_COOKIE['MM_UserId'.$suffix];
	$_SESSION['MM_DisplayName'] = $_COOKIE['MM_DisplayName'.$suffix];
	$_SESSION['MM_ProfileImg'] = $_COOKIE['MM_ProfileImg'.$suffix];
	$_SESSION['MM_UID'] = $_COOKIE['MM_UID'.$suffix];
	$_SESSION['MM_LoggedInTime'] = $_COOKIE['MM_LoggedInTime'.$suffix];
	$_SESSION['MM_ProfileUID'] = $_COOKIE['MM_ProfileUID'.$suffix];
}

if (!function_exists('pr')) {
	function pr($d) {
		echo '<pre>';
		print_r($d);
		echo '</pre>';
	}
}
?>