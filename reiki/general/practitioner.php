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
	if (empty($post['user_id'])) {
		$error = 'Empty User Id';
		return $error;
	}
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$error = checkError($_POST);
	
	if (!empty($error)) {
		unset($_POST["MM_insert"]);
	}
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO reiki_practitioners (user_id, lat, lng, name, address, highest_level, distance_healing, distance_attunement, teach_reiki, treatment_reiki, gender, teacher, address2, description, email, phone, facebook) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['lat'], "double"),
                       GetSQLValueString($_POST['lng'], "double"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
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
                       GetSQLValueString($_POST['facebook'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "confirm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Create New Practitioner Profile</title>
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
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="table-responsive">
  <table class="table">
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Name:</strong></td>
            <td valign="top"><input type="text" name="name" value="<?php echo $_SESSION['MM_DisplayName']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Address:</strong></td>
            <td valign="top"><?php include('map.php'); ?></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Highest Level:</strong></td>
            <td valign="top"><select name="highest_level">
                <option value="Reiki 1" <?php if (!(strcmp("Reiki 1", ""))) {echo "SELECTED";} ?>>Reiki 1</option>
                <option value="Reiki 2" <?php if (!(strcmp("Reiki 2", ""))) {echo "SELECTED";} ?>>Reiki 2</option>
                <option value="Master A Practitioner" <?php if (!(strcmp("Master A Practitioner", ""))) {echo "SELECTED";} ?>>Master A Practitioner</option>
                <option value="Master B Teacher" <?php if (!(strcmp("Master B Teacher", ""))) {echo "SELECTED";} ?>>Master B Teacher</option>
            </select>            </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Distance Healing:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input name="distance_healing" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input type="radio" name="distance_healing" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Distance Attunement:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input name="distance_attunement" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input type="radio" name="distance_attunement" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you teach Reiki:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input name="teach_reiki" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input type="radio" name="teach_reiki" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you do Reiki Treatment:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input name="treatment_reiki" type="radio" value="0" checked >
                        No</td>
                </tr>
                <tr>
                    <td><input type="radio" name="treatment_reiki" value="1" >
                        Yes</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Gender:</strong></td>
            <td valign="top"><select name="gender">
                <option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
                <option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
            </select>            </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Email:</strong></td>
            <td valign="top"><input name="email" type="text" id="email" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Phone: </strong></td>
            <td valign="top"><input name="phone" type="text" id="phone" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Facebook Page: </strong></td>
            <td valign="top"><input name="facebook" type="text" id="facebook" size="32"></td>
        </tr>
        
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Who Taught You:</strong></td>
            <td valign="top"><input type="text" name="teacher" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Description:</strong></td>
            <td valign="top"><label>
                <textarea name="description" cols="32" rows="5" id="description"></textarea>
            </label></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>&nbsp;</td>
            <td valign="top"><input type="submit" value="Add New Profile"></td>
        </tr>
    </table>
	</div>
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
    <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
