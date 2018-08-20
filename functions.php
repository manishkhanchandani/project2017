<?php

define('COOKIE_FILE_PATH', '');

if (!function_exists('curlget')) {
	function curlget($url) {
		$https = 0;
		if (substr($url, 0, 5) === 'https') {
			$https = 1;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);  

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
		curl_setopt($ch, CURLOPT_COOKIEJAR,COOKIE_FILE_PATH);
		if (!empty($https)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		$result = curl_exec($ch); 
		$data = array();
		$data['output'] = $result;
		$data['http_code'] = curl_getinfo ($ch, CURLINFO_HTTP_CODE);
		$data['errorNo'] = curl_errno($ch);
		$data['errorMsg'] = curl_error($ch);
		$data['return_headers'] = curl_getinfo($ch);
		curl_close($ch);
		return $data;
	}
}


if (!function_exists('curlpost')) {
	function curlpost($url, $POSTFIELDS='') {
		$https = 0;
		if (substr($url, 0, 5) === 'https') {
			$https = 1;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
		curl_setopt($ch, CURLOPT_COOKIEJAR,COOKIE_FILE_PATH);
		if (!empty($https)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		$result = curl_exec($ch); 
		$data = array();
		$data['output'] = $result;
		$data['http_code'] = curl_getinfo ($ch, CURLINFO_HTTP_CODE);
		$data['errorNo'] = curl_errno($ch);
		$data['errorMsg'] = curl_error($ch);
		$data['return_headers'] = curl_getinfo($ch);
		curl_close($ch);
		return $data;
	}
}


if (!function_exists('curlpostjson')) {
	function curlpostjson($url, $json='') {
		$https = 0;
		if (substr($url, 0, 5) === 'https') {
			$https = 1;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $json );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($json))                                                                       
        );
		

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
		curl_setopt($ch, CURLOPT_COOKIEJAR,COOKIE_FILE_PATH);
		if (!empty($https)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		$result = curl_exec($ch);
		$data = array();
		$data['output'] = $result;
		$data['http_code'] = curl_getinfo ($ch, CURLINFO_HTTP_CODE);
		$data['errorNo'] = curl_errno($ch);
		$data['errorMsg'] = curl_error($ch);
		$data['return_headers'] = curl_getinfo($ch);
		curl_close($ch);
		return $data;
	}
}


if (!function_exists('pr')) {
function pr($value)
	{
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		return true;
	}
}
if (!function_exists('regexp')) {
	function regexp($input, $regexp, $casesensitive=false)
	{
		if ($casesensitive === true) {
			if (preg_match_all("/$regexp/sU", $input, $matches, PREG_SET_ORDER)) {
				return $matches;
			}
		} else {
			if (preg_match_all("/$regexp/siU", $input, $matches, PREG_SET_ORDER)) {
				return $matches;
			}
		}

		return false;
	}
}

if (!function_exists('GetSQLValueString')) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


if (!function_exists('time_elapsed_string')) {
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
}


if (!function_exists('timeAgo')) {
function timeAgo($datetime) {
	$now = time();
	$ago = strtotime($datetime);
	$ago = $ago - (60 * 60 * 3);//5
    $seconds = $now - $ago;
	if ($seconds < 0 ) $seconds = 0;
	$interval = floor($seconds / 31536000);
	if ($interval > 1) {
	  return $interval . " years ago";
	}
	
	$interval = floor($seconds / 2592000);
	if ($interval > 1) {
	  return $interval . " months ago";
	}
	
	$interval = floor($seconds / 86400);
	if ($interval > 1) {
	  return $interval . " days ago";
	}
	
	$interval = floor($seconds / 3600);
	if ($interval > 1) {
	  return $interval . " hours ago";
	}
	
	$interval = floor($seconds / 60);
	if ($interval > 1) {
	  return $interval . " minutes ago";
	}
	
	return 'just now';
}
}


if (!function_exists('getIsCrawler')) {
	function getIsCrawler($userAgent) {
		$crawlers = 'Googlebot|bot|Facebook';
		/*'Google|msnbot|Rambler|Yahoo|AbachoBOT|accoona|' .
		'AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|' .
		'GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';*/
		$isCrawler = (preg_match("/$crawlers/si", $userAgent) > 0);
		return $isCrawler;
	}
}



if (!function_exists('yearToAge')) {
function yearToAge($year) {
  $currentYear = date('Y');
  return $currentYear - $year;
}
}


if (!function_exists('isAuthorized')) {
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
}

if (!function_exists('redirect')) {
function redirect($MM_restrictGoTo, $MM_authorizedUsers) { //HTTPPATH.'/users/login'
	if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
	  $MM_qsChar = "?";
	  $MM_referrer = $_SERVER['REQUEST_URI'];
	  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
	  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
	  header("Location: ". $MM_restrictGoTo); 
	  exit;
	}

}
}
?>