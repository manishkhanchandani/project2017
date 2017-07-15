<?php
// *** Logout the current user.
$logoutGoTo = "login.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
$_SESSION['MM_UserId'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['MM_UserId']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HTML 5</title>

</head>

<body>
</body>
</html>