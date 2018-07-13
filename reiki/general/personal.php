<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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
  $insertSQL = sprintf("INSERT INTO reiki_students_record (user_id, name, email, phone, `level`, place, class_date, yearofbirth, gender, knowledge_reiki, why_reiki, previous_reiki) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['place'], "text"),
                       GetSQLValueString($_POST['class_date'], "text"),
                       GetSQLValueString($_POST['yearofbirth'], "int"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['knowledge_reiki'], "text"),
                       GetSQLValueString($_POST['why_reiki'], "text"),
                       GetSQLValueString($_POST['previous_reiki'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "personal_view.php";
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
<title>Reiki : Personal Info</title>
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
  <h1 class="page-header">Personal Info </h1>

  <div id="content" class="visual">
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <div class="table-responsive">
  			<table class="table">
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Name:</strong></td>
                  <td valign="top"><input type="text" name="name" value="<?php echo $_SESSION['MM_DisplayName']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Email:</strong></td>
                  <td valign="top"><input type="text" name="email" value="<?php echo $_SESSION['MM_Email']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Phone:</strong></td>
                  <td valign="top"><input type="text" name="phone" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>What reiki level you are getting today?</strong></td>
                  <td valign="top"><input type="text" name="level" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Place (Where you are taking training)</strong></td>
                  <td valign="top"><input type="text" name="place" value="San Jose Public Library (Room no 255)" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Training Date</strong></td>
                  <td valign="top"><input type="text" name="class_date" value="14th / 15th July, 2018" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Year of birth:</strong></td>
                  <td valign="top"><input type="text" name="yearofbirth" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Gender:</strong></td>
                  <td valign="top"><select name="gender">
                          <option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
                          <option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
                      </select>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>What you know about Reiki?</strong></td>
                  <td valign="top"><textarea name="knowledge_reiki" cols="50" rows="5"></textarea>                  </td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Why you want to learn Reiki?</strong></td>
                  <td valign="top">
                      <textarea name="why_reiki" cols="50" rows="5"></textarea></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><p><strong>Have you done reiki previously,<br>
                  </strong><strong>if yes when and how?</strong></p>
                      </td>
                  <td valign="top"><textarea name="previous_reiki" cols="50" rows="5"></textarea>                  </td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap>&nbsp;</td>
                  <td valign="top"><input type="submit" value="Add Information"></td>
              </tr>
          </table>
  </div>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
          <input type="hidden" name="MM_insert" value="form1">
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;    </p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>