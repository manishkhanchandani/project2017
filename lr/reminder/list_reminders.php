<?php require_once('../../Connections/conn.php'); ?>
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

$MM_restrictGoTo = "../users/login.php";
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
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsReminder = 25;
$pageNum_rsReminder = 0;
if (isset($_GET['pageNum_rsReminder'])) {
  $pageNum_rsReminder = $_GET['pageNum_rsReminder'];
}
$startRow_rsReminder = $pageNum_rsReminder * $maxRows_rsReminder;

$colname_rsReminder = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rsReminder = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_conn, $conn);
$query_rsReminder = sprintf("select * from lr_reminders INNER JOIN lr_users ON lr_reminders.user_id = lr_users.user_id WHERE lr_users.email = '%s'", $colname_rsReminder);
$query_limit_rsReminder = sprintf("%s LIMIT %d, %d", $query_rsReminder, $startRow_rsReminder, $maxRows_rsReminder);
$rsReminder = mysql_query($query_limit_rsReminder, $conn) or die(mysql_error());
$row_rsReminder = mysql_fetch_assoc($rsReminder);

if (isset($_GET['totalRows_rsReminder'])) {
  $totalRows_rsReminder = $_GET['totalRows_rsReminder'];
} else {
  $all_rsReminder = mysql_query($query_rsReminder);
  $totalRows_rsReminder = mysql_num_rows($all_rsReminder);
}
$totalPages_rsReminder = ceil($totalRows_rsReminder/$maxRows_rsReminder)-1;

$queryString_rsReminder = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsReminder") == false && 
        stristr($param, "totalRows_rsReminder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsReminder = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsReminder = sprintf("&totalRows_rsReminder=%d%s", $totalRows_rsReminder, $queryString_rsReminder);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
<meta charset="utf-8">
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
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
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
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../navbar/">Default</a></li>
            <li class="active"><a href="../../Templates/./">Static top <span class="sr-only">(current)</span></a></li>
            <li><a href="../../navbar-fixed-top/">Fixed top</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
	<!-- InstanceBeginEditable name="EditRegion3" -->
		<div class="row">
		  <div class="col-md-12">
				<h3>List Reminders</h3>
				<?php if ($totalRows_rsReminder > 0) { // Show if recordset not empty ?>
				  <div class="table-responsive">
			        <table class="table table-striped">
                      <tr>
                        <td><strong>Title</strong></td>
                        <td><strong>Email To </strong></td>
                        <td><strong>Message</strong></td>
                        <td><strong>File Link </strong></td>
                        <td><strong>Status</strong></td>
                        <td><strong>Reminder Created Date </strong></td>
                        <td><strong>Edit</strong></td>
                        <td><strong>Delete</strong></td>
                      </tr>
                      <?php do { ?>
                        <tr>
                          <td><?php echo $row_rsReminder['title']; ?></td>
                          <td><?php echo $row_rsReminder['emailTo']; ?></td>
                          <td><?php echo nl2br($row_rsReminder['message']);?></td>
                          <td><?php echo $row_rsReminder['fileLink']; ?></td>
                          <td><?php echo $row_rsReminder['status']; ?></td>
                          <td><?php echo $row_rsReminder['reminder_created_dt']; ?></td>
                          <td><a href="#">Edit</a></td>
                          <td><a href="delete_reminder.php?reminder_id=<?php echo $row_rsReminder['reminder_id']; ?>">Delete</a></td>
                        </tr>
                        <?php } while ($row_rsReminder = mysql_fetch_assoc($rsReminder)); ?>
                                        </table>
				    </div>
				  <p> Records <?php echo ($startRow_rsReminder + 1) ?> to <?php echo min($startRow_rsReminder + $maxRows_rsReminder, $totalRows_rsReminder) ?> of <?php echo $totalRows_rsReminder ?>
                      <table border="0" width="50%" align="center">
                        <tr>
                          <td width="23%" align="center"><?php if ($pageNum_rsReminder > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_rsReminder=%d%s", $currentPage, 0, $queryString_rsReminder); ?>">First</a>
                                <?php } // Show if not first page ?>                                              </td>
                          <td width="31%" align="center"><?php if ($pageNum_rsReminder > 0) { // Show if not first page ?>
                                <a href="<?php printf("%s?pageNum_rsReminder=%d%s", $currentPage, max(0, $pageNum_rsReminder - 1), $queryString_rsReminder); ?>">Previous</a>
                                <?php } // Show if not first page ?>                                              </td>
                          <td width="23%" align="center"><?php if ($pageNum_rsReminder < $totalPages_rsReminder) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_rsReminder=%d%s", $currentPage, min($totalPages_rsReminder, $pageNum_rsReminder + 1), $queryString_rsReminder); ?>">Next</a>
                                <?php } // Show if not last page ?>                                              </td>
                          <td width="23%" align="center"><?php if ($pageNum_rsReminder < $totalPages_rsReminder) { // Show if not last page ?>
                                <a href="<?php printf("%s?pageNum_rsReminder=%d%s", $currentPage, $totalPages_rsReminder, $queryString_rsReminder); ?>">Last</a>
                                <?php } // Show if not last page ?>                                              </td>
                        </tr>
                                      </table>
				  <?php } // Show if recordset not empty ?>
				</p>
                <?php if ($totalRows_rsReminder == 0) { // Show if recordset empty ?>
                <p>No Reminder in Your List.
                    <?php } // Show if recordset empty ?>
                </p>
<p>&nbsp;</p>
		  </div>
		</div>  
  <!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReminder);
?>