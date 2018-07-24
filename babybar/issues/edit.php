<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$id = $_GET['id'];
$subjectUrl = $_GET['subjectUrl'];
$node_type = $_GET['node_type'];
$reference = $nodeTypes[$node_type];
$mainUrl = HTTP_PATH.$node_type.'/'.$subjectUrl.'/'.$id;
$subject = $barSubjects[$_GET['id']]['subject'];

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['REQUEST_URI'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colid_rsEdit = "-1";
if (isset($_GET['node_id'])) {
  $colid_rsEdit = (get_magic_quotes_gpc()) ? $_GET['node_id'] : addslashes($_GET['node_id']);
}
$colname_rsEdit = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM calbabybar_nodes WHERE user_id = %s AND id = %s", $colname_rsEdit,$colid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);


$sql = '';


if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND current_status = 1";
} else {
	$sql .= sprintf(" AND (current_status = 1 OR (current_status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$error = '';
	if ($_POST['type'] === 'existing') {
		$_POST['title'] = $_POST['title_existing'];
	}
	
	if (empty($_POST['title'])) {
		$error = 'Empty title';
	}

	if ($_POST['type2'] === 'existing') {
		$_POST['sub_topic'] = $_POST['sub_topic_existing'];
	}
	
	if (empty($_POST['sub_topic'])) {
		$error = 'Empty subtopic';
	}
	
	if ($_SESSION['MM_UserId'] <= 0) {
		$error = 'Invalid User';
	}
	
	$_POST['view_images'] = array_filter($_POST['view_images']);
	$_POST['view_videos'] = array_filter($_POST['view_videos']);
	$_POST['view_links'] = array_filter($_POST['view_links']);
	
	$_POST['view_images'] = json_encode($_POST['view_images']);
	$_POST['view_videos'] = json_encode($_POST['view_videos']);
	$_POST['view_links'] = json_encode($_POST['view_links']);

	if (!empty($error)) {
		unset($_POST['MM_update']);
	}
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$q = "select revision_number from calbabybar_nodes_revision WHERE user_id = ".$_SESSION['MM_UserId']." AND node_id = ".$_POST['id']." Order by revision_number DESC LIMIT 1";
  mysql_select_db($database_conn, $conn);
	$r = mysql_query($q, $conn) or die(mysql_error());
	$rec = mysql_fetch_array($r);
	$num = 1;
	if ($rec['revision_number'] >= 1) $num = $rec['revision_number'] + 1;

	$insertSQL = "INSERT INTO  calbabybar_nodes_revision (user_id, subject_id, title, description, node_type, description2, sub_topic, view_images, view_videos, view_links, node_id, revision_number, topic_created, current_status, deleted, deleted_dt, revision_action, status, ref_id) SELECT user_id, subject_id, title, description, node_type, description2, sub_topic, view_images, view_videos, view_links, id, ".$num.", topic_created, current_status, deleted, deleted_dt, 'Edited', status, ref_id from calbabybar_nodes WHERE user_id = ".$_SESSION['MM_UserId']." AND id = ".$_POST['id'];

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());


  $updateSQL = sprintf("UPDATE calbabybar_nodes SET title=%s, description=%s, description2=%s, sub_topic=%s, node_type=%s, view_images=%s, view_videos=%s, view_links=%s, status=%s, ref_id=%s WHERE user_id = %s AND id = %s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['description2'], "text"),
                       GetSQLValueString($_POST['sub_topic'], "text"),
                       GetSQLValueString($_POST['node_type'], "text"),
                       GetSQLValueString($_POST['view_images'], "text"),
                       GetSQLValueString($_POST['view_videos'], "text"),
                       GetSQLValueString($_POST['view_links'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['ref_id'], "text"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
  
  
  	$id = $_POST['id'];
	$sql = sprintf("DELETE FROM calbabybar_ref WHERE id=%s",
                       GetSQLValueString($id, "int"));
	   mysql_query($sql, $conn) or die(mysql_error());
  if (!empty($_POST['ref_id'])) {
	
  	$tmp = explode(',', $_POST['ref_id']);
	foreach ($tmp as $k => $v) {
		$ref_id = trim($v);
		$sql = sprintf("INSERT INTO calbabybar_ref (id, ref_id) VALUES (%s, %s)",
                       GetSQLValueString($id, "int"),
                       GetSQLValueString($ref_id, "int"));

	  mysql_query($sql, $conn) or die(mysql_error());
	}
  }

  $updateGoTo = $mainUrl;
  header(sprintf("Location: %s", $updateGoTo));
  exit;
}

$colname_rsDistinctTitle = "-1";
if (isset($_GET['id'])) {
  $colname_rsDistinctTitle = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsDistinctTitle = sprintf("SELECT DISTINCT title FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' $sql AND deleted = 0 ORDER BY title ASC", $colname_rsDistinctTitle, $node_type);
$rsDistinctTitle = mysql_query($query_rsDistinctTitle, $conn) or die(mysql_error());
$row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle);
$totalRows_rsDistinctTitle = mysql_num_rows($rsDistinctTitle);


$colname_rsDistinctSubtopic = "-1";
if (isset($_GET['id'])) {
  $colname_rsDistinctSubtopic = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsDistinctSubtopic = sprintf("SELECT DISTINCT sub_topic FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' $sql AND deleted = 0 ORDER BY sub_topic ASC", $colname_rsDistinctSubtopic, $node_type);
$rsDistinctSubtopic = mysql_query($query_rsDistinctSubtopic, $conn) or die(mysql_error());
$row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic);
$totalRows_rsDistinctSubtopic = mysql_num_rows($rsDistinctSubtopic);



$title = !empty($_POST['title']) ? $_POST['title'] : $row_rsEdit['title'];
$description = !empty($_POST['description']) ? $_POST['description'] : $row_rsEdit['description'];
$description2 = !empty($_POST['description2']) ? $_POST['description2'] : $row_rsEdit['description2'];
$sub_topic = !empty($_POST['sub_topic']) ? $_POST['sub_topic'] : $row_rsEdit['sub_topic'];
$nt = !empty($_POST['node_type']) ? $_POST['node_type'] : $row_rsEdit['node_type'];

$ref_id = !empty($_POST['ref_id']) ? $_POST['ref_id'] : $row_rsEdit['ref_id'];
$images = json_decode($row_rsEdit['view_images'], true);
$videos = json_decode($row_rsEdit['view_videos'], true); 
$links = json_decode($row_rsEdit['view_links'], true);
$node_id = $row_rsEdit['id'];


?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit <?php echo $reference; ?></title>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
  <h1 class="page-header">Edit <?php echo $subject; ?> <?php echo $reference; ?> </h1>
  <p class="page-header"><a href="<?php echo $mainUrl; ?>">Back</a></p>
  <div>  	  
      <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
          <div class="table-responsive">
 	 		<table class="table">

              <tr valign="baseline">
                  <td nowrap align="right" valign="top">&nbsp;</td>
                  <td><strong>Issue Title</strong></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top">
                      <strong>
                      <input name="type" type="radio" id="new" value="new" checked>
                      <label for="existing">New</label>
                      </strong></td>
                  <td><input type="text" name="title" class="form-control" value="<?php echo $title; ?>"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top">
                      <strong>
                      <input name="type" type="radio" id="existing" value="existing">
                      <label for="existing">Existing</label>
                      </strong></td>
                  <td><label>
                      <select name="title_existing" id="title_existing" class="form-control">
                          <option value="">Select Issue</option>
<?php
do {  
?><option value="<?php echo $row_rsDistinctTitle['title']?>"><?php echo $row_rsDistinctTitle['title']?></option>
                          <?php
} while ($row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle));
  $rows = mysql_num_rows($rsDistinctTitle);
  if($rows > 0) {
      mysql_data_seek($rsDistinctTitle, 0);
	  $row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle);
  }
?>
                      </select>
                  </label></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top">&nbsp;</td>
                  <td><strong>Issue Sub-Topic</strong></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>
                      <input name="type2" type="radio" id="new" value="new" checked>
                      <label for="existing">New</label>
                  </strong></td>
                  <td><input name="sub_topic" type="text" class="form-control" id="sub_topic" value="<?php echo $sub_topic; ?>"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>
                      <input name="type2" type="radio" id="existing" value="existing">
                      <label for="existing">Existing</label>
                  </strong></td>
                  <td><label>
                      <select name="sub_topic_existing" id="sub_topic_existing" class="form-control">
                          <option value="">Select Issue</option>
                          <?php
do {  
?><option value="<?php echo $row_rsDistinctSubtopic['sub_topic']?>"><?php echo $row_rsDistinctSubtopic['sub_topic']?></option>
                          <?php
} while ($row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic));
  $rows = mysql_num_rows($rsDistinctSubtopic);
  if($rows > 0) {
      mysql_data_seek($rsDistinctSubtopic, 0);
	  $row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic);
  }
?>
                      </select>
                  </label></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>Description:</strong></td>
                  <td><textarea name="description" id="description"  rows="5"><?php echo $description; ?></textarea>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>More Explanation :</strong></td>
                  <td><textarea name="description2" id="description2" rows="5"><?php echo $description2; ?></textarea>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Images:</strong></td>
                  <td><div id="images">
                          <input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" />
                          <input name="moreImage" type="button" id="moreImage" value="Add More Images" onClick="addMoreImages();" />
							<?php if (!empty($images)) { ?>
								<?php foreach ($images as $image) { ?> <br />
									 <input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" value="<?php echo $image; ?>" />
								<?php } ?>
							<?php }?>
                      </div>
                          <div id="images2" style="display:none;"> <br />
                                  <input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" />
                          </div>
                      <script>
							function addMoreImages() {
								$('#images').append($('#images2').html());
							}
						</script>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Videos (Youtube URL):</strong></td>
                  <td><div id="videos">
                          <input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
                          <input name="moreVideos" type="button" id="moreVideos" value="Add More Videos" onClick="addMoreVideos();" />
						  <?php if (!empty($videos)) { ?>
								<?php foreach ($videos as $video) { ?> <br />
									 <input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLs" value="<?php echo $video; ?>" />
								<?php } ?>
							<?php }?>
                      </div>
                          <div id="videos2" style="display:none;"> <br />
                                  <input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
                          </div>
                      <script>
							function addMoreVideos() {
								$('#videos').append($('#videos2').html());
							}
						</script>                  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Links / PDF / Document:</strong></td>
                  <td><div id="links">
                          <input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
                          <input name="moreLinks" type="button" id="moreLinks" value="Add More Links" onClick="addMoreLinks();" />
						  <?php if (!empty($links)) { ?>
								<?php foreach ($links as $link) { ?> <br />
									 <input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" value="<?php echo $link; ?>" />
								<?php } ?>
							<?php }?>
                      </div>
                          <div id="links2" style="display:none;"> <br />
                                  <input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
                          </div>
                      <script>
						function addMoreLinks() {
							$('#links').append($('#links2').html());
						}
					</script>                  </td>
              </tr>
              
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Node Type: </strong></td>
                  <td><select name="node_type" id="node_type" class="form-control">
                          <option value="">Select Node</option>
                          <?php foreach ($nodeTypes as $k => $v) { ?>
                          <option value="<?php echo $k; ?>" <?php if ($nt === $k) { ?>selected<?php } ?>><?php echo $v; ?></option>
                          <?php } ?>
                  </select></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Show / Hide:</strong> </td>
                  <td><label>
                      <input <?php if (!(strcmp($row_rsEdit['status'],"1"))) {echo "checked=\"checked\"";} ?> name="status" type="radio" value="1">
                      Public
                      <input <?php if (!(strcmp($row_rsEdit['status'],"0"))) {echo "checked=\"checked\"";} ?> name="status" type="radio" value="0">
                  Private
                  </label></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>References:<br>
                      (Comma separated ids) </strong> </td>
                  <td><input type="text" name="ref_id" class="form-control" value="<?php echo $ref_id; ?>"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Update">
                      <input name="id" type="hidden" id="id" value="<?php echo $row_rsEdit['id']; ?>"></td>
              </tr>
          </table>
		  </div>

<script>

 	$(document).ready(function() {
        $('#description').summernote({
			height: 250						   
		});
        $('#description2').summernote({
			height: 250						   
		});
    });
</script>
<input type="hidden" name="MM_update" value="form1">
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;    </p>
  </div>
</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsDistinctTitle);

mysql_free_result($rsDistinctSubtopic);

mysql_free_result($rsEdit);
?>
