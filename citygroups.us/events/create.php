<?php require_once('../../Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO citygroup_nodes (node_title, node_description, node_images, node_links, node_videos, node_type, parent_node_id, evt_start_time, evt_end_time, evt_start_date, evt_end_date, evt_frequency, node_location_name, node_location, node_addr, node_country, node_state, node_county, node_city, node_lat, node_lng, node_featured_image, category_id, creator_id, xtra1, xtra2) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['node_title'], "text"),
                       GetSQLValueString($_POST['node_description'], "text"),
                       GetSQLValueString($_POST['node_images'], "text"),
                       GetSQLValueString($_POST['node_links'], "text"),
                       GetSQLValueString($_POST['node_videos'], "text"),
                       GetSQLValueString($_POST['node_type'], "text"),
                       GetSQLValueString($_POST['parent_node_id'], "int"),
                       GetSQLValueString($_POST['evt_start_time'], "int"),
                       GetSQLValueString($_POST['evt_end_time'], "int"),
                       GetSQLValueString($_POST['evt_start_date'], "date"),
                       GetSQLValueString($_POST['evt_end_date'], "date"),
                       GetSQLValueString($_POST['evt_frequency'], "text"),
                       GetSQLValueString($_POST['node_location_name'], "text"),
                       GetSQLValueString($_POST['node_location'], "text"),
                       GetSQLValueString($_POST['node_addr'], "text"),
                       GetSQLValueString($_POST['node_country'], "text"),
                       GetSQLValueString($_POST['node_state'], "text"),
                       GetSQLValueString($_POST['node_county'], "text"),
                       GetSQLValueString($_POST['node_city'], "text"),
                       GetSQLValueString($_POST['node_lat'], "double"),
                       GetSQLValueString($_POST['node_lng'], "double"),
                       GetSQLValueString($_POST['node_featured_image'], "text"),
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['creator_id'], "int"),
                       GetSQLValueString($_POST['xtra1'], "text"),
                       GetSQLValueString($_POST['xtra2'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "confirm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

session_start();
include_once('../init.php');


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

if ($totalRows_rsGroupUser === 0) {
	$mes = "You are not a member of this group. Click here to join the group and try again. <a href='".HTTP_PATH."includes/join_group.php?group_id=".$_GET['group_id']."'>Join This Group</a>";
	header("Location: ../users/unauthorised.php?mes=".urlencode($mes));
	exit;
}

$colname_rsGroupInfo = "-1";
if (isset($_GET['group_id'])) {
  $colname_rsGroupInfo = (get_magic_quotes_gpc()) ? $_GET['group_id'] : addslashes($_GET['group_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsGroupInfo = sprintf("SELECT * FROM citygroup_groups WHERE group_id = %s", $colname_rsGroupInfo);
$rsGroupInfo = mysql_query($query_rsGroupInfo, $conn) or die(mysql_error());
$row_rsGroupInfo = mysql_fetch_assoc($rsGroupInfo);
$totalRows_rsGroupInfo = mysql_num_rows($rsGroupInfo);

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
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.gdrive-1.2.0.min.js"></script>
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
<div>
	<div class="row">
		<div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
			
<ul class="list-group">
	<li class="list-group-item"><a href="<?php echo HTTP_PATH; ?>groups/?group_id=<?php echo $row_rsGroupInfo['group_id']; ?>&city=<?php echo urlencode($row_rsGroupInfo['group_name']); ?>">Back To Groups</a></li>
	<li class="list-group-item"><a href="<?php echo HTTP_PATH; ?>events/create.php?group_id=<?php echo $row_rsGroupInfo['group_id']; ?>">Create New Event</a></li>
	<li class="list-group-item"><a href="<?php echo HTTP_PATH; ?>events/?group_id=<?php echo $row_rsGroupInfo['group_id']; ?>">List All Events</a></li>
</ul>
		</div>
		
		<div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 main">
			<h3 class="page-header">Create New Event in "<?php echo $row_rsGroupInfo['group_name']; ?>"</h3>
			<div><?php echo $row_rsGroupInfo['country']; ?>, <?php echo $row_rsGroupInfo['state']; ?>, <?php echo $row_rsGroupInfo['city']; ?></div>
			<hr />
			<!--<div>
				<div>You need google drive authorization to upload the image.</div>
				<button id="apiDriveAuthenticate" type="submit">Start Google Drive Authentication</button>
				<div id="gDriveAuthorization"></div>
			</div> -->
			<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
			    <table>
                    <tr valign="baseline">
                        <td nowrap align="right">Title:</td>
                        <td><input type="text" name="node_title" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Description:</td>
                        <td><textarea name="node_description" cols="50" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Start Date:</td>
                        <td><input type="text" name="evt_start_date" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">End date:</td>
                        <td><input type="text" name="evt_end_date" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Fequency:</td>
                        <td><input type="text" name="evt_frequency" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Location Name:</td>
                        <td><input type="text" name="node_location_name" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Location:</td>
                        <td><input type="text" name="node_location" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Featured Image:</td>
                        <td><input type="text" name="node_featured_image" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Category:</td>
                        <td><select name="category_id">
                                <option value="menuitem1" >[ Label ]</option>
                                <option value="menuitem2" >[ Label ]</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td><input type="submit" value="Insert record"></td>
                    </tr>
                </table>
                <input type="hidden" name="node_images" value="">
                <input type="hidden" name="node_links" value="">
                <input type="hidden" name="node_videos" value="">
                <input type="hidden" name="node_type" value="events">
                <input type="hidden" name="parent_node_id" value="0">
                <input type="hidden" name="evt_start_time" value="">
                <input type="hidden" name="evt_end_time" value="">
                <input type="hidden" name="node_addr" value="">
                <input type="hidden" name="node_country" value="">
                <input type="hidden" name="node_state" value="">
                <input type="hidden" name="node_county" value="">
                <input type="hidden" name="node_city" value="">
                <input type="hidden" name="node_lat" value="">
                <input type="hidden" name="node_lng" value="">
                <input type="hidden" name="creator_id" value="">
                <input type="hidden" name="xtra1" value="">
                <input type="hidden" name="xtra2" value="">
                <input type="hidden" name="MM_insert" value="form1">
            </form>
            <p>&nbsp;</p>
		</div>
		<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
		</div>

	</div>


<script>
//gdrive options with authentication and authorization level requested
var gdrive_pluginOptions = {
    authentication: {
        clientID: "<?php echo GOOGLE_DRIVE_CLIENT_ID; ?>",
        keyAPI: "<?php echo GOOGLE_API_KEY; ?>"
    },
    scopes: ["https://www.googleapis.com/auth/drive", "https://www.googleapis.com/auth/drive.file","https://www.googleapis.com/auth/userinfo.email"]
}

//initialize gdrive
$(function () {
    //initialize
    $("#apiDriveAuthenticate").gDrive(gdrive_pluginOptions);
    //listen to the event
    $('body').bind('DrivePlugin_loaded',
   function (e, data) {
       
    	var auth = $.gDrive.authorized();
		console.log('auth: ', auth);
    	if (auth) {
        	$("#apiDriveAuthenticate").hide();
        	$("#gDriveAuthorization").css("color", "green");
        	$("#gDriveAuthorization").text("You are Authorized to access Google Drive");
    	}
    	else {
        	$("#gDriveAuthorization").css("color", "orange");
        	$("#gDriveAuthorization").text("You are Not Authorized to access Google Drive. Click above button to get authorization.");
    	}

   });

});
</script>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsGroupUser);

mysql_free_result($rsGroupInfo);
?>
