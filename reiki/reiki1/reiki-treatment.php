<?php
if (!isset($_SESSION)) {
  session_start();
}
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
<title>Rei-ki : Reiki Treatment</title>
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
  <h1 class="page-header">Anatomic Illustrations for Reiki</h1>
<audio controls>
  <source src="audio/reiki-treatment.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />
  <div id="content" class="visual">
      <p>Reiki goes to where the body requires healing.</p>
      <p>Reiki is so easy to learn and apply.</p>
      <p>No need to learn anatomy to apply Reiki.</p>
      <hr>
      <p>Simply Place your hands on the body and channel the energy.</p>
      <p>Reiki will do the rest.   </p>
      <hr>
      <p>However, it will be helpful to know where the major organs are, lymphatic and endocrine systems are present.</p>
      <p>To treat specific problems or organs quicly and easily.</p>
      <p>You can search on internet to know about the location of each organs. </p>
      <hr>
      <p><strong>Endocrine System   </strong></p>
      <p>Ductless glands that release hormones.</p>
      <p>Works together with the nervous system &amp; regulates metabolic activities maintaining homeostasis. </p>
      <p><img src="images/endocrine-system1-.jpg" class="img-responsive" /></p>
      <hr>
      <p><strong>Lymphatic System</strong></p>
      <p>System of thin tubes that runs throughout the body.</p>
      <p>Lymph plays an important role in the immune system &amp; in absorbing fats from the intestines.   </p>
      <p>Lymphatic system takes colorless liquid called as lymph. </p>
      <p><img src="images/lymphatic.png" class="img-responsive" /></p>
      <p>&nbsp;</p>
  </div>
  <h1 class="page-header">How Often Do I Need to Get a Reiki Treatment?</h1>
  <div id="content" class="visual">
      <p>Reiki is a simple, natural and safe method of spiritual healing and self-improvement that everyone can use. It has been effective in helping virtually every known illness and malady and always creates a beneficial effect. It also works in conjunction with all other medical or therapeutic techniques to relieve side effects and promote recovery.          </p>
      <p>A treatment feels like a wonderful glowing radiance that flows through and around you. Reiki treats the whole person including body, emotions, mind and spirit creating many beneficial effects that include relaxation and feelings of peace, security and wellbeing. Many have reported miraculous results. </p>
      <p>The answer is, “<strong>It depends</strong>.” It depends on a number of things. Here are some of the considerations:</p>
      <p><strong>How much you are off balance physically, emotionally, or spiritually</strong> – For instance, severely anxious or depressed, chronically or acutely ill, or feeling completely disconnected from your purpose will probably be good reasons for receiving several Reiki healings as often as possible – <strong>daily or a few times per week</strong>, for example. Even weekly sessions can make a difference. In fact, they might make a HUGE difference.</p>
      <p><strong>How long you’ve had the issue</strong> – It seems that acute issues, those present for a shorter amount of time but rather severe in nature, heal faster than chronic issues – those which have been there longer. Think of Reiki as being able to rewind your health – the longer you’ve had it, the longer it might take to heal. The shorter, the faster the healing process may take effect. . I’ve used Reiki to help my family to feel more whole after sicknesses like flu or colds or after surgeries. I’ve given them Reiki several times a day and they’ve recovered quicker than before I knew Reiki.</p>
      <p><strong>How open you are to allowing Reiki to help you</strong> – Feeling hopeless no matter what will slow down the results because you are not allowing the energy to help you. It’s not necessary for you to believe without trying, but the more you are willing to accept the energy that could make a difference in your situation. Also, some people are not ready to heal because their issue is serving them in some way – bringing them attention or covering up emotional pain that’s deeper. Being truly ready to feel better can intensify the effects of the Reiki, speeding healing.</p>
      <p><br>
          So the best thing to consider is to start with <strong>the first Reiki treatment.</strong> Then work with your practitioner and set up a schedule that works for you and what you want to get out of your treatments. Going <strong>once a week or once a month is a good start</strong>. Then as you feel better maybe <strong>only once every other month</strong> and work towards <strong>once every six months</strong>. You know your body best and are the best spokesperson for YOU. Get started soon.</p>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
