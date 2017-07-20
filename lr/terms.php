<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Terms</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/style.css">
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
          <a class="navbar-brand" href="http://lifereminder.tk">LifeReminder.tk</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="our_team.php">Our Team</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reminders <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="reminder/new_reminder.php">Create New Reminder</a></li>
                <li><a href="reminder/list_reminders.php">My Reminders</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
			  	<?php if (empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="users/register.php">Register New User</a></li>
                <li><a href="users/login.php">Login</a></li>
                <li><a href="users/forgot.php">Forgot Password</a></li>
				<?php } ?>
				<?php if (!empty($_SESSION['MM_UserId'])) { ?>
                <li><a href="users/change_password.php">Change Password</a></li>
                <li><a href="users/logout.php">Logout</a></li>
				<?php } ?>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- InstanceBeginEditable name="EditRegion3" -->
<section class="section-title">
	<div class="container">
		<h1>Terms <small>And Conditions</small></h1>
	</div>
</section>
<section>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Terms</li>
		</ol>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<img src="images/puzzle.jpg" class="img-responsive">
			</div>
			<div class="col-md-7">
				<h2>Welcome to our company</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas volutpat, sem quis ornare bibendum, metus odio commodo ante, sit amet finibus sapien nibh vel augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus nunc, tristique ac mi non, elementum venenatis elit. Nullam ornare laoreet justo, in dignissim ligula faucibus sit amet. </p>
				  <p>
		
				  Suspendisse tristique diam eu ex dapibus, non finibus quam pellentesque. Fusce eleifend magna vitae sem maximus, eu luctus eros finibus. Aliquam urna leo, finibus vel turpis eget, pretium hendrerit metus. Sed a leo elementum, tempor purus at, lacinia lorem. Praesent porttitor sed ipsum at consequat. Nunc</p>
		
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus nunc, tristique ac mi non, elementum venenatis elit. Nullam ornare laoreet justo, in dignissim ligula faucibus sit amet. </p>
				   
				   <a href="contact.php" class="btn btn-primary btn-lg">Contact Us</a>
			</div>
		</div>
	</div>
</section>
<!-- InstanceEndEditable -->
	
	<footer>
		<p>Life Reminder : Copyright &copy; 2017 - <a href="#">Terms</a> | <a href="#">Privacy</a></p>
	</footer>
</body>
<!-- InstanceEnd --></html>