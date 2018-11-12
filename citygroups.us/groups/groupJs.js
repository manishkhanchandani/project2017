function createNewGroup(apiUrl, obj, returnUrl=null) {
	$('#groupErrorJS').hide();
	$.post( apiUrl, obj)
	  .done(function( data ) {
		const docRef = dbFirestore.collection("groups").doc(data.data.row_rsGroups.group_id);
		docRef.set(data.data.row_rsGroups).then(() => {
			if (returnUrl) {
				window.location.href = returnUrl;
			} else if (data.data.url) {
				window.location.href = data.data.url;
			}
		}).catch((error) => {
			//delete the group from databaase
			$('#groupErrorJS').show();
			$('#groupErrorJS').html(error);
		});
	  }).fail(function(err, err2, err3) {
		$('#groupErrorJS').show();
		$('#groupErrorJS').html(err2);
	  });
}

function getSingleData(id) {
	var promise = new Promise((resolve, reject) => {
		
		var docRef = dbFirestore.collection("groups").doc(id);
	
		docRef.get().then(function(doc) {
			if (doc.exists) {
				console.log("Document data:", doc.data());
				resolve(doc.data());
			} else {
				// doc.data() will be undefined in this case
				console.log("No such document!");
				reject(null);
			}
		}).catch(function(error) {
			console.log("Error getting document:", error);
			reject(null);
		});				   
	});
	return promise;
}