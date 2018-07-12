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
<title>Rei-ki : What is Reiki?</title>
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
  <h1 class="page-header">What is Reiki?</h1>
<audio controls class="my-audio">
  <source src="audio/what-is-reiki.ogg" type="audio/ogg">
  <source src="audio/what-is-reiki.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Reiki is a form of <strong>hands on healing</strong></p>
      <p>Origins in <strong>india</strong> and east</p>
      <p>Original <strong>knowledge lost</strong>, <strong>Rediscovered</strong> by Dr. Mikao usui</p>
      <p>Rei - divine / Universal, 
          Ki - energy</p>
      <p><strong>Divine Energy</strong> - a positive energy</p>
      <p>It is known as <strong>Prana</strong> in India,<br>
          <strong>Chi</strong> in China<br>
          <strong>Reiki</strong> in Japan</p>
      <p>pronounced as Ray - key</p>
      <p>Ki energy can be <strong>activated</strong> for the <strong>purpose of healing</strong>.</p>
      <p>Reiki stimulates a persons <strong>own natural healing abilities</strong>.</p>
      <p>Reiki is the <strong>greatest secret</strong> in the science of energetics.</p>
      <hr>
      <p>In the life force energy of Reiki, the person who is <strong>attuned</strong> as a Reiki healer has had her body's energy channels opened and <strong>cleared of obstructions</strong> by the Reiki <strong>attunments</strong>.</p>
      <hr>
      <p>She now not only receives an increase in this life energy or ki for her own healing, but becomes connected to the source of all universal Chi's or Ki.</p>
      <hr>
      <p>Upon receiving the first attunement in Reiki I, the receiver becomes a <strong>channel for this universal healing energy</strong>. From the time of the attunement and through rest of her life, all she needs to do to connect with healing Ki is to place her hands upon herself or someone else and it will flow through her automatically.</p>
      <hr>
      <p>The attunement, by placing the person in direct contact with the source of Ki, also <strong>increases the life force energy</strong> of the person who has received it.</p>
      <hr>
      <p>She experiences an energy that <strong>first heals her</strong>, and then also heals others without depleting her. </p>
      <p>In the few short minutes of the attunement process, the receiver of Reiki energy is given a <strong>gift that forever changes her life</strong> in every positive way.</p>
      <hr>
      <p>After receving Reiki 1, it is best to do as many healing sessions as possible for atleast the <strong>21 days</strong>, including a daily self-healing.</p>
      <hr>
      <p>Reiki 1 healer are for primarily for <strong>self healing</strong>.<br>
          Also healing others who are <strong>physically present</strong>.</p>
      <hr>
		<div>
		<a href="index.php" class="btn btn-primary">Previous</a>
		<a href="how-reiki-works.php" class="btn btn-primary">Next</a>
		</div>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
