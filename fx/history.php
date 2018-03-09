<?php require_once('../Connections/conn.php'); ?>
<?php

function convertType($type) {
	switch ($type) {
		case 0:
			return 'BUY';
			break;
		case 1:
			return 'SELL';
			break;
		case 2:
			return 'BUYLIMIT';
			break;
		case 3:
			return 'SELLLIMIT';
			break;
		case 4:
			return 'BUYSTOP';
			break;
		case 5:
			return 'SELLSTOP';
			break;
		case 6:
			return 'ClOSE CURRENT RUNNING ORDER';
			break;
		case 7:
			return 'DELETE PENDING ORDER';
			break;
			
	}
	return '';
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsHistory = 100;
$pageNum_rsHistory = 0;
if (isset($_GET['pageNum_rsHistory'])) {
  $pageNum_rsHistory = $_GET['pageNum_rsHistory'];
}
$startRow_rsHistory = $pageNum_rsHistory * $maxRows_rsHistory;

$colname_rsHistory = "%";
if (isset($_GET['account_number'])) {
  $colname_rsHistory = (get_magic_quotes_gpc()) ? $_GET['account_number'] : addslashes($_GET['account_number']);
}
mysql_select_db($database_conn, $conn);
$query_rsHistory = sprintf("SELECT * FROM fx_history WHERE account_number LIKE '%%%s%%' ORDER BY history_id DESC", $colname_rsHistory);
$query_limit_rsHistory = sprintf("%s LIMIT %d, %d", $query_rsHistory, $startRow_rsHistory, $maxRows_rsHistory);
$rsHistory = mysql_query($query_limit_rsHistory, $conn) or die(mysql_error());
$row_rsHistory = mysql_fetch_assoc($rsHistory);

if (isset($_GET['totalRows_rsHistory'])) {
  $totalRows_rsHistory = $_GET['totalRows_rsHistory'];
} else {
  $all_rsHistory = mysql_query($query_rsHistory);
  $totalRows_rsHistory = mysql_num_rows($all_rsHistory);
}
$totalPages_rsHistory = ceil($totalRows_rsHistory/$maxRows_rsHistory)-1;

$queryString_rsHistory = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsHistory") == false && 
        stristr($param, "totalRows_rsHistory") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsHistory = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsHistory = sprintf("&totalRows_rsHistory=%d%s", $totalRows_rsHistory, $queryString_rsHistory);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>History</title>
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

.caps {
	text-transform: uppercase;
}
</style>
</head>

<body>
<h1>Forex Trading History </h1>
<p><a href="index.php">Back to Home Page </a></p>
<form id="form1" name="form1" method="get" action="">
Search Account Number:
    <label>
    <input name="account_number" type="text" id="account_number" value="<?php echo (!empty($_GET['account_number'])) ? $_GET['account_number'] : ''; ?>" />
    </label>
    <label>
    <input type="submit" name="Submit" value="Search" />
    </label>
    <p>&nbsp;</p>
</form>
<?php if ($totalRows_rsHistory == 0) { // Show if recordset empty ?>
    <p>No History Found. </p>
    <?php } // Show if recordset empty ?>
<?php if ($totalRows_rsHistory > 0) { // Show if recordset not empty ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td><strong>Account Number </strong></td>
            <td><strong>Ticket</strong></td>
            <td><strong>Symbol</strong></td>
            <td><strong>Order Type </strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Take Profit </strong></td>
            <td><strong>Stop Loss </strong></td>
            <td><strong>History Type </strong></td>
            <td><strong>History Date </strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        <?php do { ?>
            <tr>
                <td><?php echo $row_rsHistory['account_number']; ?></td>
                <td><?php echo $row_rsHistory['ticket']; ?></td>
                <td><?php echo $row_rsHistory['symbol']; ?></td>
                <td><?php echo convertType($row_rsHistory['order_type']); ?></td>
                <td><?php echo $row_rsHistory['price']; ?></td>
                <td><?php echo $row_rsHistory['tp']; ?></td>
                <td><?php echo $row_rsHistory['sl']; ?></td>
                <td><?php echo $row_rsHistory['history_type']; ?></td>
                <td><?php echo $row_rsHistory['history_date']; ?></td>
                <td><a href="deleteHistory.php?history_id=<?php echo $row_rsHistory['history_id']; ?>" onclick="var a = confirm('do you really want to delete this record?'); return a;">Delete</a></td>
            </tr>
            <?php } while ($row_rsHistory = mysql_fetch_assoc($rsHistory)); ?>
            </table>
    <p> Records <?php echo ($startRow_rsHistory + 1) ?> to <?php echo min($startRow_rsHistory + $maxRows_rsHistory, $totalRows_rsHistory) ?> of <?php echo $totalRows_rsHistory ?> 
    <table border="0" width="50%" align="center">
        <tr>
            <td width="23%" align="center"><?php if ($pageNum_rsHistory > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsHistory=%d%s", $currentPage, 0, $queryString_rsHistory); ?>">First</a>
                        <?php } // Show if not first page ?>
            </td>
            <td width="31%" align="center"><?php if ($pageNum_rsHistory > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsHistory=%d%s", $currentPage, max(0, $pageNum_rsHistory - 1), $queryString_rsHistory); ?>">Previous</a>
                        <?php } // Show if not first page ?>
            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsHistory < $totalPages_rsHistory) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsHistory=%d%s", $currentPage, min($totalPages_rsHistory, $pageNum_rsHistory + 1), $queryString_rsHistory); ?>">Next</a>
                        <?php } // Show if not last page ?>
            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsHistory < $totalPages_rsHistory) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsHistory=%d%s", $currentPage, $totalPages_rsHistory, $queryString_rsHistory); ?>">Last</a>
                        <?php } // Show if not last page ?>
            </td>
        </tr>
    </table>
    <?php } // Show if recordset not empty ?></p>
</body>
</html>
<?php
mysql_free_result($rsHistory);
?>
