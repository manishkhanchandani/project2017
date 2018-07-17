<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin";
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
<title>Reiki 3 : Attunement Process</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="../js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="../js/firebase/5.2.0/firebase-auth.js"></script>
<script src="../js/firebase/5.2.0/firebase-database.js"></script>

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
  <h1 class="page-header">Attunement Process</h1>

  <div id="contents" class="visual">
  <h3>My Attunement process for level 1</h3>
  <p><strong>Step 1:</strong></p>
<p>1. You will stand in front of your student approximately 2 - 3 feet away from them.</p>
<p>

2. Ask your student to close their eyes and raise their hands in the prayer position with hands in front of their heart chakra.</p>
<p>

3. You will silently set a short intention.</p>
<p>

Thanks God for being here<br>

Thanks Reiki for being here
<br>
Thanks Myself for being here
<br>
Thanks Student for being here</p>
<p>

4. When you feel ready and can sense the Reiki energy around you, open your eyes.</p>
<p>

Draw DKM and CKR on your palms.</p>
<p>
Draw CKR in front of your body, intending that your chakras open to receive Reiki.</p>
<p>
Draw DKM, CKR, SHK and HSZSN above the student intending for the energy to fill the room. These symbols will be called on as needed during the ceremony.</p>
<p>

Ask your student to take a deep relaxing breath as they perform a silent invocation opening themselves up to receiving the Reiki attunement.
Example: I (student's name) call upon Reiki, the universal life force. I am ready and open to receive the Reiki attunement.</p>
<p>
Give student a few moments to complete the silent invocation. When you sense they are ready you can continue.</p>
<p>

Ask your student to relax, follow your directions and enjoy the experience of the Reiki attunement ceremony.</p>
<p>

<strong>Step 2: Opening your stuent upto receive Reiki</strong></p>
<p>

Now walk around counter clockwise to the back of your student.</p>
<p>

Raise your hands in the prayer position in front of your heart chakra.</p>
<p>

Move closer to your student and place your NON dominant hand on your students shoulder.</p>
<p>

Place tongue behind your top front teeth at the roof of your mouth and contract the Hui Yin to boost the flow of Reiki in and around your body.
</p>
<p><strong>
Step 3: Opening student up to receive Reiki (crown chakra)</strong></p>
<p>

Standing behind the Reiki student.</p>
<p>

Now you will raise your dominant hand and hold it horizontally above your Reiki student's crown chakra.</p>
<p>

Draw a small ckr above the student's crown chakra to open the student's crown center.</p>
<p>

Now place your cupped hands over the student's crown chakra and beam/channel the three previously drawn Reiki symbols (DKM + HSZSN + CKR) into the students crown chakra filling their whole head with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>Place both hands on shoulder and beam/channel all three symbols dkm, hszsn, ckr, to heart and all over the body. </p>
<p>
<strong>Step 4: Opening student up to receive Reiki (Third eye chakra)</strong></p>
<p>

Standing at the right hand side of the Reiki student.</p>
<p>

Draw a small ckr over the student's third eye chakra to open the student's third eye center.</p>
<p>

Now with your right hand touching front of the student's third eye chakra and your left hand a few inches behind the student's head touching the head beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's third eye chakra filling their third eye center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>

<strong>Step 5: Opening student up to receive Reiki (Throat chakra)</strong></p>
<p>

Standing at the right hand side of the Reiki student.</p>
<p>

Draw a small ckr over the student's Throat chakra to open the student's throat center.</p>
<p>

Now with your right hand a few inches in front of the student's throat chakra and your left hand a few inches behind the student's neack beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's throat chakra filling their throat center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p><strong>

Step 6: Opening student up to receive Reiki (Heart chakra)</strong></p>
<p>

Move so you are standing in front of the Reiki student.</p>
<p>

Draw a small ckr over the student's Heart chakra to open the student's Heart center.</p>
<p>

Now with your cupped hands side by side thumbs together facing toward your student's heart chakra; beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's heart chakra filling their heart center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>

<strong>Step 7: Opening student up to receive Reiki (solar plexus, sacral, root chakras as well as body)</strong></p>
<p>

Standing in front of the Reiki Student.</p>
<p>

Leaving the student's hands in the prayer position, step back slightly, and draw a small ckr over the student's solar plexus, sacral and root chakras to open the student's remaining three energy centers.</p>
<p>

Now with your cupped hands side by side with thumbs together facing towards your student's solar plexus, sacral and root chakras, beam the three previously drawn Reiki symbols (dkm, hszsn, ckr) into the student's solar plexus, sacral and root chakras filling their three energy centers with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>

Next beam/channel the three previously drawn Reiki symbols (dmk, hszsn, ckr) into student's arms, chest, abdomen, thighs, legs and feet. Visualize Reiki energy filling every muscle, organ, tissue and cell of their body. Remember to silently intone the names of each of the symbols three times.</p>
<p>Hands in prayer position, left hand wrapping his folded hand, tip of my hand to tip of his hand, channel all three symbol. </p>
<p>Left thumb on top of the fingers, grab hand with left hand, right third and fourth finger on over thumb of the student, channel all three symbols. </p>
<p>
<strong>Step 8: Attuning the student to the symbols</strong></p>
<p>

Open the student's hands like a book and draw the symbols into the palms of their hands and then tapping three times.</p>
<p>
Level 1: Draw ckr in both palms and tap three times.</p>
<p>
Level 2: Draw ckr, shk, hszsn, in both palms and tap three times.</p>
<p>
Level 3: Draw ckr, shk, hszsn and dkm and tap three times.</p>
<p>

Fold the student's hands back into prayer position.</p>
<p>

<strong>Step 9: Violet Breath</strong></p>
<p>
Standing in front of the Reiki student</p>
<p>

NOw place your hands around the student's hands and move them so that their fingertips are in line with their heart chakra.</p>
<p>

Blow the Violet Breath from the root chakra to the crown chakra.</p>
<p>

<strong>Step 10: Closing the ceremony</strong></p>
<p>
Standing in front of the Reiki student</p>
<p>

Take the student's hands and move them down so that they are resting on their lap.</p>
<p>

Draw a large ckr over the front of your Reiki student's body to ground their energy.</p>
<p>

Place your hands a few inches above their crown chakra within their auric field. Starting from the crown chakra, run your hands down both sides of their aura untill you reach their feet. Touch the floor with both hands to complete the grounding and break the connection with the Reiki student.</p>
<p>

Silently set an intention of gratitude of Reiki.</p>
<p>

Say to the student: "You can now come back to full awareness in your own time whenever you are ready". or "This concludes the first degree attunement."</p>
<p>&nbsp;</p>
  <hr />
  <p><strong>Step 1:</strong></p>
<p>1. You will stand in front of your student approximately 2 - 3 feet away from them.</p>
<p>

2. Ask your student to close their eyes and raise their hands in the prayer position with hands in front of their heart chakra.</p>
<p>

3. You will silently set a short intention.</p>
<p>

Thanks God for being here<br>

Thanks Reiki for being here
<br>
Thanks Myself for being here
<br>
Thanks Student for being here</p>
<p>

4. When you feel ready and can sense the Reiki energy around you, open your eyes.</p>
<p>

Draw DKM and CKR on your palms.</p>
<p>
Draw CKR in front of your body, intending that your chakras open to receive Reiki.</p>
<p>
Draw DKM, CKR, SHK and HSZSN above the student intending for the energy to fill the room. These symbols will be called on as needed during the ceremony.</p>
<p>

Ask your student to take a deep relaxing breath as they perform a silent invocation opening themselves up to receiving the Reiki attunement.
Example: I (student's name) call upon Reiki, the universal life force. I am ready and open to receive the Reiki attunement.</p>
<p>
Give student a few moments to complete the silent invocation. When you sense they are ready you can continue.</p>
<p>

Ask your student to relax, follow your directions and enjoy the experience of the Reiki attunement ceremony.</p>
<p>

<strong>Step 2: Opening your stuent upto receive Reiki</strong></p>
<p>

Now walk around counter clockwise to the back of your student.</p>
<p>

Raise your hands in the prayer position in front of your heart chakra.</p>
<p>

Move closer to your student and place your NON dominant hand on your students shoulder.</p>
<p>

Place tongue behind your top front teeth at the roof of your mouth and contract the Hui Yin to boost the flow of Reiki in and around your body.
</p>
<p><strong>
Step 3: Opening student up to receive Reiki (crown chakra)</strong></p>
<p>

Standing behind the Reiki student.</p>
<p>

Now you will raise your dominant hand and hold it horizontally above your Reiki student's crown chakra.</p>
<p>

Draw a small ckr above the student's crown chakra to open the student's crown center.</p>
<p>

Now place your cupped hands over the student's crown chakra and beam/channel the three previously drawn Reiki symbols (DKM + HSZSN + CKR) into the students crown chakra filling their whole head with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p><strong>Additional:</strong> Place both hands on shoulder and beam/channel all three symbols dkm, hszsn, ckr, to heart and all over the body. </p>
<p>
<strong>Step 4: Opening student up to receive Reiki (Third eye chakra)</strong></p>
<p>

Standing at the right hand side of the Reiki student.</p>
<p>

Draw a small ckr over the student's third eye chakra to open the student's third eye center.</p>
<p>

Now with your right hand a few inches in front of the student's third eye chakra and your left hand a few inches behind the student's head beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's third eye chakra filling their third eye center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p><strong>Additional: </strong>you can touch the third eye also instead of awa. </p>
<p>

<strong>Step 5: Opening student up to receive Reiki (Throat chakra)</strong></p>
<p>

Standing at the right hand side of the Reiki student.</p>
<p>

Draw a small ckr over the student's Throat chakra to open the student's throat center.</p>
<p>

Now with your right hand a few inches in front of the student's throat chakra and your left hand a few inches behind the student's neack beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's throat chakra filling their throat center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p><strong>

Step 6: Opening student up to receive Reiki (Heart chakra)</strong></p>
<p>

Move so you are standing in front of the Reiki student.</p>
<p>

Draw a small ckr over the student's Heart chakra to open the student's Heart center.</p>
<p>

Now with your cupped hands side by side thumbs together facing toward your student's heart chakra; beam the three previously drawn reiki symbols (dkm, hszsn, ckr) into the student's heart chakra filling their heart center with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>

<strong>Step 7: Opening student up to receive Reiki (solar plexus, sacral, root chakras as well as body)</strong></p>
<p>

Standing in front of the Reiki Student.</p>
<p>

Leaving the student's hands in the prayer position, step back slightly, and draw a small ckr over the student's solar plexus, sacral and root chakras to open the student's remaining three energy centers.</p>
<p>

Now with your cupped hands side by side with thumbs together facing towards your student's solar plexus, sacral and root chakras, beam the three previously drawn Reiki symbols (dkm, hszsn, ckr) into the student's solar plexus, sacral and root chakras filling their three energy centers with Reiki energy. Remember to silently intone the names of each of the symbols three times.</p>
<p>

Next beam/channel the three previously drawn Reiki symbols (dmk, hszsn, ckr) into student's arms, chest, abdomen, thighs, legs and feet. Visualize Reiki energy filling every muscle, organ, tissue and cell of their body. Remember to silently intone the names of each of the symbols three times.</p>
<p><strong>Additional: </strong>Hands in prayer position, left hand wrapping his folded hand, tip of my hand to tip of his hand, channel all three symbol. </p>
<p>Left thumb on top of the fingers, grab hand with left hand, right third and fourth finger on over thumb of the student, channel all three symbols. </p>
<p>
<strong>Step 8: Attuning the student to the symbols</strong></p>
<p>

Open the student's hands like a book and draw the symbols into the palms of their hands and then tapping three times.</p>
<p>
Level 1: Draw ckr in both palms and tap three times.</p>
<p>
Level 2: Draw ckr, shk, hszsn, in both palms and tap three times.</p>
<p>
Level 3: Draw ckr, shk, hszsn and dkm and tap three times.</p>
<p>

Fold the student's hands back into prayer position.</p>
<p>

<strong>Step 9: Violet Breath</strong></p>
<p>
Standing in front of the Reiki student</p>
<p>

NOw place your hands around the student's hands and move them so that their fingertips are in line with their heart chakra.</p>
<p>

Blow the Violet Breath from the root chakra to the crown chakra.</p>
<p><strong>Additonal: </strong>Blow breath of life into heart , 3rd eye, crown, take hands upto heart chakra, blow into heart chakra, take hand till third eye, blow into third eye, take hand till crown, blow in the crown. </p>
<p>

<strong>Step 10: Closing the ceremony</strong></p>
<p>
Standing in front of the Reiki student</p>
<p>

Take the student's hands and move them down so that they are resting on their lap.</p>
<p>

Draw a large ckr over the front of your Reiki student's body to ground their energy.</p>
<p>

Place your hands a few inches above their crown chakra within their auric field. Starting from the crown chakra, run your hands down both sides of their aura untill you reach their feet. Touch the floor with both hands to complete the grounding and break the connection with the Reiki student.</p>
<p>

Silently set an intention of gratitude of Reiki.</p>
<p>

Say to the student: "You can now come back to full awareness in your own time whenever you are ready". or "This concludes the first degree attunement."</p>
<p>&nbsp;</p>
<hr>
<p><strong>Attunement method 2</strong><br>
    https://www.youtube.com/watch?v=_vmxNQ7ox2E</p>
<p>1. Thanks to all</p>
<p>2. Open the crown chakra</p>
<p>3. draw chk over crown chakra and press it in</p>
<p>4. draw shk and press it in</p>
<p>5. draw hszsn and press it in</p>
<p>6. come front blow symbols in crown chakra by hold hands of student</p>
<p>7. draw dkm over crown chakra and press it</p>
<p>8. come to front</p>
<p>9. blow dkm in crown by holding hand of student</p>
<p>10. draw chk, press into heart</p>
<p>11. draw shk, press into heart</p>
<p>12. draw hszsn, press into heart</p>
<p>13. dkm, press into heart</p>
<p>14. take palms down, draw chk (level 1), tap 3 times, on both palms</p>
<p>15. level 2, add shk and hszsn, tap 3 times, on both palms</p>
<p>16. add dkm, for master level, tap 3 times on both palms</p>
<p>17. take hands of student into prayer position and holding it with both hands, blow all symbols in all chakras from top to bottom</p>
<p>18. go back</p>
<p>19. close crown chakra like book</p>
<p>20. back in prayer position, you are attuned to level x.<br>
</p>
<p>&nbsp;</p>
<p></p>
<p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
