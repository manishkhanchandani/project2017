<?php if (empty($_SESSION['MM_DisplayName'])) {  ?>
<h4>Login First To Create Request </h4>
<ul class="nav nav-sidebar">
      <li><a href="" onClick="googleLogin(); return false;">Google Login</a></li>
      <li><a href="" onClick="twitterLogin(); return false;">Twitter Login</a></li>
      <li><a href="" onClick="gitHubLogin(); return false;">Github Login</a></li> 

</ul><?php } ?>