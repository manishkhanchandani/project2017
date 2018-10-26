<?php

//parse
use Parse\ParseClient;
use Parse\ParseUser;

try {
ParseClient::initialize( PARSE_APP_ID, null, PARSE_MASTER_KEY );
ParseClient::setServerURL(PARSE_SERVER_URL, PARSE_MOUNT_PATH);

	$user = new ParseUser();
	$user->setUsername("foo1");
	$user->setPassword("Q2w#4!o)df");
    $user->signUp();
} catch (ParseException $ex) {
    echo $ex->getMessage();
}
?>
<h1>Parse Play Ground</h1>
<p>&nbsp;</p>
