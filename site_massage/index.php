<?php require_once('../Connections/conn.php'); ?>
<?php

$starttime = microtime(true);
session_start();
include_once('init.php');
include_once('library/rss.php');
$currentPage = HTTP_PATH;

$myRss = new RSSParser("http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&q=california+massage&cf=all&output=rss"); 
$itemNum=0;
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles)) $myRss_RSSmax=count($myRss->titles);

$sql = '';
if (!empty($_GET['kw'])) {
	$_GET['kw'] = trim($_GET['kw']);
	$sql .= sprintf(" AND (title like %s OR description like %s OR description2 like %s OR sub_topic like %s)", GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'), GetSQLValueString('%%'.$_GET['kw'].'%%', 'text'));
}


$endtime = microtime(true);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/ineedmassage.dwt.php" codeOutsideHTMLIsLocked="false" -->
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

	<h3 class="sub-header">Aim of This Website!! </h3>
	<div>
	   coming soon...
	    </div>
<hr />
<?php if ($myRss_RSSmax > 0) { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">California Massage News</h3>
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
