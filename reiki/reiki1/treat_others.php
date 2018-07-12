<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "reiki1,admin,reiki12,reiki123";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/access-denied.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?><!doctype html>
<html><!-- InstanceBegin template="/Templates/reiki.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta property="fb:app_id" content="168072164626"/>
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Rei-ki : Treat Others With Reiki</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/firebase_4_1_5.js"></script>

<link href="../library/wysiwyg/summernote.css" rel="stylesheet">
<script src="../library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../nav.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <?php include('../nav_side.php'); ?>
    </div>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <h1 class="page-header">Reiki Treatment for others </h1>
<audio controls>
  <source src="audio/treat_others.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Appropriate Environment</p>
      <p>Important to create the right setting whenever possible for a Reiki healing session.</p>
      <p>Work from home or hire a room in healing center.</p>
      <p>The room should be light and clean, and feel safe.</p>
      <hr>
      <p>Make sure you will not be interrupted by internal or external distractions.</p>
      <p>If you are working from home let your family or friends know your schedules so they do not disturb you.</p>
      <hr>
      <p>If possible always use a therapy table.</p>
      <p>Alternatively, you could use a strong table with thick blankets on top.</p>
      <p>Make sure the room is heated to a comfortable level.</p>
      <p>Use two pillows, one on head and one on feet.</p>
      <p>Make sure, temperature is comfortable in the room.</p>
      <p>Work in complete silence or therapeutic music to relax yourself and client.</p>
      <hr>
      <p>Your clients may cry as they release blocked emotional issues, so always keep a box of tissues handy.</p>
      <hr>
      <p><strong>Remove all jewellery</strong></p>
      <p>Reiki can travel all materials such as stone, brick, concrete and metal.</p>
      <p>To enable you to work with Reiki free from all subtle energy disturbances it is advisable to remove all jewellery such as rings, watches, earrings, chains and necklaces.</p>
      <hr>
      <p><strong>Remove Tight Clothing</strong></p>
      <p>To allow reiki to flow freely through you and your client it is important that you both remove tight clothing such as belts, ties and shoes.</p>
      <p>This will also make you feel more comfortable and relaxed.   </p>
      <hr>
      <p>Avoid Alcohol</p>
      <p>Alcohol dissipates energy.</p>
      <p>Always refrain from consuming alcohol if you can at least twenty - four hours before a session.</p>
      <hr>
      <p><strong>Personal Hygiene</strong></p>
      <p>Ensure you smell &amp; appear clean &amp; fresh.</p>
      <p>Avoid wearing strong perfumes or after shaves.</p>
      <p>If you smoke, make sure you brush your teeth or use a mouth freshner.</p>
      <p>Refrain from eating food that may leave a smell on your breath.</p>
      <p>Wash your hands before a Reiki session.</p>
      <hr>
      <p><strong>Treating others with Reiki</strong></p>
      <p>Before you begin a full body treatment there are a few important points to remember.      </p>
      <p>Never give a Reiki treatment to a person who has a pacemaker.</p>
      <p>Never give a Reiki treatment to a person who suffers from Diabetes Mellitus and are taking insulin injections, unless they are prepared to check their insulin levels every day as Reiki reduces the amount of insulin they require. </p>
      <hr>
      <p>Explain to a person who is having their first Reiki treatment exactly what you are going to do and the type of reactions that might occur.</p>
      <p>Stress that any one of these reactions are normal.</p>
      <p>Reiki will go whereever it is needed.         </p>
      <hr>
      <p>The <strong>type of reactions</strong> that may occur are:</p>
      <ul>
          <li>A sensation of heat</li>
          <li>A sensation of cold</li>
          <li>See colors</li>
          <li>Past life flashes</li>
          <li>Involuntary movements</li>
          <li>Fall asleep</li>
          <li>Itchiness</li>
          <li>Emotional responses</li>
          <li>Rumbling stomach</li>
          <li>Memory flashes</li>
          <li>Pins and needles</li>
          <li>Sense your hands moving            </li>
          </ul>
      <hr>
      <p>Often the client will experience cold at the position of your hands while you feel intense heat.</p>
      <p>If the client experiences nothing explain to them that the Reiki energy often works on a subtle level.</p>
      <p>Never forget the client is drawing Reiki through you.</p>
      <p>You are only the channel.</p>
      <p>Reiki always travels to the place it is needed most.   </p>
      <hr>
      <p>No knowledge of the human anatomy or physiology is required to work with Reiki.</p>
      <p>Leave your ego aside and Reiki will do the work.</p>
      <p>Forget the symptoms treat the whole person.     </p>
      <hr>
      <p>At the end of a treatment always offer your client a glass of cold water to aid grounding.</p>
      <p>Always wash your hands under cold running water after each treatment.    </p>
      <hr>
      <p><strong>Beginning the Treatment</strong></p>
      <p>Ensure your client is lying flat on the therapy table with their arms down by their sides.  </p>
      <p>Gently lay down your hands on your clients body. Keep them in each position for between three to five minutes. </p>
      <p>Your hands should be cupped with your fingers firmly closed as though you were trying to hold the water.</p>
      <p>In the case of burnt skin or a client genitals and breasts hold your hands just above their body.</p>
      <p>Don't forget the box of tissues.   </p>
      <hr>
      <p>Do treatment on all chakras and the parts affected.</p>
      <p> When all positions have been treated place your left hand on your clients crown chakra and your right hand at the base of their spine, (from back side) </p>
      <p>This final position  balances the energy in your client's body. </p>
      <p>Complete your treatment by combing your clients aura 3 times.</p>
      <p>1. First Strokes on body</p>
      <p>2. Light strokes on body</p>
      <p>3. In aura above the body</p>
      <p>Each time touching floor, to ground client.     </p>
      <p>Treatment takes about 30 mins to 90 minutes depending on the parts affected. </p>
      <hr>
      <p><strong>RAPID REIKI TREATMENT</strong></p>
      <p>It is not always possible to spend 60 to 90 minutes conducting a Reiki treatment.</p>
      <p>Often the person requiring Reiki has a limited amount of time or you need to work quickly in an emergency.</p>
      <p>There is quick alternative for these situations.</p>
      <p>A rapid reiki treatment focuses on chakras points while clients sits in a chair &amp; takes about 15 to 30 minutes.  </p>
      <hr>
      <p>Stand behind the client with your hands on their shoulders. Remain behind the Client. Client is seated on a chair. </p>
      <p><strong>Position 1:</strong> Place both of your hands on their crown chakra.</p>
      <p><strong>Position 2: </strong>Move to the side of the client and place one hand on 3rd eye chakra and one hand on the occipital ridge (back of head).</p>
      <p><strong>Position 3:</strong> Remain at the side of the client. Place one hand on the throat chakra and one hand on the back of the client's neck.</p>
      <p><strong>Position 4:</strong> Remain at the side of the client. Place one hand on the heart chakra and one hand on the  client's shoulder blades.</p>
      <p><strong>Position 5:</strong> Remain at the side of the client. Place one hand on the solar plexus chakra and one hand at the back on their spine.</p>
      <p><strong>Position 6:</strong>  Remain at the side of the client. Place one hand on the sacral chakra and one hand at the back on their spine.</p>
      <p><strong>Position 7: </strong>Remain at the side of the client. Place one hand on the root chakra and one hand at the back on their base of their spine. (you can keep your hands at distance of 1 or 2 inches from the body of the client).</p>
      <p>Finally comb your clients aura 3 times as you normally would do.</p>
      <p>Wash your hands in cold running water and offer a cold drink of water to your client to assist grounding. </p>
      <hr>
      <p><strong>Treat Everything</strong></p>
      <p>Give reiki to plants</p>
      <p>Give reiki to food you eat. Place food in your hand and give few minutes of Reiki.</p>
      <p>For larger area, give distance reiki (second degree)</p>
      <p>Before eating, give reiki to food and stomach for few minutes.</p>
      <p>Give reiki to everything you come across like light, computer, bus, car, anything, etc.    </p>
      
		<div>
		<a href="reiki-treatment.php" class="btn btn-primary">Previous</a>
		<a href="group_healing.php" class="btn btn-primary">Next</a>
		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
