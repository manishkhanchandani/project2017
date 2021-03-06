<?php require_once('../Connections/conn.php'); ?>
<?php
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

$MM_restrictGoTo = "login.php";
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
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_issue_mbe_essay (subject, issue_key, title, `description`, essay_related, mbe_related, own_words, user_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['issue_key'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['essay_related'], "text"),
                       GetSQLValueString($_POST['mbe_related'], "text"),
                       GetSQLValueString($_POST['own_words'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$subject = '';

if (!empty($_POST['subject'])) {
	$subject = $_POST['subject'];	
} else if (!empty($_GET['subject'])) {
	$subject = $_GET['subject'];	
}

$title = '';
if (!empty($_POST['title'])) {
	$title = $_POST['title'];	
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Issues</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->

<!-- include summernote css/js-->
<link href="library/wysiwyg/summernote.css" rel="stylesheet">
<script src="library/wysiwyg/summernote.js"></script>
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Add New Issue Details</h1>
<p><a href="issue_details.php">Refresh</a> | <a href="issue_details_view.php">Back To View</a></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="table-responsive">
  <table class="table table-striped">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Subject:</strong></td>
      <td><select name="subject">
        <option value="common" <?php if (!(strcmp("common", $subject))) {echo "selected=\"selected\"";} ?>>Common</option>
        <option value="books" <?php if (!(strcmp("books", $subject))) {echo "selected=\"selected\"";} ?>>Books</option>
        <option value="business_organization" <?php if (!(strcmp("business_organization", $subject))) {echo "selected=\"selected\"";} ?>>1. business_organization</option>
        <option value="civil_procedure" <?php if (!(strcmp("civil_procedure", $subject))) {echo "selected=\"selected\"";} ?>>2. civil_procedure</option>
        <option value="contracts" <?php if (!(strcmp("contracts", $subject))) {echo "selected=\"selected\"";} ?>>3. Contracts</option>
        <option value="community_property" <?php if (!(strcmp("community_property", $subject))) {echo "selected=\"selected\"";} ?>>4. Community Property</option>
        <option value="constitutional_law" <?php if (!(strcmp("constitutional_law", $subject))) {echo "selected=\"selected\"";} ?>>5. Constitutional Law</option>
        <option value="corporations" <?php if (!(strcmp("corporations", $subject))) {echo "selected=\"selected\"";} ?>>6. Corporations</option>
        <option value="criminal" <?php if (!(strcmp("criminal", $subject))) {echo "selected=\"selected\"";} ?>>7. Criminal</option>
        <option value="criminal_procedure" <?php if (!(strcmp("criminal_procedure", $subject))) {echo "selected=\"selected\"";} ?>>8. criminal Procedure</option>
        <option value="evidence" <?php if (!(strcmp("evidence", $subject))) {echo "selected=\"selected\"";} ?>>9. Evidence</option>
        <option value="professional_responsibility" <?php if (!(strcmp("professional_responsibility", $subject))) {echo "selected=\"selected\"";} ?>>10. Professional Responsibility</option>
        <option value="real_property" <?php if (!(strcmp("real_property", $subject))) {echo "selected=\"selected\"";} ?>>11. Real Property</option>
        <option value="remedies" <?php if (!(strcmp("remedies", $subject))) {echo "selected=\"selected\"";} ?>>12. Remedies</option>
        <option value="torts" <?php if (!(strcmp("torts", $subject))) {echo "selected=\"selected\"";} ?>>13. Torts</option>
        <option value="trusts" <?php if (!(strcmp("trusts", $subject))) {echo "selected=\"selected\"";} ?>>14. trusts</option>
        <option value="ucc" <?php if (!(strcmp("ucc", $subject))) {echo "selected=\"selected\"";} ?>>15. UCC</option>
        <option value="wills" <?php if (!(strcmp("wills", $subject))) {echo "selected=\"selected\"";} ?>>16. Wills</option>        
      </select></td>
    </tr>
    <tr valign="baseline">
        <td nowrap align="right"><strong>Issue Key: </strong></td>
        <td><input name="issue_key" type="text" id="issue_key" value="" size="32">        </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="title" id="title" value="<?php echo $title; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Description:</strong></td>
      <td><textarea name="description" cols="50" rows="5" id="description_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Essay_related:</strong></td>
      <td><textarea name="essay_related" cols="50" rows="5" id="essay_related_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Mbe_related:</strong></td>
      <td><textarea name="mbe_related" cols="50" rows="5" id="mbe_related_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Own_words:</strong></td>
      <td><textarea name="own_words" value="" cols="50" rows="10" id="own_words_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  </div>
  <input type="hidden" name="MM_insert" value="form1" />
  <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
</form>
<script>
 	$(document).ready(function() {
        $('#description_1').summernote({
			height: 250							   
		});
        $('#essay_related_1').summernote();
        $('#mbe_related_1').summernote();
        $('#own_words_1').summernote();
    });
</script>
<script>
document.getElementById('title').focus();
</script>
<h3>&nbsp;</h3>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>