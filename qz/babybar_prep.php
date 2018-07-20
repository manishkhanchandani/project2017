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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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

function highlight($text='', $word='')
{
  if(strlen($text) > 0 && strlen($word) > 0)
  {
    return (str_ireplace($word, "<span class='hilight'>{$word}</span>", $text));
  }
   return ($text);
}

$sort_order = 'id';
if (!empty($_GET['sort_order'])) {
	$sort_order = $_GET['sort_order'];
}
$sort_order_type = 'DESC';
if (!empty($_GET['sort_order_type'])) {
	$sort_order_type = $_GET['sort_order_type'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_babybar_prep_apr_may_june (user_id, details, subject, topic) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['details'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['topic'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$maxRows_rsView = 25;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$coluser_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsView = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$coltopic_rsView = "%";
if (isset($_GET['topic'])) {
  $coltopic_rsView = (get_magic_quotes_gpc()) ? $_GET['topic'] : addslashes($_GET['topic']);
}
$colname_rsView = "%";
if (isset($_GET['subject'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['subject'] : addslashes($_GET['subject']);
}
$coldetails_rsView = "%";
if (isset($_GET['details'])) {
  $coldetails_rsView = (get_magic_quotes_gpc()) ? $_GET['details'] : addslashes($_GET['details']);
}
mysql_select_db($database_conn, $conn);
echo $query_rsView = sprintf("SELECT * FROM qz_babybar_prep_apr_may_june WHERE subject LIKE '%%%s%%' AND topic LIKE '%%%s%%' AND details LIKE '%%%s%%' AND user_id = '%s' ORDER BY ".$sort_order." ".$sort_order_type, $colname_rsView,$coltopic_rsView,$coldetails_rsView,$coluser_rsView);
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);


$subject = !empty($_POST['subject']) ? $_POST['subject'] : '';
$topic = !empty($_POST['topic']) ? $_POST['topic'] : '';
$subjectg = !empty($_GET['subject']) ? $_GET['subject'] : '';
$topicg = !empty($_GET['topic']) ? $_GET['topic'] : '';
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Baby Bar Preparation (Apr, May, June)</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.hilight {
	color: red;
	font-weight: bold;
}
</style>
<link href="library/wysiwyg/summernote.css" rel="stylesheet">
<script src="library/wysiwyg/summernote.js"></script>
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h3>April, May, June 2018</h3>
<div class="row">
	<div class="col-md-12">
	
	
	
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <div class="table-responsive">
  		<table class="table table-striped">
            <tr valign="baseline">
                <td nowrap align="right"><strong>Subject:</strong></td>
                <td><select name="subject" class="form-control">
                        <option value=""  <?php if (!(strcmp("", $subject))) {echo "selected=\"selected\"";} ?>>Select</option>
                        <option value="contracts" <?php if (!(strcmp("contracts", $subject))) {echo "selected=\"selected\"";} ?>>Contracts</option>
                        <option value="criminal" <?php if (!(strcmp("criminal", $subject))) {echo "selected=\"selected\"";} ?>>Criminal</option>
                        <option value="torts" <?php if (!(strcmp("torts", $subject))) {echo "selected=\"selected\"";} ?>>Torts</option>
                    </select>                </td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right"><strong>Topic:</strong></td>
                <td><select name="topic" class="form-control">
                        <option value=""  <?php if (!(strcmp("", $topic))) {echo "selected=\"selected\"";} ?>>Select</option>
                        <option value="mbe" <?php if (!(strcmp("mbe", $topic))) {echo "selected=\"selected\"";} ?>>Mbe</option>
                        <option value="outline" <?php if (!(strcmp("outline", $topic))) {echo "selected=\"selected\"";} ?>>Outline</option>
                        <option value="issue_spotting" <?php if (!(strcmp("issue_spotting", $topic))) {echo "selected=\"selected\"";} ?>>Issue Spotting</option>
                        <option value="approach" <?php if (!(strcmp("approach", $topic))) {echo "selected=\"selected\"";} ?>>Approaches</option>
                    </select>                </td>
            </tr>
            
            <tr valign="baseline">
                <td nowrap align="right" valign="top"><strong>Details:</strong></td>
                <td><textarea name="details" id="details" cols="50" rows="5"></textarea>                </td>
            </tr>

            <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="Insert record"></td>
            </tr>
        </table>
		</div>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
        <input type="hidden" name="MM_insert" value="form1">
    </form>
<script>

 	$(document).ready(function() {
        $('#details').summernote({
			height: 250						   
		});
    });
</script>
<script>
document.getElementById('details').focus();
</script>


	</div>
	<div class="col-md-12">
	<h3>Search</h3>
<form name="form2" method="get" action="">
    Subject: 
        <select name="subject" >
            <option value="%"  <?php if (!(strcmp("%", $subjectg))) {echo "selected=\"selected\"";} ?>>Select</option>
            <option value="contracts" <?php if (!(strcmp("contracts", $subjectg))) {echo "selected=\"selected\"";} ?>>Contracts</option>
            <option value="criminal" <?php if (!(strcmp("criminal", $subjectg))) {echo "selected=\"selected\"";} ?>>Criminal</option>
<option value="torts" <?php if (!(strcmp("torts", $subjectg))) {echo "selected=\"selected\"";} ?>>Torts</option>
        </select> Topic: <select name="topic" >
            <option value="%" <?php if (!(strcmp("%", $topicg))) {echo "selected=\"selected\"";} ?>>Select</option>
            <option value="mbe" <?php if (!(strcmp("mbe", $topicg))) {echo "selected=\"selected\"";} ?>>Mbe</option>
            <option value="outline" <?php if (!(strcmp("outline", $topicg))) {echo "selected=\"selected\"";} ?>>Outline</option>
            <option value="issue_spotting" <?php if (!(strcmp("issue_spotting", $topicg))) {echo "selected=\"selected\"";} ?>>Issue Spotting</option>
            <option value="approach" <?php if (!(strcmp("approach", $topicg))) {echo "selected=\"selected\"";} ?>>Approaches</option>
                    </select>
        <strong>keyword:                </strong>
        <input name="details" type="text" id="details">
Sort Order: 
<label>
<select name="sort_order" id="sort_order">
    <option value="id" selected <?php if (!(strcmp("id", $sort_order))) {echo "selected=\"selected\"";} ?>>ID</option>
    <option value="details" <?php if (!(strcmp("details", $sort_order))) {echo "selected=\"selected\"";} ?>>Details</option>
    <option value="subject" <?php if (!(strcmp("subject", $sort_order))) {echo "selected=\"selected\"";} ?>>Subject</option>
    <option value="topic" <?php if (!(strcmp("topic", $sort_order))) {echo "selected=\"selected\"";} ?>>Topic</option>
</select>
</label>
Order Type: 
<label>
<select name="sort_order_type" id="sort_order_type">
    <option value="ASC" <?php if (!(strcmp("ASC", $sort_order_type))) {echo "selected=\"selected\"";} ?>>Ascending</option>
    <option value="DESC" selected <?php if (!(strcmp("DESC", $sort_order_type))) {echo "selected=\"selected\"";} ?>>Descending</option>
</select>
</label>    
<input type="submit" name="Submit" value="Search">
</form>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
    <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                        <?php } // Show if not first page ?>        </td>
                <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                        <?php } // Show if not first page ?>        </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                        <?php } // Show if not last page ?>        </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                        <?php } // Show if not last page ?>        </td>
            </tr>
            </table>
    <p>&nbsp;</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <td><strong>ID</strong></td>
                    <td><strong>Subject</strong></td>
                    <td><strong>Topic</strong></td>
                    <td><strong>Details</strong></td>
                    <td><strong>Created</strong></td>
                </tr>
            <?php do { ?>
                <tr>
                    <td><?php echo $row_rsView['id']; ?></td>
                    <td><?php echo $row_rsView['subject']; ?></td>
                    <td><?php echo $row_rsView['topic']; ?></td>
                    <td><?php 
					if (!empty($_GET['details'])) {
						echo highlight($row_rsView['details'], $_GET['details']);
					} else echo $row_rsView['details']; ?></td>
                    <td><?php echo $row_rsView['created']; ?></td>
                </tr>
                <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
                </table>
    </div>
    <p>&nbsp;</p>
    <p>Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
    <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                        <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                        <?php } // Show if not last page ?>                </td>
            </tr>
            </table>
    <?php } // Show if recordset not empty ?>
	
	</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
