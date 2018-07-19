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
          <a class="navbar-brand" href="index.php">Baby Bar & Bar Examination</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Issues <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Deprecated</li>
                <li><a href="">Issue Spotting</a></li>
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
    