<?php
session_start();
require_once('../Connections/connXV.php'); 

define('ROOT_DIR', dirname(__FILE__));
define('BASE_DIR', dirname(dirname(__FILE__)));

include('../functions.php');

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

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

$app_id = 'myAppId';
$master_key = 'myMasterKey';
$server_url = 'http://localhost:1337'; //'https://mkparse.info'; //'https://parse-server-mk1.herokuapp.com';
$mount_path = 'parse';
ParseClient::initialize( $app_id, null, $master_key );
ParseClient::setServerURL($server_url, $mount_path);
/*$health = ParseClient::getServerHealth();
pr($health);*/

$_GET['totalRows_rsView'] = 7377311;
set_time_limit(0);

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 100000;
$pageNum_rsView = 1;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_connXV, $connXV);
$query_rsView = sprintf("SELECT * FROM videos3");
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $connXV) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);

if ($totalRows_rsView > 0) {
do {
echo "checking: ".$row_rsView['id']."\n\n";
$query = new ParseQuery("XT_videos");
$query->equalTo("id", (int) $row_rsView['id']);
$results = $query->find();

if (!empty($results)) {
	continue;
}

$object = ParseObject::create("XT_videos");
$objectId = $object->getObjectId();
$object->set("id", (int) $row_rsView['id']);
$object->set("title", $row_rsView['title']);
$object->set("thumbnail", $row_rsView['thumbnail']);
$object->set("url", $row_rsView['url']);
$object->setArray("tags", explode(',', $row_rsView['tags']));
$object->set("duration", (int) str_replace(' sec', '', $row_rsView['duration']));
$object->save(true);
pr($row_rsView);
} while ($row_rsView = mysql_fetch_assoc($rsView));
}
?>

