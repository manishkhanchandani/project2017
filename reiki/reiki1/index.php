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
<title>Rei-ki : Reiki Level 1</title>
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
  <h1 class="page-header">Usui Reiki Level 1</h1>

  <div id="content" class="visual">
      <ul>
          <li><strong><a href="what-is-reiki.php">What</a> is</strong> Reiki?, </li>
          <li>How Reiki <strong><a href="how-reiki-works.php">Works</a></strong>? </li>
          <li><strong><a href="history-of-reiki.php">History</a></strong> of Reiki?              </li>
          <li> <strong><a href="levels-of-health.php">Levels of Health</a></strong>?              </li>
          <li><strong> <a href="pulse_diagnosis.php">Pulse Diagnosis</a> </strong></li>
          <li> Seven <strong><a href="seven-chakras.php">Chakras</a></strong></li>
          <li> Seven <strong><a href="seven-chakras-short.php">Chakras Short </a></strong></li>
          <li>Five <strong><a href="five-principles.php">Principles</a></strong></li>
          <li>Meditation</li>
          <li><strong><a href="attunement-process.php">Attunement</a></strong> Process</li>
          <li>How to <strong><a href="reiki-treatment.php">Heal Others</a></strong> and <a href="treat_others.php"><strong>treating</strong></a> others </li>
          <li><strong><a href="group_healing.php">Group</a></strong> Healing </li>
          </ul>
      <p>&nbsp;</p>
      <p><strong>MY MAIN AIM: </strong>TO HELP PEOPLE RELY ON REIKI AND STOP TAKING MEDICINES </p>
      <p>After this session, your life will change, your thinking about disease and health will change. You will look at health and disease in a different perspective.</p>
      <p><strong>Questions:</strong></p>
      <p>1. Who believes in God?</p>
      <p>2. Who believes in Reiki, who believes in alternative medicines like ayurveda, homeopathy, acupunctuure, who believes in only modern medicine?</p>
      <p>3. Did God created human being or it was created by evolution?</p>
      <p>4. Natural line of treatment.</p>
      <p>5. 2 types of diseases: Acute and chronic</p>
      <p>6. Science does not recognise reiki, homeopathy, acupuncture, why?</p>
      <p>7. Science looks at objective perspective, and reiki, homeopathy, acupuncture is based on subjective perspective.</p>
		<div>
		<a href="quiz.php" class="btn btn-primary">Previous</a>
		<a href="what-is-reiki.php" class="btn btn-primary">Next</a>
		</div>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
