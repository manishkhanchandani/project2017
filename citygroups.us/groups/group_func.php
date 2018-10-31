<?php

class Group {

	public function __construct() {
	
	}

	public function createNewGroup($location, $uid=0, $lat=null, $lng=null, $country=null, $state=null, $county=null, $city=null, $addr=null) {
		global $database_conn, $conn;
		$return = array();
		$return['url'] = HTTP_PATH;
		$return['totalRows_rsGroups'] = -1;
		$row_rsGroups = null;
		$return['row_rsGroups'] = $row_rsGroups;
		if (empty($location)) {
			return $return;
		}
		$colname_rs = (get_magic_quotes_gpc()) ? $location : addslashes($location);
		$query = sprintf("select * from citygroup_groups WHERE group_name LIKE '%%%s%%'", $colname_rs);
		mysql_select_db($database_conn, $conn);
		$rs = mysql_query($query);
		if (mysql_num_rows($rs) === 0) {				
			if (empty($lat)) {
				$return['totalRows_rsGroups'] = 0;
				return $return;
			}
				
				
			$group_name = $location;
			$group_name_url = url_name_v2($group_name);
			$group_description = '';
			$insertSQL = sprintf("INSERT INTO citygroup_groups (group_name, group_description, country, `state`, county, city, addr, lat, lng, group_creator_id, ip_address, url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
				GetSQLValueString($group_name, "text"),
				GetSQLValueString($group_description, "text"),
				GetSQLValueString($country, "text"),
				GetSQLValueString($state, "text"),
				GetSQLValueString($county, "text"),
				GetSQLValueString($city, "text"),
				GetSQLValueString($addr, "text"),
				GetSQLValueString($lat, "double"),
				GetSQLValueString($lng, "double"),
				GetSQLValueString($uid, "int"),
				GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
				GetSQLValueString($group_name_url, "text"));
			mysql_select_db($database_conn, $conn);
			$Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
			$id = mysql_insert_id();
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

		
		if (empty($url)) {
			$url = HTTP_PATH;
		}
		
		$object = array('url' => $url, 'totalRows_rsGroups' => $totalRows_rsGroups, 'row_rsGroups' => $row_rsGroups);
		return $object;
	}
}

$group = new Group();

?>