<?php require_once('../../Connections/conn.php'); ?>
<?php
session_start();
include_once('../init.php');

$colname_rsGroupInfo = "-1";
if (isset($_GET['group_id'])) {
  $colname_rsGroupInfo = (get_magic_quotes_gpc()) ? $_GET['group_id'] : addslashes($_GET['group_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsGroupInfo = sprintf("SELECT * FROM citygroup_groups WHERE group_id = %s", $colname_rsGroupInfo);
$rsGroupInfo = mysql_query($query_rsGroupInfo, $conn) or die(mysql_error());
$row_rsGroupInfo = mysql_fetch_assoc($rsGroupInfo);
$totalRows_rsGroupInfo = mysql_num_rows($rsGroupInfo);

$coluser_rsGroupUser = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsGroupUser = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsGroupUser = "-1";
if (isset($_GET['group_id'])) {
  $colname_rsGroupUser = (get_magic_quotes_gpc()) ? $_GET['group_id'] : addslashes($_GET['group_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsGroupUser = sprintf("SELECT * FROM citygroup_group_users WHERE group_id = %s AND user_id = %s", $colname_rsGroupUser,$coluser_rsGroupUser);
$rsGroupUser = mysql_query($query_rsGroupUser, $conn) or die(mysql_error());
$row_rsGroupUser = mysql_fetch_assoc($rsGroupUser);
$totalRows_rsGroupUser = mysql_num_rows($rsGroupUser);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/citygroups.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_rsGroupInfo['group_name']; ?></title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/parse-latest.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_KEY; ?>&libraries=places"></script>
<script src="<?php echo HTTP_PATH; ?>js/script.js"></script>

<!-- Firebase App is always required and must be first -->
<!--<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-app.js"></script> -->

<!-- Add additional services that you want to use -->
<!--<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-database.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.5.5/firebase-firestore.js"></script> -->

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'localHead.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!--<script src="<?php //echo HTTP_PATH; ?>groups/groupJs.js"></script>
<script>
var groupSingleData = getSingleData('<?php //echo $colname_rsGroupUser; ?>');

groupSingleData.then((data) => {
	console.log('groupSingleData: ', data);
})
</script>-->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
	<div class="row">
		<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
			<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'groups'.DIRECTORY_SEPARATOR.'group_menu.php'); ?>
			<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'find_city_groups.php'); ?>

			
			
		</div>
		
		<div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 main">
			<h1 class="page-header"><?php echo $row_rsGroupInfo['group_name']; ?></h1>
			<div><?php echo $row_rsGroupInfo['country']; ?>, <?php echo $row_rsGroupInfo['state']; ?>, <?php echo $row_rsGroupInfo['city']; ?></div>
		</div>
		<div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
			<?php if ($totalRows_rsGroupUser == 0) { // Show if recordset empty ?>
				<div><a href="../includes/join_group.php?group_id=<?php echo $row_rsGroupInfo['group_id']; ?>">Join This Group</a></div>
			<?php } else { // Show if recordset empty ?>
				<div>You <strong>joined this group</strong> <?php echo timeAgo($row_rsGroupUser['joined_date']); ?><br /><br /> <a href="../includes/leave_group.php?group_id=<?php echo $row_rsGroupInfo['group_id']; ?>">Leave This Group</a></div>
			<?php } // Show if recordset empty ?>
			<hr />
		</div>
	
	</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsGroupInfo);

mysql_free_result($rsGroupUser);
?>
