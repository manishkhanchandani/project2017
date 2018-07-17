<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsUsers = 50;
$pageNum_rsUsers = 0;
if (isset($_GET['pageNum_rsUsers'])) {
  $pageNum_rsUsers = $_GET['pageNum_rsUsers'];
}
$startRow_rsUsers = $pageNum_rsUsers * $maxRows_rsUsers;

mysql_select_db($database_conn, $conn);
$query_rsUsers = "SELECT * FROM users_auth WHERE website LIKE '%rei-ki.us%' ORDER BY display_name ASC";
$query_limit_rsUsers = sprintf("%s LIMIT %d, %d", $query_rsUsers, $startRow_rsUsers, $maxRows_rsUsers);
$rsUsers = mysql_query($query_limit_rsUsers, $conn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);

if (isset($_GET['totalRows_rsUsers'])) {
  $totalRows_rsUsers = $_GET['totalRows_rsUsers'];
} else {
  $all_rsUsers = mysql_query($query_rsUsers);
  $totalRows_rsUsers = mysql_num_rows($all_rsUsers);
}
$totalPages_rsUsers = ceil($totalRows_rsUsers/$maxRows_rsUsers)-1;

$queryString_rsUsers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsUsers") == false && 
        stristr($param, "totalRows_rsUsers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsUsers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsUsers = sprintf("&totalRows_rsUsers=%d%s", $totalRows_rsUsers, $queryString_rsUsers);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administrator : Users</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
  <h1 class="page-header">Administrator : Users</h1>

  <div id="content" class="visual">
      <?php if ($totalRows_rsUsers == 0) { // Show if recordset empty ?>
          <p>No User Found.</p>
          <?php } // Show if recordset empty ?>
		  
		  
		  <?php if ($totalRows_rsUsers > 0) { // Show if recordset not empty ?>
		      <p> <strong>Records</strong> <?php echo ($startRow_rsUsers + 1) ?> to <?php echo min($startRow_rsUsers + $maxRows_rsUsers, $totalRows_rsUsers) ?> of <?php echo $totalRows_rsUsers ?>    </p>
		      <table border="0" width="50%" align="center">
	                    <tr>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, 0, $queryString_rsUsers); ?>">First</a>
                                    <?php } // Show if not first page ?>                            </td>
	                        <td width="31%" align="center"><?php if ($pageNum_rsUsers > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, max(0, $pageNum_rsUsers - 1), $queryString_rsUsers); ?>">Previous</a>
                                    <?php } // Show if not first page ?>                            </td>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers < $totalPages_rsUsers) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, min($totalPages_rsUsers, $pageNum_rsUsers + 1), $queryString_rsUsers); ?>">Next</a>
                                    <?php } // Show if not last page ?>                            </td>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers < $totalPages_rsUsers) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, $totalPages_rsUsers, $queryString_rsUsers); ?>">Last</a>
                                    <?php } // Show if not last page ?>                            </td>
                        </tr>
                    </table>
		      <div class="table-responsive">
  <table class="table">
		          <tr>
		              <td><strong>Edit</strong></td>
		              <td><strong>user_id</strong></td>
                          <td><strong>display_name</strong></td>
                          <td><strong>profile_img</strong></td>
                          <td><strong>email</strong></td>
                          <td><strong>access_level</strong></td>
                          </tr>
		          <?php do { ?>
		              <tr>
		                  <td><a href="users_edit.php?user_id=<?php echo $row_rsUsers['user_id']; ?>">Edit</a></td>
		                  <td><?php echo $row_rsUsers['user_id']; ?></td>
		                  <td><?php echo $row_rsUsers['display_name']; ?></td>
		                  <td><img src="<?php echo $row_rsUsers['profile_img']; ?>" class="img-responsive" style="max-width: 50px;" /></td>
		                  <td><?php echo $row_rsUsers['email']; ?></td>
		                  <td><?php echo $row_rsUsers['access_level']; ?></td>
		                  </tr>
		              <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
                    </table>
					</div>
		      <p> <strong>Records</strong> <?php echo ($startRow_rsUsers + 1) ?> to <?php echo min($startRow_rsUsers + $maxRows_rsUsers, $totalRows_rsUsers) ?> of <?php echo $totalRows_rsUsers ?>    </p>
		      <table border="0" width="50%" align="center">
	                    <tr>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, 0, $queryString_rsUsers); ?>">First</a>
                                    <?php } // Show if not first page ?>                            </td>
	                        <td width="31%" align="center"><?php if ($pageNum_rsUsers > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, max(0, $pageNum_rsUsers - 1), $queryString_rsUsers); ?>">Previous</a>
                                    <?php } // Show if not first page ?>                            </td>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers < $totalPages_rsUsers) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, min($totalPages_rsUsers, $pageNum_rsUsers + 1), $queryString_rsUsers); ?>">Next</a>
                                    <?php } // Show if not last page ?>                            </td>
	                        <td width="23%" align="center"><?php if ($pageNum_rsUsers < $totalPages_rsUsers) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, $totalPages_rsUsers, $queryString_rsUsers); ?>">Last</a>
                                    <?php } // Show if not last page ?>                            </td>
                        </tr>
                    </table>
		      <?php } // Show if recordset not empty ?>
      <p>&nbsp; </p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUsers);
?>
