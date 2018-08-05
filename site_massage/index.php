<?php require_once('../Connections/conn.php'); ?>
<?php

$starttime = microtime(true);
session_start();
include_once('init.php');
$currentPage = HTTP_PATH;

if (!empty($_SESSION['MM_UserId']) && empty($_SESSION['MM_Email'])) {
	header("Location: users/update_email.php");
	exit;
}

$endtime = microtime(true);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/ineedmassage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Free Massage Service</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

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
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
    <h1 class="page-header">Dashboard</h1>
	<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 main">
		<div>
			<h3>Like <strong>Massage</strong>?</h3>
			<h3>Free Massage Exchange <strong></strong>! </h3>
			</div>
	</div>
	<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
		<h3 class="sub-header"><strong>Create Massage Request</strong> </h3>
		<div>
			<?php include('components/login_first.php'); ?>
			<?php if (!empty($_SESSION['MM_UserId'])) include('components/create_request.php'); ?>
		</div>
	</div>
	<!--<?php echo $query_rsView; echo "\n\nTime Taken:"; echo $duration = $endtime - $starttime; 
	
	?> -->
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
