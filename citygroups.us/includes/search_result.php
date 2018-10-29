<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
require_once(BASE_DIR.DIRECTORY_SEPARATOR.'Connections'.DIRECTORY_SEPARATOR.'conn.php');
require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'search_algo.php');



?>