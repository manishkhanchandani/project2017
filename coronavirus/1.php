<?php
require '../Library/parse-php-sdk/autoload.php';
include('../functions.php');
define('app_id', 'myAppId');
define('master_key', 'myMasterKey');
define('server_url', 'https://hitliaapp.herokuapp.com');
Parse\ParseClient::initialize( app_id, null, master_key );
Parse\ParseClient::setServerURL(server_url, 'parse');

use Parse\ParseException;
use Parse\ParseObject;

$sid = date('r');
$sidTime = time();


	$object = Parse\ParseObject::create("CoronavirusSids");
	$objectId = $object->getObjectId();
	$object->set('sid', $sid);
	$object->set('sidTime', $sidTime);
	$object->save();

$url = 'https://www.worldometers.info/coronavirus/';
$page = curlget($url);
$html = $page['output'];
if ($html === 'Database connection failed: Too many connections (1040)') {
	echo 'hi';
	exit;	
}
$matches = regexp($html, '<div class="main_table_countries_div">.*<table id="main_table_countries_today".*>.*<thead>.*<\/thead>.*<tbody>(.*)<\/tbody>.*<\/div>');
$content = $matches[0][1];
if (empty($content)) {
	echo 'no content';
	exit;	
}
$matches2 = regexp($content, '<tr.*>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<\/tr>');
//pr($matches2);
if (empty($matches2)) {
	echo 'no matches';
	exit;	
}
$keys = array(1 => 'country', 'total_cases', 'new_cases', 'total_deaths', 'new_deaths', 'total_recovered', 'active_cases', 'serious_critical', 'totalcases_1mpop', 'totaldeaths_1mpop');
$result = array();
$sorting = 0;
foreach ($matches2 as $k => $v) {
	foreach ($v as $k1 => $v1) {
		if ($k1 === 0) continue;
		$result[$k][$keys[$k1]] = strip_tags($v1);
	}
	$object = Parse\ParseObject::create("Coronavirus");
	$objectId = $object->getObjectId();
	foreach($keys as $x => $y) {
		$object->set($y, $result[$k][$keys[$x]]);
	}
	$object->set('sid', $sid);
	$object->set('sorting', $sorting);
	$object->save();
	$sorting++;
}
pr($result);
file_put_contents('files/'.date('Y_m_d_h_i_s').'.json', json_encode($result));

