<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
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
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php


$colname_rsGroupInfo = "-1";
if (isset($_GET['group_id'])) {
  $colname_rsGroupInfo = (get_magic_quotes_gpc()) ? $_GET['group_id'] : addslashes($_GET['group_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsGroupInfo = sprintf("SELECT * FROM citygroup_groups WHERE group_id = %s", $colname_rsGroupInfo);
$rsGroupInfo = mysql_query($query_rsGroupInfo, $conn) or die(mysql_error());
$row_rsGroupInfo = mysql_fetch_assoc($rsGroupInfo);
$totalRows_rsGroupInfo = mysql_num_rows($rsGroupInfo);


if (!($_SESSION['MM_UserGroup'] === 'admin' || (isset($_SESSION['MM_UserId']) && $row_rsGroupInfo['group_manager_id'] === $_SESSION['MM_UserId']))) {
	echo 'not a valid user';
	exit;
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/citygroups.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/parse-latest.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_KEY; ?>&libraries=places"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>

<!-- Firebase App is always required and must be first -->
<!--<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-app.js"></script> -->

<!-- Add additional services that you want to use -->
<!--<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-database.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-firestore.js"></script> -->

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'localHead.php'); ?>
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
  <h1 class="page-header">Dashboard</h1>

  <div class="row placeholders">
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
  </div>

  <h2 class="sub-header">Section title</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1,001</td>
          <td>Lorem</td>
          <td>ipsum</td>
          <td>dolor</td>
          <td>sit</td>
        </tr>
        <tr>
          <td>1,002</td>
          <td>amet</td>
          <td>consectetur</td>
          <td>adipiscing</td>
          <td>elit</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>Integer</td>
          <td>nec</td>
          <td>odio</td>
          <td>Praesent</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>libero</td>
          <td>Sed</td>
          <td>cursus</td>
          <td>ante</td>
        </tr>
        <tr>
          <td>1,004</td>
          <td>dapibus</td>
          <td>diam</td>
          <td>Sed</td>
          <td>nisi</td>
        </tr>
        <tr>
          <td>1,005</td>
          <td>Nulla</td>
          <td>quis</td>
          <td>sem</td>
          <td>at</td>
        </tr>
        <tr>
          <td>1,006</td>
          <td>nibh</td>
          <td>elementum</td>
          <td>imperdiet</td>
          <td>Duis</td>
        </tr>
        <tr>
          <td>1,007</td>
          <td>sagittis</td>
          <td>ipsum</td>
          <td>Praesent</td>
          <td>mauris</td>
        </tr>
        <tr>
          <td>1,008</td>
          <td>Fusce</td>
          <td>nec</td>
          <td>tellus</td>
          <td>sed</td>
        </tr>
        <tr>
          <td>1,009</td>
          <td>augue</td>
          <td>semper</td>
          <td>porta</td>
          <td>Mauris</td>
        </tr>
        <tr>
          <td>1,010</td>
          <td>massa</td>
          <td>Vestibulum</td>
          <td>lacinia</td>
          <td>arcu</td>
        </tr>
        <tr>
          <td>1,011</td>
          <td>eget</td>
          <td>nulla</td>
          <td>Class</td>
          <td>aptent</td>
        </tr>
        <tr>
          <td>1,012</td>
          <td>taciti</td>
          <td>sociosqu</td>
          <td>ad</td>
          <td>litora</td>
        </tr>
        <tr>
          <td>1,013</td>
          <td>torquent</td>
          <td>per</td>
          <td>conubia</td>
          <td>nostra</td>
        </tr>
        <tr>
          <td>1,014</td>
          <td>per</td>
          <td>inceptos</td>
          <td>himenaeos</td>
          <td>Curabitur</td>
        </tr>
        <tr>
          <td>1,015</td>
          <td>sodales</td>
          <td>ligula</td>
          <td>in</td>
          <td>libero</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsGroupInfo);
?>
