<?php
session_start();
$_SESSION['robot'] = 1;
/*
$_SESSION['MM_Username'] = 'Crawler';
$_SESSION['MM_UserGroup'] = 'member';
$_SESSION['MM_UserId'] = -1;
$_SESSION['MM_DisplayName'] = 'MyCrawler';*/
echo file_get_contents('robots.txt');
exit;
?>