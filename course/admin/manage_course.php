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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$error = '';
	
	if (empty($_POST['subject_name'])) {
		$error .= 'Empty Subject Name, ';
	}
	
	$_POST['user_id'] = $_SESSION['MM_UserId'];
	$_POST['course_id'] = $_GET['course_id'];
	if (!empty($error)) {
		unset($_POST["MM_insert"]);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO course_subjects (user_id, course_id, subject_name, subject_description, subject_enabled, subject_sorting) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['course_id'], "int"),
                       GetSQLValueString($_POST['subject_name'], "text"),
                       GetSQLValueString($_POST['subject_description'], "text"),
                       GetSQLValueString($_POST['subject_enabled'], "int"),
                       GetSQLValueString($_POST['subject_sorting'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "manage_course.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$coluser_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsView = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsView = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM course_details WHERE course_id = %s AND course_deleted = 0 AND user_id = %s", $colname_rsView,$coluser_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$maxRows_rsViewSubjects = 500;
$pageNum_rsViewSubjects = 0;
if (isset($_GET['pageNum_rsViewSubjects'])) {
  $pageNum_rsViewSubjects = $_GET['pageNum_rsViewSubjects'];
}
$startRow_rsViewSubjects = $pageNum_rsViewSubjects * $maxRows_rsViewSubjects;

$coluser_rsViewSubjects = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsViewSubjects = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsViewSubjects = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsViewSubjects = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsViewSubjects = sprintf("SELECT * FROM course_subjects WHERE course_id = %s AND user_id = %s AND subject_deleted = 0", $colname_rsViewSubjects,$coluser_rsViewSubjects);
$query_limit_rsViewSubjects = sprintf("%s LIMIT %d, %d", $query_rsViewSubjects, $startRow_rsViewSubjects, $maxRows_rsViewSubjects);
$rsViewSubjects = mysql_query($query_limit_rsViewSubjects, $conn) or die(mysql_error());
$row_rsViewSubjects = mysql_fetch_assoc($rsViewSubjects);

if (isset($_GET['totalRows_rsViewSubjects'])) {
  $totalRows_rsViewSubjects = $_GET['totalRows_rsViewSubjects'];
} else {
  $all_rsViewSubjects = mysql_query($query_rsViewSubjects);
  $totalRows_rsViewSubjects = mysql_num_rows($all_rsViewSubjects);
}
$totalPages_rsViewSubjects = ceil($totalRows_rsViewSubjects/$maxRows_rsViewSubjects)-1;

$queryString_rsViewSubjects = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsViewSubjects") == false && 
        stristr($param, "totalRows_rsViewSubjects") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsViewSubjects = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsViewSubjects = sprintf("&totalRows_rsViewSubjects=%d%s", $totalRows_rsViewSubjects, $queryString_rsViewSubjects);

?><!doctype html>
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Manage Courses</title>
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
<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
	  <h1 class="page-header"><?php echo $row_rsView['course_name']; ?></h1>
	  <p class="page-header"><a href="index.php">Back to Courses </a></p>
	  <h3>Create Subjects </h3>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>
        <div class="table-responsive">
  <table class="table">
            <tr valign="baseline">
                <td nowrap align="right"><strong>Subject Name:</strong></td>
                <td><input type="text" name="subject_name" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right" valign="top"><strong>Subject Description:</strong></td>
                <td><textarea name="subject_description" cols="50" rows="5"></textarea>                </td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right"><strong>Sorting:</strong></td>
                <td><input type="text" name="subject_sorting" value="0" size="32"></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right"><strong>Status:</strong></td>
                <td><label>
                    <input name="subject_enabled" type="radio" value="1">
                    Enable
                    <input name="subject_enabled" type="radio" value="0" checked>
                    Disable </label></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="Add Subject"></td>
            </tr>
        </table>
		</div>
        <input type="hidden" name="user_id" value="">
        <input type="hidden" name="course_id" value="">
        <input type="hidden" name="MM_insert" value="form1">
    </form>
    <?php if ($totalRows_rsViewSubjects > 0) { // Show if recordset not empty ?>
    <h3>View Subjects </h3>
    <p> Records <?php echo ($startRow_rsViewSubjects + 1) ?> to <?php echo min($startRow_rsViewSubjects + $maxRows_rsViewSubjects, $totalRows_rsViewSubjects) ?> of <?php echo $totalRows_rsViewSubjects ?></p>

    <table border="0" width="50%" align="center">
        <tr>
            <td width="23%" align="center"><?php if ($pageNum_rsViewSubjects > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsViewSubjects=%d%s", $currentPage, 0, $queryString_rsViewSubjects); ?>">First</a>
                    <?php } // Show if not first page ?>            </td>
            <td width="31%" align="center"><?php if ($pageNum_rsViewSubjects > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsViewSubjects=%d%s", $currentPage, max(0, $pageNum_rsViewSubjects - 1), $queryString_rsViewSubjects); ?>">Previous</a>
                    <?php } // Show if not first page ?>            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsViewSubjects < $totalPages_rsViewSubjects) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsViewSubjects=%d%s", $currentPage, min($totalPages_rsViewSubjects, $pageNum_rsViewSubjects + 1), $queryString_rsViewSubjects); ?>">Next</a>
                    <?php } // Show if not last page ?>            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsViewSubjects < $totalPages_rsViewSubjects) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsViewSubjects=%d%s", $currentPage, $totalPages_rsViewSubjects, $queryString_rsViewSubjects); ?>">Last</a>
                    <?php } // Show if not last page ?>            </td>
        </tr>
    </table>
    
<div class="table-responsive">
  <table class="table">
        <tr>
            <td><strong>Name</strong></td>
            <td><strong>Description</strong></td>
            <td><strong>Creation Date </strong></td>
            <td><strong>Enabled</strong></td>
            <td><strong>Sorting</strong></td>
            <td><strong>Manage</strong></td>
            <td><strong>Edit</strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        <?php do { ?>
            <tr>
                <td><?php echo $row_rsViewSubjects['subject_name']; ?></td>
                <td><?php echo $row_rsViewSubjects['subject_description']; ?></td>
                <td><?php echo $row_rsViewSubjects['subject_creation_dt']; ?></td>
                <td><?php echo $row_rsViewSubjects['subject_enabled']; ?></td>
                <td><?php echo $row_rsViewSubjects['subject_sorting']; ?></td>
                <td><a href="manage_subjects.php?course_id=<?php echo $row_rsViewSubjects['course_id']; ?>&subject_id=<?php echo $row_rsViewSubjects['subject_id']; ?>">Manage</a></td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php } while ($row_rsViewSubjects = mysql_fetch_assoc($rsViewSubjects)); ?>
    </table>
</div>
    <p>&nbsp;</p>
    <?php } // Show if recordset not empty ?>
		
		
		</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsViewSubjects);
?>
