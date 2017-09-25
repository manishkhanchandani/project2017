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

$colname_rsTitle = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsTitle = $_GET['cat_id'];
}
mysql_select_db($database_conn, $conn);
$query_rsTitle = sprintf("SELECT Distinct topic, count(*) as cnt FROM qz_questions WHERE category_id = %s GROUP BY topic ORDER BY topic ASC", GetSQLValueString($colname_rsTitle, "int"));
$rsTitle = mysql_query($query_rsTitle, $conn) or die(mysql_error());
$row_rsTitle = mysql_fetch_assoc($rsTitle);
$totalRows_rsTitle = mysql_num_rows($rsTitle);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Quiz Settings</title>
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Issues <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="issue_details_view.php">Issue Details</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Deprecated</li>
                <li><a href="issues.php">Issue Spotting</a></li>
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
  <h1>Quiz Settings</h1>
  <form name="form1" method="get" action="view_quiz.php">
    <p><strong>No of Questions:</strong>
      <input name="maxRows_rsQuiz" type="text" id="maxRows_rsQuiz" size="50" value="10">
      </p>
    <p><strong>Topic:</strong>
<select name="topic" id="topic">
  <option value="%">All</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsTitle['topic']?>"><?php echo $row_rsTitle['topic']?> (<?php echo  $row_rsTitle['cnt']; ?>)</option>
        <?php
} while ($row_rsTitle = mysql_fetch_assoc($rsTitle));
  $rows = mysql_num_rows($rsTitle);
  if($rows > 0) {
      mysql_data_seek($rsTitle, 0);
	  $row_rsTitle = mysql_fetch_assoc($rsTitle);
  }
?>
    </select>
    </p>
    <p>
      <input type="submit" id="button" value="Start Test">
      <input name="cat_id" type="hidden" id="cat_id" value="<?php echo $_GET['cat_id']; ?>">
    </p>
  </form>
</div> 
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsTitle);
?>
