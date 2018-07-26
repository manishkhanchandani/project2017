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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
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
  $insertSQL = sprintf("INSERT INTO s_classified (user_id, is_public, view_images, view_videos, view_links, prof_type, display_name, description, location, prof_lat, prof_lng, travel_radius, work_travel, work_business, pref_no_pref, pref_male, pref_female, gender, type_swedish, type_deep, type_thai, type_sports, type_pregnancy, type_reflexology, type_medical, type_hotstone, goal_relaxation, goal_flexibility, goal_pain, price_60_min, price_90_min, price_120_min, mas_type_ind, mas_type_cpl, discount_5_sess, discount_10_sess, discount_20_sess, business_hours, apointment_same_day, prof_country, prof_state, prof_county, prof_city, prof_addr) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['prof_addr'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/ineedmassage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
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
<div class="provider_create">
	<h1 class="page-header">Create New Provider Profile</h1>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
		    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                <table>
                    <tr valign="baseline">
                        <td nowrap align="right">Show/Hide:</td>
                        <td>
						<div class="form-group">
							<input name="is_public" id="is_public_1" type="radio" value="1" checked>
							<label for="is_public_1">Public</label>
							<input name="is_public" id="is_public_2" type="radio" value="0">
							<label for="is_public_2">Private</label>
						</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Display Name:</td>
                        <td>
							<div class="form-group">
								<label for="display_name">Display Name:</label>
								<input type="text" class="form-control" id="display_name" name="display_name">
							</div>						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Description:</td>
                        <td>
							<div class="form-group">
								<label for="description">Description:</label>
								<textarea type="text" class="form-control" id="description" rows="5" name="description"></textarea>
							</div>                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Location:</td>
                        <td>
							<div class="form-group">
								<label for="autocomplete">Business or Current Location:</label>
								<input type="text" class="form-control addressBox" id="autocomplete" name="location" onFocus="geolocate()" placeholder="enter address" value="<?php echo !empty($_POST['location']) ? $_POST['location'] : ''; ?>">
							</div>
						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Travel Radius:</td>
                        <td>
							<div class="form-group">
								<label for="travel_radius">How Far you can travel to reach the client (in miles):</label>
								<input type="text" class="form-control" id="travel_radius" name="travel_radius">
							</div>
						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Work_travel:</td>
                        <td>
							<div class="form-group">
								
								<label>Where do you provide massages?</label>
								<label for="work_business" class="myLabel">At my business location: <input type="checkbox"  id="work_business" name="work_business" checked="checked"></label>
								<label for="work_travel" class="myLabel">At client's home or business location: <input type="checkbox"  id="work_travel" name="work_travel" checked="checked"></label>
							</div>
						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Pref_no_pref:</td>
                        <td>
							<div class="form-group">
								
								<label>Which clients do you work with?</label>
								<label for="pref_no_pref" class="myLabel">Clients who have no preference: <input type="checkbox"  id="pref_no_pref" name="pref_no_pref" checked="checked"></label>
								<label for="pref_female" class="myLabel">Clients who want female massage therapists only: <input type="checkbox"  id="pref_female" name="pref_female" checked="checked"></label>
								<label for="pref_male" class="myLabel">Clients who want male massage therapists only: <input type="checkbox"  id="pref_male" name="pref_male" checked="checked"></label>
								
							</div>
						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Gender:</td>
                        <td>
							<div class="form-group">
								<label for="gender">Gender:</label>
								<select name="gender" id="gender" class="form-control">
									<option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
									<option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
								</select>  
							</div>
						                      </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Type_swedish:</td>
                        <td>
							<div class="form-group">
								<label>Which types of massage do you offer?</label>
								<label for="type_swedish" class="myLabel">Swedish massage (standard): <input type="checkbox"  id="type_swedish" name="type_swedish" checked="checked"></label>
								<label for="type_deep" class="myLabel">Deep tissue massage: <input type="checkbox"  id="type_deep" name="type_deep" checked="checked"></label>
								<label for="type_thai" class="myLabel">Thai massage: <input type="checkbox"  id="type_thai" name="type_thai" checked="checked"></label>
								<label for="type_sports" class="myLabel">Sports massage: <input type="checkbox"  id="type_sports" name="type_sports" checked="checked"></label>
								<label for="type_pregnancy" class="myLabel">Pregnancy massage: <input type="checkbox"  id="type_pregnancy" name="type_pregnancy" checked="checked"></label>
								<label for="type_reflexology" class="myLabel">Reflexology massage: <input type="checkbox"  id="type_reflexology" name="type_reflexology" checked="checked"></label>
								<label for="type_medical" class="myLabel">Medical massage: <input type="checkbox"  id="type_medical" name="type_medical" checked="checked"></label>
								<label for="type_hotstone" class="myLabel">Hot stone massage: <input type="checkbox"  id="type_hotstone" name="type_hotstone" checked="checked"></label>
								
							</div>
						</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Goal_relaxation:</td>
                        <td>
									
							<div class="form-group">
								<label>Which clients do you work with?</label>
								<label for="goal_relaxation" class="myLabel">Relaxation / stress relief: <input type="checkbox"  id="goal_relaxation" name="goal_relaxation" checked="checked"></label>
								<label for="goal_flexibility" class="myLabel">Increased flexibility: <input type="checkbox"  id="goal_flexibility" name="goal_flexibility" checked="checked"></label>
								<label for="goal_pain" class="myLabel">Pain relief: <input type="checkbox"  id="goal_pain" name="goal_pain" checked="checked"></label>
							</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Price 60 min:</td>
                        <td>
							<div class="form-group">
								<label for="price_60_min">Price 60 min:</label>
								<input type="text" class="form-control" id="price_60_min" name="price_60_min">
							</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Price 90 min:</td>
                        <td>
							<div class="form-group">
								<label for="price_90_min">Price 90 min:</label>
								<input type="text" class="form-control" id="price_90_min" name="price_90_min">
							</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Price 120 min:</td>
                        <td>
							<div class="form-group">
								<label for="price_120_min">Price 120 min:</label>
								<input type="text" class="form-control" id="price_120_min" name="price_120_min">
							</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Mas_type_ind:</td>
                        <td>
							<div class="form-group">
								<label>Which clients do you work with?</label>
								<label for="mas_type_ind" class="myLabel">Relaxation / stress relief: <input type="checkbox"  id="mas_type_ind" name="mas_type_ind" checked="checked"></label>
								<label for="mas_type_cpl" class="myLabel">Increased flexibility: <input type="checkbox"  id="mas_type_cpl" name="mas_type_cpl" checked="checked"></label>
							</div></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Discount_5_sess:</td>
                        <td>
							<div class="form-group">
								<label for="display_name">Location:</label>
								<input type="text" class="form-control" id="display_name" name="display_name">
							</div>
						<input type="text" name="discount_5_sess" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Discount_10_sess:</td>
                        <td>
							<div class="form-group">
								<label for="display_name">Location:</label>
								<input type="text" class="form-control" id="display_name" name="display_name">
							</div>
						<input type="text" name="discount_10_sess" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Discount_20_sess:</td>
                        <td>
							<div class="form-group">
								<label for="display_name">Location:</label>
								<input type="text" class="form-control" id="display_name" name="display_name">
							</div>
						<input type="text" name="discount_20_sess" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Apointment_same_day:</td>
                        <td>
							<div class="form-group">
								<label for="display_name">Location:</label>
								<input type="text" class="form-control" id="display_name" name="display_name">
							</div>
						<input name="apointment_same_day" type="checkbox" value="" checked ></td>
                    </tr>
                    <tr valign="baseline" class="table">
                        <td nowrap align="right"><strong>Images:</strong></td>
                        <td><div id="images">
                                <input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" />
                                <input name="moreImage" type="button" id="moreImage" value="Add More Images" onClick="addMoreImages();" />
                            </div>
                                <div id="images2" style="display:none;"> <br />
                                        <input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" />
                                </div>
                            <script>
							function addMoreImages() {
								$('#images').append($('#images2').html());
							}
						</script>
                        </td>
                    </tr>
                    <tr valign="baseline" class="table">
                        <td nowrap align="right"><strong>Videos (Youtube URL):</strong></td>
                        <td><div id="videos">
                                <input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
                                <input name="moreVideos" type="button" id="moreVideos" value="Add More Videos" onClick="addMoreVideos();" />
                            </div>
                                <div id="videos2" style="display:none;"> <br />
                                        <input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
                                </div>
                            <script>
							function addMoreVideos() {
								$('#videos').append($('#videos2').html());
							}
						</script>
                        </td>
                    </tr>
                    <tr valign="baseline" class="table">
                        <td nowrap align="right"><strong>Links / PDF / Document:</strong></td>
                        <td><div id="links">
                                <input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
                                <input name="moreLinks" type="button" id="moreLinks" value="Add More Links" onClick="addMoreLinks();" />
                            </div>
                                <div id="links2" style="display:none;"> <br />
                                        <input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
                                </div>
                            <script>
						function addMoreLinks() {
							$('#links').append($('#links2').html());
						}
					    </script>
                        </td>
                    </tr>
                    
                    <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td><input type="submit" value="Insert record"></td>
                    </tr>
                </table>
				<input type="hidden" name="prof_country" id="prof_country" value="" />
				<input type="hidden" name="prof_state" id="prof_state" value="" />
				<input type="hidden" name="prof_county" id="prof_county" value="" />
				<input type="hidden" name="prof_city" id="prof_city" value="" />
				<input type="hidden" name="prof_addr" id="prof_addr" value="" />
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
                <input type="hidden" name="prof_type" value="massage">
                <input type="hidden" name="prof_lat" id="prof_lat" value="<?php echo !empty($_POST['prof_lat']) ? $_POST['prof_lat'] : ''; ?>">
                <input type="hidden" name="prof_lng" id="prof_lng" value="<?php echo !empty($_POST['prof_lng']) ? $_POST['prof_lng'] : ''; ?>">
                <input type="hidden" name="business_hours" value="<?php echo !empty($_POST['prof_lat']) ? htmlspecialchars($_POST['business_hours']) : ''; ?>">
                <input type="hidden" name="MM_insert" value="form1">

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
            </form>
            <p>&nbsp;</p>
		</div>
	</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
