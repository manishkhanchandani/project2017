<?php require_once('../../Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsRecord = "SELECT * FROM lr_users  WHERE login_dt < 1491369252 AND emailFlag1 = 0";
$rsRecord = mysql_query($query_rsRecord, $conn) or die(mysql_error());
$row_rsRecord = mysql_fetch_assoc($rsRecord);
$totalRows_rsRecord = mysql_num_rows($rsRecord);
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HTML 5</title>

</head>

<body>
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
  	$message = "dfdkfdjfkdjfk";
  	@mail($row_rsRecord['email'], 'Life Reminder, Are you Alive?', $message, 'From: Administrator<admin@lifereminder.com>');
	//update the table with emailFlag1 = 1 and emailflag1Date = current time
  ?>
    <tr>
      <td><?php echo $row_rsRecord['user_id']; ?></td>
      <td><?php echo $row_rsRecord['email']; ?></td>
      <td><?php echo $row_rsRecord['password']; ?></td>
      <td><?php echo $row_rsRecord['first_name']; ?></td>
      <td><?php echo $row_rsRecord['last_name']; ?></td>
      <td><?php echo $row_rsRecord['gender']; ?></td>
      <td><?php echo $row_rsRecord['birth_year']; ?></td>
      <td><?php echo $row_rsRecord['created_dt']; ?></td>
      <td><?php echo $row_rsRecord['login_dt']; ?></td>
      <td><?php echo $row_rsRecord['emailFlag1']; ?></td>
      <td><?php echo $row_rsRecord['emailFlag1Date']; ?></td>
      <td><?php echo $row_rsRecord['cronFlag']; ?></td>
    </tr>
    <?php } while ($row_rsRecord = mysql_fetch_assoc($rsRecord)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsRecord);
?>