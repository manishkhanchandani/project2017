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

$maxRows_rsIssues = 25;
$pageNum_rsIssues = 0;
if (isset($_GET['pageNum_rsIssues'])) {
  $pageNum_rsIssues = $_GET['pageNum_rsIssues'];
}
$startRow_rsIssues = $pageNum_rsIssues * $maxRows_rsIssues;

$colname_rsIssues = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsIssues = $_SESSION['MM_UserId'];
}
$colsubject_rsIssues = "%";
if (isset($_GET['subject'])) {
  $colsubject_rsIssues = $_GET['subject'];
}
$col_issue_rsIssues = "%";
if (isset($_GET['keyword'])) {
  $col_issue_rsIssues = $_GET['keyword'];
}
mysql_select_db($database_conn, $conn);
$query_rsIssues = sprintf("SELECT * FROM qz_issue_mbe_essay WHERE user_id = %s AND  (title LIKE %s OR `description` LIKE %s OR essay_related LIKE %s OR mbe_related LIKE %s OR own_words LIKE %s) AND subject LIKE %s ORDER BY issue_id ASC", GetSQLValueString($colname_rsIssues, "int"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString($colsubject_rsIssues, "text"));
$query_limit_rsIssues = sprintf("%s LIMIT %d, %d", $query_rsIssues, $startRow_rsIssues, $maxRows_rsIssues);
$rsIssues = mysql_query($query_limit_rsIssues, $conn) or die(mysql_error());
$row_rsIssues = mysql_fetch_assoc($rsIssues);

if (isset($_GET['totalRows_rsIssues'])) {
  $totalRows_rsIssues = $_GET['totalRows_rsIssues'];
} else {
  $all_rsIssues = mysql_query($query_rsIssues);
  $totalRows_rsIssues = mysql_num_rows($all_rsIssues);
}
$totalPages_rsIssues = ceil($totalRows_rsIssues/$maxRows_rsIssues)-1;

$queryString_rsIssues = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsIssues") == false && 
        stristr($param, "totalRows_rsIssues") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsIssues = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsIssues = sprintf("&totalRows_rsIssues=%d%s", $totalRows_rsIssues, $queryString_rsIssues);

$subject = '';

if (!empty($_POST['subject'])) {
	$subject = $_POST['subject'];	
} else if (!empty($_GET['subject'])) {
	$subject = $_GET['subject'];	
}


$keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
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
<h1>Issue Details</h1>
<p><a href="issue_details_new.php">New Issue</a></p>
<form name="form3" method="get" action="">
Keyword: 
<label>
<input name="keyword" type="text" id="keyword" value="<?php echo $keyword; ?>">
</label> 
Subject: 
<select name="subject" id="subject">
  <option value="%" <?php if (!(strcmp("%", $subject))) {echo "selected=\"selected\"";} ?>>All</option>
  
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
</select>
<label>
<input type="submit" id="button" value="Search">
</label>
</form>

<?php if ($totalRows_rsIssues > 0) { // Show if recordset not empty ?>
  
<div class="table-responsive">
<table class="table table-striped">
    <tr>
      <td valign="top"><strong>Issue ID</strong></td>
      <td valign="top"><strong>Key</strong></td>
      <td valign="top"><strong>Subject</strong></td>
      <td valign="top"><strong>Title</strong></td>
      <td valign="top"><strong>Edit</strong></td>
      <td valign="top"><strong>Details</strong></td>
      </tr>
    <?php do { ?>
      <tr>
        <td valign="top"><?php echo $row_rsIssues['issue_id']; ?></td>
        <td valign="top"><?php echo $row_rsIssues['issue_key']; ?></td>
        <td valign="top"><?php echo $row_rsIssues['subject']; ?></td>
        <td valign="top"><p><strong><?php echo $row_rsIssues['title']; ?></strong></p>
          <p><?php echo substr(strip_tags($row_rsIssues['description']), 0, 200).' ....'; ?></p></td>
        <td valign="top"><a href="issue_details_edit.php?issue_id=<?php echo $row_rsIssues['issue_id']; ?>&keyword=<?php echo $keyword; ?>&subject=<?php echo $subject; ?>#edit">Edit</a></td>
        <td valign="top"><a href="issue_details_display.php?issue_id=<?php echo $row_rsIssues['issue_id']; ?>">Details</a></td>
    </tr>
<?php } while ($row_rsIssues = mysql_fetch_assoc($rsIssues)); ?>
  </table>
  </div>
  <p> Records <?php echo ($startRow_rsIssues + 1) ?> to <?php echo min($startRow_rsIssues + $maxRows_rsIssues, $totalRows_rsIssues) ?> of <?php echo $totalRows_rsIssues ?> </p>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_rsIssues > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, 0, $queryString_rsIssues); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsIssues > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, max(0, $pageNum_rsIssues - 1), $queryString_rsIssues); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsIssues < $totalPages_rsIssues) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, min($totalPages_rsIssues, $pageNum_rsIssues + 1), $queryString_rsIssues); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_rsIssues < $totalPages_rsIssues) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, $totalPages_rsIssues, $queryString_rsIssues); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>

<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsIssues);
?>
