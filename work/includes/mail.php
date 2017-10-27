<?php
$to = $_POST['to'];
$from = $_POST['from'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$cc = $_POST['cc'];
$bcc = $_POST['bcc'];
function emailinhtml($to,$subject,$message,$from,$name,$cc,$bcc) {
	// HTML HEADER
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8895-1\r\n";
	$headers .= "From: ".$name."<".$from.">\r\n";
	$headers .= "Cc: ".$cc."\r\n";
	$headers .= "Bcc: ".$bcc."\r\n";

	$message = "<html><head></head><body>".$message."</body></html>";
	//$to = $email.",".$email2.",".$email3; Like this
	if(@mail($to,$subject,$message,$headers)) {
		echo 1;
	} else {
		echo 0;
	}
}
emailinhtml($to,$subject,$message,$from,$name,$cc,$bcc);
?>