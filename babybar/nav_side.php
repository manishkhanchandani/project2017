<ul class="nav nav-sidebar">
  <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
  <li><a href="#">Reports</a></li>
  <li><a href="#">Analytics</a></li>
  <li><a href="#">Export</a></li>
</ul>
<ul class="nav nav-sidebar">
  <li><a href="">Nav item</a></li>
  <li><a href="">Nav item again</a></li>
  <li><a href="">One more nav</a></li>
  <li><a href="">Another nav item</a></li>
  <li><a href="">More navigation</a></li>
</ul>
<ul class="nav nav-sidebar">
  <li><a href="">Nav item again</a></li>
  <li><a href="">One more nav</a></li>
  <li><a href="">Another nav item</a></li>
</ul>
<h4><?php if (!empty($_SESSION['MM_UserId'])) { echo $_SESSION['MM_DisplayName']; } else { ?>Users <?php } ?></h4>
<ul class="nav nav-sidebar">
  <?php if (!empty($_SESSION['MM_UserId'])) { ?>
      <li><a href="" onClick="signOut(); return false;">Signout</a></li>
  <?php } else { ?>
      <li><a href="" onClick="googleLogin(); return false;">Google Login</a></li>
      <li><a href="" onClick="facebookLogin(); return false;">Facebook Login</a></li>
      <li><a href="" onClick="twitterLogin(); return false;">Twitter Login</a></li>
      <li><a href="" onClick="gitHubLogin(); return false;">Github Login</a></li>
  <?php } ?>
</ul>