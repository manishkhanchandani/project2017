<?php
if (!empty($_SESSION['MM_UserId'])) {
require_once(BASE_DIR.DIRECTORY_SEPARATOR.'Connections'.DIRECTORY_SEPARATOR.'conn.php');
$colname_rsMyGroups = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsMyGroups = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsMyGroups = sprintf("SELECT * FROM citygroup_group_users as a INNER JOIN citygroup_groups as b ON a.group_id = b.group_id  WHERE a.user_id = %s ORDER BY b.group_name ASC", $colname_rsMyGroups);
$rsMyGroups = mysql_query($query_rsMyGroups, $conn) or die(mysql_error());
$row_rsMyGroups = mysql_fetch_assoc($rsMyGroups);
$totalRows_rsMyGroups = mysql_num_rows($rsMyGroups);
?>
<?php if ($totalRows_rsMyGroups > 0) { // Show if recordset not empty ?>
    <li>
        <a href="" class="dropdown-toggle" data-toggle="dropdown">My Groups<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <?php do { ?>
			<li><a href="<?php echo HTTP_PATH; ?>groups/?group_id=<?php echo $row_rsMyGroups['group_id']; ?>&city=<?php echo urlencode($row_rsMyGroups['group_name']); ?>"><?php echo $row_rsMyGroups['group_name']; ?></a></li>
            <?php } while ($row_rsMyGroups = mysql_fetch_assoc($rsMyGroups)); ?>
        </ul>
</li>
<?php } // Show if recordset not empty ?>
<?php
mysql_free_result($rsMyGroups);
}
?>
