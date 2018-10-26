<?php
session_start();
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


$maxRows_rsView = 100;
$pageNum_rsView = 0;
if (isset($_GET['page'])) {
  $pageNum_rsView = $_GET['page'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$arr = !empty($_GET['kw']) ? explode(',', $_GET['kw']) : array();
$query = new ParseQuery("XT_videos");
if (!empty($arr)) {
$query->containsAll("tags", $arr);
}

$query->limit($maxRows_rsView);
$query->skip($startRow_rsView);
$results = $query->find();
echo "Successfully retrieved " . count($results) . " scores.<br />";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
  echo $object->getObjectId() . ' - ' . $object->get('title').'<br />';
  pr($object->get('id'));
  pr($object->get('tags'));
  echo ($object->get('duration')).' secs';
  pr($object->get('thumbnail'));
  echo '<a href="'.$object->get('url').'" target="_blank">'.$object->get('url').'</a>';
}
?>

