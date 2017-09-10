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

function regexp($input, $regexp, $casesensitive=false)
	{
		if ($casesensitive === true) {
			if (preg_match_all("/$regexp/sU", $input, $matches, PREG_SET_ORDER)) {
				return $matches;
			}
		} else {
			if (preg_match_all("/$regexp/siU", $input, $matches, PREG_SET_ORDER)) {
				return $matches;
			}
		}

		return false;
	}
function pr($value)
	{
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		return true;
	}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$arr = array();
$arr['explanation'] = '';
$arr['description'] = '';
$arr['option'][0] = '';
$arr['option'][1] = '';
$arr['option'][2] = '';
$arr['option'][3] = '';
if (!empty($_POST["body"])) {
	$regexp = 'EXPLANATION:(.*)QUESTION:(.*)(A\.(.*))(B\.(.*))(C\.(.*))(D\.(.*))$';
	$input = $_POST["body"];
	$matches = regexp($input, $regexp, true);
	$arr['explanation'] = trim($matches[0][1]);
	$arr['description'] = trim($matches[0][2]);
	$arr['option'][0] = trim($matches[0][4]);
	$arr['option'][1] = trim($matches[0][6]);
	$arr['option'][2] = trim($matches[0][8]);
	$arr['option'][3] = trim($matches[0][10]);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$_POST['answers'] = json_encode($_POST['option']);
	if ($_POST['correct'] != 0 && empty($_POST['correct'])) $_POST['correct'] = null;
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE qz_questions SET category_id=%s, question=%s, explanation=%s, status=%s, answers=%s, correct=%s, topic=%s WHERE id=%s",
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['explanation'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['answers'], "text"),
                       GetSQLValueString($_POST['correct'], "int"),
                       GetSQLValueString($_POST['topic'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$_POST['answers'] = json_encode($_POST['option']);
	if ($_POST['correct'] != 0 && empty($_POST['correct'])) $_POST['correct'] = null;
	$_POST['topic'] = trim($_POST['topic']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_questions (user_id, category_id, question, explanation, quiz_dt, status, answers, correct, topic) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['explanation'], "text"),
                       GetSQLValueString($_POST['quiz_dt'], "date"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['answers'], "text"),
                       GetSQLValueString($_POST['correct'], "int"),
                       GetSQLValueString($_POST['topic'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_GET['del_id'])) && ($_GET['del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM qz_questions WHERE id=%s",
                       GetSQLValueString($_GET['del_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}

$maxRows_rsQuiz = 5;
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
$query_rsQuiz = sprintf("SELECT * FROM qz_questions WHERE category_id = %s ORDER by id DESC", GetSQLValueString($colname_rsQuiz, "-1"));
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

$colname_rsCat = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsCat = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCat = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $colname_rsCat);
$rsCat = mysql_query($query_rsCat, $conn) or die(mysql_error());
$row_rsCat = mysql_fetch_assoc($rsCat);
$totalRows_rsCat = mysql_num_rows($rsCat);


$colname_rsEdit = "-1";
if (isset($_GET['editId'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['editId'] : addslashes($_GET['editId']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM qz_questions WHERE id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

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


$breadcrumb = array();
function breadcrumb($id = 0) {
	global $breadcrumb, $conn;
	if ($id == 0) {
		array_unshift($breadcrumb, array('id' => $id, 'text' => 'Home'));
		return;
	}
	
	$query = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $id);
	$rs = mysql_query($query, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($rs);
	
	array_unshift($breadcrumb, array('id' => $row['cat_id'], 'text' => $row['category']));
	return breadcrumb($row['parent_id']);
}
breadcrumb($row_rsCat['cat_id']);
$tmp = array();
foreach ($breadcrumb as $k => $v) {
	$tmp[] = '<a href="index.php?parent_id='.$v['id'].'">'.$v['text'].'</a>';
}
$breadCrumbString = implode(' > ', $tmp);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Add Quiz</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->


<style type="text/css">
<!--
.active {
	font-weight: bold;
	color: #FF0000;
}
-->
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
<h1>Add New Quiz</h1>
<div><a href="index.php?parent_id=<?php echo $row_rsCat['parent_id']; ?>">Go Back</a> | <a href="view_quiz_settings.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">View Quiz </a><br><br>
<?php echo $breadCrumbString; ?></div>



<form method="post" name="form1" action="<?php echo $editFormAction; ?>">

  <div class="table-responsive">
  <table class="table">
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Topic:</td>
      <td>
        <input name="topic" type="text" id="topic" value="" size="55">
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Question:</td>
      <td><textarea name="question" rows="7" class="form-control"><?php echo $arr['description']; ?></textarea>      </td>
    </tr>
	<?php for ($i = 0; $i < 4; $i++) { ?>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Option </td>
      <td><table width="100%" border="0">
        <tr>
          <td>
		  	<textarea name="option[<?php echo $i; ?>]" rows="3" cols="55"><?php echo $arr['option'][$i]; ?></textarea>
          </td>
          <td>
            <input name="correct" type="radio" value="<?php echo $i; ?>" />
          Correct Option </td>
        </tr>
      </table></td>
    </tr>
	<?php } ?>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Explanation:</td>
      <td><textarea name="explanation" cols="50" rows="5" class="form-control"><?php echo $arr['explanation']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Status:</td>
      <td><select name="status">
        <option value="1" <?php if (!(strcmp(1, "1"))) {echo "selected=\"selected\"";} ?>>Active</option>
        <option value="0" <?php if (!(strcmp(0, "1"))) {echo "selected=\"selected\"";} ?>>Inactive</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  </div>
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
  <input type="hidden" name="category_id" value="<?php echo $_GET['cat_id']; ?>">
  <input type="hidden" name="answers" value="">
  <input type="hidden" name="quiz_dt" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<script>
document.getElementById('topic1').focus();	
</script>

<form method="post" name="formParse" action="<?php echo $editFormAction; ?>">
<label>Parse Text</label>
<textarea name="body" cols="50" rows="5" class="form-control"></textarea>
<input type="submit" value="Process">
</form>
<?php if ($totalRows_rsQuiz > 0) { // Show if recordset not empty ?>
   <?php $i = 0;?>
  <h3>View Quiz </h3>
  <div class="table-responsive">
  <table class="table">
    <tr>
      <td valign="top"><strong>Number</strong></td>
      <td valign="top"><strong>Topic</strong></td>
      <td valign="top"><strong>Question</strong></td>
      <td valign="top"><strong>Explanation</strong></td>
      <td valign="top"><strong>Status</strong></td>
      <td valign="top"><strong>Answers</strong></td>
      <td valign="top"><strong>Correct</strong></td>
      <td valign="top"><strong>Edit</strong></td>
      <td valign="top"><strong>Delete</strong></td>
    </tr>
      <?php do { ?>
      <tr>
        <td valign="top"><?php echo $row_rsQuiz['id']; ?> (<?php $i++; echo $i; ?>)</td>
        <td valign="top"><?php echo $row_rsQuiz['topic']; ?></td>
        <td valign="top"><?php echo substr($row_rsQuiz['question'], 0, 25).'...<br />'.substr($row_rsQuiz['question'], -25); ?></td>
        <td valign="top"><?php echo substr($row_rsQuiz['explanation'], 0, 25); ?></td>
        <td valign="top"><?php echo $row_rsQuiz['status']; ?></td>
        <td valign="top"><?php /*foreach (json_decode($row_rsQuiz['answers'], 1) as $k => $v) {
			if ($k == $row_rsQuiz['correct']) $class = 'active'; else $class = '';
			echo '<div class="'.$class.'">'.($k + 1).'. '.$v.'</div>';
		}*/ ?></td>
        <td valign="top"><?php echo $row_rsQuiz['correct']; ?></td>
        <td valign="top"><a href="add_quiz.php?cat_id=<?php echo $_GET['cat_id']; ?>&editId=<?php echo $row_rsQuiz['id']; ?>#edit">Edit</a></td>
        <td valign="top"><a href="add_quiz.php?cat_id=<?php echo $_GET['cat_id']; ?>&del_id=<?php echo $row_rsQuiz['id']; ?>" onClick="var a = confirm('do you want to delete?'); return a;">Delete</a></td>
      </tr>
      <?php } while ($row_rsQuiz = mysql_fetch_assoc($rsQuiz)); ?>
      </table>
Records <?php echo ($startRow_rsQuiz + 1) ?> to <?php echo min($startRow_rsQuiz + $maxRows_rsQuiz, $totalRows_rsQuiz) ?> of <?php echo $totalRows_rsQuiz ?> <br>
<br>
  <table width="50%" border="0" align="center">
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
  </div>
  <?php } // Show if recordset not empty ?>

<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
<h3>Edit Record <a name="edit"></a></h3>
<?php 
	$row_rsEdit['options'] = json_decode($row_rsEdit['answers'], true);
	 
?>
 <form method="post" name="form2" action="<?php echo $editFormAction; ?>">

  <div class="table-responsive">
  <table class="table">
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Category ID:</td>
      <td><label for="category_id"></label>
        <input name="category_id" type="text" id="category_id" value="<?php echo $row_rsEdit['category_id']; ?>" size="55"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Topic:</td>
      <td>
        <input name="topic" type="text" id="topic" size="55" value="<?php echo $row_rsEdit['topic']; ?>">
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Question:</td>
      <td><textarea name="question" rows="7" class="form-control"><?php echo $row_rsEdit['question']; ?></textarea>      </td>
    </tr>
	<?php for ($i = 0; $i < 4; $i++) { ?>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Option </td>
      <td><table width="100%" border="0">
        <tr>
          <td>
		  	<textarea name="option[<?php echo $i; ?>]" rows="3" cols="55"><?php echo $row_rsEdit['options'][$i]; ?></textarea>
          </td>
          <td>
            <input name="correct" type="radio" value="<?php echo $i; ?>" <?php if (!is_null($row_rsEdit['correct']) && $row_rsEdit['correct'] == $i) echo ' checked'; ?> />
          Correct Option </td>
        </tr>
      </table></td>
    </tr>
	<?php } ?>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Explanation:</td>
      <td><textarea name="explanation" cols="50" rows="7" class="form-control"><?php echo $row_rsEdit['explanation']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Status:</td>
      <td><select name="status">
        <option value="1" <?php if (!(strcmp(1, $row_rsEdit['status']))) {echo "SELECTED";} ?>>Active</option>
        <option value="0" <?php if (!(strcmp(0, $row_rsEdit['status']))) {echo "SELECTED";} ?>>Inactive</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  </div>
  <input type="hidden" name="id" value="<?php echo $row_rsEdit['id']; ?>">
  <input type="hidden" name="answers" value="<?php echo $row_rsEdit['answers']; ?>">
  <input type="hidden" name="MM_update" value="form2">
</form>  
<?php } // Show if recordset not empty ?>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsQuiz);

mysql_free_result($rsCat);

mysql_free_result($rsEdit);
?>
