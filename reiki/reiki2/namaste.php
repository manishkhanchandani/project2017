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
<title>Rei-ki : Namaste</title>
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
  <h1 class="page-header">Namaste</h1>

  <div id="content" class="visual">
      <p>I honor the place in you in which the entire universe dwells.<br>
I honor the place in you which is of love, of truth, of light and of peace.<br>
When you are in that place in you and I am in that place in me, we are one.<br>
</p>
      <p>The gesture (or mudra) of Namaste is a simple act made by bringing together both palms of the hands before the heart, and lightly bowing the head. In the simplest of terms it is accepted as a humble greeting straight from the heart and reciprocated accordingly.<br>
      </p>
      <p>Namaste is pronounced &quot;Namastay&quot;, a composite of two Sanskrit words, Nama, and te.<br>
          Te means you<br>
          Nama means to bend, incline or bow.<br>
          Together they mean a sense of submitting onself to another, with complete humility.<br>
      </p>
      <p>The word nama is split into two, na and ma.<br>
          Na signifies negation and ma represents mine. The meaning would then be 'not mine'.<br>
          Namaste is the rejection of 'I' and the associated phenomena of egotism. It is said that 'ma' in nama means death (spiritual), and when this is negated (na-ma), it signifies immortality.<br>
      </p>
      <p>The whole action of Namaste unfolds itself at three levels:<br>
          Mental<br>
          Physical<br>
          Verbal<br>
      </p>
      <p>The mental submission is in the spirit of total surrender of the self.<br>
          A transaction can only be between equals, hence by performing Namaste before an individual we recogise the divine spark in him/her and within our own selves.<br>
          Simply put, Namaste intimates the following:<br>
          The God in me greets the God in you.<br>
          The Spirit in me meets the same Spirit in you.<br>
      </p>
      <p>It recognizes the equality of all.<br>
          Translated into a bodily act, Namaste is deeply rich in symbolism.<br>
          Firstly the proper performance of Namaste requires that we blend the five fingers of the left hand exactly with the fingers of the right hand.<br>
          The five fingers of the left hand represent the five senses of karma, and those of the right hand the five organs of knowledge. Hence it signifies that our karma or action must be in harmony, and governed by rightful knowledge, prompting us to think and act correctly.<br>
      </p>
      <p>Namaste recognizes the duality that has forever existed in this world and suggests an effort on our part to bring these two forces together, ultimately leading to a highter unity and non-dual state of Oneness. (God and goddess, pleasure and pain, conscious and unconscious, etc).<br>
      </p>
      <p>Namaste is unique also in the sense that its physical performance is accompanied by a verbal utterance of the word &quot;namaste&quot;.<br>
          This practice is equivalent to the chanting of a mantra.<br>
          At its most general Namaste is a social transaction. It is usual for individual to greet when they meet each other. It is not only a sign of recognition but also an expression of happiness at each other's sight.<br>
      </p>
      <p>Namaste as a greeting is thus a mosaic of movements and words constituting affirmative thoughts and sentiments.<br>
          In human society it is an approach mechanism, brimming with social, emotional and spiritual significance.<br>
          In fact it is said that in Namaste the hands are put together like a knife so that people may cut through all differences that may exist, and immediately get to the shared ground that is common to all people's of all cultures.<br>
      </p>
      <p>Though shaking hands is an extremely intimate gesture, Namaste scores over it in some ways. Primarily is the one that Namaste is a great equalizer.<br>
          A King or President cannot shake hands with the large multitude they are addressing. But Namaste serves the purpose.<br>
      </p>
      <p>As much as yoga is an exercise to bring all levels of our existence, including the physical and intellectual, in complete harmony with the rhythms of nature, the gesture of Namaste is a yoga in itself.<br>
          It isn't surprising that any yogic activity begins with the performance of this deeply spiritual gesture.<br>
          The Buddhists went further and gave it the status of a mudra, that is, a gesture displayed by deities.<br>
          The performance of Namaste is comprised of all these three activities. Thus Namaste is in essence equivalent to meditation, which is the lganguage of our spirti in conversation with God, and the perfect vehicle for bathing us in the rivers of divine pleasure.</p>
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
