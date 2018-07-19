<?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');
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
<title>Reiki : Lecture</title>
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
  <h1 class="page-header">Lecture Level 2</h1>

  <div id="contents" class="visual">
      <p><strong>Chapter 1: Introduction to the 2nd degree</strong></p>
      <p>&quot;<span style="font-variant-ligatures:normal; font-variant-caps:normal; letter-spacing:normal; orphans:2; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px; -webkit-text-stroke-width:0px; background-color:rgb(255, 255, 255); text-decoration-style:initial; text-decoration-color:initial; display:inline !important; float:none; font-family:-apple-system, BlinkMacSystemFont, 'Neue Haas Grotesk Text Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16.2px; color:rgba(255, 255, 255, 0.9); font-style:normal; font-weight:300; ">The universe reveals its secrets to those who dare to follow their hearts</span>&quot;</p>
      <p>&nbsp;</p>
      <p>In first degree, you learnt and experienced following:</p>
      <p>- A moment of reflection<br>
          - Beginning of a journey<br>
          - self discovery, personal change<br>
          - Love, Growth<br>
          - new experiences<br>
          - bonding with higher power<br>
      </p>
      <p>It takes little time from Scepticism to New Understanding.<br>
          Reiki is a Door to new dimensions<br>
          Access to the purest unconditional love.<br>
      </p>
      <p>Reiki is pure energy<br>
          Omnipresent<br>
          Omnipotent<br>
          Omniscient<br>
          Available to All</p>
      <p>Words are impossible to adequately describe Reiki<br>
          Needs to be Experienced<br>
          Be open to Reiki<br>
          It will change your life<br>
          EVERY PERSON FEELS IN DEFFENT WAY SO IT IS IMPOSSIBLE TO DEFINE REIKI IN WORDS.<br>
      </p>
      <p>The 2nd Degree<br>
          Next Giant Step<br>
          Must have completed Reiki 1<br>
          Students normally have some experience and skill.<br>
          Drawn or Guided to Reiki 2<br>
      </p>
      <p>Trying to understand how Reiki works is almost impossible.<br>
          Like many things in our world, no-one truly knows how Reiki works<br>
          We can still use Reiki to improve our lives.<br>
      </p>
      <p>Working with Reiki will help you understand how it works<br>
          We think its best to just believe in Reiki, its wisdom and power<br>
          Leave doubts and fears aside.<br>
      </p>
      <p>Reiki is omnipresent-present everywhere at the same time.<br>
          Reiki is omnipotent-absolute and infinite power.<br>
          Reiki is omniscient-infinite wisdom and knowledge.<br>
      </p>
      <p>Reiki Connects everything together in the universe.<br>
          We are all connected at an unconscious level.</p>
      <p>&nbsp;</p>
      <p>We all have 50 trillion cells in our body connected and communitcating with each other.<br>
          Quantum healing teaches us everything is connected.<br>
          Each particle has an innate intelligence.<br>
      </p>
      <p>Scientists studying monkeys in Japan found that new behavior was picked up by other groups around the world.<br>
          Communicating across time and space.<br>
          Morphic Resonance</p>
      <p>&nbsp;</p>
      <p>Another study showed how trees communicated using gases to help protect each other from Giraffes overeating their leaves.<br>
          An energy with intelligence.<br>
          Reiki is also an energy with intelligence.</p>
      <p>&nbsp;</p>
      <p><strong>Chapter 2: Gassho The First Pillar of Reiki</strong></p>
      <p>The five Reiki principles which are taught in Reiki level 1 are based on the three pillars of Reiki:<br>
          A. <strong>Gassho</strong>: Pronounced as Gash-Show<br>
          B. <strong>Reiji-Ho</strong>: pronounced as Ray-Gee-Hoe<br>
          C. <strong>Chiryo</strong>: Pronounced as - Chi-Rye-Oh</p>
      <p>&nbsp;</p>
      <p><strong>Gassho</strong> literally means &quot;two hands coming together.&quot; It is a ritual gesture formed by placing the hands - palms together, in the 'prayer' or 'praying hands' position.</p>
      <p>And is the most fundamental and also the most frequently used of all the hand gestures in the practice of Buddhism.<br>
      </p>
      <p>There are 2 primary forms of gassho: Formal Gassho<br>
          The hands are brought together in front of the face, fingers straight pointing up, palms pressing together. Elbows are raised, forearms at about 30 deg angle to the floor; fingertips level with top of the nose, hands roughly a fist's distance in front of the tip of the nose. They eyes are focused on the tips of the middle fingers.<br>
          Helps establish a reverential, alert attitude &amp; shows reverence.<br>
      </p>
      <p>Mu-shin ('No - Mind') Gassho<br>
          Used primarily in greetings. Hands held loosely together, tips of fingers / thumbs still touch, a slight space betweent he palms. The forearms are at 45 deg angles to the floor.<br>
          The hands 4-6 inch distance in front of tip of the nose, hands are lower, in front of the mouth, the fingertips level just below the nose. The eyesfocused on the tips of the middle fingers.<br>
          Many people also perform mu-shin gassho with hands positioned in front of the chest at a level just above the heart.<br>
      </p>
      <p>There are a number of other special versions of Gassho found in Buddhism.<br>
          The lotus gassho: almost identical to mu-shin, the fingers are bent slightly more &amp; the tips of the middle fingers are held about an inch apart.<br>
          The Diamond gassho: also called the 'gassho of oneness with all life' - almost identical to mu-shin gassho, however the fingers are perfectly straight and interlocked.<br>
          Both are primarily used by priests during particular ceremonies or rites.<br>
      </p>
      <p>Usui taught a meditation called the gassho meditation. This meditation was practiced at the beginning of every Reiki workshop and meeting.<br>
          His students practiced the meditation each morning &amp; evening for 5-20 minutes. Gassho is so simple, that anyone can practice it alone or in a group meditation.<br>
          We recommend you try for at least 30 days.<br>
          Keep a meditation journal to record your experience with Gassho.<br>
      </p>
      <p>The Gassho Meditation (5-20 minutes a day)<br>
          Sit down, close your eyes and place hands together in Gassho.<br>
          Focus your attention at the point where the two middle finders meet.<br>
          Let go of everything else. If your mind wanders, acknowledge the thought, let it go and just refocus returning to the point where your middle fingers meet.<br>
          Repeat the five reiki principles either aloud or internally.<br>
          (if you get tired, keep hands on lap slowly and then revert to gassho again, have comfortable position and do gassho meditation)<br>
      </p>
      <p><strong>Chapter 3: Reiji-Ho The Second pilar of Reiki</strong><br>
              <br>
          Translated into English, Reiji means &quot;indication of the Reiki power.&quot;<br>
          Ho means &quot;methods&quot;.<br>
          Reiji-Ho consists of 3 short rituals that are carried out before each treatment.<br>
      </p>
      <p>Step 1: Fold your hands in front of your chest in the Gasho position with your eyes closed.<br>
          Now connect with the Reiki power.<br>
          Ask the Reiki power to flow through you. (within few minutes you will feel that reiki energy is flowing through you, it will enter through your crown chakra and it will go to your heart chakra or hands)<br>
          2nd Degree Practitioners and / or Reiki Masters can use the distance healing symbol to connect with the Reiki power. (repeat the wish 3 times in mind that Reiki may flow, then send with mental healing symbol and then seal it with power symbol, <br>
          As soon as you feel the energy, continue on to the next step.</p>
      <p>Step 2: Pray for the recovery health of the patient on all levels, let Reiki do what is required.<br>
          Raise your hands up (still in Gassho) in front of your 3rd eye &amp; ask Reiki to guide your hands to where the energy is needed.<br>
      </p>
      <p>Step 3: Then use and follow your intuition.<br>
          This technique guides your hands like magnets to the places on the body that needs treatment. (recipient body will attract your hand to particular position automatically)<br>
          Trusting your intuition &amp; the phenomenon that is Reiki.<br>
          Totally detach yourself, just let go and believe in Reiki.<br>
          Don't worry if nothing seems to happen - it will come in time - and when it does, you will know.<br>
          Reiki will guide your hands to the next spot when appropriate.<br>
      </p>
      <p>When there are no more areas requiring treatment your hands will be guided to rest, palms down, on your thights / in your lap.<br>
          Conclude Reiji Ho by once more performing gassho.</p>
      <p> Reiji Ho (in a nutshell, intuition)<br>
          Step 1:<br>
          Hands in Gassho;<br>
          Connect to Reiki</p>
      <p>Step 2:<br>
          Pray for the Recipients Health &amp; Well Being. Raise Hands to Third Eye ask the Reiki power to guide your hands to where the energy is needed.</p>
      <p>Step 3:<br>
          Use your intuition<br>
      </p>
      <p><strong>Chapter 4: Chiryo The Third Pillar of Reiki</strong></p>
      <p>Chiryo means &quot;treatment&quot; in English.<br>
          The person giving the treatment holds their dominant hand above the client's crown chakra and waits until there is an impulse or inspiration, which the hand then follows.<br>
          During the treatment the reiki practitioner uses their intuition; giving free rein to their hands, sensing painful areas of the body to work on and moving from those areas only when they no longer hurt or until the hands lift from the body on their own and find a new area to treat.</p>
      <p>The Breath is the bridge between the body and consciousness.<br>
          The Breath esoterically has special meaning.<br>
          As we breathe in oxygen, we also inhale Reiki which nourishes and cleanses our mind body and spirit.<br>
          Usui taught a breathing technique called Joshin Kokyuu-Ho which means breathing to cleanse the spirit.</p>
      <p>Joshin Kokyuu-Ho: Sit down, relax your body, keeping your spine straight.<br>
          Inhale through your nose, imagine also drawing Reiki energy through your crown chakra.<br>
          Become aware of how you experience Reiki being drawn through the crown chakra.<br>
          Your entire body will be invigorated &amp; enriched with Reiki energy. Draw the breath deep down into the Tanden, the center.</p>
      <p>The Tandem (Tantien) is the center of the body, the seat of vitality.<br>
          Hold your breath &amp; the energy you have drawn in with it in the Tanden for a few seconds.<br>
          Your aim is to supply the body with love and energy. Be gentle.</p>
      <p>&nbsp;</p>
      <p>Imagine that the energy from the Tanden spreads throughout your entire body.<br>
          Exhale through your mouth, Imagine that the breath &amp; the Reiki energy flows out of your mouth, fingertips, toes, hand &amp; foot chakras.<br>
          We become a clear channel of Reiki. Energy flows into us from the cosmos &amp; back again to the consmos.<br>
          Tongue on roof of mouth touching front teeth while inhaling, bottom of the mouth while exhaling.<br>
          Experiment with this technique.</p>
      <p><strong>Chapter 5: Namaste</strong><br>
          I honor the place in you in which the entire universe dwells.<br>
          I honor the place in you which is of love, of truth, of light and of peace.<br>
          When you are in that place in you and I am in that place in me, we are one.<br>
      </p>
      <p>The gesture (or mudra) of Namaste is a simple act made by bringing together both palms of the hands before the heart, and lightly bowing the head. In the simplest of terms it is accepted as a humble greeting straight from the heart and reciprocated accordingly.<br>
      </p>
      <p>Namaste is pronounced &quot;Namastay&quot;, a composite of two Sanskrit words, Nama, and te.<br>
          Te means you<br>
          Nama means to bend, incline or bow.<br>
          Together they mean a sense of submitting onself to another, with complete humility.<br>
      </p>
      <p>The word nama is split into two, na and ma.<br>
          Na signifies negation and ma represents mine. The meaning would then be 'not mine'.<br>
          Namaste is the rejection of 'I' and the associated phenomena of egotism. It is said that 'ma' in nama means death (spiritual), and when this is negated (na-ma), it signifies immortality.<br>
      </p>
      <p>The whole action of Namaste unfolds itself at three levels:<br>
          Mental<br>
          Physical<br>
          Verbal<br>
      </p>
      <p>The mental submission is in the spirit of total surrender of the self.<br>
          A transaction can only be between equals, hence by performing Namaste before an individual we recogise the divine spark in him/her and within our own selves.<br>
          Simply put, Namaste intimates the following:<br>
          The God in me greets the God in you.<br>
          The Spirit in me meets the same Spirit in you.<br>
      </p>
      <p>It recognizes the equality of all.<br>
          Translated into a bodily act, Namaste is deeply rich in symbolism.<br>
          Firstly the proper performance of Namaste requires that we blend the five fingers of the left hand exactly with the fingers of the right hand.<br>
          The five fingers of the left hand represent the five senses of karma, and those of the right hand the five organs of knowledge. Hence it signifies that our karma or action must be in harmony, and governed by rightful knowledge, prompting us to think and act correctly.<br>
      </p>
      <p>Namaste recognizes the duality that has forever existed in this world and suggests an effort on our part to bring these two forces together, ultimately leading to a highter unity and non-dual state of Oneness. (God and goddess, pleasure and pain, conscious and unconscious, etc).<br>
      </p>
      <p>Namaste is unique also in the sense that its physical performance is accompanied by a verbal utterance of the word &quot;namaste&quot;.<br>
          This practice is equivalent to the chanting of a mantra.<br>
          At its most general Namaste is a social transaction. It is usual for individual to greet when they meet each other. It is not only a sign of recognition but also an expression of happiness at each other's sight.<br>
      </p>
      <p>Namaste as a greeting is thus a mosaic of movements and words constituting affirmative thoughts and sentiments.<br>
          In human society it is an approach mechanism, brimming with social, emotional and spiritual significance.<br>
          In fact it is said that in Namaste the hands are put together like a knife so that people may cut through all differences that may exist, and immediately get to the shared ground that is common to all people's of all cultures.<br>
      </p>
      <p>Though shaking hands is an extremely intimate gesture, Namaste scores over it in some ways. Primarily is the one that Namaste is a great equalizer.<br>
          A King or President cannot shake hands with the large multitude they are addressing. But Namaste serves the purpose.<br>
      </p>
      <p>As much as yoga is an exercise to bring all levels of our existence, including the physical and intellectual, in complete harmony with the rhythms of nature, the gesture of Namaste is a yoga in itself.<br>
          It isn't surprising that any yogic activity begins with the performance of this deeply spiritual gesture.<br>
          The Buddhists went further and gave it the status of a mudra, that is, a gesture displayed by deities.<br>
          The performance of Namaste is comprised of all these three activities. Thus Namaste is in essence equivalent to meditation, which is the lganguage of our spirti in conversation with God, and the perfect vehicle for bathing us in the rivers of divine pleasure.<br>
      </p>
      <p><strong>Chapter 6 : New Possibilities with Reiki 2</strong></p>
      <p>The 2nd degree brings new possibilities for the practitioner who now can use the Reiki symbols.<br>
          The symbols are the keys that give the practitioner access to the full potential of the universal life force. There are three major new skills gained through the study of second degree Reiki.</p>
      <p>The Reiki practitioner can increase and focus the universal life force. <br>
          This can be used for self healing or to heal others.</p>
      <p>The Reiki practiioner can complete a full Reiki treatment in about 15 minutes.<br>
          The Reiki practitioner can now help more people in less time.</p>
      <p>The Reiki practitioner can send distant healing across time and space.<br>
          Through the symbols the second degree practiioner can connect to another person or being anywhere in the universe - either in the past, present or in the future.<br>
      </p>
      <p>As you incorporate the Reiki symbols into your life, you will find unlimited uses for them.<br>
          The greater your understanding and imagination, the more varied applications you will discover and develop.<br>
          The student will find that their personal vibratory level and psychic abilities have heightened.<br>
          The student will go through a 21 day detoxification process as their mind, body and spirit finds equilibrium.</p>
      <p>&nbsp;</p>
      <p><strong>Chapter 7: The Sacred Reiki Symbols</strong></p>
      <p>The symbols are special, unique and an important part of Reiki that connects you more effectively to the energy.<br>
          They are the keys that unlock the flow of Reiki and enhance and amplify the universal life force.<br>
          You can of course access the Reiki without the symbols.<br>
          However, the symbols can be harnessed to strengthn and focus reiki.<br>
      </p>
      <p>Dr Usui's four sacred symbols are known as the traditional Reiki symbols.<br>
          The first 3 symbols are taught in reiki 2.<br>
          The 4th and master symbol is taught in Reiki 3.<br>
          Once a student has been attuned to the Reiki symbols; they will be linked at a conscious and subconscious level to those symbols for life.<br>
      </p>
      <p>Once the second degree Usui Reiki student has studied and assimiliated the first three reiki symbols, their healing abilities are immediately heightened.<br>
          Without the second degree attunement however, the symbols will not work and are worthless.<br>
      </p>
      <p>Mikao Usui originally taught Reiki without the use of the symbols. However, he introduced them after a while to help his students better understand and more easily connect to the Reiki energy.</p>
      <p>The 4 symbols were found in the Sanskrit sutras by Dr Usui. He realised that these esoteric symbols would enable himself and others to be finely tuned into Reiki, just like tuning a television or radio signal.</p>
      <p>The symbols enable us to bridge the gap between the healer and the recipient, across which the universal life force could be drawn and sent as necessary.<br>
          Transcendental by nature, the Reiki symbols connect the practitioner and the recipient directly to the higher self or higher consciousness - the Rei<br>
          Simultineously a connection occurs which has ramifications on all levels - inner and outer.<br>
      </p>
      <p>When drawing the symbols, your intention should be absolutely clear and positive.<br>
          Visualize or imagine the symbols as a live energy. Many see that energy as a white light.<br>
          Some practitioners draw the symbols on the roof of their mouth with their tongue before transferring the symbols to a recipient.<br>
          Other draw the symbols on their hands or the bodies of the recipient.<br>
      </p>
      <p><strong>Chapter 8: The first sacred symbol - Cho ku Rei</strong></p>
      <p>Cho-ku Rei is the power symbol and the activator. Often called &quot;the light switch&quot; as it turns on and activites all the other symbols.<br>
          Cho - To cut, Remove illusions in order to see the whole.<br>
          Ku - Penetrating, imagine a swword slicing through.<br>
          Rei - Universal. Omnipresent, present everywhere.</p>
      <p>The Cho-ku-Rei cuts through and removes resistance. In Japanese Cho-Ku means imperial command - immediate.<br>
          The esoteric meaning of the symbol is dis-creation, illness and disease are creations being constantly recreated.</p>
      <p>How to draw the Cho-ku-Rei<br>
          Stroke 1: Draw a horizontal line from left to right.<br>
          Stroke 2: Draw a vertical line from top to bottom.<br>
          Stroke 3: Draw three and a half decreasing circles finishing on the vertical line as shown.</p>
      <p>The Cho-ku-Rei symbol dis-creates. This is the symbol that turns on the second degree energy.<br>
          Without this symbol the practitioner is still channelling only 1st degree energy.<br>
          It can be used alone or as an activator for all the other symbols. Reiki's infinite wisdom will bring about whatever is needed.<br>
      </p>
      <p>How to use the Cho-ku-rei Symbol<br>
          There are six main ways of transferring the Cho-ku Rei symbol from yourself onto your client.<br>
          They are as follows:</p>
      <p>Visualise or imagine a brillient white Cho-ku-Rei symbol projected from your third eye chakra onto the back of your hands as you rest them on the different hand positions of your client.<br>
          Visualize or imagine a brilliant white Cho-ku-Rei symbol on the palms of your hands before you place your hands onto your client.<br>
          Draw the Cho-Ku-Rei symbol on the roof of your mouth with your tongue. Then project the symbol onto the back of your hands as they rest on your client.<br>
          Draw the Cho-ku-Rei symbol on the roof of your mouth with your tongue. Then project the symbol onto the palms of your hands before you place your hands onto your client.<br>
          Draw the Cho-ku-Rei symbol onto the palms of your hands using your index fingers. Then place your hands onto your client.<br>
          Draw the Cho-ku-Rei symbol in the air with your index finger in the direction you wish the Reiki to go.</p>
      <p>To activate the symbols you have just drawn you must always silently intone the words Cho-ku-Rei three times.<br>
          The symbol will not work without the words silently intoned. If the situation calls for it write the problem down on a piece of paper and draw the Ccho-ku-rei symbol over the top of the writing.<br>
          Remember to silently intone the words Cho-ku-Rei three times. Then place the paper in the palm of your hands for a few minutes.</p>
      <p>The ckr turns on the 2nd degree Reiki.<br>
          The ckr activates all the other symbols.<br>
          The ckr protects you on all levels.<br>
          The ckr will bring about whatever is needed in a situation.<br>
          The ckr cleanses energies in your home, office, crystals, car, etc.<br>
          The ckr brings balance into your life.</p>
      <p>The ckr can be sewn into your children's clothes.<br>
          The ckr can be sent under a stamp on a letter.<br>
          The ckr can be placed under a sticker on a gift.<br>
          The ckr can be used on your food, drink, plants, animals, etc.<br>
          The ckr can be used to help your career.</p>
      <p>The ckr can be used on airlines, trains, pilots, drivers, etc.<br>
          The ckr can be drawn invisibly under your doormat, under wallpaper, in cupboards, behind pictures, on your front door.<br>
          You are only limited by imagination.<br>
          As you incorporate the symbols into your life you will use Reiki on everything.<br>
      </p>
      <p><strong>Chapter 9: The Second Sacred Symbol Sei Heiki</strong></p>
      <p>The second symbol is the Sei-Heiki pronounced say-high-key.<br>
          This is the emotional and mental symbol used primarily for emotional and mental healing. Sei-Heiki balances the right and left brain.<br>
          Sei - means birth, coming into being.<br>
          Heiki - means balance. Equilibrium<br>
      </p>
      <p>How to use the Sei-Heiki Symbol<br>
          The Sei-Heiki symbol can be transferred from yourself to your client in the same six ways already shown for the Ch-ku-Rei (see above)</p>
      <p>How to draw the Sei-Heiki<br>
          Stroke 1: Draw a three part zigzag line as shown.<br>
          Stroke 2: Draw a vertical line from top to bottom.<br>
          Stroke 3: Draw a curved line from top to bottom.<br>
          Stroke 4: Draw a curved line from top to bottom.<br>
          Stroke 5 &amp; 6: Draw two curved lines as shown from top to bottom.</p>
      <p>To activate the Sei-Heiki symbol you must first draw the Cho-ku-rei intoning the words Cho-ku-Rei three times.<br>
          You then draw the Sei-Heiki on top of the Cho-ku-Rei and intone the words Sei-Heiki three times.<br>
          Finally you draw the Cho-ku-Rei on top of the Sei-Heiki remembering to intone the words. Cho-ku-Rei three times more times (the Reiki sandwich)<br>
      </p>
      <p>The Reiki Sandwich<br>
          If you feel your client is suffering from some sort of emotional or mental block the Reiki sandwich can be used to release any blockages and allow the healing process to begin.<br>
          Visualize or Imagine the Reiki sandwich coming out of your third eye chakra and entering the third eye chakra of your client. As you intone the words add the rider if it be for the highest good.<br>
          Alternatively, draw the symbols on your hands and then place them over the clients third eye chakra.<br>
      </p>
      <p>This is often needed when you are treating a person for addictions, weight loss or unwanted habits. Keep a box of tissues handy as this can often cause the client to become weepy and emotional.</p>
      <p>The Reiki sandwich can be used on all the normal hand positions. However, the third eye chakra position must be treated with the utmost care and responsibility.<br>
          The Reiki sandwich will take the practitioner deep into the clients mind. It is vitally important to guard  your thoughts as they can be picked up by the client.<br>
          Ask the higher self of your client for consent before working on their third eye chakra. Your own intuition will give you the answer.</p>
      <p>If you are treating a person who is suffering from a disease such as cancer, leukaemia or AIDS, visualize thousands of Sei-Heiki symbols penetrating every cell in your clients body.<br>
      </p>
      <p>When you find something you do not understand or you have a question that needs answering. Write it down on a piece of paper and draw the Reiki sandwich shown on the previous page over the top of it. Your answer will come to you intuitively.</p>
      <p>&nbsp;</p>
      <p>Examples of Uses for the Sei-Heiki (SH) Symbol:<br>
          The SH works on blockages and resistance in the body.<br>
          The SH works on drink, drugs and smoking addictions.<br>
          The SH works on anorexia nervosa (An eating disorder causing people to obsess about weight and what they eat. Anorexia is characterized by a distorted body image, with an unwarranted fear of being overweight. Symptoms include trying to maintain a below-normal weight through starvation or too much exercise.)  and bulimia (Teenagers with bulimia nervosa typically ‘binge and purge’ by engaging in uncontrollable episodes of overeating (bingeing) usually followed by compensatory behavior such as: purging through vomiting, use of laxatives, enemas, fasting, or excessive exercise.  Eating binges may occur as often as several times a day but are most common in the evening and night hours.).<br>
      </p>
      <p>The SH works on relationship problems.<br>
          The sh works on nervousness, fear, phobias.<br>
          The sh works on anger, sadness and other emotions.<br>
          The sh works on grief from bereavement. (be deprived of a loved one through a profound absence, especially due to the loved one's death.)<br>
          The sh works on improving memory.<br>
          The sh works on enhancing affirmations.<br>
      </p>
      <p>The sh works on improving intuition and inspiration<br>
          The sh works on calming negative atmospheres.<br>
          The sh balances energies in your home, work, crystals.<br>
          The sh works on calming arguments.<br>
          The sh works on improving poor communications.<br>
          The sh protects you on every level.</p>
      <p>The sh protects you from the losing personal belongings.<br>
          The sh protects you while travelling.<br>
          The sh helps you find lost articles.<br>
          The sh improves creativity.<br>
          The sh helps with coma patients, head injuries.<br>
          The sh works on others as well as yourself.<br>
          Never use Reiki to manipulate others. Misuse is one way of losing your gift.<br>
      </p>
      <p><strong>Chapter 10 Hon Sha Ze Sho Nen</strong></p>
      <p>The third Usui symbol is the Hon-sha-ze-sho-nen. This symbol is known as the distant or absent healing symbol, and is used to transcend time and space - past present and future.<br>
          Like all the other symbols the Cho-ku-Rei symbol is used first to activate the HSZSN.</p>
      <p>The HSZSN gives the Reiki practitioner the ability to channel Reiki across space, distance becomes no object.<br>
          Reiki can be sent to a person across the room in a therapy situation or channelled to a person in another part of the world.</p>
      <p>The HSZSN also allows the practitioner to bridge time from the present to the past or future.<br>
          Reiki can be sent back to heal a childhood problem or even further still to a past life.<br>
          Future situations such can be greatly improved by sending Reiki in advance.<br>
          Time has no relevance when the HSZSN symbol is used.</p>
      <p>hon-sha-ze-sho-nen.png<br>
      </p>
      <p>How to draw the HSZSN symbol.<br>
          When the HSZSN symbol is drawn all strokes are drawn from left to right and from top to bottom.</p>
      <p>1. The first horisontal stroke means number one. The beginning.<br>
          2. The second vertical stroke which crosses over the first one, means number ten. The End. Completion.<br>
          3/4. The third and fourth strokes combined with strokes one and two symbolise a tree in Japanese.<br>
          Escoterically it means the tree of life; also the tree of death and transformation, of knowledge, evil, desire and resistance.<br>
          5 The fifth horizontal stroke means the root - the root of the tree. The cause; the essence, the origin.<br>
          Strokes one to five combined form the first Kenji - HON.<br>
          hon.png</p>
      <p>6. The sixth horizontal stroke symbolises the land - the earth.<br>
          7. Stroke seven a downward curving line means becomes - existence.<br>
          8. Stroke eight is a vertical line drawn downwards from the curved line.<br>
          9. Stroke nine is drawn from the left and curves sharply downards as shown.<br>
          10. Stroke ten is a horizontal line drawn from the center of stroke eight. The stroke eight, nine and ten form another Kanji which translated means the sun.<br>
          This symbol means what was hidden is brought into being. Bringing light into the earth. The miracle of Reiki - when you place your hands on someone, you are revealing little by little what is already there.<br>
          sha.png</p>
      <p>11. Stroke number eleven is a horizontal line drawn from left to right and seals the SHA kanji.<br>
          12. Stroke number twelve is a vertical line drawn from the center of stroke eleven downwards.<br>
          13. Stroke number thirteen is a vertical line drawn as shown.<br>
          14. Stroke number fourteen is a horizontal line drawn as shown.<br>
          Storkes eleven to fourteen form the next kanji - sho which means right, correct, justice.<br>
          sho.png</p>
      <p>15. Stroke number fifteen curves downwards to the left as shown.<br>
          16. Stroke number sixteen curves downwards to the right as shown.<br>
          17. Stroke fifteen and sixteen combined form the Kanji - ZE which means harmony. Acting appropriately, in the correct manner.<br>
          Remember an energy with intelligence, it always goes where it is needed.<br>
          Although the Kanji ZE is drawn after the SHO it is spoken before it.<br>
          ze.png</p>
      <p>17. Stroke number seventeen is a horizontal line drawn from left to right as shown.<br>
          18. Stroke number eighteen is drawn horizontally from left to right parallel to stroke number seventeen. It then curves downwards and to the left as shown.<br>
          19. Stroke ninteen curves downwards similar to the letter 'C' as shown.<br>
          20. Stroke twenty also curves downwards similar to the letter 'C' as shown.<br>
          21. Finally, stroke number twenty-one also curves downwards as shown.<br>
          Strokes seventeen to twenty one form the final kanji - NEN which means the heart, thought, also now - in the present moment in time.</p>
      <p>nen.png</p>
      <p>Hon: The essence or cause<br>
          Sha: Coming into existence<br>
          Ze: Harmonising appropriately<br>
          Sho: Correctly or justly<br>
          Nen: The heart or the thoughts, now</p>
      <p>hon-sha-ze-sho-nen-meaning.png</p>
      <p>How to Use the Hon-Sha-Ze-Sho-Nen Symbol<br>
          The HSZSN symbol can be transferred from yourself to your client in the same six ways already shown for the Cho-ku-rei (see above).<br>
          To activate the HSZSN symbol you must follow the same procedure used to activate the Sei-Heiki symbol - The Reiki Sandwich.<br>
          (Projecting the full reiki sandwich from your 3rd eye chakra to recipient's 3rd eye chakra - ckr, shk, ckr, hszsn, chr)</p>
      <p>projecting_full_sandwich.png<br>
      </p>
      <p>full-sandwich.png<br>
      </p>
      <p>Examples of Uses For the HSZSN symbol:<br>
          The HSZSN works on deep seated diseases.<br>
          The HSZSN works on long standing problems.<br>
          The HSZSN channels Reiki to a person in another country.<br>
          The HSZSN channels Reiki to someone in hospital.<br>
      </p>
      <p>The HSZSN works on groups or large organisations.<br>
          The HSZSN works on towns, cities and countries.<br>
          The HSZSN channels Reiki to disaster or crisis situations.<br>
          The HSZSN channels Reiki to world leaders.<br>
          The HSZSN works on driving tests and examinations.<br>
          The HSZSN works on interviews and meetings.<br>
      </p>
      <p>The HSZSN works on karmic past life issues<br>
          The HSZSN works on children while they sleep or rest.<br>
          The HSZSN helps treat patients with burns who cannot be touched or where there is a risk of infection through touch.<br>
      </p>
      <p>The HSZSN heals the inner child.<br>
          The HSZSN heals the past present and future.<br>
          The HSZSN works on world peace.<br>
          You are only limited by your imagination.<br>
          Believe and succeed.<br>
      </p>
      <p><strong>Chapter 11: Distant or Absent Reiki Healing</strong></p>
      <p>The three Usui Reiki symbols are the keys that unlock the doors to absent and distance healing.<br>
          It is important to study and master these symbols.<br>
          Practice drawing them until you can draw and visualise all three of them without referring to these pages.<br>
      </p>
      <p>There are many ways to channel Reiki.<br>
          Not important to understand how it works. Belief and the right attitude make the real difference.<br>
          Forget Logic - Remove Scepticism.<br>
          Try Sending Reiki to a friends sick pet.<br>
          Perfect this profound form of healing.<br>
      </p>
      <p>Preparing to send Distant Reiki Healing<br>
          With practice you'll be able to send Reiki Healing Energy at will, whenever it's required.<br>
          You will be able to perform a distant healing session no matter what the environment or location you find yourself in or no matter what distractions may be around you at that time.<br>
          You will have the ability through practice to simple filter out everything else and focus in on the job at hand - sending reiki to a person, place or event etc.</p>
      <p>&nbsp;</p>
      <p>Initially try to follow these Guidelines.<br>
          Find a quiet place and ensure you have enough time. You need to focus on the following:<br>
          Decide on the Distant Healing method you are going to use to send reiki before you begin the session.<br>
          Ground yourself &amp; connect with Reiki.<br>
          Remove the Ego - You are the Channel for Reiki.<br>
          Feel the flow of Reiki before you connect with the recipient and start sending reiki to them.<br>
      </p>
      <p>Start Transmitting once you feelt he connection with Reiki<br>
          All methods will work, so try them all.<br>
          Keep the sessions going for as long as you intuitively feel it should continue. Reiki will go where it is needed and continue to work after you have closed the session down.<br>
          An average distant healing session lasts about 15 minutes. There is no right or wrong in distant reiki, the KEY as always is in the INTENTION.<br>
          Always end the Reiki distant healing session with a positive envisioning of the person, place, event or situation you focus on.<br>
          Release the outcome to the Infinite Wisdom of Reiki.<br>
          Disconnect from the recipient &amp; Ground Yourself.<br>
      </p>
      <p>Popular Methods Used to Send Distant Reiki Healing</p>
      <p>Intially follow a pre-arranged format so you can remain relaxed and focussed on the healing session rather than the mechanics of what you are doing.<br>
          Practice makes permanent.<br>
          Like learning to drive a car; in the beginning it can seem overwhelming. With repetion &amp; practice you permanently encode the mechanics of driving in to your subconscious &amp; you can then enjoy the experience of driving.<br>
      Likewise, once you have mastered the mechanics of performing a distant healing session you will be able to just relax and focus of the healing session and not on what you need to do next - it will all become automatic.<br>
      </p>
      <p>As you grow in confidence, you can begin to rely more on your intuition to guide you during your future distant reiki healing sessions.<br>
          Because you don't have the recipient in front of you when you are performing the Distant Healing, you need to find a way to &quot;see&quot; what is going on during the session. Listed below are a number of substitute methods you can use to help you visualize or represent the distant Reiki recipient in your mind.<br>
      </p>
      <p>THE SURROGATE METHOD<br>
      </p>
      <p>surrogate.png</p>
      <p>You can literally use anything as a surrogate to channel Reiki. The most important thing you must do is clearly specifiy that the surrogate is taking the place of whoever or whatever you are sending Reiki to during your invocation.<br>
          A photograph, cushions, dolls, teddy bears, pens, crystals or the details of the person or thing written on a piece of paper area all good examples of a surrogate.</p>
      <p>Many Reiki practitioners have their favorite surrogate and use it for all their distance and absent healing.<br>
          When we treat people using a surrogate we prefer to use a teddy bear as we are able to work more precisely on the various hand positions and chakras.</p>
      <p>E.g. you want to channel Reiki to your mother who is in hospital in another part of the country or world. Find a photograph of your mother. Write down her name and the Details on piece of paper. (hospital name, room number)<br>
          Telephone your mother, get her permission and agreed time to send healing to her.<br>
          Place the photo &amp; the piece of paper in your hands. Recite your invocation aloud adding also that the photo and piece of paper are to be used as a surrogate of your mother.<br>
      </p>
      <p>A rider is similar to a caveat. When we are calling upon reiki the universal life force to help heal our friend/client etc, we must remember that we do not control or have any say on what is the best interest for that client/friend etc. - we remove our ego and let reiki and its infinite wisdom do what is needed based on the clients best interest - not our perceptions of what is best for them.<br>
          So the rider hands responsibility back to reiki to do what is needed and go where it is needed.<br>
          Sometimes you will discover in your future reiki practice that it is not the right time for whatever higher reason for that person to receive healing.<br>
          We MUST alwyas try to ask permission first before you send anyone healing or at least add the Rider - Should it be for their higher good.</p>
      <p>&nbsp;</p>
      <p>mother_distant_reiki.png</p>
      <p>Holding the photo &amp; piece of paper draw the full Reiki Sandwich over the top.<br>
          Close your hands together and imagine sending healing light to your mother. Keep your hands closed for at least 5 minutes.<br>
          Now visualize or imagine your mother getting better. See her leave the hospital and making a full recovery.<br>
          Remember the recipient is drawing the Reiki and doing the healing, you are just a channel.<br>
          This process should be repeated at 4 times over 4 consecutive days. Save time by setting up 4 healing sessions at once.  (put time and date she wished to be reiki energy channelled to her, you will mention, 4 days and 4 times, and now you only need to spend one 5 to 10 minutes reiki healing session channeling reiki to your client, they will receive over the 4 different days)<br>
          Remember the symbols transcend time and space.<br>
          Obviously the stronger your intent and the more time you spend sending Reiki the stronger and more profound it will be.<br>
      </p>
      <p>THE THIGH AND KNEE METHOD<br>
          You will need to be seated to perform this treatment.<br>
          Make your right knee and thigh the surrogate for the head and front of your client. Your right knee is your client head,  your right mid thigh is your clients body and rest of your right thigh is your clients legs and feet.<br>
          The left knee and thigh represents the back of your clients head and body. Your left knee is the back of your client's head, your left mid thigh is your client's back and the rest of your thigh represents the back of your clients legs and feet.</p>
      <p>thigh_knee_method.png<br>
      </p>
      <p>It takes about 15 minutes to complete<br>
          Using your left hand for the left knee and thigh and your right hand for the right knee and thigh work on the three positions for about 5 minutes each. Draw, visualize or imagine the three Usui symbols (The full reiki sandwich) on each hand position. Remember to intone the words of each symbol three times. Complete the treatment as normal by thanking the universal life force and finally sweep your clients aura by rubbing your knees and thighs.<br>
      </p>
      <p>VISUALIZATION TECHNIQUES</p>
      <p>There are two basic ways of using visualization to perform absent or distant healing.<br>
          Close your eyes and make your invocation. Repeat your friends name three times to focus your mind and establish a connection between yourself and your friend in hospital.<br>
          Transport your friend from the hospital and visualize or imagine them a miniature form resting in the palms of your hands. open your eyes and project the symbols from your third eye onto your friend resting in the palms of your hands. Alternatively you can place your friend on one hand and draw the symbols from the other hand.<br>
          Gently cup your hands together. Keep your hands close for five to ten minutes or until you intuitively feel the treatment is complete. Open your hands and visualize or imaging your friend making a full recovery. Close your eyes and transport your friend back to hospital. Say Good bye to keep healing light with them, and to continue and complete the healing session. Say thanks to Reiki. Wash your hands in cold running water.</p>
      <p>visualization.png<br>
      </p>
      <p>ALTERNATIVE VISUALIZATION TECHNIQUE</p>
      <p>Close your eyes and visualize or imaging being in your friends home. Have the child lie down on a bed or couch. Make your invocation and then project the three Usuai symbols onto the child. Conduct a full hands on treatment.<br>
          Visualize or imagine a healing light enveloping the child. Say goodbye leaving the healing light with them to continue and complete the healing process. Complete the treatment by thanking the universal life force.</p>
      <p>&nbsp;</p>
      <p>Chapter 12: A traditional distant Reiki Healing Technique</p>
      <p>Important Note: Whenever you perform disstant Reiki healing, your intuition or imagination is particularly useful because you won't receive instant feedback directly from the recipient during the session.<br>
          Unlike an in person treatment you can't observe or experience exactly what the distant recipient is going through; so you will not be able to see (intuitively imagine) if that person is sighing, crying, smiling, coughing or pick up on any of the more subtle non-verbal communications/responses like involuntary movements or a change in skin tone for example.<br>
      </p>
      <p>Step 1: Ask for permission to send the Distant Healing to the Recipient.</p>
      <p>trad_permission.png</p>
      <p>When you are treating someone in person with Reiki, it is safe to assume that you have their permission to treat them with Reiki otherwise why would they be there!<br>
          However, when we perform a Distant Reiki Treatment we need to ensure that wherever possible (they may be seriously ill and unable to talk to you) we have the recipient's or a close family member of the recipient, permission to channel reiki to them so we can maintain good ethical practice and integrity.<br>
          Don't force your good intentions to channel healing on someone else against their will. If you offer of Reiki is refused by one person, you can always find someone who does want to receive the Reiki energy.</p>
      <p>Someone in need of healing will contact you by email, a note, a text, via your website, or verbally during a meeting or phone conversation. Their approach requesting distant healing is your green light, giving you permission to send Reiki.<br>
          You may also get a request for distant healing on another's behalf, If you aren't sure of the person's consent, you can choose to take one of the following course of action:<br>
          Using Reiki Connect with the person and get their consent intuitively. Ask them the question in your mind: &quot;Do you want to receive long-distance Reiki from me?&quot; If you get a clear yes or no, the proceed accordingly.<br>
      </p>
      <p>If you get an urgent request on another person's behalf, you can use your intuition or if you need to proceed immediately add the rider - Should it be for their highest good.<br>
          You can also send Reiki with a specific intent so that it flows only where it is desired. In other words you can send Reiki without explicit approaval, but first make clear in your mind that, if the person in question doesn't want Reiki, the energy will go to the earth or to some other person who wants it.<br>
          You may have strong feelings one way or another about getting permission to send Reiki. Follow what feels right for you - remember these are only guidelines.</p>
      <p>&nbsp;</p>
      <p>Step 2: The Traditional Distant Reiki Technique</p>
      <p>The basic reiki distant healing method we were taught using a photograph by our Reiki Master.<br>
          Remember it is a guide, try lots of different methods until you find the one that you like the most or you intuitively feel gets the best results for you and your client.</p>
      <p>traditional_method.png</p>
      <p>1. Confirm you have the recipients permission to send distant reiki healing.<br>
          2. Holding the photo of the recipient in your cupped hands. Visually draw on that photo while intoning the names of the following symbols alound three times each to create a virtual Reiki Sandwich<br>
          Cho-ku-rei (power symbol)<br>
          Sei-he-ki (emotional symbol)<br>
          Hon Sha Ze Sho Nen (Distance symbol)<br>
          Cho Ku Rei (Power symbol)</p>
      <p>3. Say aloud the name of th eperson 3 times as you close your hands gently together to cover the photo.<br>
          4. Now imagine being in the room wiht that person so you can see/imagine the recipient in your mind sitting or lying down ready to receive the treatment.<br>
          5. Now visually draw the virtual reiki sandwich on to the body of the recipient once again intoning the name of the symbols three times.<br>
          6. Conduct a full reiki session in your mind. Remember to pay special attention to any known disease hot spots or places you are intuitively drawn to.</p>
      <p>7. End the session by cleaning the recipients aura &amp; ground them.<br>
          8. Now ground yourself. Remember to thank reiki and your guides etc. for participating in the distant healing session.<br>
          This is only a guide. As alwyas Intention is the key to success, there is not right or wrong way!<br>
          Usui's preferred distant healing method, which he called Enkaku Chiryo Ho uses the visualizing technique of photographs. (Enkaku translates &quot;remote or sending&quot;, Chiryo to &quot;treatment&quot;, and Ho to &quot;method&quot;)</p>
      <p>&nbsp;</p>
      <p>Chapter 13: Examples of Sending Distant Reiki Healing</p>
      <p>As we know when we think about using Reiki on ourselves or others we know Reiki will automatically start to flow through us as Reiki Practitioners.<br>
          As Reiki 2 Practitioners we move in to a new realm of Reiki, where the restrictions of time, space and distance no longer exist.<br>
          We can send reiki to a person, group and even a whole country or continent even if we are located on the other side of the world.<br>
          In fact we can now channel reiki to the past, present, or future event or situation.</p>
      <p>SEND REIKI DISTANTLY TO PEOPLE</p>
      <p>Most distant Reiki healing sessions will involve sending reiki to another person over a short or long distance.<br>
          The recipient may be at their home or in a hospital in another place.<br>
          The distance doesn't matter, it could be a mile away or 12,000 miles because Reiki can transcend any distance.<br>
          (You can also define time when the reiki should be sent, I ask the power and wisdom of reiki with the power of hszsn, to deliver the reiki at the time of the operation.)<br>
      </p>
      <p>SEND THE REIKI TO FUTURE</p>
      <p>Reiki can be sent into the future ahead of time to important events such as a wedding, a driving test, exams, competitions, job interviews, doctor or dental appointments, etc.<br>
          Because you may not always be available at a particular time to send Reiki to someone or even yourself, this technique is a wonderful way to ensure that the power of Reiki is flowing at that special event to help you or the recipient should it be for your / their higher good.<br>
          (You can mention, time, place, person who is receiving reiki and situation of the event, for example if you want to send person who is about to sit in exam , you can take pic and visualize symbols and say &quot;I ask the power and wisdom of reiki with the power of hszsn to make her pass and get admission in this college&quot;)<br>
      </p>
      <p>SEND REIKI TO PAST<br>
          The ability to send healing backward in time allows you to help heal previous events, experiences &amp; situations.<br>
          Sending reiki back will not change history, but you can heal what results from it.<br>
          People tend to hold onto past experiences, much of the healing done in the present time or now is actually healing the baggage carried forward from the past.<br>
          Set your clear intention for the specific, past experience or time period you want to focus on for the Reiki session.<br>
          Remember you can send Reiki to a single moment in time, or to a period of time.</p>
      <p>(for example if you are injured in any sports, you can go back in past and imagine yourself in same spot and give reiki to yourself, set your clear intention on specific situation and time period).<br>
      </p>
      <p>SEND REIKI TO YOURSELF</p>
      <p>Your past: Send Reiki back along your timeline to events or situations where you experienced pain or suffering or even a break up or loss.<br>
          Sending healing reiki energy to those trying times in the past can bring relief and remove any blockages that may be effecting you now in the present. Healing the past can be both cathartic and liberating and open up a whole new brighter future for you.<br>
          In you are going to work on past events remember the box of tissues as you may stir up emotions and begin to cry as part of the process.</p>
      <p>Your present: You could be tired and run down and in need of a energy boost.<br>
          Take a break, may be even meditate for a few minutes and send reiki to yourself by imagining yourself in your mind's eye. (passing reiki white light entering into your crown chakra with filling your whole body with reiki energy)</p>
      <p>Your future: Send Reiki to your future self. Go one day, week, month or even years into the your future. Think of a certain upcoming event in your future such as a vacation, retirement, wedding or just send to the future with no event or time frame in mind asking reiki to guide you in your future reiki practice so you attract success and happiness to yourself.<br>
          Sometimes when you send Reiki to yourself in the past, present or future you will receive a message, an acknowledgement or validation. You can use any technique on yourself. In fact, its best to put yourself first in order to learn and practice any technique but also so that you gain the benefits of Reiki healing.<br>
      </p>
      <p>SEND REIKI TO PLACES, SITUATIONS AND WORLD EVENTS OR DISASTERS</p>
      <p>You can send reiki distant energy to mother earth, which is itself receptive to healing. Hardly a week goes by without some form of disaster or natural events that harm the earth including tropical storms, tsunamis, fires, volcanoes and earthquakes; and man-made disasters like forest fires, unnecessary pollution, destruction of rain forests and delicate eco-systems or the illegal poaching of endangered wildfire or whaling.<br>
          Mother Earth provides us with every basic need we have for sustenance. It is only right that we give something back by sending reiki healing to the earth.</p>
      <p>You can also help to heal conflicts and major accidents or mindless attacks such asa the following: Road, rail or air traffic accidents. Next time you hear of an accident or pass an accident on the road, you can send Reiki to all the people involved.<br>
          War Zones: Send Reiki to all the victims of war with an intention of bringing about a peaceful resolution and reconciliation.<br>
          Terrorist Attacks: Send Reiki to all the victims and the relatives and friends of mindless terrorist attacks.<br>
          Political situations: Send Reiki so that the differences among political parties of different ideologies are healed and decisions are made that benefit the higher good of all humanity.</p>
      <p>&nbsp;</p>
      <p>When you send Reiki to large events it would be impossible to get permission from everyone involved in such an event or situation, so you can intend that Reiki go to all who want it. You're not sending Reiki to any particular individual but making this healing energy available to those who need it most.<br>
          If you want to practice sending distant Reiki and don't know where to start, just open the newspaper or turn on a TV news programme. You will unfortunately be able to find lots of candidates to practice on.<br>
      </p>
      <p>&nbsp;</p>
      <p>SEND REIKI TO MULITPLE PEOPLE/EVENTS/SITUATIONS<br>
          As your Reiki practice become busier you will need to find creative ways to juggle the workload. One of the ways you can save time while still providing great service to your clients is to send healing regularly to multiple people and / or events and situations.<br>
          Its like sending an email to multiple people all over the world at the same time.<br>
          When you send Reiki to multiple clients at the same time, you get to help more people while saving &amp; managing your time effectively - A Win-Win.</p>
      <p>&nbsp;</p>
      <p>REIKI BOX<br>
          write down the names of the people or situations you are sending healing to including any times and date and put the card/paper with the names into a box along with any photos.<br>
          Try to set aside a set time everyday to send reiki to the people/events etc stored within the healing box. You will find many of the requests for healing stay in there for a few weeks, while some will stay &quot;forever&quot;.<br>
          Check the card in the box regularly &amp; send distant Reiki energy ot all the people in it. Using feedback and using your own intuition, remove some of the cards once reiki has completed its work.</p>
      <p>(you can put your wishes, challenges, treatment request, personal goals, in the box or of others who request you., remove the cards who are completed)</p>
      <p>reiki-box.png</p>
      <p>CRYSTAL GRID<br>
          You charge the crystals with Reiki energy and place them in a set pattern and with a specific intention. Crystals are used to enhance the energy sent at a distance.</p>
      <p>BOARDS WITH PHOTOS AND NAMES OF PEOPLE TO BE HEALED<br>
          Use a board/surface where you can attach the names or photos of people requesting Reiki. You can become the energy to the requests on the board.<br>
      </p>
      <p>&nbsp;</p>
      <p>Finally, remember to share your distant healing experiences with the recipients if appropriate. Many of your clients could benefit from any insights or intuitive information you may have received from the distant healing session. You can also benefit from any feedback the recipient gives you on the experience. It could help you to fine-tune what you do and the type of technique that works best for you.<br>
          As with all things Reiki, the key to success is your intention.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Chapter 14: Working with Reiki 2</p>
      <p>EMPOWER YOUR GOALS<br>
          Goals make the difference between success and failure in life.<br>
          Reiki can empower your goals, dreams and desires. Write your goal on a piece of paper. Be specific. A goal should be set in the positive. Include all the facts, dates, names, etc. (for example monday, july 14, 2018, i want to go here / there or i will get the result)<br>
      </p>
      <p>The secret (the law of attraction) explains that we can have anythign we want in life, we just need to send out that thought or vibration to the universe and it will deliver all our goals dreams and desires. By sending out positive energy into the universe, we attract positive results back - Its that simple.<br>
          It shoudl also sound very familiar to you as Reiki practitioners. The Secret or the law of attraction is working with the Universal Life Force.</p>
      <p>english version - https://www.youtube.com/watch?v=jTGZQgdr0ag<br>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>If you can see clearly see in your mind your goals, dreams and desires and you send it out to the universe you will attract everything you desire with the power of Reiki.<br>
          You just need to Believe in the Power of Reiki - That's the Real Secret.<br>
          Draw the full Reiki sandwich over the top of your goal. reiki the paper for several minutes. Carry the piece of paper with you in your purse or wallet. Reiki the paper several times a day. Remember to add the rider should it be for the highest good. Remember - Believe and succeed.</p>
      <p>&nbsp;</p>
      <p>THE MAGICIAN (Tarot Cards)<br>
          A simple way of sending Reiki is in the Magician position. Hold one of your hands in the direction you wish to send Reiki and the other pointing down towards the earth.</p>
      <p>magician.png</p>
      <p>PREPARING TO TREAT A CLIENT</p>
      <p>Clear any negative energy and raise the vibration of the room by using the Cho-ku-Rei symbol, Draw the ckr symbol on all the walls, celing, floor, healing couch, crsytals and candles.<br>
          When your client arrives project the ckr symbol onto their third eye chakra to relax and prepare them for a treatment.<br>
          Alwyas draw the symbols on your hands before you begin the treatment. Visualise the symbols entering your clients body through each chakra and hand position. Remember to Add the Rider should it be for their Higher Good.<br>
      </p>
      <p>POSITIVE AFFIRMATIONS</p>
      <p>If you are working on a specific treatment, try incorporating positive affirmations. For example if your client wants to stop smoking. Ask your client to silently intone at regular intervals throughout the treatment &quot;I now release the need to smoke cigarattes.&quot; You should also intone the same affirmation on each new hand position. Pay particular attention to the third eye chakra. Remember the Sei-Heiki is used for addictions.</p>
      <p>Alternatively, write the positive affirmation on a piece of paper and have your client hold onto it throughout the treatment. When the treatment is complete your client can take it home wiht them and keep it in their purse or wallet. Tell them to read it on a regular daily basis.<br>
      </p>
      <p>SCANNING THE AURA<br>
          Before you begin a treatment scan your clients aura. Use your new heightened intuition to sense possible problems or blockages. Sense how the energy beneath your hands or in your palms feel. You may notice a variance in temperature. If you are guided or drawn to a particular position on your clients body go with it. Trust your intuition. Place your hands over that spot and work to heal and re-balance the distortion in your clients aura.</p>
      <p>ZAPPING (cause to move suddenly and rapidly in a specified direction)</p>
      <p>When you use the HSZSN symbol you can zap people or situations from afar. Imagine your hand or finer is a laser gun and beam Reiki where it is needed.</p>
      <p>&nbsp;</p>
      <p>Chapter 15 Additional Non Traditional Reiki Symbols<br>
      </p>
      <p>The 3 traditional Usui symbols cover every eventuality. They are omniscient and omnipotent.<br>
          However, there are several NON traditional reiki symbols which you have specific purposes and can be used in conjunction with the Full Reiki Sandwich.<br>
          These additional symbols are not a necessity. Try using the additional symbols &amp; decide for yourself whether you want to incorporate and use them in your Reiki Practice.</p>
      <p>&nbsp;</p>
      <p>REVERSED CHO-KU-REI<br>
          This symbol is drawn in a clockwise direction unlike the traditional Usui ckr which is drawn anticlockwise.<br>
          When used together the two ckr's are similar to the double helix found in DNA. The double helix of the dna is both clockwise and anticlockwise.<br>
          The chakras also radiate outwards from the center of th ebody similar to the double helix with the norrowest section at the center.</p>
      <p>reverse-cho-ku-rei.png<br>
      </p>
      <p>The clockwise ckr connects with heaven while the anti-clockwise ckr connects with earth. you could experiment with both ckr's by using the traditional usui ckr at the beginning of the reiki sandwich and the reversed ckr at the end of the reiki sandwich.<br>
          You may find it brings balance and additional power to your work. If you do notice a positive difference you can incorporate into your practice and daily use.</p>
      <p>full--sandwich-with-reverse-ckr.png<br>
      </p>
      <p>ZONAR<br>
          The Zonar symbol represents infinity, timeless, ageless, perpetual and eternal. It is drawn as the letter Z with the last stroke rising up into an infinity sign drawn three times across the center of the Z.<br>
          This symbol is used for past life issues and karmic and inter-dimensional problems that are difficult to define. Often there are problems and issues manifesting in our present life that are leftover remnants from a previous life or lives.</p>
      <p>zonar.png</p>
      <p>HARTH<br>
          This is the symbol for love, truth, beauty and harmony. It can be used to dissolve negative patterns we unconsciously use to insulate ourselves from the truth, thus shattering delusion and denial.<br>
          The Harth symbol clears and opens the channels to higher consciousness. Often known as the master symbol as it is used in some initiation ceremonies by the Reiki Master. All strokes are from left to right, top to bottom.</p>
      <p>harth.png</p>
      <p>How to draw Harth?<br>
          harth-draw.png</p>
      <p>&nbsp;</p>
      <p>FIRE DRAGON<br>
          Also know as the Tibetan Fire Serpent, this symbol represents the Ki energy travelling up the spine from the root chakra. It is used for spianl and back problems and is said to be good for the menopause.<br>
          To draw the fire dragon you begin at the base and draw an anti-clockwise spiral two and a half times. Continue the line upwards in a series of waves. Complete the symbol with a horizonatal line across the top drawn from left to right. The Fire Dragon's surging upward spiral of energy cleanses and joins the chakras.</p>
      <p>fire-dragon.png</p>
      <p>&nbsp;</p>
      <p>JOHRA</p>
      <p>The Johre symbolises white light. It is used to release blockages, for protection and to transfer healing white light.<br>
          The symbol can be added to the reiki sandwich to send healing energy and protection across space and time. This symbol is difficult to draw so try to project the symbol from your third eye chakra.<br>
          Draw from top to bottom as shown.</p>
      <p>johra.png</p>
      <p>MOTOR ZANON<br>
          Considered a Master symbol by Buddist monsh who use it for exorcism. Motor means to go in while Zanon means to come out. This symbol is used for viruses, infections and AIDS.<br>
          When the motor goes in, the little squiggle catches the virus or bacteria. The Zanon symbol is then drawn and it reverses polarity and leaves the body taking the virus or bacteria with it.<br>
          Draw the Reiki Sandwich as Follows: 1) ckr 2) motor zanon 3) reverse ckr. (ckr + mz + rckr)</p>
      <p>motor_zanon.png</p>
      <p>Draw the Reiki Sandwich as Follows:<br>
          1) ckr<br>
          2) motor zanon<br>
          3) reverse ckr<br>
          (ckr + mz + rckr)</p>
      <p>reiki-sandwich-with-mz.png</p>
      <p>LEN SO MY<br>
          Pronounced len so my this symbol represents pure unconditional love and is used for emotional problems and situations. The symbol is normally placed over the heart chakra.<br>
          Draw the figure eight (8) first followed by the dickie-bow shape. Remember to draw from top to bottom, left to right.<br>
      </p>
      <p>len-so-my.png</p>
      <p>RAKU</p>
      <p>This symbol is used for grounding and can be used at the end of each reiki treatment session. Certain Reiki branches use Raku, a Tibetan symbol, to close the connection between teacher and student after attunements.<br>
          Similar to a lightning stroke, it focuses and grounds (brings into the earth) energy. This symbol is also incorporated into the Tibetan Dai ko myo (Tibetan master symbol) and in an elongated form in the Tibetan fire serpent which are taught in the third degree.</p>
      <p>raku.png<br>
      </p>
      <p>OM<br>
          Om is a sanskrit symbol used for protection, healing and meditation and by different Eastern spiritual practices, including yoga. Om represents the sound of the universe and is frequently chanted. It sounds like &quot;ah-oh-mm&quot; or &quot;aum.&quot; Som Reiki branches, including karuna Reiki, use this symbol. Listening to or chanting the sound &quot;om&quot; helps to connect spirtiually. Some Reiki masters play om chanting music during the attunement process or during a healing session.</p>
      <p>om.png<br>
      </p>
      <p>REMINDER<br>
          Always use the Cho-ku-Rei symbol to activate all of the other symbols.<br>
          Always intone the name of the each symbol that you have drawn; visualised or projected it onto a subject, three times.</p>
      <p>chokurei2.png<br>
      </p>
      <p>Chapter 16: Extra Reiki Hand Positions</p>
      <p>Specific parts of the body where you have problems</p>
      <p>Chapter 17: Combining Reiki with other Healing Disciplines</p>
      <p>Reiki can compliment and enhance the effectiveness of almost any other method of healing. <br>
          Reiki energy balances the subtle frequencies of th eperson's energetic body as it is being received. In fact, combining healing modalities can help to increase the benefits of a Reiki healing session for the recipient.<br>
          We have found combining Reiki with NLP and Hypnosis can help to really enhance a client session by allowing the client to relax deeply and easily, so they are open unconsciously to the positive suggestions of change delivered with NLP and hypnosis.<br>
          Remember to explain to your client what you intend to do during the session and get permission from them to use more than just Reiki.<br>
          We have found Reiki and hypnotic suggestion can be quicker and more effective - you are only limited by your imagination.<br>
      </p>
      <p>&nbsp;</p>
      <p>REIKI AND THE ART OF FOCUSING<br>
          Most people are aware of the connection between the body and mind as it relates to health and well-being. We all store feelings and emotions over our entire lifetime in our bodies. When these feeling and emotions are left to fester they can invariably lead to unhappiness, sickness and disease.<br>
          The bodymind has an early warning system. The signs normally express themeselves as bodily aches and pains.<br>
          Most people take a pain killer to alleviate and suppress the ailments. Issues, emotions and feelings that needs to be dealth with are suppressed. The cure for the pain is in the pain. We can communicate with the bodymind and release the blockages and destructive emotions.<br>
          Health, well-being and blanace follows. Learning to communicate and understand your body mind is vitally important in the search for longevity and happiness.<br>
      </p>
      <p>THE FOCUSING TECHNIQUE FOR SELF-HEALING</p>
      <p>Sit or lie down in a comfortable position. Close your eyes Focus on your breathing. Begin a normal Reiki self healing treatment. Work from position 1 to position 7. When you have finish working on the heart chakra rest both hands across your chest covering your heart.<br>
          Focus your conscious awareness inside. Imaging placing a microscopic version of yourself underneath your hands.Fee how safe and releaxed you feel. Allow the miniature version of yourself to travel all over your body from the tips of your toes to the top of your head. Notice any aches or pains that have appeared. If nothing appears straight away look again. Often you will find an ache or pain on the second or third run.</p>
      <p>&nbsp;</p>
      <p>Place your full awareness into the pain. Focus and stay with it for a few moments. Say hello to the pain. Thank the part of the body that has come to talk to you today. Notice what color it is? (eg. red). Notice what shape it has? (e.g square). If that part could communicate with you and could say only one word what would it be? (e.g. sad).<br>
          Focus on the word sad (or any other word that comes up). Ask the words sad when it first entered your body. You will normally invoke a memory. Warning you may get fearful and emotional. You may want to cry, shout or scream - let it out.<br>
          Continue the conversation with the part of the body until you have resolved the problem, emotion or issue. Use Reiki to heal. If you find it is too difficult to talk and continue the conversation send Reiki to the situation so it can heal it for you with its infinite wisdom. Complete session with the full self treatment.</p>
      <p>&nbsp;</p>
      <p>On occasions you may find these issues are residues left over from past lives, childhood and time sof personal loss and grieving. Use the full Reiki sandwich to heal and remove the emotional and physical pains. This is an extremely powerful technique.<br>
          Go carefully in the beginning until yo uhave gain confidence and experience with it. If you find it too difficult to work directly with your various issues write them down on a piece of paper and send Reiki to them.<br>
          As you release the emotional blockages and residues you will feel a new sense of peace and well-being. Remember to heal yourself first, then your family, then your friends and others.<br>
          This technique can be used to treat others also.<br>
      </p>
      <p>TIMELINE REIKI<br>
          This technique is based on a mixture of Reiki and NLP (neuro linguistic programming). It allows you to travel into your future and create the life you want for yourself.<br>
          Sit or lie down in a comfortable position. Close your eyes. Focus on your breathing. Begin a normal reiki self healing treatment. Work from position 1 through to position 7 (i use all chakras). When you have finish working on the heart chakra (position 7) rest both hands across your chest covering your heart.</p>
      <p>timeline-reiki.png<br>
      </p>
      <p>Focus your conscious awareness upwards towards the crown chakra. Visualise or imagice a small opening appar in the crown chakra. Float upwards throught the opening and hover just above your body. Look down and visualize or imagine your timeline. Typically you will see a line of images relating to past memories and future expectations. Normally the future projects forward while the past extends behing you. Whatever is right for you will appear.<br>
          Float gently above your timeline. Move forward until you reach the end of your timeline. If you timeline has ended before you can see that you have reached an old age or achived your full potential project the Full Reiki sandwich onto your timeline. Take hold of your timeline and stretch it out to add longevity, well-being and a rich fulfilling future.<br>
      </p>
      <p>timeline-reiki-2.png<br>
      </p>
      <p>Look back now along your timeline and review your life. See if you are satisfied with how you have lead your life. Did you reach your full potential? Did you make a worthwhile contribution to this world? Are you satisfied you lived your life to the full? Would you like to change anything about your life?<br>
          If you find a part (or parts) of your future timeline you want to change project the Full Reiki Sandwich onto that part (or parts). Visualize or imagine the infinite wisdom of Reiki dissolving the unwanted part of your future and replacing it with a new more positive, enriching and fulfilling part.<br>
      </p>
      <p>&nbsp;</p>
      <p>Look back along your timeline again and feel, sense, imagine, visualise a happier more fulfilling future. Envelop your timeline in the healing guiding light of Reiki. Now look back at the wise old person you will become.<br>
          Notice the future you has a gift for you. It may be words of wisdom or something that is very important to you on a personal level. Take your gift and give thanks to your future self for this wonderful present. Take a moment to assimilate and really appreciate this wonderful gift you have received.</p>
      <p>&nbsp;</p>
      <p>Gently float back along your timeline to the present you reviewing your new future timeline along the way until you come to a stop above yourself in the present time.<br>
          Look back into your past, see a younger y ou who once anticipated the present you. Send Reiki back with its infinite wisdom. Then look into your future and see the future you who is expecting you. Send Reiki into the future.<br>
      </p>
      <p>&nbsp;</p>
      <p>Gently float back down through the opening in your crown chakra. Bring your awareness and your gift back down to your heart chakra beneath your hands.<br>
          Place the gift you received from your future wise self into your heart chakra. Feel, sense, experience the new you. Use this gift wisely. Allow the process of Transeformation and change to begin.<br>
          Complete the Reiki treatment by finishing all the self healing hand positions. At your own time and place gently open your eyes.<br>
          Timeline Reiki can be adapted to be used with other people.</p>
      <p>&nbsp;</p>
      <p>Lesson 18: Animal Reiki Technique<br>
      </p>
      <p>Reiki can be used on every living thing for healing, personal development, deep relaxation and stress relief.<br>
          Animals are particularly receptive to Reiki Energy. As an Advanced Reiki Practitioner we now have the tools and techniques to develop further how we use Reiki on Animals.<br>
          Animal Reiki is an extremely popular and rewarding niche, that more and more reiki practitioners are adding to their Reiki Practice.<br>
      </p>
      <p>Reiki is a very effective therapy for Animals for exactly the same reasons it works well on people.<br>
          Animals respond positively to Reiki and you can really help your family pets as well as other animals feel so much better and help them to recover from illnesses, diseases, through labor and from past neglect or abuse.<br>
      </p>
      <p>You can give Reiki to animals in a number of situations:<br>
          When they are ill: Reiki helps the healing process and works with yany type of medical veterinary intervention.<br>
          When they are young or old. You can use Reiki on an animal of any age or situation.<br>
          When they have been through a trauma: Animals can use loving energy after they've experienced any type of abuse, loss or move, or if they seem to exhibit depression or other behavioural disorder.<br>
          Even if you don't know what the problem is, you can use Reiki to help.</p>
      <p>&nbsp;</p>
      <p>Rapport and Communicating with Animals:<br>
          Animals respond differently to Reiki depending on their type of illness, personality, and how well they know and trust you. There are a number of key indicators to look for so you can better understand and intuitively read if you are in rapport with the animal and it is safe and ok to perform Reiki on the animal. They are as follows:<br>
          An animal may abrk, growl, screech, fly, hiss, buck or run away as a way of tell you id doesn't want to be touched. If this happens and you know the animal is sick or in pain and needs Reiki then you can still treat the animal by using distant Reiki or the zapping or beaming techniques.<br>
      </p>
      <p>An animal may let you perform hands-on Reiki but then after a while shift positions or look at you funny. Move your hands a few inches above the body, scan the aura and other parts of the animals body and continue treating the animal with Reiki, if you intuitively feel that it's still needed.<br>
          An animal may tell you it wants Reiki by coming near you when you are giving Reiki to yourself or someone else.<br>
      </p>
      <p>If you at anytime sense a change in the animal mood or energy and are concerned for your own safetly, stop the treatment immediately and continue sending reiki from a safe distance.<br>
          Remember all these suggestions are just guidelines, it is key that you use your intuition and just go with what you are drawn to do. The animal will sense your positive loving energy towards it and respond accordingly.<br>
      </p>
      <p>Preparing to Treat an Animal with Reiki:<br>
          If you feel comfortable or get an intuitive message to get closer to an animal, you can then try performing Reiki with your hands hovering above the pet. Moving gradually into an actual hands-on session.<br>
          Adapt the Reiki 1 &amp; Reiki 2 techniques for treating animals. Because animals can't give their express permission for you to perform Reiki, make sure you approach any animal in a slow and respectful manner when starting to give Reiki.<br>
          Doing so gives the animal the opportunity to understand what you are doing and lets the animal make his feelings known.</p>
      <p>&nbsp;</p>
      <p>You may want to start by beaming Reiki to the animal from across the room or sending distant Reiki. These distant techniques may be sufficient for treating animal and the safest for you as a Reiki Practitioner if you are treating large or exotic animals.<br>
          Intention as always is the single most important factor in the success of an Animal Reiki treatment. Your intention should be for the highest level of healing for the animal and that you can be used as a pure channel for the Reiki energy.</p>
      <p>&nbsp;</p>
      <p>Animal Reiki Techniques:<br>
          Distant Reiki: This type of Reiki can be performed from anywhere, so you don't need to be near the animal to do this.<br>
          You can use this technique to treat any trauma on animal might have suffered in the past or to help the animal with any event in the future.<br>
      </p>
      <p>Beaming Reiki from across the room: When you are working with an animal you don't know, start with beaming to connect wiht the animal from a safe distance. You and the animal then get a chance to connect with each other before moving closer. It can also be used as an effective method of treating animals in zoos, aquariums or the wild.<br>
          Reiki with hands hovering over the body: Some pets tolerate this type of Reiki for a longer period of time than hands-on Reiki. Especially smaller pets where the weight of your hands can be uncomfortable, and even painful if they are very ill or depressed.</p>
      <p>&nbsp;</p>
      <p>Hands-on Reiki: You can adapt the standard Human Reiki 1 hand positions for your pets or other animals. While some animals are much smaller, the basic idea of anatomy is the same.<br>
          Group Reiki: For larger animals, especially horses or large dogs, a few people can perform Reiki simultaneously, sending much love and healing at once.<br>
      </p>
      <p>You will discover that when you give Reiki to a sick animal you will also be helping their owner or human companion at the same time. Animal lovers often treat their pets like their own children and get just as distressed when their &quot;baby&quot; is ill or suffering.<br>
          Just like treating a person, Reiki healing can often help on animal to recover from an illness. When nothing else can be done for the animal in the case of just old age for example, Reiki can also help the animal to pass peacefully. Reiki doesn't change the natural order of events, but it can help the transition and can also be used to treat the animals owners with their loss and grief.<br>
      </p>
      <p><br>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p></p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
