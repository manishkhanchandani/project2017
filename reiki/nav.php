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
          
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Practitioner<span class="caret"></span></a>
              
              <ul class="dropdown-menu">
            	<li><a href="<?php echo COMPLETE_HTTP_PATH; ?>directory.php">Directory</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>real-cases.php">Real Cases?</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Level 1 <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/">Reiki Level 1</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/what-is-reiki.php">What is Reiki?</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/how-reiki-works.php">How Reiki Works?</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/history-of-reiki.php">History of Reiki</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/seven-chakras.php">Seven Chakras & Endocrinology?</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/five-principles.php">Five Principles</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/attunement-process.php">Attunement Process</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/self-healing.php">Self Healing</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/reiki-treatment.php">How to Give Reiki Treatment</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/levels-of-health.php">Levels Of Health</a></li>
                <li><a href="<?php echo COMPLETE_HTTP_PATH; ?>reiki1/pulse_diagnosis.php">Pulse Diagnosis?</a></li>
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
                    <li><a href="" onClick="facebookLogin(); return false;">Facebook</a></li>
                    <li><a href="" onClick="twitterLogin(); return false;">Twitter</a></li>
                    <li><a href="" onClick="gitHubLogin(); return false;">Github</a></li>
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
    