<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/login.php";
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

$quiz = array(
	array('title' => 'Root Chakra', 'name' => 'root_chakra', 'category_id' => 61, 'questions' => array('I feel emotionally stable and grounded.', 'I rarely go a day without being in nature.', 'I feel safe, confident and secure.', 'I trust my natural instincts to make decisions.')),
	array('title' => 'Sacral Chakra', 'name' => 'sacral_chakra', 'category_id' => 62, 'questions' => array('I embrace my sensual/sexual nature.', 'I am full of energy each day.', 'It is easy for me to express my creativity.', 'I regularly have sex with people/a person I trust.')),
	array('title' => 'Solar Plexus Chakra', 'name' => 'solar_plexus_chakra', 'category_id' => 63, 'questions' => array('I find it easy to forgive myself of my flaws and mistakes.', 'I have a vibrant sense of humor.', 'I accept responsibility for my actions (e.g. I don\' t blame, criticize or judge others).', 'I actively try to fix my problems rather than wallowing in the misery of my failure.')),
	array('title' => 'Heart Chakra', 'name' => 'heart_chakra', 'category_id' => 64, 'questions' => array('I love the person I am.', 'I have empathy for others (even those who harm me).', 'When I give I don\' t expect anything in return.', 'I can forgive other people easily.')),
	array('title' => 'Throat Chakra', 'name' => 'throat_chakra', 'category_id' => 65, 'questions' => array('I can speak up for myself and my own needs.', 'I respect my boundaries and know when to say "no" or "yes".', 'When I speak, I ensure that I am heard and understood clearly.', 'I am a good listener.')),
	array('title' => 'Third Eye Chakra', 'name' => 'third_eye_chakra', 'category_id' => 66, 'questions' => array('When it comes to issues in my life I can see the big picture rather than getting lost in the details.', 'My intuition is well-developed.', 'It is easy for me to open to new perceptions, opinions, beliefs and ideas.', 'My thoughts are clear, focused and directed (i.e. I don\' t get stuck in intellectual ruts or cycles).')),
	array('title' => 'Crown Chakra', 'name' => 'crown_chakra', 'category_id' => 68, 'questions' => array('I feel as though my life has a great purpose.', 'I feel a sense of connection to God/Divinity/Consciousness.', 'I have hope.', 'I don\' t take myself too seriously (lovingly).')),

);
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {	
	$return = array();
	if (!empty($_POST['data'])) {
		$return['data'] = $_POST['data'];
		$grandtotal = 0;
		foreach ($_POST['data'] as $k => $v) {
			$tot = array_sum($v) * 5;
			$return['total'][$k] = $tot;
			$_POST[$quiz[$k]['name']] = $tot;
			$return[$quiz[$k]['name']] = $tot;
			$grandtotal = $grandtotal + $tot;
		}
		$_POST['total_points'] = $grandtotal;
		$return['total_points'] = $grandtotal;
		$_POST['quiz_result'] = json_encode($return);
	}
	
	if (empty($return['data'])) {
		unset($_POST["MM_insert"]);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO reiki_chakra_quiz (user_id, quiz_result, root_chakra, sacral_chakra, solar_plexus_chakra, heart_chakra, throat_chakra, third_eye_chakra, crown_chakra, total_points) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['quiz_result'], "text"),
                       GetSQLValueString($_POST['root_chakra'], "int"),
                       GetSQLValueString($_POST['sacral_chakra'], "int"),
                       GetSQLValueString($_POST['solar_plexus_chakra'], "int"),
                       GetSQLValueString($_POST['heart_chakra'], "int"),
                       GetSQLValueString($_POST['throat_chakra'], "int"),
                       GetSQLValueString($_POST['third_eye_chakra'], "int"),
                       GetSQLValueString($_POST['crown_chakra'], "int"),
                       GetSQLValueString($_POST['total_points'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "quiz_complete.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki : Quiz</title>
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
  <h1 class="page-header">Quiz</h1>

  <div id="content" class="visual visualSmall">
      <p>Fill the following quiz answers: </p>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <div class="table-responsive">
  			<table class="table">
              <tr valign="baseline">
                  <td><?php echo $_SESSION['MM_DisplayName']; ?></td>
              </tr>
			  <?php foreach ($quiz as $k => $v) { ?>
			  <?php foreach ($v['questions'] as $k1 => $v1) { ?>
              <tr valign="baseline">
                  <td><strong><?php echo $v1; ?></strong></td>
              </tr>
              <tr valign="baseline">
                  <td>(Strongly Disagree)  
                      <input name="data[<?php echo $k; ?>][<?php echo $k1; ?>]" id="data_<?php echo $k; ?>_<?php echo $k1; ?>_1" type="radio" value="1"> <label for="data_<?php echo $k; ?>_<?php echo $k1; ?>_1">1</label> <input name="data[<?php echo $k; ?>][<?php echo $k1; ?>]"  id="data_<?php echo $k; ?>_<?php echo $k1; ?>_2" type="radio" value="2"> <label for="data_<?php echo $k; ?>_<?php echo $k1; ?>_2">2</label> <input name="data[<?php echo $k; ?>][<?php echo $k1; ?>]" id="data_<?php echo $k; ?>_<?php echo $k1; ?>_3" checked="checked" type="radio" value="3"> <label for="data_<?php echo $k; ?>_<?php echo $k1; ?>_3">3</label> <input name="data[<?php echo $k; ?>][<?php echo $k1; ?>]" id="data_<?php echo $k; ?>_<?php echo $k1; ?>_4" type="radio" value="4"> <label for="data_<?php echo $k; ?>_<?php echo $k1; ?>_4">4</label> <input name="data[<?php echo $k; ?>][<?php echo $k1; ?>]" id="data_<?php echo $k; ?>_<?php echo $k1; ?>_5" type="radio" value="5"> <label for="data_<?php echo $k; ?>_<?php echo $k1; ?>_5">5</label> (Strongly Agree)                      </td>
              </tr>
			  <?php } ?>
			  <?php } ?>
              <tr valign="baseline">
                  <td><input type="submit" value="Submit Quiz"></td>
              </tr>
          </table>
		  </div>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
          <input type="hidden" name="quiz_result" value="">
          <input type="hidden" name="root_chakra" value="">
          <input type="hidden" name="sacral_chakra" value="">
          <input type="hidden" name="solar_plexus_chakra" value="">
          <input type="hidden" name="heart_chakra" value="">
          <input type="hidden" name="throat_chakra" value="">
          <input type="hidden" name="third_eye_chakra" value="">
          <input type="hidden" name="crown_chakra" value="">
          <input type="hidden" name="MM_insert" value="form1">
          <input type="hidden" name="total_points" value="">
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;    </p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
