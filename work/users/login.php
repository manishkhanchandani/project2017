<?php require_once('../Connections/conn.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_POST['username'])) {

  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "accesslevel";
  $MM_redirectLoginSuccess = "success.php";
  $MM_redirectLoginFailed = "failure.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conn, $conn);
  	
  $LoginRS__query=sprintf("SELECT user_id, username, password, accesslevel FROM mk_users WHERE username='%s' AND password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 

  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    	if($_POST) {
		if(trim($_POST['username'])=="" || trim($_POST['password'])=="") {
			header("Location: failure.php");
			exit;
		}
		$query = "update mk_users set last_login_dt = NOW(), logged_in = 1, logged_in_time = '".time()."' WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
		$rs = mysql_query($query) or die("error");
	}
    $loginStrGroup  = mysql_result($LoginRS,0,'accesslevel');
    $user_id  = mysql_result($LoginRS,0,'user_id');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    $_SESSION['user_id'] = $user_id;

    if ($_GET['accesscheck']) {
      $MM_redirectLoginSuccess = $_GET['accesscheck'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
if($_SESSION['MM_Username']) {
	header("Location: ../index.php");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body,td,th,select,input,submit,button,div,p {
	font-family: Verdana;
	font-size: 11px;
}
body {
	background-color: #B5D452;
}
-->
</style>
</head>

<body>
<table width="800" border="2" align="center" cellpadding="1" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" height="500">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td valign="top">Designed By:<br>
          <strong>Manish Khanchandani </strong></td>
        <td valign="top"><h1>Work </h1> </td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><a href="../index.php">Home</a> | <a href="../timesheet/addhome.php">Time Management System</a> | <a href="whosonline.php">Who's Online</a>          <?php if(!$_SESSION['MM_Username']) { ?> | <a href="register.php">Register</a> | <a href="login.php">Login</a><?php } ?><?php if($_SESSION['MM_Username']) { ?> | <a href="edit.php">Edit Details</a> | <a href="logout.php">Logout</a><?php } ?>
          <?php if($_SESSION['MM_Username']) { ?><br>
          You are logged in as: <?php echo $_SESSION['MM_Username']; ?><?php } ?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h3>Login</h3>
<form name="form1" method="POST" action="">
Username:
<input name="username" type="text" id="username"> 
  Password: 
  <input name="password" type="password" id="password">
  <input type="submit" name="Submit" value="Go">
</form>
<p>&nbsp; </p>
<!-- InstanceEndEditable -->
</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include('../end.php'); ?>
</body>
<!-- InstanceEnd --></html>
