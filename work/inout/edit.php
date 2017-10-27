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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$_POST['in_time'] = strtotime($_POST['in_time']);
	$_POST['out_time'] = strtotime($_POST['out_time']);
	if($_POST['out_time']>0) {
		$_POST['diff_time'] = $_POST['out_time'] - $_POST['in_time'];
	}
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE mk_inout SET in_time=%s, out_time=%s, diff_time=%s, ip=%s, ipout=%s WHERE inout_id=%s",
                       GetSQLValueString($_POST['in_time'], "int"),
                       GetSQLValueString($_POST['out_time'], "int"),
                       GetSQLValueString($_POST['diff_time'], "int"),
                       GetSQLValueString($_POST['ip'], "text"),
                       GetSQLValueString($_POST['ipout'], "text"),
                       GetSQLValueString($_POST['inout_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEdit = "1";
if (isset($_GET['inout_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['inout_id'] : addslashes($_GET['inout_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM mk_inout WHERE inout_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
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
<h3>Edit In Out Time</h3>
<dlcalendar click_element_id="img_flightdeparture"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture1"
            input_element_id="input_flightdeparture1"
            tool_tip="Click to choose flight departure date"></dlcalendar>

<dlcalendar click_element_id="text_flightdeparture2"
            input_element_id="input_flightdeparture2"
            tool_tip="Click to choose flight departure date"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture3"
            input_element_id="input_flightdeparture3"
            tool_tip="Click to choose flight departure date"
            start_date="2004,7,30"
            end_date="2004,11,5"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture_en"
            input_element_id="input_flightdeparture4"
            tool_tip="English Calendar"
            firstday="Su"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture_es"
            input_element_id="input_flightdeparture4"
            tool_tip="Calendario Español"
            months="ene,feb,mar,abr,may,jun,jul,ago,sep,oct,nov,dic"
            days="do,lu,ma,mi,ju,vi,sa"
            firstday="lu"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture5"
            input_element_id="input_flightdeparture5"
            tool_tip="Click to choose flight departure date"
            start_date="2003,7,30"
            end_date="2005-11-5"
            months="01,02,03,04,05,06,07,08,09,10,11,12"
            days="S,M,T,W,T,F,S"
            firstday="M"
            date_format="mm~dd~yy"
            root_date="2004-04-1"
            navbar_style="background-color: yellow; color:black;"
            daybar_style="background-color: black; font-family: Courier; color:white;"
            selecteddate_style="background-color: yellow; font-family: serif; font-style:italics; color:black; border-width:0px;"
            weekenddate_style="background-color: blue; font-family: serif; color:red; border-width:0px;"
            regulardate_style="background-color: red; font-family: serif; color:blue; border-width:0px;"
            othermonthdate_style="background-color: lightgrey; border-width:0px;"
            use_webdings="false"
            nav_images="dlcalendar_prevyear_black.gif,dlcalendar_prevmonth_black.gif,dlcalendar_nextmonth_black.gif,dlcalendar_nextyear_black.gif"
            hide_selects="true"
            hide_onselection="false"
            emptydate_option="true"
            emptydate_style="background-color: pink; color:black; font-style:italic;"
            emptydate_text="Reset Date"

            callfunction_onselection="myCustomFunction"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture6"
            emptydate_option="true"                      hide_onselection="false"

            input_element_id="input_flightdeparture6"
            tool_tip="Click to choose flight departure date"></dlcalendar>

<dlcalendar click_element_id="img_flightdeparture7"
            emptydate_option="true"                        hide_onselection="false"
																	    qemptydate_text="Reset Date"

            emptydate_style="background-color: yellow; color:black; font-style:italic;"
            input_element_id="input_flightdeparture7"
            tool_tip="Click to choose flight departure date"></dlcalendar>
			
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">In Time:</td>
      <td><input type="text" name="in_time" value="<?php echo $dt = date('Y-m-d H:i:s', $row_rsEdit['in_time']); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Out Time:</td>
      <td><input type="text" name="out_time" value="<?php $dt2 = date('Y-m-d H:i:s', $row_rsEdit['out_time']); if($row_rsEdit['out_time']) echo $dt2; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">In Ip:</td>
      <td><input type="text" name="ip" value="<?php echo $row_rsEdit['ip']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Out Ip:</td>
      <td><input type="text" name="ipout" value="<?php echo $row_rsEdit['ipout']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="inout_id" value="<?php echo $row_rsEdit['inout_id']; ?>">
  <input name="diff_time" type="hidden" id="diff_time">
</form>
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
mysql_free_result($rsEdit);
?>
