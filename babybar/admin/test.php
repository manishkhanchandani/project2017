<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

$MM_authorizedUsers = "admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/access-denied.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

use Parse\ParseClient;
use Parse\ParseObject;

$app_id = 'myAppID';
$master_key = 'myMasterKey';
$server_url = 'https://parse-server-mk1.herokuapp.com';
$mount_path = 'parse';
ParseClient::initialize( $app_id, null, $master_key );
ParseClient::setServerURL($server_url, $mount_path);
/*$health = ParseClient::getServerHealth();
pr($health);*/

?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM calbabybar_nodes";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Test</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Dashboard</h1>
<p>dd</p>
<p>&nbsp;</p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>id</td>
        <td>user_id</td>
        <td>subject_id</td>
        <td>current_status</td>
        <td>title</td>
        <td>description</td>
        <td>topic_created</td>
        <td>node_type</td>
        <td>description2</td>
        <td>sub_topic</td>
        <td>deleted</td>
        <td>deleted_dt</td>
        <td>view_images</td>
        <td>view_videos</td>
        <td>view_links</td>
        <td>status</td>
        <td>ref_id</td>
        <td>site_name</td>
        <td>xtras</td>
        <td>related_id</td>
        <td>sorting</td>
    </tr>
    <?php do { ?>
        <tr>
            <td><?php echo $row_rsView['id']; ?></td>
            <td><?php echo $row_rsView['user_id']; ?></td>
            <td><?php echo $row_rsView['subject_id']; ?></td>
            <td><?php echo $row_rsView['current_status']; ?></td>
            <td><?php echo $row_rsView['title']; ?></td>
            <td><?php echo $row_rsView['description']; ?></td>
            <td><?php echo $row_rsView['topic_created']; ?></td>
            <td><?php echo $row_rsView['node_type']; ?></td>
            <td><?php echo $row_rsView['description2']; ?></td>
            <td><?php echo $row_rsView['sub_topic']; ?></td>
            <td><?php echo $row_rsView['deleted']; ?></td>
            <td><?php echo $row_rsView['deleted_dt']; ?></td>
            <td><?php echo $row_rsView['view_images']; ?></td>
            <td><?php echo $row_rsView['view_videos']; ?></td>
            <td><?php echo $row_rsView['view_links']; ?></td>
            <td><?php echo $row_rsView['status']; ?></td>
            <td><?php echo $row_rsView['ref_id']; ?></td>
            <td><?php echo $row_rsView['site_name']; ?></td>
            <td><?php echo $row_rsView['xtras']; ?></td>
            <td><?php echo $row_rsView['related_id']; ?></td>
            <td><?php echo $row_rsView['sorting']; ?></td>
        </tr>
<?php
$row_rsView['view_images'] = json_decode($row_rsView['view_images'], true);
$row_rsView['view_videos'] = json_decode($row_rsView['view_videos'], true);
$row_rsView['view_links'] = json_decode($row_rsView['view_links'], true);

if (empty($row_rsView['view_images'])) {
	$row_rsView['view_images'] = array();
}
if (empty($row_rsView['view_videos'])) {
	$row_rsView['view_videos'] = array();
}
if (empty($row_rsView['view_links'])) {
	$row_rsView['view_links'] = array();
}
pr($row_rsView);
exit;
$object = ParseObject::create("Calbabybar_nodes");
$objectId = $object->getObjectId();
$object->set("id", $row_rsView['id']);
$object->set("user_id", $row_rsView['user_id']);
$object->set("subject_id", $row_rsView['subject_id']);
$object->set("current_status", $row_rsView['current_status']);
$object->set("title", $row_rsView['title']);
$object->set("description", $row_rsView['description']);
$object->set("topic_created", $row_rsView['topic_created']);
$object->set("node_type", $row_rsView['node_type']);
$object->set("description2", $row_rsView['description2']);
$object->set("sub_topic", $row_rsView['sub_topic']);
$object->set("deleted", $row_rsView['deleted']);
$object->set("deleted_dt", $row_rsView['deleted_dt']);
$object->setArray("view_images", $row_rsView['view_images']);
$object->setArray("view_videos", $row_rsView['view_videos']);
$object->setArray("view_links", $row_rsView['view_links']);
$object->set("ref_id", $row_rsView['ref_id']);
$object->set("site_name", $row_rsView['site_name']);
$object->set("xtras", $row_rsView['xtras']);
$object->set("related_id", $row_rsView['related_id']);
$object->set("sorting", $row_rsView['sorting']);
/*$object->setArray("mylist", [1, 2, 3]);
$object->setAssociativeArray(
    "languageTypes", array("php" => "awesome", "ruby" => "wtf")
);*/
// Save normally:
//$object->save();
// Or pass true to use the master key to override ACLs when saving:
$object->save(true);
pr($object);
/*
// encode an object for later use
$encoded = $object->encode();

// decode an object
$decodedObject = ParseObject::decode($encoded);
*/

?>
<?php //exit; ?>
<?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
<p>&nbsp;</p>
</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
