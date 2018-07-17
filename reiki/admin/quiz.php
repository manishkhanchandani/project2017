<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

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
?><?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_rsView = 25;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM reiki_chakra_quiz INNER JOIN users_auth ON reiki_chakra_quiz.user_id = users_auth.user_id ORDER BY users_auth.display_name ASC,  reiki_chakra_quiz.quiz_date DESC";
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);


$quiz = array(
	array('title' => 'Root Chakra', 'name' => 'root_chakra', 'category_id' => 61, 'questions' => array('I feel emotionally stable and grounded.', 'I rarely go a day without being in nature.', 'I feel safe, confident and secure.', 'I trust my natural instincts to make decisions.')),
	array('title' => 'Sacral Chakra', 'name' => 'sacral_chakra', 'category_id' => 62, 'questions' => array('I embrace my sensual/sexual nature.', 'I am full of energy each day.', 'It is easy for me to express my creativity.', 'I regularly have sex with people/a person I trust.')),
	array('title' => 'Solar Plexus Chakra', 'name' => 'solar_plexus_chakra', 'category_id' => 63, 'questions' => array('I find it easy to forgive myself of my flaws and mistakes.', 'I have a vibrant sense of humor.', 'I accept responsibility for my actions (e.g. I don\' t blame, criticize or judge others).', 'I actively try to fix my problems rather than wallowing in the misery of my failure.')),
	array('title' => 'Heart Chakra', 'name' => 'heart_chakra', 'category_id' => 64, 'questions' => array('I love the person I am.', 'I have empathy for others (even those who harm me).', 'When I give I don\' t expect anything in return.', 'I can forgive other people easily.')),
	array('title' => 'Throat Chakra', 'name' => 'throat_chakra', 'category_id' => 65, 'questions' => array('I can speak up for myself and my own needs.', 'I respect my boundaries and know when to say "no" or "yes".', 'When I speak, I ensure that I am heard and understood clearly.', 'I am a good listener.')),
	array('title' => 'Third Eye Chakra', 'name' => 'third_eye_chakra', 'category_id' => 66, 'questions' => array('When it comes to issues in my life I can see the big picture rather than getting lost in the details.', 'My intuition is well-developed.', 'It is easy for me to open to new perceptions, opinions, beliefs and ideas.', 'My thoughts are clear, focused and directed (i.e. I don\' t get stuck in intellectual ruts or cycles).')),
	array('title' => 'Crown Chakra', 'name' => 'crown_chakra', 'category_id' => 68, 'questions' => array('I feel as though my life has a great purpose.', 'I feel a sense of connection to God/Divinity/Consciousness.', 'I have hope.', 'I don\' t take myself too seriously (lovingly).')),

);
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administrator : Quiz</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Administrator : Quiz</h1>

  <div id="content" class="visual">
      <h3>Results</h3>
      <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
	  
                  <?php do { ?>
				  <?php $quiz_result = json_decode($row_rsView['quiz_result'], true); 
				  
				  ?>
					<div class="row">
						<div class="col-md-8">
						
						<div class="table-responsive">
							<table class="table">
							  <tr>
								  <td valign="top"><strong>Picture</strong></td>
								  <td valign="top"><strong>Quiz Date </strong></td>
									  <td valign="top"><strong>Root Chakra </strong></td>
									  <td valign="top"><strong>Sacral Chakra </strong></td>
									  <td valign="top"><strong>Solar Plexus Chakra </strong></td>
									  <td valign="top"><strong>Heart Chakra </strong></td>
									  <td valign="top"><strong>Throat Chakra </strong></td>
									  <td valign="top"><strong>Third Eye Chakra </strong></td>
									  <td valign="top"><strong>Crown Chakra </strong></td>
									</tr>
									  <tr>
										  <td valign="top"><img src="<?php echo $row_rsView['profile_img']; ?>" class="img-responsive" style="max-width: 100px" /><br>
											  <?php echo $row_rsView['display_name']; ?><br>
												<?php echo $row_rsView['total_points']; ?>
											</td>
										  <td valign="top"><?php echo $row_rsView['quiz_date']; ?></td>
										  <td valign="top"><?php echo $row_rsView['root_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['sacral_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['solar_plexus_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['heart_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['throat_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['third_eye_chakra']; ?></td>
										  <td valign="top"><?php echo $row_rsView['crown_chakra']; ?></td>
										</tr>
						  </table>
						  </div>
						
						
						</div>
						<div class="col-md-4">
							<div class="table-responsive">
  								<table width="50%" border="1" cellspacing="5" cellpadding="5">
									<?php
									for ($i = 0; $i <= 6; $i++) {
									foreach ($quiz_result['data'][$i] as $k => $v) {
									?>
										<tr>
											<td style="padding:10px;"><?php echo ($k === 1) ? $quiz[$i]['title'] : ''; ?></td>
											<td style="padding:10px;"><?php echo $quiz[$i]['questions'][$k]; ?></td>
											<td style="padding:10px;"><?php echo $v; ?></td>
										</tr>
									<?php
										}
									}
									?>
								</table>
							</div>
						</div>
					</div>
	  
          
          <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
          <p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?></p>
          <table border="0" width="50%" align="center">
                        <tr>
                            <td width="23%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                            <?php } // Show if not first page ?>                                                    </td>
                            <td width="31%" align="center"><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                            <?php } // Show if not first page ?>                                                    </td>
                            <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                            <?php } // Show if not last page ?>                                                    </td>
                            <td width="23%" align="center"><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                            <?php } // Show if not last page ?>                                                    </td>
                        </tr>
                    </table>
          <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
          <p>No Result Found. </p>
          <?php } // Show if recordset empty ?><p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);
?>
