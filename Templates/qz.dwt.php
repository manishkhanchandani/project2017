<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../qz/css/bootstrap.min.css">
<script src="../qz/js/jquery.min.js"></script>
<script src="../qz/js/bootstrap.min.js"></script>

<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
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
          <a class="navbar-brand" href="../qz/index.php">Quiz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="active"><a href="../qz/index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Issues <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="../qz/issue_details_view.php">Issue Details</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Deprecated</li>
                <li><a href="../qz/issues.php">Issue Spotting</a></li>
              </ul>
            </li>
		  	<?php if (!empty($_SESSION['MM_UserId'])) { ?>
            <li><a href="../qz/logout.php">Logout</a></li>
			<?php } else { ?>
            <li><a href="../qz/login.php">Login</a></li>
            <li><a href="../qz/register.php">Register</a></li>
			<?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
<!-- TemplateBeginEditable name="EditRegion3" -->
<div>my basic content</div> 
<!-- TemplateEndEditable -->
</div>
</body>
</html>
