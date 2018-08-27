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

var Post = Parse.Object.extend("TestObject1");//create new class, table
var post = new Post(); //new row
let data = {
	foo: 'bar',
	age: 32
};
post.save(data, {
	success: (obj) => {
		console.log('successfully saved: ', obj.id);
	},
	error: (obj, err) => {
		console.log(' object: ', obj);console.log(' error: ', err);
	}
});

</script>
</head>
<body>

</body>
</html>