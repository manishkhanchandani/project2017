<?php require_once('../Connections/conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO qz_issues_exam (essay, subject, user_id, question_date) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['essay'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['question_date'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE qz_issues_exam SET essay=%s, subject=%s, question_date=%s WHERE essay_id=%s",
                       GetSQLValueString($_POST['essay'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['question_date'], "text"),
                       GetSQLValueString($_POST['essay_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

$colname_rsView = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsView = $_SESSION['MM_UserId'];
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM qz_issues_exam WHERE user_id = %s ORDER BY essay_id DESC", GetSQLValueString($colname_rsView, "int"));
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsEdit = "-1";
if (isset($_GET['essay_id'])) {
  $colname_rsEdit = $_GET['essay_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM qz_issues_exam WHERE essay_id = %s", GetSQLValueString($colname_rsEdit, "int"));
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Issues Spotting Data Feed</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- InstanceBeginEditable name="head" -->
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
<div>
<h1>Issue Spotting Data Feed</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<table>
<tr valign="baseline">
<td nowrap align="right" valign="top"><strong>Essay:</strong></td>
<td><textarea name="essay" cols="50" rows="5"></textarea></td>
</tr>
<tr valign="baseline">
<td nowrap align="right"><strong>Subjects:</strong></td>
<td><select name="subject">
<option value="contracts" <?php if (!(strcmp("contracts", $_POST['subject']))) {echo "selected=\"selected\"";} ?>>Contracts</option>
<option value="criminal" <?php if (!(strcmp("criminal", $_POST['subject']))) {echo "selected=\"selected\"";} ?>>Criminal</option>
<option value="torts" <?php if (!(strcmp("torts", $_POST['subject']))) {echo "selected=\"selected\"";} ?>>Torts</option>
</select></td>
</tr>
<tr valign="baseline">
<td nowrap align="right"><strong>Question Date Reference:</strong></td>
<td><input type="text" name="question_date" value="" size="32"></td>
</tr>
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td><input type="submit" value="Insert record"></td>
</tr>
</table>
<input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
<input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<p>View Data</p>
<p>&nbsp;</p>
<p>Edit Data</p>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
<table>
<tr valign="baseline">
<td nowrap align="right">Essay:</td>
<td><input type="text" name="essay" value="<?php echo htmlentities($row_rsEdit['essay'], ENT_COMPAT, ''); ?>" size="32"></td>
</tr>
<tr valign="baseline">
<td nowrap align="right">Subjects:</td>
<td><select name="subjects">
<option value="contracts" <?php if (!(strcmp("contracts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Contracts</option>
<option value="criminal" <?php if (!(strcmp("criminal", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Criminal</option>
<option value="torts" <?php if (!(strcmp("torts", $row_rsEdit['subject']))) {echo "selected=\"selected\"";} ?>>Torts</option>
</select></td>
</tr>
<tr valign="baseline">
<td nowrap align="right">Question Date Reference:</td>
<td><input type="text" name="question_date" value="<?php echo htmlentities($row_rsEdit['question_date'], ENT_COMPAT, ''); ?>" size="32"></td>
</tr>
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td><input type="submit" value="Update record"></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="form2">
<input type="hidden" name="essay_id" value="<?php echo $row_rsEdit['essay_id']; ?>">
</form>
</div> 
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsEdit);
?>
