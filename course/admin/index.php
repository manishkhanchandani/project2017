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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$error = '';
	
	if (empty($_POST['course_name'])) {
		$error .= 'Empty Course Name, ';
	}
	
	$_POST['user_id'] = $_SESSION['MM_UserId'];
	if (!empty($error)) {
		unset($_POST["MM_insert"]);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO course_details (course_name, course_description, user_id, live) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['course_name'], "text"),
                       GetSQLValueString($_POST['course_description'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['live'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_rsView = 500;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM course_details WHERE user_id = %s AND course_deleted = 0 ORDER BY course_name ASC", $colname_rsView);
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
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Course Creation</title>
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
	
	
	
<h1>Course Management</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>
    <div class="table-responsive">
  <table class="table">
        <tr valign="baseline">
            <td nowrap align="right"><strong>Course Name:</strong></td>
            <td><input type="text" name="course_name" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right" valign="top"><strong>Course Description:</strong></td>
            <td><textarea name="course_description" cols="50" rows="5"></textarea>            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Status:</td>
            <td><label>
                <input name="live" type="radio" value="1">
                Online
                <input name="live" type="radio" value="0" checked>
                Offline </label></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Add New Course"></td>
        </tr>
    </table>
	</div>
    <input type="hidden" name="MM_insert" value="form1">
    <input name="user_id" type="hidden" id="user_id">
</form>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <h3>View My Courses </h3>
    <div class="table-responsive">
  <table class="table">
        <tr>
            <td><strong>Course Name </strong></td>
                <td><strong>Created On </strong></td>
                <td><strong>Description</strong></td>
                <td><strong>Manage</strong></td>
                <td><strong>Edit</strong></td>
                <td><strong>Delete</strong></td>
            </tr>
        <?php do { ?>
            <tr>
                <td><?php echo $row_rsView['course_name']; ?></td>
                <td><?php echo $row_rsView['course_created']; ?></td>
                <td><?php echo $row_rsView['course_description']; ?></td>
                <td><a href="manage_course.php?course_id=<?php echo $row_rsView['course_id']; ?>">Manage</a></td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
            </table>
		</div>
    <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
        <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                        <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                        <?php } // Show if not last page ?>                </td>
            </tr>
        </table>
    <?php } // Show if recordset not empty ?>

	</div>
	</div>
<!-- InstanceEndEditable -->
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsView);
?>
