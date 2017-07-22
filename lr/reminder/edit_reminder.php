<?php require_once('../../Connections/conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE lr_reminders SET title=%s, emailTo=%s, message=%s, fileLink=%s, status=%s WHERE reminder_id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['emailTo'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['fileLink'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['reminder_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "list_reminders.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname2_rsEdit = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname2_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsEdit = "-1";
if (isset($_GET['reminder_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['reminder_id'] : addslashes($_GET['reminder_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM lr_reminders WHERE reminder_id = %s AND user_id = %s", $colname_rsEdit,$colname2_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);


?><!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Reminder</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/font-awesome.css">
<link rel="stylesheet" href="../css/style.css">
<!-- InstanceBeginEditable name="head" -->
<meta charset="utf-8">


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
          <a class="navbar-brand" href="http://lifereminder.tk">LifeReminder.tk</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../index.php">Home</a></li>
            <li><a href="../our_team.php">Our Team</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reminders <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="new_reminder.php">Create New Reminder</a></li>
                <li><a href="list_reminders.php">My Reminders</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
			  	<?php if (empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="../users/register.php">Register New User</a></li>
                <li><a href="../users/login.php">Login</a></li>
                <li><a href="../users/forgot.php">Forgot Password</a></li>
				<?php } ?>
				<?php if (!empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="../users/change_password.php">Change Password</a></li>
                <li><a href="../users/logout.php">Logout</a></li>
				<?php } ?>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- InstanceBeginEditable name="EditRegion3" -->
		<div class="container">
          <div class="row">
            <div class="col-md-12">
                        <h3>Edit Reminder</h3>
                        <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
                        <form method="POST" name="form1" id="form1" action="<?php echo $editFormAction; ?>">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_rsEdit['title']; ?>" placeholder="Enter Title">
                          </div>
                          <div class="form-group">
                            <label for="emailTo">Email</label>
                            <input name="emailTo" type="text" class="form-control" id="emailTo" value="<?php echo $row_rsEdit['emailTo']; ?>" placeholder="Enter Email">
                          </div>
                          <div class="form-group">
                            <label for="title">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Enter Message"><?php echo $row_rsEdit['message']; ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="fileLink">File Link</label>
                            <input name="fileLink" type="text" class="form-control" id="fileLink" value="<?php echo $row_rsEdit['fileLink']; ?>" placeholder="Enter File Link">
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <p>
                              <label>
                              <input <?php if (!(strcmp($row_rsEdit['status'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="1">
                                Active</label>
                              <label>
                              <input <?php if (!(strcmp($row_rsEdit['status'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="0">
                                Inactive</label>
                              <br>
                            </p>
                          </div>
                          <button type="submit" class="btn btn-default">Update Reminder</button>
                          <input name="reminder_id" type="hidden" id="reminder_id" value="<?php echo $row_rsEdit['reminder_id']; ?>">
                          <input type="hidden" name="MM_update" value="form1">
                        </form>
                            <?php } // Show if recordset not empty ?>
            </div>
          </div>
          <?php if ($totalRows_rsEdit == 0) { // Show if recordset empty ?>
            <h3>
            You are not authorised to Edit this reminder.
            <?php } // Show if recordset empty ?>
		  
		  </h3>
</div>
<!-- InstanceEndEditable -->
	
	<footer>
		<p>Life Reminder : Copyright &copy; 2017 - <a href="#">Terms</a> | <a href="#">Privacy</a></p>
	</footer>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEdit);
?>
