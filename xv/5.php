<?php require_once('../Connections/connXV.php'); ?>
<?php
$_GET['totalRows_rsView'] = 7377311;


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "%s";
if (isset($_GET['tags'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['tags'] : addslashes($_GET['tags']);
}
mysql_select_db($database_connXV, $connXV);
$query_rsView = sprintf("SELECT * FROM videos3 WHERE tags LIKE '%%%s%%'", $colname_rsView);
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $connXV) or die(mysql_error());
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
    <p>Videos</p>
    <?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
        <p>No record found</p>
        <?php } // Show if recordset empty ?>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>id</td>
            <td>url</td>
            <td>title</td>
            <td>embedlink</td>
            <td>duration</td>
            <td>thumbnail</td>
            <td>tags</td>
            <td>category</td>
        </tr>
        <?php do { ?>
            <tr>
                <td><?php echo $row_rsView['id']; ?></td>
                <td><?php echo $row_rsView['url']; ?></td>
                <td><?php echo $row_rsView['title']; ?></td>
                <td><?php echo $row_rsView['embedlink']; ?></td>
                <td><?php echo $row_rsView['duration']; ?></td>
                <td><?php echo $row_rsView['thumbnail']; ?></td>
                <td><?php echo $row_rsView['tags']; ?></td>
                <td><?php echo $row_rsView['category']; ?></td>
            </tr>
            <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
            </table>

    <table border="0" width="50%" align="center">
        <tr>
            <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                    <?php } // Show if not first page ?>            </td>
            <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                    <?php } // Show if not first page ?>            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                    <?php } // Show if not last page ?>            </td>
        </tr>
            </table>

    <?php } // Show if recordset not empty ?>

</body>
</html>
<?php
mysql_free_result($rsView);
?>
