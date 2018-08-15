<?php
// *** Logout the current user.
$logoutGoTo = "../";
if (!isset($_SESSION)) {
  session_start();
}

$time = time() - 3600;
$suffix = SUFFIX;

setcookie('MM_Username'.$suffix, '', $time, '/');
setcookie('MM_Email'.$suffix, '', $time, '/');
setcookie('MM_UserGroup'.$suffix, '', $time, '/');
setcookie('MM_UserId'.$suffix, '', $time, '/');
setcookie('MM_DisplayName'.$suffix, '', $time, '/');
setcookie('MM_ProfileImg'.$suffix, '', $time, '/');
setcookie('MM_UID'.$suffix, '', $time, '/');
setcookie('MM_LoggedInTime'.$suffix, '', $time, '/');
setcookie('MM_ProfileUID'.$suffix, '', $time, '/');
	
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_UserId'] = NULL;
$_SESSION['MM_DisplayName'] = NULL;
$_SESSION['MM_ProfileImg'] = NULL;
$_SESSION['MM_UID'] = NULL;
$_SESSION['MM_LoggedInTime'] = NULL;
$_SESSION['MM_ProfileUID'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['MM_UserId']);
unset($_SESSION['MM_DisplayName']);
unset($_SESSION['MM_ProfileImg']);
unset($_SESSION['MM_UID']);
unset($_SESSION['MM_LoggedInTime']);
unset($_SESSION['MM_ProfileUID']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>