<?php
$MM_redirectLoginSuccess = COMPLETE_HTTP_PATH;

if (isset($_GET['accesscheck'])) {
  $MM_redirectLoginSuccess = $_GET['accesscheck'];	
}


?>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBhpHK-ve2s0ynnr8og8Zx0S69ttEFpDKk",
    authDomain: "project100-fe20e.firebaseapp.com",
    databaseURL: "https://project100-fe20e.firebaseio.com",
    projectId: "project100-fe20e",
    storageBucket: "project100-fe20e.appspot.com",
    messagingSenderId: "674827815611"
  };
  firebase.initializeApp(config);
</script>
<script>
	var homeUrl = '<?php echo COMPLETE_HTTP_PATH; ?>';
	var firebaseDatabase = firebase.database();
	var userLocation = {};
	
	function addInFb(obj) {
		let url = '<?php echo FIREBASE_BASEPATH; ?>/trackPages/<?php echo date('Y-m-d'); ?>/user_<?php echo !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : ''; ?>';
		let uniqueID = firebaseDatabase.ref(url).push(obj).key;
		firebaseDatabase.ref(url).child(uniqueID).child('id').set(uniqueID);
	}
	function trackPage() {
		let obj = {
			page: '<?php echo $_SERVER['REQUEST_URI']; ?>',
			user_id: <?php echo !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : -1; ?>,
			ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>',
			datetime: firebase.database.ServerValue.TIMESTAMP,
			useragent: '<?php echo $_SERVER['HTTP_USER_AGENT']; ?>'
		};

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				userLocation.lat = position.coords.latitude;
				userLocation.lng = position.coords.longitude;
				obj.userLocation = userLocation;
				addInFb(obj);
			}, (d) => {addInFb(obj);console.log('error is ', d);});
		} else {
			addInFb(obj);
		}
	}
	trackPage();
	/*
	let url = '<?php //echo FIREBASE_BASEPATH; ?>/somepath';
	firebaseDatabase.ref(url).child(this.state.deleteIssueModalData.id).set(null);

	ref.off();
	ref.on('value', (snapshot) => {
		var result = snapshot.val();
	});
	let ref = firebaseDatabase.ref(url).limitToLast(500);
	var current = firebase.database.ServerValue.TIMESTAMP;
	
	var url = FirebaseConstant.basePath + '/data/posts';
	var uniqueID = firebaseDatabase.ref(url).push(obj).key;
	firebaseDatabase.ref(url).child(uniqueID).child('id').set(uniqueID);
	*/
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
        //console.log('userData is ', userData);
		
	  } else {
		console.log('user is logged out');
	  }
	});
	
	
	//if i have to post json data to server
	function postJson(postUrl, params) {
		//console.log('postUrl: ', postUrl);
		var jqxhr = $.ajax({
			url: postUrl,
			type: 'POST',
			data: JSON.stringify(params),
			constenType: 'application/json; charset=utf-8'
		}).done(function(response) {
			window.location.href = '<?php echo $MM_redirectLoginSuccess; ?>';
		}).fail(function(jqxhr, settings, ex) {
			console.log('jqxhr is ', jqxhr);
			console.log('settings is ', settings);
			console.log('ex is ', ex);
		});
	}
    
	function postToApi(obj) {
		postJson(homeUrl+'api.php', obj);
		
	}
    
    function login(provider) {
        firebase.auth().signInWithPopup(provider).then(function(result) {
		
			var user = result.user;
			var userData = {};
			userData.displayName = user.displayName;
			userData.email = user.email;
			userData.photoURL = user.photoURL;
			userData.profileUID = user.providerData[0].uid;
			userData.refreshToken = user.refreshToken;
			userData.uid = user.uid;
			userData.provider_id = user.providerData[0].providerId;
			
			postToApi(userData);
		}).catch(function(error) {
		  console.log('error22 is ', error);
		});
    }


	function googleLogin() {
		var provider = new firebase.auth.GoogleAuthProvider();
		provider.addScope('profile');
		provider.addScope('email');
       login(provider);
	}
	
	function facebookLogin() {
		var provider = new firebase.auth.FacebookAuthProvider();
       login(provider);
	}
	
	//https://apps.twitter.com/
	function twitterLogin() {
		var provider = new firebase.auth.TwitterAuthProvider();
       login(provider);
	}
	
	//https://github.com/settings/developers
	function gitHubLogin() {
		var provider = new firebase.auth.GithubAuthProvider();
       login(provider);
	}
	
	function signOut() {
		firebase.auth().signOut().then(function() {
		  // Sign-out successful.
           window.location.href = homeUrl+'users/logout.php';
		}).catch(function(error) {
		  // An error happened.
			console.log('error logout: ', error);
		});
	}
</script>

<script>
	function toggleContent(id) {
		$('#' + id).toggle();
	}
</script> 