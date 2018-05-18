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

function getValue($theValue) {
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }
    
    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);  
    return $theValue; 
}

function time_elapsed_string($time_elapsed)
{
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
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

function getTextArea($fd) {
	$answers =  json_decode($fd['answers'], 1); 
	return '{
			"key": "rule'.$fd['id'].'",
			"name": "Rule '.$fd['id'].': '.$fd['topic'].'",
			"description": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($fd['explanation'])), '"').' (Ref '.$fd['id'].')",
			"examples": [
				{
					"question": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($fd['question'])), '"').'",
					"answerOptions": [
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[0])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[1])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[2])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[3])), '"').'"
					],
					"correct": '.$fd['correct'].',
					"explanation": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($fd['explanation'])), '"').'"
				}
			]
		}';
}

$error = '';
if (!empty($_POST['formData'])) {
	$formData = json_decode($_POST['formData'], 1);
	if (empty($_SESSION['startTime'])) {
		$_SESSION['startTime'] = time();	
	}
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
	
	$error .= '<h3>Topic</h3><div>'.$formData['topic'].'<br /></div>';
	if (!empty($formData['explanation'])) {
		$error .= '<b>Explanation:</b><br />'.nl2br($formData['explanation']).'<br /><br />';
	}
	
	$error .= '<b>Question:</b><br />'.$formData['id'].'. '.nl2br($formData['question']).'<br /><br />';
	
	$answers =  json_decode($formData['answers'], 1); 
	foreach ($answers as $k => $ans) { 
		$error .= ($k + 1).'. '. $ans.'<br /><br />';
	}
	
	$textarea = '{
			"key": "rule'.$formData['id'].'",
			"name": "Rule '.$formData['id'].': '.$formData['topic'].'",
			"description": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($formData['explanation'])), '"').' (Ref '.$formData['id'].')",
			"examples": [
				{
					"question": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($formData['question'])), '"').'",
					"answerOptions": [
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[0])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[1])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[2])), '"').'",
						"'.addcslashes(preg_replace('/\s+/', ' ', nl2br($answers[3])), '"').'"
					],
					"correct": '.$formData['correct'].',
					"explanation": "'.addcslashes(preg_replace('/\s+/', ' ', nl2br($formData['explanation'])), '"').'"
				}
			]
		}';//getTextArea($formData);
	
	$error .= '<a href="add_quiz.php?cat_id='.$formData['category_id'].'&editId='.$formData['id'].'#edit" target="_blank">Edit This Question</a><hr /><textarea rows="10" cols="50">'.$textarea.'</textarea>';
}

function buildQuery()
{
    $query = '';
    if (!empty($_GET['cat_ids'])) {
        $ids = implode(', ', $_GET['cat_ids']);
        $query .= ' AND category_id IN ('.getValue($ids).')';
    } else if (!empty($_GET['cat_id'])) {
        $query .= ' AND category_id = '. getValue($_GET['cat_id']);
    }
    
    if (!empty($_GET['question_id'])) {
        $query .= ' AND id IN ('.getValue($_GET['question_id']).')';
    }
    
    if (!empty($_SESSION['ansString'])) {
        $query .= ' AND id NOT IN ('.getValue($_SESSION['ansString']).')';
    }
    
    if (!empty($_GET['topic'])) {
      $query .= ' AND topic = '.GetSQLValueString($_GET['topic'], 'text');
    }
    return $query;
}

$sorting = 'id ASC';
if (!empty($_GET['sorting'])) {
	if ($_GET['sorting'] == 2) {
		$sorting = 'RAND()';
	}
}

$query = buildQuery();


$topicQuery = '';
if (!empty($_GET['topic'])) {
  $topicQuery = ' AND topic = '.GetSQLValueString($_GET['topic'], 'text');
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsQuestions = 1000;
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
$coltopic_rsQuestions = "%";
if (isset($_GET['topic'])) {
  $coltopic_rsQuestions = $_GET['topic'];
}

mysql_select_db($database_conn, $conn);
echo $query_rsQuestions = "SELECT * FROM qz_questions WHERE correct is not null $query ORDER BY $sorting";
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
$queryString_rsQuestions_main = $queryString_rsQuestions;

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

$textareaAll = '';
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
<h1>Quiz</h1>
<form id="form1" name="form1" method="post" action="">
<div><a href="index.php?parent_id=<?php echo $row_rsCat['parent_id']; ?>">Back To Category</a> | <a href="add_quiz.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">Add Quiz </a> | <a href="quiz.php?cat_id=<?php echo $row_rsCat['cat_id']; ?>">Restart Quiz</a> | <a href="quiz2.php?<?php echo $queryString_rsQuestions_main; ?>">Refresh This Page</a></div>
<div><strong>Current Page Url:</strong> <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $_SERVER['QUERY_STRING']; ?>">http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $_SERVER['QUERY_STRING']; ?></a></div>
<div><?php echo $breadCrumbString; ?></div><br />

<?php echo $error; ?>
<?php if (!empty($_SESSION['quiz'])) { ?>
<p><b>Score: </b> <?php echo $pts = calculatePoints($_SESSION['quiz']); ?> / <?php echo $max = count($_SESSION['quiz']); ?> : <?php echo $percentage = number_format((($pts / $max) * 100), 2); ?> % <br />
Total Time: <?php echo time_elapsed_string(time() - $_SESSION['startTime']); ?> <br />
<?php } ?>
<?php if ($totalRows_rsQuestions > 0) { ?>
<?php if (!empty($row_rsQuestions)) { ?>
<div class="table-responsive">
      <table class="table table-striped">
<?php do { ?>
<?php 
$textarea = getTextArea($row_rsQuestions);
$textareaAll = $textareaAll.',
		'.$textarea; ?>
<tr>
<td valign="top"><p><strong>Question Id:</strong> <?php echo $row_rsQuestions['id']; ?> (<?php echo $row_rsQuestions['topic']; ?>)</p>
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
<textarea rows="10" cols="50"><?php echo $textarea; ?></textarea>
</td>
</tr>
<?php } while ($row_rsQuestions = mysql_fetch_assoc($rsQuestions)); ?>
</table>
<textarea rows="10" cols="50"><?php echo $textareaAll; ?></textarea>
</div>
<?php } ?>
<div class="table-responsive">
      <table class="table table-striped">
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
</div>
<?php } ?>
<p>&nbsp;</p>
<p><strong>Remaining Problems:</strong> <?php echo $totalRows_rsQuestions ?></p>

</form>
<?php if (!empty($_SESSION['quiz'])) { ?>
<h3>Your Answers</h3>
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
        <?php foreach ($_SESSION['quiz'] as $k => $v) { ?>
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
<a href="save_quiz_result.php?save=1">Save Result</a> | <a href="quiz3_restart.php?<?php echo $_SERVER['QUERY_STRING']; ?>">Restart Quiz with Failed Results</a>
<pre>
<?php print_r($_SESSION['quiz']); ?>
</pre>
<?php } ?>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsQuestions);

mysql_free_result($rsCat);
?>
