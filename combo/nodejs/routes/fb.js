var express = require('express');
var router = express.Router();
var Firebase = require('firebase');
var btoa = require('btoa');
var config = require('../config'); // get our config file
var admin = require("firebase-admin");
var jwt    = require('jsonwebtoken'); 
const expressJwt = require('express-jwt');  
const authenticate = expressJwt({secret : 'ilovescotchyscotch'});

// Use the shorthand notation to retrieve the default app's services
var defaultAuth = admin.auth();
var defaultDatabase = admin.database();
var fbRef = defaultDatabase.ref(config.firebasePath);
var userRef = defaultDatabase.ref(config.firebaseUsersPath);
var uid = 'h1KYKSR0ZnX36IdIJUWk1FQZjuF3';
var adminUID = 'kMstRTsgEBe4yj1twnziC6IX7432';

var dummyObj = {
	one: 1,
	two: 2
};

router.get('/', function(req, res, next) {
  	res.send(dummyObj);
});

/*
//Auth
router.get('/auth/', function(req, res, next) {
  	res.send(dummyObj);
});


router.post('/auth/', function(req, res, next) {
	const payload = {
      admin: 'YWRtaW46cGFzc3dvcmQ='
    };
	var token = jwt.sign(payload, 'ilovescotchyscotch', {
	  expiresIn : 60*60*24 // expires in 24 hours
	});
	res.json({
	  success: true,
	  message: 'Enjoy your token!',
	  token: token
	});
});

//Enterprise
router.get('/enterprise/', function(req, res, next) {
	var userId = adminUID;
	if(req.query.uid) {
		userId = req.query.uid;
	}
	if (userId !== adminUID) {
		var ref = fbRef.child('enterprise_users').child(userId);

		ref.once('value', function(snapshot){
			var enterprise = [];
			var obj = {};

			var ref2 = fbRef.child('enterprise').child(snapshot.val());
			ref2.once('value', function(snapshot2){
				obj = snapshot2.val();
				enterprise.push(obj);
				res.send(enterprise);
			});
		});
	}

	if (userId === adminUID) {
		var enterprise = [];
		var ref2 = fbRef.child('enterprise');
		ref2.once('value', function(snapshot2){
			snapshot2.forEach(function(childSnapshot){
				enterprise.push(childSnapshot.val());
			});
			res.send(enterprise);
		});
	}
});
*/
/*
http://localhost:5000/enterprise/
{
"EnterpriseName": "Honeywell",
"AccountType":"Regular",
"Services":"Normal"
}
*/
/*
router.post('/enterprise/', function(req, res, next) {
	var response = {};
	response.success = true;
	response.message = '';
	response.data = null;
	var obj = {};
	obj.EnterpriseName = req.body.EnterpriseName;
	obj.AccountType = req.body.AccountType;
	obj.Services = req.body.Services;
	response.data = obj;
	var ref = fbRef.child('enterprise').child(obj.EnterpriseName).set(obj);
	res.status(201);
	res.send(obj);
});

router.get('/enterprise/:EnterpriseName', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	var ref = fbRef.child('enterprise').child(EnterpriseName);
	ref.once('value', function(snapshot){
		res.status(201);
		res.send(snapshot.val());
	});
});


router.delete('/enterprise/:EnterpriseName', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var refU = fbRef.child('enterprise_users');
	refU.orderByValue().equalTo(EnterpriseName).once('value', function(snapshot){
		console.log('snapshot is ', snapshot.val());
		snapshot.forEach(function(childSnapshot){
			console.log('childSnapshot val is ', childSnapshot.val());
			console.log('index val is ', childSnapshot.key);
			fbRef.child('enterprise_users').child(childSnapshot.key).set(null);
		});
	});
	var ref = fbRef.child('enterprise').child(EnterpriseName).set(null);
	var obj = {success: true};
	res.status(201);
	res.send(obj);
});

//Site
router.get('/enterprise/:EnterpriseName/site/', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var ref = fbRef.child('site').child(EnterpriseName);

		ref.once('value', function(snapshot) {
			var obj = [];
			if (!snapshot.exists()) {
				res.send(obj);
				return;
			}

			var records = snapshot.val();
			for (var key in records) {
				obj.push(records[key])
			}
			res.send(obj);
		});
});

router.post('/enterprise/:EnterpriseName/site/', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var response = {};
	response.success = true;
	response.message = '';
	response.data = null;
	var obj = {};
	obj.SiteName = req.body.SiteName;
	obj.MCC = req.body.MCC;
	obj.MNC = req.body.MNC;
	obj.EnterpriseName = EnterpriseName;
	response.data = obj;
	var ref = fbRef.child('site').child(EnterpriseName).child(obj.SiteName).set(obj);
	res.status(201);
	res.send(obj);
});

router.get('/enterprise/:EnterpriseName/site/:SiteName', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

router.delete('/enterprise/:EnterpriseName/site/:SiteName', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var SiteName = req.params.SiteName;
	var ref = fbRef.child('site').child(EnterpriseName).child(SiteName).set(null);
	var obj = {success: true};
	res.status(201);
	res.send(obj);
});

//APN
router.get('/enterprise/:EnterpriseName/site/:SiteName/apn/', function(req, res, next) {

	let enterprise = [];
	var EnterpriseName = req.params.EnterpriseName;
	var SiteName = req.params.SiteName;
	var ref = fbRef.child('apn').child(EnterpriseName).child(SiteName);

	ref.once('value', function(snapshot){
		var enterprise = [];

		snapshot.forEach(function(childSnapshot){
			enterprise.push(childSnapshot.val());
		});
		res.send(enterprise);
	});

});

router.post('/enterprise/:EnterpriseName/site/:SiteName/apn/', function(req, res, next) {
	var response = {};
	response.success = true;
	response.message = '';
	response.data = null;
	var EnterpriseName = req.params.EnterpriseName;
	var SiteName = req.params.SiteName;
	var obj = {};
	obj.ApnName = req.body.ApnName;
	obj.AmbrMaxDl = req.body.AmbrMaxDl;
	obj.AmbrMaxUl = req.body.AmbrMaxUl;
	obj.IPPoolEndIp = req.body.IPPoolEndIp;
	obj.IPPoolNetwork = req.body.IPPoolNetwork;
	obj.IPPoolStartIp = req.body.IPPoolStartIp;
	obj.IPPoolSubnetMask = req.body.IPPoolSubnetMask;
	response.data = obj;
	var ref = fbRef.child('apn').child(EnterpriseName).child(SiteName).child(btoa(obj.ApnName)).set(obj);
	res.status(201);
	res.send(obj);
});

router.get('/enterprise/:EnterpriseName/site/:SiteName/apn/:ApnName', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

router.delete('/enterprise/:EnterpriseName/site/:SiteName/apn/:ApnName', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var SiteName = req.params.SiteName;
	var ApnName = req.params.ApnName;
	var ref = fbRef.child('apn').child(EnterpriseName).child(SiteName).child(btoa(ApnName)).set(null);
	var obj = {success: true};
	res.status(201);
	res.send(obj);
});




//IDU

router.get('/enterprise/:EnterpriseName/site/:SiteName/idu/', function(req, res, next) {
	res.send(dummyObj);
});

router.post('/enterprise/:EnterpriseName/site/:SiteName/idu/', function(req, res, next) {
	res.send(dummyObj);
});

router.get('/enterprise/:EnterpriseName/site/:SiteName/idu/:IDuName', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

router.delete('/enterprise/:EnterpriseName/site/:SiteName/idu/:IDuName', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

//IMSI

router.get('/enterprise/:EnterpriseName/site/:SiteName/imsi/', function(req, res, next) {

		let enterprise = [];
		var EnterpriseName = req.params.EnterpriseName;
		var SiteName = req.params.SiteName;
		var ref = fbRef.child('imsi').child(EnterpriseName).child(SiteName);

		ref.once('value', function(snapshot){
			var enterprise = [];

			snapshot.forEach(function(childSnapshot){
				enterprise.push(childSnapshot.val());
			});
			res.send(enterprise);
		});
});

router.post('/enterprise/:EnterpriseName/site/:SiteName/imsi/', function(req, res, next) {
	res.send(dummyObj);
});

router.get('/enterprise/:EnterpriseName/site/:SiteName/imsi/:IMSI', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

router.delete('/enterprise/:EnterpriseName/site/:SiteName/imsi/:IMSI', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});


router.post('/enterprise/:EnterpriseName/site/:SiteName/bulkimsi/', function(req, res, next) {
	var response = {};
	response.success = true;
	response.message = '';
	response.data = null;
	var EnterpriseName = req.params.EnterpriseName;
	var SiteName = req.params.SiteName;
	var obj = {};
	obj.APN = req.body.APN;
	obj.IMSI = req.body.MSINRange;
	obj.Name = req.body.MSINRange;
	obj.IsOnline = true;
	response.data = obj;
	var ref = fbRef.child('imsi').child(EnterpriseName).child(SiteName).child(btoa(obj.IMSI)).set(obj);
	res.status(201);
	res.send(obj);
});



//User

router.get('/enterprise/:EnterpriseName/user/', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var ref = fbRef.child('subUsers').child(EnterpriseName);

		ref.once('value', function(snapshot) {
			var obj = [];
			if (!snapshot.exists()) {
				res.send(obj);
				return;
			}

			var records = snapshot.val();
			for (var key in records) {
				obj.push(records[key])
			}
			res.send(obj);
		});
});

router.post('/enterprise/:EnterpriseName/user/', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	var response = {};
	response.success = true;
	response.message = '';
	response.data = null;
	var obj = {};
	obj.UserName = req.body.UserName;
	obj.FirstName = req.body.FirstName;
	obj.LastName = req.body.LastName;
	obj.Password = req.body.Password;
	obj.UserRole = req.body.UserRole;
	obj.EnterpriseName = EnterpriseName;
	response.data = obj;
	var ref = fbRef.child('subUsers').child(EnterpriseName).child(btoa(obj.UserName)).set(obj);
	res.status(201);
	res.send(obj);
});

router.get('/enterprise/:EnterpriseName/user/:UserName', function(req, res){
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});

router.delete('/enterprise/:EnterpriseName/user/:UserName', function(req, res, next) {
	var EnterpriseName = req.params.EnterpriseName;
	res.send(dummyObj);
});
*/

module.exports = router;
