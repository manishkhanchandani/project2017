<?php require_once('../Connections/conn.php'); ?>
<?php

$starttime = microtime(true);
session_start();
include_once('init.php');
include_once('library/rss.php');
$currentPage = HTTP_PATH;

$myRss = new RSSParser("http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&q=massage&cf=all&output=rss"); 
$itemNum=0;
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles)) $myRss_RSSmax=count($myRss->titles);

$sql = '';
if (!empty($_GET['kw'])) {
	$_GET['kw'] = trim($_GET['kw']);
	$sql .= sprintf(" AND (title like %s OR description like %s OR description2 like %s OR sub_topic like %s)", GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'));
}


$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM calbabybar_nodes WHERE current_status = 1 AND deleted = 0 AND status = 1 $sql ORDER BY id DESC";
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

$endtime = microtime(true);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/newSite.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>California Bar</title>
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
<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
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
    
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 main">
  <h1 class="page-header">Dashboard</h1>

  <!--<div class="row placeholders">
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
      <h4>Label</h4>
      <span class="text-muted">Something else</span>
    </div>
  </div> -->

  <h3 class="sub-header">Latest Entries </h3><?php //echo $query_rsView; ?>
      <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
          <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Sub Topic </th>
                          <th>Year</th>
                          <th>Subject</th>
                          <th>Created On </th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php do { ?>
                          <tr>
                              <td><a href="<?php echo HTTP_PATH; ?><?php echo $row_rsView['node_type']; ?>/<?php echo $barSubjects[$row_rsView['subject_id']]['url']; ?>/<?php echo $row_rsView['subject_id']; ?>/detail/<?php echo $row_rsView['id']; ?>"><strong>ID: <?php echo $row_rsView['id']; ?></strong></a></td>
                              <td><a href="<?php echo HTTP_PATH; ?><?php echo $row_rsView['node_type']; ?>/<?php echo $barSubjects[$row_rsView['subject_id']]['url']; ?>/<?php echo $row_rsView['subject_id']; ?>"><?php echo $row_rsView['title']; ?></a></td>
                              <td><?php echo $row_rsView['sub_topic']; ?></td>
                              <td><?php echo $row_rsView['subject_id']; ?></td>
                              <td><?php echo $row_rsView['node_type']; ?> / <a href="<?php echo HTTP_PATH; ?><?php echo $row_rsView['node_type']; ?>/<?php echo $row_rsView['subject_id']; ?>/<?php echo $row_rsView['subject_id']; ?>"><?php echo $row_rsView['subject_id']; ?></a></td>
                              <td><?php echo timeAgo($row_rsView['topic_created']); ?></td>
                          </tr>
                          <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
                  </tbody>
              </table>
          </div>
          <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
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
          <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
      <p>No Record Found.</p>
              <?php } // Show if recordset empty ?>
 
<hr />
	<h3 class="sub-header">Aim of This Website!! </h3>
	<div>
	    <p>User Generated Contents for California Bar Course. All the contents are inserted by the users. A social networking framework for LAW STUDENTS.</p>
	    <p>You can resubmit the data on any topic as every student has different views and let readers should read everybody's view on every topic. For example: Assault can be resubmitted by many students to let others know the idea of assault. </p>
	    </div>
<hr />
<?php if ($myRss_RSSmax > 0) { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">California Law News</h3>
					</div>
					<div class="panel-body">
						<ul>
							<?php
								for($itemNum=1;$itemNum<$myRss_RSSmax;$itemNum++){
							?>
								<li><a href="<?php echo $myRss->links[$itemNum]; ?>" target="_blank"><?php echo $myRss->titles[$itemNum]; ?></a><br>
									<small><?php echo $desc = $myRss->descriptions[$itemNum];  /*echo strip_tags($desc, '<b><strong><br>');if (isset($_GET['t'])) { echo htmlentities($myRss->descriptions[$itemNum]); }*/?></small>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
      <?php } ?>
<!--<?php echo $query_rsView; echo "\n\nTime Taken:"; echo $duration = $endtime - $starttime; 

?> -->
  <p>&nbsp;</p>
</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
