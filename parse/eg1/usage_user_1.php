<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
  <script src="https://npmcdn.com/parse@1.8.5/dist/parse-latest.js"></script>

<script>
Parse.initialize("myAppID");
Parse.serverURL = "https://parse-server-mk1.herokuapp.com/parse";

var user = new Parse.User();
user.set("username", "mkgxy@mkgalaxy.com");
user.set("password", "password01");
user.set("email", "mkgxy@mkgalaxy.com");
user.set("foo", "bar");

user.set("name", "manish k2");
user.set("gender", "male");


Parse.User.requestPasswordReset("mkgxy@mkgalaxy.com").then(
	function () {
		console.log('reset email in is ');
	}
);

/*
user.signUp().then(
	function success(user) {
		console.log('user is ', user);
	},
	function error(err) {
		console.log('err is ', err);
	}
);

Parse.User.logIn("manishkk74@gmail.com", "password01").then(
	function (user) {
		console.log('user logged in is ', user);
		console.log('2: ', Parse.User.current());
	}
);
Parse.User.logOut("manishkk74@gmail.com", "password01").then(
	function (user) {
		console.log('user logged out is ', user);
		console.log('3: ', Parse.User.current());
	}
);

Parse.User.logIn("manishkk74@gmail.com", "password01").then(
	function (user) {
		var Post = Parse.Object.extend("Post");//create new class, table
		var post = new Post(); //new row
		post.set("author", Parse.User.current()); 
		post.save().then(function() {
			console.log("Posted");
		});
	}
);

var q = new Parse.Query("User");
q.find().then(function (results) {
	console.log('r is ', results);
});*/
</script>
</head>
<body>

</body>
</html>