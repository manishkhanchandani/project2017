<?php
 /* Copyright (c) 2015 Yubico AB
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above
 *     copyright notice, this list of conditions and the following
 *     disclaimer in the documentation and/or other materials provided
 *     with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
/**
 * This is a basic example of a u2f-server command line that can be used 
 * with the u2f-host binary to perform regitrations and authentications.
 */ 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$res = array();
$res['error'] = 0;
if (empty($_GET['mode'])) {
	$res['error'] = 1;
	$res['mes'] = 'empty mode';
	echo json_encode($res);
	exit;
}

$mode = $_GET['mode']; //register, authenticate
if (!($mode === 'register' || $mode === 'authenticate')) {
	$res['error'] = 1;
	$res['mes'] = 'wrong mode';
	echo json_encode($res);
	exit;
}
$registration = '';
if ($mode === 'authenticate') {
	if (empty($_GET['registration'])) {
		$res['error'] = 1;
		$res['mes'] = 'wrong registration';
		echo json_encode($res);
		exit;
	}
	$registration = $_GET['registration'];
	$regs = json_decode('[' . $registration . ']');
}

if (empty($_GET['o'])) {
	$res['error'] = 1;
	$res['mes'] = 'origin must be supplied';
	echo json_encode($res);
	exit;
}

require_once('U2F.php');
$mode;
$challenge;
$response;
$result;
$regs;
$u2f = new u2flib_server\U2F($_GET['o']);
if($mode === "register") {
  $challenge = $u2f->getRegisterData();
} elseif($mode === "authenticate") {
  $challenge = $u2f->getAuthenticateData($regs);
}
echo '<pre>';
print_r($challenge);
exit;
print json_encode($challenge[0]) . "\n";
$response = fgets(STDIN);
if($mode === "register") {
  $result = $u2f->doRegister($challenge[0], json_decode($response));
} elseif($mode === "authenticate") {
  $result = $u2f->doAuthenticate($challenge, $regs, json_decode($response));
}
print json_encode($result) . "\n";
?>