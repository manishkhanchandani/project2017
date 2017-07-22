<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register_failure.php";
  $loginUsername = $_POST['email'];
  $LoginRS__query = "SELECT email FROM lr_users WHERE email='" . $loginUsername . "'";
  mysql_select_db($database_conn, $conn);
  $LoginRS=mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formRegister")) {
  $insertSQL = sprintf("INSERT INTO lr_users (email, password, first_name, last_name, gender, birth_year, created_dt, login_dt) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['birth_year'], "int"),
                       GetSQLValueString($_POST['created_dt'], "date"),
                       GetSQLValueString($_POST['login_dt'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "register_success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Register Now</title>
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
<div class="row">
			<div class="col-md-12">
				<h3>Register As New User</h3>
				<form method="POST" name="formRegister" id="formRegister" action="<?php echo $editFormAction; ?>">
				  <div class="form-group">
					<label for="email">Email address</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email">
				  </div>
				  <div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  </div>
				  <div class="form-group">
					<label for="confirm_password">Confirm Password</label>
					<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
				  </div>
				  <div class="form-group">
					<label for="first_name">First Name</label>
					<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
				  </div>
				  <div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
				  </div>
				  <div class="form-group">
					<label>Gender</label>
					<div>
					<input type="radio" name="gender" id="gender_male" value="male" checked> Male <input type="radio" name="gender" id="gender_female" value="female"> Female</div>
				  </div>
				  <div class="form-group">
					<label for="birth_year">Birth Year</label>
					<input type="number" class="form-control" id="birth_year" name="birth_year" placeholder="Birth Year">
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" id="terms"> I accept the terms and conditions
					</label>
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				  <input name="created_dt" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>">
				  <input name="login_dt" type="hidden" value="<?php echo time(); ?>">
				  <input type="hidden" name="MM_insert" value="formRegister">
			  </form>
			</div>
		</div>
</div> 
	<!-- InstanceEndEditable -->
	
	<footer>
		<p>Life Reminder : Copyright &copy; 2017 - <a href="#">Terms</a> | <a href="#">Privacy</a></p>
	</footer>
</body>
<!-- InstanceEnd --></html>
