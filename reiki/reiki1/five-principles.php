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
<title>Rei-ki : Five Principles</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

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
  <h1 class="page-header">Five Principles of Reiki</h1>
<audio controls class="my-audio">
  <source src="audio/five-principles.ogg" type="audio/ogg">
  <source src="audio/five-principles.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>1. Just for today I will <strong>not be angry</strong> </p>
      <p>2. Just for today I will <strong>not worry          </strong></p>
      <p>3. Just for today I will do <strong>my work honestly</strong>, (make an honest living)          </p>
      <p>4. Just for today I will be <strong>kind to my neighbor</strong> and every living thing. (be kind to everything that has life)          </p>
      <p>5. Just for today I will give <strong>thanks for my many blessings</strong> (honor our fathers and mothers, our teachers, and neighbors, and honor our food) </p>
      <hr>
      <p>Reiki principles are <strong>spiritual ideals</strong><br>

we are all <strong>imperfect</strong><br>
<strong>Just for today</strong>..</p>
      <p>

Read aloud at least twice a day
<br>
Meditate to unlock meaning of principles to you</p>
      <hr>
      <p>

<strong>Worry</strong>: I will not worry<br />
Worry causes stress and anxiety<br />
Laughter is a wonderful healer<br />
Have fun - life's too short to waste it worrying</p>
      <p>

Keep one hand in root chakra and another in heart chakra,<br />
keep it there as long as you feel to.<br />
Reiki will bring your mind, body and spirit in equilibrium</p>
      <p>

This will remove blockages caused by stress, worry, and anxiety</p>
      <hr>
      <p>

<strong>Angry</strong>: I will not be angry<br />
Anger is a powerful emotion<br />
When we get angry, we lose control<br />
We must understand what triggers our anger</p>
      <p>

Take back control of your emotions<br />
Choose to respond to situations in a positive way.</p>
      <p>

Everytime  you meet or talk to someone, there is an exchange of energy<br />
If you become angry for any reason, other person has stolen your energy.<br />
If someone is angry at you, then you are stealing their energies.</p>
      <p>

Don't let them steal your energy.<br />
Anger is a choice response.<br />
Choose to live a healthier life free from anger.</p>
      <p>

Just don't try to react to negative people.</p>
      <p>

Keep one hand in root chakra and another in 3rd eye chakra,<br />
keep it there as long as you feel to.<br />
This will help you to control negative emotions.</p>
      <hr>
      <p>

<strong>Honesty</strong>: I will do my work honestly<br />
Honesty means different things to different people.<br />

Everyone at some point is dishonest.
Live Every Second.</p>
      <p>

Place one hand on 3rd eye chakra and another hand in solar plexus chakra, 
To rebalance this principle</p>
      <hr>
      <p>

<strong>Thanks for many blessings</strong>: I will give thanks for my many blessings</p>
      <p>

Appreciate the many blessings in your life.</p>
      <p>

One hand on 3rd eye chakra and another on the back of the 3rd eye chakra
To rebalance this principle</p>
      <hr>
      <p>

<strong>Kind</strong>: I will be kind to every living thing</p>
      <p>

What goes around comes around</p>
      <p>

Karma is a two edge sword</p>
      <p>

First put one hand in 3rd eye chakra and another at root
then put one hand in throat chakra and another at heart chakra
</p>
      <p>

How people treat you is their karma and how you react is yours.</p>
		<div>
		<a href="seven-chakras-short.php" class="btn btn-primary">Previous</a>
		<a href="attunement-process.php" class="btn btn-primary">Next</a>
		</div>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
