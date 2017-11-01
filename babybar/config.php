<?php
define('HOST', 'http://'.$_SERVER['HTTP_HOST']);
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('HTTP_PATH', '/project2017/babybar/');
} else {
    define('HTTP_PATH', '/');
}

define('COMPLETE_HTTP_PATH', HOST.HTTP_PATH);

?>