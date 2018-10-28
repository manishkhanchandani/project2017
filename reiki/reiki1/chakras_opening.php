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
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
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
<title>Rei-ki : Opening the Chakras</title>
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
  <h1 class="page-header">Opening Your Chakras </h1>

<audio controls class="my-audio">
  <source src="audio/chakras_opening.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p><img src="images/Opening-Chakras-1.jpg" class="img-responsive"></p>
      <p>Opening the chakras can be done in several ways of various difficulties. Here’s are simple instruction explaining how to open your chakras in 3 steps:</p>
		<p>Step 1: Know your chakras<br>
		    Step 2: Identify the primary chakra or chakras you want to work at opening first<br>
		    Step 3: Activate the energy in the chakra you want to open<br>
		    There are numberous ways to open chakras, some are prescribed by traditional schools of thoughts associated with Eastern spirituality; some are more modern and are often derived from these more ancient practices. They were created by people interested today in psychology, healing, and holistic medicine with the purpose of helping us in our everyday lives. We will expose mostly contemporary ideas and techniques that you can easily apply on your own.</p>
		<p>Opening Chakras Step 1: Know your Chakras<br>
		    The first step to opening your chakras is to know them. These centers of energies have different qualities and characteristics that are useful to recognize in order to find a better balance overall. For instance, practices to open the root chakra will be different from the ones used to open the heart or third eye chakra.</p>
		<p>Action item: Know you chakras. Get online and learn more about the seven chakras and their individual characteristics.<br>
		    Opening Chakras Step 2: Identify which chakra needs most help<br>
		    The second step consists in identifying which chakra you want to work on first. The chakras are all connected. If one is imbalanced, whether it’s overactive and too open or deficient and “closed” or energy does not flow well through it, the neighboring chakras and the whole system may be affected as well. That’s why it might sometimes be difficult to pinpoint which chakra needs the most help.</p>
		<p>Here are a few pointers:</p>
		<p>Take the chakra test; it will help identify possible areas to focus on<br>
		    Check whether you have a localized physical pain; it might be related to the activity of the chakra corresponding to that area<br>
		    Look at what’s happening in your and what is most problematic or causes most concerns (e.g., a relationship, finances, feeling of safety, lack of motivation, emotional roller-coaster, etc.)<br>
		    Have a person who’s energy conscious do a checkup</p>
		<p>Action item: Identify one or two chakras to open first. Take a chakra test and check which chakra needs the most attention.</p>
		<p>Opening Chakras Step 3: Activate the energy to open your chakra<br>
		    The third step is to activate the energy in the chakra you want to open. It’s useful to think of it not just in terms of “opening” your chakra, but also restoring flow, increasing awareness of its state and variations, and balancing inflow and outflow of energy. The main principle at work when opening your chakras is the idea of balance or balancing.</p>
		<p>To activate the energy in the chakras you want to open, you may practice the following:</p>
		<p>Physical activity focused on the chakra’s location in the body<br>
		    Breathing exercises<br>
		    Meditation on a specific chakra<br>
		    Introspection and self-inquiry to address the psychological and emotion components of the blockage<br>
		    Self-healing hands-on techniques (e.g. massage, “chakra connection” technique)<br>
		    Healing session to balance your chakras		</p>
		<p>When you start activating energy in a chakra that had an imbalance, “stuff” may come up. In other words, the “stuff” that was contributing to closing the chakra might come to your awareness, so you have a chance to deal with it more consciously. Be mindful of taking good care of yourself, with enough rest, moments of reflection and introspection, as well as physical activity to keep things moving.</p>
		<p>Action item: Check which type of practice makes most sense or resonates with you: Is it a physical practice or meditative one? Can you make a little time to center yourself and reflect or do you prefer to schedule a one-hour healing session?</p>
		<p>Action item: Check the list of 7 chakras and corresponding pages to learn more about specific practices to open each individual chakra.</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="chakras_crown.php" class="btn btn-primary">Previous</a>
		<a href="seven-chakras-short.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
