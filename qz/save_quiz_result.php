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

function calculatePoints($data)
{
	if (empty($data)) {
		return 0;	
	}
	$pts = 0;
	foreach ($data as $k => $v) {
		if ($v['isCorrect']) {
			$pts = $pts + 1;
		}
	}
	
	return $pts;
}

if (!empty($_GET['save'])) {
		$data = json_encode($_SESSION['quiz']);
		$pts = calculatePoints($_SESSION['quiz']);
		$max = count($_SESSION['quiz']);
		$percentage = number_format((($pts / $max) * 100), 2); 

		$insertSQL = sprintf("INSERT INTO qz_save_quiz (user_id, answer_data, result_percentage) VALUES (%s, %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($data, "text"),
                       GetSQLValueString($percentage, "double"));

		  mysql_select_db($database_conn, $conn);
		  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
		header("Location: save_quiz_result.php");
		exit;
}

$maxRows_rsRecord = 1;
$pageNum_rsRecord = 0;
if (isset($_GET['pageNum_rsRecord'])) {
  $pageNum_rsRecord = $_GET['pageNum_rsRecord'];
}
$startRow_rsRecord = $pageNum_rsRecord * $maxRows_rsRecord;

$colname_rsRecord = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsRecord = $_SESSION['MM_UserId'];
}
mysql_select_db($database_conn, $conn);
$query_rsRecord = sprintf("SELECT * FROM qz_save_quiz WHERE user_id = %s ORDER BY save_id DESC", GetSQLValueString($colname_rsRecord, "int"));
$query_limit_rsRecord = sprintf("%s LIMIT %d, %d", $query_rsRecord, $startRow_rsRecord, $maxRows_rsRecord);
$rsRecord = mysql_query($query_limit_rsRecord, $conn) or die(mysql_error());
$row_rsRecord = mysql_fetch_assoc($rsRecord);

if (isset($_GET['totalRows_rsRecord'])) {
  $totalRows_rsRecord = $_GET['totalRows_rsRecord'];
} else {
  $all_rsRecord = mysql_query($query_rsRecord);
  $totalRows_rsRecord = mysql_num_rows($all_rsRecord);
}
$totalPages_rsRecord = ceil($totalRows_rsRecord/$maxRows_rsRecord)-1;

$queryString_rsRecord = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsRecord") == false && 
        stristr($param, "totalRows_rsRecord") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsRecord = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsRecord = sprintf("&totalRows_rsRecord=%d%s", $totalRows_rsRecord, $queryString_rsRecord);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Saved Result</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.answer_0 {
	background-color: #999 !important;
	color: #fff;
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<div>
<h1>Saved Quiz Results</h1>
<?php if ($totalRows_rsRecord > 0) { // Show if recordset not empty ?>
<?php do { ?>
<?php 
$data = json_decode($row_rsRecord['answer_data'], 1);
?>
<h3>Date: <?php echo $row_rsRecord['save_dt']; ?></h3>
<div class="table-responsive">
      <table class="table table-striped">
      	<tr>
        	<td valign="top">ID
            </td>
<td valign="top">Question</td>
<td valign="top">You Answered</td>
<td valign="top">Correct Answer</td>
<td valign="top">Options</td>
<td valign="top">Topic</td>
<td valign="top">Edit</td>
        </tr>
        <?php foreach ($data as $k => $v) { ?>
<tr class="answer_<?php echo $v['isCorrect'] ? 1 : 0; ?>">
<td valign="top"><?php echo $v['data']['id']; ?></td>
<td valign="top" style="width: 450px;"><?php echo nl2br($v['data']['question']); ?><hr /><?php echo nl2br($v['data']['explanation']); ?></td>
<td valign="top"><?php echo $v['answer']  + 1; ?> is something you answered</td>
<td valign="top"><?php echo $v['correct'] + 1; ?> is correct answer</td>
<td valign="top"><ol><?php $answer =  $v['data']['answers']; $answer2 = json_decode($answer, 1); foreach ($answer2 as $k2 => $v2) {
		?>
        <li><?php echo $v2; ?></li>
        <?php
	} ?></ol></td>
<td valign="top"><?php echo $v['data']['topic']; ?></td>
<td valign="top"><a href="add_quiz.php?cat_id=<?php echo $v['data']['category_id']; ?>&editId=<?php echo $v['data']['id']; ?>#edit" target="_blank">Edit</a></td>
</tr>
		<?php } ?>
      </table>
</div>
<?php } while ($row_rsRecord = mysql_fetch_assoc($rsRecord)); ?>

<p>Records <?php echo ($startRow_rsRecord + 1) ?> to <?php echo min($startRow_rsRecord + $maxRows_rsRecord, $totalRows_rsRecord) ?> of <?php echo $totalRows_rsRecord ?>
<table border="0">
<tr>
<td><?php if ($pageNum_rsRecord > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_rsRecord=%d%s", $currentPage, 0, $queryString_rsRecord); ?>">First</a>
<?php } // Show if not first page ?></td>
<td><?php if ($pageNum_rsRecord > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_rsRecord=%d%s", $currentPage, max(0, $pageNum_rsRecord - 1), $queryString_rsRecord); ?>">Previous</a>
<?php } // Show if not first page ?></td>
<td><?php if ($pageNum_rsRecord < $totalPages_rsRecord) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_rsRecord=%d%s", $currentPage, min($totalPages_rsRecord, $pageNum_rsRecord + 1), $queryString_rsRecord); ?>">Next</a>
<?php } // Show if not last page ?></td>
<td><?php if ($pageNum_rsRecord < $totalPages_rsRecord) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_rsRecord=%d%s", $currentPage, $totalPages_rsRecord, $queryString_rsRecord); ?>">Last</a>
<?php } // Show if not last page ?></td>
</tr>
</table>
<?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
<?php if ($totalRows_rsRecord == 0) { // Show if recordset empty ?>
<p>No Results</p>
<?php } // Show if recordset empty ?>
<p>&nbsp;</p>
</div> 
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsRecord);
?>
