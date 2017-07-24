<?php require_once('../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../qz/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

function getLink($id, $arr=array()) {
	global $database_conn, $conn;
	mysqli_select_db($conn, $database_conn);
	$query = sprintf("SELECT * FROM definitions WHERE id = %s", $id);
	$rs = mysqli_query($conn, $query) or die(mysqli_error());
	$row = mysqli_fetch_assoc($rs);

	if (empty($row)) {
		return $arr;
	}
	array_push($arr, $row);
	return getLink($row['parent_id'], $arr);
}

function pr($d) {
	echo '<pre>';
	print_r($d);
	echo '<pre>';
}

if (empty($_GET['parent_id'])) $_GET['parent_id'] = 0;
if (empty($_POST['subject'])) $_POST['subject'] = !empty($_GET['subject']) ? $_GET['subject'] : '%';

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO definitions (title, definition, example, `exception`, subject, parent_id, ref_id) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['definition'], "text"),
                       GetSQLValueString($_POST['example'], "text"),
                       GetSQLValueString($_POST['exception'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['parent_id'], "int"),
                       GetSQLValueString($_POST['ref_id'], "int"));

  mysqli_select_db($conn, $database_conn);
  $Result1 = mysqli_query($conn, $insertSQL) or die(mysqli_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE definitions SET title=%s, definition=%s, example=%s, `exception`=%s, subject=%s, parent_id=%s, ref_id=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['definition'], "text"),
                       GetSQLValueString($_POST['example'], "text"),
                       GetSQLValueString($_POST['exception'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['parent_id'], "int"),
                       GetSQLValueString($_POST['ref_id'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysqli_select_db($conn, $database_conn);
  $Result1 = mysqli_query($conn, $updateSQL) or die(mysqli_error());
}


$maxRows_rsCategory = 25;
$pageNum_rsCategory = 0;
if (isset($_GET['pageNum_rsCategory'])) {
  $pageNum_rsCategory = $_GET['pageNum_rsCategory'];
}
$startRow_rsCategory = $pageNum_rsCategory * $maxRows_rsCategory;

$colname2_rsCategory = "-1";
if (isset($_POST['subject'])) {
  $colname2_rsCategory = (get_magic_quotes_gpc()) ? $_POST['subject'] : addslashes($_POST['subject']);
}
$colname_rsCategory = "0";
if (isset($_GET['parent_id'])) {
  $colname_rsCategory = (get_magic_quotes_gpc()) ? $_GET['parent_id'] : addslashes($_GET['parent_id']);
}
mysqli_select_db($conn, $database_conn);
$query_rsCategory = sprintf("SELECT * FROM definitions WHERE parent_id = %s AND subject like '%s' ORDER BY subject, id", $colname_rsCategory,$colname2_rsCategory);
$query_limit_rsCategory = sprintf("%s LIMIT %d, %d", $query_rsCategory, $startRow_rsCategory, $maxRows_rsCategory);
$rsCategory = mysqli_query($conn, $query_limit_rsCategory) or die(mysqli_error());
$row_rsCategory = mysqli_fetch_assoc($rsCategory);

if (isset($_GET['totalRows_rsCategory'])) {
  $totalRows_rsCategory = $_GET['totalRows_rsCategory'];
} else {
  $all_rsCategory = mysqli_query($conn, $query_rsCategory);
  $totalRows_rsCategory = mysqli_num_rows($all_rsCategory);
}
$totalPages_rsCategory = ceil($totalRows_rsCategory/$maxRows_rsCategory)-1;

$colname_rsEdit = "-1";
if (isset($_GET['id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($conn, $database_conn);
$query_rsEdit = sprintf("SELECT * FROM definitions WHERE id = %s", $colname_rsEdit);
$rsEdit = mysqli_query($conn, $query_rsEdit) or die(mysqli_error());
$row_rsEdit = mysqli_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysqli_num_rows($rsEdit);

mysqli_select_db( $conn, $database_conn);
$query_rsView = "SELECT * FROM definitions";
$rsView = mysqli_query($conn, $query_rsView) or die(mysqli_error());
$row_rsView = mysqli_fetch_assoc($rsView);
$totalRows_rsView = mysqli_num_rows($rsView);

$queryString_rsCategory = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsCategory") == false && 
        stristr($param, "totalRows_rsCategory") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsCategory = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsCategory = sprintf("&totalRows_rsCategory=%d%s", $totalRows_rsCategory, $queryString_rsCategory);


$breadCrumb = getLink($_GET['parent_id'], array());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/elaw.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Definitions</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<meta charset="utf-8" />




<link rel="stylesheet" href="css/bootstrap-treeview.css" />
<script src="js/bootstrap-treeview.js"></script>
<script>
//http://www.jqueryrain.com/?9_I6fGfI
//https://github.com/jonmiles/bootstrap-treeview
</script>
<!-- InstanceEndEditable -->
</head>

<body>

    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>          </button>
          <a class="navbar-brand" href="../Templates/index.php">Law</a>        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
<!-- InstanceBeginEditable name="EditRegion3" -->

<div class="container">

<h1>Definitions </h1>
<div>
  <?php if (!empty($breadCrumb)) { ?>
  <ol class="breadcrumb">
  <?php for ($i = count($breadCrumb) - 1; $i >= 0; $i--) { ?>
    
    <li><a href="definitions.php?parent_id=<?php echo $breadCrumb[$i]['parent_id']; ?>&amp;subject=<?php echo $_POST['subject']; ?>"><?php echo $breadCrumb[$i]['title']; ?></a></li>
  <?php } ?>
  </ol>
  <?php } ?>
</div>
<p><a href="definitions.php?subject=contracts">Contracts</a> | <a href="definitions.php?subject=criminal">Criminal</a> | <a href="definitions.php?subject=torts">Torts</a> </p>

  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <div class="table-responsive">
  <table class="table table-striped">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Title:</td>
        <td><input type="text" name="title" id="title" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Definition:</td>
        <td><textarea name="definition" cols="50" rows="5"></textarea>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Example:</td>
        <td><textarea name="example" cols="50" rows="5"></textarea>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Exception:</td>
        <td><textarea name="exception" cols="50" rows="5"></textarea>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Subject:</td>
        <td><select name="subject">
            <option value="contracts" <?php if (!(strcmp("contracts", $_POST['subject']))) {echo "SELECTED";} ?>>Contracts</option>
            <option value="criminal" <?php if (!(strcmp("criminal", $_POST['subject']))) {echo "SELECTED";} ?>>Criminal</option>
            <option value="torts" <?php if (!(strcmp("torts", $_POST['subject']))) {echo "SELECTED";} ?>>Torts</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Ref ID:</td>
        <td><input type="text" name="ref_id" value="0" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Parent ID: </td>
        <td><input type="text" name="parent_id" value="<?php echo $_GET['parent_id']; ?>" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insert record" /></td>
      </tr>
    </table>
	</div>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <script>
  	document.getElementById('title').focus();
  </script>
  <?php if ($totalRows_rsCategory > 0) { // Show if recordset not empty ?>
      <h3>View Definitions </h3>
    <div class="table-responsive">
  <table class="table table-striped">
      <tr>
        <td><strong>Id</strong></td>
        <td><strong>Title</strong></td>
        <td><strong>Definition</strong></td>
        <td><strong>Subject</strong></td>
        <td><strong>Parent Id </strong></td>
        <td><strong>Ref Id </strong></td>
        <td><strong>Details</strong> </td>
        <td><strong>Child</strong></td>
        <td><strong>Edit</strong></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_rsCategory['id']; ?></td>
          <td><?php echo $row_rsCategory['title']; ?></td>
          <td><?php echo nl2br($row_rsCategory['definition']); ?></td>
          <td><?php echo $row_rsCategory['subject']; ?></td>
          <td><?php echo $row_rsCategory['parent_id']; ?></td>
          <td><?php echo $row_rsCategory['ref_id']; ?></td>
          <td><a href="detail.php?id=<?php echo $row_rsCategory['id']; ?>">Details</a></td>
          <td><a href="definitions.php?parent_id=<?php echo $row_rsCategory['id']; ?>&amp;subject=<?php echo $_POST['subject']; ?>">Child</a></td>
          <td><a href="definitions.php?id=<?php echo $row_rsCategory['id']; ?>&amp;subject=<?php echo $_POST['subject']; ?>#edit">Edit</a></td>
        </tr>
        <?php } while ($row_rsCategory = mysqli_fetch_assoc($rsCategory)); ?>
      </table>
	</div>
    <p> Records <?php echo ($startRow_rsCategory + 1) ?> to <?php echo min($startRow_rsCategory + $maxRows_rsCategory, $totalRows_rsCategory) ?> of <?php echo $totalRows_rsCategory ?>
    </p><table border="0" width="50%" align="center">
      <tr>
        <td width="23%" align="center"><?php if ($pageNum_rsCategory > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, 0, $queryString_rsCategory); ?>">First</a>
            <?php } // Show if not first page ?>        </td>
        <td width="31%" align="center"><?php if ($pageNum_rsCategory > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, max(0, $pageNum_rsCategory - 1), $queryString_rsCategory); ?>">Previous</a>
            <?php } // Show if not first page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_rsCategory < $totalPages_rsCategory) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, min($totalPages_rsCategory, $pageNum_rsCategory + 1), $queryString_rsCategory); ?>">Next</a>
            <?php } // Show if not last page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_rsCategory < $totalPages_rsCategory) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, $totalPages_rsCategory, $queryString_rsCategory); ?>">Last</a>
            <?php } // Show if not last page ?>        </td>
      </tr>
    </table>
    <?php } // Show if recordset not empty ?></p>
</p>
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?><a name="edit" id="edit"></a>
  <h3>Edit Category </h3>
  
  <form action="<?php echo $editFormAction; ?>&parent_id=<?php echo $row_rsEdit['parent_id']; ?>" method="post" name="form2" id="form2">
    <div class="table-responsive">
  <table class="table table-striped">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Title:</td>
        <td><input type="text" name="title" value="<?php echo $row_rsEdit['title']; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Definition:</td>
        <td><textarea name="definition" cols="50" rows="5"><?php echo $row_rsEdit['definition']; ?></textarea>        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Example:</td>
        <td><textarea name="example" cols="50" rows="5"><?php echo $row_rsEdit['example']; ?></textarea>        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Exception:</td>
        <td><textarea name="exception" cols="50" rows="5"><?php echo $row_rsEdit['exception']; ?></textarea>        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Subject:</td>
        <td><select name="subject">
          <option value="contracts" <?php if (!(strcmp("contracts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Contracts</option>
          <option value="criminal" <?php if (!(strcmp("criminal", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Criminal</option>
<option value="torts" <?php if (!(strcmp("torts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Torts</option>
          </select>        </td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Ref ID:</td>
        <td><input type="text" name="ref_id" value="<?php echo $row_rsEdit['ref_id']; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Parent ID: </td>
        <td><input type="text" name="parent_id" value="<?php echo $row_rsEdit['parent_id']; ?>" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Update Record" /></td>
      </tr>
    </table>
	</div>
    <input name="id" type="hidden" id="id" value="<?php echo $row_rsEdit['id']; ?>" />
    <input type="hidden" name="MM_update" value="form2" />
  </form>
  <?php } // Show if recordset not empty ?>
<?php
$data = array();
?>
<?php do { ?>
<?php
$data[$row_rsView['subject']][] = $row_rsView;
?>
<?php } while ($row_rsView = mysqli_fetch_assoc($rsView)); ?>
<?php
function parseTree($tree, $root = 0) {

    $return = array();
    # Traverse the tree and search for direct children of the root
    foreach($tree as $child => $v) {
        # A direct child is found
        if($v['parent_id'] == $root) {
            # Remove item from tree (we don't need to traverse this again)
            unset($tree[$v['id']]);
            # Append the child into result array and parse its children
            $return[] = array(
                'text' => $v['title'],
				'data' => $v,
				'icon' => 'glyphicon glyphicon-log-in',
				'href' => 'detail.php?id='.$v['id'].'&title='.urlencode($v['title']),
                'nodes' => parseTree($tree, $v['id'])
            );
        }
    }
    return empty($return) ? null : $return;    
}
/*
function printTree($tree) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul>';
        foreach($tree as $node) {
            echo '<li>'.var_export($node['name'], 1);
            printTree($node['children']);
            echo '</li>';
        }
        echo '</ul>';
    }
}*/
//printTree($result);
$tree =  $data['criminal'];

$resultCriminal = parseTree($tree);

$tree =  $data['torts'];
$resultTorts = parseTree($tree);

$tree =  $data['contracts'];
$resultContracts = parseTree($tree);

?>
<div class="row">
	<div class="col-md-4">

<h3>Criminal</h3>
<div id="treeCriminal"></div>
<script>
	var treeCriminal = <?php echo json_encode($resultCriminal); ?>;
	$('#treeCriminal').treeview({
          levels: 1,
		  expandIcon: "glyphicon glyphicon-stop",
          collapseIcon: "glyphicon glyphicon-unchecked",
          nodeIcon: "glyphicon glyphicon-user",
		  enableLinks: true,
          color: "yellow",
          backColor: "purple",
          onhoverColor: "orange",
          borderColor: "red",
          showBorder: false,
          showTags: true,
          highlightSelected: true,
          selectedColor: "yellow",
          selectedBackColor: "darkorange",
		  data: treeCriminal});
</script>

	</div>
	<div class="col-md-4">
	
<h3>Torts</h3>
<div id="treeTorts"></div>
<script>
	var treeTorts = <?php echo json_encode($resultTorts); ?>;
	$('#treeTorts').treeview({
          levels: 1,
		  expandIcon: "glyphicon glyphicon-stop",
          collapseIcon: "glyphicon glyphicon-unchecked",
          nodeIcon: "glyphicon glyphicon-user",
		  enableLinks: true,
          color: "yellow",
          backColor: "purple",
          onhoverColor: "orange",
          borderColor: "red",
          showBorder: false,
          showTags: true,
          highlightSelected: true,
          selectedColor: "yellow",
          selectedBackColor: "darkorange",
		  data: treeTorts});
</script>

	</div>
	<div class="col-md-4">
<h3>Contracts</h3>
<div id="treeContracts"></div>
<script>
	var treeContracts = <?php echo json_encode($resultContracts); ?>;
	$('#treeContracts').treeview({
          levels: 1,
		  expandIcon: "glyphicon glyphicon-stop",
          collapseIcon: "glyphicon glyphicon-unchecked",
          nodeIcon: "glyphicon glyphicon-user",
		  enableLinks: true,
          color: "yellow",
          backColor: "purple",
          onhoverColor: "orange",
          borderColor: "red",
          showBorder: false,
          showTags: true,
          highlightSelected: true,
          selectedColor: "yellow",
          selectedBackColor: "darkorange",
		  data: treeContracts});
</script>
	</div>
</div>
<!--    <p>Select <br />
      c1.cat_id as cat_id1, c1.category as category1, c1.parent_id as parent_id1,<br />
      c2.cat_id as cat_id2, c2.category as category2, c2.parent_id as parent_id2<br />
      from qz_categories as c1 LEFT JOIN qz_categories as c2 ON c1.parent_id = c2.cat_id<br />
      WHERE c1.user_id = 1</p>
    <p>Select <br />
      c1.cat_id as cat_id1, c1.category as category1, c1.parent_id as parent_id1,<br />
      c2.cat_id as cat_id2, c2.category as category2, c2.parent_id as parent_id2<br />
      from qz_categories as c1 LEFT JOIN qz_categories as c2 ON c1.cat_id = c2.parent_id<br />
      WHERE c1.user_id = 1</p> -->
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($rsCategory);

mysqli_free_result($rsEdit);

mysqli_free_result($rsView);
?>
