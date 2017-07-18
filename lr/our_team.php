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
<title>Untitled Document</title>
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
            <li><a href="faq.php">FAQ</a></li>
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
		<h1>Our Team <small>Meet Our Developers</small></h1>
	</div>
</section>
<section>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li>Our Team</li>
		</ol>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="img-responsive img-thumbnail img-circle" src="images/man1.jpg" />
				<h3 class="text-center">Manish Khanchandani <small>Sr. Web Developer</small></h3>
				<p>15 years of experience in Web Development. Working on Angular JS, React JS, PHP, Mysql, Javascript, Bootstrap CSS, etc.</p>
				<ul class="list-unstyled list-inline list-social-icons">
				  <li class="tooltip-social facebook-link"><a href="http://facebook.com" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
				  <li class="tooltip-social linkedin-link"><a href="http://linkedin.com" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
				  <li class="tooltip-social twitter-link"><a href="http://twitter.com" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
				  <li class="tooltip-social google-plus-link"><a href="http://google.com" data-toggle="tooltip" data-placement="top" title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<img class="img-responsive img-thumbnail img-circle" src="images/woman1.jpg" />
				<h3 class="text-center">Carrie Parecki <small>Webmaster</small></h3>
				<p>15 years of experience in Web Development. Working on Angular JS, React JS, PHP, Mysql, Javascript, Bootstrap CSS, etc.</p>
				<ul class="list-unstyled list-inline list-social-icons">
				  <li class="tooltip-social facebook-link"><a href="http://facebook.com" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
				  <li class="tooltip-social linkedin-link"><a href="http://linkedin.com" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
				  <li class="tooltip-social twitter-link"><a href="http://twitter.com" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
				  <li class="tooltip-social google-plus-link"><a href="http://google.com" data-toggle="tooltip" data-placement="top" title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<img class="img-responsive img-thumbnail img-circle" src="images/man2.jpg" />
				<h3 class="text-center">Kate <small>Sr. Web Developer</small></h3>
				<p>15 years of experience in Web Development. Working on Angular JS, React JS, PHP, Mysql, Javascript, Bootstrap CSS, etc.</p>
				<ul class="list-unstyled list-inline list-social-icons">
				  <li class="tooltip-social facebook-link"><a href="http://facebook.com" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
				  <li class="tooltip-social linkedin-link"><a href="http://linkedin.com" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
				  <li class="tooltip-social twitter-link"><a href="http://twitter.com" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
				  <li class="tooltip-social google-plus-link"><a href="http://google.com" data-toggle="tooltip" data-placement="top" title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
				</ul>
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