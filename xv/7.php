<?php require_once('../Connections/connXV.php'); ?>
<?php
$colname_rsDetail = "-1";
if (isset($_GET['id'])) {
  $colname_rsDetail = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connXV, $connXV);
$query_rsDetail = sprintf("SELECT * FROM videos3 WHERE id = %s", $colname_rsDetail);
$rsDetail = mysql_query($query_rsDetail, $connXV) or die(mysql_error());
$row_rsDetail = mysql_fetch_assoc($rsDetail);
$totalRows_rsDetail = mysql_num_rows($rsDetail);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Detail</h1>
<p><?php echo $row_rsDetail['id']; ?></p>
<p><?php echo $row_rsDetail['tags']; ?></p>
<p><?php echo $row_rsDetail['category']; ?></p>
<p><img src="<?php echo $row_rsDetail['thumbnail']; ?>" /></p>
<p><a href="<?php echo $row_rsDetail['url']; ?>" target="_blank"><?php echo $row_rsDetail['url']; ?></a></p>
<p><?php echo $row_rsDetail['title']; ?></p>
<p><?php echo $row_rsDetail['duration']; ?></p>
<p><?php echo $row_rsDetail['embedlink']; ?></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsDetail);
?>
