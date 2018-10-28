<!DOCTYPE html>
<html>
<head>
<script src="jquery-2.2.4.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
  <script src="parse-latest.js"></script>

<script>
Parse.initialize("EpadXy6PyizcoNx07LuONVzLPniuwXXxNJB2EUN0");
//Parse.serverURL = "https://parse-server-mk1.herokuapp.com/parse";
Parse.serverURL = "https://parseapi.back4app.com/parse";
console.log(Parse.serverURL);

var user = new Parse.User();
user.set("username", "mkgxy@mkgalaxy.com");
user.set("password", "password01");
user.set("email", "mkgxy@mkgalaxy.com");
user.set("foo", "bar");
user.set("name", "manish k2");
user.set("gender", "male");

user.signUp().then(
	function success(user) {
		console.log('user is ', user);
	},
	function error(err) {
		console.log('err is ', err);
	}
);


</script>
</head>
<body>

</body>
</html>