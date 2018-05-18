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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$element = array_filter($_POST['element']);
	$_POST['elements'] = json_encode($element);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_elements (issue, elements, rule, subject) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['issue'], "text"),
                       GetSQLValueString($_POST['elements'], "text"),
                       GetSQLValueString($_POST['rule'], "text"),
                       GetSQLValueString($_POST['subject'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$maxRows_rsView = 100;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM qz_elements ORDER BY element_id DESC";
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

$subject = !empty($_POST['subject']) ? $_POST['subject'] : '';
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Element Study</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->

<link href="library/wysiwyg/summernote.css" rel="stylesheet">
<script src="library/wysiwyg/summernote.js"></script>
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h3>Add New Rule / Elements</h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <div class="table-responsive">
  		<table class="table table-striped">
        <tr valign="baseline">
            <td nowrap align="right"><strong>Subject:</strong></td>
            <td><select name="subject" id="subject">
                <option value="" <?php if (!(strcmp("", $subject))) {echo "selected=\"selected\"";} ?>>Select</option>
                <option value="contracts" <?php if (!(strcmp("contracts", $subject))) {echo "selected=\"selected\"";} ?>>Contracts</option>
                <option value="torts" <?php if (!(strcmp("torts", $subject))) {echo "selected=\"selected\"";} ?>>Torts</option>
                <option value="criminal" <?php if (!(strcmp("criminal", $subject))) {echo "selected=\"selected\"";} ?>>Criminal</option>
            </select></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right"><strong>Issue:</strong></td>
            <td><input type="text" name="issue" id="issue" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right" valign="top"><strong>Rule:</strong></td>
            <td><textarea name="rule" id="rule" cols="50" rows="5"></textarea>            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right"><strong>Elements:</strong></td>
            <td>
				<div class="form-group" id="elementDiv">
				  <input type="text" name="element[]" class="inputText" value="" placeholder="Enter Element" size="45" /><br />
			  </div>
				<div class="form-group">
               		<input type="button" name="addElement" id="addElement" onClick="addElementTT()" value="Add Element" />
                </div>
                <div id="tmpElement" style="display:none;"><input type="text" name="element[]" class="inputText" placeholder="Enter Element" value="" size="45" /><br /></div></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record"></td>
        </tr>
    </table>
	</div>
    <input type="hidden" name="elements" value="">
    <input type="hidden" name="MM_insert" value="form1">
<script>

function addElementTT() {
  $('#elementDiv').append($('#tmpElement').html());
}

 	$(document).ready(function() {
        $('#rule').summernote({
			height: 150						   
		});
    });
</script>
<script>
document.getElementById('issue').focus();
</script>
</form>

<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
    <h3>View Rule / Elements</h3>
    <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?>    </p>
        <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                        <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                        <?php } // Show if not last page ?>                </td>
            </tr>
            </table>

        <div class="table-responsive">
            <table class="table table-striped">
                    <td width="10%"><strong>subject</strong></td>
                    <td width="25%"><strong>issue</strong></td>
                    <td width="40%"><strong>rule</strong></td>
                    <td width="25%"><strong>elements</strong></td>
                </tr>
                <?php do { ?>
                    <tr>
                        <td><?php echo $row_rsView['subject']; ?></td>
                        <td><strong><?php echo $row_rsView['issue']; ?></strong></td>
                        <td><?php echo $row_rsView['rule']; ?></td>
                        <td><?php $arr = json_decode($row_rsView['elements']); 
						if (!empty($arr)) {
							foreach ($arr as $v) {
								echo '- <b>'.$v.'</b><br />';
							}
						}
						?></td>
                    </tr>
                    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
                </table>
        </div>
		 <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?>    </p>
        <table border="0" width="50%" align="center">
            <tr>
                <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                        <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                        <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                        <?php } // Show if not last page ?>                </td>
            </tr>
            </table>
    <?php } // Show if recordset not empty ?><p>&nbsp; </p>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
