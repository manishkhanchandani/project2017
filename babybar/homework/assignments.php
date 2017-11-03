<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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

$MM_restrictGoTo = "../index.php";
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
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO baby_bar_assignments (lawYear, question, outline_page, user_id, answer, assignment_type, subject_id) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['lawYear'], "text"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['outline_page'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['answer'], "text"),
                       GetSQLValueString($_POST['assignment_type'], "text"),
                       GetSQLValueString($_POST['subject_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_2")) {
  $updateSQL = sprintf("UPDATE baby_bar_assignments SET lawYear=%s, question=%s, outline_page=%s, answer=%s, assignment_type=%s, subject_id=%s WHERE id=%s",
                       GetSQLValueString($_POST['lawYear'], "text"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['outline_page'], "text"),
                       GetSQLValueString($_POST['answer'], "text"),
                       GetSQLValueString($_POST['assignment_type'], "text"),
                       GetSQLValueString($_POST['subject_id'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "assignments.php";
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conn, $conn);
$query_rsSubject = "SELECT * FROM baby_bar_subjects";
$rsSubject = mysql_query($query_rsSubject, $conn) or die(mysql_error());
$row_rsSubject = mysql_fetch_assoc($rsSubject);
$totalRows_rsSubject = mysql_num_rows($rsSubject);

$colname_rsEdit = "-1";
if (isset($_GET['id'])) {
  $colname_rsEdit = $_GET['id'];
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM baby_bar_assignments WHERE id = %s", GetSQLValueString($colname_rsEdit, "int"));
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$maxRows_rsView = 100;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsView = $_SESSION['MM_UserId'];
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM baby_bar_assignments INNER JOIN baby_bar_subjects ON baby_bar_assignments.subject_id = baby_bar_subjects.subject_id WHERE baby_bar_assignments.user_id = %s ORDER BY baby_bar_assignments.id ASC", GetSQLValueString($colname_rsView, "int"));
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
$query_rsSubject = "SELECT * FROM baby_bar_subjects WHERE is_visible = 1";
$rsSubject = mysql_query($query_rsSubject, $conn) or die(mysql_error());
$row_rsSubject = mysql_fetch_assoc($rsSubject);
$totalRows_rsSubject = mysql_num_rows($rsSubject);
?>
<?php

include_once('../config.php');
include_once('../../functions.php');

$lawYear = !empty($_POST['lawYear']) ? $_POST['lawYear'] : '';
$subject_id = !empty($_POST['subject_id']) ? $_POST['subject_id'] : '';
$assignment_type = !empty($_POST['assignment_type']) ? $_POST['assignment_type'] : '';

?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/babybar.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Assignments</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/firebase_4_1_5.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Assignments</h1>
	<div class="row">
    	<div class="col-md-12">
          <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <div class="table-responsive">
  			<table class="table table-striped">
              <tr valign="baseline">
                <td nowrap align="right">Law Year:</td>
                <td><select name="lawYear">
                  <option value="L1" <?php if (!(strcmp("L1", $lawYear))) {echo "SELECTED";} ?>>L1</option>
                  <option value="L2" <?php if (!(strcmp("L2", $lawYear))) {echo "SELECTED";} ?>>L2</option>
                  <option value="L3" <?php if (!(strcmp("L3", $lawYear))) {echo "SELECTED";} ?>>L3</option>
                  <option value="L4" <?php if (!(strcmp("L4", $lawYear))) {echo "SELECTED";} ?>>L4</option>
                </select></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Question:</td>
                <td><input type="text" name="question" id="question" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Outline Page:</td>
                <td><input type="text" name="outline_page" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right" valign="top">Answer:</td>
                <td><textarea name="answer" id="answer" cols="50" rows="5"></textarea></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Assignment Type:</td>
                <td><input type="text" name="assignment_type" value="<?php echo $assignment_type; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Subject:</td>
                <td><label for="subject_id"></label>
                  <select name="subject_id" id="subject_id">
                    <?php
do {  
?>
                    <option value="<?php echo $row_rsSubject['subject_id']?>"<?php if (!(strcmp($row_rsSubject['subject_id'], $subject_id))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSubject['subject']?></option>
<?php
} while ($row_rsSubject = mysql_fetch_assoc($rsSubject));
  $rows = mysql_num_rows($rsSubject);
  if($rows > 0) {
      mysql_data_seek($rsSubject, 0);
	  $row_rsSubject = mysql_fetch_assoc($rsSubject);
  }
?>
                  </select></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="Insert record"></td>
              </tr>
            </table>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
            <input type="hidden" name="MM_insert" value="form1">
            <script>
				$(document).ready(function() {
					$('#answer').summernote({
						height: 250							   
					});
				});
			</script>
			<script>
			document.getElementById('definition').focus();
			</script>
          </form>
    	</div>
    </div>
    <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
  <h2 class="sub-header">Edit <a name="edit"></a></h2>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo $editFormAction; ?>" method="POST" name="form_2" id="form_2">
            <div class="table-responsive">
              <table class="table table-striped">
                <tr valign="baseline">
                  <td nowrap align="right">Law Year:</td>
                  <td><select name="lawYear">
                    <option value="L1" <?php if (!(strcmp("L1", $row_rsEdit['lawYear']))) {echo "selected=\"selected\"";} ?>>L1</option>
                    <option value="L2" <?php if (!(strcmp("L2", $row_rsEdit['lawYear']))) {echo "selected=\"selected\"";} ?>>L2</option>
                    <option value="L3" <?php if (!(strcmp("L3", $row_rsEdit['lawYear']))) {echo "selected=\"selected\"";} ?>>L3</option>
                    <option value="L4" <?php if (!(strcmp("L4", $row_rsEdit['lawYear']))) {echo "selected=\"selected\"";} ?>>L4</option>
                    </select></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Question:</td>
                  <td><input type="text" name="question" id="question" value="<?php echo $row_rsEdit['question']; ?>" size="32"></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Outline Page:</td>
                  <td><input type="text" name="outline_page" value="<?php echo $row_rsEdit['outline_page']; ?>" size="32"></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right" valign="top">Answer:</td>
                  <td><textarea name="answer" id="answer_2" cols="50" rows="5"><?php echo $row_rsEdit['answer']; ?></textarea></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Assignment Type:</td>
                  <td><input type="text" name="assignment_type" value="<?php echo $row_rsEdit['assignment_type']; ?>" size="32"></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Subject:</td>
                  <td><label for="subject_id"></label>
                    <select name="subject_id" id="subject_id">
                      <?php
do {  
?>
                      <option value="<?php echo $row_rsSubject['subject_id']?>"<?php if (!(strcmp($row_rsSubject['subject_id'], $row_rsEdit['subject_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSubject['subject']?></option>
                      <?php
} while ($row_rsSubject = mysql_fetch_assoc($rsSubject));
  $rows = mysql_num_rows($rsSubject);
  if($rows > 0) {
      mysql_data_seek($rsSubject, 0);
	  $row_rsSubject = mysql_fetch_assoc($rsSubject);
  }
?>
                    </select></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Update">
                    <input name="id" type="hidden" id="id" value="<?php echo $row_rsEdit['id']; ?>"></td>
                  </tr>
                </table>
              </div>
            <script>
				$(document).ready(function() {
					$('#answer_2').summernote({
						height: 250							   
					});
				});
			</script>
            <input type="hidden" name="MM_update" value="form_2">
            </form>
          </div>
      </div>
      <?php } // Show if recordset not empty ?>
<h2 class="sub-header">View Assignments</h2>
  <div class="table-responsive">
    <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Question</th>
        <th>Outline Page</th>
        <th>Assignment Type</th>
        <th>Subject</th>
        <th>Law Year</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php do { ?>
      <tr>
          <td><?php echo $row_rsView['id']; ?></td>
          <td><?php echo $row_rsView['question']; ?></td>
          <td><?php echo $row_rsView['outline_page']; ?></td>
          <td><?php echo $row_rsView['assignment_type']; ?></td>
          <td><?php echo $row_rsView['subject']; ?></td>
          <td><?php echo $row_rsView['lawYear']; ?></td>
          <td><a href="assignments.php?id=<?php echo $row_rsView['id']; ?>#edit">Edit</a></td>
          <td><a href="assignments.php?delete_id=<?php echo $row_rsView['id']; ?>" onClick="var a = confirm('do you want to delete this record?'); return a;">Delete</a></td>
      </tr>
          <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
    </tbody>
  </table>
      <p>Records <?php echo ($startRow_rsView + 1) ?> to 
        <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
      <table border="0">
        <tr>
          <td><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
              <?php } // Show if not last page ?></td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>

  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSubject);

mysql_free_result($rsEdit);

mysql_free_result($rsView);
?>
