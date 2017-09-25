<?php require_once('../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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

$MM_restrictGoTo = "login.php";
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_issue_mbe_essay (subject, title, `description`, essay_related, mbe_related, own_words, user_id) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['essay_related'], "text"),
                       GetSQLValueString($_POST['mbe_related'], "text"),
                       GetSQLValueString($_POST['own_words'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE qz_issue_mbe_essay SET subject=%s, title=%s, `description`=%s, essay_related=%s, mbe_related=%s, own_words=%s WHERE issue_id=%s",
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['essay_related'], "text"),
                       GetSQLValueString($_POST['mbe_related'], "text"),
                       GetSQLValueString($_POST['own_words'], "text"),
                       GetSQLValueString($_POST['issue_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

$maxRows_rsIssues = 25;
$pageNum_rsIssues = 0;
if (isset($_GET['pageNum_rsIssues'])) {
  $pageNum_rsIssues = $_GET['pageNum_rsIssues'];
}
$startRow_rsIssues = $pageNum_rsIssues * $maxRows_rsIssues;

$colname_rsIssues = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsIssues = $_SESSION['MM_UserId'];
}
$colsubject_rsIssues = "%";
if (isset($_GET['subject'])) {
  $colsubject_rsIssues = $_GET['subject'];
}
$col_issue_rsIssues = "%";
if (isset($_GET['keyword'])) {
  $col_issue_rsIssues = $_GET['keyword'];
}
mysql_select_db($database_conn, $conn);
$query_rsIssues = sprintf("SELECT * FROM qz_issue_mbe_essay WHERE user_id = %s AND  (title LIKE %s OR `description` LIKE %s OR essay_related LIKE %s OR mbe_related LIKE %s OR own_words LIKE %s) AND subject LIKE %s ORDER BY subject ASC, issue_id ASC", GetSQLValueString($colname_rsIssues, "int"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString("%" . $col_issue_rsIssues . "%", "text"),GetSQLValueString($colsubject_rsIssues, "text"));
$query_limit_rsIssues = sprintf("%s LIMIT %d, %d", $query_rsIssues, $startRow_rsIssues, $maxRows_rsIssues);
$rsIssues = mysql_query($query_limit_rsIssues, $conn) or die(mysql_error());
$row_rsIssues = mysql_fetch_assoc($rsIssues);

if (isset($_GET['totalRows_rsIssues'])) {
  $totalRows_rsIssues = $_GET['totalRows_rsIssues'];
} else {
  $all_rsIssues = mysql_query($query_rsIssues);
  $totalRows_rsIssues = mysql_num_rows($all_rsIssues);
}
$totalPages_rsIssues = ceil($totalRows_rsIssues/$maxRows_rsIssues)-1;

$colname_rsEdit = "-1";
if (isset($_GET['issue_id'])) {
  $colname_rsEdit = $_GET['issue_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM qz_issue_mbe_essay WHERE issue_id = %s", GetSQLValueString($colname_rsEdit, "int"));
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$queryString_rsIssues = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsIssues") == false && 
        stristr($param, "totalRows_rsIssues") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsIssues = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsIssues = sprintf("&totalRows_rsIssues=%d%s", $totalRows_rsIssues, $queryString_rsIssues);

$subject = '';

if (!empty($_POST['subject'])) {
	$subject = $_POST['subject'];	
} else if (!empty($_GET['subject'])) {
	$subject = $_GET['subject'];	
}


$keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Issues</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->

<!-- include summernote css/js-->
<link href="library/wysiwyg/summernote.css" rel="stylesheet">
<script src="library/wysiwyg/summernote.js"></script>

<!-- InstanceEndEditable -->
</head>

<body>

    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Quiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="issues.php">Issue Spotting</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
		  	<?php if (!empty($_SESSION['MM_UserId'])) { ?>
            <li><a href="logout.php">Logout</a></li>
			<?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Issue Details</h1>
<p><a href="issue_details.php">Refresh</a></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="table-responsive">
  <table class="table table-striped">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject:</td>
      <td><select name="subject">
        <option value="contracts" <?php if (!(strcmp("contracts", $subject))) {echo "selected=\"selected\"";} ?>>Contracts</option>
        <option value="criminal" <?php if (!(strcmp("criminal", $subject))) {echo "selected=\"selected\"";} ?>>Criminal</option>
        <option value="torts" <?php if (!(strcmp("torts", $subject))) {echo "selected=\"selected\"";} ?>>Torts</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Title:</td>
      <td><input type="text" name="title" id="title" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Description:</td>
      <td><textarea name="description" cols="50" rows="5" id="description_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Essay_related:</td>
      <td><textarea name="essay_related" cols="50" rows="5" id="essay_related_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Mbe_related:</td>
      <td><textarea name="mbe_related" cols="50" rows="5" id="mbe_related_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Own_words:</td>
      <td><textarea name="own_words" value="" cols="50" rows="10" id="own_words_1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  </div>
  <input type="hidden" name="MM_insert" value="form1" />
  <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
</form>
<script>
 	$(document).ready(function() {
        $('#description_1').summernote();
        $('#essay_related_1').summernote();
        $('#mbe_related_1').summernote();
        $('#own_words_1').summernote();
    });
</script>
<script>
document.getElementById('title').focus();
</script>
<h3>View Issue</h3>
<form name="form3" method="get" action="">
Keyword: 
<label>
<input name="keyword" type="text" id="keyword" value="<?php echo $keyword; ?>">
</label> 
Subject: 
<select name="subject" id="subject">
<option value="%" <?php if (!(strcmp("%", $subject))) {echo "selected=\"selected\"";} ?>>All</option>
<option value="contracts" <?php if (!(strcmp("contracts", $subject))) {echo "selected=\"selected\"";} ?>>Contracts</option>
<option value="criminal" <?php if (!(strcmp("criminal", $subject))) {echo "selected=\"selected\"";} ?>>Criminal</option>
<option value="torts" <?php if (!(strcmp("torts", $subject))) {echo "selected=\"selected\"";} ?>>Torts</option>
</select>
<label>
<input type="submit" id="button" value="Search">
</label>
</form>
<p>&nbsp;</p>
<?php if ($totalRows_rsIssues > 0) { // Show if recordset not empty ?>
  
<div class="table-responsive">
<table class="table table-striped">
    <tr>
      <td valign="top"><strong>Issue ID</strong></td>
      <td valign="top"><strong>Subject</strong></td>
      <td valign="top"><strong>Title</strong></td>
      <td valign="top"><strong>Edit</strong></td>
      <td valign="top"><strong>Details</strong></td>
      </tr>
    <?php do { ?>
      <tr>
        <td valign="top"><?php echo $row_rsIssues['issue_id']; ?></td>
        <td valign="top"><?php echo $row_rsIssues['subject']; ?></td>
        <td valign="top"><p><strong><?php echo $row_rsIssues['title']; ?></strong></p>
          <p><?php echo $row_rsIssues['description']; ?></p></td>
        <td valign="top"><a href="issue_details.php?issue_id=<?php echo $row_rsIssues['issue_id']; ?>&keyword=<?php echo $keyword; ?>&subject=<?php echo $subject; ?>#edit">Edit</a></td>
        <td valign="top"><a href="issue_details_display.php?issue_id=<?php echo $row_rsIssues['issue_id']; ?>">Details</a></td>
    </tr>
    <?php } while ($row_rsIssues = mysql_fetch_assoc($rsIssues)); ?>
  </table>
  </div>
  <p> Records <?php echo ($startRow_rsIssues + 1) ?> to <?php echo min($startRow_rsIssues + $maxRows_rsIssues, $totalRows_rsIssues) ?> of <?php echo $totalRows_rsIssues ?> </p>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_rsIssues > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, 0, $queryString_rsIssues); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsIssues > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, max(0, $pageNum_rsIssues - 1), $queryString_rsIssues); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_rsIssues < $totalPages_rsIssues) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, min($totalPages_rsIssues, $pageNum_rsIssues + 1), $queryString_rsIssues); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_rsIssues < $totalPages_rsIssues) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsIssues=%d%s", $currentPage, $totalPages_rsIssues, $queryString_rsIssues); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
  <h3>Edit Issue<a name="edit"></a></h3>
  <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
    <div class="table-responsive">
  <table class="table table-striped">
      <tr valign="baseline">
        <td nowrap align="right"><strong>Subject:</strong></td>
        <td><select name="subject">
          <option value="contracts" <?php if (!(strcmp("contracts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Contracts</option>
          <option value="criminal" <?php if (!(strcmp("criminal", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Criminal</option>
          <option value="torts" <?php if (!(strcmp("torts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Torts</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><strong>Title:</strong></td>
        <td><input type="text" name="title" value="<?php echo htmlentities($row_rsEdit['title'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top"><strong>Description:</strong></td>
        <td><textarea name="description" cols="50" rows="5" id="description_2"><?php echo htmlentities($row_rsEdit['description'], ENT_COMPAT, ''); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top"><strong>Essay_related:</strong></td>
        <td><textarea name="essay_related" cols="50" rows="5" id="essay_related_2"><?php echo htmlentities($row_rsEdit['essay_related'], ENT_COMPAT, ''); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top"><strong>Mbe_related:</strong></td>
        <td><textarea name="mbe_related" cols="50" rows="5" id="mbe_related_2"><?php echo htmlentities($row_rsEdit['mbe_related'], ENT_COMPAT, ''); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top"><strong>Own_words:</strong></td>
        <td><textarea name="own_words" cols="50" rows="5" id="own_words_2"><?php echo htmlentities($row_rsEdit['own_words'], ENT_COMPAT, ''); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Update record"></td>
      </tr>
    </table>
    </div>
    <input type="hidden" name="MM_update" value="form2">
    <input type="hidden" name="issue_id" value="<?php echo $row_rsEdit['issue_id']; ?>">
  </form>
  
<script>
 	$(document).ready(function() {
        $('#description_2').summernote();
        $('#essay_related_2').summernote();
        $('#mbe_related_2').summernote();
        $('#own_words_2').summernote();
    });
</script>
  <?php } // Show if recordset not empty ?>

<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsIssues);

mysql_free_result($rsEdit);
?>
