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

let createRoles = () => {
	let roleACL = new Parse.ACL;
	roleACL.setPublicReadAccess(true);
	roleACL.setWriteAccess(Parse.User.current(), true);
	
	let role = new Parse.Role("Admin", roleACL);
	
	role.save().then(() => {
		role.getUsers().add(Parse.User.current());
		role.save().then(() => {
			console.log('role created ', role.id);
		});
	});
};


Parse.User.logIn("mkgxy@mkgalaxy.com", "password01").then(createRoles);


</script>
</head>

<body>
</body>
</html>
