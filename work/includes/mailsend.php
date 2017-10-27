<?php
$url = "http://greatdad.com/includes/mail.php"; // URL to POST FORM. (Action of Form)
// use PHP Fucntion url_encode() for post variable for application/x-www-form-urlencoded 
/*
$to = "manish@procentris.com";
$cc = "anup@procentris.com";
$bcc = "sashidhar@procentris.com";
$from = "virtual@virtual-india.net";
$subject = 'hi testing';
$message = "hello<br>
<h1>Procentris</h1>";
$name = "Webmaster";
*/
$post_fields = "to=".urlencode($to)."&cc=".urlencode($cc)."&bcc=".urlencode($bcc)."&from=".urlencode($from)."&name=".urlencode($name)."&subject=".urlencode($subject)."&message=".urlencode($message); // form Fields.

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_POST, 1); // use this option to Post a form
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Pass form Fields.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

?>