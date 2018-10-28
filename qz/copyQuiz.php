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

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

if (!empty($_POST['method'])) {
	if ($_POST['method'] == 1) {
		$query = " SELECT id, `user_id`, `category_id` , `question`, `explanation`, `status`, `answers`, 
`correct`, `topic`, `laws`, `essence`, `level_type`, `seconds_assigned` 
FROM qz_questions WHERE category_id = ".GetSQLValueString($_POST['from_cat_id'], 'int')." order by id";
		mysql_select_db($database_conn, $conn);
		$rs = mysql_query($query, $conn) or die(mysql_error());
		$return = array();
		if (mysql_num_rows($rs) > 0) {
			while($rec = mysql_fetch_assoc($rs)) {
				$rec['category_id'] = $_POST['to_cat_id'];
				$return[] = $rec;
				$query = "insert into qz_questions (`user_id`, `category_id`, `question`, `explanation`, `status`, `answers`, `correct`, `topic`, `laws`, `essence`, `level_type`, `seconds_assigned`) VALUES(
					".GetSQLValueString($rec['user_id'], 'int').",
					".GetSQLValueString($rec['category_id'], 'int').",
					".GetSQLValueString($rec['question'], 'text').",
					".GetSQLValueString($rec['explanation'], 'text').",
					".GetSQLValueString($rec['status'], 'text').",
					".GetSQLValueString($rec['answers'], 'text').",
					".GetSQLValueString($rec['correct'], 'text').",
					".GetSQLValueString($rec['topic'], 'text').",
					".GetSQLValueString($rec['laws'], 'text').",
					".GetSQLValueString($rec['essence'], 'text').",
					".GetSQLValueString($rec['level_type'], 'text').",
					".GetSQLValueString($rec['seconds_assigned'], 'text')."
				)";
				mysql_query($query, $conn) or die(mysql_error());
			}
		}
		$message = 'Records Copied Successfully';
			
	}
	
	if ($_POST['method'] == 2) {
		echo '2';
		print_r($_POST);	
		exit;
	}
}

$colname_Recordset1 = "-1";
if (isset($_GET['cat_id'])) {
  $colname_Recordset1 = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conn, $conn);
$query_rsCatAll = "SELECT a.*, b.cat_id as cat_id2, b.category as category2, b.parent_id as parent_id2 FROM qz_categories as a INNER JOIN qz_categories as b ON a. cat_id = b.parent_id";
$rsCatAll = mysql_query($query_rsCatAll, $conn) or die(mysql_error());
$row_rsCatAll = mysql_fetch_assoc($rsCatAll);
$totalRows_rsCatAll = mysql_num_rows($rsCatAll);

$cat_id = $colname_Recordset1;
$cat_id2 = !empty($_POST['to_cat_id']) ? $_POST['to_cat_id'] : -1;


$breadcrumb = array();
function breadcrumb($id = 0) {
	global $breadcrumb, $conn;
	if ($id == 0) {
		array_unshift($breadcrumb, array('id' => $id, 'text' => 'Home'));
		return;
	}
	
	$query = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $id);
	$rs = mysql_query($query, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($rs);
	
	array_unshift($breadcrumb, array('id' => $row['cat_id'], 'text' => $row['category']));
	return breadcrumb($row['parent_id']);
}
breadcrumb($colname_Recordset1);
$tmp = array();
foreach ($breadcrumb as $k => $v) {
	$tmp[] = '<a href="index.php?parent_id='.$v['id'].'">'.$v['text'].'</a>';
}
$breadCrumbString = implode(' > ', $tmp);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Copy Quiz</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<?php include('nav.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<div>
  <h1>Copy Records </h1>
  <?php echo $breadCrumbString; ?>
  <h3>A. Copy All Quiz From Category X to Category Y</h3>
  <?php if (!empty($message)) { ?><p><?php echo $message; ?></p><?php } ?>
  <form name="form2" method="post" action="">
    <p><strong>From Category:</strong>
<select name="from_cat_id" id="from_cat_id">
  <?php
do {  
?>
  <option value="<?php echo $row_rsCatAll['cat_id2']?>"<?php if (!(strcmp($row_rsCatAll['cat_id2'], $cat_id))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCatAll['category']; ?> => <?php echo $row_rsCatAll['category2']?></option>
  <?php
} while ($row_rsCatAll = mysql_fetch_assoc($rsCatAll));
  $rows = mysql_num_rows($rsCatAll);
  if($rows > 0) {
      mysql_data_seek($rsCatAll, 0);
	  $row_rsCatAll = mysql_fetch_assoc($rsCatAll);
  }
?>
</select>
    </p>
    <p><strong>To Category:</strong>
<select name="to_cat_id" id="to_cat_id">
  <?php
do {  
?>
  <option value="<?php echo $row_rsCatAll['cat_id2']?>"<?php if (!(strcmp($row_rsCatAll['cat_id2'], $cat_id2))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCatAll['category']; ?> => <?php echo $row_rsCatAll['category2']?></option>
        <?php
} while ($row_rsCatAll = mysql_fetch_assoc($rsCatAll));
  $rows = mysql_num_rows($rsCatAll);
  if($rows > 0) {
      mysql_data_seek($rsCatAll, 0);
	  $row_rsCatAll = mysql_fetch_assoc($rsCatAll);
  }
?>
    </select>
    </p>
    <p>
      <input type="submit" name="button" id="button" value="Submit">
      <input name="method" type="hidden" id="method" value="1">
    </p>
  </form>
  <p>&nbsp;</p>
  <p>B. Copy A Quiz Record From Category X to Category Y</p>
  <form name="form1" method="post" action="">
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div> 
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rsCatAll);
?>
