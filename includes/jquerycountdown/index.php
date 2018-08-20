<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>display</title>
<style type="text/css">

</style>
<script type="text/javascript" src="jquery-2.0.3.js"></script>
<script type="text/javascript" src="jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.countdownTimer.css" />
<script>
	function callme() {
		document.getElementById('timer').value = parseInt(document.getElementById('s_timer').innerHTML);
	}
</script>
</head>

<body>
<?php if (!empty($_POST)) {
print_r($_POST);
}?>
 <h3><u>Reverse countdown to zero from time set to only seconds.</u></h3>
                            <span id="s_timer"></span><br/>
<form method="post" onSubmit="callme()">
	<input type="text" name="timer" id="timer" />
    <label>
    <input type="submit" name="Submit" value="Submit">
    </label>
</form>

<script>
	$(function(){
		$('#s_timer').countdowntimer({
			seconds :11,
			size : "lg",
			reverseDir: true
		});
	});
</script>
</body>
</html>