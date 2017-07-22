<?php require_once('../../Connections/conn.php'); ?>
<?php
// on dec 1, sep 1, jan, oct 1

$pastDate = time() - (60 * 60 * 24 * 90);

// if i have many users, then following page will break, because it takes time to send email to all the users

//cron for 1 hour 15 or 1 min, 5 user cron run time
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
?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsRecord = "SELECT * FROM lr_users WHERE login_dt < $pastDate AND emailFlag1 = 0 LIMIT 5";
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
  	$message = "Dear {$row_rsRecord['first_name']},

You haven't logged in on our website (http://lifereminder.tk/users/login.php). Are you really alive. If yes, then go and login to our website to confirm that you are alive.

Thank you,
Administrator
";
mail($row_rsRecord['email'], 'Life Reminder, Are you Alive?', $message, 'From: Administrator<admin@lifereminder.tk>');
	//update the table with emailFlag1 = 1 and emailflag1Date = current time


$updateSQL = sprintf("UPDATE lr_users SET emailFlag1 = 1, emailFlag1Date = %s WHERE user_id=%s",
				   GetSQLValueString(time(), "int"),
				   GetSQLValueString($row_rsRecord['user_id'], "int"));

mysql_select_db($database_conn, $conn);
$Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
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
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsRecord);
?>