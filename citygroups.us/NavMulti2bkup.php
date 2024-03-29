<?php

?>
<script>

	function LogoutUser(redirect=false) {
		console.log('in logout');
		firebase.auth().signOut().then(function() {
		  // Sign-out successful.
		  console.log('successful logged out from fb');
		  $.get( "<?php echo HTTP_PATH; ?>users/logout_user.php")
				  .done(function( data ) {
					console.log( "hey you are logged out finally" );
					if (redirect) {
						window.location.href = "<?php echo HTTP_PATH; ?>users/login.php";
					}
				  }).fail(function(err, err2, err3) {
				  	console.log( "fail fail fail" );
				  });
		}).catch(function(error) {
		  // An error happened.
		  console.log('unsuccessful logged: ', error);
		});
	}
</script>
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
				<a class="navbar-brand" href="<?php echo HTTP_PATH; ?>">City Groups</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo HTTP_PATH; ?>">Home</a></li>
					
					<?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mygroups.php'); ?>
				</ul>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php if (!empty($_SESSION['MM_DisplayName'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?><span class="caret"></span></a>
					  
					  <ul class="dropdown-menu">
						<?php if (!empty($_SESSION['MM_DisplayName'])) { ?>
							<!--<li><a href="" onClick="signOut(); return false;">Signout</a></li> -->
							<li><a href="#" onclick="LogoutUser(1);">Signout</a></li>
						<?php } else { ?>
							<!--<li><a href="" onClick="googleLogin(); return false;">Google</a></li>
							<li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
							<li><a href="" onClick="gitHubLogin(); return false;">Github</a></li> -->
							<li><a href="<?php echo HTTP_PATH; ?>users/login.php">Login / Register</a></li>
						<?php } ?>
					  </ul>
					</li>
				  </ul>
				  
				  
				  
			</div>
		</div>
	</div>
</div>