<?php

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$error = '';
	if ($_SESSION['MM_UserId'] <= 0) {
		$error .= 'Invalid User, ';
	}

	if (empty($_POST['display_name'])) {
		$error .= 'Empty Display Name, ';
	}
	
	if (empty($_POST['birth_year'])) {
		$error .= 'Empty birth year, ';
	}
	if (empty($_POST['prof_lat'])) {
		$error .= 'Empty Location, ';
	}
	
	if (empty($_POST['real_name'])) {
		$error .= 'Empty Real Name, ';
	}
	if (empty($_POST['travel_radius'])) {
		$error .= 'Empty travel radius, ';
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
  $insertSQL = sprintf("INSERT INTO ineedmassage (user_id, is_public, view_images, view_videos, view_links, prof_type, display_name, description, location, prof_lat, prof_lng, travel_radius, looking_gender_male, looking_gender_female, gender, type_swedish, type_deep, type_thai, type_sports, type_pregnancy, type_reflexology, type_medical, type_hotstone, prof_country, prof_state, prof_county, prof_city, real_name, id_proof_url, marital_status, birth_year) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString(isset($_POST['looking_gender_male']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['looking_gender_female']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString(isset($_POST['type_swedish']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_deep']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_thai']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_sports']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_pregnancy']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_reflexology']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_medical']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['type_hotstone']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['prof_country'], "text"),
                       GetSQLValueString($_POST['prof_state'], "text"),
                       GetSQLValueString($_POST['prof_county'], "text"),
                       GetSQLValueString($_POST['prof_city'], "text"),
                       GetSQLValueString($_POST['real_name'], "text"),
                       GetSQLValueString($_POST['id_proof_url'], "text"),
                       GetSQLValueString($_POST['marital_status'], "text"),
                       GetSQLValueString($_POST['birth_year'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  $id = mysql_insert_id();
  $error = "Request created Successfully. It is pending on admin's permission and it will be sent out to all the users in few minutes. <a href=\"requests/my.php\">See all requests here</a>";
  $txt = $error;
  mail(ADMINEMAIL, "New Request at ineedmassage.us", $txt, FROMEMAIL);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($_FILES['userfile']) && !empty($_FILES['userfile']['tmp_name'])) {
	$ref = md5($id.'_'.$_SESSION['MM_UserId']);
	$ext = strrchr($_FILES['userfile']['name'], '.');
	if (!is_dir(ROOT_DIR.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'user_'.$_SESSION['MM_UserId'])) {
		mkdir(ROOT_DIR.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'user_'.$_SESSION['MM_UserId'], 0777);
		chmod(ROOT_DIR.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'user_'.$_SESSION['MM_UserId'], 0777);
	}
	
	$lpath = 'files/user_'.$_SESSION['MM_UserId'].'/'.$ref.$ext;
	$path = ROOT_DIR.DIRECTORY_SEPARATOR.$lpath;
	move_uploaded_file($_FILES['userfile']['tmp_name'], $path);
	$_POST['id_proof_url'] = $lpath;
	mysql_query("update ineedmassage set id_proof_url = '".$lpath."' WHERE id = ".$id);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$_POST = array();
}

$marital_status = !empty($_POST['marital_status']) ? $_POST['marital_status'] : 'single';
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<?php if (!empty($error)) { ?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php } ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Show/Hide</div>
			<div class="panel-body">
				<label for="is_public_1" class="myLabel">Public <input name="is_public" id="is_public_1" type="radio" value="1" checked /></label>						
				<label for="is_public_2" class="myLabel">Private <input name="is_public" id="is_public_2" type="radio" value="0" /></label>
			</div>
		</div>
		
		
		
		
		<div class="panel panel-primary">
			<div class="panel-heading">Personal Info</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="display_name">Display Name (Shown to users):</label>
					<input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="<?php echo (!empty($_POST['display_name'])) ? $_POST['display_name'] : ''; ?>" />
				</div>
				<div class="form-group">
					<label for="birth_year">Birth Year:</label>
					<input type="number" class="form-control" id="birth_year" name="birth_year" placeholder="Display Name" value="<?php echo (!empty($_POST['birth_year'])) ? $_POST['birth_year'] : ''; ?>" />
				</div>
				<div class="form-group">
					<label for="real_name">Real Name (Will not be shown to users):</label>
					<input type="text" class="form-control" id="real_name" name="real_name" placeholder="Real Name" value="<?php echo (!empty($_POST['real_name'])) ? $_POST['real_name'] : ''; ?>" />
				</div>						
				<div class="form-group">
					<label>Upload ID Proof (*) (To confirm your Real Name, This will not be shared with anyone):</label>
					<input type="file" name="userfile" id="userfile" class="form-control">					    
				</div>
				<div class="form-group">
					<label for="description">Description:</label>
					<textarea class="form-control" id="description" rows="5" name="description"><?php echo (!empty($_POST['description'])) ? $_POST['description'] : ''; ?></textarea>
				</div> 
				<div class="form-group">
					<label for="gender">Gender:</label>
					<select name="gender" id="gender" class="form-control">
						<option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
						<option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
					</select>  
				</div>
				<div class="form-group">
					<label for="gender">Looking for Massage From:</label>
					<input name="looking_gender_female" type="checkbox" value="1" checked="checked"> Female <input name="looking_gender_male" type="checkbox" value="1" checked="checked"> Male 
					
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
					<label for="travel_radius">Radius (in miles):<br />Request will be sent to all users within the following travelling radius.</label>
					<input type="number" class="form-control" id="travel_radius" name="travel_radius" value="<?php echo (!empty($_POST['travel_radius'])) ? $_POST['travel_radius'] : 25; ?>" />
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-primary">
			<div class="panel-heading">Preference</div>
			<div class="panel-body">
				<div class="form-group">
					
					<label>Where do you provide massages?</label>
					<p>
					<label for="isHost" class="myLabel">I can host an exchange: <input type="checkbox"  id="isHost" name="isHost" checked="checked" /></label>
					<label for="massage_table" class="myLabel">I have a massage table: <input type="checkbox"  id="massage_table" name="massage_table" checked="checked" /></label>
					<label for="qualification" class="myLabel">I have formal massage qualifications: <input type="checkbox"  id="qualification" name="qualification" checked="checked" /></label></p>
				</div>
				<div class="form-group">
					<label>Which types of massage do you offer?</label>
					<p><label for="type_swedish" class="myLabel">Swedish massage (standard): <input type="checkbox"  id="type_swedish" name="type_swedish" checked="checked" /></label>
					<label for="type_deep" class="myLabel">Deep tissue massage: <input type="checkbox"  id="type_deep" name="type_deep" checked="checked" /></label>
					<label for="type_thai" class="myLabel">Thai massage: <input type="checkbox"  id="type_thai" name="type_thai" /></label>
					<label for="type_sports" class="myLabel">Sports massage: <input type="checkbox"  id="type_sports" name="type_sports"  /></label>
					<label for="type_pregnancy" class="myLabel">Pregnancy massage: <input type="checkbox"  id="type_pregnancy" name="type_pregnancy"  /></label>
					<label for="type_reflexology" class="myLabel">Reflexology massage: <input type="checkbox"  id="type_reflexology" name="type_reflexology"  /></label>
					<label for="type_medical" class="myLabel">Medical massage: <input type="checkbox"  id="type_medical" name="type_medical" checked="checked" /></label>
					<label for="type_hotstone" class="myLabel">Hot stone massage: <input type="checkbox"  id="type_hotstone" name="type_hotstone" /></label></p>							
				</div>
				
				
				<div class="form-group">
					<label>Marital Status?</label>
					<p>
					<label for="single" class="myLabel">Single: <input <?php if (!(strcmp($marital_status,"single"))) {echo "checked=\"checked\"";} ?> type="radio"  id="single" name="marital_status" value="single" />
					</label>
					<label for="married" class="myLabel">Married: <input <?php if (!(strcmp($marital_status,"married"))) {echo "checked=\"checked\"";} ?> type="radio"  id="married" name="marital_status" value="married" />
					</label>
					<label for="divorced" class="myLabel">Divorced: <input <?php if (!(strcmp($marital_status,"divorced"))) {echo "checked=\"checked\"";} ?> type="radio"  id="divorced" name="marital_status" value="divorced" />
					</label>
					<label for="separated" class="myLabel">Separated: <input <?php if (!(strcmp($marital_status,"separated"))) {echo "checked=\"checked\"";} ?> type="radio"  id="separated" name="marital_status" value="separated" />
					</label>
					<label for="widowed" class="myLabel">Widowed: <input <?php if (!(strcmp($marital_status,"widowed"))) {echo "checked=\"checked\"";} ?> type="radio"  id="widowed" name="marital_status" value="widowed" />
					</label>
					</p>							
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

<div class="form-group">
	<input type="submit" value="Create New Requests">
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
<input type="hidden" name="id_proof_url" id="id_proof_url" value="" />
<input type="hidden" name="MM_insert" value="form1" />
</form>

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
			