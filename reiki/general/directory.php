<?php require_once('../../Connections/conn.php'); ?>
<?php
session_start();

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 25;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM reiki_practitioners WHERE status = 1 ORDER BY name ASC";
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

ob_start();
include('search.php');
$xtraText = ob_get_clean();
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Directory</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/firebase_4_1_5.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Practitioner's Directory</h1>
  <div>      
                <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
                    <div class="table-responsive">
  						<table class="table">
                            <tr>
                                <td valign="top"><strong>Name</strong></td>
                                <td valign="top"><strong>Gender</strong></td>
                                <td valign="top"><strong>Highest Reiki Level </strong></td>
                                <td valign="top"><strong>Details</strong></td>
                                <td valign="top"><strong>Description</strong></td>
                            </tr>
                            <?php do { ?>
                                  <tr>
                                      <td valign="top"><?php echo $row_rsView['name']; ?></td>
                                      <td valign="top"><?php echo $row_rsView['gender']; ?></td>
                                      <td valign="top"><?php echo $row_rsView['highest_level']; ?></td>
                                      <td valign="top"><strong>Do you practice Distance Healing:</strong> <?php echo $row_rsView['distance_healing']; ?><br>
                                          <strong>Do you practice Distance Attunement: </strong><?php echo $row_rsView['distance_attunement']; ?><br>
                                      <strong>Do you teach Reiki:</strong> <?php echo $row_rsView['teach_reiki']; ?><br>
                                      <strong>Do you do Reiki treatment:</strong> <?php echo $row_rsView['treatment_reiki']; ?></td>
                                      <td valign="top"><?php echo $row_rsView['description']; ?></td>
                                  </tr>
                                  <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
                        </table>
                    </div>
                    <p> <strong>Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></strong> </p>
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


  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
