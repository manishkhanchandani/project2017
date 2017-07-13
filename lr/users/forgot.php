<?php require_once('../../Connections/conn.php'); ?>
<?php
$colname_rsEdit = "-1";
if (isset($_GET['email'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['email'] : addslashes($_GET['email']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM lr_users WHERE email = '%s'", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

$status = '';
if ($totalRows_rsEdit > 0) {
	//send email
	
	$message = "Dear {$row_rsEdit['first_name']}
Your password is {$row_rsEdit['password']}.

Thanks	
";
	
	//@mail($row_rsEdit['email'], 'Forgot Password', $message, 'From:admin<admin@lifereminder.com>');
	
	$status = 'Password sent to your email successfully';
}


?><!doctype html>
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
		<div>
		  <h1>Forgot Password </h1>
		  <p><?php echo $status; ?></p>
		  <form method="get" name="form1">
            <table>
              <tr valign="baseline">
                <td nowrap align="right">Email:</td>
                <td><input type="text" name="email" id="email" size="32"></td>
              </tr>

              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input name="submit" type="submit" value="Send My Password"></td>
              </tr>
            </table>
	      </form>
		  <p></p>
		</div> 
	<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEdit);
?>
