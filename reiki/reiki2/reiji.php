<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin,reiki12,reiki123,reiki2";
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
<title>Rei-ki : Reiji-Ho The Second pilar of Reiki</title>
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
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
  <h1 class="page-header">Reiji-Ho The Second pilar of Reiki</h1>

  <div id="content" class="visual">
      <p>Translated into English, Reiji means &quot;indication of the Reiki power.&quot;<br>
Ho means &quot;methods&quot;.<br>
Reiji-Ho consists of 3 short rituals that are carried out before each treatment.<br>
</p>
      <p>Step 1: Fold your hands in front of your chest in the Gasho position with your eyes closed.<br>
          Now connect with the Reiki power.<br>
          Ask the Reiki power to flow through you. (within few minutes you will feel that reiki energy is flowing through you, it will enter through your crown chakra and it will go to your heart chakra or hands)<br>
          2nd Degree Practitioners and / or Reiki Masters can use the distance healing symbol to connect with the Reiki power. (repeat the wish 3 times in mind that Reiki may flow, then send with mental healing symbol and then seal it with power symbol, <br>
          As soon as you feel the energy, continue on to the next step.</p>
      <p>Step 2: Pray for the recovery health of the patient on all levels, let Reiki do what is required.<br>
          Raise your hands up (still in Gassho) in front of your 3rd eye &amp; ask Reiki to guide your hands to where the energy is needed.<br>
      </p>
      <p>Step 3: Then use and follow your intuition.<br>
          This technique guides your hands like magnets to the places on the body that needs treatment. (recipient body will attract your hand to particular position automatically)<br>
          Trusting your intuition &amp; the phenomenon that is Reiki.<br>
          Totally detach yourself, just let go and believe in Reiki.<br>
          Don't worry if nothing seems to happen - it will come in time - and when it does, you will know.<br>
          Reiki will guide your hands to the next spot when appropriate.<br>
      </p>
      <p>When there are no more areas requiring treatment your hands will be guided to rest, palms down, on your thights / in your lap.<br>
          Conclude Reiji Ho by once more performing gassho.</p>
      <p> Reiji Ho (in a nutshell, intuition)<br>
          Step 1:<br>
          Hands in Gassho;<br>
          Connect to Reiki</p>
      <p>Step 2:<br>
          Pray for the Recipients Health &amp; Well Being. Raise Hands to Third Eye ask the Reiki power to guide your hands to where the energy is needed.</p>
      <p>Step 3:<br>
          Use your intuition</p>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
