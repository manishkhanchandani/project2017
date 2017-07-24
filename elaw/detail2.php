<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsDetail = "-1";
if (isset($_GET['id'])) {
  $colname_rsDetail = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($conn, $database_conn);
$query_rsDetail = sprintf("SELECT * FROM definitions WHERE id = %s", $colname_rsDetail);
$rsDetail = mysqli_query($conn, $query_rsDetail) or die(mysqli_error());
$row_rsDetail = mysqli_fetch_assoc($rsDetail);
$totalRows_rsDetail = mysqli_num_rows($rsDetail);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/elaw.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_rsDetail['title']; ?> (<?php echo $row_rsDetail['subject']; ?>)</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
            <span class="icon-bar"></span>          </button>
          <a class="navbar-brand" href="../Templates/index.php">Law</a>        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="container">
	<h1><?php echo $row_rsDetail['title']; ?> (<?php echo $row_rsDetail['subject']; ?>) </h1>
	<p><a href="definitions.php?id=<?php echo $row_rsDetail['id']; ?>&subject=<?php echo $row_rsDetail['subject']; ?>&parent_id=<?php echo $row_rsDetail['parent_id']; ?>#edit">Edit</a> | <a href="definitions.php?parent_id=<?php echo $row_rsDetail['id']; ?>&subject=<?php echo $row_rsDetail['subject']; ?>">Create Child</a> | <a href="definitions.php?subject=<?php echo $row_rsDetail['subject']; ?>&parent_id=<?php echo $row_rsDetail['parent_id']; ?>">Back To Definitions</a> </p>
	<?php if (!empty($row_rsDetail['definition'])) { ?>
	<p><strong>Definition</strong><br />
    <?php echo nl2br($row_rsDetail['definition']); ?></p>
	<?php } ?>
	<?php if (!empty($row_rsDetail['example'])) { ?>
	<p><strong>Examples</strong><br />
    <?php echo $row_rsDetail['example']; ?></p>
	<?php } ?>
	<?php if (!empty($row_rsDetail['exception'])) { ?>
	<p><strong>Exception</strong><br />
    <?php echo $row_rsDetail['exception']; ?></p>
	<?php } ?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</div>
<!-- InstanceEndEditable -->
</body><!-- InstanceEnd --></html>
<?php
mysqli_free_result($rsDetail);
?>
