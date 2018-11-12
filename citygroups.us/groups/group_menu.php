<ul class="list-group">
	<li class="list-group-item"><a href="<?php echo HTTP_PATH; ?>events/?group_url=<?php echo $row_rsGroupInfo['url']; ?>&group_id=<?php echo $_GET['group_id']; ?>">Events</a></li>
</ul>
<div class="menuContainer">

  <div class="row">
      <div class="col-md-12">
          <div class="well">
              <div>
                  <ul class="nav">
				  	<?php if (!($_SESSION['MM_UserGroup'] === 'admin' || (isset($_SESSION['MM_UserId']) && $row_rsGroupInfo['group_manager_id'] === $_SESSION['MM_UserId']))) {
					?>
                      <li>
                          <label label-default="" class="tree-toggle nav-header">Admin</label>
                          <ul class="nav tree">
                              <li><a href="#">JavaScript</a>
                              </li>
                              <li><a href="#">CSS</a>
                              </li>
                          </ul>
                      </li>
					  <?php } ?>
                      <li>
                        <label label-default="" class="tree-toggle nav-header">Events</label>
                        <ul class="nav tree">
                          <li><a href="#">Colors</a>
                          </li>
                          <li><a href="#">Sizes</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <label label-default="" class="tree-toggle nav-header">Responsive</label>
                        <ul class="nav tree">
                          <li><a href="#">Overview</a>
                          </li>
                          <li><a href="#">CSS</a>
                          </li>
                          <li>
                            <label label-default="" class="tree-toggle nav-header">Media Queries</label>
                            <ul class="nav tree">
                              <li><a href="#">Text</a>
                              </li>
                              <li><a href="#">Images</a>
                              </li>
                              <li>
                                <label label-default="" class="tree-toggle nav-header">Mobile</label>
                                <ul class="nav tree">
                                  <li><a href="#">iPhone</a>
                                  </li>
                                  <li><a href="#">Samsung</a>
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
</div>