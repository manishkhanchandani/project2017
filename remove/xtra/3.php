<?php
include('Mail.php');
echo get_include_path();
$from_name = "student"; // Japanese name 
    $to_name = "manish"; // Another Japanese name 
    $subject = "subkkdfkdjfkdjdfk"; // Japanese subject 
    $mailmsg = "message";
     

    $From = "From: ".$from_name." <student@mkgalaxy.com>"; 
    $To = "To: ".$to_name." <manishkk74@gmail.com>"; 

    $recipients = "naveenkhanchandani@gmail.com"; 
    $headers["From"] = $From; 
    $headers["To"] = $To; 
    $headers["Subject"] = $subject; 
    $headers["Reply-To"] = "student@mkgalaxy.com"; 
    $headers["Content-Type"] = "text/plain"; 
    $headers["Return-path"] = "student@mkgalaxy.com"; 
     
    $smtpinfo["host"] = "mail.mkgalaxy.com"; 
    $smtpinfo["port"] = "25"; 
    $smtpinfo["auth"] = true; 
    $smtpinfo["username"] = "student@mkgalaxy.com"; 
    $smtpinfo["password"] = "f45Wi?!i3X+x"; 

    $mail_object =& Mail::factory("smtp", $smtpinfo); 

    $mail_object->send($recipients, $headers, $mailmsg); 
?>