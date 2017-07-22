<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
$colname_rsEdit = "-1";
if (isset($_GET['email'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['email'] : addslashes($_GET['email']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM lr_users WHERE email = '%s'", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$status = '';
if ($totalRows_rsEdit > 0) {
	//send email
	
	$message = "Dear {$row_rsEdit['first_name']}
Your password is {$row_rsEdit['password']}.

Thanks	
";
mail($row_rsEdit['email'], 'Forgot Password', $message, 'From:admin<admin@lifereminder.tk>');
	
	$status = 'Password sent to your email successfully';
}


?><!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Forgot Password</title>
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
                <li><a href="../reminder/new_reminder.php">Create New Reminder</a></li>
                <li><a href="../reminder/list_reminders.php">My Reminders</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
			  	<?php if (empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="register.php">Register New User</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="forgot.php">Forgot Password</a></li>
				<?php } ?>
				<?php if (!empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
				<?php } ?>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- InstanceBeginEditable name="EditRegion3" -->
		<div class="container">
<div>
		  <h1>Forgot Password </h1>
		  <p><?php echo $status; ?></p>
		  <form method="get" name="form1">
            <table>
              <tr valign="baseline">
                <td nowrap align="right">Email:</td>
                <td><input type="text" name="email" id="email" size="32"></td>
              </tr>

              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input name="submit" type="submit" value="Send My Password"></td>
              </tr>
            </table>
	      </form>
		  <p></p>
		</div> 
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
