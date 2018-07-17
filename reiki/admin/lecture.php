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
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><style type="text/css">
<!--
.style1 {
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 14px;
	color: rgb(51, 51, 51);
}
-->
</style><!-- InstanceEndEditable -->
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
  <p><strong>
      My Info</strong></p>
  <p>My name is Manish Khanchandani, my email is manishkk74@gmail.com and my phone number is 4085052726.</p>
  <p>I am a Reiki Master Teacher and I did that in year 1999. I taught about reiki to about 200 people in India.</p>
  <p>Now my mission is to teach reiki to every person in the US to reduce the medical cost of every individual.</p>
  <p>Reiki is divided into Reiki 1, Reiki 2, Reiki 3a and Reiki 3b, In some countries people add Reiki Grandmaster name for name sake.</p>
  <p>After this session, your life will change, your thinking about disease and health will change. You will look at health and disease in a different perspective. You will no longer take modern medicines (unless in emergency).</p>
  <hr>
  <p><strong>MY MAIN AIM: </strong>TO HELP PEOPLE RELY ON REIKI AND STOP TAKING MEDICINES </p>
  <p><strong>Questions:</strong></p>
  <p>1. Who believes in God?</p>
  <p>2. Who believes in Reiki, who believes in alternative medicines like ayurveda, homeopathy, acupunctuure, who believes in only modern medicine?</p>
  <p>3. Did God created human being or it was created by evolution?</p>
  <p>4. Natural line of treatment.</p>
  <p>5. 2 types of diseases: Acute and chronic</p>
  <p>6. Science does not recognise reiki, homeopathy, acupuncture, why?</p>
  <p>7. Science looks at objective perspective, and reiki, homeopathy, acupuncture is based on subjective perspective.</p>
  <p>8. How many of you like to do meditation. </p>
  <p><strong>Regarding History of Reiki, In short,</strong></p>
  <p>Dr. Mikao Usui  read many  Buddhist texts, and then he meditate for 21 days in one mountain of kurama, after 21 days he felt a bright light stuck in his third eye and he was able to see many symbols, he assumed he got some power to heal, and he was able to heal when he came back to his home as he healed one girl with toothache. He then treated many people and he taught reiki to many students, one of them was Dr. Hyashi and Dr. Hyashi taught to Dr. Takata who brought Reiki to western world i.e. USA. </p>
  <hr>
  <p>&nbsp;</p>
  <p><strong>We will be studying following sections in Reiki</strong></p>
  <p>what is reiki, how reiki works, history of reiki, levels of health, pulse diagnosis, seven chakras, five principles, meditation in reiki,  attunement process, how to heal others, self healing, group healing, diet for healthy living.</p>
  <hr>
  <p><strong>What is Reiki?</strong></p>
  <p>Reiki is made up of two words Rei and ki, rei means universal or divine and ki means energy. so it is a universal energy or universal life force or divine life force or divine energy.</p>
  <p>it is also called chi in china, prana in india, </p>
  <p>This ki energy is activated for the purpose of healing.</p>
  <p>&nbsp;</p>
  <hr>
  <p><strong>How Reiki Works?</strong></p>
  <p>Reiki stimulates a persons own natural healing abilities to cure the disease. upon receiving the first attunement, receiver becomes the channel for this energy. and he can heal with his hands. </p>
  <p><span style="font-variant-ligatures:normal; font-variant-caps:normal; letter-spacing:normal; orphans:2; text-align:start; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px; -webkit-text-stroke-width:0px; background-color:rgb(255, 255, 255); text-decoration-style:initial; text-decoration-color:initial; display:inline !important; float:none; font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; color:rgb(51, 51, 51); font-style:normal; font-weight:400; ">There are </span><strong style="box-sizing: border-box; font-weight: 700; color: rgb(51, 51, 51); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">7 main energy centers</strong><span style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; color:rgb(51, 51, 51); font-style:normal; font-weight:400; "> in the body called Chakras. Reiki restores the balance in these chakras which help in treating the disorders. Reiki stimulates the immune system and remove toxins.</span></p>
  <p><span class="style1">Reik is pure energy. <span style="font-variant-ligatures:normal; font-variant-caps:normal; letter-spacing:normal; orphans:2; text-align:start; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px; -webkit-text-stroke-width:0px; background-color:rgb(255, 255, 255); text-decoration-style:initial; text-decoration-color:initial; display:inline !important; float:none; font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; color:rgb(51, 51, 51); font-style:normal; font-weight:400; ">The best way to understand how Reiki works is to </span><strong style="box-sizing: border-box; font-weight: 700; color: rgb(51, 51, 51); font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;">experience it</strong><span style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; color:rgb(51, 51, 51); font-style:normal; font-weight:400; ">.</span></span></p>
  <hr>
  <p>&nbsp;  </p>
  <p></p>
<p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
