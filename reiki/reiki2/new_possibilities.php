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
<title>Rei-ki : New Possibilities with Reiki 2</title>
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
  <h1 class="page-header">New Possibilities with Reiki 2</h1>

  <div id="content" class="visual">
      <p>The 2nd degree brings new possibilities for the practitioner who now can use the Reiki symbols.<br>
The symbols are the keys that give the practitioner access to the full potential of the universal life force. There are three major new skills gained through the study of second degree Reiki.</p>
      <p>The Reiki practitioner can increase and focus the universal life force. <br>
          This can be used for self healing or to heal others.</p>
      <p>The Reiki practiioner can complete a full Reiki treatment in about 15 minutes.<br>
          The Reiki practitioner can now help more people in less time.</p>
      <p>The Reiki practitioner can send distant healing across time and space.<br>
          Through the symbols the second degree practiioner can connect to another person or being anywhere in the universe - either in the past, present or in the future.<br>
      </p>
      <p>As you incorporate the Reiki symbols into your life, you will find unlimited uses for them.<br>
          The greater your understanding and imagination, the more varied applications you will discover and develop.<br>
          The student will find that their personal vibratory level and psychic abilities have heightened.<br>
          The student will go through a 21 day detoxification process as their mind, body and spirit finds equilibrium.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
