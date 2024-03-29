<?php
define('ROOT_DIR', dirname(__FILE__));
define('BASE_DIR', dirname(dirname(__FILE__)));
include_once(BASE_DIR.DIRECTORY_SEPARATOR.'functions.php');
include_once(ROOT_DIR.DIRECTORY_SEPARATOR.'config.php');
$suffix = '_V1';
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


define('HOST', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']);
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('HTTP_PATH', LOCAL_FOLDER);
} else {
    define('HTTP_PATH', SERVER_FOLDER);
}

define('COMPLETE_HTTP_PATH', HOST.HTTP_PATH);

$isCrawler = getIsCrawler($_SERVER['HTTP_USER_AGENT']);
if ($isCrawler) {
	$_SESSION['MM_Username'] = 'User';
	$_SESSION['MM_UserGroup'] = 'member';
	$_SESSION['MM_UserId'] = -1;
	$_SESSION['MM_DisplayName'] = 'User';
}


spl_autoload_register(function ($class) {
    // Parse class prefix
    $prefix = 'Parse\\';
    // base directory for the namespace prefix
    $base_dir = defined('PARSE_SDK_DIR') ? PARSE_SDK_DIR : BASE_DIR.'/libraries/Parse/';
	
    // does the class use the namespace prefix?
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    // get the relative class name
    $relative_class = substr($class, $len);
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
/*

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;
use Parse\ParsePushStatus;
use Parse\ParseServerInfo;
use Parse\ParseLogs;
use Parse\ParseAudience;
*/
?>