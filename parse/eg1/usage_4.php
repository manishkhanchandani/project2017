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

var TestObject1 = Parse.Object.extend("TestObject1");//create new class, table
var q = new Parse.Query("TestObject1");

var res = [];

q.equalTo("foo", "bar");
q.find().then((results) => {
	res = results;
	console.log('res is ', res);
	for (let i = 0; i < results.length; i++) {
		console.log('result: ', results[i]);
	}
});

var subscription = q.subscribe();
subscription.on('open', () => {
	console.log('subscription opened ....');
});

subscription.on('create', (obj) => {
	console.log('object created ....', obj.attributes);
});

subscription.on('update', (obj) => {
	console.log('object updated ....', obj.attributes);
});

subscription.on('enter', (obj) => {
	console.log('object entered ....', obj.attributes);
});

subscription.on('leave', (obj) => {
	console.log('object left ....', obj.attributes);
});

</script>
</head>
<body>

</body>
</html>