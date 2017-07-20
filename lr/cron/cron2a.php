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


$maxRows_rsUsers = 5;
$pageNum_rsUsers = 0;
if (isset($_GET['pageNum_rsUsers'])) {
  $pageNum_rsUsers = $_GET['pageNum_rsUsers'];
}
$startRow_rsUsers = $pageNum_rsUsers * $maxRows_rsUsers;

$colname_rsUsers = "-1";
if (isset($threeDays)) {
  $colname_rsUsers = (get_magic_quotes_gpc()) ? $threeDays : addslashes($threeDays);
}
mysql_select_db($database_conn, $conn);
$query_rsUsers = sprintf("SELECT * FROM lr_users WHERE lr_users.emailFlag1 = 1 AND lr_users.emailFlag1Date < %s AND lr_users.cronFlag = 0", $colname_rsUsers);
$query_limit_rsUsers = sprintf("%s LIMIT %d, %d", $query_rsUsers, $startRow_rsUsers, $maxRows_rsUsers);
$rsUsers = mysql_query($query_limit_rsUsers, $conn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);

if (isset($_GET['totalRows_rsUsers'])) {
  $totalRows_rsUsers = $_GET['totalRows_rsUsers'];
} else {
  $all_rsUsers = mysql_query($query_rsUsers);
  $totalRows_rsUsers = mysql_num_rows($all_rsUsers);
}
$totalPages_rsUsers = ceil($totalRows_rsUsers/$maxRows_rsUsers)-1;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>cron 2</h1>
<p>&nbsp;</p>

<?php if ($totalRows_rsUsers > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>user_id</td>
      <td>email</td>
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
	
$colname_rsReminders = "-1";
if (isset($row_rsUsers['user_id'])) {
  $colname_rsReminders = (get_magic_quotes_gpc()) ? $row_rsUsers['user_id'] : addslashes($row_rsUsers['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsReminders = sprintf("SELECT * FROM lr_reminders WHERE user_id = %s", $colname_rsReminders);
$rsReminders = mysql_query($query_rsReminders, $conn) or die(mysql_error());
$row_rsReminders = mysql_fetch_assoc($rsReminders);
$totalRows_rsReminders = mysql_num_rows($rsReminders);
	?>
	
<?php if ($totalRows_rsReminders > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>reminder_id</td>
      <td>user_id</td>
      <td>title</td>
      <td>emailTo</td>
      <td>message</td>
      <td>fileLink</td>
      <td>status</td>
      <td>reminder_created_dt</td>
        </tr>
      <?php do { ?>
	  
	  <?php 
	$message = "{$row_rsReminders['title']}
{$row_rsUsers['first_name']} is not alive today. He has send a special message for you. The message is:

{$row_rsReminders['message']}

File Link: {$row_rsReminders['fileLink']}

Thank You,
Life Reminder Admin

";
echo nl2br($message);
mail($row_rsReminder['emailTo'], $row_rsReminder['title'], $message, 'From: Admin<admin@lifereminder.com>');

	?>
	
          <tr>
            <td><?php echo $row_rsReminders['reminder_id']; ?></td>
            <td><?php echo $row_rsReminders['user_id']; ?></td>
            <td><?php echo $row_rsReminders['title']; ?></td>
            <td><?php echo $row_rsReminders['emailTo']; ?></td>
            <td><?php echo $row_rsReminders['message']; ?></td>
            <td><?php echo $row_rsReminders['fileLink']; ?></td>
            <td><?php echo $row_rsReminders['status']; ?></td>
            <td><?php echo $row_rsReminders['reminder_created_dt']; ?></td>
          </tr>
          <?php } while ($row_rsReminders = mysql_fetch_assoc($rsReminders)); ?>
      </table>
  <?php } // Show if recordset not empty ?>
  
  <?php
//update , cronFlag = 1;

$updateSQL = sprintf("UPDATE lr_users SET cronFlag = 1 WHERE user_id=%s",
				   GetSQLValueString($row_rsUsers['user_id'], "int"));

mysql_select_db($database_conn, $conn);
$Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
	?>
  
      <tr>
        <td><?php echo $row_rsUsers['user_id']; ?></td>
        <td><?php echo $row_rsUsers['email']; ?></td>
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
      <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysql_free_result($rsUsers);
?>
