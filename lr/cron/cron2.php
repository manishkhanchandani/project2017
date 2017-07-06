<?php require_once('../../Connections/conn.php'); ?>
<?php
$threeDays = time() - (60 * 60 * 24 * 3);// three days from today

$colname_rsUsers = "-1";
if (isset($threeDays)) {
  $colname_rsUsers = (get_magic_quotes_gpc()) ? $threeDays : addslashes($threeDays);
}
mysql_select_db($database_conn, $conn);
$query_rsUsers = sprintf("SELECT * FROM lr_users WHERE lr_users.emailFlag1 = 1 AND lr_users.emailFlag1Date < %s LIMIT 5", $colname_rsUsers);
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
<p>Record 1 user </p>
<p>For each record, go to lr_reminders table and send email to all the reminders for this user </p>
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
    <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsers);
?>