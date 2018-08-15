<?php
session_name('my_session');
session_start();
define('ROOT_DIR', dirname(__FILE__));
define('BASE_DIR', dirname(dirname(__FILE__)));
include_once(ROOT_DIR.DIRECTORY_SEPARATOR.'conn.php');
include_once(BASE_DIR.DIRECTORY_SEPARATOR.'functions.php');
include_once(ROOT_DIR.DIRECTORY_SEPARATOR.'constants.php');
include_once(ROOT_DIR.DIRECTORY_SEPARATOR.'config.php');


$suffix = SUFFIX;
if (empty($_SESSION['MM_UserId']) && !empty($_COOKIE['MM_UserId'.$suffix])) {
	$_SESSION['MM_Username'] = $_COOKIE['MM_Username'.$suffix];
	$_SESSION['MM_Email'] = $_COOKIE['MM_Email'.$suffix];
    $_SESSION['MM_UserGroup'] = $_COOKIE['MM_UserGroup'.$suffix];
	$_SESSION['MM_UserId'] = $_COOKIE['MM_UserId'.$suffix];
	$_SESSION['MM_DisplayName'] = $_COOKIE['MM_DisplayName'.$suffix];
	$_SESSION['MM_ProfileImg'] = $_COOKIE['MM_ProfileImg'.$suffix];
	$_SESSION['MM_UID'] = $_COOKIE['MM_UID'.$suffix];
	$_SESSION['MM_LoggedInTime'] = $_COOKIE['MM_LoggedInTime'.$suffix];
	$_SESSION['MM_ProfileUID'] = $_COOKIE['MM_ProfileUID'.$suffix];
}


$base_page_path = 'sites'.'/'.$domainConfig['site_url'].'/';
$page = '';
$defaultPage = $base_page_path.'home.php';
$page = $defaultPage;

//override
if (!empty($_GET['q']['action'])) {
  $_GET['p'] = $_GET['q']['action'];
}
//end override

if (!empty($_GET['p'])) {
  $page = $_GET['p'];
}

if (!empty($_GET['direct']))
	$page = $page.'.php';
else
	$page = $base_page_path.$page.'.php';


$pageTitle = $domainConfig['pageTitle'];


ob_start();
if (file_exists($page)) {
  include($page);
} else {
  include($defaultPage);
}

$contentForTemplate = ob_get_clean();

if (!empty($_GET['isJson'])) {
	echo $contentForTemplate;
	exit;
}

include($base_page_path.$domainConfig['template_file']);
?>