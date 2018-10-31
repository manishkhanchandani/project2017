<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
include_once('init.php');
$starttime = microtime(true);
$currentPage = $_SERVER["PHP_SELF"];

$colname_rsView = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM course_details WHERE course_id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colid_rsJoin = "-1";
if (isset($_GET['course_id'])) {
  $colid_rsJoin = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
$colname_rsJoin = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsJoin = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsJoin = sprintf("SELECT * FROM course_join WHERE user_id = %s AND course_id = %s", $colname_rsJoin,$colid_rsJoin);
$rsJoin = mysql_query($query_rsJoin, $conn) or die(mysql_error());
$row_rsJoin = mysql_fetch_assoc($rsJoin);
$totalRows_rsJoin = mysql_num_rows($rsJoin);

$colname_rsSubject = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsSubject = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSubject = sprintf("SELECT * FROM course_subjects WHERE course_id = %s ORDER BY subject_sorting ASC", $colname_rsSubject);
$rsSubject = mysql_query($query_rsSubject, $conn) or die(mysql_error());
$row_rsSubject = mysql_fetch_assoc($rsSubject);
$totalRows_rsSubject = mysql_num_rows($rsSubject);

$colname_rsChapter = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsChapter = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsChapter = sprintf("SELECT * FROM course_chapters WHERE course_id = %s ORDER BY chapter_sorting ASC", $colname_rsChapter);
$rsChapter = mysql_query($query_rsChapter, $conn) or die(mysql_error());
$row_rsChapter = mysql_fetch_assoc($rsChapter);
$totalRows_rsChapter = mysql_num_rows($rsChapter);

$colname_rsTopic = "3";
if (isset($_GET['course_id'])) {
  $colname_rsTopic = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsTopic = sprintf("SELECT course_contents.*, course_topics.topic_name, course_chapters.chapter_name, course_subjects.subject_name FROM course_contents INNER JOIN course_topics ON course_contents.topic_id = course_topics.topic_id INNER JOIN course_chapters ON course_contents.chapter_id = course_chapters.chapter_id INNER JOIN course_subjects ON course_contents.subject_id = course_subjects.subject_id WHERE course_contents.course_id = %s  AND course_contents.content_enabled = 1 AND course_topics.topic_enabled = 1 AND course_chapters.chapter_enabled = 1 AND course_subjects.subject_enabled = 1 ORDER BY course_subjects.subject_sorting ASC, course_chapters.chapter_sorting ASC, course_topics.topic_sorting ASC, course_contents.content_sorting ASC", $colname_rsTopic);
$rsTopic = mysql_query($query_rsTopic, $conn) or die(mysql_error());
$row_rsTopic = mysql_fetch_assoc($rsTopic);
$totalRows_rsTopic = mysql_num_rows($rsTopic);

//SELECT course_topics.*, course_chapters.chapter_name, course_subjects.subject_name FROM course_topics INNER JOIN course_chapters ON course_topics.chapter_id = course_chapters.chapter_id INNER JOIN course_subjects ON course_topics.subject_id = course_subjects.subject_id WHERE course_topics.course_id = %s ORDER BY course_subjects.subject_sorting ASC, course_chapters.chapter_sorting ASC, course_topics.topic_sorting ASC

$return = array();

$return['subjects'] = array();
$return['chapters'] = array();

if ($totalRows_rsSubject > 0) {
	do {
		$return['subjects'][$row_rsSubject['subject_id']] = $row_rsSubject;
	} while ($row_rsSubject = mysql_fetch_assoc($rsSubject));
}


if ($totalRows_rsChapter > 0) {
	do {
		$return['chapters'][$row_rsChapter['chapter_id']] = $row_rsChapter;
	} while ($row_rsChapter = mysql_fetch_assoc($rsChapter));
}




$endtime = microtime(true);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/newSite.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_rsView['course_name']; ?></title>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
    
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 main">
  <h1 class="page-header"><?php echo $row_rsView['course_name']; ?></h1>

<?php
if ($totalRows_rsJoin > 0) { ?>
	<p>You are Member of This Course | <a href="study.php?course_id=<?php echo $_GET['course_id']; ?>"><strong>Study</strong></a> | <a href="leave.php?course_id=<?php echo $_GET['course_id']; ?>" onClick="a = confirm('do you really want to leave this group?'); return a;"><strong>Leave This Course</strong></a></p>
    
<?php } else { ?>
 <p> <a href="join.php?course_id=<?php echo $_GET['course_id']; ?>">Join This Course!!</a></p>
<?php } ?>



            <?php if ($totalRows_rsTopic > 0) { // Show if recordset not empty ?>
        <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><strong>Subject</strong></td>
                            <td><strong>Chapter</strong></td>
                            <td><strong>Topic</strong></td>
                            <td><strong>Content</strong></td>
                    </tr>
                    <?php do { ?>
                        <tr>
                            <td>
								
							<?php
								if (empty($tmp)) {
									$tmp = $row_rsTopic['subject_id'];
									echo $row_rsTopic['subject_name'];
								}							
								else if ($tmp !== $row_rsTopic['subject_id']) {
									$tmp = $row_rsTopic['subject_id'];
									echo $row_rsTopic['subject_name'];
								}
							?></td>
                            <td>
								
							<?php
								if (empty($tmp2)) {
									$tmp2 = $row_rsTopic['chapter_id'];
									echo $row_rsTopic['chapter_name'];
								}							
								else if ($tmp2 !== $row_rsTopic['chapter_id']) {
									$tmp2 = $row_rsTopic['chapter_id'];
									echo $row_rsTopic['chapter_name'];
								}
							?></td>
                            <td>
							
							<?php 
								if (empty($tmp3)) {
									$tmp3 = $row_rsTopic['topic_id'];
									echo $row_rsTopic['topic_name'];
								}							
								else if ($tmp3 !== $row_rsTopic['topic_id']) {
									$tmp3 = $row_rsTopic['topic_id'];
									echo $row_rsTopic['topic_name'];
								}
							?></td>
                            <td><?php echo $row_rsTopic['content_title']; ?></td>
                        </tr>
                        <?php } while ($row_rsTopic = mysql_fetch_assoc($rsTopic)); ?>
                    </table>
                </div><?php } // Show if recordset not empty ?>
        <hr />



<!--<?php echo "\n\nTime Taken:"; echo $duration = $endtime - $starttime; 

?> -->
</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsJoin);

mysql_free_result($rsSubject);

mysql_free_result($rsChapter);

mysql_free_result($rsTopic);
?>

