<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$error = '';
	if ($_SESSION['MM_UserId'] <= 0) {
		$error .= 'Invalid User, ';
	}

	if (empty($_POST['display_name'])) {
		$error .= 'Empty Display Name, ';
	}
	
	if (empty($_POST['prof_lat'])) {
		$error .= 'Empty Location, ';
	}
	
	if (empty($_POST['real_name'])) {
		$error .= 'Empty Real Name, ';
	}
	if (empty($_POST['price_60_min'])) {
		$error .= 'Price 60 min is missing, ';
	}
	
	$_POST['view_images'] = array_filter($_POST['view_images']);
	$_POST['view_videos'] = array_filter($_POST['view_videos']);
	$_POST['view_links'] = array_filter($_POST['view_links']);
	
	$_POST['view_images'] = json_encode($_POST['view_images']);
	$_POST['view_videos'] = json_encode($_POST['view_videos']);
	$_POST['view_links'] = json_encode($_POST['view_links']);
	
	$bh = array(
		'startTime' => $_POST['startTime'],
		'endTime' => $_POST['endTime'],
		'hstatus' => $_POST['hstatus']
	);
	
	$_POST['business_hours'] = json_encode($bh);

	if (!empty($error)) {
		unset($_POST['MM_insert']);
	}
	
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_classified (user_id, is_public, view_images, view_videos, view_links, prof_type, display_name, description, location, prof_lat, prof_lng, travel_radius, work_travel, work_business, pref_no_pref, pref_male, pref_female, gender, type_swedish, type_deep, type_thai, type_sports, type_pregnancy, type_reflexology, type_medical, type_hotstone, goal_relaxation, goal_flexibility, goal_pain, price_60_min, price_90_min, price_120_min, mas_type_ind, mas_type_cpl, discount_5_sess, discount_10_sess, discount_20_sess, business_hours, apointment_same_day, prof_country, prof_state, prof_county, prof_city, prof_addr, currency_type, real_name, id_proof_url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['is_public'], "int"),
                       GetSQLValueString($_POST['view_images'], "text"),
                       GetSQLValueString($_POST['view_videos'], "text"),
                       GetSQLValueString($_POST['view_links'], "text"),
                       GetSQLValueString($_POST['prof_type'], "text"),
                       GetSQLValueString($_POST['display_name'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['prof_lat'], "double"),
                       GetSQLValueString($_POST['prof_lng'], "double"),
                       GetSQLValueString($_POST['travel_radius'], "int"),
                       GetSQLValueString(isset($_POST['work_travel']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['work_business']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['pref_no_pref']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['pref_male']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['pref_female']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString(isset($_POST['type_swedish']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_deep']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_thai']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_sports']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_pregnancy']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_reflexology']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_medical']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_hotstone']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['goal_relaxation']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['goal_flexibility']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['goal_pain']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['price_60_min'], "double"),
                       GetSQLValueString($_POST['price_90_min'], "double"),
                       GetSQLValueString($_POST['price_120_min'], "double"),
                       GetSQLValueString(isset($_POST['mas_type_ind']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['mas_type_cpl']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['discount_5_sess'], "double"),
                       GetSQLValueString($_POST['discount_10_sess'], "double"),
                       GetSQLValueString($_POST['discount_20_sess'], "double"),
                       GetSQLValueString($_POST['business_hours'], "text"),
                       GetSQLValueString(isset($_POST['apointment_same_day']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['prof_country'], "text"),
                       GetSQLValueString($_POST['prof_state'], "text"),
                       GetSQLValueString($_POST['prof_county'], "text"),
                       GetSQLValueString($_POST['prof_city'], "text"),
                       GetSQLValueString($_POST['prof_addr'], "text"),
                       GetSQLValueString($_POST['currency_type'], "text"),
                       GetSQLValueString($_POST['real_name'], "text"),
                       GetSQLValueString($_POST['id_proof_url'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  $id = mysql_insert_id();
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($_FILES['userfile']) && !empty($_FILES['userfile']['tmp_name'])) {
	$ext = strrchr($_FILES['userfile']['name'], '.');
	if (!is_dir('../files/user_'.$_SESSION['MM_UserId'])) {
		mkdir('../files/user_'.$_SESSION['MM_UserId'], 0777);
		chmod('../files/user_'.$_SESSION['MM_UserId'], 0777);
	}
	
	$lpath = 'files/user_'.$_SESSION['MM_UserId'].'/file_'.$id.$ext;
	$path = '../'.$lpath;
	move_uploaded_file($_FILES['userfile']['tmp_name'], $path);
	$_POST['id_proof_url'] = $lpath;
	mysql_query("update s_classified set id_proof_url = '".$lpath."' WHERE profession_id = ".$id);
}

?><!doctype html>
<html><!-- InstanceBegin template="/Templates/ineedmassage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Providers : Create New Profile</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<link href="<?php echo HTTP_PATH; ?>js/timepicker/1.2.17/jquery.timepicker.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo HTTP_PATH; ?>js/timepicker/1.2.17/jquery.timepicker.min.js"></script>
<link href="<?php echo HTTP_PATH; ?>js/businessHours/jquery.businessHours.css" rel="stylesheet" type="text/css">
<script src="<?php echo HTTP_PATH; ?>js/businessHours/jquery.businessHours.js"></script>

<style type="text/css">
	.colorBox.WorkingDayState {
		background-color: #4caf50;
	}
</style>
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="provider_create">
	<h1 class="page-header">Create New Provider Profile</h1>
<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($id) && empty($error)) { ?>
<script>
function providerProfile() {
	let url = '<?php echo FIREBASE_BASEPATH; ?>/s_classified/<?php echo 'post_'.$id; ?>';
	let obj = {};
	obj.is_public = <?php echo $_POST['is_public']; ?>;
    obj.display_name = '<?php echo $_POST['display_name']; ?>';
    obj.real_name = '<?php echo $_POST['real_name']; ?>';
	obj.description = '<?php echo $_POST['description']; ?>';
	obj.location = '<?php echo $_POST['location']; ?>';
	obj.travel_radius = <?php echo $_POST['travel_radius']; ?>;
	obj.work_business = <?php echo !empty($_POST['work_business']) ? 1 : 0; ?>;
	obj.work_travel = <?php echo !empty($_POST['work_travel']) ? 1 : 0; ?>;
	obj.pref_no_pref = <?php echo !empty($_POST['pref_no_pref']) ? 1 : 0; ?>;
	obj.pref_female = <?php echo !empty($_POST['pref_female']) ? 1 : 0; ?>;
	obj.pref_male = <?php echo !empty($_POST['pref_male']) ? 1 : 0; ?>;
	obj.gender = '<?php echo $_POST['gender']; ?>';
	obj.type_swedish = <?php echo !empty($_POST['type_swedish']) ? 1 : 0; ?>;
	obj.type_deep = <?php echo !empty($_POST['type_deep']) ? 1 : 0; ?>;
	obj.type_thai = <?php echo !empty($_POST['type_thai']) ? 1 : 0; ?>;
	obj.type_sports = <?php echo !empty($_POST['type_sports']) ? 1 : 0; ?>;
	obj.type_pregnancy = <?php echo !empty($_POST['type_pregnancy']) ? 1 : 0; ?>;
	obj.type_reflexology = <?php echo !empty($_POST['type_reflexology']) ? 1 : 0; ?>;
	obj.type_medical = <?php echo !empty($_POST['type_medical']) ? 1 : 0; ?>;
	obj.type_hotstone = <?php echo !empty($_POST['type_hotstone']) ? 1 : 0; ?>;
	obj.goal_relaxation = <?php echo !empty($_POST['goal_relaxation']) ? 1 : 0; ?>;
	obj.goal_flexibility = <?php echo !empty($_POST['goal_flexibility']) ? 1 : 0; ?>;
	obj.goal_pain = <?php echo !empty($_POST['goal_pain']) ? 1 : 0; ?>;
	obj.mas_type_ind = <?php echo !empty($_POST['mas_type_ind']) ? 1 : 0; ?>;
	obj.mas_type_cpl = <?php echo !empty($_POST['mas_type_cpl']) ? 1 : 0; ?>;
	obj.currency_type = '<?php echo $_POST['currency_type']; ?>';
	obj.price_60_min = '<?php echo $_POST['price_60_min']; ?>';
	obj.price_90_min = '<?php echo $_POST['price_90_min']; ?>';
	obj.price_120_min = '<?php echo $_POST['price_120_min']; ?>';
	obj.discount_5_sess = '<?php echo $_POST['discount_5_sess']; ?>';
	obj.discount_10_sess = '<?php echo $_POST['discount_10_sess']; ?>';
	obj.discount_20_sess = '<?php echo $_POST['discount_20_sess']; ?>';
	obj.apointment_same_day = <?php echo !empty($_POST['apointment_same_day']) ? 1 : 0; ?>;
	obj.view_images = '<?php echo $_POST['view_images']; ?>';
	obj.view_videos = '<?php echo $_POST['view_videos']; ?>';
	obj.view_links = '<?php echo $_POST['view_links']; ?>';
	obj.prof_country = '<?php echo $_POST['prof_country']; ?>';
	obj.prof_state = '<?php echo $_POST['prof_state']; ?>';
	obj.prof_county = '<?php echo $_POST['prof_county']; ?>';
	obj.prof_city = '<?php echo $_POST['prof_city']; ?>';
	obj.prof_addr = '<?php echo $_POST['prof_addr']; ?>';
	obj.user_id = '<?php echo $_POST['user_id']; ?>';
	obj.prof_type = '<?php echo $_POST['prof_type']; ?>';
	obj.prof_lat = '<?php echo $_POST['prof_lat']; ?>';
	obj.prof_lng = '<?php echo $_POST['prof_lng']; ?>';
	obj.business_hours = '<?php echo $_POST['business_hours']; ?>';
	obj.id_proof_url = '<?php echo $_POST['id_proof_url']; ?>';
	firebaseDatabase.ref(url).set(obj);
}
//providerProfile();
</script>
<meta http-equiv="refresh" content="3;URL=../index.php">
<div class="alert alert-success">
  <strong>Success!</strong> Profile created successfully. Redirecting you to main page ....
</div>
<?php } else { ?>

<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>

<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1">
	<div class="row">
		<div class="col-sm-12 col-md-4 col-xs-12 col-lg-4">
		
				<div class="panel panel-primary">
					<div class="panel-heading">Personal Info</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="display_name">Display Name (Shown to users):</label>
							<input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="<?php echo (!empty($_POST['display_name'])) ? $_POST['display_name'] : ''; ?>" />
						</div>
						<div class="form-group">
							<label for="real_name">Real Name (Will not be shown to users):</label>
							<input type="text" class="form-control" id="real_name" name="real_name" placeholder="Real Name" value="<?php echo (!empty($_POST['real_name'])) ? $_POST['real_name'] : ''; ?>" />
						</div>						
						<div class="form-group">
							<label>Upload ID Proof (*):</label>
							<input type="file" name="userfile" id="userfile" class="form-control">					    
						</div>
						<div class="form-group">
							<label for="description">Description:</label>
							<textarea class="form-control" id="description" rows="5" name="description"><?php echo (!empty($_POST['description'])) ? $_POST['description'] : ''; ?></textarea>
						</div> 
					</div>
				</div>
		
				<div class="panel panel-primary">
					<div class="panel-heading">Travel Preference</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="autocomplete">Business or Current Location:</label>
							<input type="text" class="form-control addressBox" id="autocomplete" name="location" onFocus="geolocate()" placeholder="enter address" value="<?php echo !empty($_POST['location']) ? $_POST['location'] : ''; ?>">
						</div>
						<div class="form-group">
							<label for="travel_radius">How Far you can travel to reach the client (in miles):</label>
							<input type="number" class="form-control" id="travel_radius" name="travel_radius" value="<?php echo (!empty($_POST['travel_radius'])) ? $_POST['travel_radius'] : 100; ?>" />
						</div>
						<div class="form-group">
							
							<label class="page-header">Where do you provide massages?</label>
							<label for="work_business" class="myLabel">At my business location: <input type="checkbox"  id="work_business" name="work_business" checked="checked" /></label>
							<label for="work_travel" class="myLabel">At client's home or business location: <input type="checkbox"  id="work_travel" name="work_travel" checked="checked" /></label>
						</div>
					</div>
				</div>
		
		
				<div class="panel panel-primary">
					<div class="panel-heading">Show/Hide</div>
					<div class="panel-body">
						<label for="is_public_1" class="myLabel">Public <input name="is_public" id="is_public_1" type="radio" value="1" checked /></label>						
						<label for="is_public_2" class="myLabel">Private <input name="is_public" id="is_public_2" type="radio" value="0" /></label>
					</div>
				</div>
				
		
		
		</div>
		<div class="col-sm-12 col-md-4 col-xs-12 col-lg-4">
		
				<div class="panel panel-primary">
					<div class="panel-heading">Job Preference</div>
					<div class="panel-body">
					
						<div class="form-group">							
							<label class="page-header">Which clients do you work with?</label>
							<label for="pref_no_pref" class="myLabel">Clients who have no preference: <input type="checkbox"  id="pref_no_pref" name="pref_no_pref" checked="checked" /></label>
							<label for="pref_female" class="myLabel">Clients who want female massage therapists only: <input type="checkbox"  id="pref_female" name="pref_female" checked="checked" /></label>
							<label for="pref_male" class="myLabel">Clients who want male massage therapists only: <input type="checkbox"  id="pref_male" name="pref_male" checked="checked" /></label>							
						</div>
						<div class="form-group">
							<label for="gender">Gender:</label>
							<select name="gender" id="gender" class="form-control">
								<option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
								<option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
							</select>  
						</div>
						<div class="form-group">
							<label class="page-header">Which types of massage do you offer?</label>
							<label for="type_swedish" class="myLabel">Swedish massage (standard): <input type="checkbox"  id="type_swedish" name="type_swedish" checked="checked" /></label>
							<label for="type_deep" class="myLabel">Deep tissue massage: <input type="checkbox"  id="type_deep" name="type_deep" checked="checked" /></label>
							<label for="type_thai" class="myLabel">Thai massage: <input type="checkbox"  id="type_thai" name="type_thai" checked="checked" /></label>
							<label for="type_sports" class="myLabel">Sports massage: <input type="checkbox"  id="type_sports" name="type_sports" checked="checked" /></label>
							<label for="type_pregnancy" class="myLabel">Pregnancy massage: <input type="checkbox"  id="type_pregnancy" name="type_pregnancy" checked="checked" /></label>
							<label for="type_reflexology" class="myLabel">Reflexology massage: <input type="checkbox"  id="type_reflexology" name="type_reflexology" checked="checked" /></label>
							<label for="type_medical" class="myLabel">Medical massage: <input type="checkbox"  id="type_medical" name="type_medical" checked="checked" /></label>
							<label for="type_hotstone" class="myLabel">Hot stone massage: <input type="checkbox"  id="type_hotstone" name="type_hotstone" checked="checked" /></label>							
						</div>						
						<div class="form-group">
							<label class="page-header">Which clients do you work with?</label>
							<label for="goal_relaxation" class="myLabel">Relaxation / stress relief: <input type="checkbox"  id="goal_relaxation" name="goal_relaxation" checked="checked" /></label>
							<label for="goal_flexibility" class="myLabel">Increased flexibility: <input type="checkbox"  id="goal_flexibility" name="goal_flexibility" checked="checked" /></label>
							<label for="goal_pain" class="myLabel">Pain relief: <input type="checkbox"  id="goal_pain" name="goal_pain" checked="checked" /></label>
						</div>		
						<div class="form-group">
							<label class="page-header">What types of massage do you offer?</label>
							<label for="mas_type_ind" class="myLabel">Individual massage: <input type="checkbox"  id="mas_type_ind" name="mas_type_ind" checked="checked" /></label>
							<label for="mas_type_cpl" class="myLabel">Couples massage: <input type="checkbox"  id="mas_type_cpl" name="mas_type_cpl" checked="checked" /></label>
						</div>
					
					</div>
				</div>
		
		
		
				
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>
		<div class="col-sm-12 col-md-4 col-xs-12 col-lg-4">
				
				<div class="panel panel-primary">
					<div class="panel-heading">Prices</div>
					<div class="panel-body">					
						<div class="form-group">
							<label for="currency_type">Currency Type:</label>
							<input type="text" class="form-control" id="currency_type" name="currency_type" placeholder="$" value="<?php echo (!empty($_POST['description'])) ? $_POST['description'] : '$'; ?>" />
						</div>
						<div class="form-group">
							<label for="price_60_min">Price 60 min:</label>
							<input type="text" class="form-control" id="price_60_min" name="price_60_min" value="<?php echo (!empty($_POST['price_60_min'])) ? $_POST['price_60_min'] : ''; ?>" />
						</div>
						<div class="form-group">
							<label for="price_90_min">Price 90 min:</label>
							<input type="text" class="form-control" id="price_90_min" name="price_90_min" value="<?php echo (!empty($_POST['price_90_min'])) ? $_POST['price_90_min'] : ''; ?>" />
						</div>
						<div class="form-group">
							<label for="price_120_min">Price 120 min:</label>
							<input type="text" class="form-control" id="price_120_min" name="price_120_min" value="<?php echo (!empty($_POST['price_120_min'])) ? $_POST['price_120_min'] : ''; ?>" />
						</div>
						<div class="form-group">								
							<label class="page-header">Discount for session packages (Let customers know about any discounts)?</label>
							<label for="discount_10_sess" class="myLabel">5 sessions: <input type="text"  id="discount_5_sess" name="discount_5_sess" placeholder="0 (in %)" value="<?php echo (!empty($_POST['discount_5_sess'])) ? $_POST['discount_5_sess'] : ''; ?>" /></label>
							<label for="discount_10_sess" class="myLabel">10 sessions: <input type="text"  id="discount_10_sess" name="discount_10_sess" placeholder="0 (in %)" value="<?php echo (!empty($_POST['discount_10_sess'])) ? $_POST['discount_10_sess'] : ''; ?>" /></label>
							<label for="discount_20_sess" class="myLabel">20 sessions: <input type="text"  id="discount_20_sess" name="discount_20_sess" placeholder="0 (in %)" value="<?php echo (!empty($_POST['discount_20_sess'])) ? $_POST['discount_20_sess'] : ''; ?>" /></label>
							
						</div>
						<div class="form-group">
							<label for="apointment_same_day" class="myLabel">Same Day Appointment: <input type="checkbox"  id="apointment_same_day" name="apointment_same_day" checked="checked" /></label>
						</div>
						
						
					</div>
				</div>
				
				
				
				
				
				
				
				
				
				<div class="panel panel-primary">
					<div class="panel-heading">Media</div>
					<div class="panel-body">
						
						<div class="form-group">
							<label>Images:</label>
							<div id="images">
								<input name="view_images[]" type="text" id="view_images[]" placeholder="Add Image URL" />
								<input name="moreImage" type="button" id="moreImage" value="Add More Images" onClick="addMoreImages();" />
							</div>
							<div id="images2" style="display:none;"> <br />
									<input name="view_images[]" type="text" id="view_images[]" placeholder="Add Image URL" />
							</div>
						</div>
						<script>
						function addMoreImages() {
							$('#images').append($('#images2').html());
						}
						</script>
						<div class="form-group">
							<label>Videos (Youtube URL):</label>
							<div id="videos">
								<input name="view_videos[]" type="text" id="view_videos[]" placeholder="Add Youtube URLS" />
								<input name="moreVideos" type="button" id="moreVideos" value="Add More Videos" onClick="addMoreVideos();" />
							</div>
							<div id="videos2" style="display:none;"> <br />
								<input name="view_videos[]" type="text" id="view_videos[]" placeholder="Add Youtube URLS" />
							</div>
						</div>
						<script>
						function addMoreVideos() {
							$('#videos').append($('#videos2').html());
						}
						</script>
						<div class="form-group">
							<label>Links / PDF / Document:</label>
								<div id="links">
								<input name="view_links[]" type="text" id="view_links[]" placeholder="Add Links" />
								<input name="moreLinks" type="button" id="moreLinks" value="Add More Links" onClick="addMoreLinks();" />
							</div>
							<div id="links2" style="display:none;"> <br />
									<input name="view_links[]" type="text" id="view_links[]" placeholder="Add Links" />
							</div>
						</div>
						<script>
						function addMoreLinks() {
							$('#links').append($('#links2').html());
						}
						</script>
					</div>
				</div>
				
				
				
				
				
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">

			<div class="panel panel-primary">
					<div class="panel-heading">Business Hours</div>
					<div class="panel-body">
						<div id="businessHoursContainer"></div>
					</div>
			</div>
				
				
				
				

				
				
					<div class="form-group">
						<input type="submit" value="Create New Profile">
					</div>
					<input type="hidden" name="prof_country" id="prof_country" value="<?php echo !empty($_POST['prof_country']) ? $_POST['prof_country'] : ''; ?>" />
					<input type="hidden" name="prof_state" id="prof_state" value="<?php echo !empty($_POST['prof_state']) ? $_POST['prof_state'] : ''; ?>" />
					<input type="hidden" name="prof_county" id="prof_county" value="<?php echo !empty($_POST['prof_county']) ? $_POST['prof_county'] : ''; ?>" />
					<input type="hidden" name="prof_city" id="prof_city" value="<?php echo !empty($_POST['prof_city']) ? $_POST['prof_city'] : ''; ?>" />
					<input type="hidden" name="prof_addr" id="prof_addr" value="<?php echo !empty($_POST['prof_addr']) ? $_POST['prof_addr'] : ''; ?>" />
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>" />
					<input type="hidden" name="prof_type" value="<?php echo PROF_SERVICE_TYPE; ?>">
					<input type="hidden" name="prof_lat" id="prof_lat" value="<?php echo !empty($_POST['prof_lat']) ? $_POST['prof_lat'] : ''; ?>" />
					<input type="hidden" name="prof_lng" id="prof_lng" value="<?php echo !empty($_POST['prof_lng']) ? $_POST['prof_lng'] : ''; ?>" />
					<input type="hidden" name="business_hours" value="<?php echo !empty($_POST['prof_lat']) ? htmlspecialchars($_POST['business_hours']) : ''; ?>" />
					<input type="hidden" name="id_proof_url" id="id_proof_url" value="" />
					<input type="hidden" name="MM_insert" value="form1" />

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
		{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();
	console.log('place is ', place);
	document.getElementById('prof_lat').value = place.geometry.location.lat();
	document.getElementById('prof_lng').value = place.geometry.location.lng();
	if (place.address_components) {
		for (let k in place.address_components) {
			let p = place.address_components[k];
			
			if (p.types[0] === 'locality') {
				document.getElementById('prof_city').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_2') {
				document.getElementById('prof_county').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_1') {
				document.getElementById('prof_state').value = p.long_name;
			} else if (p.types[0] === 'country') {
				document.getElementById('prof_country').value = p.long_name;
			}
			console.log('addr is ', p.types[0], p.short_name, p.long_name);
		}
	}
	document.getElementById('prof_addr').value = place.formatted_address;
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
			
			
		</div>
	</div>
	</form>
<script>
$("#businessHoursContainer").businessHours({
	postInit:function(){
		$('.operationTimeFrom, .operationTimeTill').timepicker({
			'timeFormat': 'H:i',
			'step': 15
			});
	},
	operationTime: [
		{},
		{},
		{},
		{},
		{},
		{},
		{}
	],
	defaultOperationTimeFrom: '9:00',
	defaultOperationTimeTill: '17:00',
	dayTmpl:'<div class="dayContainer" style="width: 80px;">' +
		'<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState" name="hstatus[]"></div>' +
		'<div class="weekday"></div>' +
		'<div class="operationDayTimeContainer">' +
		'<div class="operationTime input-group"><span class="input-group-addon"><i class="far fa-sun"></i></span><input type="text" name="startTime[]" class="mini-time form-control operationTimeFrom" value=""></div>' +
		'<div class="operationTime input-group"><span class="input-group-addon"><i class="far fa-moon"></i></span><input type="text" name="endTime[]" class="mini-time form-control operationTimeTill" value=""></div>' +
		'</div></div>'
});
</script>
<?php } ?>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
