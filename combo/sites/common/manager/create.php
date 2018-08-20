<?php
redirect(HTTPPATH.'/users/login?direct=1', $MM_authorizedUsers);
?>



<div class="provider_create">
	<h1 class="page-header">Create New Manager Profile (Independent Contractor)</h1>
<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($id) && empty($error)) { ?>
</script>
<meta http-equiv="refresh" content="3;URL=<?php echo HTTPPATH; ?>">
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
					<div class="panel-heading">County Information</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="autocomplete">Enter your home / work address (for which you want to become the manager):</label>
							<input type="text" class="form-control addressBox" id="autocomplete" name="location" onFocus="geolocate()" placeholder="enter address" value="<?php echo !empty($_POST['location']) ? $_POST['location'] : ''; ?>">
						</div>
						<div class="form-group">
							<label for="autocomplete">County:</label>
							<input type="text" class="form-control" name="prof_county" id="prof_county" value="<?php echo !empty($_POST['prof_county']) ? $_POST['prof_county'] : ''; ?>" readonly="readonly" />
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
					<div class="panel-heading">Personal Data</div>
					<div class="panel-body">
						
						<div class="form-group">
							<label for="birth_year">Birth Year:</label>
							<input type="text" class="form-control" id="birth_year" name="birth_year" placeholder="Birth Year" value="<?php echo (!empty($_POST['birth_year'])) ? $_POST['birth_year'] : ''; ?>" />
						</div>		
						
						<div class="form-group">
							<label for="gender">Gender:</label>
							<select name="gender" id="gender" class="form-control">
								<option value="Female" <?php if (!(strcmp("Female", ""))) {echo "SELECTED";} ?>>Female</option>
								<option value="Male" <?php if (!(strcmp("Male", ""))) {echo "SELECTED";} ?>>Male</option>
							</select>  
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

				
				
				

				
				
					<div class="form-group">
						<input type="submit" value="Create New Profile">
					</div>
					<input type="hidden" name="prof_country" id="prof_country" value="<?php echo !empty($_POST['prof_country']) ? $_POST['prof_country'] : ''; ?>" />
					<input type="hidden" name="prof_state" id="prof_state" value="<?php echo !empty($_POST['prof_state']) ? $_POST['prof_state'] : ''; ?>" />
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
<?php } ?>
</div>