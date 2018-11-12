<?php require_once('../../Connections/conn.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$colname_rsVerify = "-1";
if (isset($_GET['user_id'])) {
  $colname_rsVerify = (get_magic_quotes_gpc()) ? $_GET['user_id'] : addslashes($_GET['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsVerify = sprintf("SELECT * FROM users_auth WHERE user_id = %s", $colname_rsVerify);
$rsVerify = mysql_query($query_rsVerify, $conn) or die(mysql_error());
$row_rsVerify = mysql_fetch_assoc($rsVerify);
$totalRows_rsVerify = mysql_num_rows($rsVerify);

$error = '';
if ($totalRows_rsVerify === 0) {
	header("Location: ".COMPLETE_HTTP_PATH);
	exit;
}
if (empty($_GET['code'])) {
	header("Location: ".COMPLETE_HTTP_PATH);
	exit;
}

if ((int) $row_rsVerify['email_verified'] === 1) {
	$error = 'Email Already verified. Please go to login page.';
} else if ($row_rsVerify['email_verified_code'] !== $_GET['code']) {
	$error = 'Verification code is incorrect.';
} else {
	mysql_query("update users_auth set email_verified = 1 WHERE user_id = ".$colname_rsVerify);
	$error = 'Email verified successfully. Please go to login page.';
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/citygroups.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Email Verification</title>
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
  <h1 class="page-header">Confirmation</h1>

<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>

  
</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsVerify);
?>
