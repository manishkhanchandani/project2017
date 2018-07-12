<?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

$MM_authorizedUsers = "reiki1,admin,reiki12,reiki123";
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
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki : Self Healing</title>
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
  <h1 class="page-header">Reiki Self Treatment </h1>
<audio controls class="my-audio">
  <source src="audio/self-healing.ogg" type="audio/ogg">
  <source src="audio/self-healing.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>After the attunement you can work with Reiki properly.</p>
      <p>1st Heal yourself then family, friends &amp; others.</p>
      <hr>
      <p>Takes time to practice &amp; experience to master Reiki skills &amp; techniques.</p>
      <p>Similar to apprenticeship.  </p>
      <hr>
      <p>Self healing is the starting point.</p>
      <p>Reiki is always available to you.</p>
      <p>Possibilities are endless, the benefits immeasurable.</p>
      <hr>
      <p><strong>How Reiki can help you?</strong></p>
      <p>Reiki works holistically on the mind, body and spirit.</p>
      <p>More you use, more stronger it becomes </p>
      <p>e.g. it improves health, energizes you, relax you, bring deep relaxation, calms you, focuses your mind, releases pain, accelerates natural healing, detoxifies the body, dissovles energy blockages, etc. </p>
      <hr>
      <p><strong>How to treat yourself with Reiki?</strong></p>
      <p>No right or wrong way.</p>
      <p>hand positions are only a guide - use your intuition.</p>
      <p>3 to 5 minutes on each position. Apply reiki on 7 chakras. Also apply reiki to positions based on weakness in any of 5 principles of reiki.</p>
      <p>Drink large glass of water after each treatment.</p>
      <p>Try to recollect all the experiences you felt during the session and note it down.</p>
		<div>
		<a href="attunement-process.php" class="btn btn-primary">Previous</a>
		<a href="reiki-treatment.php" class="btn btn-primary">Next</a>
		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
