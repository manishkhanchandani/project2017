<?php
include_once('../Connections/conn.php');
mysql_select_db($database_conn, $conn);
$query_rsWhosonline = "SELECT * FROM mk_users WHERE logged_in = 1 ORDER BY name ASC";
$rsWhosonline = mysql_query($query_rsWhosonline, $conn) or die(mysql_error());
$row_rsWhosonline = mysql_fetch_assoc($rsWhosonline);
$totalRows_rsWhosonline = mysql_num_rows($rsWhosonline);
?>
<b>Online Users:</b><br>
<?php if ($totalRows_rsWhosonline > 0) { // Show if recordset not empty ?>
<?php do { ?>
<?php echo $row_rsWhosonline['name']; ?><br>
<?php } while ($row_rsWhosonline = mysql_fetch_assoc($rsWhosonline)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysql_free_result($rsWhosonline);
?>