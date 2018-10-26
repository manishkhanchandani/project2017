<?php require_once('../Connections/connXV.php'); 
session_start();
include('../functions.php');
$filename = "xvideos.com-db.csv";
ini_set ('memory_limit', filesize ($filename) + 4000000);
function file_get_contents_chunked($file,$chunk_size,$callback)
{
    try
    {
        $handle = fopen($file, "r");
        $i = 0;
        while (!feof($handle))
        {
            call_user_func_array($callback,array(fread($handle,$chunk_size),&$handle,$i));
            $i++;
        }

        fclose($handle);

    }
    catch(Exception $e)
    {
         trigger_error("file_get_contents_chunked::" . $e->getMessage(),E_USER_NOTICE);
         return false;
    }

    return true;
}

$_SESSION['count'] = 0;
$_SESSION['str'] = '';
if (empty($_SESSION['data'])) {
	$_SESSION['data'] = array();
}
$success = file_get_contents_chunked($filename,4096,function($chunk,&$handle,$iteration){
	global $connXV;
    /*
        * Do what you will with the {&chunk} here
        * {$handle} is passed in case you want to seek
        ** to different parts of the file
        * {$iteration} is the section fo the file that has been read so
        * ($i * 4096) is your current offset within the file.
    */
	//echo $chunk;
	//echo "\n\n<br><br>";
	/**/
	//pr($txt);
	$txt = explode("\n", $chunk);
	$res = array();
	for ($i = 0; $i < count($txt) - 1; $i++) {
		$tmp = explode(";", $txt[$i]);
		if ($i === (count($txt) - 1)) {
			//$_SESSION['data'][] = $tmp;
			//continue;
		}
		pr($tmp);

			$insertSQL = sprintf("INSERT INTO videos (id, url, title, embedlink, duration, thumbnail, tags, category) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($tmp[6], "int"),
						   GetSQLValueString($tmp[0], "text"),
						   GetSQLValueString($tmp[1], "text"),
						   GetSQLValueString($tmp[4], "text"),
						   GetSQLValueString($tmp[2], "text"),
						   GetSQLValueString($tmp[3], "text"),
						   GetSQLValueString($tmp[5], "text"),
						   GetSQLValueString($tmp[7], "text"));
	echo $insertSQL;

		  $Result1 = @mysql_query($insertSQL, $connXV);

	}
	echo '<hr />';
	$_SESSION['count']++;
	if ($_SESSION['count'] == 3) {
		exit;
	}
});

mysql_select_db($database_connXV, $connXV);
if(!$success)
{
    //It Failed
	echo 'failed';
} else {
	
}
echo 'session: ';
pr($_SESSION['data']);
?>