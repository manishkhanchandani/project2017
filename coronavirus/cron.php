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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$url = 'https://www.worldometers.info/coronavirus/';
$page = curlget($url);
$html = $page['output'];
if ($html === 'Database connection failed: Too many connections (1040)') {
	echo 'hi';
	exit;	
}
$matches = regexp($html, '<div class="main_table_countries_div">.*<table id="main_table_countries_today".*>.*<thead>.*<\/thead>.*<tbody>(.*)<\/tbody>.*<\/div>');
$content = $matches[0][1];
if (empty($content)) {
	echo 'no content';
	exit;	
}
$matches2 = regexp($content, '<tr.*>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<td.*>(.*)<\/td>.*<\/tr>');
//pr($matches2);
if (empty($matches2)) {
	echo 'no matches';
	exit;	
}
$keys = array(1 => 'country', 'total_cases', 'new_cases', 'total_deaths', 'new_deaths', 'total_recovered', 'active_cases', 'serious_critical', 'totalcases_1mpop', 'totaldeaths_1mpop');
$result = array();
$sorting = 0;
 
mysql_select_db($database_conn, $conn);
$dt = date('Y-m-d H:i:s');
foreach ($matches2 as $k => $v) {
	foreach ($v as $k1 => $v1) {
		if ($k1 === 0) continue;
		$result[$k][$keys[$k1]] = str_replace('+', '', str_replace(',', '', strip_tags($v1)));
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
                       GetSQLValueString($dt, "date"),
					   $sorting);

  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
	$sorting++;
}
pr($result);
file_put_contents('files/'.date('Y_m_d_h_i_s').'.json', json_encode($result));

?>