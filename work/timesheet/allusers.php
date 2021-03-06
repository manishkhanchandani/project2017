<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "Admin,SUPERADMIN";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsUsers = "SELECT * FROM mk_users ORDER BY username ASC";
$rsUsers = mysql_query($query_rsUsers, $conn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/maintimesheet.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
body,td,th,select,input,submit,button,div,p {
	font-family: Verdana;
	font-size: 11px;
}
body {
	background-color: #B5D452;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
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
        <td valign="top"><h1>Work</h1></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><a href="../index.php">Home</a><?php if(!$_SESSION['MM_Username']) { ?> | <a href="../users/register.php">Register</a> | <a href="../users/login.php">Login</a><?php } ?><?php if($_SESSION['MM_Username']) { ?> | <a href="../inout/index.php">In Out Time</a> | <a href="addhome.php">Add Timesheet</a> | <a href="timesheet_new.php">Add Timesheet <span class="style1">(NEW)</span></a> | <a href="timesheet.php">Timesheet</a> | <a href="deleted_task_list.php">Deleted Task List</a> | <a href="../users/edit.php">Edit Details</a> | <a href="../users/logout.php">Logout</a><?php } ?><?php if($_SESSION['MM_UserGroup']=="Admin" || $_SESSION['MM_UserGroup']=="SUPERADMIN") { ?> | <a href="../inout/admin.php">In Out Time</a> | <a href="admin.php">Admin</a>          <?php } ?>
          <?php if($_SESSION['MM_Username']) { ?><br>
          You are logged in as: <?php echo $_SESSION['MM_Username']; ?><?php } ?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h3>All Users</h3>
<p><a href="steps.php">Back</a></p>
<table border="1">
  <tr>
    <td valign="top"><strong>User Id </strong></td>
    <td valign="top"><strong>Username</strong></td>
    <td valign="top"><strong>Name</strong></td>
    <td valign="top"><strong>Timesheet</strong></td>
    <td valign="top"><strong>Add Timesheet</strong> </td>
    <td valign="top"><strong>Edit</strong></td>
    <td valign="top"><strong>Add Client </strong></td>
    <td valign="top"><strong>InOutTime</strong></td>
    <td valign="top"><strong>Last Login Dt </strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td valign="top"><?php echo $row_rsUsers['user_id']; ?></td>
    <td valign="top"><?php echo $row_rsUsers['username']; ?></td>
    <td valign="top"><?php echo $row_rsUsers['name']; ?></td>
    <td valign="top"><p><a href="timesheet_one.php?user_id=<?php echo $row_rsUsers['user_id']; ?>">Timesheet</a>
	<br /><a href="usertimesheet.php?e=<?php echo $row_rsUsers['username']; ?>">External</a></p></td>
    <td valign="top"><a href="timesheet_new_admin.php?user=<?php echo $row_rsUsers['username']; ?>">Add Timesheet</a> </td>
    <td valign="top"><a href="../users/editadmin.php?user_id=<?php echo $row_rsUsers['user_id']; ?>">Edit</a></td>
    <td valign="top"><a href="addclient.php?user_id=<?php echo $row_rsUsers['user_id']; ?>">Add Client</a> </td>
    <td valign="top"><a href="../inout/user_in_out.php?user=<?php echo $row_rsUsers['username']; ?>">InOutTime</a></td>
    <td valign="top"><?php echo $row_rsUsers['last_login_dt']; ?>&nbsp;</td>
  </tr>
  <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
</table>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include('../end.php'); ?>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUsers);
?>
