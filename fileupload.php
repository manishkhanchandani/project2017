<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

echo '<pre>';
echo 'file: ';
print_r($_FILES);

echo 'post: ';
print_r($_POST);
echo 'get: ';
print_r($_GET);
echo 'request: ';
print_r($_REQUEST);

echo 'input: ';
$post = file_get_contents('php://input');
print_r($post);
?>