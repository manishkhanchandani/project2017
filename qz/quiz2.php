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

$sorting = 'id ASC';
if (!empty($_GET['sorting'])) {
	if ($_GET['sorting'] == 2) {
		$sorting = 'RAND()';
	}
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

function totalPoints($data)
{
	if (empty($data)) {
		return 0;	
	}
	return count($data);
}

$error = '';
if (!empty($_POST['formData'])) {
	$formData = json_decode($_POST['formData'], 1);
	$_SESSION['quiz'][$formData['id']] = array(
												   	'data' => $formData,
													'answer' => $_POST['selectedAnswer'],
													'correct' => $formData['correct'],
													'isCorrect' => ($formData['correct'] == $_POST['selectedAnswer'])
												   );
	array_push($_SESSION['ansArray'], $formData['id']);
	$_SESSION['ansArray'] = array_unique($_SESSION['ansArray']);
	$_SESSION['ansString'] = implode(',',$_SESSION['ansArray']);
	$error = '';
	if ($formData['correct'] == $_POST['selectedAnswer']) {
		$error = 'You <b>answerd correctly</b> (Option '.($formData['correct'] + 1).')';
	} else {
		$error = 'You <b>answerd wrong</b> (Option '.($_POST['selectedAnswer'] + 1).'), <b>Correct Answer </b>is (Option '.($formData['correct'] + 1).')';
	}
	
	$error = '<div class="alert alert-success">'.$error.'</div>';
	
	if (!empty($formData['explanation'])) {
		$error .= '<b>Explanation:</b><br />'.nl2br($formData['explanation']).'<br /><br />';
	}
	
	$error .= '<b>Question:</b><br />'.nl2br($formData['question']);
	
	$answers =  json_decode($formData['answers'], 1); 
	foreach ($answers as $k => $ans) { 
		$error .= ($k + 1).'. '. $ans.'<br /><br />';
	}
	
	$error .= '<hr />';
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsQuestions = 1;
$pageNum_rsQuestions = 0;
if (isset($_GET['pageNum_rsQuestions'])) {
  $pageNum_rsQuestions = $_GET['pageNum_rsQuestions'];
}
$startRow_rsQuestions = $pageNum_rsQuestions * $maxRows_rsQuestions;

$colname_rsQuestions = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsQuestions = $_GET['cat_id'];
}
$colid_rsQuestions = "-1";
if (isset($_SESSION['ansString'])) {
  $colid_rsQuestions = $_SESSION['ansString'];
}
$coluser_rsQuestions = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsQuestions = $_SESSION['MM_UserId'];
}
$coltopic_rsQuestions = "%";
if (isset($_GET['topic'])) {
  $coltopic_rsQuestions = $_GET['topic'];
}
mysql_select_db($database_conn, $conn);
$query_rsQuestions = sprintf("SELECT * FROM qz_questions WHERE category_id = %s and user_id = %s and topic LIKE %s AND id NOT IN (%s) ORDER BY $sorting", GetSQLValueString($colname_rsQuestions, "int"),GetSQLValueString($coluser_rsQuestions, "int"),GetSQLValueString($coltopic_rsQuestions, "text"),$colid_rsQuestions);
$query_limit_rsQuestions = sprintf("%s LIMIT %d, %d", $query_rsQuestions, $startRow_rsQuestions, $maxRows_rsQuestions);
$rsQuestions = mysql_query($query_limit_rsQuestions, $conn) or die(mysql_error());
$row_rsQuestions = mysql_fetch_assoc($rsQuestions);

if (isset($_GET['totalRows_rsQuestions'])) {
  $totalRows_rsQuestions = $_GET['totalRows_rsQuestions'];
} else {
  $all_rsQuestions = mysql_query($query_rsQuestions);
  $totalRows_rsQuestions = mysql_num_rows($all_rsQuestions);
}
$totalPages_rsQuestions = ceil($totalRows_rsQuestions/$maxRows_rsQuestions)-1;

$colname_rsCat = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsCat = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsCat = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $colname_rsCat);
$rsCat = mysql_query($query_rsCat, $conn) or die(mysql_error());
$row_rsCat = mysql_fetch_assoc($rsCat);
$totalRows_rsCat = mysql_num_rows($rsCat);

$queryString_rsQuestions = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsQuestions") == false && 
        stristr($param, "totalRows_rsQuestions") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsQuestions = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsQuestions = sprintf("&totalRows_rsQuestions=%d%s", $totalRows_rsQuestions, $queryString_rsQuestions);

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
          
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Issues <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="issue_details_view.php">Issue Details</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Deprecated</li>
                <li><a href="issues.php">Issue Spotting</a></li>
              </ul>
            </li>
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
<h1>Quiz</h1>
<form id="form1" name="form1" method="post" action="">
<div><a href="index.php?parent_id=<?php echo $row_rsCat['parent_id']; ?>">Back To Category</a> | <a href="add_quiz.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">Add Quiz </a> | <a href="quiz.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">Change Parameters</a></div>

<div><?php echo $breadCrumbString; ?></div><br />

<?php echo $error; ?>
<?php if (!empty($_SESSION['quiz'])) { ?>
<p><b>Score: </b> <?php echo $pts = calculatePoints($_SESSION['quiz']); ?> / <?php echo $max = count($_SESSION['quiz']); ?> : <?php echo $percentage = (($pts / $max) * 100); ?> % <br />
<?php } ?>
<div class="table-responsive">
      <table class="table table-striped">
<?php do { ?>
<tr>
<td valign="top"><p><strong>Question Id:</strong><br /> 
<?php echo $row_rsQuestions['id']; ?></p>
<p><strong>Question:</strong><br />
<?php echo nl2br($row_rsQuestions['question']); ?></p>
<p><strong>Options:</strong><br />
<?php $answers =  json_decode($row_rsQuestions['answers'], 1); ?>

<?php foreach ($answers as $k => $ans) { ?>

<input type="radio" name="selectedAnswer" value="<?php echo $k; ?>" /> <?php echo $k + 1; ?>. <?php echo $ans; ?><br /><br />
<?php } ?>
</p></td>
</tr>
<tr>
<td valign="top">
<input type="submit" name="button" id="button" value="Submit" />
<input name="formData" type="hidden" id="formData" value="<?php echo htmlentities(json_encode($row_rsQuestions)); ?>" />
</td>
</tr>
<?php } while ($row_rsQuestions = mysql_fetch_assoc($rsQuestions)); ?>
</table>
</div>
<table border="0">
<tr>
<td><?php if ($pageNum_rsQuestions > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_rsQuestions=%d%s", $currentPage, 0, $queryString_rsQuestions); ?>">First</a>
<?php } // Show if not first page ?></td>
<td><?php if ($pageNum_rsQuestions > 0) { // Show if not first page ?>
<a href="<?php printf("%s?pageNum_rsQuestions=%d%s", $currentPage, max(0, $pageNum_rsQuestions - 1), $queryString_rsQuestions); ?>">Previous</a>
<?php } // Show if not first page ?></td>
<td><?php if ($pageNum_rsQuestions < $totalPages_rsQuestions) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_rsQuestions=%d%s", $currentPage, min($totalPages_rsQuestions, $pageNum_rsQuestions + 1), $queryString_rsQuestions); ?>">Next</a>
<?php } // Show if not last page ?></td>
<td><?php if ($pageNum_rsQuestions < $totalPages_rsQuestions) { // Show if not last page ?>
<a href="<?php printf("%s?pageNum_rsQuestions=%d%s", $currentPage, $totalPages_rsQuestions, $queryString_rsQuestions); ?>">Last</a>
<?php } // Show if not last page ?></td>
</tr>
</table>
<p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsQuestions);

mysql_free_result($rsCat);
?>
