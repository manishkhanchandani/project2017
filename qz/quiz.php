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

if (!empty($_GET['MM_Test'])) {
	$_SESSION['ansString'] = 0;
	$_SESSION['ansArray'] = array();
	$_SESSION['quiz'] = array();
	$_SESSION['points']  = 0;
	$_SESSION['startTime'] = time();
    print_r($_GET);
    if (!empty($_GET['cat_ids'])) {
        $sql = array();
        foreach ($_GET['cat_ids'] as $k => $v) {
            $sql[] = '(SELECT * FROM `qz_questions` WHERE category_id = '.GetSQLValueString($v, 'int').' ORDER BY RAND() LIMIT 2)';
        }
        $query = implode(' UNION ', $sql);
        mysql_select_db($database_conn, $conn);
        $rs = mysql_query($query, $conn) or die(mysql_error());
        $qid = array();
        while ($row = mysql_fetch_assoc($rs)) {
            $qid[] = $row['id'];    
        }
        unset($_GET['cat_ids']);
        $_GET['question_id'] = implode(',', $qid);
        
        $str = http_build_query($_GET);
        header("Location: quiz2.php?".$str);
    }
    //header("Location: quiz2.php?".$_SERVER['QUERY_STRING']);
} else if (!empty($_GET['num'])) {
	$_SESSION['ansString'] = 0;
	$_SESSION['ansArray'] = array();
	$_SESSION['quiz'] = array();
	$_SESSION['points']  = 0;
	$_SESSION['startTime'] = time();
	header("Location: quiz2.php?".$_SERVER['QUERY_STRING']);
}

$colname_rsTitle = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsTitle = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsTitle = sprintf("SELECT Distinct topic, count(*) as cnt FROM qz_questions WHERE category_id = %s GROUP BY topic ORDER BY topic ASC", GetSQLValueString($colname_rsTitle, "int"));
$rsTitle = mysql_query($query_rsTitle, $conn) or die(mysql_error());
$row_rsTitle = mysql_fetch_assoc($rsTitle);
$totalRows_rsTitle = mysql_num_rows($rsTitle);

mysql_select_db($database_conn, $conn);
$query_rsCategories = "SELECT * FROM qz_categories ORDER BY category ASC";
$rsCategories = mysql_query($query_rsCategories, $conn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Quiz</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<p><strong>Start Quiz </strong></p>
<form id="form1" name="form1" method="get" action="quiz.php">
<p>No Of Questions:
<input name="num" type="text" id="num" value="500" />
</p>
<p>Order: 
<label>
<input name="sorting" type="radio" id="sorting1" value="1" checked="checked" />
</label>
By Question ID 
<label>
<input type="radio" name="sorting" id="sorting2" value="2" />
</label>
By Random</p>
<p><strong>Topic:</strong>
<select name="topic" id="topic">
<option value="">All</option>
<?php
do {  
?>
<option value="<?php echo $row_rsTitle['topic']?>"><?php echo $row_rsTitle['topic']?> - <?php echo $row_rsTitle['cnt']; ?></option>
<?php
} while ($row_rsTitle = mysql_fetch_assoc($rsTitle));
  $rows = mysql_num_rows($rsTitle);
  if($rows > 0) {
      mysql_data_seek($rsTitle, 0);
	  $row_rsTitle = mysql_fetch_assoc($rsTitle);
  }
?>
</select>
<p>
  <label for="cat_id">Category Ids:</label>
  <br>
  <select name="cat_id" size="1" id="cat_id">
    <option value="" <?php if (!(strcmp("", !empty($_GET['cat_id']) ? $_GET['cat_id'] : ''))) {echo "selected=\"selected\"";} ?>>Category</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsCategories['cat_id']?>"<?php if (!(strcmp($row_rsCategories['cat_id'], !empty($_GET['cat_id']) ? $_GET['cat_id'] : ''))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCategories['category']?> - <?php echo $row_rsCategories['parent_id']?></option>
    <?php
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
  $rows = mysql_num_rows($rsCategories);
  if($rows > 0) {
      mysql_data_seek($rsCategories, 0);
	  $row_rsCategories = mysql_fetch_assoc($rsCategories);
  }
?>
  </select>
</p>
<p>Question Id's:
  <input name="question_id" type="text" id="question_id" value="<?php echo !empty($_GET['question_id']) ? $_GET['question_id'] : ''; ?>" />
</p>
<label>
  <input type="submit" id="button" value="Submit" />
</label>
</p>
</form>
<p>&nbsp;</p>
<form id="form2" name="form2" method="get" action="quiz.php">
  <p><strong>Generate Random Records To Test Area of Weakness
  </strong></p>
  <p>No Of Questions Per Category:
    <input name="num" type="text" id="num" value="2" />
  </p>
  <p>Order:
    <label>
      <input name="sorting" type="radio" id="sorting" value="1" checked="checked" />
    </label>
    By Question ID
  <label>
    <input type="radio" name="sorting" id="sorting4" value="2" />
  </label>
    By Random</p>
  <p><strong>Topic:</strong>
    <select name="topic2" id="topic2">
      <option value="">All</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsTitle['topic']?>"><?php echo $row_rsTitle['topic']?> - <?php echo $row_rsTitle['cnt']; ?></option>
      <?php
} while ($row_rsTitle = mysql_fetch_assoc($rsTitle));
  $rows = mysql_num_rows($rsTitle);
  if($rows > 0) {
      mysql_data_seek($rsTitle, 0);
	  $row_rsTitle = mysql_fetch_assoc($rsTitle);
  }
?>
    </select>
  <p>
    <label for="cat_ids[]">Category Ids:</label>
    <br>
    <select name="cat_ids[]" size="5" multiple id="cat_ids[]">
      <option value="" <?php if (!(strcmp("", !empty($_GET['cat_id']) ? $_GET['cat_id'] : ''))) {echo "selected=\"selected\"";} ?>>Category</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsCategories['cat_id']?>"<?php if (!(strcmp($row_rsCategories['cat_id'], !empty($_GET['cat_id']) ? $_GET['cat_id'] : ''))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCategories['category']?> - <?php echo $row_rsCategories['parent_id']?></option>
      <?php
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
  $rows = mysql_num_rows($rsCategories);
  if($rows > 0) {
      mysql_data_seek($rsCategories, 0);
	  $row_rsCategories = mysql_fetch_assoc($rsCategories);
  }
?>
    </select>
  </p>
  <p>
    <input type="submit" id="button2" value="Submit" />
    <input name="MM_Test" type="hidden" id="MM_Test" value="2">
  </p>
  <p>&nbsp; </p>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsTitle);

mysql_free_result($rsCategories);
?>
