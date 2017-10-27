<?php require_once('../Connections/conn.php'); ?>
<?php
// *** Logout the current user.
$logoutGoTo = "login.php";
session_start();
mysql_query("update mk_users set logged_in = 0 where username = '".$_SESSION['MM_Username']."'") or die(mysql_error());
session_destroy();
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
session_unregister('MM_Username');
session_unregister('MM_UserGroup');

exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>

</body>
</html>
