<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

$MM_authorizedUsers = "admin,superadmin";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
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
	$error = '';
	if (empty($_POST['content_type'])) {
		$error = 'Empty Content Type';
	}

	if (empty($_POST['content_subtype'])) {
		$error = 'Empty Content Sub Type';
	}

	if (empty($_POST['content_title'])) {
		$error = 'Empty Title';
	}
	
	if ($_SESSION['MM_UserId'] <= 0) {
		$error = 'Invalid User';
	}

	$_POST['subject_id'] = $_GET['subject_id'];
	$_POST['user_id'] = $_SESSION['MM_UserId'];
	$_POST['course_id'] = $_GET['course_id'];
	$_POST['chapter_id'] = $_GET['chapter_id'];
	$_POST['topic_id'] = $_GET['topic_id'];
	
	$_POST['view_images'] = array_filter($_POST['view_images2']);
	$_POST['view_videos'] = array_filter($_POST['view_videos2']);
	$_POST['view_links'] = array_filter($_POST['view_links2']);
	$_POST['linebyline'] = array_filter($_POST['linebyline']);
	
	$_POST['view_images'] = json_encode($_POST['view_images']);
	$_POST['view_videos'] = json_encode($_POST['view_videos']);
	$_POST['view_links'] = json_encode($_POST['view_links']);
	if ($_POST['content_subtype'] === 'line') {
		$_POST['xtra1'] = json_encode($_POST['linebyline']);
	}
	
	if ($_POST['content_type'] === 'quiz') {
		$arr = array(
			'qz_question' => $_POST['qz_question'],
			'qz_options' => array_filter($_POST['qz_options']),
			'qz_correct' => $_POST['qz_correct'],
			'qz_explanation' => $_POST['qz_explanation'],
		);
		$_POST['xtra1'] = json_encode($arr);
	} else if ($_POST['content_type'] === 'qna') {
		$arr = array();
		foreach ($_POST['qna'] as $k => $v) {
			if (!trim($v)) continue;
			$arr[$k] = array('qna' => $v, 'qna_ans' => $_POST['qna_ans'][$k]);
		}
		$_POST['xtra1'] = json_encode($arr);
	}

	if (!empty($error)) {
		unset($_POST['MM_insert']);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO course_contents (course_id, user_id, subject_id, chapter_id, topic_id, content_enabled, content_title, content_description, view_images, view_videos, view_links, content_type, xtra1, content_subtype, content_sorting) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['course_id'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['subject_id'], "int"),
                       GetSQLValueString($_POST['chapter_id'], "int"),
                       GetSQLValueString($_POST['topic_id'], "int"),
                       GetSQLValueString($_POST['content_enabled'], "int"),
                       GetSQLValueString($_POST['content_title'], "text"),
                       GetSQLValueString($_POST['content_description'], "text"),
                       GetSQLValueString($_POST['view_images'], "text"),
                       GetSQLValueString($_POST['view_videos'], "text"),
                       GetSQLValueString($_POST['view_links'], "text"),
                       GetSQLValueString($_POST['content_type'], "text"),
                       GetSQLValueString($_POST['xtra1'], "text"),
                       GetSQLValueString($_POST['content_subtype'], "text"),
                       GetSQLValueString($_POST['content_sorting'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "manage_topics.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$coluser_rsCourse = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsCourse = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsCourse = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsCourse = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCourse = sprintf("SELECT * FROM course_details WHERE course_id = %s AND course_deleted = 0 AND user_id = %s", $colname_rsCourse,$coluser_rsCourse);
$rsCourse = mysql_query($query_rsCourse, $conn) or die(mysql_error());
$row_rsCourse = mysql_fetch_assoc($rsCourse);
$totalRows_rsCourse = mysql_num_rows($rsCourse);

$colsubuid_rsSubject = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colsubuid_rsSubject = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colid_rsSubject = "-1";
if (isset($_GET['course_id'])) {
  $colid_rsSubject = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
$colname_rsSubject = "-1";
if (isset($_GET['subject_id'])) {
  $colname_rsSubject = (get_magic_quotes_gpc()) ? $_GET['subject_id'] : addslashes($_GET['subject_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSubject = sprintf("SELECT * FROM course_subjects WHERE subject_id = %s AND course_id = %s AND user_id = %s AND subject_deleted = 0", $colname_rsSubject,$colid_rsSubject,$colsubuid_rsSubject);
$rsSubject = mysql_query($query_rsSubject, $conn) or die(mysql_error());
$row_rsSubject = mysql_fetch_assoc($rsSubject);
$totalRows_rsSubject = mysql_num_rows($rsSubject);

$coluser_rsChapter = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsChapter = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsChapter = "-1";
if (isset($_GET['chapter_id'])) {
  $colname_rsChapter = (get_magic_quotes_gpc()) ? $_GET['chapter_id'] : addslashes($_GET['chapter_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsChapter = sprintf("SELECT * FROM course_chapters WHERE chapter_id = %s AND chapter_deleted = 0 AND user_id = %s", $colname_rsChapter,$coluser_rsChapter);
$rsChapter = mysql_query($query_rsChapter, $conn) or die(mysql_error());
$row_rsChapter = mysql_fetch_assoc($rsChapter);
$totalRows_rsChapter = mysql_num_rows($rsChapter);

$coluser_rsTopic = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsTopic = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsTopic = "-1";
if (isset($_GET['topic_id'])) {
  $colname_rsTopic = (get_magic_quotes_gpc()) ? $_GET['topic_id'] : addslashes($_GET['topic_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsTopic = sprintf("SELECT * FROM course_topics WHERE topic_id = %s AND user_id = %s AND topic_deleted = 0", $colname_rsTopic,$coluser_rsTopic);
$rsTopic = mysql_query($query_rsTopic, $conn) or die(mysql_error());
$row_rsTopic = mysql_fetch_assoc($rsTopic);
$totalRows_rsTopic = mysql_num_rows($rsTopic);

$maxRows_rsView = 500;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colcourseid_rsView = "-1";
if (isset($_GET['course_id'])) {
  $colcourseid_rsView = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
$colsubjectid_rsView = "-1";
if (isset($_GET['subject_id'])) {
  $colsubjectid_rsView = (get_magic_quotes_gpc()) ? $_GET['subject_id'] : addslashes($_GET['subject_id']);
}
$colchapterid_rsView = "-1";
if (isset($_GET['chapter_id'])) {
  $colchapterid_rsView = (get_magic_quotes_gpc()) ? $_GET['chapter_id'] : addslashes($_GET['chapter_id']);
}
$coltopicid_rsView = "-1";
if (isset($_GET['topic_id'])) {
  $coltopicid_rsView = (get_magic_quotes_gpc()) ? $_GET['topic_id'] : addslashes($_GET['topic_id']);
}
$colname_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM course_contents WHERE user_id = %s AND course_id = %s AND subject_id = %s AND chapter_id = %s AND topic_id = %s", $colname_rsView,$colcourseid_rsView,$colsubjectid_rsView,$colchapterid_rsView,$coltopicid_rsView);
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
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Manage Topics</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<script>
function checkpara() {
	if ($("#content_subtype_2").is(":checked")) {
		$("#trLineByLine").show();
	} else {
		$("#trLineByLine").hide();
	}
}
function hideQuiz() {
	$("#qz1").hide();
	$("#qz2").hide();
	$("#qz3").hide();
	$("#qz4").hide();
}
function showQuiz() {
	$("#qz1").show();
	$("#qz2").show();
	$("#qz3").show();
	$("#qz4").show();
}
function checktype() {
	if ($("#content_type").is(":checked")) {
		hideQuiz();
		$("#content_subtype_2").attr('disabled', false);
		$("#trQNA").hide();
	} else if ($("#content_type_2").is(":checked")) {
		hideQuiz();
		$("#content_subtype_2").attr('disabled', false);
		$("#trQNA").hide();
	} else if ($("#content_type_3").is(":checked"))  {
		showQuiz();
		$("#content_subtype_2").attr('disabled', true);
		$("#content_subtype").prop('checked', true);
		$("#trLineByLine").hide();
		$("#trQNA").hide();
	}  else if ($("#content_type_4").is(":checked"))  {
		$("#trQNA").show();
		hideQuiz();
		$("#content_subtype_2").attr('disabled', true);
		$("#content_subtype").prop('checked', true);
		$("#trLineByLine").hide();
	}
}
</script>
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1><?php echo $row_rsTopic['topic_name']; ?></h1>
  <small>Course &quot;<strong><?php echo $row_rsCourse['course_name']; ?></strong>&quot; and Subject &quot;<strong><?php echo $row_rsSubject['subject_name']; ?></strong>&quot; and Chapter &quot;<strong><?php echo $row_rsChapter['chapter_name']; ?></strong>&quot;</small>
  <hr />
  <p class="page-header"><a href="index.php">Back to Courses</a> | <a href="manage_course.php?course_id=<?php echo $_GET['course_id']; ?>">Back to Subjects</a> | <a href="manage_subjects.php?course_id=<?php echo $_GET['course_id']; ?>&subject_id=<?php echo $_GET['subject_id']; ?>">Back to Chapters</a> | <a href="manage_chapters.php?course_id=<?php echo $_GET['course_id']; ?>&subject_id=<?php echo $_GET['subject_id']; ?>&chapter_id=<?php echo $_GET['chapter_id']; ?>">Back to Topics</a> </p>
  

  
		<h3>Create Content</h3>
		<hr />
		<?php if (!empty($error)) { ?>
		<div class="alert alert-danger">
		  <?php echo $error; ?>
		</div>
		<?php } ?>
		<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
		    <div class="table-responsive">
  <table class="table">
                <tr valign="baseline">
                    <td align="right" valign="top" nowrap><strong>Content Title:</strong></td>
                    <td valign="top"><input type="text" name="content_title" value="" class="form-control"  /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right" valign="top"><strong>Content Description:</strong></td>
                    <td valign="top"><textarea name="content_description" id="content_description" rows="5"></textarea>                    </td>
                </tr>
				
                <tr valign="baseline">
                    <td align="right" valign="top" nowrap>
                        <label for="content_type">Content Type:</label>
                    </td>
                    <td valign="top"><div>
					<input type="radio" id="content_type" name="content_type" value="read" <?php echo (empty($_POST['content_type']) || (!empty($_POST['content_type']) && $_POST['content_type'] === 'read')) ? 'checked' : ''; ?> onClick="checktype()" /> Read 
					<input type="radio" id="content_type_2" name="content_type" value="write" <?php echo (!empty($_POST['content_type']) && $_POST['content_type'] === 'write') ? 'checked' : ''; ?> onClick="checktype()" /> Write 
					<input type="radio" id="content_type_3" name="content_type" value="quiz" <?php echo (!empty($_POST['content_type']) && $_POST['content_type'] === 'quiz') ? 'checked' : ''; ?> onClick="checktype()" /> Quiz 
				    <input type="radio" id="content_type_4" name="content_type" value="qna" <?php echo (!empty($_POST['content_type']) && $_POST['content_type'] === 'qna') ? 'checked' : ''; ?> onClick="checktype()" />
Q&amp;A </div></td>
                </tr>
                <tr valign="baseline">
                    <td align="right" valign="top" nowrap><strong>
                        <label for="content_type">Content Sub Type:</label>
                    </strong></td>
                    <td valign="top"><div>
					<input type="radio" id="content_subtype" name="content_subtype" value="para" <?php echo (empty($_POST['content_subtype']) || (!empty($_POST['content_subtype']) && $_POST['content_subtype'] === 'para')) ? 'checked' : ''; ?> onClick="checkpara()" /> Paragraph 
					<input type="radio" id="content_subtype_2" name="content_subtype" value="line" <?php echo (!empty($_POST['content_subtype']) && $_POST['content_subtype'] === 'line') ? 'checked' : ''; ?> onClick="checkpara()" /> Line By Line
				</div></td>
                </tr>
				
                <tr valign="baseline" id="qz1" style="display:none;">
                    <td align="right" valign="top" nowrap><label>Quiz Question </label></td>
                    <td valign="top">
                        <textarea name="qz_question" class="form-control" rows="3" id="qz_question" placeholder="Add Question"></textarea>
                    </td>
                </tr>
                <tr valign="baseline" id="qz2" style="display:none;">
                    <td align="right" valign="top" nowrap><strong>Quiz Options: </strong></td>
                    <td valign="top"><input name="addqzoptions" type="button" id="addqzoptions" value="Add More Options" onClick="addMoreOptions();" /><br /><br />
					
					<div id="qzoptsitems"><textarea name="qz_options[]"  class="form-control" rows="3" id="qz_options[]" placeholder="Add Option"></textarea></div>
					<div id="qzoptsitems2" style="display:none;">
						<br />
						<textarea name="qz_options[]"  class="form-control" rows="3" id="qz_options[]" placeholder="Add Option"></textarea>
						</div>
						<script>
							function addMoreOptions() {
								$('#qzoptsitems').append($('#qzoptsitems2').html());
							}
						</script>
					</td>
                </tr>
                <tr valign="baseline" id="qz3" style="display:none;">
                    <td align="right" valign="top" nowrap><label>Quiz Correct Option </label></td>
                    <td valign="top"><input type="text" name="qz_correct" value="" class="form-control" placeholder="Add Correct option (1 or 2,..)" />
                    </td>
                </tr>
                <tr valign="baseline" id="qz4" style="display:none;">
                    <td align="right" valign="top" nowrap><label>Quiz Explanation </label></td>
                    <td valign="top">
                        <textarea name="qz_explanation" class="form-control" rows="3" id="qz_explanation" placeholder="Add Explanation"></textarea>
                    </td>
                </tr>
				
                <tr valign="baseline" id="trQNA" style="display:none;">
                  <td align="right" valign="top" nowrap><strong>Question & Answers:</strong></td>
                  <td valign="top">
						<input name="moreqna" type="button" id="moreqna" value="Add More Q&A" onClick="addMoreQnA();" />
						<div id="qnaitems">
				  		<strong>Question</strong><br />
						<textarea name="qna[]" class="form-control" rows="3" id="qna[]" placeholder="Add Q&A"></textarea><br />
						<strong>Answer (leave blank for custom answers by user)</strong><br />
						<textarea name="qna_ans[]" class="form-control" rows="3" id="qna_ans[]" placeholder="Add Q&A Answer"></textarea>
						</div>
						<div id="qnaitems2" style="display:none;">
						<br />
				  		<strong>Question</strong><br />
						<textarea name="qna[]" class="form-control" rows="3" id="qna[]" placeholder="Add Q&A"></textarea><br />
						<strong>Answer (leave blank for custom answers by user)</strong><br />
						<textarea name="qna_ans[]" class="form-control" rows="3" id="qna_ans[]" placeholder="Add Q&A Answer"></textarea>
						</div>
						<script>
							function addMoreQnA() {
								$('#qnaitems').append($('#qnaitems2').html());
							}
						</script>					</td>
              </tr>
                <tr valign="baseline" id="trLineByLine" style="display:none;">
                  <td align="right" valign="top" nowrap><strong>Line By Line Items:</strong></td>
                  <td valign="top"><div id="linebylineitems">
						<input name="linebyline[]" type="text" id="linebyline[]" size="55" placeholder="Add Lines" />
						<input name="morelinebyline" type="button" id="morelinebyline" value="Add More Lines" onClick="addMoreLines();" />
						</div>
						<div id="linebylineitems2" style="display:none;">
						<br />
						<input name="linebyline[]" type="text" id="linebyline[]" size="55" placeholder="Add Lines" />
						</div>
						<script>
							function addMoreLines() {
								$('#linebylineitems').append($('#linebylineitems2').html());
							}
						</script>					</td>
              </tr>
				
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Images:</strong></td>
                  <td valign="top"><div id="images">
						<input name="view_images2[]" type="text" id="view_images2[]" size="55" placeholder="Add Image URL" />
						<input name="moreImage" type="button" id="moreImage" value="Add More Images" onClick="addMoreImages();" />
						</div>
						<div id="images2" style="display:none;">
						<br />
						<input name="view_images2[]" type="text" id="view_images2[]" size="55" placeholder="Add Image URL" />
						</div>
						<script>
							function addMoreImages() {
								$('#images').append($('#images2').html());
							}
						</script>					</td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Videos (Youtube URL):</strong></td>
                  <td valign="top">
				  	<div id="videos">
						<input name="view_videos2[]" type="text" id="view_videos2[]" size="55" placeholder="Add Youtube URLS" />
						<input name="moreVideos" type="button" id="moreVideos" value="Add More Videos" onClick="addMoreVideos();" />
						</div>
						<div id="videos2" style="display:none;">
							<br />
							<input name="view_videos2[]" type="text" id="view_videos2[]" size="55" placeholder="Add Youtube URLS" />
						</div>
						<script>
							function addMoreVideos() {
								$('#videos').append($('#videos2').html());
							}
						</script>				  </td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Links / PDF / Document:</strong></td>
                  <td valign="top">
				  	<div id="links">
						<input name="view_links2[]" type="text" id="view_links2[]" size="55" placeholder="Add Links" />
						<input name="moreLinks" type="button" id="moreLinks" value="Add More Links" onClick="addMoreLinks();" />
					</div>
					<div id="links2" style="display:none;">
						<br />
						<input name="view_links2[]" type="text" id="view_links2[]" size="55" placeholder="Add Links" />
					</div>
					<script>
						function addMoreLinks() {
							$('#links').append($('#links2').html());
						}
					</script>				  </td>
              </tr>
              <tr valign="baseline">
                  <td align="right" valign="top" nowrap><strong>Sorting:</strong></td>
                  <td valign="top"><input name="content_sorting" type="text" id="content_sorting" value="0" size="32"></td>
              </tr>

                <tr valign="baseline">
                    <td align="right" valign="top" nowrap><strong>
                        <label for="content_enabled">Status: </label>
                    </strong></td>
                    <td valign="top">
                        <input name="content_enabled" id="content_enabled" type="radio" value="1">
                        Enable
                        <input name="content_enabled" id="content_enabled_2" type="radio" value="0" checked>
                        Disable</td>
                </tr>
                <tr valign="baseline">
                    <td align="right" valign="top" nowrap>&nbsp;</td>
                    <td valign="top"><input type="submit" value="Add New Content"></td>
                </tr>
            </table>
		    </div>
            <input type="hidden" name="course_id" value="">
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="subject_id" value="">
            <input type="hidden" name="chapter_id" value="">
            <input type="hidden" name="topic_id" value="">
            <input type="hidden" name="view_images" value="">
            <input type="hidden" name="view_videos" value="">
            <input type="hidden" name="view_links" value="">
            <input type="hidden" name="xtra1" value="">
            <input type="hidden" name="MM_insert" value="form1">
<script>

 	$(document).ready(function() {
        $('#content_description').summernote({
			height: 250						   
		});
    });
</script>
        </form>
		
		
		
		<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
            <div>
                <h3>View Contents</h3>
                <div class="table-responsive">
  <table class="table">
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>Content Type </strong></td>
                        <td><strong>Content Sub Type </strong></td>
                        <td><strong>Title</strong></td>
                        <td><strong>Is Enabled </strong></td>
                        <td><strong>Created On </strong></td>
                        <td><strong>Sorting</strong></td>
                    </tr>
                    <?php do { ?>
                        <tr>
                            <td><?php echo $row_rsView['content_id']; ?></td>
                            <td><?php echo $row_rsView['content_type']; ?></td>
                            <td><?php echo $row_rsView['content_subtype']; ?></td>
                            <td><?php echo $row_rsView['content_title']; ?></td>
                            <td><?php echo $row_rsView['content_enabled']; ?></td>
                            <td><?php echo $row_rsView['content_created']; ?></td>
                            <td><?php echo $row_rsView['content_sorting']; ?></td>
                        </tr>
                        <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
                </table>
				</div>
                <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?> </p>
                <table border="0" width="50%" align="center">
                    <tr>
                        <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                                    <?php } // Show if not first page ?>
                        </td>
                        <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                                    <?php } // Show if not first page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                                    <?php } // Show if not last page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                                    <?php } // Show if not last page ?>
                        </td>
                    </tr>
                </table>
               
                <p>&nbsp;</p>
            </div>
		    <?php } // Show if recordset not empty ?></div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCourse);

mysql_free_result($rsSubject);

mysql_free_result($rsChapter);

mysql_free_result($rsTopic);

mysql_free_result($rsView);
?>
