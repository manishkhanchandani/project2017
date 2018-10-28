<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
$id = $_GET['id'];
$subjectUrl = $_GET['subjectUrl'];
$node_type = $_GET['node_type'];
$reference = $nodeTypes[$node_type]['name'];

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
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
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


$sql = '';

if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND status = 1";
} else {
	$sql .= sprintf(" AND (status = 1 OR (status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}

if (empty($_SESSION['MM_UserId'])) {
	$sql .= " AND current_status = 1";
} else {
	$sql .= sprintf(" AND (current_status = 1 OR (current_status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
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
	
	$_POST['current_status'] = 1;
	$sendMail = false;
	if ((int) $_POST['status'] === 1) {
		$_POST['current_status'] = 0;
		$sendMail = true;
	}

	if (!empty($error)) {
		unset($_POST['MM_insert']);
	} else {
		setcookie('sub_topic_'.$id, $_POST['sub_topic'], (time() + 60*60*24), '/');
	}
}

$redirect = false;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO calbabybar_nodes (user_id, subject_id, title, description, node_type, description2, sub_topic, view_images, view_videos, view_links, status, ref_id, current_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($_POST['subject_id'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['node_type'], "text"),
                       GetSQLValueString($_POST['description2'], "text"),
                       GetSQLValueString($_POST['sub_topic'], "text"),
                       GetSQLValueString($_POST['view_images'], "text"),
                       GetSQLValueString($_POST['view_videos'], "text"),
                       GetSQLValueString($_POST['view_links'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['ref_id'], "text"),
                       GetSQLValueString($_POST['current_status'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  
  
  $id = mysql_insert_id();
  if (!empty($_POST['ref_id'])) {
  	$tmp = explode(',', $_POST['ref_id']);
	foreach ($tmp as $k => $v) {
		$ref_id = trim($v);
		$sql = sprintf("INSERT INTO calbabybar_ref (id, ref_id) VALUES (%s, %s)",
                       GetSQLValueString($id, "int"),
                       GetSQLValueString($ref_id, "int"));

	  mysql_select_db($database_conn, $conn);
	  mysql_query($sql, $conn) or die(mysql_error());
	}
  }

  $insertGoTo = $mainUrl.'/detail/'.$id;
  if (!empty($sendMail)) {
  		mail("mkgxy@mkgalaxy.com", "New content posted on calbabybar.com with id at ".$id, "View the content at http://calbabybar.com/admin/change_status.php", "From:admin of calbabybar.com<admin@calbabybar.com>");
	}
  header(sprintf("Location: %s", $insertGoTo));
  $redirect = true;
  $error = "Posting successful. Redirecting you ....";
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


$title = !empty($_POST['title']) ? $_POST['title'] : '';
$description = !empty($_POST['description']) ? $_POST['description'] : '';
$description2 = !empty($_POST['description2']) ? $_POST['description2'] : '';
$sub_topic = !empty($_POST['sub_topic']) ? $_POST['sub_topic'] : (!empty($_COOKIE['sub_topic_'.$id]) ? $_COOKIE['sub_topic_'.$id] : '');
$ref_id = !empty($_POST['ref_id']) ? $_POST['ref_id'] : '';
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Create New <?php echo $reference; ?></title>
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
  <h1 class="page-header">Create New <?php echo $subject; ?> <?php echo $reference; ?> </h1>
  <p class="page-header"><a href="<?php echo $mainUrl; ?>">Back</a></p>
  <div>  	  
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<?php if (!empty($error)) { ?>
<div class="alert alert-success">
  <?php echo $error; ?>
</div>
<?php } ?>
<?php 
if (!empty($redirect) && ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1"))) { ?>
<script>
var Post = Parse.Object.extend("BabyBarNodes");//create new class, table
var post = new Post(); //new row
post.set("user_id", "<?php echo $_SESSION['MM_UserId']; ?>");
post.set("subject_id", "<?php echo $_POST['subject_id']; ?>");
post.set("title", "<?php echo $_POST['title']; ?>");
post.set("description", "<?php echo $_POST['description']; ?>");
post.set("node_type", "<?php echo $_POST['node_type']; ?>");
post.set("description2", "<?php echo $_POST['description2']; ?>");
post.set("sub_topic", "<?php echo $_POST['sub_topic']; ?>");
post.set("view_images", "<?php echo $_POST['view_images']; ?>");
post.set("view_videos", "<?php echo $_POST['view_videos']; ?>");
post.set("view_links", "<?php echo $_POST['view_links']; ?>");
post.set("status", "<?php echo $_POST['status']; ?>");
post.set("refer_id", "<?php echo $_POST['ref_id']; ?>");
post.save(null, {
	success: (obj) => {
		console.log('successfully saved: ', obj.id);
	},
	error: (obj, err) => {console.log(' object: ', obj);console.log(' error: ', err);}
});
</script>
<meta http-equiv="refresh" content="3;URL=<?php echo $mainUrl; ?>">

<?php } ?>
          <div class="table-responsive">
 	 		<table class="table">

              <tr valign="baseline">
                  <td nowrap align="right" valign="top">&nbsp;</td>
                  <td><strong><?php echo $reference; ?> Title</strong></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top">
                      <strong>
                      <input name="type" type="radio" id="new" value="new" checked>
                      <label for="existing">New</label>
                      </strong></td>
                  <td><input type="text" name="title" class="form-control" value="<?php echo $title; ?>" maxlength="255"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top">
                      <strong>
                      <input name="type" id="existing" type="radio" value="existing">
                      <label for="existing">Existing</label>
                      </strong></td>
                  <td><label>
                      <select name="title_existing" id="title_existing" class="form-control">
                          <option value="">Select <?php echo $reference; ?></option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_rsDistinctTitle['title']?>"><?php echo $row_rsDistinctTitle['title']?></option>
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
                  <td><strong><?php echo $reference; ?> Sub-Topic</strong></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>
                      <input name="type2" type="radio" id="new" value="new" maxlength="200" <?php if ($totalRows_rsDistinctSubtopic === 0) { ?>checked="checked"<?php } ?>>
                      <label for="existing">New</label>
                  </strong></td>
                  <td><input name="sub_topic" type="text" class="form-control" id="sub_topic"  value="<?php echo $sub_topic; ?>"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right" valign="top"><strong>
                      <input name="type2" id="existing" type="radio" value="existing" <?php if ($totalRows_rsDistinctSubtopic > 0) { ?>checked="checked"<?php } ?>>
                      <label for="existing">Existing</label>
                  </strong></td>
                  <td><label>
                      <select name="sub_topic_existing" id="sub_topic_existing" class="form-control">
                          <?php
do {  
?>
                          <option value="<?php echo $row_rsDistinctSubtopic['sub_topic']?>" <?php if ($sub_topic === $row_rsDistinctSubtopic['sub_topic']) { ?>selected="selected"<?php } ?> ><?php echo $row_rsDistinctSubtopic['sub_topic']?></option>
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
						</div>
						<div id="images2" style="display:none;">
						<br />
						<input name="view_images[]" type="text" id="view_images[]" size="55" placeholder="Add Image URL" />
						</div>
						<script>
							function addMoreImages() {
								$('#images').append($('#images2').html());
							}
						</script>					</td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Videos (Youtube URL):</strong></td>
                  <td>
				  	<div id="videos">
						<input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
						<input name="moreVideos" type="button" id="moreVideos" value="Add More Videos" onClick="addMoreVideos();" />
						</div>
						<div id="videos2" style="display:none;">
							<br />
							<input name="view_videos[]" type="text" id="view_videos[]" size="55" placeholder="Add Youtube URLS" />
						</div>
						<script>
							function addMoreVideos() {
								$('#videos').append($('#videos2').html());
							}
						</script>				  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Links / PDF / Document:</strong></td>
                  <td>
				  	<div id="links">
						<input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
						<input name="moreLinks" type="button" id="moreLinks" value="Add More Links" onClick="addMoreLinks();" />
					</div>
					<div id="links2" style="display:none;">
						<br />
						<input name="view_links[]" type="text" id="view_links[]" size="55" placeholder="Add Links" />
					</div>
					<script>
						function addMoreLinks() {
							$('#links').append($('#links2').html());
						}
					</script>				  </td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Node Type: </strong></td>
                  <td><select name="node_type" id="node_type" class="form-control">
                      <option value="">Select Node</option>
					  <?php foreach ($nodeTypes as $k => $v) { ?>
					  <option value="<?php echo $k; ?>" <?php if ($node_type === $k) { ?>selected<?php } ?>><?php echo $v['name']; ?></option>
					  <?php } ?>
                  </select></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>Show / Hide:</strong> </td>
                  <td><label>
                      <input  name="status" type="radio" value="1" checked>
                      Public
                      <input   name="status" type="radio" value="0">
                      Private </label></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right"><strong>References:<br>
					(Comma separated ids)
					</strong> </td>
                  <td><input type="text" name="ref_id" class="form-control" value="<?php echo $ref_id; ?>"></td>
              </tr>
              <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Submit"></td>
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
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
          <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
          <input type="hidden" name="MM_insert" value="form1">
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
?>
