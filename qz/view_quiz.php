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

if ((isset($_GET['del_id'])) && ($_GET['del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM qz_results WHERE cid=%s AND user_id=%s",
                       GetSQLValueString($_GET['del_id'], "int"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}

$maxRows_rsQuiz = 1;
if (isset($_GET['maxRows_rsQuiz'])) {
  $maxRows_rsQuiz = $_GET['maxRows_rsQuiz'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$maxRows_rsQuiz = $maxRows_rsQuiz;
$pageNum_rsQuiz = 0;
if (isset($_GET['pageNum_rsQuiz'])) {
  $pageNum_rsQuiz = $_GET['pageNum_rsQuiz'];
}
$startRow_rsQuiz = $pageNum_rsQuiz * $maxRows_rsQuiz;

$colname_rsQuiz = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsQuiz = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsQuiz = sprintf("SELECT * FROM qz_questions WHERE category_id = %s AND correct >= 0 AND status = 1", GetSQLValueString($colname_rsQuiz, ""));
$query_limit_rsQuiz = sprintf("%s LIMIT %d, %d", $query_rsQuiz, $startRow_rsQuiz, $maxRows_rsQuiz);
$rsQuiz = mysql_query($query_limit_rsQuiz, $conn) or die(mysql_error());
$row_rsQuiz = mysql_fetch_assoc($rsQuiz);

if (isset($_GET['totalRows_rsQuiz'])) {
  $totalRows_rsQuiz = $_GET['totalRows_rsQuiz'];
} else {
  $all_rsQuiz = mysql_query($query_rsQuiz);
  $totalRows_rsQuiz = mysql_num_rows($all_rsQuiz);
}
$totalPages_rsQuiz = ceil($totalRows_rsQuiz/$maxRows_rsQuiz)-1;

$maxRows_rsResults = 25;
$pageNum_rsResults = 0;
if (isset($_GET['pageNum_rsResults'])) {
  $pageNum_rsResults = $_GET['pageNum_rsResults'];
}
$startRow_rsResults = $pageNum_rsResults * $maxRows_rsResults;

$colname2_rsResults = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname2_rsResults = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsResults = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsResults = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsResults = sprintf("SELECT * FROM qz_results WHERE category_id = %s AND user_id = %s ORDER BY qz_results.cdate DESC", $colname_rsResults,$colname2_rsResults);
$query_limit_rsResults = sprintf("%s LIMIT %d, %d", $query_rsResults, $startRow_rsResults, $maxRows_rsResults);
$rsResults = mysql_query($query_limit_rsResults, $conn) or die(mysql_error());
$row_rsResults = mysql_fetch_assoc($rsResults);

if (isset($_GET['totalRows_rsResults'])) {
  $totalRows_rsResults = $_GET['totalRows_rsResults'];
} else {
  $all_rsResults = mysql_query($query_rsResults);
  $totalRows_rsResults = mysql_num_rows($all_rsResults);
}
$totalPages_rsResults = ceil($totalRows_rsResults/$maxRows_rsResults)-1;

$colname_rsCat = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsCat = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCat = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $colname_rsCat);
$rsCat = mysql_query($query_rsCat, $conn) or die(mysql_error());
$row_rsCat = mysql_fetch_assoc($rsCat);
$totalRows_rsCat = mysql_num_rows($rsCat);

$queryString_rsResults = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsResults") == false && 
        stristr($param, "totalRows_rsResults") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsResults = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsResults = sprintf("&totalRows_rsResults=%d%s", $totalRows_rsResults, $queryString_rsResults);

$queryString_rsQuiz = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsQuiz") == false && 
        stristr($param, "totalRows_rsQuiz") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsQuiz = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsQuiz = sprintf("&totalRows_rsQuiz=%d%s", $totalRows_rsQuiz, $queryString_rsQuiz);


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($_POST['option'])) {
	$results = json_encode($_POST['option']);
	$correct_results = 0;
	foreach ($_POST['option'] as $k => $v) {
		if ($_POST['correct'][$k] == $v) {
			$correct_results++;
		}
	}
	
	$wrong_results = $maxRows_rsQuiz - $correct_results;
	$percentage = (($correct_results/$maxRows_rsQuiz) * 100);
	
  $insertSQL = sprintf("INSERT INTO qz_results (category_id, user_id, total_question, correct_results, cdate, results, wrong_results, calc_percentage) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['cat_id'], "int"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($maxRows_rsQuiz, "int"),
                       GetSQLValueString($correct_results, "int"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                       GetSQLValueString($results, "text"),
                       GetSQLValueString($wrong_results, "int"),
                       GetSQLValueString($percentage, "double")
					   );

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  header("Location: view_quiz.php?cat_id=".$colname_rsQuiz);
  exit;
  
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>View Quiz</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.boxParent {
	position: absolute;
	padding: 15px;
	right: 0;
}

.box {
	position: absolute;
	width: 500px;
	background-color: black;
	color: white;
	visibility:hidden;
	padding: 15px;
	border-radius: 6px;
}
.boxParent:hover .box {
	visibility: visible;
}

.left {
	right: 105%;
	top: -5px;
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>

    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Quiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
		  	<?php if (!empty($_SESSION['MM_UserId'])) { ?>
            <li><a href="logout.php">Logout</a></li>
			<?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>View Quiz for "<?php echo $row_rsCat['category']; ?>"</h1>
<div><a href="index.php?parent_id=<?php echo $row_rsCat['parent_id']; ?>">Back To Category</a> | <a href="add_quiz.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">Add Quiz </a></div>
<?php if ($totalRows_rsQuiz > 0) { // Show if recordset not empty ?>
  <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
    <?php $i = 0; ?>
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <td valign="top"><strong>Question</strong></td>
        </tr>
        <?php do { ?>
          <tr>
            <td valign="top"><?php $i++; echo $i; ?>. <?php echo nl2br($row_rsQuiz['question']); ?><br><br>
              <?php if (!empty($row_rsQuiz['answers'])) { foreach (json_decode($row_rsQuiz['answers'], 1) as $k => $v) {
			?>
              <div><input name="option[<?php echo $row_rsQuiz['id']; ?>]" type="radio" value="<?php echo $k; ?>" /> <?php echo $v; ?><input name="correct[<?php echo $row_rsQuiz['id']; ?>]" type="hidden" value="<?php echo $row_rsQuiz['correct']; ?>" /> </div>
              <?php
		} } ?>
              <br><br>
              <div class="boxParent">
                Show Explanation
                <span class="box left">
                  <?php echo $row_rsQuiz['topic']; ?><br><br>
                  <?php echo $row_rsQuiz['explanation']; ?>
                  </span>
              </div>
            </td>
          </tr>
          <?php } while ($row_rsQuiz = mysql_fetch_assoc($rsQuiz)); ?>
      </table>
    </div>
    
    
    <label>
      <input name="MM_insert" type="hidden" value="form1" />
      <input type="submit" name="Submit" value="Submit" />
    </label>
    
  </form>
  <p>Records <?php echo ($startRow_rsQuiz + 1) ?> to <?php echo min($startRow_rsQuiz + $maxRows_rsQuiz, $totalRows_rsQuiz) ?> of <?php echo $totalRows_rsQuiz ?> </p>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, 0, $queryString_rsQuiz); ?>">First</a>
        <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, max(0, $pageNum_rsQuiz - 1), $queryString_rsQuiz); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, min($totalPages_rsQuiz, $pageNum_rsQuiz + 1), $queryString_rsQuiz); ?>">Next</a>
        <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, $totalPages_rsQuiz, $queryString_rsQuiz); ?>">Last</a>
        <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsResults > 0) { // Show if recordset not empty ?>
  <h3>View Past Results</h3>

  <div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <td><strong>Date</strong></td>
      <td><strong>Total Questions </strong></td>
      <td><strong>Correct Answers </strong></td>
      <td><strong>Wrong Answers </strong></td>
      <td><strong>Percentage</strong></td>
      <td><strong>Results</strong></td>
      <td><strong>Delete</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsResults['cdate']; ?></td>
        <td><?php echo $row_rsResults['total_question']; ?></td>
        <td><?php echo $row_rsResults['correct_results']; ?></td>
        <td><?php echo $row_rsResults['wrong_results']; ?></td>
        <td><?php echo $row_rsResults['calc_percentage']; ?> %</td>
        <td><?php echo $row_rsResults['results']; ?></td>
        <td><a href="view_quiz.php?cat_id=<?php echo $_GET['cat_id']; ?>&del_id=<?php echo $row_rsResults['cid']; ?>" onClick="var a = confirm('do you really want to delete his record?'); return a;">Delete</a></td>
      </tr>
      <?php } while ($row_rsResults = mysql_fetch_assoc($rsResults)); ?>
      </table>
    </div>
  <p> Records <?php echo ($startRow_rsResults + 1) ?> to <?php echo min($startRow_rsResults + $maxRows_rsResults, $totalRows_rsResults) ?> of <?php echo $totalRows_rsResults ?></p>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsResults > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsResults=%d%s", $currentPage, 0, $queryString_rsResults); ?>">First</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsResults > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsResults=%d%s", $currentPage, max(0, $pageNum_rsResults - 1), $queryString_rsResults); ?>">Previous</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsResults < $totalPages_rsResults) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsResults=%d%s", $currentPage, min($totalPages_rsResults, $pageNum_rsResults + 1), $queryString_rsResults); ?>">Next</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsResults < $totalPages_rsResults) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsResults=%d%s", $currentPage, $totalPages_rsResults, $queryString_rsResults); ?>">Last</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
    </table>
  <?php } // Show if recordset not empty ?>
<p>&nbsp; </p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsQuiz);

mysql_free_result($rsResults);

mysql_free_result($rsCat);
?>
