<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$id = $_GET['id'];
$subjectUrl = $_GET['subjectUrl'];
$node_type = $_GET['node_type'];
$detail_id = $_GET['detail_id'];
$reference = $nodeTypes[$node_type]['name'];
$mainUrl = HTTP_PATH.$node_type.'/'.$subjectUrl.'/'.$id;
$subject = $barSubjects[$_GET['id']]['subject'];
$detailUrl = HTTP_PATH.$node_type.'/'.$subjectUrl.'/'.$id.'/detail/'.$detail_id;

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

$MM_restrictGoTo = HTTP_PATH."users/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['REQUEST_URI'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
$starttime = microtime(true);
$currentPage = $_SERVER["PHP_SELF"];

$sql = '';

if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND status = 1";
} else {
	$sql .= sprintf(" AND (status = 1 OR (status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}

if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND current_status = 1";
} else {
	$sql .= sprintf(" AND (current_status = 1 OR (current_status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}


$colname_rsView = "-1";
if (isset($_GET['id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
$colid_rsView = "-1";
if (isset($_GET['detail_id'])) {
  $colid_rsView = (get_magic_quotes_gpc()) ? $_GET['detail_id'] : addslashes($_GET['detail_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' AND deleted = 0 AND id=%s $sql", $colname_rsView, $node_type, $colid_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsMyRef = "-1";
if (isset($_GET['detail_id'])) {
  $colname_rsMyRef = (get_magic_quotes_gpc()) ? $_GET['detail_id'] : addslashes($_GET['detail_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsMyRef = sprintf("SELECT b.* FROM calbabybar_ref as a LEFT JOIN calbabybar_nodes as b ON a.ref_id = b.id WHERE a.id = %s", $colname_rsMyRef);
$rsMyRef = mysql_query($query_rsMyRef, $conn) or die(mysql_error());
$row_rsMyRef = mysql_fetch_assoc($rsMyRef);
$totalRows_rsMyRef = mysql_num_rows($rsMyRef);

$colname_rsIamRelated = "-1";
if (isset($_GET['detail_id'])) {
  $colname_rsIamRelated = (get_magic_quotes_gpc()) ? $_GET['detail_id'] : addslashes($_GET['detail_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsIamRelated = sprintf("SELECT b.*  FROM calbabybar_ref as a LEFT JOIN calbabybar_nodes as b ON a.id = b.id WHERE a.ref_id = %s", $colname_rsIamRelated);
$rsIamRelated = mysql_query($query_rsIamRelated, $conn) or die(mysql_error());
$row_rsIamRelated = mysql_fetch_assoc($rsIamRelated);
$totalRows_rsIamRelated = mysql_num_rows($rsIamRelated);


$endtime = microtime(true);


?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $reference; ?> : <?php echo $row_rsView['title']; ?></title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<meta name="description" content="<?php echo strip_tags($row_rsView['description']); ?>" />
<meta name="keywords" content="<?php echo $reference; ?>,<?php echo $row_rsView['title']; ?>" />

<meta name="author" content="" />
<meta name="copyright" content="CalBabyBar.com" />
<meta name="application-name" content="Cal Baby Bar" />
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
	<div class="row">
		<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
			<div><a href="<?php echo $mainUrl; ?>">Back to Subject Page</a> | <a href="<?php echo HTTP_PATH; ?>">Back to Home Page</a></div>
		</div>
		<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
			<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 ">
  				<h3 class="page-header"><?php echo $row_rsView['title']; ?></h3>
				<div><small>(<?php echo $subject; ?> <?php echo $reference; ?>) <?php if (!empty($_SESSION['MM_UserId']) && $_SESSION['MM_UserId'] === $row_rsView['user_id']) { ?><a href="<?php echo $mainUrl; ?>/edit/<?php echo $row_rsView['id']; ?>"><img src="<?php echo HTTP_PATH; ?>images/edit16.png" /></a> <a href="<?php echo $mainUrl; ?>/delete/<?php echo $row_rsView['id']; ?>" onClick="var a = confirm('do you really want to delete this record?'); return a;"><img src="<?php echo HTTP_PATH; ?>images/delete16.png" /></a><?php } ?><br /><br /></small><hr /></div>
				<div><?php echo $row_rsView['description']; ?></div>
				<div>
					<?php 
					$d2 = trim(strip_tags($row_rsView['description2']));
					if (!empty($d2)) { ?>
						<hr />
						<p><strong>More Explanation</strong></p>
						<div><?php echo $row_rsView['description2']; ?><hr /></div>                                      
					<?php } ?>
				</div>	
				<?php
					$images = json_decode($row_rsView['view_images'], true);
					$videos = json_decode($row_rsView['view_videos'], true); 
					$links = json_decode($row_rsView['view_links'], true);
					$node_id = $row_rsView['id'];
					include('../common/media.php');
				?>
			</div><!-- ending col -->
			
			<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 ">
				<?php 
					if ($node_type === 'essays') { 
						include(ROOT_DIR.'/common/essay_issues.php');
					}
				?>				
			</div><!-- ending col -->
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12"><small><hr /><strong>ID:</strong> <?php echo $row_rsView['id']; ?> (<strong><?php echo timeAgo($row_rsView['topic_created']); ?></strong>)</small></div>
		<?php } // Show if recordset not empty ?>
		<?php if ($totalRows_rsView === 0) { // Show if recordset not empty ?>
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
				<h1>No Record Found. </h1>
			</div>
		<?php } // Show if recordset not empty ?>
	</div>



























<?php /*if ($totalRows_rsMyRef > 0) { // Show if recordset not empty ?>

<hr />
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Current Article needs following knowledge</h3>
	</div>
	<div class="panel-body">
<?php do { ?>
		
		
		
		
		
	<div class="page-header"><strong><?php echo $row_rsMyRef['title']; ?></strong></div>
  <div><small><a href="<?php echo HTTP_PATH.$row_rsMyRef['node_type'].'/'.$barSubjects[$row_rsMyRef['subject_id']]['url'].'/'.$row_rsMyRef['subject_id']; ?>/detail/<?php echo $row_rsMyRef['id']; ?>">Detail</a><br /></small>
  <hr /></div>
  
  <div><?php echo $row_rsMyRef['description']; ?></div>
  
  <div><?php 
	$d2 = trim(strip_tags($row_rsMyRef['description2']));
	if (!empty($d2)) { ?>
	<hr />
	<p><strong>More Explanation</strong></p>
	<div><?php echo $row_rsMyRef['description2']; ?><hr /></div>                                      
	<?php } ?></div>
	
	<div>
<?php
$images = json_decode($row_rsMyRef['view_images'], true);
$videos = json_decode($row_rsMyRef['view_videos'], true); 
$links = json_decode($row_rsMyRef['view_links'], true);
$node_id = $row_rsMyRef['id'];
?>
		<?php include('../common/media.php'); ?>
	</div>

	<div><small><hr /><strong>ID:</strong> <?php echo $row_rsMyRef['id']; ?> (<strong><?php echo timeAgo($row_rsMyRef['topic_created']); ?></strong>)</small></div>	
		
		
		
		
		
		
		
		
		
		

<?php } while ($row_rsMyRef = mysql_fetch_assoc($rsMyRef)); ?>

	</div>
</div>
<?php } // Show if recordset not empty */ ?>







<?php /*if ($totalRows_rsIamRelated > 0) { // Show if recordset not empty ?>

<hr />
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Following articles need above knowledge</h3>
	</div>
	<div class="panel-body">
<?php do { ?>

<div class="page-header"><strong><?php echo $row_rsIamRelated['title']; ?></strong></div>
  <div><small><a href="<?php echo HTTP_PATH.$row_rsIamRelated['node_type'].'/'.$barSubjects[$row_rsIamRelated['subject_id']]['url'].'/'.$row_rsIamRelated['subject_id']; ?>/detail/<?php echo $row_rsIamRelated['id']; ?>">Detail</a><br /></small>
  <hr /></div>
  
  <div><?php echo $row_rsIamRelated['description']; ?></div>
  
  <div><?php 
	$d2 = trim(strip_tags($row_rsIamRelated['description2']));
	if (!empty($d2)) { ?>
	<hr />
	<p><strong>More Explanation</strong></p>
	<div><?php echo $row_rsIamRelated['description2']; ?><hr /></div>                                      
	<?php } ?></div>
	
	<div>
<?php
$images = json_decode($row_rsIamRelated['view_images'], true);
$videos = json_decode($row_rsIamRelated['view_videos'], true); 
$links = json_decode($row_rsIamRelated['view_links'], true);
$node_id = $row_rsIamRelated['id'];
?>
		<?php include('../common/media.php'); ?>
	</div>

	<div><small><hr /><strong>ID:</strong> <?php echo $row_rsIamRelated['id']; ?> (<strong><?php echo timeAgo($row_rsIamRelated['topic_created']); ?></strong>)</small></div>
<?php } while ($row_rsIamRelated = mysql_fetch_assoc($rsIamRelated)); ?>

	</div>
</div>

<?php } // Show if recordset not empty */?>










<!--<?php echo $query_rsView; echo "\n\nTime Taken:"; echo $duration = $endtime - $starttime; 

?> -->

<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsMyRef);

mysql_free_result($rsIamRelated);
?>
