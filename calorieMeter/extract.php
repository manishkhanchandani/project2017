<?php
include('../functions.php');
include('../Connections/conn.php');

$content = file_get_contents('raw.html');

$regexp = "<tr>.*<td width=\"69%\">(.*)<\/td>.*<td width=\"0%\">(.*)<\/td>.*<td width=\"8%\">(.*)<\/td>.*<td width=\"4%\">(.*)<\/td>.*<td width=\"19%\">(.*)<\/td>.*<\/tr>";
$input = $content;
$result = regexp($input, $regexp);


foreach ($result as $k => $v) {
	pr($v);
	echo $sql = "insert into calorie_chart set food_description = ".GetSQLValueString(ucwords(strtolower($v[1])), "text").", calories = ".GetSQLValueString($v[2], "int").", protein = ".GetSQLValueString($v[3], "int").", fat = ".GetSQLValueString($v[4], "int").", carbohydrate = ".GetSQLValueString($v[5], "int").", user_id = 1";
  mysql_select_db($database_conn, $conn);
	//mysql_query($sql, $conn);
}
?>