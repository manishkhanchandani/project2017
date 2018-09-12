<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="parse-latest.js"></script>
<script>
Parse.initialize("myAppID");
Parse.serverURL = "https://parse-server-mk1.herokuapp.com/parse";

var TestObject = Parse.Object.extend("TestObject1");

const main = (user) => {
	console.log("main called");
	console.log('user is ', user);
	let u = Parse.User.current();
	let testObj = new TestObject();
	
	let groupACL = new Parse.ACL();
	groupACL.setWriteAccess(u, true);
	groupACL.setPublicReadAccess(true);
	
	testObj.setACL(groupACL);//this user can read and write
	testObj.set("foo1", "bar1");
	testObj.save().then((obj) => {
		console.log("saved test object with id ", obj.id);
	});
}

Parse.User.logIn("mkgxy@mkgalaxy.com", "password01").then(main);


/*

only one user acl
const main = (user) => {
	console.log("main called");
	console.log('user is ', user);
	let testObj = new TestObject();
	testObj.setACL(new Parse.ACL(Parse.User.current()));//this user can read and write
	testObj.set("foo1", "bar1");
	testObj.save().then((obj) => {
		console.log("saved test object with id ", obj.id);
	});
}


multiple read write
const main = (user) => {
	console.log("main called");
	console.log('user is ', user);
	let u = Parse.User.current();
	let testObj = new TestObject();
	
	let groupACL = new Parse.ACL();
	groupACL.setWriteAccess(u, true);
	groupACL.setReadAccess(u, true);
	
	testObj.setACL(groupACL);//this user can read and write
	testObj.set("foo1", "bar1");
	testObj.save().then((obj) => {
		console.log("saved test object with id ", obj.id);
	});
}

public read access

const main = (user) => {
	console.log("main called");
	console.log('user is ', user);
	let u = Parse.User.current();
	let testObj = new TestObject();
	
	let groupACL = new Parse.ACL();
	groupACL.setWriteAccess(u, true);
	groupACL.setPublicReadAccess(true);
	
	testObj.setACL(groupACL);//this user can read and write
	testObj.set("foo1", "bar1");
	testObj.save().then((obj) => {
		console.log("saved test object with id ", obj.id);
	});
}
*/
</script>
</head>

<body>
</body>
</html>
