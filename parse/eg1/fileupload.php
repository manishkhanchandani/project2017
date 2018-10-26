<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="parse-latest.js"></script>
<script src="jquery.min.js"></script>
<script>
Parse.initialize("myAppID");
Parse.serverURL = "https://mkparse.info/parse";

$(document).ready(function() {
	console.log('jquery loaded');
	$("#buttonEl").on("click", function() {
		console.log('button clicked');
		
		var fileUploadControl = $("#inputEl")[0];
		console.log('fileUploadControl: ', fileUploadControl);
		console.log('fileUploadControl.files: ', fileUploadControl.files);
		if (fileUploadControl.files.length > 0) {
			var file = fileUploadControl.files[0];
			var name = file.name;
			console.log("file uploaded", name);
			console.log("file uploaded ", file);
			
			var parseFile = new Parse.File(name, file);
			parseFile.save().then(() => {
				console.log('parse: ', parseFile.url());
				$("#imageEl").attr("src", parseFile.url());
			});
		}
	});
});
</script>
</head>

<body>
<h1>File Upload</h1>
<p>
<img src="" alt="" id="imageEl" />
</p>
<input type="file" id="inputEl" name="inputEl" />
<input type="button" id="buttonEl" name="buttonEl" value="Upload" />
</body>
</html>
