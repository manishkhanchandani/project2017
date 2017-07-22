<?php
if (!isset($_SESSION)) {
  session_start();
}

//if page will load, there is not post data, and so user will not go inside the following if condition
//but when user clicks submit button, then the post variable will be available and we can send email at that time.
if (!empty($_POST)) {
	$message = "Dear Admin,
User with name '{$_POST['name']}'	
and email '{$_POST['email']}'
has sent following message:

{$_POST['message']}


Thanks
System Generated.
";
	mail('manishkk74@gmail.com', 'New Contact Message at LifeReminder.tk', $message, 'From:admin<admin@lifereminder.tk>');
	
	$status = 'Message Submitted';
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Contact Us</title>
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
		<h1>Contact <small>Get In Touch</small></h1>
	</div>
</section>
<section>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Contact</li>
		</ol>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php if (!empty($status)) { ?>
				<div class="alert alert-success" role="alert"><?php echo $status; ?></div>
				<?php } ?>
				<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
				
				<h3>Contact Us Today!</h3>
				<form method="post">
                  <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Email address</label>
                    <input name="email" type="email" class="form-control">
                  </div>
                    <div class="form-group">
                    <label>Message</label>
                   <textarea name="message" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
              </form>
			</div>
			<div class="col-md-4">
				<h3>Contact Details</h3>
				<p>89 West Main st<br>Merrimac, MA 01860<br></p>
				<p><i class="fa fa-phone"></i> (555) 555-5555</p>
				<p><i class="fa fa-envelope-o"></i> <a href="mailto:admin@lifereminder.tk">Email Us</a></p>
				<p><i class="fa fa-clock-o"></i> Monday - Friday: 9.00 am to 5.00 pm</p>
				<ul class="list-unstyled list-inline list-social-icons">
					<li><a href="#"><i class="fa fa-facebook-square fa-2x"></i></a></li>
					<li><a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter-square fa-2x"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
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