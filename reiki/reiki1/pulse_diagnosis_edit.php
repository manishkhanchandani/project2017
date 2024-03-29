<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

$MM_authorizedUsers = "reiki1,admin,reiki12,reiki123";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/access-denied.php";
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$_POST['pulse_data'] = json_encode($_POST['data']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE reiki_pulse_diagnosis SET name=%s, gender=%s, age=%s, case_date=%s, pulse_data=%s WHERE case_id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['age'], "text"),
                       GetSQLValueString($_POST['case_date'], "text"),
                       GetSQLValueString($_POST['pulse_data'], "text"),
                       GetSQLValueString($_POST['case_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "pulse_diagnosis_view.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


$colid_rsEdit = "-1";
if (isset($_GET['case_id'])) {
  $colid_rsEdit = (get_magic_quotes_gpc()) ? $_GET['case_id'] : addslashes($_GET['case_id']);
}
$colname_rsEdit = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM reiki_pulse_diagnosis WHERE user_id = %s and case_id = %s", $colname_rsEdit,$colid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
 
include('pulse_data.php');
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki : Pulse Diagnosis</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Pulse Diagnosis Edit </h1>
<?php $pulse_data = json_decode(stripslashes($row_rsEdit['pulse_data']), true); ?>
  <div id="content" class="visual">
      <form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
      <div class="row">
	  	<div class="col-md-4">
			<div class="table-responsive">
  				<table class="table">
				<tr>
					<td>
						Superficial
					</td>
					<td>
						Deep
					</td>
				</tr>
				<?php foreach ($pulse['right'] as $k => $v) { ?>
				<tr>
					<?php foreach ($v as $k1 => $v1) { ?>
					<td>
						<div><strong><?php echo $v1['name']; ?></strong></div>
						<div>
							<?php foreach ($quality as $k2 => $v2) { ?>
								<input name="data[<?php echo $k1; ?>]" type="radio" id="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>" value="<?php echo $v2['label']; ?>" <?php if ($v2['label'] === $pulse_data[$v1['key']]) echo 'checked="checked"'; ?>> <label for="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>"><?php echo $v2['label']; ?></label> 
							<?php } ?>
						</div></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			</div>
			
		</div>
		<div class="col-md-4"><img src="images/pulse3.jpg" class="img-responsive" /></div>
		<div class="col-md-4">
			<div class="table-responsive">
  				<table class="table">
				<tr>
					<td>
						Superficial
					</td>
					<td>
						Deep
					</td>
				</tr>
				<?php foreach ($pulse['left'] as $k => $v) { ?>
				<tr>
					<?php foreach ($v as $k1 => $v1) { ?>
					<td>
						<div><strong><?php echo $v1['name']; ?></strong></div>
						<div>
							<?php foreach ($quality as $k2 => $v2) { ?>
								<input name="data[<?php echo $k1; ?>]" type="radio" id="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>" value="<?php echo $v2['label']; ?>" <?php if ($v2['label'] === $pulse_data[$v1['key']]) echo 'checked="checked"'; ?>> <label for="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>"><?php echo $v2['label']; ?></label> 
							<?php } ?>
						</div></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			</div>
		</div>
		</div>
		
		
		
		
		
		<div class="table-responsive">
			<table class="table">
				<tr>
					<td align="right">
						<strong>Name</strong>					</td>
					<td>
						<input name="name" type="text" id="name" value="<?php echo $row_rsEdit['name']; ?>">					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Gender</strong>					</td>
					<td>
						<input name="gender" type="text" id="gender" value="<?php echo $row_rsEdit['gender']; ?>">					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Age</strong>					</td>
					<td>
						<input name="age" type="text" id="age" value="<?php echo $row_rsEdit['age']; ?>">					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Date</strong>					</td>
					<td>
						<input name="case_date" type="text" id="case_date" value="<?php echo $row_rsEdit['case_date']; ?>">					</td>
				</tr>
				<tr>
				    <td align="right">&nbsp;</td>
				    <td><input name="submit" type="submit" value="Submit">
                        <input name="pulse_data" type="hidden" id="pulse_data">
                        <input name="case_id" type="hidden" id="case_id" value="<?php echo $row_rsEdit['case_id']; ?>"></td>
				    </tr>
			</table>
		</div>
	    <input type="hidden" name="MM_update" value="form1">
      </form>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEdit);
?>
