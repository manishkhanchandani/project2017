<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="parse-latest.js"></script>
<script>
Parse.initialize("myAppID");
Parse.serverURL = "https://mkparse.info/parse"; //"https://parse-server-mk1.herokuapp.com/parse";

let myAuthData = {
  "id": "785942793642401793",
  "screen_name": "rollypolly74",
  "consumer_key": "DgBjBDeWWu0btWv6CtlqrjbPc",
  "consumer_secret": "oJ0TNz7ntakc8x67ylQuSZnZ0CAzij0aupYeAWyMPEVmUrNr66",
  "auth_token": "785942793642401793-Tro9YNXvhfSfrkLbPQ1w5CbbUZFFYpb",
  "auth_token_secret": "RQ32id3UKNiUxdZeE6KLLkPl48yK6VhNf0sWQDghSakmw"
}
let user = new Parse.User();
user._linkWith('twitter', myAuthData).then(function(user){
    // user
	console.log('twitter: ', user);
});
</script>
</head>

<body>
</body>
</html>
