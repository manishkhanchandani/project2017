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
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

if (!empty($_POST['MM_insert'])) {
	pr($_POST);
	
	foreach ($_POST['data'] as $k => $v) {
		$title = trim($v['title']);
		if (empty($title)) continue;
		echo $insertSQL = sprintf("INSERT INTO calbabybar_nodes (user_id, subject_id, title, description, node_type, sub_topic, status, current_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($v['subject_id'], "int"),
                       GetSQLValueString($title, "text"),
                       GetSQLValueString($v['description'], "text"),
                       GetSQLValueString($v['node_type'], "text"),
                       GetSQLValueString($v['sub_topic'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['current_status'], "int"));

	  //mysql_select_db($database_conn, $conn);
	  //$Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
	}
	exit;
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Title</title>
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
  <h1 class="page-header">Bulk Create </h1>

  <form name="form1" method="post" action="">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Subject</th>
          <th>Title</th>
          <th>SubTopic</th>
          <th>Description</th>
          <th>Node Type</th>
        </tr>
      </thead>
      <tbody>
	  	<?php for ($i = 0; $i < 10; $i++) { ?>
        <tr>
          <td><?php echo $i + 1; ?></td>
          <td><select name="data[<?php echo $i; ?>][subject_id]" size="4">
		  	<?php foreach ($barSubjects as $k => $v) { ?>
			<option value="<?php echo $k; ?>"><?php echo $v['subject']; ?></option>
			<?php } ?>
		  
		  </select></td>
          <td><input type="text" name="data[<?php echo $i; ?>][title]"></td>
          <td><input type="text" name="data[<?php echo $i; ?>][sub_topic]" value="<?php echo !empty($_POST[$i]['sub_topic']) ? $_POST[$i]['sub_topic'] : 'General'; ?>"></td>
          <td><textarea name="data[<?php echo $i; ?>][description]" rows="4"></textarea></td>
          <td>
              <input type="text" name="data[<?php echo $i; ?>][node_type]" value="<?php echo !empty($_POST[$i]['node_type']) ? $_POST[$i]['node_type'] : 'defs'; ?>"><br>
			e.g. 'defs','casebriefs','midterma','midtermb','issues','essays','mbe','assignments','quizes'			</td>
        </tr>
		<?php } ?>
      </tbody>
    </table>
  </div>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
          <input type="hidden" name="current_status" value="1">
          <input type="hidden" name="status" value="1">
          <input type="hidden" name="MM_insert" value="form1">
		  <input type="submit" value="Submit">
  </form>
</div>

  </div>
<!-- InstanceEndEditable -->
</div>
</body><!-- InstanceEnd -->
</html>
