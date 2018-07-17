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
      <p>Chapter 4: Chiryo The Third Pillar of Reiki</p>
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
      <p>Chapter 5: Namaste<br>
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
      <p>Chapter 6 : New Possibilities with Reiki 2</p>
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
      <p>Chapter 7: The Sacred Reiki Symbols</p>
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
      <p>Chapter 8: The first sacred symbol - Cho ku Rei</p>
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
