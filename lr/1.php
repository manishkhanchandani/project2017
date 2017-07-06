<?php

echo $pastTime = time() - (60 * 60 * 24 * 90);

echo '<br>';

echo date('r', $pastTime);
?>
