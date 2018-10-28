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
<title>Rei-ki : Gassho</title>
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
  <h1 class="page-header">Gassho The First Pillar of Reiki</h1>

  <div id="content" class="visual">
      <p>The five Reiki principles which are taught in Reiki level 1 are based on the three pillars of Reiki:<br>
A. <strong>Gassho</strong>: Pronounced as Gash-Show<br>
B. <strong>Reiji-Ho</strong>: pronounced as Ray-Gee-Hoe<br>
C. <strong>Chiryo</strong>: Pronounced as - Chi-Rye-Oh</p>
      <p>&nbsp;</p>
      <p><strong>Gassho</strong> literally means &quot;two hands coming together.&quot; It is a ritual gesture formed by placing the hands - palms together, in the 'prayer' or 'praying hands' position.</p>
      <p>And is the most fundamental and also the most frequently used of all the hand gestures in the practice of Buddhism.<br>
      </p>
      <p>There are 2 primary forms of gassho: Formal Gassho<br>
          The hands are brought together in front of the face, fingers straight pointing up, palms pressing together. Elbows are raised, forearms at about 30 deg angle to the floor; fingertips level with top of the nose, hands roughly a fist's distance in front of the tip of the nose. They eyes are focused on the tips of the middle fingers.<br>
          Helps establish a reverential, alert attitude &amp; shows reverence.<br>
      </p>
      <p>Mu-shin ('No - Mind') Gassho<br>
          Used primarily in greetings. Hands held loosely together, tips of fingers / thumbs still touch, a slight space betweent he palms. The forearms are at 45 deg angles to the floor.<br>
          The hands 4-6 inch distance in front of tip of the nose, hands are lower, in front of the mouth, the fingertips level just below the nose. The eyesfocused on the tips of the middle fingers.<br>
          Many people also perform mu-shin gassho with hands positioned in front of the chest at a level just above the heart.<br>
      </p>
      <p>There are a number of other special versions of Gassho found in Buddhism.<br>
          The lotus gassho: almost identical to mu-shin, the fingers are bent slightly more &amp; the tips of the middle fingers are held about an inch apart.<br>
          The Diamond gassho: also called the 'gassho of oneness with all life' - almost identical to mu-shin gassho, however the fingers are perfectly straight and interlocked.<br>
          Both are primarily used by priests during particular ceremonies or rites.<br>
      </p>
      <p>Usui taught a meditation called the gassho meditation. This meditation was practiced at the beginning of every Reiki workshop and meeting.<br>
          His students practiced the meditation each morning &amp; evening for 5-20 minutes. Gassho is so simple, that anyone can practice it alone or in a group meditation.<br>
          We recommend you try for at least 30 days.<br>
          Keep a meditation journal to record your experience with Gassho.<br>
      </p>
      <p>The Gassho Meditation (5-20 minutes a day)<br>
          Sit down, close your eyes and place hands together in Gassho.<br>
          Focus your attention at the point where the two middle finders meet.<br>
          Let go of everything else. If your mind wanders, acknowledge the thought, let it go and just refocus returning to the point where your middle fingers meet.<br>
          Repeat the five reiki principles either aloud or internally.<br>
          (if you get tired, keep hands on lap slowly and then revert to gassho again, have comfortable position and do gassho meditation)</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
