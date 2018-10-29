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

$MM_restrictGoTo = "users/login.php";
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
include_once('init.php');
?>
<?php
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


$maxRows_rsContent = 1;
$pageNum_rsContent = 0;
if (isset($_GET['pageNum_rsContent'])) {
  $pageNum_rsContent = $_GET['pageNum_rsContent'];
}
$startRow_rsContent = $pageNum_rsContent * $maxRows_rsContent;

$colname_rsContent = "-1";
if (isset($_GET['course_id'])) {
  $colname_rsContent = (get_magic_quotes_gpc()) ? $_GET['course_id'] : addslashes($_GET['course_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsContent = sprintf("SELECT course_contents.*, course_topics.topic_name, course_chapters.chapter_name, course_subjects.subject_name FROM course_contents INNER JOIN course_topics ON course_contents.topic_id = course_topics.topic_id INNER JOIN course_chapters ON course_contents.chapter_id = course_chapters.chapter_id INNER JOIN course_subjects ON course_contents.subject_id = course_subjects.subject_id WHERE course_contents.course_id = %s ORDER BY course_subjects.subject_sorting ASC, course_chapters.chapter_sorting ASC, course_topics.topic_sorting ASC, course_contents.content_sorting ASC", $colname_rsContent);
$query_limit_rsContent = sprintf("%s LIMIT %d, %d", $query_rsContent, $startRow_rsContent, $maxRows_rsContent);
$rsContent = mysql_query($query_limit_rsContent, $conn) or die(mysql_error());
$row_rsContent = mysql_fetch_assoc($rsContent);

if (isset($_GET['totalRows_rsContent'])) {
  $totalRows_rsContent = $_GET['totalRows_rsContent'];
} else {
  $all_rsContent = mysql_query($query_rsContent);
  $totalRows_rsContent = mysql_num_rows($all_rsContent);
}
$totalPages_rsContent = ceil($totalRows_rsContent/$maxRows_rsContent)-1;

$queryString_rsContent = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsContent") == false && 
        stristr($param, "totalRows_rsContent") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsContent = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsContent = sprintf("&totalRows_rsContent=%d%s", $totalRows_rsContent, $queryString_rsContent);


function processRecs($content_type, $content_subtype, $record) {
	$return = array('left' => '', 'right' => '');
	ob_start();
	include(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.$content_type.'_'.$content_subtype.'_left.php');
	$return['left'] = ob_get_clean();
	ob_start();
	include(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.$content_type.'_'.$content_subtype.'_right.php');
	$return['right'] = ob_get_clean();
	
	return $return;
}

?><!doctype html>
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Study</title>
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
	<div class="col-sm-3 col-md-2 sidebar">
		<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'nav_side.php'); ?>
	</div>
	
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h1 class="page-header"><?php echo $row_rsView['course_name']; ?></h1>
		<p class="page-header"><a href="study.php?course_id=<?php echo $_GET['course_id']; ?>">Refresh This Course</a> | <a href="study.php?course_id=<?php echo $_GET['course_id']; ?>&pageNum_rsContent=<?php echo $pageNum_rsContent; ?>">Refresh This Page</a> | <a href="details.php?course_id=<?php echo $_GET['course_id']; ?>">Back to Course Overview</a> | <a href="index.php">Back to Home Page </a></p>
		<?php if ($totalRows_rsContent > 0) { // Show if recordset not empty ?>
        <?php do { ?>
		<?php
		$return = processRecs($row_rsContent['content_type'], $row_rsContent['content_subtype'], $row_rsContent);
		?>
			<h3 class="page-header"><?php echo $row_rsContent['topic_name']; ?> / <?php echo $row_rsContent['content_title']; ?> (<small>Subject &quot;<strong><?php echo $row_rsContent['subject_name']; ?></strong>&quot; and Chapter &quot;<strong><?php echo $row_rsContent['chapter_name']; ?></strong>&quot;</small>)</h3>
			<div class="row">
				<div class="col-md-6">
					<?php echo $return['left']; ?>
				</div>
				<div class="col-md-6">
					<?php echo $return['right']; ?>
				</div>
			</div>
			
		<?php } while ($row_rsContent = mysql_fetch_assoc($rsContent)); ?>

<hr />
<p>	
		
Records <?php echo ($startRow_rsContent + 1) ?> to <?php echo min($startRow_rsContent + $maxRows_rsContent, $totalRows_rsContent) ?> of <?php echo $totalRows_rsContent ?></p>		
        <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsContent > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsContent=%d%s", $currentPage, 0, $queryString_rsContent); ?>">First</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center"><?php if ($pageNum_rsContent > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsContent=%d%s", $currentPage, max(0, $pageNum_rsContent - 1), $queryString_rsContent); ?>">Previous</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsContent < $totalPages_rsContent) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsContent=%d%s", $currentPage, min($totalPages_rsContent, $pageNum_rsContent + 1), $queryString_rsContent); ?>">Next</a>
                        <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsContent < $totalPages_rsContent) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsContent=%d%s", $currentPage, $totalPages_rsContent, $queryString_rsContent); ?>">Last</a>
                        <?php } // Show if not last page ?>                </td>
            </tr>
        </table>

        <?php if ($totalRows_rsContent == 0) { // Show if recordset empty ?>
                <p>No Record Found.                </p>
                <?php } // Show if recordset empty ?>

        <?php } // Show if recordset not empty ?>
	</div>

</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsJoin);

mysql_free_result($rsContent);
?>
