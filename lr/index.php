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
<title>Life Reminder</title>
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

<style type="text/css">
	@media only screen and (max-width: 768px) {
		.jumbotron {
			background-image: none;
		}
		
		.jumbotron h1 {
			font-size: 24px;
		}
		
		.jumbotron p {
			font-size: 12px;
		}
		
		.btn-group-lg>.btn, .btn-lg {
			padding: 5px 8px; 
			font-size: 12px;
		}
	}
</style>
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
<section class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-xs-12">
				<h1>Life Reminder</h1>
				<p class="lead">Life Reminder is to remind your ideas after your death.
					<a class="btn btn-primary btn-lg" href="#">Find out more</a>
				</p>
			</div>
			<div class="col-md-5 col-xs-12">
				<img src="images/logos.png" />
			</div>
		</div>
	</div>
</section> 

<section class="section-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-3 text-center">
				<span class="fa-stack fa-lg fa-4x">
				  <i class="fa fa-circle fa-stack-2x fa-color"></i>
				  <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
				</span>
				<h3>Valid Code</h3>
			</div>
			<div class="col-md-3 text-center">
				<span class="fa-stack fa-lg fa-4x">
				  <i class="fa fa-circle fa-stack-2x fa-color"></i>
				  <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
				</span>
				<h3>Responsive</h3>
			</div>
			<div class="col-md-3 text-center">
				<span class="fa-stack fa-lg fa-4x">
				  <i class="fa fa-circle fa-stack-2x fa-color"></i>
				  <i class="fa fa-video-camera fa-stack-1x fa-inverse"></i>
				</span>
				<h3>Animation Ready</h3>
			</div>
			<div class="col-md-3 text-center">
				<span class="fa-stack fa-lg fa-4x">
				  <i class="fa fa-circle fa-stack-2x fa-color"></i>
				  <i class="fa fa-gear fa-stack-1x fa-inverse"></i>
				</span>
				<h3>Customizable</h3>
			</div>
		</div>
	</div>
</section>

<section class="section-secondary slogan">
	<h1>Take a Closer Look</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor sapien sit amet ante sodales interdum. Curabitur in est risus</p>
	<a href="#" class="btn btn-lg btn-default">More Info</a>
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 class="page-header">Business Theme Includes....</h2>
				<ul class="feature-list">
					<li><i class="glyphicon glyphicon-ok"></i> Bootstrap 3 Framework</li>
					<li><i class="glyphicon glyphicon-ok"></i> Mobile Responsive Design</li>
					<li><i class="glyphicon glyphicon-ok"></i> Minimal Custom CSS Styles</li>
					<li><i class="glyphicon glyphicon-ok"></i> Unstyled: Add Your Own Style and Content!</li>
					<li><i class="glyphicon glyphicon-ok"></i> 100% <strong>Free</strong> to Use</li>
					<li><i class="glyphicon glyphicon-ok"></i> Open Source: Use for any project, private or commercial!</li>
				</ul>
			</div>
			<div class="col-md-6">
				<img src="images/macbook.png" class="img-responsive" />
			</div>
		</div>
	</div>
</section>

<section class="section-primary">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="images/sample1.jpg" class="img-responsive img-circle" />
			</div>
			<div class="col-md-6">
				<h2 class="page-header">More Features Include...</h2>
				<ul class="feature-list">
				  <li><i class="glyphicon glyphicon-ok"></i> Bootstrap 3 Framework</li>
				  <li><i class="glyphicon glyphicon-ok"></i> Mobile Responsive Design</li>
				  <li><i class="glyphicon glyphicon-ok"></i> Minimal Custom CSS Styles</li>
				  <li><i class="glyphicon glyphicon-ok"></i> Unstyled: Add Your Own Style and Content!</li>
				  <li><i class="glyphicon glyphicon-ok"></i> 100% <strong>Free</strong> to Use</li>
				  <li><i class="glyphicon glyphicon-ok"></i> Open Source: Use for any project, private or commercial!</li>
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
