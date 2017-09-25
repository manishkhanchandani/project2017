<?php require_once('../Connections/conn.php'); ?><?php
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

$MM_restrictGoTo = "login.php";
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
	mysql_select_db($database_conn, $conn);
	$query = sprintf("SELECT * FROM hm_categories WHERE cat_id = %s", $id);
	$rs = mysql_query($query, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($rs);

	if (empty($row)) {
		return $arr;
	}
	array_push($arr, $row);
	return getLink($row['parent_id'], $arr);
}
if (empty($_GET['parent_id'])) $_GET['parent_id'] = 0;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO hm_categories (category, parent_id, user_id) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['category'], "text"),
                       GetSQLValueString($_POST['parent_id'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE hm_categories SET category=%s, parent_id=%s WHERE cat_id=%s",
                       GetSQLValueString($_POST['category'], "text"),
                       GetSQLValueString($_POST['parent_id'], "int"),
                       GetSQLValueString($_POST['cat_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

$maxRows_rsCategory = 10;
$pageNum_rsCategory = 0;
if (isset($_GET['pageNum_rsCategory'])) {
  $pageNum_rsCategory = $_GET['pageNum_rsCategory'];
}
$startRow_rsCategory = $pageNum_rsCategory * $maxRows_rsCategory;

$colname2_rsCategory = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname2_rsCategory = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsCategory = "0";
if (isset($_GET['parent_id'])) {
  $colname_rsCategory = (get_magic_quotes_gpc()) ? $_GET['parent_id'] : addslashes($_GET['parent_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCategory = sprintf("SELECT * FROM hm_categories WHERE parent_id = %s AND user_id = %s", $colname_rsCategory,$colname2_rsCategory);
$query_limit_rsCategory = sprintf("%s LIMIT %d, %d", $query_rsCategory, $startRow_rsCategory, $maxRows_rsCategory);
$rsCategory = mysql_query($query_limit_rsCategory, $conn) or die(mysql_error());
$row_rsCategory = mysql_fetch_assoc($rsCategory);

if (isset($_GET['totalRows_rsCategory'])) {
  $totalRows_rsCategory = $_GET['totalRows_rsCategory'];
} else {
  $all_rsCategory = mysql_query($query_rsCategory);
  $totalRows_rsCategory = mysql_num_rows($all_rsCategory);
}
$totalPages_rsCategory = ceil($totalRows_rsCategory/$maxRows_rsCategory)-1;

$colname_rsEdit = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM hm_categories WHERE cat_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

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
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Category Management</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
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
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Quiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Issues <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="issue_details_view.php">Issue Details</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Deprecated</li>
                <li><a href="issues.php">Issue Spotting</a></li>
              </ul>
            </li>
		  	<?php if (!empty($_SESSION['MM_UserId'])) { ?>
            <li><a href="logout.php">Logout</a></li>
			<?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Category </h1>
<div>
<?php if (!empty($breadCrumb)) { ?>
<ol class="breadcrumb">
<?php for ($i = count($breadCrumb) - 1; $i >= 0; $i--) { ?>

  <li><a href="hm_categories.php?parent_id=<?php echo $breadCrumb[$i]['parent_id']; ?>"><?php echo $breadCrumb[$i]['category']; ?></a></li>
<?php } ?>
</ol>
<?php } ?>
</div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  
  <div class="table-responsive">
  <table class="table table-striped">
    <tr valign="baseline">
      <td nowrap align="right">Category:</td>
      <td><input type="text" name="category" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  </div>
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
  <input type="hidden" name="parent_id" value="<?php echo $_GET['parent_id']; ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php if ($totalRows_rsCategory > 0) { // Show if recordset not empty ?>
  <h3>View Categories </h3>
  
  <div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <td><strong>Category ID </strong></td>
      <td><strong>Category</strong></td>
      <td><strong>Parent Id </strong></td>
      <td><strong>Add Child </strong></td>
      <td><strong>Edit</strong></td>
      <td><strong>Delete</strong></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsCategory['cat_id']; ?></td>
        <td><?php echo $row_rsCategory['category']; ?></td>
        <td><?php echo $row_rsCategory['parent_id']; ?></td>
        <td><a href="hm_categories.php?parent_id=<?php echo $row_rsCategory['cat_id']; ?>">Add Child</a> </td>
        <td>Edit</td>
        <td>Delete</td>
      </tr>
      <?php } while ($row_rsCategory = mysql_fetch_assoc($rsCategory)); ?>
    </table>
	</div>
  <p>Records <?php echo ($startRow_rsCategory + 1) ?> to <?php echo min($startRow_rsCategory + $maxRows_rsCategory, $totalRows_rsCategory) ?> of <?php echo $totalRows_rsCategory ?></p>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsCategory > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, 0, $queryString_rsCategory); ?>">First</a>
      <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsCategory > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, max(0, $pageNum_rsCategory - 1), $queryString_rsCategory); ?>">Previous</a>
      <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsCategory < $totalPages_rsCategory) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, min($totalPages_rsCategory, $pageNum_rsCategory + 1), $queryString_rsCategory); ?>">Next</a>
      <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsCategory < $totalPages_rsCategory) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsCategory=%d%s", $currentPage, $totalPages_rsCategory, $queryString_rsCategory); ?>">Last</a>
      <?php } // Show if not last page ?>      </td>
    </tr>
    </table>
  <?php } // Show if recordset not empty ?></p>
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
  <h3>Edit Category </h3>
  <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
    <table>
          <tr valign="baseline">
            <td nowrap align="right">Category:</td>
            <td><input type="text" name="category" value="<?php echo $row_rsCategory['category']; ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Parent  id:</td>
            <td><input type="text" name="parent_id" value="<?php echo $row_rsCategory['parent_id']; ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Update record"></td>
          </tr>
      </table>
        <input type="hidden" name="MM_update" value="form2">
        <input type="hidden" name="cat_id" value="<?php echo $row_rsCategory['cat_id']; ?>">
    </form>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
    <p>&nbsp;</p>
	
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
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCategory);

mysql_free_result($rsEdit);
?>
