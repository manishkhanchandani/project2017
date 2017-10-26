<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('HTTP_PATH', '/p2017/babybar/');
} else {
    define('HTTP_PATH', '/');
}

?>