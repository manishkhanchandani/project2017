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
				<a class="navbar-brand" href="">Library1</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

				</ul>
				<ul class="nav navbar-nav">
					<li class="active"><a href="">Home</a></li>
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
											<li><a href="<?php echo HTTP_PATH; ?>defs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Definitions</a></li>
											<li><a href="<?php echo HTTP_PATH; ?>casebriefs/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Case-Briefs</a></li>
											<li class="divider"></li>
											<li><a href="<?php echo HTTP_PATH; ?>midterma/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Mid-Term A</a></li>
											<li><a href="<?php echo HTTP_PATH; ?>midtermb/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Mid-Term B</a></li>
											<li class="divider"></li>
											<li><a href="<?php echo HTTP_PATH; ?>issues/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Issues</a></li>
											<li><a href="<?php echo HTTP_PATH; ?>essays/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">Bar Essays</a></li>
											<li><a href="<?php echo HTTP_PATH; ?>mbe/<?php echo $v1['url']; ?>/<?php echo $v1['id']; ?>">MBE</a></li>
										</ul>
									</li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
					
					<li>
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
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>