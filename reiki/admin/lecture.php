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
<title>Reiki 3 : Lecture</title>
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
  <h1 class="page-header">Lecture</h1>

  <div id="contents" class="visual">
  <p>
      My name is Manish Khanchandani, my email is manishkk74@gmail.com and my phone number is 4085052726.</p>
  <p>I am a Reiki Master Teacher and I did that in year 1999. I taught about reiki to about 200 people in India.</p>
  <p>Now my mission is to teach reiki to every person in the US to reduce the medical cost of every individual.</p>
  <p>Reiki is divided into Reiki 1, Reiki 2, Reiki 3a and Reiki 3b, In some countries people add Reiki Grandmaster name for name sake.</p>
  <p>After this session, your life will change, your thinking about disease and health will change. You will look at health and disease in a different perspective. You will no longer take modern medicines (unless in emergency).</p>
  <p><strong>MY MAIN AIM: </strong>TO HELP PEOPLE RELY ON REIKI AND STOP TAKING MEDICINES </p>
  <p><strong>Questions:</strong></p>
  <p>1. Who believes in God?</p>
  <p>2. Who believes in Reiki, who believes in alternative medicines like ayurveda, homeopathy, acupunctuure, who believes in only modern medicine?</p>
  <p>3. Did God created human being or it was created by evolution?</p>
  <p>4. Natural line of treatment.</p>
  <p>5. 2 types of diseases: Acute and chronic</p>
  <p>6. Science does not recognise reiki, homeopathy, acupuncture, why?</p>
  <p>7. Science looks at objective perspective, and reiki, homeopathy, acupuncture is based on subjective perspective.</p>
  <p>&nbsp;</p>
  <p><strong>Regarding History of Reiki, In short,</strong></p>
  <p>He read many  Buddhist texts, and then he meditate for 21 days in one mountain, after 21 days he felt a bright light stuck in his third eye and he was able to see many symbols, he assumed he got some power to heal, and he was able to heal when he came back to his home as he healed one girl with toothache. He then treated many people and he taught reiki to many students, one of them was Dr. Hyashi and Dr. Hyashi taught to Dr. Takata who brought Reiki to western world i.e. USA. </p>
  <p></p>
<p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
