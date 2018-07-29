<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$id = $_GET['id'];
$subjectUrl = $_GET['subjectUrl'];
$node_type = $_GET['node_type'];
$reference = $nodeTypes[$node_type]['name'];
$mainUrl = HTTP_PATH.$node_type.'/'.$subjectUrl.'/'.$id;
$subject = $barSubjects[$_GET['id']]['subject'];

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
  $MM_referrer = $_SERVER['REQUEST_URI'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

if ((isset($_GET['node_id'])) && ($_GET['node_id'] != "")) {
	$q = "select revision_number from calbabybar_nodes_revision WHERE user_id = ".$_SESSION['MM_UserId']." AND node_id = ".$_GET['node_id']." Order by revision_number DESC LIMIT 1";
  mysql_select_db($database_conn, $conn);
	$r = mysql_query($q, $conn) or die(mysql_error());
	$rec = mysql_fetch_array($r);
	$num = 1;
	if ($rec['revision_number'] >= 1) $num = $rec['revision_number'] + 1;

	$insertSQL = "INSERT INTO  calbabybar_nodes_revision (user_id, subject_id, title, description, node_type, description2, sub_topic, view_images, view_videos, view_links, node_id, revision_number, topic_created, current_status, deleted, deleted_dt, revision_action, status, ref_id) SELECT user_id, subject_id, title, description, node_type, description2, sub_topic, view_images, view_videos, view_links, id, ".$num.", topic_created, current_status, deleted, deleted_dt, 'Deleted', status, ref_id from calbabybar_nodes WHERE user_id = ".$_SESSION['MM_UserId']." AND id = ".$_GET['node_id'];

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());


	$date = date('Y-m-d H:i:s');
  $deleteSQL = sprintf("UPDATE calbabybar_nodes SET deleted = 1, deleted_dt = %s WHERE id=%s AND user_id=%s",
                       GetSQLValueString($date, "date"),
                       GetSQLValueString($_GET['node_id'], "int"),
					   GetSQLValueString($_SESSION['MM_UserId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());

  $deleteGoTo = $mainUrl;
  header(sprintf("Location: %s", $deleteGoTo));
}

?>