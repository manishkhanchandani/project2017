<form name="form1" method="get" action="">
	<h3>Search Practitioner</h3>
	<div class="form-group">
		<label for="keyword">Keyword: </label>
		<input type="search" class="form-control" id="keyword" name="keyword" placeholder="enter name or keyword" value="<?php echo !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="keyword">Location: </label>
		<input type="text" class="form-control addressBox" id="autocomplete" name="autocomplete" onFocus="geolocate()" placeholder="enter address" value="<?php echo !empty($_GET['autocomplete']) ? $_GET['autocomplete'] : ''; ?>">
	</div>
	<input name="slat" id="slat" type="hidden" value="<?php echo !empty($_GET['slat']) ? $_GET['slat'] : ''; ?>" /> <input name="slng" id="slng" type="hidden" value="<?php echo !empty($_GET['slng']) ? $_GET['slng'] : ''; ?>" />
	<button type="submit" class="btn btn-default">Search</button>
</form>
<hr />
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
	document.getElementById('slat').value = place.geometry.location.lat();
	document.getElementById('slng').value = place.geometry.location.lng();
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWqKxrgU8N1SGtNoD6uD6wFoGeEz0xwbs&libraries=places&callback=initAutocomplete"
        async defer></script>