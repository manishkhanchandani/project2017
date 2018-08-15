<?php 

define('ENV', 'dev');
$dir = dirname($_SERVER['PHP_SELF']);
if ($dir === '/') $dir = '';
$dir = $dir .'/';

$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
define('SITENAME', $host);

define('ROOTDOMAIN', $host);
define('HTTPPATH', $_SERVER['REQUEST_SCHEME'].'://'.$host.$dir);

define('COMPLETE_HTTP_PATH', HTTPPATH);
define('ROOTHTTPPATH', $dir);
define('APIDIR', $dir.'api');
define('APIHTTPPATH', 'http://'.$host.APIDIR);

define('ADMIN_USER', '112913147917981568678');
define('ADMIN_EMAIL', 'manishkk74@gmail.com');
define('LOGINURL', 'users/login');
define('PLACESAPIKEY', 'AIzaSyBvXqWIcqyTVRgjXsVjDbdORcNaXHVjtOw');
define('DEFAULT_LATITUDE', 37.3867);
define('DEFAULT_LONGITUDE', -121.897);
define('ENCRYPTKEY', 'JKjVXtFdY3NNT6Fp6U9uM3m5eeWbtqXWrR5qwWpyM9b8SFSdWVK2vruN');

define('CLIENTID', '754890700194-4p5reil092esbpr9p3kk46pf31vkl3ub.apps.googleusercontent.com');
define('CLIENTSECRET', '8uvHeE3vQU1HQU0JoA1mRQTK');
define('DEVELOPERKEY', 'AIzaSyCWqKxrgU8N1SGtNoD6uD6wFoGeEz0xwbs');

ini_set("include_path", BASE_DIR.DIRECTORY_SEPARATOR.'libraries'.PATH_SEPARATOR . ini_get("include_path") );
ini_set("include_path", ROOT_DIR.DIRECTORY_SEPARATOR.'api'.PATH_SEPARATOR . ini_get("include_path") );

function myautoload($class_name) {
    $classPath = ROOT_DIR.DIRECTORY_SEPARATOR.'api'.DIRECTORY_SEPARATOR.'help'.DIRECTORY_SEPARATOR.'MkGalaxy'.DIRECTORY_SEPARATOR.implode('/', explode('_', $class_name));

   if (file_exists($classPath.'.class.php')) {
    include_once $classPath . '.class.php';
   }
}
spl_autoload_register('myautoload', true);


/*
if (isset($_GET['clearSession']) || empty($_COOKIE['ipDetails'])) {
  $_SESSION['location'] = '';
}


if (empty($_SESSION['location']['ipDetails'])) {
	$ip = ($_SERVER['REMOTE_ADDR'] === '::1') ? '67.218.103.16' : $_SERVER['REMOTE_ADDR'];
	$ipDetails = curlget('http://api.mkgalaxy.com/ip.php?ip='.$ip);
	pr($ipDetails);
	if (!empty($ipDetails)) {
		$tmp = json_decode($ipDetails, true);
		$_SESSION['location']['ipDetails'] = !empty($tmp['data']['result']) ? $tmp['data']['result'] : '';
		$loc = json_encode($_SESSION['location']['ipDetails']);
		setcookie('ipDetails', $loc, time() + (60 * 60 * 4), '/');
		$_COOKIE['ipDetails'] = $loc;
	}
}


if (empty($_SESSION['location']['nearby'])) {
	$lat = !empty($_SESSION['location']['ipDetails']['lat']) ? $_SESSION['location']['ipDetails']['lat']: '';
	$lng = !empty($_SESSION['location']['ipDetails']['lng']) ? $_SESSION['location']['ipDetails']['lng']: '';
	if (!empty($lat) && !empty($lng)) {
		$location = curlget('http://api.mkgalaxy.com/api.php?action=nearby&lat='.$lat.'&lng='.$lng);
		$tmp = json_decode($location, true);
		$_SESSION['location']['nearby'] = !empty($tmp['data']) ? $tmp['data'] : '';
	}
}


pr($_SESSION);
*/

$modelGeneral = new General($connMainAdodb);

define('DEFAULT_IMAGE', HTTPPATH.'images/no-image-available.jpg');
$domainConfig = array();

switch ($host) {
	case 'donation.mkgalaxy.com':
		$domainConfig = array(
			'site_url' => 'd',
			'site_name' => 'Donation',
			'site_email' => 'donation@mkgalaxy.com',
			'template_file' => 'd/template.php',
			'firebase_dir' => '/d',
  			'homeUrl' => 'd/home',
			'pageTitle' => 'Donation'
		);
		break;
	case 'ineedservice.us':
		$domainConfig = array(
			'site_url' => 's',
			'site_name' => 'I Need Service',
			'site_email' => 'ineedservice@mkgalaxy.com',
			'template_file' => 's/template.php',
			'firebase_dir' => '/s',
  			'homeUrl' => 's/home',
			'pageTitle' => 'Service'
		);
		break;
	case 'citygroups.us':
		$domainConfig = array(
			'site_url' => 'g',
			'site_name' => 'City Groups',
			'site_email' => 'citygroups@mkgalaxy.com',
			'template_file' => 'g/template.php',
			'firebase_dir' => '/g',
  			'homeUrl' => 'g/home',
			'pageTitle' => 'City'
		);
		break;
	default:
		$domainConfig = array(
			'site_url' => 's',
			'site_name' => 'I Need Service',
			'site_email' => 'ineedservice@mkgalaxy.com',
			'template_file' => 'template.php',
			'firebase_dir' => '/s',
  			'homeUrl' => 'home',
			'pageTitle' => 'Service'
		);
		break;
}

if (empty($domainConfig['site_url'])) {
	echo 'missing config';
	exit;
}


if (file_exists(ROOT_DIR.DIRECTORY_SEPARATOR.'sites'.DIRECTORY_SEPARATOR.$domainConfig['site_url'].DIRECTORY_SEPARATOR.'config.php')) {
	include_once(ROOT_DIR.DIRECTORY_SEPARATOR.'sites'.DIRECTORY_SEPARATOR.$domainConfig['site_url'].DIRECTORY_SEPARATOR.'config.php');
}


?>