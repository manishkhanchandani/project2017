<?php
$totalRows_rsGroups = -1;
$url = HTTP_PATH;
if (!empty($_POST['location'])) {
	$colname_rs = (get_magic_quotes_gpc()) ? $_POST['location'] : addslashes($_POST['location']);
	$query = sprintf("select * from citygroup_groups WHERE group_name LIKE '%%%s%%'", $colname_rs);
	mysql_select_db($database_conn, $conn);
	$rs = mysql_query($query);
	if (mysql_num_rows($rs) === 0) {
		
		if (empty($_POST['lat'])) {
			$totalRows_rsGroups = 0;
		} else {
		
		
			$group_name = $_POST['location'];
			$_POST['group_description'] = '';
			$uid = !empty($_SESSION['MM_UserId']) ? $_SESSION['MM_UserId'] : 0;
			$insertSQL = sprintf("INSERT INTO citygroup_groups (group_name, group_description, country, `state`, county, city, addr, lat, lng, group_creator_id, ip_address) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['location'], "text"),
						   GetSQLValueString($_POST['group_description'], "text"),
						   GetSQLValueString($_POST['country'], "text"),
						   GetSQLValueString($_POST['state'], "text"),
						   GetSQLValueString($_POST['county'], "text"),
						   GetSQLValueString($_POST['city'], "text"),
						   GetSQLValueString($_POST['addr'], "text"),
						   GetSQLValueString($_POST['lat'], "double"),
						   GetSQLValueString($_POST['lng'], "double"),
						   GetSQLValueString($uid, "int"),
						   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"));
			  mysql_select_db($database_conn, $conn);
			  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
			  $id = mysql_insert_id();
		}
	} else {
		$rec = mysql_fetch_array($rs);
		$id = $rec['group_id'];
		$group_name = $rec['group_name'];
	}


	if (!empty($id)) {
		$url = HTTP_PATH."groups/?group_id=".$id."&city=".urlencode($group_name);
		
		mysql_select_db($database_conn, $conn);
		$query_rsGroups = "SELECT * FROM citygroup_groups WHERE group_id = $id";
		$rsGroups = mysql_query($query_rsGroups, $conn) or die(mysql_error());
		$row_rsGroups = mysql_fetch_assoc($rsGroups);
		$totalRows_rsGroups = mysql_num_rows($rsGroups);
	}
} else {
	$url = HTTP_PATH;
}

if (!empty($_POST['redirect'])) {
	if (empty($url)) {
		$url = HTTP_PATH;
	}
	header("Location: ".$url);
	exit;
}
?>