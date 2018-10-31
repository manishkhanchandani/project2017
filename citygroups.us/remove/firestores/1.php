<?php
session_start();

include_once('../../init.php');
?>
<!doctype html>
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
<!--<script src="<?php echo HTTP_PATH; ?>js/parse-latest.js"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_KEY; ?>&libraries=places"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>
<!-- Firebase App is always required and must be first -->
<!--<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>-->

<!-- Add additional services that you want to use -->
<!--<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>-->

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'localHead.php'); ?>
<!-- InstanceBeginEditable name="head" -->

<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase-firestore.js"></script>
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

<h1>Test</h1>
<div id="cafe-list"></div>
<h3>Data</h3>

<form name="form1" id="form1" method="post" action="">
    <label>name
    <input name="name" type="text" id="name">
    </label>
    <p>
        <label>city
        <input name="city" type="text" id="city">
        </label>
    </p>
    <p>
        <label>
        <input type="submit" name="Submit" value="Submit">
        </label>
    </p>
</form>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBhpHK-ve2s0ynnr8og8Zx0S69ttEFpDKk",
    authDomain: "project100-fe20e.firebaseapp.com",
    databaseURL: "https://project100-fe20e.firebaseio.com",
    projectId: "project100-fe20e",
    storageBucket: "project100-fe20e.appspot.com",
    messagingSenderId: "674827815611"
  };
  firebase.initializeApp(config);
  const db = firebase.firestore();
  db.settings({timestampsInSnapshots: true});
</script>
<script src="app.js"></script>
  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
