<?php

?>
<div class="nav-multi">
	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo HTTP_PATH; ?>">City Groups</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo HTTP_PATH; ?>">Home</a></li>
					
					<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mygroups.php'); ?>
				</ul>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php if (!empty($_SESSION['MM_DisplayName'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?><span class="caret"></span></a>
					  
					  <ul class="dropdown-menu">
						<?php if (!empty($_SESSION['MM_DisplayName'])) { ?>
							<li><a href="" onClick="signOut(); return false;">Signout</a></li>
						<?php } else { ?>
							<!--<li><a href="" onClick="googleLogin(); return false;">Google</a></li>
							<li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
							<li><a href="" onClick="gitHubLogin(); return false;">Github</a></li> -->
							<li><a href="<?php echo HTTP_PATH; ?>users/login.php">Login / Register</a></li>
						<?php } ?>
					  </ul>
					</li>
				  </ul>
				  <form class="navbar-form navbar-right" method="post" action="<?php echo HTTP_PATH; ?>includes/search_result.php">
					<input type="search" name="location" id="location_menu" class="form-control" value="" onFocus="geolocate_menu()" placeholder="search city...">
					<input name="redirect" type="hidden" value="1" />
					<input type="hidden" name="country" id="country_menu" value="" />
					<input type="hidden" name="state" id="state_menu" value="" />
					<input type="hidden" name="county" id="county_menu" value="" />
					<input type="hidden" name="city" id="city_menu" value="" />
					<input type="hidden" name="addr" id="addr_menu" value="" />
					<input type="hidden" name="lat" id="lat_menu" value="" />
					<input type="hidden" name="lng" id="lng_menu" value="" />
					<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete_menu;

  function initAutocomplete_menu() {
  	if (typeof google === 'undefined') return;
	// Create the autocomplete object, restricting the search to geographical
	// location types.
	autocomplete_menu = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('location_menu')),
		{types: ['(cities)']}); //{ types: ['(cities)'] }); //{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	autocomplete_menu.addListener('place_changed', fillInAddress_menu);
  }

  function fillInAddress_menu() {
	// Get the place details from the autocomplete object.
	var place = autocomplete_menu.getPlace();
	//console.log('place is ', place);
	document.getElementById('lat_menu').value = place.geometry.location.lat();
	document.getElementById('lng_menu').value = place.geometry.location.lng();
	if (place.address_components) {
		for (let k in place.address_components) {
			let p = place.address_components[k];
			
			if (p.types[0] === 'locality') {
				document.getElementById('city_menu').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_2') {
				document.getElementById('county_menu').value = p.long_name;
			} else if (p.types[0] === 'administrative_area_level_1') {
				document.getElementById('state_menu').value = p.long_name;
			} else if (p.types[0] === 'country') {
				document.getElementById('country_menu').value = p.long_name;
			}
			//console.log('addr is ', p.types[0], p.short_name, p.long_name);
		}
	}
	document.getElementById('addr_menu').value = place.formatted_address;
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate_menu() {
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
		autocomplete_menu.setBounds(circle.getBounds());
	  });
	}
  }

initAutocomplete_menu();
</script>
				  </form>
			</div>
		</div>
	</div>
</div>