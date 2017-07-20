<?php require_once('../../Connections/conn.php'); ?>

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
?>
<?php
$threeDays = time() - (60 * 60 * 3);

$colname_rsUsers = "-1";
if (isset($threeDays)) {
  $colname_rsUsers = (get_magic_quotes_gpc()) ? $threeDays : addslashes($threeDays);
}
mysql_select_db($database_conn, $conn);
$query_rsUsers = sprintf("SELECT * FROM lr_users WHERE lr_users.emailFlag1 = 1 AND lr_users.emailFlag1Date < %s AND lr_users.cronFlag = 0 LIMIT 5", $colname_rsUsers);
$rsUsers = mysql_query($query_rsUsers, $conn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HTML 5</title>

</head>

<body>
<p>Steps</p>
<p>1. Check if emailFlag1 = 1 AND emailFlag1Date &lt; 3days from now, limi 5 </p>
<?php if ($totalRows_rsUsers > 0) { ?>
<table border="1">
  <tr>
    <td>user_id</td>
    <td>email</td>
    <td>password</td>
    <td>first_name</td>
    <td>last_name</td>
    <td>gender</td>
    <td>birth_year</td>
    <td>created_dt</td>
    <td>login_dt</td>
    <td>emailFlag1</td>
    <td>emailFlag1Date</td>
    <td>cronFlag</td>
  </tr>
  <?php do { ?>
  
	<?php

$colname_rsReminder = "-1";
if (isset($row_rsUsers['user_id'])) {
  $colname_rsReminder = (get_magic_quotes_gpc()) ? $row_rsUsers['user_id'] : addslashes($row_rsUsers['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsReminder = sprintf("SELECT * FROM lr_reminders WHERE user_id = %s", $colname_rsReminder);
$rsReminder = mysql_query($query_rsReminder, $conn) or die(mysql_error());
$row_rsReminder = mysql_fetch_assoc($rsReminder);
$totalRows_rsReminder = mysql_num_rows($rsReminder);
	?>
<?php if ($totalRows_rsReminder > 0) { ?>
<?php do { ?>
<?php 
	$message = "{$row_rsReminder['title']}
{$row_rsUsers['first_name']} is not alive today. He has send a special message for you. The message is:

{$row_rsReminder['message']}

File Link: {$row_rsReminder['fileLink']}

Thank You,
Life Reminder Admin

";
echo nl2br($message);
mail($row_rsReminder['emailTo'], $row_rsReminder['title'], $message, 'From: Admin<admin@lifereminder.tk>');

	?>
  <?php } while ($row_rsReminder = mysql_fetch_assoc($rsReminder)); ?>
<?php } ?>
    <tr>
      <td><?php echo $row_rsUsers['user_id']; ?></td>
      <td><?php echo $row_rsUsers['email']; ?></td>
      <td><?php echo $row_rsUsers['password']; ?></td>
      <td><?php echo $row_rsUsers['first_name']; ?></td>
      <td><?php echo $row_rsUsers['last_name']; ?></td>
      <td><?php echo $row_rsUsers['gender']; ?></td>
      <td><?php echo $row_rsUsers['birth_year']; ?></td>
      <td><?php echo $row_rsUsers['created_dt']; ?></td>
      <td><?php echo $row_rsUsers['login_dt']; ?></td>
      <td><?php echo $row_rsUsers['emailFlag1']; ?></td>
      <td><?php echo $row_rsUsers['emailFlag1Date']; ?></td>
      <td><?php echo $row_rsUsers['cronFlag']; ?></td>
    </tr>
	<?php
//update , cronFlag = 1;

$updateSQL = sprintf("UPDATE lr_users SET cronFlag = 1 WHERE user_id=%s",
				   GetSQLValueString($row_rsUsers['user_id'], "int"));

mysql_select_db($database_conn, $conn);
$Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
	?>
    <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
</table>
<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsers);

mysql_free_result($rsReminder);
?>