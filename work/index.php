<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Work Management System</title>
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
        <td valign="top"><h1>Work Related Timesheet </h1> </td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><a href="index.php">Home</a> | <a href="timesheet/addhome.php">Time Management System</a> | <a href="users/whosonline.php">Who's Online</a>          <?php if(!$_SESSION['MM_Username']) { ?> | <a href="users/register.php">Register</a> | <a href="users/login.php">Login</a><?php } ?><?php if($_SESSION['MM_Username']) { ?> | <a href="users/edit.php">Edit Details</a> | <a href="users/logout.php">Logout</a><?php } ?>
          <?php if($_SESSION['MM_Username']) { ?><br>
          You are logged in as: <?php echo $_SESSION['MM_Username']; ?><?php } ?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">Welcome to My Timesheet!!
</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include('end.php'); ?>

</body>
</html>
