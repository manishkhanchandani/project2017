<?php
if (!isset($_SESSION)) {
  session_start();
}

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
<title>Rei-ki : How Reiki Works?</title>
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
  <h1 class="page-header"> How Reiki Works?</h1>
<audio controls>
  <source src="audio/how-reiki-works.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>50 trillion cells with omniscient wisdom          </p>
      <p>Every living thing in the universe is connected.          </p>
      <p>Reiki is part of our genetic structure          </p>
      <p>Reiki <strong>stimulates</strong> growth, health, life and healing.          </p>
      <p>Bad habits, poor choices result in the flow of reiki being stifled          </p>
      <p>Reiki <strong>cannot be destroyed</strong>, it continues to exist as part of the universe          </p>
      <p>Reiki is the key that unlocks the body's optimum capabilities          </p>
      <p>There are <strong>7 main energy centers</strong> in the body called Chakras.          </p>
      <p>A full reiki treatment <strong>rebalances the mind, body and spirit</strong> </p>
      <p>Stimulates the <strong>immune system</strong> and remove toxins.          </p>
      <p>Full treatment for<strong> four days </strong>to stimulate the energy.          </p>
      <p>Reiki is the <strong>easiest to learn, master and administer</strong> </p>
      <p>The results are profound. </p>
      <hr>
      <p>Reiki is <strong>ever present</strong> in your body, Attunement adds balance and increases energy level and capacity</p>
      <p>Reiki is described as being similar to <strong>radio waves</strong>.<br>
          <strong>Cannot see the waves</strong> that are everywhere.<br>
          Need to be <strong>tuned into Reiki</strong></p>
      <p>Reiki stays with us for <strong>Life</strong>.<br>
          Reiki is <strong>Pure Energy</strong><br>
          Reiki is <strong>Channelled</strong> through the hands</p>
      <p>The best way to understand how Reiki works is to <strong>experience it</strong>.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
