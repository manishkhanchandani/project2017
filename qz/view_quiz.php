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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_rsQuiz = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsQuiz = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsQuiz = sprintf("SELECT * FROM qz_questions WHERE category_id = %s ORDER BY RAND()", $colname_rsQuiz);
$rsQuiz = mysql_query($query_rsQuiz, $conn) or die(mysql_error());
$row_rsQuiz = mysql_fetch_assoc($rsQuiz);
$totalRows_rsQuiz = mysql_num_rows($rsQuiz);

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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($_POST['option'])) {
	$results = json_encode($_POST['option']);
	$correct_results = 0;
	foreach ($_POST['option'] as $k => $v) {
		if ($_POST['correct'][$k] == $v) {
			$correct_results++;
		}
	}
	
	$wrong_results = $totalRows_rsQuiz - $correct_results;
	$percentage = (($correct_results/$totalRows_rsQuiz) * 100);
	
  $insertSQL = sprintf("INSERT INTO qz_results (category_id, user_id, total_question, correct_results, cdate, results, wrong_results, calc_percentage) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['cat_id'], "int"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($totalRows_rsQuiz, "int"),
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
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
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
<h1>Start Quiz</h1>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <td valign="top"><strong>Question</strong></td>
      <td valign="top"><strong>Options</strong></td>
      <td valign="top"><strong>Explanation</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td valign="top"><?php echo $row_rsQuiz['question']; ?></td>
        <td valign="top"><?php foreach (json_decode($row_rsQuiz['answers'], 1) as $k => $v) {
			?>
			<div><input name="option[<?php echo $row_rsQuiz['id']; ?>]" type="radio" value="<?php echo $k; ?>" /> <?php echo $v; ?><input name="correct[<?php echo $row_rsQuiz['id']; ?>]" type="hidden" value="<?php echo $row_rsQuiz['correct']; ?>" /> </div>
		<?php
		} ?></td>
        <td valign="top"><?php echo $row_rsQuiz['explanation']; ?>
		<br /><?php echo $row_rsQuiz['correct']; ?> is correct</td>
      </tr>
      <?php } while ($row_rsQuiz = mysql_fetch_assoc($rsQuiz)); ?>
  </table>
  <p>
    <label>
	<input name="MM_insert" type="hidden" value="form1" />
    <input type="submit" name="Submit" value="Submit" />
    </label>
  </p>
</form>
<?php if ($totalRows_rsResults > 0) { // Show if recordset not empty ?>
  <h3>View Past Results</h3>
  <table border="1">
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
        <td><?php echo $row_rsResults['calc_percentage']; ?></td>
        <td><?php echo $row_rsResults['results']; ?></td>
        <td><a href="view_quiz.php?del_id=<?php echo $row_rsResults['cid']; ?>">Delete</a></td>
      </tr>
      <?php } while ($row_rsResults = mysql_fetch_assoc($rsResults)); ?>
      </table>
  <p> Records <?php echo ($startRow_rsResults + 1) ?> to <?php echo min($startRow_rsResults + $maxRows_rsResults, $totalRows_rsResults) ?> of <?php echo $totalRows_rsResults ?>
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
  <?php } // Show if recordset not empty ?></p>
<p>&nbsp; </p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsQuiz);

mysql_free_result($rsResults);
?>
