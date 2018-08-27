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

var Post = Parse.Object.extend("Post");//create new class, table
var post = new Post(); //new row
post.set("body", "Hello my name is Manish"); //create a new row
post.set("tags", ["first-post", "welcome"]);
post.set("numComments", 0);
post.save(null, {
	success: (obj) => {
		console.log('successfully saved: ', obj.id);
		var Comments = Parse.Object.extend("Comments");//create new class, table
		var comment = new Comments(); //new row
		comment.set("body", "comment 1"); //create a new row
		comment.set("parent", post);
		comment.save(null, {
			success: (obj) => {
				console.log('successfully saved comment: ', obj.id);
				var c = post.relation("comments");
				c.add(comment);
				post.save(null, {
					success: (obj) => {
						console.log('successfully post saved: ', obj.id);
					}
				});
			}
		});
		
		
		
		var q = new Parse.Query("Post");
		q.get(obj.id, {
			success: (obj2) => {
				console.log('successfully saved 2: ', obj2);
			},
			error: (obj2, err) => {console.log(' object2: ', obj2);console.log(' error2: ', err);}
		});
	},
	error: (obj, err) => {console.log(' object: ', obj);console.log(' error: ', err);}
});

</script>
</head>
<body>

</body>
</html>