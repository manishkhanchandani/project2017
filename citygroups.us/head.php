<?php
/*
$MM_redirectLoginSuccess = COMPLETE_HTTP_PATH;

if (isset($_GET['accesscheck'])) {
  $MM_redirectLoginSuccess = $_GET['accesscheck'];	
}


?>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDuO1qtU7u3VSgTsSKbnnzOFxQNdcfj0NU",
    authDomain: "citigroups-us.firebaseapp.com",
    databaseURL: "https://citigroups-us.firebaseio.com",
    projectId: "citigroups-us",
    storageBucket: "citigroups-us.appspot.com",
    messagingSenderId: "724008084629"
  };
  firebase.initializeApp(config);
  	// Initialize Cloud Firestore through Firebase
  	var dbFirestore = firebase.firestore();
  	dbFirestore.settings({
  		timestampsInSnapshots: true
	});
	///* 
	//add data
	dbFirestore.collection("users").add({
		first: "Ada",
		last: "Lovelace",
		born: 1815
	})
	.then(function(docRef) {
		console.log("Document written with ID: ", docRef.id);
	})
	.catch(function(error) {
		console.error("Error adding document: ", error);
	});
	
	Read data
	
	dbFirestore.collection("users").get().then((querySnapshot) => {
		querySnapshot.forEach((doc) => {
			console.log(`${doc.id} => ${doc.data()}`);
		});
	});

	auth required
	// Allow read/write access on all documents to any user signed in to the application
	service cloud.firestore {
	  match /databases/{database}/documents {
		match /{document=**} {
		  allow read, write: if request.auth.uid != null;
		}
	  }
	}
	
	locked mode
	// Deny read/write access to all users under any conditions
	service cloud.firestore {
	  match /databases/{database}/documents {
		match /{document=**} {
		  allow read, write: if false;
		}
	  }
	}
	
	Test mode
	// Allow read/write access to all users under any conditions
	// Warning: **NEVER** use this rule set in production; it allows
	// anyone to overwrite your entire database.
	service cloud.firestore {
	  match /databases/{database}/documents {
		match /{document=**} {
		  allow read, write: if true;
		}
	  }
	}
	
	collections can be created as
	var alovelaceDocumentRef = db.collection('users').doc('alovelace');
	var usersCollectionRef = db.collection('users');
	var alovelaceDocumentRef = db.doc('users/alovelace');
	
	var messageRef = db.collection('rooms').doc('roomA')
                .collection('messages').doc('message1');
	
	Deleting a document does not delete its subcollections!
	
	Data types
	
    Null values
    Boolean values
    Integer and floating-point values, sorted in numerical order
    Date values
    Text string values
    Byte values
    Cloud Firestore references
    Geographical point values
    Array values
    Map values

	update
	var washingtonRef = db.collection("cities").doc("DC");

	// Set the "capital" field of the city 'DC'
	return washingtonRef.update({
		capital: true
	})
	.then(function() {
		console.log("Document successfully updated!");
	})
	.catch(function(error) {
		// The document probably doesn't exist.
		console.error("Error updating document: ", error);
	});

	//You can also add server timestamps to specific fields in your documents, to track when an update was received by the server:
	var docRef = db.collection('objects').doc('some-id');

	// Update the timestamp field with the value from the server
	var updateTimestamp = docRef.update({
		timestamp: firebase.firestore.FieldValue.serverTimestamp()
	});

	//Update elements in an array

	var washingtonRef = db.collection("cities").doc("DC");

	// Atomically add a new region to the "regions" array field.
	washingtonRef.update({
		regions: firebase.firestore.FieldValue.arrayUnion("greater_virginia")
	});
	
	// Atomically remove a region from the "regions" array field.
	washingtonRef.update({
		regions: firebase.firestore.FieldValue.arrayRemove("east_coast")
	});

	Transaction
	// Create a reference to the SF doc.
var sfDocRef = db.collection("cities").doc("SF");

// Uncomment to initialize the doc.
// sfDocRef.set({ population: 0 });

return db.runTransaction(function(transaction) {
    // This code may get re-run multiple times if there are conflicts.
    return transaction.get(sfDocRef).then(function(sfDoc) {
        if (!sfDoc.exists) {
            throw "Document does not exist!";
        }

        var newPopulation = sfDoc.data().population + 1;
        transaction.update(sfDocRef, { population: newPopulation });
    });
	}).then(function() {
		console.log("Transaction successfully committed!");
	}).catch(function(error) {
		console.log("Transaction failed: ", error);
	});
////

</script>
<script>
	var homeUrl = '<?php echo COMPLETE_HTTP_PATH; ?>';
	var firebaseDatabase = firebase.database();
	var userLocation = {};
	///*
	function addInFb(obj) {
		let url = '<?php //echo FIREBASE_BASEPATH; ?>/trackPages/<?php //echo date('Y-m-d'); ?>/user_<?php //echo !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : ''; ?>';
		let uniqueID = firebaseDatabase.ref(url).push(obj).key;
		firebaseDatabase.ref(url).child(uniqueID).child('id').set(uniqueID);
	}
	function trackPage() {
		let obj = {
			page: '<?php //echo $_SERVER['REQUEST_URI']; ?>',
			user_id: <?php //echo !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : -1; ?>,
			ip: '<?php //echo $_SERVER['REMOTE_ADDR']; ?>',
			datetime: firebase.database.ServerValue.TIMESTAMP,
			useragent: '<?php //echo $_SERVER['HTTP_USER_AGENT']; ?>'
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
	////
	//trackPage();
	//let url = '<?php //echo FIREBASE_BASEPATH; ?>/somepath';
	//firebaseDatabase.ref(url).child(this.state.deleteIssueModalData.id).set(null);

	//ref.off();
	//ref.on('value', (snapshot) => {
	//	var result = snapshot.val();
	//});
	//let ref = firebaseDatabase.ref(url).limitToLast(500);
	//var current = firebase.database.ServerValue.TIMESTAMP;
	
	//var url = FirebaseConstant.basePath + '/data/posts';
	//var uniqueID = firebaseDatabase.ref(url).push(obj).key;
	//firebaseDatabase.ref(url).child(uniqueID).child('id').set(uniqueID);
	
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
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
*/
?>