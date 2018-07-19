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
	var homeUrl = '/project2017/babybar/';
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
          console.log('user is ', user);
		var userData = {};
		userData.displayName = user.displayName;
		userData.email = user.email;
		userData.photoURL = user.photoURL;
		userData.profileUID = user.providerData[0].uid;
		userData.refreshToken = user.refreshToken;
		userData.uid = user.uid;
          console.log('userData is ', userData);
		
	  } else {
		console.log('user is logged out');
	  }
	});
	
	
	//if i have to post json data to server
	function postJson(postUrl, params) {
		var jqxhr = $.ajax({
			url: postUrl,
			type: 'POST',
			data: JSON.stringify(params),
			constenType: 'application/json; charset=utf-8'
		}).done(function(response) {
			window.location.href = homeUrl;
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