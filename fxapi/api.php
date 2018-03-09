<?php require_once('../Connections/conn.php'); ?>
<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

if (empty($_GET['account'])) {
	exit;
}
?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsTrading = "SELECT * FROM fxtable WHERE deleted = 0 ORDER BY fx_id DESC";
$rsTrading = mysql_query($query_rsTrading, $conn) or die(mysql_error());
$row_rsTrading = mysql_fetch_assoc($rsTrading);
$totalRows_rsTrading = mysql_num_rows($rsTrading);

if ($totalRows_rsTrading === 0) {
	exit;
}

do {
//process
if ($row_rsTrading['include_accounts'] !== 'All') {
	if (empty($_GET['account'])) {
		continue;
	}
	
	$exp = explode(',', $row_rsTrading['include_accounts']); 
	if (!in_array($_GET['account'], $exp)) {
		continue;
	}
}
if (!empty($row_rsTrading['exclude_accounts'])) {
	$exp = explode(',', $row_rsTrading['exclude_accounts']); 
	if (in_array($_GET['account'], $exp)) {
		continue;
	}
}

echo strtoupper($row_rsTrading['symbol']).'|'.$row_rsTrading['order_type'].'|'.$row_rsTrading['order_price'].'|'.$row_rsTrading['order_sl'].'|'.$row_rsTrading['order_tp'].'|'.$row_rsTrading['order_comment'].'|'.$row_rsTrading['order_magic']."\n";
} while ($row_rsTrading = mysql_fetch_assoc($rsTrading));
mysql_free_result($rsTrading);
?>
