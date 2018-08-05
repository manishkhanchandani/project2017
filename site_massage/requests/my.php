<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');
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

$maxRows_rsMy = 25;
$pageNum_rsMy = 0;
if (isset($_GET['pageNum_rsMy'])) {
  $pageNum_rsMy = $_GET['pageNum_rsMy'];
}
$startRow_rsMy = $pageNum_rsMy * $maxRows_rsMy;

$colname_rsMy = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsMy = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsMy = sprintf("SELECT * FROM ineedmassage WHERE user_id = %s ORDER BY id DESC", $colname_rsMy);
$query_limit_rsMy = sprintf("%s LIMIT %d, %d", $query_rsMy, $startRow_rsMy, $maxRows_rsMy);
$rsMy = mysql_query($query_limit_rsMy, $conn) or die(mysql_error());
$row_rsMy = mysql_fetch_assoc($rsMy);

if (isset($_GET['totalRows_rsMy'])) {
  $totalRows_rsMy = $_GET['totalRows_rsMy'];
} else {
  $all_rsMy = mysql_query($query_rsMy);
  $totalRows_rsMy = mysql_num_rows($all_rsMy);
}
$totalPages_rsMy = ceil($totalRows_rsMy/$maxRows_rsMy)-1;

$queryString_rsMy = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMy") == false && 
        stristr($param, "totalRows_rsMy") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMy = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMy = sprintf("&totalRows_rsMy=%d%s", $totalRows_rsMy, $queryString_rsMy);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/ineedmassage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>My Requests</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link href="<?php echo HTTP_PATH; ?>fontawesome-5.1.1/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<?php include(BASE_DIR.DIRECTORY_SEPARATOR.'head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
	.individualItems {
		margin: 0 8px 8px 0;
		padding: 4px 8px;
		border: 1px solid #e9eced;
		border-radius: 4px;
		font-size: 12px;
    	line-height: 18px;
		vertical-align: baseline;
	}
	
	.rightSide {
		display: flex;
		text-align: center;
    -webkit-box-flex: 0;
	flex: 0 0 auto;
    padding-left: 24px;
    border-width: 1px;
    border-style: none none none solid;
    border-color: #e9eced;
    -webkit-box-align: center;
	align-items: center;
    -webkit-box-pack: center;
	justify-content: center;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
	flex-direction: column;
	font-size: 14px;
    line-height: 20px;
	}
	
	.viewDetails {
		margin-bottom: 16px;    font-size: 14px; line-height: 20px; padding-top: 8px; padding-bottom: 8px; min-height: 40px; background-color: #fff;border-color: #d3d4d5; color: #676d73; box-sizing: border-box; display: inline-block; vertical-align: middle; white-space: nowrap; font-family: inherit; cursor: pointer; margin: 0;     font-weight: 700; user-select: none; border-radius: 4px; padding: 12px 22px; overflow: visible;     border: 2px solid transparent;
	}
</style>
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'NavMulti.php'); ?>
<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
    
	<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
      <div class="panel panel-primary">
			<div class="panel-heading">My Created Requests</div>
			<div class="panel-body">
				
                                <?php if ($totalRows_rsMy > 0) { // Show if recordset not empty ?>
                                   
                            <?php do { ?>
							<?php 
							$row = $row_rsMy;
							include(ROOT_DIR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'row.php'); ?>
										
                                    <!--<div>
											<?php
												echo $row_rsMy['display_name'];
											?>
										</div><tr>
                                        <td><?php echo $row_rsMy['id']; ?></td>
                                        <td><?php echo $row_rsMy['user_id']; ?></td>
                                        <td><?php echo $row_rsMy['current_status']; ?></td>
                                        <td><?php echo $row_rsMy['is_public']; ?></td>
                                        <td><?php echo $row_rsMy['prof_created_dt']; ?></td>
                                        <td><?php echo $row_rsMy['view_images']; ?></td>
                                        <td><?php echo $row_rsMy['view_videos']; ?></td>
                                        <td><?php echo $row_rsMy['view_links']; ?></td>
                                        <td><?php echo $row_rsMy['prof_type']; ?></td>
                                        <td><?php echo $row_rsMy['display_name']; ?></td>
                                        <td><?php echo $row_rsMy['real_name']; ?></td>
                                        <td><?php echo $row_rsMy['id_proof_url']; ?></td>
                                        <td><?php echo $row_rsMy['description']; ?></td>
                                        <td><?php echo $row_rsMy['gender']; ?></td>
                                        <td><?php echo $row_rsMy['looking_gender_female']; ?></td>
                                        <td><?php echo $row_rsMy['looking_gender_male']; ?></td>
                                        <td><?php echo $row_rsMy['location']; ?></td>
                                        <td><?php echo $row_rsMy['prof_lat']; ?></td>
                                        <td><?php echo $row_rsMy['prof_lng']; ?></td>
                                        <td><?php echo $row_rsMy['travel_radius']; ?></td>
                                        <td><?php echo $row_rsMy['host']; ?></td>
                                        <td><?php echo $row_rsMy['massage_table']; ?></td>
                                        <td><?php echo $row_rsMy['qualification']; ?></td>
                                        <td><?php echo $row_rsMy['type_swedish']; ?></td>
                                        <td><?php echo $row_rsMy['type_deep']; ?></td>
                                        <td><?php echo $row_rsMy['type_thai']; ?></td>
                                        <td><?php echo $row_rsMy['type_sports']; ?></td>
                                        <td><?php echo $row_rsMy['type_pregnancy']; ?></td>
                                        <td><?php echo $row_rsMy['type_reflexology']; ?></td>
                                        <td><?php echo $row_rsMy['type_medical']; ?></td>
                                        <td><?php echo $row_rsMy['type_hotstone']; ?></td>
                                        <td><?php echo $row_rsMy['prof_country']; ?></td>
                                        <td><?php echo $row_rsMy['prof_state']; ?></td>
                                        <td><?php echo $row_rsMy['prof_county']; ?></td>
                                        <td><?php echo $row_rsMy['prof_city']; ?></td>
                                        <td><?php echo $row_rsMy['marital_status']; ?></td>
                                    </tr> -->
                                    <?php } while ($row_rsMy = mysql_fetch_assoc($rsMy)); ?>
                                                     
                                    <table border="0" width="50%" align="center">
                                        <tr>
                                            <td width="23%" align="center"><?php if ($pageNum_rsMy > 0) { // Show if not first page ?>
                                                <a href="<?php printf("%s?pageNum_rsMy=%d%s", $currentPage, 0, $queryString_rsMy); ?>">First</a>
                                                    <?php } // Show if not first page ?>                                                                                            </td>
                                            <td width="31%" align="center"><?php if ($pageNum_rsMy > 0) { // Show if not first page ?>
                                                <a href="<?php printf("%s?pageNum_rsMy=%d%s", $currentPage, max(0, $pageNum_rsMy - 1), $queryString_rsMy); ?>">Previous</a>
                                                    <?php } // Show if not first page ?>                                                                                            </td>
                                            <td width="23%" align="center"><?php if ($pageNum_rsMy < $totalPages_rsMy) { // Show if not last page ?>
                                                <a href="<?php printf("%s?pageNum_rsMy=%d%s", $currentPage, min($totalPages_rsMy, $pageNum_rsMy + 1), $queryString_rsMy); ?>">Next</a>
                                                    <?php } // Show if not last page ?>                                                                                            </td>
                                            <td width="23%" align="center"><?php if ($pageNum_rsMy < $totalPages_rsMy) { // Show if not last page ?>
                                                <a href="<?php printf("%s?pageNum_rsMy=%d%s", $currentPage, $totalPages_rsMy, $queryString_rsMy); ?>">Last</a>
                                                    <?php } // Show if not last page ?>                                                                                            </td>
                                        </tr>
                                                                            </table>
                                    <p>Records <?php echo ($startRow_rsMy + 1) ?> to <?php echo min($startRow_rsMy + $maxRows_rsMy, $totalRows_rsMy) ?> of <?php echo $totalRows_rsMy ?></p>
                                    <?php } // Show if recordset not empty ?>
                                <?php if ($totalRows_rsMy == 0) { // Show if recordset empty ?>
                                    <p>No Request Found </p>
                                    <?php } // Show if recordset empty ?>    
			</div>
		</div>
  	</div>


  </div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMy);
?>
