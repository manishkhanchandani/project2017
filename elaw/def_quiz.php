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
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_conn, $conn);
$query_rsSubjects = "SELECT DISTINCT subject FROM law_definition_quiz";
$rsSubjects = mysql_query($query_rsSubjects, $conn) or die(mysql_error());
$row_rsSubjects = mysql_fetch_assoc($rsSubjects);
$totalRows_rsSubjects = mysql_num_rows($rsSubjects);

mysql_select_db($database_conn, $conn);
$query_rsChapter = "SELECT DISTINCT chapter FROM law_definition_quiz";
$rsChapter = mysql_query($query_rsChapter, $conn) or die(mysql_error());
$row_rsChapter = mysql_fetch_assoc($rsChapter);
$totalRows_rsChapter = mysql_num_rows($rsChapter);

mysql_select_db($database_conn, $conn);
$query_rsTopic = "SELECT DISTINCT topic FROM law_definition_quiz";
$rsTopic = mysql_query($query_rsTopic, $conn) or die(mysql_error());
$row_rsTopic = mysql_fetch_assoc($rsTopic);
$totalRows_rsTopic = mysql_num_rows($rsTopic);

$maxRows_rsQuiz = 1;
$pageNum_rsQuiz = 0;
if (isset($_GET['pageNum_rsQuiz'])) {
  $pageNum_rsQuiz = $_GET['pageNum_rsQuiz'];
}
$startRow_rsQuiz = $pageNum_rsQuiz * $maxRows_rsQuiz;

$colname2_rsQuiz = "%";
if (isset($_GET['chapter'])) {
  $colname2_rsQuiz = (get_magic_quotes_gpc()) ? $_GET['chapter'] : addslashes($_GET['chapter']);
}
$colname_rsQuiz = "%";
if (isset($_GET['subject'])) {
  $colname_rsQuiz = (get_magic_quotes_gpc()) ? $_GET['subject'] : addslashes($_GET['subject']);
}
$colname3_rsQuiz = "%";
if (isset($_GET['topic'])) {
  $colname3_rsQuiz = (get_magic_quotes_gpc()) ? $_GET['topic'] : addslashes($_GET['topic']);
}
mysql_select_db($database_conn, $conn);
$query_rsQuiz = sprintf("SELECT * FROM law_definition_quiz WHERE subject LIKE '%%%s%%' AND chapter LIKE '%%%s%%' AND topic LIKE '%%%s%%' ORDER BY sorting ASC", $colname_rsQuiz,$colname2_rsQuiz,$colname3_rsQuiz);
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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>display</title>
</head>

<body>
<h1>View Quiz</h1>
<form name="form2" method="post" action="">
Subject:
<label>
  <select name="subject" id="subject">
    <option value="%">Choose Subject</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsSubjects['subject']?>"><?php echo $row_rsSubjects['subject']?></option>
    <?php
} while ($row_rsSubjects = mysql_fetch_assoc($rsSubjects));
  $rows = mysql_num_rows($rsSubjects);
  if($rows > 0) {
      mysql_data_seek($rsSubjects, 0);
	  $row_rsSubjects = mysql_fetch_assoc($rsSubjects);
  }
?>
  </select>
  </label> 
Chapter: 
</form>
<?php if ($totalRows_rsQuiz > 0) { // Show if recordset not empty ?>
  <form name="form1" method="post" action="">
    <table border="1">
      <tr>
        <td><strong>Definition</strong></td>
        <td><strong>Subject</strong></td>
        <td><strong>Chapter</strong></td>
        <td><strong>Topic</strong></td>
        <td><strong>Sorting</strong></td>
        <td><strong>Created Date </strong></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_rsQuiz['definition']; ?></td>
          <td><?php echo $row_rsQuiz['subject']; ?></td>
          <td><?php echo $row_rsQuiz['chapter']; ?></td>
          <td><?php echo $row_rsQuiz['topic']; ?></td>
          <td><?php echo $row_rsQuiz['sorting']; ?></td>
          <td><?php echo $row_rsQuiz['created_quiz_dt']; ?></td>
        </tr>
        <?php } while ($row_rsQuiz = mysql_fetch_assoc($rsQuiz)); ?>
          </table>
  </form>
  <p> Records <?php echo ($startRow_rsQuiz + 1) ?> to <?php echo min($startRow_rsQuiz + $maxRows_rsQuiz, $totalRows_rsQuiz) ?> of <?php echo $totalRows_rsQuiz ?> 
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, 0, $queryString_rsQuiz); ?>">First</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, max(0, $pageNum_rsQuiz - 1), $queryString_rsQuiz); ?>">Previous</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, min($totalPages_rsQuiz, $pageNum_rsQuiz + 1), $queryString_rsQuiz); ?>">Next</a>
            <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, $totalPages_rsQuiz, $queryString_rsQuiz); ?>">Last</a>
            <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?></p>
<?php if ($totalRows_rsQuiz == 0) { // Show if recordset empty ?>
  <p>No Quiz Found </p>
  <?php } // Show if recordset empty ?></body>
</html>
<?php
mysql_free_result($rsSubjects);

mysql_free_result($rsChapter);

mysql_free_result($rsTopic);

mysql_free_result($rsQuiz);
?>
