<?php require_once('../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
		case 8:
			return 'MODIFY ORDER';
			break;
			
	}
	return '';
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO fxtable (fx_date, symbol, order_type, order_price, order_sl, order_tp, order_comment, order_magic, include_accounts, exclude_accounts, order_lots) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fx_date'], "date"),
                       GetSQLValueString($_POST['symbol'], "text"),
                       GetSQLValueString($_POST['order_type'], "int"),
                       GetSQLValueString($_POST['order_price'], "text"),
                       GetSQLValueString($_POST['order_sl'], "text"),
                       GetSQLValueString($_POST['order_tp'], "text"),
                       GetSQLValueString($_POST['order_comment'], "text"),
                       GetSQLValueString($_POST['order_magic'], "int"),
                       GetSQLValueString($_POST['include_accounts'], "text"),
                       GetSQLValueString($_POST['exclude_accounts'], "text"),
                       GetSQLValueString($_POST['order_lots'], "double"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_rsTrading = 25;
$pageNum_rsTrading = 0;
if (isset($_GET['pageNum_rsTrading'])) {
  $pageNum_rsTrading = $_GET['pageNum_rsTrading'];
}
$startRow_rsTrading = $pageNum_rsTrading * $maxRows_rsTrading;

mysql_select_db($database_conn, $conn);
$query_rsTrading = "SELECT * FROM fxtable WHERE deleted = 0 ORDER BY fx_id DESC";
$query_limit_rsTrading = sprintf("%s LIMIT %d, %d", $query_rsTrading, $startRow_rsTrading, $maxRows_rsTrading);
$rsTrading = mysql_query($query_limit_rsTrading, $conn) or die(mysql_error());
$row_rsTrading = mysql_fetch_assoc($rsTrading);

if (isset($_GET['totalRows_rsTrading'])) {
  $totalRows_rsTrading = $_GET['totalRows_rsTrading'];
} else {
  $all_rsTrading = mysql_query($query_rsTrading);
  $totalRows_rsTrading = mysql_num_rows($all_rsTrading);
}
$totalPages_rsTrading = ceil($totalRows_rsTrading/$maxRows_rsTrading)-1;

$queryString_rsTrading = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsTrading") == false && 
        stristr($param, "totalRows_rsTrading") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsTrading = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsTrading = sprintf("&totalRows_rsTrading=%d%s", $totalRows_rsTrading, $queryString_rsTrading);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fx Table</title>
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
<h1>Forex Trading </h1>
<p><a href="history.php">History</a></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Symbol:</td>
            <td valign="top"><input type="text" name="symbol" value="" size="32" class="caps"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Type:</td>
            <td valign="top"><select name="order_type">
                <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>BUY</option>
                <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>SELL</option>
                <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>BUYLIMIT</option>
                <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>SELLLIMIT</option>
                <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>BUYSTOP</option>
                <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>SELLSTOP</option>
                <option value="6" <?php if (!(strcmp(6, ""))) {echo "SELECTED";} ?>>ClOSE CURRENT RUNNING ORDER</option>
                <option value="7" <?php if (!(strcmp(7, ""))) {echo "SELECTED";} ?>>DELETE PENDING ORDER</option>
                <option value="8" <?php if (!(strcmp(8, ""))) {echo "SELECTED";} ?>>MODIFY ORDER</option>
            </select>            </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap="nowrap">Order Lots :</td>
            <td valign="top"><input name="order_lots" type="text" id="order_lots" value="0.01" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Price:</td>
            <td valign="top"><input type="text" name="order_price" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>&nbsp;</td>
            <td valign="top">For Buy/Sell, don't fill price in above text box, price is only inserted in pending orders </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>StopLoss:</td>
            <td valign="top"><input type="text" name="order_sl" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Take Profit:</td>
            <td valign="top"><input type="text" name="order_tp" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Comment:</td>
            <td valign="top"><input type="text" name="order_comment" value="MKTrade" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Magic:</td>
            <td valign="top"><input type="text" name="order_magic" value="100" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Allowed Accounts: </td>
            <td valign="top"><label>
                <textarea name="include_accounts" cols="35" rows="7" id="include_accounts">All</textarea>
            </label></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>Ban Accounts </td>
            <td valign="top"><label>
                <textarea name="exclude_accounts" cols="35" rows="7" id="exclude_accounts"></textarea>
            </label></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>&nbsp;</td>
            <td valign="top"><input type="submit" value="Create New Order"></td>
        </tr>
    </table>
    <input type="hidden" name="fx_date" value="">
    <input type="hidden" name="MM_insert" value="form1">
</form>
<?php if ($totalRows_rsTrading > 0) { // Show if recordset not empty ?>
    <h3>View All Orders </h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td><strong>Date Created </strong></td>
            <td><strong>Symbol</strong></td>
            <td><strong>Lots</strong></td>
            <td><strong>Type</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Stop Loss </strong></td>
            <td><strong>Take Profit </strong></td>
            <td><strong>Comment</strong></td>
            <td><strong>Magic</strong></td>
            <td><strong>Allowed Accounts </strong></td>
            <td><strong>Banned Accounts </strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        <?php do { ?>
            <tr>
                <td><?php echo $row_rsTrading['fx_date']; ?></td>
                <td><?php echo $row_rsTrading['symbol']; ?></td>
                <td><?php echo $row_rsTrading['order_lots']; ?></td>
                <td><?php echo convertType($row_rsTrading['order_type']); ?></td>
                <td><?php echo $row_rsTrading['order_price']; ?></td>
                <td><?php echo $row_rsTrading['order_sl']; ?></td>
                <td><?php echo $row_rsTrading['order_tp']; ?></td>
                <td><?php echo $row_rsTrading['order_comment']; ?></td>
                <td><?php echo $row_rsTrading['order_magic']; ?></td>
                <td><?php echo $row_rsTrading['include_accounts']; ?></td>
                <td><?php echo $row_rsTrading['exclude_accounts']; ?></td>
                <td><a href="delete.php?fx_id=<?php echo $row_rsTrading['fx_id']; ?>" onclick="var a = confirm('do you really want to delete this record?'); return a;">Delete</a></td>
            </tr>
            <?php } while ($row_rsTrading = mysql_fetch_assoc($rsTrading)); ?>
            </table>
    <p> Records <?php echo ($startRow_rsTrading + 1) ?> to <?php echo min($startRow_rsTrading + $maxRows_rsTrading, $totalRows_rsTrading) ?> of <?php echo $totalRows_rsTrading ?>
    <table border="0" width="50%" align="center">
        <tr>
            <td width="23%" align="center"><?php if ($pageNum_rsTrading > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsTrading=%d%s", $currentPage, 0, $queryString_rsTrading); ?>">First</a>
            <?php } // Show if not first page ?>            </td>
            <td width="31%" align="center"><?php if ($pageNum_rsTrading > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsTrading=%d%s", $currentPage, max(0, $pageNum_rsTrading - 1), $queryString_rsTrading); ?>">Previous</a>
            <?php } // Show if not first page ?>            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsTrading < $totalPages_rsTrading) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsTrading=%d%s", $currentPage, min($totalPages_rsTrading, $pageNum_rsTrading + 1), $queryString_rsTrading); ?>">Next</a>
            <?php } // Show if not last page ?>            </td>
            <td width="23%" align="center"><?php if ($pageNum_rsTrading < $totalPages_rsTrading) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsTrading=%d%s", $currentPage, $totalPages_rsTrading, $queryString_rsTrading); ?>">Last</a>
            <?php } // Show if not last page ?>            </td>
        </tr>
    </table>
    <?php } // Show if recordset not empty ?></p>
</body>
</html>
<?php
mysql_free_result($rsTrading);
?>
