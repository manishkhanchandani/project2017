<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$id = $_GET['id'];
$subjectUrl = $_GET['subjectUrl'];
$node_type = $_GET['node_type'];
$reference = $nodeTypes[$node_type];
$mainUrl = HTTP_PATH.$node_type.'/'.$subjectUrl.'/'.$id;
$subject = $barSubjects[$_GET['id']]['subject'];

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
$currentPage = $mainUrl;

$sql = '';
$order = 'id DESC';
$sorttype = !empty($_GET['sorttype']) ? $_GET['sorttype'] : 'ASC';
if (!empty($_GET['my']) && !empty($_SESSION['MM_UserId'])) {
	$sql .= sprintf(" AND user_id=%s", $_SESSION['MM_UserId']);
}


if (!empty($_GET['sort'])) {
	$sort = ($_GET['sort'] == 2) ? 'title' : 'topic_created';
	$order = $sort.' '.$sorttype;
}

if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND current_status = 1";
} else {
	$sql .= sprintf(" AND (current_status = 1 OR (current_status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}

if (!empty($_GET['keyword'])) {
	$sql .= sprintf(" AND (title like %s OR description like %s OR description2 like %s OR sub_topic like %s)", GetSQLValueString('%%'.$_GET['keyword'].'%%', 'text'), GetSQLValueString('%%'.$_GET['keyword'].'%%', 'text'), GetSQLValueString('%%'.$_GET['keyword'].'%%', 'text'), GetSQLValueString('%%'.$_GET['keyword'].'%%', 'text'));
}

$maxRows_rsView = 25;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "-1";
if (isset($_GET['id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' AND deleted = 0 $sql ORDER BY $order", $colname_rsView, $node_type);
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
        stristr($param, "totalRows_rsView") == false && 
        stristr($param, "subjectUrl") == false && 
        stristr($param, "id") == false && 
        stristr($param, "node_type") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);

$endtime = microtime(true);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $reference; ?></title>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
    <div class="col-sm-12 col-xs-12 col-md-2">
<div><a href="<?php echo $mainUrl; ?>/create">Create New <?php echo $reference; ?></a><hr />

<?php include('../common/search.php'); ?>
<hr />
</div>
      <?php include('../nav_side.php'); ?>
    </div><!-- ending col -->
    
<div class="col-sm-12 col-xs-12 col-md-10 main">
  <h1 class="page-header"><?php echo $subject; ?> <?php echo $reference; ?></h1>

  <div><?php //echo $query_rsView; ?>
		<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
		    <div>
											<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
											<strong><?php echo $reference; ?></strong>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
											<strong>Description</strong>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hideMobile">
											<strong>ID</strong>
											</div>
											<br />
											<hr />
                      <?php do { ?>
<?php
$images = json_decode($row_rsView['view_images'], true);
$videos = json_decode($row_rsView['view_videos'], true); 
$links = json_decode($row_rsView['view_links'], true);
$node_id = $row_rsView['id'];
?>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
											<p><a href="<?php echo HTTP_PATH; ?><?php echo $row_rsView['node_type']; ?>/<?php echo $barSubjects[$row_rsView['subject_id']]['url']; ?>/<?php echo $row_rsView['subject_id']; ?>/detail/<?php echo $row_rsView['id']; ?>"><strong><?php echo $row_rsView['title']; ?></strong></a></p>                                        <p><?php if (!empty($_SESSION['MM_UserId']) && $_SESSION['MM_UserId'] === $row_rsView['user_id']) { ?><a href="<?php echo $mainUrl; ?>/edit/<?php echo $row_rsView['id']; ?>"><img src="<?php echo HTTP_PATH; ?>images/edit16.png" /></a> <a href="<?php echo $mainUrl; ?>/delete/<?php echo $row_rsView['id']; ?>" onClick="var a = confirm('do you really want to delete this record?'); return a;"><img src="<?php echo HTTP_PATH; ?>images/delete16.png" /></a><?php } ?>
                                            <?php //echo $row_rsView['topic_created']; ?>
                                    </p>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
											<?php echo $row_rsView['description']; 
								  	//echo substr(strip_tags($row_rsView['description']), 0, 255); 
								  	//if (strlen($row_rsView['description']) > 255) echo '....';
								   ?>
                                        <?php 
										/*$d2 = trim(strip_tags($row_rsView['description2']));
										if (!empty($d2)) { ?>
                                        <hr />
                                        <p><strong>Analysis / Description 2</strong></p>
                                    	<div><?php echo $row_rsView['description2']; ?></div>                                      
										<?php } */ ?>
										
										<?php //include('../common/media.php'); ?>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hideMobile">
											<?php echo $row_rsView['id']; ?>
											</div>
										</div>
										<hr />
                              <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
		        </div>
		    <p>Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?> </p>
		    <table border="0" width="50%" align="center">
                        <tr>
                          <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                                    <?php } // Show if not first page ?>                                        </td>
                            <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                                    <?php } // Show if not first page ?>                                        </td>
                            <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                                    <?php } // Show if not last page ?>                                        </td>
                            <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                                    <?php } // Show if not last page ?>                                        </td>
                        </tr>
                          </table>
		    <?php } // Show if recordset not empty ?>
		<?php if ($totalRows_rsView === 0) { // Show if recordset not empty ?>
          <p>No Record Found. </p>
          <?php } // Show if recordset not empty ?><p>&nbsp;</p>
  </div>
</div><!-- ending col -->
<!--<?php echo $query_rsView; echo "\n\nTime Taken:"; echo $duration = $endtime - $starttime; 

?> -->
  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
