<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

$MM_authorizedUsers = "admin";
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

$MM_restrictGoTo = "../users/access-denied.php";
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
$currentPage = $_SERVER["PHP_SELF"];

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

if (isset($_GET['change']) && isset($_GET['id'])) {
  $deleteSQL = sprintf("UPDATE calbabybar_nodes SET current_status=%s WHERE id=%s",
                       GetSQLValueString($_GET['change'], "int"),
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}

$maxRows_rsView = 25;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$coldeleted_rsView = "0";
if (isset($_GET['deleted'])) {
  $coldeleted_rsView = (get_magic_quotes_gpc()) ? $_GET['deleted'] : addslashes($_GET['deleted']);
}
$colname_rsView = "0";
if (isset($_GET['current_status'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['current_status'] : addslashes($_GET['current_status']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT *, a.status as st FROM calbabybar_nodes as a INNER JOIN users_auth as b on a.user_id = b.user_id WHERE a.current_status = %s AND a.deleted = %s ORDER BY id ASC", $colname_rsView,$coldeleted_rsView);
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
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Change Status</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Records</h1>
<p><a href="change_status.php?current_status=0&deleted=<?php echo $coldeleted_rsView; ?>">Unapproved List</a> | <a href="change_status.php?current_status=1&deleted=<?php echo $coldeleted_rsView; ?>">Approved Lists</a> | Deleted Lists  </p>
<?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
    <p>No Record Found.</p>
    <?php } // Show if recordset empty ?>
    <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <div class="table-responsive">
  						<table class="table">
        <tr>
            <td valign="top"><strong>ID</strong></td>
            <td valign="top"><strong>User Id </strong></td>
            <td valign="top"><strong>Current Status </strong></td>
            <td valign="top"><strong>Title</strong></td>
            <td valign="top"><strong>Node Type </strong></td>
            <td valign="top"><strong>SubTopic</strong></td>
            <td valign="top"><strong>Deleted</strong></td>
            <td valign="top"><strong>Status</strong></td>
            <td valign="top"><strong>Display Name </strong></td>
            </tr>
        <?php do { ?>
            <tr>
                <td valign="top"><?php echo $row_rsView['id']; ?></td>
                <td valign="top"><?php echo $row_rsView['user_id']; ?></td>
                <td valign="top"><p><?php echo $row_rsView['current_status']; ?></p>
                    <p><a href="change_status.php?id=<?php echo $row_rsView['id']; ?>&change=1&deleted=<?php echo $coldeleted_rsView; ?>&current_status=<?php echo $colname_rsView; ?>&pageNum_rsView=<?php echo $pageNum_rsView; ?>">Approve</a> | <a href="change_status.php?id=<?php echo $row_rsView['id']; ?>&change=0&deleted=<?php echo $coldeleted_rsView; ?>&current_status=<?php echo $colname_rsView; ?>&pageNum_rsView=<?php echo $pageNum_rsView; ?>">Unapprove</a></p>
                    <p><a href="change_status.php?id=<?php echo $row_rsView['id']; ?>&delete=1&deleted=<?php echo $coldeleted_rsView; ?>&current_status=<?php echo $colname_rsView; ?>&pageNum_rsView=<?php echo $pageNum_rsView; ?>">Delete</a> | <a href="change_status.php?id=<?php echo $row_rsView['id']; ?>&delete=0&deleted=<?php echo $coldeleted_rsView; ?>&current_status=<?php echo $colname_rsView; ?>&pageNum_rsView=<?php echo $pageNum_rsView; ?>">Undelete</a>  </p></td>
                <td valign="top"><?php echo $row_rsView['title']; ?>
                    <hr>
                    <p><?php echo $row_rsView['description']; ?></p>
                    <hr>
                    <p><?php echo $row_rsView['description2']; ?></p></td>
                <td valign="top"><?php echo $row_rsView['node_type']; ?></td>
                <td valign="top"><?php echo $row_rsView['sub_topic']; ?></td>
                <td valign="top"><?php echo $row_rsView['deleted']; ?></td>
                <td valign="top"><?php echo $row_rsView['st']; ?></td>
                <td valign="top"><?php echo $row_rsView['display_name']; ?>
                    <hr>
                    <img src="<?php echo $row_rsView['profile_img']; ?>" style="max-width: 100px;" />
                    <hr>
                    <?php echo $row_rsView['email']; ?> </td>
                </tr>
            <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
    </table>
	</div>
    <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
    <table border="0" width="50%" align="center">
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
    <?php } // Show if recordset not empty ?>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
