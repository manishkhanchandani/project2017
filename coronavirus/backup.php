<?php require_once('../Connections/conn.php'); ?>
<?php
include('../functions.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$files = array();
$filetypes = array();
$path = "/files";
if($_GET['path']) $path = urldecode($_GET['path']);
$base = "/";
$dir = getcwd();
$dirname = getcwd().$path;echo $path; echo "<br>";echo "<hr>";echo "<br>";
if ($handle = opendir($dirname)) {
	$i=0;
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		$filetype = filetype($dirname."/".$file);
		$files[$i] = $file;
		$filetypes[$i] = $filetype;
		$i++;
	}
	closedir($handle);
}
mysql_select_db($database_conn, $conn);
if($files) {
	asort($files);
	foreach($files as $i=>$file) {
		$filetype = $filetypes[$i];
		if($filetype=="dir" && !($file == "." || $file == "..")) {
			echo "Type1: ".$filetype." - ".$file;
			echo "Type1: ".$filetype." - <a href='index.php?path=".urlencode($path.$file)."/'>".$file."</a>";
			echo "<br>";
		} else if($filetype == "file") {
			echo 'files/'.$file;
			echo "<br>";
			$content = file_get_contents('files/'.$file);
			$exp = explode('_', str_replace('.json', '', $file));
			$created = $exp[0].'-'.$exp[1].'-'.$exp[2].' '.$exp[3].':'.$exp[4].':'.$exp[5];
			$rs = mysql_query("select * from coronatime where created = '$created'");
			$total = mysql_num_rows($rs);
			if ($total > 0) continue;
			$json = json_decode($content, 1);
			$result = array();
			$sorting = 0;
			foreach ($json as $k => $v) {
				foreach ($v as $k1 => $v1) {
					$result[$k][$k1] = str_replace('+', '', str_replace(',', '', strip_tags($v1)));	
				}
				$insertSQL = sprintf("INSERT INTO coronatime (country, total_cases, new_cases, total_deaths, new_deaths, total_recovered, active_cases, serious_critical, totalcases_1mpop, totaldeaths_1mpop, created, sorting) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($result[$k]['country'], "text"),
                       GetSQLValueString($result[$k]['total_cases'], "int"),
                       GetSQLValueString($result[$k]['new_cases'], "int"),
                       GetSQLValueString($result[$k]['total_deaths'], "int"),
                       GetSQLValueString($result[$k]['new_deaths'], "int"),
                       GetSQLValueString($result[$k]['total_recovered'], "int"),
                       GetSQLValueString($result[$k]['active_cases'], "int"),
                       GetSQLValueString($result[$k]['serious_critical'], "int"),
                       GetSQLValueString($result[$k]['totalcases_1mpop'], "int"),
                       GetSQLValueString($result[$k]['totaldeaths_1mpop'], "int"),
                       GetSQLValueString($created, "date"),
					   $sorting);

				  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
					$sorting++;
			}
			/*pr($result);
			pr($exp);
			pr($json);
			exit;*/
		}		
	}
}
?>