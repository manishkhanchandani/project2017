<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

$MM_authorizedUsers = "admin";
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE users_auth SET display_name=%s, profile_img=%s, email=%s, provider_id=%s, password=%s, access_level=%s, user_created_dt=%s, uid=%s, logged_in_time=%s, profile_uid=%s, website=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['display_name'], "text"),
                       GetSQLValueString($_POST['profile_img'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['provider_id'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['access_level'], "text"),
                       GetSQLValueString($_POST['user_created_dt'], "date"),
                       GetSQLValueString($_POST['uid'], "text"),
                       GetSQLValueString($_POST['logged_in_time'], "int"),
                       GetSQLValueString($_POST['profile_uid'], "text"),
                       GetSQLValueString($_POST['website'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "users.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEdit = "-1";
if (isset($_GET['user_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['user_id'] : addslashes($_GET['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM users_auth WHERE user_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administrator : Users Edit</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/firebase_4_1_5.js"></script>

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
  <h1 class="page-header">Administrator : Users Edit</h1>

  <div id="content" class="visual">
      <p>&nbsp;</p>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>"><div class="table-responsive">
          <table class="table">
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Display_name:</strong></td>
                  <td><input type="text" name="display_name" value="<?php echo $row_rsEdit['display_name']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Profile_img:</strong></td>
                  <td><input type="text" name="profile_img" value="<?php echo $row_rsEdit['profile_img']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Email:</strong></td>
                  <td><input type="text" name="email" value="<?php echo $row_rsEdit['email']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Provider_id:</strong></td>
                  <td><input type="text" name="provider_id" value="<?php echo $row_rsEdit['provider_id']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Password:</strong></td>
                  <td><input type="text" name="password" value="<?php echo $row_rsEdit['password']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Access_level:</strong></td>
                  <td><select name="access_level">
                      <option value=""  <?php if (!(strcmp("", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>Select</option>
                      <option value="admin" <?php if (!(strcmp("admin", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>admin</option>
                      <option value="reiki1" <?php if (!(strcmp("reiki1", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>reiki1</option>
                      <option value="reiki2" <?php if (!(strcmp("reiki2", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>reiki2</option>
                      <option value="reiki3" <?php if (!(strcmp("reiki3", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>reiki3</option>
                      <option value="reiki12" <?php if (!(strcmp("reiki12", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>reiki12</option>
                      <option value="reiki123" <?php if (!(strcmp("reiki123", $row_rsEdit['access_level']))) {echo "selected=\"selected\"";} ?>>reiki123</option>
                      </select>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>User_created_dt:</strong></td>
                  <td><input type="text" name="user_created_dt" value="<?php echo $row_rsEdit['user_created_dt']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Uid:</strong></td>
                  <td><input type="text" name="uid" value="<?php echo $row_rsEdit['uid']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Logged_in_time:</strong></td>
                  <td><input type="text" name="logged_in_time" value="<?php echo $row_rsEdit['logged_in_time']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Profile_uid:</strong></td>
                  <td><input type="text" name="profile_uid" value="<?php echo $row_rsEdit['profile_uid']; ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Website:</strong></td>
                  <td><input type="text" name="website" value="<?php echo htmlspecialchars($row_rsEdit['website']); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Update record"></td>
              </tr>
          </table>
		  </div>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="user_id" value="<?php echo $row_rsEdit['user_id']; ?>">
      </form>
      <p>&nbsp;</p>
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
