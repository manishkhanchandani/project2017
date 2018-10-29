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
	
	if (empty($_POST['user_addr'])) {
		$error .= 'Empty user location (please search and select from list), ';
	}
	
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
	if (empty($_POST['gender'])) {
		$error .= 'Empty gender, ';
	}
	
	$_POST['access_level'] = 'member';
	$_POST['uid'] = $_POST['email'];
	
	if (!empty($error)) {
		unset($_POST["MM_insert"]);
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	$email_verified_code = substr(md5(date('Y-m-d H:i:s').'-'.$_POST['email']), 3, 7);
  $insertSQL = sprintf("INSERT INTO users_auth (display_name, profile_img, email, provider_id, password, access_level, uid, logged_in_time, profile_uid, webReference, gender, user_country, user_state, user_county, user_city, user_addr, user_lat, user_lng, user_created_dt, email_verified, email_verified_code) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['display_name'], "text"),
                       GetSQLValueString($_POST['profile_img'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['provider_id'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString('member', "text"),
                       GetSQLValueString($_POST['uid'], "text"),
                       GetSQLValueString(time(), "int"),
                       GetSQLValueString($_POST['profile_uid'], "text"),
                       GetSQLValueString(WEBREFERENCE, "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['user_country'], "text"),
                       GetSQLValueString($_POST['user_state'], "text"),
                       GetSQLValueString($_POST['user_county'], "text"),
                       GetSQLValueString($_POST['user_city'], "text"),
                       GetSQLValueString($_POST['user_addr'], "text"),
                       GetSQLValueString($_POST['user_lat'], "double"),
                       GetSQLValueString($_POST['user_lng'], "double"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                       GetSQLValueString(0, "int"),
                       GetSQLValueString($email_verified_code, "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  $id = mysql_insert_id();
  mail($_POST['email'], 'Verify Email', 'Click here to verify your email. '.COMPLETE_HTTP_PATH.'?code='.$email_verified_code, 'From:Citygroups.us<admin@citygroups.us>');
  
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
<html><!-- InstanceBegin template="/Templates/citygroups.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<!--<script src="<?php echo HTTP_PATH; ?>js/parse-latest.js"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_KEY; ?>&libraries=places"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>
<!-- Firebase App is always required and must be first -->
<!--<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>-->

<!-- Add additional services that you want to use -->
<!--<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php //echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>-->

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'localHead.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<script>
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
	<!--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	
		<div class="panel panel-primary">
			<div class="panel-heading">3rd Party Login</div>
			<div class="panel-body">
				
				<h4><?php if (!empty($_SESSION['MM_DisplayName'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?></h4>
				<ul class="nav nav-sidebar">
				  <?php if (!empty($_SESSION['MM_DisplayName'])) { ?>
					  <li><a href="" onClick="signOut(); return false;">Signout</a></li>
				  <?php } else { ?>
					  <li><a href="" onClick="googleLogin(); return false;">Google Login</a></li>
					  <li><a href="" onClick="facebookLogin(); return false;">Facebook Login</a></li>
					  <li><a href="" onClick="twitterLogin(); return false;">Twitter Login</a></li>
					  <li><a href="" onClick="gitHubLogin(); return false;">Github Login</a></li>
				  <?php } ?>
				</ul>
				
				
				
				
			</div>
		</div>
	
	</div> -->
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	
	

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
			<input type="text" class="form-control" id="email2" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="real_name">Password:</label>
			<input type="password" class="form-control" id="password2" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ''; ?>" />
		</div>	
		<input type="hidden" name="MM_Login" value="1" />
		<input type="submit" name="Submit" value="Login" />
	</div>
</div>
</form>



<form id="form3" name="form3" method="POST" action="">
<div class="panel panel-primary">
	<div class="panel-heading">Forgot Password</div>
	<div class="panel-body">
<?php if (!empty($error3)) { ?>
<div class="alert alert-danger">
  <?php echo $error3; ?>
</div>
<?php } ?>
		<div class="form-group">
			<label for="display_name">Email:</label>
			<input type="text" class="form-control" id="email3" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" />
		</div>
		<input type="hidden" name="MM_Forgot" value="1" />
		<input type="submit" name="Submit" value="Send My Password" />
	</div>
</div>
</form>
	
	
	
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		


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
			<label for="autocomplete">Current City *:</label>
			<input type="text" class="form-control addressBox" id="autocomplete" name="location" onFocus="geolocate()" placeholder="enter city" value="<?php echo !empty($_POST['location']) ? $_POST['location'] : ''; ?>">
		</div>
		<div class="form-group">
			<label for="display_name">Email *:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="real_name">Password *:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ''; ?>" />
		</div>	
		<div class="form-group">
			<label for="real_name">Confirm Password *:</label>
			<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php echo (!empty($_POST['cpassword'])) ? $_POST['cpassword'] : ''; ?>" />
		</div>	
		<div class="form-group">
			<label for="display_name">Display Name *:</label>
			<input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="<?php echo (!empty($_POST['display_name'])) ? $_POST['display_name'] : ''; ?>" />
		</div>
		<div class="form-group">
			<label for="gender">Gender *:</label>
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
		<input type="hidden" name="user_country" id="user_country" value="<?php echo !empty($_POST['user_country']) ? $_POST['user_country'] : ''; ?>" />
		<input type="hidden" name="user_state" id="user_state" value="<?php echo !empty($_POST['user_state']) ? $_POST['user_state'] : ''; ?>" />
		<input type="hidden" name="user_county" id="user_county" value="<?php echo !empty($_POST['user_county']) ? $_POST['user_county'] : ''; ?>" />
		<input type="hidden" name="user_city" id="user_city" value="<?php echo !empty($_POST['user_city']) ? $_POST['user_city'] : ''; ?>" />
		<input type="hidden" name="user_addr" id="user_addr" value="<?php echo !empty($_POST['user_addr']) ? $_POST['user_addr'] : ''; ?>" />
		<input type="hidden" name="user_lat" id="user_lat" value="<?php echo !empty($_POST['user_lat']) ? $_POST['user_lat'] : ''; ?>" />
		<input type="hidden" name="user_lng" id="user_lng" value="<?php echo !empty($_POST['user_lng']) ? $_POST['user_lng'] : ''; ?>" />
	</div>
</div>
<input type="hidden" name="MM_insert" value="form2">


<script>
  $(document).on("keypress", 'form', function (e) {
	  var code = e.keyCode || e.which;
	  if (code == 13) {
		  var str = e.target.className;
		  var n = str.indexOf("addressBox");
		  if (n === -1) {
			return true;
		  } else {
			return false;
		  }
		  return true;
	  }
  });
  </script>
<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;

  function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical
	// location types.
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
		{types: ['(cities)']}); //{ types: ['(cities)'] }); //{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();
	//console.log('place is ', place);
	document.getElementById('user_lat').value = place.geometry.location.lat();
	document.getElementById('user_lng').value = place.geometry.location.lng();
	if (place.address_components) {
		for (let k in place.address_components) {
			let p = place.address_components[k];
			
			if (p.types[0] === 'locality') {
				document.getElementById('user_city').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_2') {
				document.getElementById('user_county').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_1') {
				document.getElementById('user_state').value = p.long_name;
			} else if (p.types[0] === 'country') {
				document.getElementById('user_country').value = p.long_name;
			}
			//console.log('addr is ', p.types[0], p.short_name, p.long_name);
		}
	}
	document.getElementById('user_addr').value = place.formatted_address;
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
		var geolocation = {
		  lat: position.coords.latitude,
		  lng: position.coords.longitude
		};
		var circle = new google.maps.Circle({
		  center: geolocation,
		  radius: position.coords.accuracy
		});
		autocomplete.setBounds(circle.getBounds());
	  });
	}
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_KEY; ?>&libraries=places&callback=initAutocomplete"
        async defer></script>
</form>

	
	</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
