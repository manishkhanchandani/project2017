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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO law_definition_quiz (user_id, definition, answer_value, subject, chapter, topic, sorting, created_quiz_dt) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['definition'], "text"),
                       GetSQLValueString($_POST['answer_value'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['chapter'], "text"),
                       GetSQLValueString($_POST['topic'], "text"),
                       GetSQLValueString($_POST['sorting'], "int"),
                       GetSQLValueString($_POST['created_quiz_dt'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$maxRows_rsQuiz = 100;
$pageNum_rsQuiz = 0;
if (isset($_GET['pageNum_rsQuiz'])) {
  $pageNum_rsQuiz = $_GET['pageNum_rsQuiz'];
}
$startRow_rsQuiz = $pageNum_rsQuiz * $maxRows_rsQuiz;

mysql_select_db($database_conn, $conn);
$query_rsQuiz = "SELECT * FROM law_definition_quiz ORDER BY quiz_id DESC";
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

$subject = !empty($_POST['subject']) ? $_POST['subject'] : '';
$chapter = !empty($_POST['chapter']) ? $_POST['chapter'] : '';
$topic = !empty($_POST['topic']) ? $_POST['topic'] : '';
$sorting = !empty($_POST['sorting']) ? $_POST['sorting'] : 0;
$sorting = $sorting + 1;
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Quiz</title>
</head>

<body>
<h1>Add Definition Quiz</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><p><strong>Definition:</strong></p>
      <p>[Replace Answer part with __BLANK__] </p></td>
      <td><textarea name="definition" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Answer value:</strong></td>
      <td><textarea name="answer_value" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Subject:</strong></td>
      <td><input type="text" name="subject" value="<?php echo $subject; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Chapter:</strong></td>
      <td><input type="text" name="chapter" value="<?php echo $chapter; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Topic:</strong></td>
      <td><input type="text" name="topic" value="<?php echo $topic; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Sorting:</strong></td>
      <td><input type="text" name="sorting" value="<?php echo $sorting; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
  <input type="hidden" name="created_quiz_dt" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php if ($totalRows_rsQuiz > 0) { // Show if recordset not empty ?>
  <p>View Quiz Data </p>
  <table border="1">
    <tr>
      <td><strong>quiz_id</strong></td>
      <td><strong>user_id</strong></td>
      <td><strong>definition</strong></td>
      <td><strong>answer_value</strong></td>
      <td><strong>subject</strong></td>
      <td><strong>chapter</strong></td>
      <td><strong>topic</strong></td>
      <td><strong>sorting</strong></td>
      <td><strong>created_quiz_dt</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsQuiz['quiz_id']; ?></td>
        <td><?php echo $row_rsQuiz['user_id']; ?></td>
        <td><?php echo $row_rsQuiz['definition']; ?></td>
        <td><?php echo $row_rsQuiz['answer_value']; ?></td>
        <td><?php echo $row_rsQuiz['subject']; ?></td>
        <td><?php echo $row_rsQuiz['chapter']; ?></td>
        <td><?php echo $row_rsQuiz['topic']; ?></td>
        <td><?php echo $row_rsQuiz['sorting']; ?></td>
        <td><?php echo $row_rsQuiz['created_quiz_dt']; ?></td>
      </tr>
      <?php } while ($row_rsQuiz = mysql_fetch_assoc($rsQuiz)); ?>
      </table>
  <p> Records <?php echo ($startRow_rsQuiz + 1) ?> to <?php echo min($startRow_rsQuiz + $maxRows_rsQuiz, $totalRows_rsQuiz) ?> of <?php echo $totalRows_rsQuiz ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, 0, $queryString_rsQuiz); ?>">First</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsQuiz > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, max(0, $pageNum_rsQuiz - 1), $queryString_rsQuiz); ?>">Previous</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, min($totalPages_rsQuiz, $pageNum_rsQuiz + 1), $queryString_rsQuiz); ?>">Next</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsQuiz < $totalPages_rsQuiz) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsQuiz=%d%s", $currentPage, $totalPages_rsQuiz, $queryString_rsQuiz); ?>">Last</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
      </table>
  <?php } // Show if recordset not empty ?></p>
</body>
</html>
<?php
mysql_free_result($rsQuiz);
?>