<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
?>
<?php
if($_SESSION['MM_Username']) {
	$rs = mysql_query("select * from mk_users where username = '".$_SESSION['MM_Username']."'") or die("error");
	$rec = mysql_fetch_array($rs);
	$_GET['user_id'] = $rec['user_id'];
	$user_id = $rec['user_id'];
}
function getCategory($u, $fromdate, $todate) {
	if(!$fromdate) $fromdate="1900-01-01";
	if(!$todate) $todate="3000-12-31";
	$query = "select DISTINCT pt.category, pl.list from mk_timesheet as pt, mk_list as pl where pt.user_id like '".$u."' and pt.cdate between '".$fromdate."' and '".$todate."' and pt.category = pl.list_id";
	$rs = mysql_query($query) or die("error");
	while($rec = mysql_fetch_array($rs)) {
		$categories[$rec['category']] = $rec['list'];
	}
	return $categories;
}
function getProject($u, $categoryKey, $fromdate, $todate) {
	if(!$fromdate) $fromdate="1900-01-01";
	if(!$todate) $todate="3000-12-31";
	if(!$categoryKey) $categoryKey = '%';
	$query = "select DISTINCT pt.project, pl.list from mk_timesheet as pt, mk_list as pl where pt.user_id like '".$u."' and pt.category like '".$categoryKey."' and pt.cdate between '".$fromdate."' and '".$todate."' and pt.project = pl.list_id";
	$rs = mysql_query($query) or die("error");
	while($rec = mysql_fetch_array($rs)) {
		$projects[$rec['project']] = $rec['list'];
	}
	return $projects;
}
function getTask($u,$categoryKey,$projectKey,$fromdate,$todate) {
	if(!$fromdate) $fromdate="1900-01-01";
	if(!$todate) $todate="3000-12-31";
	if(!$categoryKey) $categoryKey = '%';
	if(!$projectKey) $projectKey = '%';
	$query = "select DISTINCT pt.tasks, pl.list from mk_timesheet as pt, mk_list as pl where pt.user_id like '".$u."' and pt.category like '".$categoryKey."' and pt.project like '".$projectKey."' and pt.cdate between '".$fromdate."' and '".$todate."' and pt.tasks = pl.list_id";
	$rs = mysql_query($query) or die("error");
	while($rec = mysql_fetch_array($rs)) {
		$tasks[$rec['tasks']] = $rec['list'];
	}
	return $tasks;
}

function getTime($u,$categoryKey,$projectKey,$taskKey,$date) {
	if(!$fromdate) $fromdate="1900-01-01";
	if(!$todate) $todate="3000-12-31";
	if(!$categoryKey) $categoryKey = '%';
	if(!$projectKey) $projectKey = '%';
	if(!$taskKey) $taskKey = '%';
	$query = "select sum(pt.timetaken) as tm from mk_timesheet as pt where pt.user_id like '".$u."' and pt.category like '".$categoryKey."' and pt.project like '".$projectKey."' and pt.tasks like '".$taskKey."' and pt.cdate = '".$date."'";
	$rs = mysql_query($query) or die("error");
	while($rec = mysql_fetch_array($rs)) {
		$timetaken = $rec['tm'];
	}
	return $timetaken;
}

function getDays($time='') {
	if(!$time) {
		$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
	}
	$today = getdate($time);
	//print_r($today);
	switch($today['wday']) {
		case 1: // monday
			$monday = $time+(60*60*24*0); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time+(60*60*24*1); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*2); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*3); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*4); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*5); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*6); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 2: // tuesday
			$monday = $time-(60*60*24*1); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time+(60*60*24*0); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*1); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*2); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*3); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*4); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*5); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 3: // wednesday
			$monday = $time-(60*60*24*2); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*1); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time+(60*60*24*0); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*1); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*2); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*3); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*4); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 4: // thursday
			$monday = $time-(60*60*24*3); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*2); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*1); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time+(60*60*24*0); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*1); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*2); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*3); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 5: // friday
			$monday = $time-(60*60*24*4); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*3); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*2); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*1); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time+(60*60*24*0); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*1); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*2); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 6: // saturday
			$monday = $time-(60*60*24*5); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*4); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*3); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*2); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time-(60*60*24*1); 
			$arr['friday'] = getdate($friday);
			$saturday = $time+(60*60*24*0); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*1); 
			$arr['sunday'] = getdate($sunday);
			break;
		case 0: // sunday
			$monday = $time-(60*60*24*6); 
			$arr['monday'] = getdate($monday);
			$tuesday = $time-(60*60*24*5); 
			$arr['tuesday'] = getdate($tuesday);
			$wednesday = $time-(60*60*24*4); 
			$arr['wednesday'] = getdate($wednesday);
			$thursday = $time-(60*60*24*3); 
			$arr['thursday'] = getdate($thursday);
			$friday = $time-(60*60*24*2); 
			$arr['friday'] = getdate($friday);
			$saturday = $time-(60*60*24*1); 
			$arr['saturday'] = getdate($saturday);
			$sunday = $time+(60*60*24*0); 
			$arr['sunday'] = getdate($sunday);
			break;
	}
	return $arr;
}
?>
<?php
$colname_rsTimesheet = "-1";
if (isset($_GET['user_id'])) {
  $colname_rsTimesheet = (get_magic_quotes_gpc()) ? $_GET['user_id'] : addslashes($_GET['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsTimesheet = sprintf("SELECT * FROM mk_timesheet WHERE user_id = %s", $colname_rsTimesheet);
$rsTimesheet = mysql_query($query_rsTimesheet, $conn) or die(mysql_error());
$row_rsTimesheet = mysql_fetch_assoc($rsTimesheet);
$totalRows_rsTimesheet = mysql_num_rows($rsTimesheet);

$colname_rsUser = "-1";
if (isset($_GET['user_id'])) {
  $colname_rsUser = (get_magic_quotes_gpc()) ? $_GET['user_id'] : addslashes($_GET['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsUser = sprintf("SELECT * FROM mk_users WHERE user_id = %s", $colname_rsUser);
$rsUser = mysql_query($query_rsUser, $conn) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);
?>
<?php
if($_GET['mydate']) {
		$time = strtotime($_GET['mydate']);
	} else {
		$time = time();
	}
	$arr = getDays($time);
  $fromdate = $arr['monday']['year']."-".$arr['monday']['mon']."-".$arr['monday']['mday'];
  $todate = $arr['sunday']['year']."-".$arr['sunday']['mon']."-".$arr['sunday']['mday'];
  // row 1
  $excel = "\r\n";
  // row 2
  $excel .= "\t\t";
  $excel .= "Timesheet for ".$arr['monday']['mday']." ".date('S',$arr['monday'][0])." ".$arr['monday']['month']." - ".$arr['sunday']['mday']." ".date('S',$arr['sunday'][0])." ".$arr['sunday']['month']."\r\n\t\r\n";
  // row 4
  $excel .= $row_rsUser['name']."\r\n";
  
  // row2
  $excel .= "\t\tDate\t";
  foreach($arr as $key => $value) { 
		$excel .= $arr[$key]['mday']."\t"; 
	} 
	$excel .= "\r\n";
	
	// row 3
	$excel .= "Category\t"; 
	$excel .= "Projects\t";
	$excel .= "Tasks\t";
	foreach($arr as $key => $value) { 
		//$excel .= ucfirst($key)."/".$arr[$key]['mday']." ".$arr[$key]['month']."\t"; 
		$excel .= substr($arr[$key]['weekday'],0,3)."\t"; 
	} 
	$excel .= "Total\r\n"; 
  $category = getCategory($_GET['user_id'],$fromdate,$todate);
  if($category) {
	  foreach($category as $categoryKey=>$categoryValue) {
		$categorycnt[$categoryValue]=1;
		$project = getProject($_GET['user_id'],$categoryKey,$fromdate,$todate);
		if($project) {
			foreach($project as $projectKey=>$projectValue) {
				$projectcnt[$projectValue]=1;
				$task = getTask($_GET['user_id'],$categoryKey,$projectKey,$fromdate,$todate);
				if($task) {
					$j=0;
					foreach($task as $taskKey => $taskValue) {
						if($categorycnt[$categoryValue]==1) { 
							$excel .= $categoryValue; 
						} 
					$excel .= "\t";
					$categorycnt[$categoryValue]++;
					if($projectcnt[$projectValue]==1) { 
							$excel .= $projectValue;
					} 
					$excel .= "\t";
					$projectcnt[$projectValue]++;
					$excel .= $taskValue;
					$excel .= "\t";
			$i=0;
			$totalh[$j] = 0;
			foreach($arr as $key => $value) { 
				$timetaken[$i] = getTime($_GET['user_id'],$categoryKey,$projectKey,$taskKey,$arr[$key]['year']."-".$arr[$key]['mon']."-".$arr[$key]['mday']); 
				$excel .= number_format($timetaken[$i],2);
				$excel .= "\t";
				$totalv[$key] += $timetaken[$i]; 
				$totalh[$j] += $timetaken[$i]; 
				$i++; 
			} 
			$excel .= number_format($totalh[$j],2);
			$excel .= "\r\n";
			$j++; 
				 } // for task ends 
			} // if task ends 
		} // foreach project ends
	} // if project ends 
 } // foreach $category ends
 } // if cateogry ends
 
 $excel .= "\t"; 
 $excel .= "\t"; 
 $excel .= "Total:\t"; 
 foreach($arr as $key => $value) {  
	$grandtotal += $totalv[$key]; 
	$excel .= number_format($totalv[$key],2);
	$excel .= "\t";
	} 
	$excel .= $grandtotal;
	$excel .= "\r\n";
	$filename = $user_id."-".date("Y-m-d",$time).".xls";
mysql_free_result($rsTimesheet);

mysql_free_result($rsUser);
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
print "$excel"; 
?>
