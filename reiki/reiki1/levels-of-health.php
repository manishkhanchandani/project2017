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
<title>Rei-ki : Levels of Health</title>
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
  <h1 class="page-header">Levels of Health </h1>

  <div id="content" class="visual">
  	<h3>Herings law of cure</h3>
	<p>Hering's Law of Cure is the basis of all healing. This is the way the body heals or cures itself. "All cure starts from within out, from the head down and in reverse order as the symptoms have appeared or been suppressed". ... <strong>Hering's Law is a very important law</strong> to understand and remember.</p>
	<p><strong>Hering’s Law of Cure:</strong><br>
	    Symptoms of a chronic disease disappear in definite order, going in reverse and taking about one month for every year the symptoms have been present.<br>
	    Symptoms move from the more vital organs to the less vital organs; from the interior of the body towards the skin.<br>
	    Symptoms move from the top of the body downward.<br>
	</p>
	<p><strong>Hering’s Law of Cure is the basis of all healing</strong></p>
	<p>Hering’s Law of Cure is the basis of all healing. This is the way the body heals or cures itself. &quot;All cure starts from within out, from the head down and in reverse order as the symptoms have appeared or been suppressed&quot;.</p>
	<p>&quot;We don’t catch diseases, we create them by breaking down the natural defenses according to the way we eat, drink, think and live&quot;. Hering’s Law is a very important law to understand and remember. It is imperative to follow this law in order to allow the body to eliminate toxins created daily.</p>
	<p><strong>The definition of Hering’s Law of Cure is as follows:</strong></p>
	<p><strong>&quot;We heal from the head down&quot;.</strong> This means that before we can even begin to heal we must believe we can heal. We must be mentally prepared and strong in order to allow the body to heal. We must not doubt the body’s ability to heal itself.</p>
	<p><strong>&quot;We heal from within out&quot;.</strong> This means we must allow the body to cleanse. In order for the body to eliminate toxins it must be allowed to do so by not suppressing any kind of discharge.</p>
	<p>Most over-the-counter medications and prescriptions do suppress discharges. This is not good as these toxins can go deeper into the body and create other weaknesses. The body must be allowed to cleanse itself in whatever manner it needs to without interruption by synthetic suppressive substances.</p>
	<p>&quot;We heal in reverse order as the symptoms have appeared or been suppressed&quot;. This means that most of the time the last problem someone has is the first problem to be dealt with by the body in the reversal process.</p>
	<p>For instance, let’s say the last illness you had was a sinus infection and a suppressive medication was used to stop any sneezing, coughing, dripping nose or sinus drainage.</p>
	<p>In order for the body to heal itself it must eliminate these toxins and mucous that were suppressed at this time. Since this was the last illness it is the easiest for the body to heal.</p>
	<p>The body may stimulate the Immune System to create a fever to burn out the toxins, the toxins may be eliminated through the Lungs or Bronchioles causing a large amount of phlegm to exit these areas, it might eliminate them through the skin causing breakouts or it could eliminate them through the Colon in which case mucous, old feces and food that hasn’t been eaten for quite a while may be eliminated. These are just a few ways the body heals itself.</p>
	<p>Unfortunately, Hering’s Law of Cure is not used today in Orthodox medicine. Orthodox medicine generally believes that because the symptoms are suppressed the problem is cured, or by removing the organ, which is not functioning correctly, it can cure the problem.</p>
	<p>Perhaps this is why no one knows what a &quot;Cold&quot; is today. A &quot;Cold&quot; is the body’s way of eliminating toxins, which it does by increasing the mucous from the mucous membranes in order to free the toxins. Toxin elimination is imperative in order for the body to stay healthy. Disease reversal is also imperative in order for the body to &quot;cure&quot; a disease.</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div>
		<a href="group_healing.php" class="btn btn-primary">Previous</a>
		<a href="diet.php" class="btn btn-primary">Next</a>
		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
