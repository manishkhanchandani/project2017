<?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');
$MM_authorizedUsers = "admin";
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
<title>Reiki : Lecture</title>
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
  <h1 class="page-header">Lecture Level 3 </h1>

  <div id="contents" class="visual">
      <p><strong>Chapter 1: An introduction to Usui 3rd Degree Reiki</strong><br>
      </p>
      <p>Tools &amp; Techniques to Teach &amp; Pass on Attunements<br>
          Simple &amp; practical format<br>
          Always more to learn<br>
          Beginning of a new Journey<br>
          Where you end up is up to you</p>
      <p>&nbsp;</p>
      <p>Learn the master symbol, receive the attunements, and learn how to attune others to reiki.<br>
          Becoming a Reiki Master is only the beginning of your own personal and spiritual development.<br>
          A Reiki Master; is not a better, wiser or more englightened person, it simply means that as a Reiki Master/Teacher you are now able to pass on the gift to others.<br>
          Hopefully, a person seeking to become a Reiki Master is seeking to not only enhance their own life, but also the lives of others.<br>
      </p>
      <p>It is vital that we attract more people to Reiki.<br>
          We need to learn to live together and come to realise that we are all connected and should live in peace and harmony.<br>
          The more people in tune with Reiki the better our world will undoubtedly become.<br>
          Reiki should be affordable and available to all. <br>
          Reiki is a god given right. It is built into our genetic makeup- our very essence of being.</p>
      <p>&nbsp;</p>
      <p>Like the Reiki Symbols we can enhance and proliferate this natural healing method and way of life.<br>
          The most important pre-requisite to becoming a Usui Reiki Master/ Teacher is the desire and intention to help others.<br>
          We are both honoured &amp; blessed that you have decided to begin your future Reiki study &amp; practice with us at the Reiki store.<br>
          Good luck on the journey.</p>
      <p>&nbsp;</p>
      <p><strong>Chapter 2: Reiki and Symbolism</strong></p>
      <p>There are basically 3 different groups or types of symbols with their own unique set of symbolic beliefs.<br>
          The first group of symbols are tattwa's which have the power or ability to create effect inherent in the form of the symbol.</p>
      <p>The five tattwa symbols:<br>
          A yellow square representing Prithvi/Earth.<br>
          A Blue Circle representing Vayu/Air<br>
          A Silver Crescent representing Apas/Water.<br>
          A Red traingle representing Tejas/Fire<br>
          A Indigo Ovoid representing Akasha / Spirit.<br>
      </p>
      <p>tattwa.png</p>
      <p><img src="../reiki3/images/tattwa.png" width="162" height="249"><br>
      </p>
      <p>Tattwa's along Yantra Mandalas which are visual tools that serve either as centring devices are among those in which the actual shape or form is said to directly stimulate the subconscious energy patterns in the brain and energy body or physical and non-physical reality.<br>
      </p>
      <p>yantra-mandala.png</p>
      <p><img src="../reiki3/images/yantra-mandala.png" width="217" height="214"></p>
      <p>&nbsp;</p>
      <p>The second group envelopes the belief that certain objects and symbols like a Rosary or Prayer Beads can be charged or empowered by intention or ritual or proximity to holy places or people to contain the power to create an effect.</p>
      <p>second-group.png</p>
      <p><img src="../reiki3/images/second-group.png" width="207" height="207"><br>
      </p>
      <p>The third group of symbols are tools or triggers which enable you to connect with; and harness an energy, a spiritual function or information etc. that exists separate from the symbol itself.<br>
          They symbol is more like a light switch that can turn on the power of its own.<br>
          We believe that the Reiki symbols are part of the third group. They are tools, keys, on / off switches to facilitate connection with different aspects of the universal energy for healing.<br>
      </p>
      <p>third-group.png</p>
      <p><img src="../reiki3/images/third-group.png" width="203" height="172"><br>
      </p>
      <p>The Reiki symbols are exactly that, symbols. They are not what they represent.<br>
          The Reiki symbols represent specific energy properties and functions for healing and spiritual enhancement.<br>
          When anyone who is attuned to Reiki visualizes, draws or internally or externally intones the name of any of these symbols it helps them to connect themselves with the Reki energy and activate the function and specific purpose the symbol represents.<br>
      </p>
      <p>Don't only use direct intention to activate the symbols.<br>
          Assimilate the information and experience by using the symbols.<br>
          It is not necessary to understand the meanings of the symbols completely or even to consciously use them to gain and share the benefits of the Reiki system.<br>
          They symbols remind us that there are ways to focus on different aspects of the reiki energy.</p>
      <p></p>
      <p><br>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p></p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
