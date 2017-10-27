<?php
$path = "files";
echo $dirname = $path; echo "<br>";echo "<br>";

if ($handle = opendir($dirname)) {
	$i=0;
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		if ($file == '.' || $file == '..') {
			continue;
		}
		$dir = 'files/'.$file;
		$dirs[$dir] = $file;
	}
	closedir($handle);
}

function getdetails($c) {
	$first = explode("\n", $c);
	foreach($first as $line) {
		$second = explode(" = ", $line);
		$key = strtolower($second[0]);
		$v = $second[1];
		if (!$key) continue;
		if ($key == 'images')
			$arr[$key][] = $v;
		else 
			$arr[$key] = $v;
	}
	return $arr;
}

if ($_GET['dates']) {
	$path = $_GET['dates'];
	echo $dirname = $path; echo "<br>";echo "<br>";
	
	if ($handle = opendir($dirname)) {
		$i=0;
		/* This is the correct way to loop over the directory. */
		while (false !== ($file = readdir($handle))) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			$dir = $dirname.'/'.$file;
			$c = file_get_contents($dir);
			$records[] = getdetails($c);
		}
		closedir($handle);
	}
}
?>