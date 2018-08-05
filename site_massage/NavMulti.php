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
				<a class="navbar-brand" href="<?php echo HTTP_PATH; ?>">INeedMassage.us</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo HTTP_PATH; ?>">Home</a></li>
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Menu <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="">Action</a></li>
							<li><a href="">Another action</a></li>
							<li><a href="">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="">One more separated link</a></li>
							<li class="dropdown-submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
								<ul class="dropdown-menu">
									<li><a href="">Action</a></li>
									<li><a href="">Another action</a></li>
									<li><a href="">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="">Separated link</a></li>
									<li class="divider"></li>
									<li class="dropdown-submenu">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu">
												<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
												<ul class="dropdown-menu">
													<li><a href="">Action</a></li>
													<li><a href="">Another action</a></li>
													<li><a href="">Something else here</a></li>
													<li class="divider"></li>
													<li><a href="">Separated link</a></li>
													<li class="divider"></li>
													<li><a href="">One more separated link</a></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!--
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Provider <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo HTTP_PATH; ?>provider/create.php">Create New Profile</a></li>
							<li><a href="">My Profiles</a></li>
							<li><a href="">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="">One more separated link</a></li>
							<li class="dropdown-submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
								<ul class="dropdown-menu">
									<li><a href="">Action</a></li>
									<li><a href="">Another action</a></li>
									<li><a href="">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="">Separated link</a></li>
									<li class="divider"></li>
									<li class="dropdown-submenu">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu">
												<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
												<ul class="dropdown-menu">
													<li><a href="">Action</a></li>
													<li><a href="">Another action</a></li>
													<li><a href="">Something else here</a></li>
													<li class="divider"></li>
													<li><a href="">Separated link</a></li>
													<li class="divider"></li>
													<li><a href="">One more separated link</a></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li><li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="">Action</a></li>
							<li><a href="">Another action</a></li>
							<li><a href="">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="">One more separated link</a></li>
							<li class="dropdown-submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
								<ul class="dropdown-menu">
									<li><a href="">Action</a></li>
									<li><a href="">Another action</a></li>
									<li><a href="">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="">Separated link</a></li>
									<li class="divider"></li>
									<li class="dropdown-submenu">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu">
												<a href="" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
												<ul class="dropdown-menu">
													<li><a href="">Action</a></li>
													<li><a href="">Another action</a></li>
													<li><a href="">Something else here</a></li>
													<li class="divider"></li>
													<li><a href="">Separated link</a></li>
													<li class="divider"></li>
													<li><a href="">One more separated link</a></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li> -->
				</ul>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php if (!empty($_SESSION['MM_UserId'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?><span class="caret"></span></a>
					  
					  <ul class="dropdown-menu">
						<?php if (!empty($_SESSION['MM_UserId'])) { ?>
							<li><a href="" onClick="signOut(); return false;">Signout</a></li>
						<?php } else { ?>
							<li><a href="" onClick="googleLogin(); return false;">Google</a></li>
							<!--<li><a href="" onClick="facebookLogin(); return false;">Facebook</a></li>
							<li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
							<li><a href="" onClick="gitHubLogin(); return false;">Github</a></li> -->
						<?php } ?>
					  </ul>
					</li>
				  </ul>
				  <form class="navbar-form navbar-right" method="get" action="<?php echo HTTP_PATH; ?>">
					<input type="search" name="kw" class="form-control" placeholder="Search..." value="<?php echo !empty($_GET['kw']) ? $_GET['kw'] : ''; ?>">
				  </form>
			</div>
		</div>
	</div>
</div>