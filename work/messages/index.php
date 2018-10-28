<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "Admin,SUPERADMIN";
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

$MM_restrictGoTo = "../users/login.php";
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
function sendSMS($PhoneNumber, $text) {
	$url = "http://www.globalsms-mms.com/sendsmsv2.asp"; 
	$user = "nkhanchandani";
	$password = "password";
	$sender = "mumbaionlin";
	$sendercdma = "919860609000";
	$post_fields = 'user='.$user.'&password='.$password.'&sender='.urlencode($sender).'&sendercdma='.urlencode($sendercdma).'&PhoneNumber='.urlencode($PhoneNumber).'&text='.urlencode($text); 

	$ch = curl_init(); // Initialize a CURL session.
	curl_setopt($ch, CURLOPT_URL, $url); // Pass URL as parameter.
	curl_setopt($ch, CURLOPT_POST, 1); // use this option to Post a form
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Pass form Fields.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return Page contents.
	$result = curl_exec($ch); // grab URL and pass it to the variable.
	curl_close($ch); // close curl resource, and free up system resources.
	return $result; // Print page contents.
}
$rsLoggedIn = mysql_query("select * from mk_users where username = '".$_SESSION['MM_Username']."'") or die("error");
$recLoggedIn = mysql_fetch_array($rsLoggedIn);
	
$sql = "select username, name, user_id, mobilephone from mk_users";
$rsUsers = mysql_query($sql) or die('error');
while($rec = mysql_fetch_array($rsUsers)) {
	$return[$rec['user_id']] = $rec;
	$all[] = $rec['username'];
}
if($_POST) {
	if($_POST['users']) {
		foreach($_POST['users'] as $k => $v) {
			if($v=="-1") {
				if($_POST['type']=="SMS") {
					if($return) {
						foreach($return as $uid=>$rec) {
							if($rec['mobilephone']) sendSMS($rec['mobilephone'], substr($_POST['message'],0,159));
						}
					}
				} else {
					if($all) {
						$string = implode(", ", $all);
						mail($string, $_POST['subject'], $_POST['message'], "From: ".$recLoggedIn['name']."<".$recLoggedIn['username'].">");
					}
				}
				break;
			} else {				
				if($_POST['type']=="SMS") {
					if($return[$v]['mobilephone']) sendSMS($return[$v]['mobilephone'], substr($_POST['message'],0,159));
				} else {
					$else[] = $return[$v]['username'];
				}
			}
		}
		if($else) {
			$elseString = implode(", ", $else);
			mail($elseString, $_POST['subject'], $_POST['message'], "From: ".$recLoggedIn['name']."<".$recLoggedIn['username'].">");
		}
		$msg = "<p><strong><font color=red>".$_POST['type']." sent to all selected users.</font></strong></p>";
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/maintimesheet.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administrator :: Message Center</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
body,td,th,select,input,submit,button,div,p {
	font-family: Verdana;
	font-size: 11px;
}
body {
	background-color: #B5D452;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="800" border="2" align="center" cellpadding="1" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" height="500">
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td valign="top">Designed By:<br>
            <strong>Manish Khanchandani </strong></td>
        <td valign="top"><h1>Xoriant Solutions </h1></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><a href="../index.php">Home</a><?php if(!$_SESSION['MM_Username']) { ?> | <a href="../users/register.php">Register</a> | <a href="../users/login.php">Login</a><?php } ?><?php if($_SESSION['MM_Username']) { ?> | <a href="../inout/index.php">In Out Time</a> | <a href="../timesheet/addhome.php">Add Timesheet</a> | <a href="../timesheet/timesheet_new.php">Add Timesheet <span class="style1">(NEW)</span></a> | <a href="../timesheet/timesheet.php">Timesheet</a> | <a href="../timesheet/deleted_task_list.php">Deleted Task List</a> | <a href="../users/edit.php">Edit Details</a> | <a href="../users/logout.php">Logout</a><?php } ?><?php if($_SESSION['MM_UserGroup']=="Admin" || $_SESSION['MM_UserGroup']=="SUPERADMIN") { ?> | <a href="../inout/admin.php">In Out Time</a> | <a href="../timesheet/admin.php">Admin</a>          <?php } ?>
          <?php if($_SESSION['MM_Username']) { ?><br>
          You are logged in as: <?php echo $_SESSION['MM_Username']; ?><?php } ?></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h3>Message Center </h3>
<?php echo $msg; ?>
<form name="form1" method="post" action="">
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td align="right" valign="top"><strong>Users:</strong></td>
      <td valign="top"><select name="users[]" size="5" multiple id="users">
	  <option value="-1">All</option>
	  <?php if($return) {
	  			foreach($return as $uid=>$rec) { ?>
	  	<option value="<?php echo $rec['user_id']; ?>"><?php echo $rec['name']; ?></option>
	  			<?php } ?>
			<?php } ?>
      </select>      </td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>Subject:</strong></td>
      <td valign="top"><input name="subject" type="text" id="subject"></td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>Message:</strong></td>
      <td valign="top"><textarea name="message" cols="45" rows="5" id="message"></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top"><strong>Type:</strong></td>
      <td valign="top"><input name="type" type="radio" value="Email" checked>
        Email 
          <input name="type" type="radio" value="SMS">
          SMS</td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td valign="top"><input type="submit" name="Submit" value="Send Mail"></td>
    </tr>
  </table>
</form>
<p>
<?php if($return) {
	  			foreach($return as $uid=>$rec) { ?>
	  	<?php echo $rec['username']; ?><br />
	  			<?php } ?>
			<?php } ?>&nbsp;</p>
<p>&nbsp; </p>
<!-- InstanceEndEditable --></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include('../end.php'); ?>
</body>
<!-- InstanceEnd --></html>
