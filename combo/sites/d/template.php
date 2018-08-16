<?php
$jsVersion = 1.1;
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">

<title><?php echo $pageTitle; ?></title>
<base href="<?php echo $dir; ?>">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/NavMulti.css">

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="js/firebase/5.3.1/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="js/firebase/5.3.1/firebase-auth.js"></script>
<script src="js/firebase/5.3.1/firebase-database.js"></script>

<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'headCombo.php'); ?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'sites'.DIRECTORY_SEPARATOR.$domainConfig['site_url'].DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container">
<?php echo $contentForTemplate; ?>
</div>
</body>
</html>