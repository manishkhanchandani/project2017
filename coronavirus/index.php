<?php require_once('../Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsDistinct = 1;
$pageNum_rsDistinct = 0;
if (isset($_GET['pageNum_rsDistinct'])) {
  $pageNum_rsDistinct = $_GET['pageNum_rsDistinct'];
}
$startRow_rsDistinct = $pageNum_rsDistinct * $maxRows_rsDistinct;

mysql_select_db($database_conn, $conn);
$query_rsDistinct = "SELECT Distinct(created) as created FROM coronatime ORDER BY created DESC";
$query_limit_rsDistinct = sprintf("%s LIMIT %d, %d", $query_rsDistinct, $startRow_rsDistinct, $maxRows_rsDistinct);
$rsDistinct = mysql_query($query_limit_rsDistinct, $conn) or die(mysql_error());
$row_rsDistinct = mysql_fetch_assoc($rsDistinct);

if (isset($_GET['totalRows_rsDistinct'])) {
  $totalRows_rsDistinct = $_GET['totalRows_rsDistinct'];
} else {
  $all_rsDistinct = mysql_query($query_rsDistinct);
  $totalRows_rsDistinct = mysql_num_rows($all_rsDistinct);
}
$totalPages_rsDistinct = ceil($totalRows_rsDistinct/$maxRows_rsDistinct)-1;

$colname_rsList = "-1";
if (isset($row_rsDistinct['created'])) {
  $colname_rsList = $row_rsDistinct['created'];
}
mysql_select_db($database_conn, $conn);
$query_rsList = sprintf("SELECT * FROM coronatime WHERE created = %s ORDER BY sorting ASC", GetSQLValueString($colname_rsList, "date"));
$rsList = mysql_query($query_rsList, $conn) or die(mysql_error());
$row_rsList = mysql_fetch_assoc($rsList);
$totalRows_rsList = mysql_num_rows($rsList);

$queryString_rsDistinct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsDistinct") == false && 
        stristr($param, "totalRows_rsDistinct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsDistinct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsDistinct = sprintf("&totalRows_rsDistinct=%d%s", $totalRows_rsDistinct, $queryString_rsDistinct);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CoronaVirus Time</title>
<script src="./jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style type="text/css">
th {
  background: white;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
</style>

<meta property="og:title" content="CoronaVirus Time" /> 
<meta property="og:description" content="coronavirus statistics" /> 
<meta property="og:image" og:image:width="720" og:image:height="405" content="http://corona.mkgalaxy.com/images/corona1.jpg" />
<meta property="og:type" content="information"/>
<meta property="og:url" content="http://corona.mkgalaxy.com/" />
<meta property="og:site_name" content="CoronaVirus" />   
<meta name="title" content="CoronaVirus Time" />
<meta name="description" content="coronavirus statistics" />
<link rel="image_src" href="http://corona.mkgalaxy.com/images/corona1.jpg" />
<meta name="keywords" content="caronavirus, carona, virus, covid19">
<meta name="robots" content="noarchive">
</head>

<body>
<div class="container">
<h1>CoronaVirus Cases</h1>
  <?php do { ?>
      <p><strong>Date</strong> <?php echo $row_rsDistinct['created']; ?></p>
    <?php } while ($row_rsDistinct = mysql_fetch_assoc($rsDistinct)); ?>
<table width="50%" border="0" cellpadding="5" cellspacing="1">
  <tr>
    <td><?php if ($pageNum_rsDistinct > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsDistinct=%d%s", $currentPage, 0, $queryString_rsDistinct); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rsDistinct > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsDistinct=%d%s", $currentPage, max(0, $pageNum_rsDistinct - 1), $queryString_rsDistinct); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rsDistinct < $totalPages_rsDistinct) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsDistinct=%d%s", $currentPage, min($totalPages_rsDistinct, $pageNum_rsDistinct + 1), $queryString_rsDistinct); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rsDistinct < $totalPages_rsDistinct) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsDistinct=%d%s", $currentPage, $totalPages_rsDistinct, $queryString_rsDistinct); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>

<p>&nbsp;</p>
<table class="table table-striped table-dark">
  <thead class="thead-light">
  <tr>
    <th><strong>Country</strong></th>
    <th><strong>Total Cases</strong></th>
    <th><strong>New Cases</strong></th>
    <th><strong>Total Death</strong></th>
    <th><strong>New Death</strong></th>
    <th><strong>Total Recoverd</strong></th>
    <th><strong>Active Cases</strong></th>
    <th><strong>Serios Critical</strong></th>
    <th><strong>Totalcases 1m pop</strong></th>
    <th><strong>Total Death 1m pop</strong></th>
  </tr></thead>
  <tbody id="coronabody">
  	  <?php do { ?>
  	<tr>
  	    <td><?php echo $row_rsList['country']; ?></td><td><?php echo $row_rsList['total_cases']; ?></td><td <?php if ( $row_rsList['new_cases']) { ?>style="font-weight: bold; text-align:right;background-color:#FFEEAA;color:black;"<?php } ?>><?php if ( $row_rsList['new_cases']) { ?>+<?php echo $row_rsList['new_cases']; ?><?php } ?>&nbsp;</td><td><?php echo $row_rsList['total_deaths']; ?></td><td <?php if ( $row_rsList['new_deaths']) { ?>style="font-weight: bold; text-align:right;background-color:red; color:white"<?php } ?>><?php if ( $row_rsList['new_deaths']) { ?>+<?php echo $row_rsList['new_deaths']; ?><?php } ?>&nbsp;</td><td><?php echo $row_rsList['total_recovered']; ?></td><td><?php echo $row_rsList['active_cases']; ?></td><td><?php echo $row_rsList['serious_critical']; ?></td><td><?php echo $row_rsList['totalcases_1mpop']; ?></td><td><?php echo $row_rsList['totaldeaths_1mpop']; ?></td>
    </tr>
  	    <?php } while ($row_rsList = mysql_fetch_assoc($rsList)); ?>
  </tbody>
  
</table>
</div>
</body>
</html>
<?php
mysql_free_result($rsDistinct);

mysql_free_result($rsList);
?>
