<?php
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
    define('HTTP_PATH', '/project2017/babybar/');
} else {
    define('HTTP_PATH', '/');
}

define('ROOT_DIR', dirname(__FILE__));
define('BASE_DIR', dirname(dirname(__FILE__)));

include_once(BASE_DIR.DIRECTORY_SEPARATOR.'functions.php');

define('COMPLETE_HTTP_PATH', HOST.HTTP_PATH);

define('FIREBASE_BASEPATH', 'babybarphp');

$barSubjects = array(
	1 => array('subject' => 'Contracts', 'year' => '1L', 'url' => 'contracts', 'id' => 1),
	3 => array('subject' => 'Torts', 'year' => '1L', 'url' => 'torts', 'id' => 3),
	4 => array('subject' => 'Criminal', 'year' => '1L', 'url' => 'criminal', 'id' => 4),
	5 => array('subject' => 'Agency and Partnership', 'year' => '2L', 'url' => 'agency_partnership', 'id' => 5),
	6 => array('subject' => 'Criminal Procedure', 'year' => '2L', 'url' => 'criminal_procedure', 'id' => 6),
	7 => array('subject' => 'Real Property', 'year' => '2L', 'url' => 'real_property', 'id' => 7),
	8 => array('subject' => 'Remedies', 'year' => '2L', 'url' => 'remedies', 'id' => 8),
	9 => array('subject' => 'Civil Procedure', 'year' => '3L', 'url' => 'civil_procedure', 'id' => 9),
	10 => array('subject' => 'Constitutional law', 'year' => '3L', 'url' => 'constitutional_law', 'id' => 10),
	11 => array('subject' => 'Corporations', 'year' => '3L', 'url' => 'corporations', 'id' => 11),
	12 => array('subject' => 'Evidence', 'year' => '3L', 'url' => 'evidence', 'id' => 12),
	13 => array('subject' => 'Administrative Law', 'year' => '4L', 'url' => 'administrative_law', 'id' => 13),
	14 => array('subject' => 'Community Property', 'year' => '4L', 'url' => 'community_property', 'id' => 14),
	15 => array('subject' => 'Professional Responsibility', 'year' => '4L', 'url' => 'professional_responsibility', 'id' => 15),
	16 => array('subject' => 'Trusts', 'year' => '4L', 'url' => 'trusts', 'id' => 16),
	17 => array('subject' => 'Wills', 'year' => '4L', 'url' => 'wills', 'id' => 17)
);
?>