<!doctype html>
<html><!-- InstanceBegin template="/Templates/qz.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login</title>
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
		<div class="row">
			<div class="col-md-12">
				<h3>Register</h3>
				<form method="POST" name="formLogin" id="formLogin">
				  <div class="form-group">
					<label for="email">Email address</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email">
				  </div>
				  <div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-default">Login</button>
			  </form>
			</div>
		</div> 
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
