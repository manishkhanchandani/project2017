<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
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
$timediff = 0; //(60*60*5)+(60*30);
function secondsToWords($seconds)
{
    /*** return value ***/
    $ret = "";

    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0)
    {
        $ret .= "$hours hours ";
    }
    /*** get the minutes ***/
    $minutes = bcmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0)
    {
        $ret .= "$minutes minutes ";
    }
  
    /*** get the seconds ***/
    $seconds = bcmod(intval($seconds),60);
    //$ret .= "$seconds seconds";

    return $ret;
}
$end = time()+$timediff;
if(!$_GET['period']) { $_GET['period'] = "D"; }
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
function getDays($time='') {
	if(!$time) {
		$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
	} else {
		$d = date('d',$time);
		$m = date('m',$time);
		$y = date('Y',$time);
		$time = mktime(0,0,0,$m,$d,$y);
	}
	$today = getdate($time);
	//print_r($today);
	switch($today['wday']) {
		case 1: // monday
			$monday = $time+(60*60*24*0); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time+(60*60*24*1); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*2); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*3); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*4); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*5); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*6); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 2: // tuesday
			$monday = $time-(60*60*24*1); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time+(60*60*24*0); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*1); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*2); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*3); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*4); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*5); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 3: // wednesday
			$monday = $time-(60*60*24*2); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*1); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*0); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*1); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*2); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*3); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*4); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 4: // thursday
			$monday = $time-(60*60*24*3); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*2); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*1); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*0); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*1); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*2); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*3); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 5: // friday
			$monday = $time-(60*60*24*4); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*3); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*2); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*1); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*0); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*1); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*2); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 6: // saturday
			$monday = $time-(60*60*24*5); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*4); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*3); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*2); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time-(60*60*24*1); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*0); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*1); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 0: // sunday
			$monday = $time-(60*60*24*6); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*5); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*4); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*3); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time-(60*60*24*2); 
			$arr['friday'] = getdate($friday);
			$saturday = $time-(60*60*24*1); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*0); 
			$arr['sunday'] = getdate($sunday);
			break;
	}
	return $arr;
}
$arr = getDays($end);
$week = $arr['monday'][0];
if($_GET['period']) {
	switch($_GET['period']) {
		case 'A':
			$start = 0;
			break;
		case 'Y':
			$start = strtotime(date('Y')."-01-01");
			break;
		case 'M':
			$start = strtotime(date('Y')."-".date('m')."-01");
			break;
		case 'W':
			$start = $week;
			break;
		case 'D':
			$start = strtotime(date('Y')."-".date('m')."-".date('d'));
			break;
	}
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 100;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "manish.khanchandani@xoriant.com";
if (isset($_SESSION['MM_Username'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
$col1_rsView = "0";
if (isset($start)) {
  $col1_rsView = (get_magic_quotes_gpc()) ? $start : addslashes($start);
}
$col2_rsView = "9999999999";
if (isset($end)) {
  $col2_rsView = (get_magic_quotes_gpc()) ? $end : addslashes($end);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM mk_inout, mk_users WHERE mk_inout.user_id = mk_users.user_id AND mk_users.username = '%s' AND (mk_inout.in_time BETWEEN %s AND %s)  ORDER BY mk_inout.inout_id DESC", $colname_rsView,$col1_rsView,$col2_rsView);
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/maintimesheet.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>View My Timesheet</title>
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
<h3>My Timesheet</h3>
<form name="form1" method="get" action="">
  <p>
    <label>
    <input <?php if (!(strcmp($_GET['period'],"A"))) {echo "CHECKED";} ?> type="radio" name="period" value="A">
  All</label>
    <label>
    <input <?php if (!(strcmp($_GET['period'],"Y"))) {echo "CHECKED";} ?> type="radio" name="period" value="Y">
  This Year</label>
    <label>
    <input <?php if (!(strcmp($_GET['period'],"M"))) {echo "CHECKED";} ?> type="radio" name="period" value="M">
  This Month</label>
    <label>
    <input <?php if (!(strcmp($_GET['period'],"W"))) {echo "CHECKED";} ?> type="radio" name="period" value="W">
  This Week</label>
    <label>
    <input <?php if (!(strcmp($_GET['period'],"D"))) {echo "CHECKED";} ?> type="radio" name="period" value="D">
  Today</label>
    <input type="submit" name="Submit" value="Search">
    <br>
  </p>
</form>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
<p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?>
<table width="50%" border="0">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td><strong>Date</strong></td>
    <td><strong>In Time </strong></td>
    <td><strong>Out Time </strong></td>
    <td><strong>Time Worked</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td><?php echo date('d M, Y',$row_rsView['in_time']); ?> </td>
    <td><?php echo date('d M, Y H:i',$row_rsView['in_time']); ?> </td>
    <td><?php if($row_rsView['out_time']>0) { ?>
        <?php echo date('d M, Y H:i',$row_rsView['out_time']); ?>
        <?php } ?>
 </td>
    <td><?php if($row_rsView['diff_time']>0) { ?>
        <?php 
		$totaldiff += $row_rsView['diff_time'];
		//$tmpTime = date("H:i",$row_rsView['diff_time']); 
		//$arr = converttime($tmpTime);
		//echo $arr['time'];
		echo secondsToWords($row_rsView['diff_time']);
	?>
      <?php } ?>
 </td>
  </tr>
  <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
  <tr>
    <td> </td>
    <td> </td>
    <td>Total: </td>
    <td><?php 
		//$tmpTime = $totaldiff/(60*60); 
		//$tmpTime = number_format($tmpTime,2);
		//$array = explode(".",$tmpTime);
		//$min = (60*$array[1])/100;
		//$tmpTime = $array[0].":".$min;
		//$arr = converttime($tmpTime);
		//echo $arr['time'];
		echo secondsToWords($totaldiff);
		?></td>
  </tr>
</table>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
<p>No Record Found. </p>
<?php } // Show if recordset empty ?>
<p> </p>
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
mysql_free_result($rsView);

?>
