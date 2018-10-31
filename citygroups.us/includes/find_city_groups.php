<?php require_once(BASE_DIR.DIRECTORY_SEPARATOR.'Connections'.DIRECTORY_SEPARATOR.'conn.php'); ?>
<?php
require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'search_algo.php');
/*
$totalRows_rsGroups = -1;

if (!empty($_POST['location'])) {
	$colname_rs = (get_magic_quotes_gpc()) ? $_POST['location'] : addslashes($_POST['location']);
	$query = sprintf("select * from citygroup_groups WHERE group_name LIKE '%%%s%%'", $colname_rs);
	mysql_select_db($database_conn, $conn);
	$rs = mysql_query($query);
	if (mysql_num_rows($rs) === 0) {
		
		if (empty($_POST['lat'])) {
			$totalRows_rsGroups = 0;
		} else {
		
		
			$group_name = $_POST['location'];
			$_POST['group_description'] = '';
			$uid = !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : 0;
			$insertSQL = sprintf("INSERT INTO citygroup_groups (group_name, group_description, country, `state`, county, city, addr, lat, lng, group_creator_id, ip_address) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['location'], "text"),
						   GetSQLValueString($_POST['group_description'], "text"),
						   GetSQLValueString($_POST['country'], "text"),
						   GetSQLValueString($_POST['state'], "text"),
						   GetSQLValueString($_POST['county'], "text"),
						   GetSQLValueString($_POST['city'], "text"),
						   GetSQLValueString($_POST['addr'], "text"),
						   GetSQLValueString($_POST['lat'], "double"),
						   GetSQLValueString($_POST['lng'], "double"),
						   GetSQLValueString($uid, "int"),
						   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"));
			  mysql_select_db($database_conn, $conn);
			  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
			  $id = mysql_insert_id();
		}
	} else {
		$rec = mysql_fetch_array($rs);
		$id = $rec['group_id'];
		$group_name = $rec['group_name'];
	}


	if (!empty($id)) {
		$url = HTTP_PATH."groups/?group_id=".$id."&city=".urlencode($group_name);
		
		mysql_select_db($database_conn, $conn);
		$query_rsGroups = "SELECT * FROM citygroup_groups WHERE group_id = $id";
		$rsGroups = mysql_query($query_rsGroups, $conn) or die(mysql_error());
		$row_rsGroups = mysql_fetch_assoc($rsGroups);
		$totalRows_rsGroups = mysql_num_rows($rsGroups);
	}
}
*/
?>
<h3 class="page-header">Find City Group</h3>
		<form id="form2" name="form2" method="POST" action="">
			<div class="form-group">
				<label for="autocomplete">City *:</label>
				<input type="text" class="form-control addressBox" id="autocomplete" name="location" onFocus="geolocate()" placeholder="enter city" value="<?php echo !empty($_POST['location']) ? $_POST['location'] : ''; ?>">
			</div>
			<input type="submit" name="Submit" value="Find Group" /><br /><br />
			<input type="hidden" name="country" id="country" value="<?php echo !empty($_POST['country']) ? $_POST['country'] : ''; ?>" />
			<input type="hidden" name="state" id="state" value="<?php echo !empty($_POST['state']) ? $_POST['state'] : ''; ?>" />
			<input type="hidden" name="county" id="county" value="<?php echo !empty($_POST['county']) ? $_POST['county'] : ''; ?>" />
			<input type="hidden" name="city" id="city" value="<?php echo !empty($_POST['city']) ? $_POST['city'] : ''; ?>" />
			<input type="hidden" name="addr" id="addr" value="<?php echo !empty($_POST['addr']) ? $_POST['addr'] : ''; ?>" />
			<input type="hidden" name="lat" id="lat" value="<?php echo !empty($_POST['lat']) ? $_POST['lat'] : ''; ?>" />
			<input type="hidden" name="lng" id="lng" value="<?php echo !empty($_POST['lng']) ? $_POST['lng'] : ''; ?>" />

<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;

  function initAutocomplete() {
  	if (typeof google === 'undefined') return;
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
	document.getElementById('lat').value = place.geometry.location.lat();
	document.getElementById('lng').value = place.geometry.location.lng();
	if (place.address_components) {
		for (let k in place.address_components) {
			let p = place.address_components[k];
			
			if (p.types[0] === 'locality') {
				document.getElementById('city').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_2') {
				document.getElementById('county').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_1') {
				document.getElementById('state').value = p.long_name;
			} else if (p.types[0] === 'country') {
				document.getElementById('country').value = p.long_name;
			}
			//console.log('addr is ', p.types[0], p.short_name, p.long_name);
		}
	}
	document.getElementById('addr').value = place.formatted_address;
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
  	if (typeof google === 'undefined') return;
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

initAutocomplete();
</script>
		</form>
		
<?php
if (isset($totalRows_rsGroups) && $totalRows_rsGroups > 0) {
?>
<br />
<br />
<p>Redirecting you to <strong>"<?php echo $row_rsGroups['group_name']; ?>"</strong></p>
<meta http-equiv="refresh" content="1;URL=<?php echo $url; ?>" />

<?php
}

if (isset($totalRows_rsGroups) && $totalRows_rsGroups === 0) {
?>
<br />
<br />
<p>City Group <strong>"<?php echo $_POST['location']; ?>"</strong> Not Found.</p>
<?php
}

?>