<?php
session_start();
include('init.php');
include_once('library/rss.php');

$myRss = new RSSParser("http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&q=Reiki&cf=all&output=rss"); 
$itemNum=0;
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles)) $myRss_RSSmax=count($myRss->titles);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/dashboard.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="js/firebase/5.2.0/firebase-auth.js"></script>
<script src="js/firebase/5.2.0/firebase-database.js"></script>

<link href="library/wysiwyg/summernote.css" rel="stylesheet">
<script src="library/wysiwyg/summernote.js"></script>
<?php include('head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Dashboard</h1>

  <div>
  		<p>Reiki is a gentle and deeply relaxing hands-on healing technique.</p>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Links</h3>
					</div>
					<div class="panel-body">
					
     			 		<p><a href="general/directory.php">Directory</a> <br /><br /><a href="general/practitioner.php">Add New Practitioner</a> </p>
					</div>
				</div>

			
			</div>
			
			
			
			<div class="col-md-6">



  	<?php if ($myRss_RSSmax > 0) { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Reiki News</h3>
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





			</div>
			
			
			
		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
