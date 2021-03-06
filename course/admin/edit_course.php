<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

$MM_authorizedUsers = "admin,superadmin";
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
  $updateSQL = sprintf("UPDATE course_subjects SET subject_name=%s, subject_description=%s, subject_enabled=%s, subject_sorting=%s WHERE subject_id=%s",
                       GetSQLValueString($_POST['subject_name'], "text"),
                       GetSQLValueString($_POST['subject_description'], "text"),
                       GetSQLValueString($_POST['subject_enabled'], "int"),
                       GetSQLValueString($_POST['subject_sorting'], "int"),
                       GetSQLValueString($_POST['subject_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "manage_course.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEdit = "-1";
if (isset($_GET['subject_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['subject_id'] : addslashes($_GET['subject_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM course_subjects WHERE subject_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Subject</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'nav_side.php'); ?>
    </div>
    
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h1 class="page-header">Edit Subject</h1>
	  <form method="POST" name="form1" id="form1" action="<?php echo $editFormAction; ?>">
          <?php if (!empty($error)) { ?>
          <div class="alert alert-danger"> <?php echo $error; ?> </div>
	      <?php } ?>
          <div class="table-responsive">
              <table class="table">
                  <tr valign="baseline">
                      <td nowrap align="right"><strong>Subject Name:</strong></td>
                      <td><input type="text" name="subject_name" value="<?php echo $row_rsEdit['subject_name']; ?>" size="32"></td>
                  </tr>
                  <tr valign="baseline">
                      <td nowrap align="right" valign="top"><strong>Subject Description:</strong></td>
                      <td><textarea name="subject_description" cols="50" rows="5"><?php echo $row_rsEdit['subject_description']; ?></textarea>
                      </td>
                  </tr>
                  <tr valign="baseline">
                      <td nowrap align="right"><strong>Sorting:</strong></td>
                      <td><input type="text" name="subject_sorting" value="<?php echo $row_rsEdit['subject_sorting']; ?>" size="32"></td>
                  </tr>
                  <tr valign="baseline">
                      <td nowrap align="right"><strong>Status:</strong></td>
                      <td><label>
                          <input <?php if (!(strcmp($row_rsEdit['subject_enabled'],"1"))) {echo "checked=\"checked\"";} ?> name="subject_enabled" type="radio" value="1">
                          Enable
                          <input <?php if (!(strcmp($row_rsEdit['subject_enabled'],"0"))) {echo "checked=\"checked\"";} ?> name="subject_enabled" type="radio" value="0">
                          Disable </label></td>
                  </tr>
                  <tr valign="baseline">
                      <td nowrap align="right">&nbsp;</td>
                      <td><input name="submit" type="submit" value="Edit Subject"></td>
                  </tr>
              </table>
          </div>
	      <input type="hidden" name="subject_id" value="<?php echo $row_rsEdit['subject_id']; ?>">
          <input type="hidden" name="MM_update" value="form1">
      </form>
	  <p>&nbsp;</p>
	  <p class="page-header">&nbsp;</p>
	</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEdit);
?>
