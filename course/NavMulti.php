<?php
?>
<div class="nav-multi">
	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo HTTP_PATH; ?>">Courses</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<?php if (!empty($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup'] === 'admin') { ?>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo HTTP_PATH; ?>">Home</a></li>
					
					
					
					
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo HTTP_PATH; ?>admin/">Create New Course</a></li>
						</ul>
					</li>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				</ul>
				<?php } ?>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php if (!empty($_SESSION['MM_DisplayName'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?><span class="caret"></span></a>
					  
					  <ul class="dropdown-menu">
						<?php if (!empty($_SESSION['MM_UserId'])) { ?>
							<li><a href="" onClick="signOut(); return false;">Signout</a></li>
						<?php } else { ?>
							<li><a href="" onClick="googleLogin(); return false;">Google</a></li>
							<li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
							<li><a href="" onClick="gitHubLogin(); return false;">Github</a></li>
							<li><a href="<?php echo HTTP_PATH; ?>users/login.php">Email</a></li>
						<?php } ?>
					  </ul>
					</li>
				  </ul>
			</div>
		</div>
	</div>
</div>