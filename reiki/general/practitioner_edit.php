<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

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

$MM_restrictGoTo = "../users/login.php";
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

function checkError($post) {
	if (empty($post['lat'])) {
		$error = 'Empty Latitude & Longitude';
		return $error;
	}
	if (empty($post['lng'])) {
		$error = 'Empty Latitude & Longitude';
		return $error;
	}
	if (empty($post['address'])) {
		$error = 'Empty address';
		return $error;
	}
	if (empty($post['name'])) {
		$error = 'Empty name';
		return $error;
	}
	
	return null;
}
$error = '';
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formEdit")) {
	$error = checkError($_POST);
	
	if (!empty($error)) {
		unset($_POST["MM_update"]);
	}
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formEdit")) {
  $updateSQL = sprintf("UPDATE reiki_practitioners SET lat=%s, lng=%s, address=%s, name=%s, highest_level=%s, distance_healing=%s, distance_attunement=%s, teach_reiki=%s, treatment_reiki=%s, gender=%s, teacher=%s, address2=%s, description=%s, email=%s, phone=%s, facebook=%s WHERE id=%s",
                       GetSQLValueString($_POST['lat'], "double"),
                       GetSQLValueString($_POST['lng'], "double"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['highest_level'], "text"),
                       GetSQLValueString($_POST['distance_healing'], "int"),
                       GetSQLValueString($_POST['distance_attunement'], "int"),
                       GetSQLValueString($_POST['teach_reiki'], "int"),
                       GetSQLValueString($_POST['treatment_reiki'], "int"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['teacher'], "text"),
                       GetSQLValueString($_POST['address2'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['facebook'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "directory.php?my=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colid_rsEdit = "-1";
if (isset($_GET['id'])) {
  $colid_rsEdit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
$colname_rsEdit = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM reiki_practitioners WHERE user_id = %s AND id = %s", $colname_rsEdit,$colid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$_POST['address'] = $row_rsEdit['address'];
$_POST['address2'] = $row_rsEdit['address2'];
$latitude = $row_rsEdit['lat'];
$longitude = $row_rsEdit['lng'];
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit  Practitioner Profile</title>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
<h1 class="page-header">Practitioner</h1>
<?php if (!empty($error)) { ?>
<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
<?php } ?>
<form method="POST" name="formEdit" id="formEdit" action="<?php echo $editFormAction; ?>">
<div class="table-responsive">
  <table class="table">
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Name:</strong></td>
            <td valign="top"><input type="text" name="name" value="<?php echo $row_rsEdit['name']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Address:</strong></td>
            <td valign="top"><?php include('map.php'); ?></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Highest Level:</strong></td>
            <td valign="top"><select name="highest_level">
                <option value="Reiki 1" <?php if (!(strcmp("Reiki 1", $row_rsEdit['highest_level']))) {echo "selected=\"selected\"";} ?>>Reiki 1</option>
                <option value="Reiki 2" <?php if (!(strcmp("Reiki 2", $row_rsEdit['highest_level']))) {echo "selected=\"selected\"";} ?>>Reiki 2</option>
                <option value="Master A Practitioner" <?php if (!(strcmp("Master A Practitioner", $row_rsEdit['highest_level']))) {echo "selected=\"selected\"";} ?>>Master A Practitioner</option>
                <option value="Master B Teacher" <?php if (!(strcmp("Master B Teacher", $row_rsEdit['highest_level']))) {echo "selected=\"selected\"";} ?>>Master B Teacher</option>
            </select>            </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Distance Healing:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['distance_healing'],"0"))) {echo "checked=\"checked\"";} ?> name="distance_healing" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['distance_healing'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="distance_healing" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Distance Attunement:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['distance_attunement'],"0"))) {echo "checked=\"checked\"";} ?> name="distance_attunement" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['distance_attunement'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="distance_attunement" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you teach Reiki:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['teach_reiki'],"0"))) {echo "checked=\"checked\"";} ?> name="teach_reiki" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['teach_reiki'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="teach_reiki" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Reiki Treatment:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['treatment_reiki'],"0"))) {echo "checked=\"checked\"";} ?> name="treatment_reiki" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input <?php if (!(strcmp($row_rsEdit['treatment_reiki'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="treatment_reiki" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Gender:</strong></td>
            <td valign="top"><select name="gender">
                <option value="Male" <?php if (!(strcmp("Male", $row_rsEdit['gender']))) {echo "selected=\"selected\"";} ?>>Male</option>
                <option value="Female" <?php if (!(strcmp("Female", $row_rsEdit['gender']))) {echo "selected=\"selected\"";} ?>>Female</option>
            </select></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Email:</strong></td>
            <td valign="top"><input name="email" type="text" id="email" value="<?php echo $row_rsEdit['email']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Phone: </strong></td>
            <td valign="top"><input name="phone" type="text" id="phone" value="<?php echo $row_rsEdit['phone']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Facebook Page: </strong></td>
            <td valign="top"><input name="facebook" type="text" id="facebook" value="<?php echo $row_rsEdit['facebook']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Who Taught You:</strong></td>
            <td valign="top"><input name="teacher" type="text" value="<?php echo $row_rsEdit['teacher']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Description:</strong></td>
            <td valign="top"><label>
                <textarea name="description" cols="32" rows="5" id="description"><?php echo $row_rsEdit['description']; ?></textarea>
            </label></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>&nbsp;</td>
            <td valign="top"><input type="submit" value="Update">
                <input name="id" type="hidden" id="id" value="<?php echo $row_rsEdit['id']; ?>"></td>
        </tr>
    </table>
	</div>
    <input type="hidden" name="MM_update" value="formEdit">
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEdit);
?>
