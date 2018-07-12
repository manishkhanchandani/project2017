<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "reiki1,admin,reiki12,reiki123";
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
?>
<?php 
$pulse = array(
	'right' => array(
		array(
			'tw' => array('name' => 'Adrenals/Thyroid', 'key' => 'tw', 'type' => 'superficial'),
			'p' => array('name' => 'Sex Organs', 'key' => 'p', 'type' => 'deep')
		),
		array(
			'st' => array('name' => 'Stomach', 'key' => 'st', 'type' => 'superficial'),
			'sp' => array('name' => 'Spleen', 'key' => 'sp', 'type' => 'deep')
		),
		array(
			'li' => array('name' => 'Large Intestine', 'key' => 'li', 'type' => 'superficial'),
			'lu' => array('name' => 'Lungs', 'key' => 'lu', 'type' => 'deep')
		)
	),
	'left' => array(
		array(
			'k' => array('name' => 'Kidney', 'key' => 'k', 'type' => 'deep'),
			'ub' => array('name' => 'Urinary Bladder', 'key' => 'ub', 'type' => 'superficial')
		),
		array(
			'liv' => array('name' => 'Liver', 'key' => 'liv', 'type' => 'deep'),
			'gb' => array('name' => 'Gall Bladder', 'key' => 'gb', 'type' => 'superficial')
		),
		array(
			'h' => array('name' => 'Heart', 'key' => 'h', 'type' => 'deep'),
			'si' => array('name' => 'Small Intestine', 'key' => 'si', 'type' => 'superficial')
		)
	)
);
$quality = array(
	array('label' => '++', 'name' => 'pp'),
	array('label' => '+', 'name' => 'p'),
	array('label' => '+-', 'name' => 'pm'),
	array('label' => '-', 'name' => 'm'),
	array('label' => '--', 'name' => 'mm'),
);

if ($_POST) {
	echo '<pre>';
	print_r($_POST);
	exit;
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki : Pulse Diagnosis</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/firebase_4_1_5.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
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

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Pulse Diagnosis</h1>

  <div id="content" class="visual">
      <form name="form1" method="post" action="">
      <div class="row">
	  	<div class="col-md-4">
			<div class="table-responsive">
  				<table class="table">
				<tr>
					<td>
						Superficial
					</td>
					<td>
						Deep
					</td>
				</tr>
				<?php foreach ($pulse['right'] as $k => $v) { ?>
				<tr>
					<?php foreach ($v as $k1 => $v1) { ?>
					<td>
						<div><strong><?php echo $v1['name']; ?></strong></div>
						<div>
							<?php foreach ($quality as $k2 => $v2) { ?>
								<input name="data[<?php echo $k1; ?>]" type="radio" id="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>" value="<?php echo $v2['label']; ?>" <?php if ($v2['label'] === '+-') echo 'checked="checked"'; ?>> <label for="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>"><?php echo $v2['label']; ?></label> 
							<?php } ?>
						</div></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			</div>
			
		</div>
		<div class="col-md-4"><img src="images/pulse3.jpg" class="img-responsive" /></div>
		<div class="col-md-4">
			<div class="table-responsive">
  				<table class="table">
				<tr>
					<td>
						Superficial
					</td>
					<td>
						Deep
					</td>
				</tr>
				<?php foreach ($pulse['left'] as $k => $v) { ?>
				<tr>
					<?php foreach ($v as $k1 => $v1) { ?>
					<td>
						<div><strong><?php echo $v1['name']; ?></strong></div>
						<div>
							<?php foreach ($quality as $k2 => $v2) { ?>
								<input name="data[<?php echo $k1; ?>]" type="radio" id="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>" value="<?php echo $v2['label']; ?>" <?php if ($v2['label'] === '+-') echo 'checked="checked"'; ?>> <label for="data_<?php echo $k1; ?>_<?php echo $v2['name']; ?>"><?php echo $v2['label']; ?></label> 
							<?php } ?>
						</div></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			</div>
		</div>
		</div>
		
		
		
		
		
		<div class="table-responsive">
			<table class="table">
				<tr>
					<td align="right">
						<strong>Name</strong>					</td>
					<td>
						<input name="name" type="text" id="name">					
					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Gender</strong>					</td>
					<td>
						<input name="gender" type="text" id="gender">					
					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Age</strong>					</td>
					<td>
						<input name="age" type="text" id="age">					
					</td>
				</tr>
				<tr>
					<td align="right">
						<strong>Date</strong>					</td>
					<td>
						<input name="case_date" type="text" id="case_date">					
					</td>
				</tr>
			</table>
		</div>
	  <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
	  <input type="submit" value="Submit">
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  
		<div>
		<a href="levels-of-health.php" class="btn btn-primary">Previous</a>
		<a href="certification.php" class="btn btn-primary">Next</a>
		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
