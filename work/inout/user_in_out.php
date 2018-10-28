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
$timediff = 0; //(60*60*5)+(60*30);
function converttime($var) {
	$array = explode(":",$var);
	$minute = $array[1];
	$hour = $array[0];
	settype($minute, "integer"); 
	if($minute >=0 && $minute <=7) {
		//echo "$minute is between 0 and 7";
		$newminute = 0;
	}
	if($minute >=8 && $minute <=22) {
		//echo "$minute is between 8 and 22";
		$newminute = 25;
	}
	if($minute >=23 && $minute <=37) {
		//echo "$minute is between 23 and 37";
		$newminute = 50;
	}
	if($minute >=38 && $minute <=52) {
		//echo "$minute is between 38 and 52";
		$newminute = 75;
	}
	if($minute >=53 && $minute <=59) {
		//echo "$minute is between 53 and 59";
		$newminute = 0;
		$hour = $hour+1;
	}
	$arr['hour'] = $hour;
	$arr['minute'] = $newminute;
	$arr['time'] = $hour.".".$newminute;
	return $arr;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE mk_inout SET user_id=%s, out_time=%s, diff_time=%s, ipout=%s WHERE inout_id=%s",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['out_time'], "int"),
                       GetSQLValueString($_POST['diff_time'], "int"),
                       GetSQLValueString($_POST['ipout'], "text"),
                       GetSQLValueString($_POST['inout_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "view.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO mk_inout (user_id, in_time, ip) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['in_time'], "int"),
                       GetSQLValueString($_POST['ip'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$colname_rsUser = "1";
if (isset($_GET['user'])) {
  $colname_rsUser = (get_magic_quotes_gpc()) ? $_GET['user'] : addslashes($_GET['user']);
}
mysql_select_db($database_conn, $conn);
$query_rsUser = sprintf("SELECT * FROM mk_users WHERE username = '%s'", $colname_rsUser);
$rsUser = mysql_query($query_rsUser, $conn) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);

$colname_rsOUT = "-1";
if (isset($_GET['user'])) {
  $colname_rsOUT = (get_magic_quotes_gpc()) ? $_GET['user'] : addslashes($_GET['user']);
}
mysql_select_db($database_conn, $conn);
$query_rsOUT = sprintf("SELECT * FROM mk_inout, mk_users WHERE (mk_inout.out_time is NULL OR mk_inout.out_time = '') AND mk_users.username = '%s'  AND mk_users.user_id = mk_inout.user_id ORDER BY mk_inout.inout_id DESC LIMIT 1", $colname_rsOUT);
$rsOUT = mysql_query($query_rsOUT, $conn) or die(mysql_error());
$row_rsOUT = mysql_fetch_assoc($rsOUT);
$totalRows_rsOUT = mysql_num_rows($rsOUT);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/maintimesheet.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>In Out Time</title>
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
        <td colspan="2" valign="top"><a href="../index.php">Home</a><?php if(!$_SESSION['MM_Username']) { ?> | <a href="../users/register.php">Register</a> | <a href="../users/login.php">Login</a><?php } ?><?php if($_SESSION['MM_Username']) { ?> | <a href="index.php">In Out Time</a> | <a href="../timesheet/addhome.php">Add Timesheet</a> | <a href="../timesheet/timesheet_new.php">Add Timesheet <span class="style1">(NEW)</span></a> | <a href="../timesheet/timesheet.php">Timesheet</a> | <a href="../timesheet/deleted_task_list.php">Deleted Task List</a> | <a href="../users/edit.php">Edit Details</a> | <a href="../users/logout.php">Logout</a><?php } ?><?php if($_SESSION['MM_UserGroup']=="Admin" || $_SESSION['MM_UserGroup']=="SUPERADMIN") { ?> | <a href="admin.php">In Out Time</a> | <a href="../timesheet/admin.php">Admin</a>          <?php } ?>
          <?php if($_SESSION['MM_Username']) { ?><br>
          You are logged in as: <?php echo $_SESSION['MM_Username']; ?><?php } ?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
<!-- InstanceBeginEditable name="EditRegion3" -->
<br>
   Your IP:
   <?php echo $_SERVER['REMOTE_ADDR']; ?> | <a href="../timesheet/allusers.php">Back
   </a>
   <?php if ($totalRows_rsOUT == 0) { // Show if recordset empty ?>
<h3>Add In Time</h3>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>Your In Time is:
      <?php
   $time = time()+$timediff;
   echo date('d M, Y H:i',$time);
   ?>
      <input type="hidden" name="in_time" value="<?php echo $time; ?>">
      <input name="user_id" type="hidden" id="user_id" value="<?php echo $row_rsUser['user_id']; ?>">
      <input name="ip" type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
</p>
  <p>
    <input type="submit" name="Submit" value="Click Here To Record In Time">
  </p>
    <input type="hidden" name="MM_insert" value="form1">
</form>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_rsOUT > 0) { // Show if recordset not empty ?>
<h3>Add Out Time</h3>
<form name="form2" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="var ret=confirm('Do you really want to check out. Click ok to checkout'); if(ret) return true; else return false;">
  <p>Your Out Time is:
      <?php
   $time = time()+$timediff;
   echo date('d M, Y H:i',$time);
   $diff = $time - $row_rsOUT['in_time'];
   ?>
      <input type="hidden" name="out_time" value="<?php echo $time; ?>">
      <input name="user_id" type="hidden" id="user_id" value="<?php echo $row_rsUser['user_id']; ?>">
      <input name="inout_id" type="hidden" id="inout_id" value="<?php echo $row_rsOUT['inout_id']; ?>">
      <input name="diff_time" type="hidden" id="diff_time" value="<?php echo $diff; ?>">
      <input name="ipout" type="hidden" id="ipout" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
  </p>
  <p>
    <input type="submit" name="Submit" value="Click Here To Record Out Time">
</p>
  <p>Hours Worked Till Now: <?php
  		$tmpTime = date("H:i",$diff); 
		$arr = converttime($tmpTime);
		echo $arr['time'];
		?>
		<br>
		<?php if((60*60*8)+(60*30)-$diff>0) { 
		?>
		Pending Hours: 
		<?php
		$pending = (60*60*8)+(60*30)-$diff;
		$tmpTime = date("H:i",$pending); 
		$arr = converttime($tmpTime);
		echo $arr['time'];
   ?>
   <?php } else { ?>
   You have completed your working hours.
   <?php } ?>
   </p>
  <input type="hidden" name="MM_update" value="form2">
</form>
<?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
<p>&nbsp;  </p>
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
mysql_free_result($rsUser);

mysql_free_result($rsOUT);
?>
