<?php
$path = '../reiki/reiki1/images/third-eye-meditation.jpg';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
echo $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>