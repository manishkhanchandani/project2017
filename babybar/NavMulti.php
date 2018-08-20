<?php
$leftSideBar = array();
if (!empty($barSubjects)) {
	foreach ($barSubjects as $k => $v) {
		$leftSideBar[$v['year']][] = array('subject_id' => $k, 'subject' => $v['subject'], 'url' => $v['url'], 'subject_year' => $v['year'], 'id' => $v['id']);
	}
}

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
				<a class="navbar-brand" href="<?php echo HTTP_PATH; ?>">California Bar</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo HTTP_PATH; ?>">Home</a></li>
					<?php if (!empty($leftSideBar)) { ?>
					<li>
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Subjects<b class="caret"></b></a>
						<ul class="dropdown-menu multi-level">							
							<?php foreach ($leftSideBar as $k => $v) { ?>
							<li class="dropdown-submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $k; ?></a>
								<ul class="dropdown-menu">
									<?php foreach ($v as $k1 => $v1) { ?>
									<li class="dropdown-submenu">
										<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $v1['subject']; ?></a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>defs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Definitions</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>defs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>defs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>defs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Definitions</a></li>
												</ul>
											</li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>casebriefs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Case-Briefs</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>casebriefs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>casebriefs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>casebriefs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Case-Briefs</a></li>
												</ul>
											</li>
											<li class="divider"></li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>midterma/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Mid-Term A</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>midterma/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>midterma/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>midterma/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Mid-Term A</a></li>
												</ul>
											</li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>midtermb/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Mid-Term B</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>midtermb/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>midtermb/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>midtermb/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Mid-Term B</a></li>
												</ul>
											</li>
											<li class="divider"></li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>issues/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Issues</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>issues/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>issues/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>issues/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Issues</a></li>
												</ul>
											</li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>essays/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Essays</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>essays/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>essays/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>essays/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Essays</a></li>
												</ul>											
											</li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>mbe/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">MBE</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>mbe/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>mbe/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>mbe/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My MBE</a></li>
												</ul>
											</li>
											<?php if ($v1['id'] <= 4) { ?>
											<li class="divider"></li>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>quizes/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Quizes</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>quizes/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>quizes/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>quizes/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My Definitions</a></li>
												</ul>
											</li>
											<?php } ?>
											<li class="dropdown-submenu"><a href="<?php echo HTTP_PATH; ?>practice/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Practice</a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo HTTP_PATH; ?>practice/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">View All</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>practice/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>/create">Create New</a></li>
													<li><a href="<?php echo HTTP_PATH; ?>practice/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>?my=1">My MBE</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
					
					<!--<li>
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
							<!--<li><a href="" onClick="facebookLogin(); return false;">Facebook</a></li> -->
							<li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
							<li><a href="" onClick="gitHubLogin(); return false;">Github</a></li>
							<li><a href="<?php echo HTTP_PATH; ?>users/login.php">Login / Register</a></li>
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