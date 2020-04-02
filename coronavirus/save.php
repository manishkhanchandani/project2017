<?php
if (!empty($_POST['data'])) {
	file_put_contents('content.php', $_POST['data']);	
}
echo 'done';
?>