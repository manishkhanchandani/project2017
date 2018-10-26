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
const authData = {
    "id": profile.getId(),
    "id_token": id_token
}
const options = {
    "authData": authData
}
const user = new Parse.User();
user._linkWith('google', options).then(function(user) {
    console.log('Successful user._linkWith(). returned user=' + JSON.stringify(user))
}, function(error) {
    console.log('Error linking/creating user: ' + error)
    alert('Error linking/creating user: ' + error)
    // TODO handle error
})
</script>
</head>

<body>
</body>
</html>
