<!-- Static navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo COMPLETE_HTTP_PATH; ?>">Rei-ki.us</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">General<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/personal.php">Add Personal Info</a></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/personal_view.php">View Personal Info</a></li>
                <li role="separator" class="divider"></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/quiz.php">Quiz</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Practitioner<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/practitioner.php">Add New Practitioner</a></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/directory.php">Directory</a></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/directory.php?my=1">My Practitioner's Records</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>general/real-cases.php">Real Solved Cases</a></li>
              </ul>
            </li>
			<?php if (!empty($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup'] === 'admin') { ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>admin/index.php">Admin</a></li>
                <li role="separator" class="divider"></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>admin/users.php">Users</a></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>admin/personal_info.php">Personal Info</a></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>admin/quiz.php">Quiz Results</a></li>
                <li role="separator" class="divider"></li>
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>admin/lecture.php">Lecture level 1</a></li>
              </ul>
            </li>
			<?php } ?>
			<?php if (isset($_SESSION['MM_UserGroup']) && (strpos($_SESSION['MM_UserGroup'], 'admin') !== false || strpos($_SESSION['MM_UserGroup'], '1') !== false)) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Level 1 <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/">Reiki Level 1</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/what-is-reiki.php">What is Reiki?</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/how-reiki-works.php">How Reiki Works?</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/history-of-reiki.php">History of Reiki</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/seven-chakras.php">Seven Chakras & Endocrinology</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/seven-chakras-short.php">Seven Chakras Short</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/five-principles.php">Five Principles</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/attunement-process.php">Attunement Process</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/self-healing.php">Self Healing</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/reiki-treatment.php">How to Give Reiki Treatment</a>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/treat_others.php">Treat Others</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/group_healing.php">Group Healing</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/levels-of-health.php">Levels Of Health</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/pulse_diagnosis.php">Pulse Diagnosis</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/pulse_diagnosis_view.php">Pulse Diagnosis View</a></li>
              </ul>
            </li>
			<?php } ?>
			<?php if (isset($_SESSION['MM_UserGroup']) && (strpos($_SESSION['MM_UserGroup'], 'admin') !== false || strpos($_SESSION['MM_UserGroup'], '2') !== false)) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Level 2 <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/">Reiki Level 1</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/intro.php">Introduction to the 2nd degree</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/gassho.php">Gassho</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/reiji.php">Reiji-Ho</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/chiryo.php">Chiryo</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/namaste.php">Namaste</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/new_possibilities.php">New Possibilities</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/symbols.php">Reiki Symbols</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/chokurei.php">Cho ku Rei</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/seiheiki.php">Sei Heiki</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/honshazeshonen.php">Hon Sha Ze Sho Nen</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/distant.php">Distant or Absent Reiki Healing</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/traditional_distant.php">Traditional Distant Healing</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/examples.php">Examples Distant Healing</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/working.php">Working with Reiki 2</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/additional_symbols.php">Additional Non Traditional Reiki Symbols</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/other_healing.php">Reiki with other healing technique</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki2/animal.php">Animal Reiki Technique</a></li>
              </ul>
            </li>
			<?php } ?>
			<?php if (isset($_SESSION['MM_UserGroup']) && (strpos($_SESSION['MM_UserGroup'], 'admin') !== false || strpos($_SESSION['MM_UserGroup'], '3') !== false)) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>">Master Level</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki3/attunement.php">Attunement Process</a></li>
              </ul>
            </li>
			<?php } ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Visual<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="#" id="bigfonts">Big Fonts</a></li>
                <li><a href="#" id="normalfonts">Normal Fonts</a></li>
              </ul>
            </li>
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
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<script>
$( document ).ready(function() {
    $( "#bigfonts" ).click(function() {
	  $('#content').removeClass('visual').addClass('visualBig');
	});
    $( "#normalfonts" ).click(function() {
	  $('#content').removeClass('visualBig').addClass('visual');
	});
});
</script>