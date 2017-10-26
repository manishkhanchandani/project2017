<?php
$leftSideBar = array();
$fetchSubjects = curlget(COMPLETE_HTTP_PATH.'apis/baby_bar_subjects.php');
if (!empty($fetchSubjects['output'])) {
    $res = json_decode($fetchSubjects['output'], 1);
    if ($res['success'] === 1) {
        $leftSideBar = $res['data'];
    }
}

?>
<!--<ul class="nav nav-sidebar">
  <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
  <li><a href="#">Reports</a></li>
  <li><a href="#">Analytics</a></li>
  <li><a href="#">Export</a></li>
</ul>-->
<?php if (!empty($leftSideBar)) { ?>
<?php foreach ($leftSideBar as $k => $v) { ?>
    <h4>Year: <?php echo $k; ?></h4>
    <ul class="nav nav-sidebar">
            <?php foreach ($v as $k1 => $v2) { ?>
            <li><a href="<?php echo HTTP_PATH; ?>subjects/?id=<?php echo $v2['subject_id']; ?>"><?php echo $v2['subject']; ?></a></li>
            <?php } ?>
    </ul>
<?php } ?>
<?php } ?>
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