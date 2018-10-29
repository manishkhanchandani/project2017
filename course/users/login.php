<?php require_once('../../Connections/conn.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $loginUsername = $_POST['email'];
  $LoginRS__query = "SELECT uid FROM users_auth WHERE email='" . $loginUsername . "' AND webReference='".WEBREFERENCE."'";
  mysql_select_db($database_conn, $conn);
  $LoginRS=mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    unset($_POST[$MM_flag]);
	$error = 'Email already exists';
  }
}



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	$error = '';
	
	if (empty($_POST['email'])) {
		$error .= 'Empty email, ';
	}
	
	if (empty($_POST['password'])) {
		$error .= 'Empty password, ';
	}
	
	if (empty($_POST['cpassword'])) {
		$error .= 'Empty confirm password, ';
	}
	
	if ($_POST['password'] !== $_POST['cpassword']) {
		$error .= 'Password does not match with confirm password, ';
	}
	if (empty($_POST['display_name'])) {
		$error .= 'Empty display name, ';
	}
	
	$_POST['access_level'] = 'member';
	$_POST['uid'] = $_POST['email'];
	
	if (!empty($error)) {
		unset($_POST["MM_insert"]);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO users_auth (display_name, profile_img, email, provider_id, password, access_level, uid, logged_in_time, profile_uid, webReference, gender) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['display_name'], "text"),
                       GetSQLValueString($_POST['profile_img'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['provider_id'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString('member', "text"),
                       GetSQLValueString($_POST['uid'], "text"),
                       GetSQLValueString($_POST['logged_in_time'], "int"),
                       GetSQLValueString($_POST['profile_uid'], "text"),
                       GetSQLValueString(WEBREFERENCE, "text"),
                       GetSQLValueString($_POST['gender'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  $id = mysql_insert_id();
  
    $_SESSION['MM_Username'] = $_POST['email'];
    $_SESSION['MM_UserGroup'] = $_POST['access_level'];
	$_SESSION['MM_Username'] = $_POST['display_name'];
	$_SESSION['MM_Email'] = $_POST['email'];
    $_SESSION['MM_UserGroup'] = $_POST['access_level'];
	$_SESSION['MM_UserId'] = $id;
	$_SESSION['MM_DisplayName'] = $_POST['display_name'];
	$_SESSION['MM_ProfileImg'] = $_POST['profile_img'];
	$_SESSION['MM_UID'] = $_POST['uid'];
	$_SESSION['MM_LoggedInTime'] = $_POST['logged_in_time'];
	$_SESSION['MM_ProfileUID'] = $_POST['profile_uid'];  

  $MM_redirectLoginSuccess = "../index.php";
    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
	exit;
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['MM_Login'])) {
	$error2 = '';
	
	if (empty($_POST['email'])) {
		$error2 .= 'Empty email, ';
	}
	
	if (empty($_POST['password'])) {
		$error2 .= 'Empty password, ';
	}
	
	if (empty($error2)) {
	
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "access_level";
  $MM_redirectLoginSuccess = "../index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conn, $conn);
  	
  $LoginRS__query=sprintf("SELECT * FROM users_auth WHERE email='%s' AND password='%s' AND webReference='%s' AND provider_id = 'email1'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password), get_magic_quotes_gpc() ? WEBREFERENCE : addslashes(WEBREFERENCE)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
  	$rec = mysql_fetch_array($LoginRS);
    
    //declare two session variables and assign them
    $_SESSION['MM_UserGroup'] = $rec['access_level'];
	$_SESSION['MM_Username'] = $rec['display_name'];
	$_SESSION['MM_Email'] = $rec['email'];
	$_SESSION['MM_UserId'] = $rec['user_id'];
	$_SESSION['MM_DisplayName'] = $rec['display_name'];
	$_SESSION['MM_ProfileImg'] = $rec['profile_img'];
	$_SESSION['MM_UID'] = $rec['uid'];
	$_SESSION['MM_LoggedInTime'] = $rec['logged_in_time'];
	$_SESSION['MM_ProfileUID'] = $rec['profile_uid'];     
	
	
	$time = time() + (60* 60* 24 * 7);
	$suffix = '_V1';
	setcookie('MM_Username'.$suffix, $_SESSION['MM_Username'], $time, '/');
	setcookie('MM_Email'.$suffix, $_SESSION['MM_Email'], $time, '/');
	setcookie('MM_UserGroup'.$suffix, $_SESSION['MM_UserGroup'], $time, '/');
	setcookie('MM_UserId'.$suffix, $_SESSION['MM_UserId'], $time, '/');
	setcookie('MM_DisplayName'.$suffix, $_SESSION['MM_DisplayName'], $time, '/');
	setcookie('MM_ProfileImg'.$suffix, $_SESSION['MM_ProfileImg'], $time, '/');
	setcookie('MM_UID'.$suffix, $_SESSION['MM_UID'], $time, '/');
	setcookie('MM_LoggedInTime'.$suffix, $_SESSION['MM_LoggedInTime'], $time, '/');
	setcookie('MM_ProfileUID'.$suffix, $_SESSION['MM_ProfileUID'], $time, '/');

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
  echo 'failed';exit;
    header("Location: ". $MM_redirectLoginFailed );
  }
	}
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/course.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<script src="<?php echo HTTP_PATH; ?>js/parse-latest.js"></script>
<script>
Parse.initialize("myAppID");
Parse.serverURL = "https://mkparse.info/parse";
$(document).ready(function() {
	$("#buttonEl").on("click", function() {
		
		var fileUploadControl = $("#inputEl")[0];
		if (fileUploadControl.files.length > 0) {
			var file = fileUploadControl.files[0];
			var name = file.name;
			
			var parseFile = new Parse.File(name, file);
			parseFile.save().then(() => {
				$("#imageEl").attr("src", parseFile.url());
				$("#profile_img").val(parseFile.url());
			});
		}
	});
});
</script>

<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Login/Register</h1>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	
		<div class="panel panel-primary">
			<div class="panel-heading">3rd Party Login</div>
			<div class="panel-body">
				
				<h4><?php if (!empty($_SESSION['MM_DisplayName'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?></h4>
				<ul class="nav nav-sidebar">
				  <?php if (!empty($_SESSION['MM_DisplayName'])) { ?>
					  <li><a href="" onClick="signOut(); return false;">Signout</a></li>
				  <?php } else { ?>
					  <li><a href="" onClick="googleLogin(); return false;">Google Login</a></li>
					  <!--<li><a href="" onClick="facebookLogin(); return false;">Facebook Login</a></li> -->
					  <li><a href="" onClick="twitterLogin(); return false;">Twitter Login</a></li>
					  <li><a href="" onClick="gitHubLogin(); return false;">Github Login</a></li>
				  <?php } ?>
				</ul>
				
				
				
				
			</div>
		</div>
	
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	
	
<?php if (empty($_SESSION['MM_DisplayName'])) { ?>

<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<div class="panel panel-primary">
	<div class="panel-heading">Login</div>
	<div class="panel-body">
<?php if (!empty($error2)) { ?>
<div class="alert alert-danger">
  <?php echo $error2; ?>
</div>
<?php } ?>
		<div class="form-group">
			<label for="display_name">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="real_name">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ''; ?>" />
		</div>	
		<input type="hidden" name="MM_Login" value="1" />
		<input type="submit" name="Submit" value="Login" />
	</div>
</div>
</form>
<?php } ?>
	
	
	
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		

<?php if (empty($_SESSION['MM_DisplayName'])) { ?>

<form id="form2" name="form2" method="POST" action="<?php echo $editFormAction; ?>">
<div class="panel panel-primary">
	<div class="panel-heading">Register</div>
	<div class="panel-body">
<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>
		<div class="form-group">
			<label for="display_name">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="real_name">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ''; ?>" />
		</div>	
		<div class="form-group">
			<label for="real_name">Confirm Password:</label>
			<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php echo (!empty($_POST['cpassword'])) ? $_POST['cpassword'] : ''; ?>" />
		</div>	
		<div class="form-group">
			<label for="display_name">Display Name:</label>
			<input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="<?php echo (!empty($_POST['display_name'])) ? $_POST['display_name'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="gender">Gender:</label>
			<input type="radio" id="gender1" name="gender" placeholder="Gender" value="male" <?php echo (!empty($_POST['gender']) && $_POST['gender'] === 'male') ? 'checked' : ''; ?> /> Male 
			<input type="radio" id="gender2" name="gender" placeholder="Gender" value="female" <?php echo (!empty($_POST['gender']) && $_POST['gender'] === 'female') ? 'checked' : ''; ?> /> Female
		</div>
		<div class="form-group">
			<label for="display_name">Profile Image:</label>
			<input type="text" id="profile_img" name="profile_img" placeholder="Profile Image Url" value="<?php echo (!empty($_POST['profile_img'])) ? $_POST['profile_img'] : ''; ?>" />
			<!--<div>
				<img class="img-responsive img-thumbnail" src="" alt="" id="imageEl" />
			</div>
			<div>
			<input type="file" id="inputEl" name="inputEl" />
			<input type="button" id="buttonEl" name="buttonEl" value="Upload" />
			</div> -->
		</div>
		<input type="submit" name="Submit" value="Register" />
		<input type="hidden" name="provider_id" value="email1" />
		<input type="hidden" name="access_level" value="member" />
		<input type="hidden" name="uid" value="" />
		<input type="hidden" name="profile_uid" value="" />
		<input type="hidden" name="logged_in_time" value="<?php echo time(); ?>" />
	</div>
</div>
<input type="hidden" name="MM_insert" value="form2">
</form>
<?php } ?>
	
	</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
