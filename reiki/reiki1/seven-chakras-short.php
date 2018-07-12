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
<title>Rei-ki : Seven Chakras</title>
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
  <h1 class="page-header">Seven Chakras (Short) </h1>
<audio controls>
  <source src="audio/seven-chakras-short.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Here’s a description of the 7 most significant chakras and how to recognize if one of them is blocked:</p>
      <p><strong>1. Root Chakra</strong><br>
          Color: Red<br>
          Element: Earth<br>
          Position: Base of the Spine<br>
          Objective: It corresponds to the physical body and connection to the Earth. Just like a foundation, it is concerned with the basics of survival: food, shelter, safety, comfort and belonging.</p>
      <p><strong>When your Root Chakra is blocked…</strong></p>
      <p>You can tell if your root chakra is closed if you often feel stuck and sluggish<br>
          You experience unrelenting stress because of a belief that you must rely on external circumstances<br>
          You may have persistant financial problems and find yourself in a less-than-ideal career<br>
          You feel you have been abandoned by your parents<br>
          You feel you have to survive life and are constantly getting by or going without<br>
          You hate your body and feel you are not good enough the way you are<br>
          <strong>When your Root Chakra is open…</strong></p>
      <p>You have a strong connection with your family and or friends that are like family to you, and as a result, feel wanted and loved<br>
          You feel like you belong, you are content with your body and are confident with money, managing it well and always having enough for what you need and want<br>
          <strong>2. Sacral Chakra</strong><br>Color: Orange<br>
          Element: Water<br>
          Position: Below the belly button. Looking at the body from head to toe, this is your physical center.<br>
          Objective: Sexuality, the nature of your relationships, freedom from guilt, pleasure, sensation, creativity and the joys of life.</p>
      <p><strong>When your Sacral Chakra is blocked…</strong></p>
      <p>You experience difficulty allowing yourself to become emotionally and sexually intimate<br>
          You believe sex is bad and that it can hurt you, or your feel you have to be sexy to be loved<br>
          You feel abused, hurt, and confused and don’t trust that you can be loved for being you<br>
          You struggle with a healthy self-image<br>
          You move from one relationship to another, desperately trying to find “the one” yet lacking the sense that you are worthy of love<br>
          <strong>When your Sacral Chakra is open…</strong></p>
      <p>You have a strong sense of your sexuality and recognize it as one of your most powerful creative energies<br>
          You create healthy sexual experiences with others that honor you, you enjoy pleasure in many different ways in life<br>
          <strong>3: Solar Plexus Chakra</strong><br>
          Color: Yellow<br>
          Element: Fire<br>
          Position: Above the navel – two inches below the breastbone.<br>
          Objective: Relationship with yourself, personal power, self-esteem, self-worth, and freedom from shame.</p>
      <p><strong>When your Solar Plexus Chakra is blocked…</strong></p>
      <p>You feel like a victim in the world and often feel powerless relative to other people and circumstances<br>
          You give your power away to others as you feel this is necessary to keep peace in relationships<br>
          You will find it difficult to take action on your dreams due to a sense of powerlessness and low self-esteem<br>
          You suffer from stomach pains and stomach anxiety<br>
          <strong>When your Solar Plexus Chakra is open…</strong></p>
      <p>You have a strong sense of your own power and how to use it in healthy ways<br>
          You admire others with power and influence and choose to emulate people who are<br>
          You want to use your power and influence for good in the world<br>
          <strong>4. Heart Chakra</strong><br>
          Color: Green<br>
          Element: Air<br>
          Position: Center of chest<br>
          Objective: Love and spirituality, compassion, emotional zone, masculine/feminine of the self, and forgiveness. Love doesn’t mean only love for others; it also applies to self-love and self-acceptance.</p>
      <p><strong>When your Heart Chakra is blocked…</strong></p>
      <p>You are afraid of commitment and feel like you have to please others to be loved<br>
          You have been hurt by others many times in relationships and now feel like you have to guard yourself from being hurt again<br>
          You have trouble with giving and receiving love and being compassionate<br>
          You hold grudges and become needy in relationships, and this often leads to anger and distrust<br>
          A weak heart chakra can be at the root of heart disease, asthma, and allergies<br>
          <strong>When your Heart Chakra is open…</strong></p>
      <p>You are comfortable in your relationships<br>
          You give and receive love easily, and you feel a heartfelt sense of gratitude for how wonderful your life is<br>
          You appreciate others and feel compassion for yourself and others without feeling sorry for anyone<br>
          <strong>5. Throat Chakra</strong><br>
          Color: Blue<br>
          Element: Sound<br>
          Position: Hollow of throat<br>
          Objective: Your communication center — your voice, your creative self-expression. Speaking your truth, coming from the center of your willpower, listening and being heard.</p>
      <p><strong>When your Throat Chakra is blocked…</strong></p>
      <p>You are afraid to speak up and say what you want or feel<br>
          You go along with others so you don’t upset anyone<br>
          You are frustrated because you don’t feel that other people hear what you have to say<br>
          You get sore throats often and feel like your throat is blocked<br>
          <strong>When your Throat Chakra is open…</strong></p>
      <p>You are comfortable speaking your truth<br>
          You experience others listening to you and you feel that you are heard and honored for your truth<br>
          <strong>6. Third Eye Chakra</strong><br>
          Color: Indigo<br>
          Element: Light<br>
          Position: Between the eyebrows<br>
          Objective: Responsible for psychic abilities such as intuition as well as your sense of purpose in life — self-reflection, visualization, discernment, and trust of your own intuition.</p>
      <p><strong>When your Third Eye Chakra is blocked…</strong></p>
      <p>You struggle with finding meaning in life and oftne ask yourself, “Why am I here?”<br>
          You feel disconnected from your intuition, or don’t feel like you have any<br>
          You have trouble making decisions and you feel lost when it comes to your spiritual purpose and path in life<br>
          You feel frustrated that there is something wrong with you as you feel like other people have this intuitive sense and you don’t<br>
          You get headaches and feel tension in your brow area often<br>
          <strong>When yourThird Eye Chakra is open…</strong></p>
      <p>Your intuition is your constant guide that you trust and act on with confidence<br>
          You have a strong sense of your own inner truth and listen to and follow it as it guides you on your life path<br>
          <strong>7. Crown Chakra</strong><br>
          Color: Violet<br>
          Element: Thought<br>
          Position: Top of the head<br>
          Objective: This is the connection between you and the divine. It is responsible for spirituality, belief systems, revelation, divine consciousness, and enlightenment. Your brain functions and central nervous system are controlled by the crown chakra.</p>
      <p><strong>When your Crown Chakra is blocked…</strong></p>
      <p>You experience loneliness, insignificance, and meaningless<br>
          You may feel a strong attachment to material possessions and achievements (and define yourself according to them) and a disconnect from the spiritual side of life<br>
          You feel no connection or guidance from a higher power, you feel unworthy of spiritual help and are angry that your higher power has abandoned you<br>
          You often suffer from migraines and tension headaches<br>
          <strong>When your Crown Chakra is open…</strong></p>
      <p>You feel connected to a higher power and sense that you are being watched over and cared for<br>
          You know you deserve immense blessings<br>
          You feel immense gratitude for the universal love and appreciation you feel towards yourself and others<br>
          A blockage in one primary chakra causes imbalances in the rest…</p>
      <p>Now, these list of symptoms of blocked chakras can be overwhelming and in some cases even a bit depressing. But remember, you most likely have a blockage in one primary chakra that causes imbalances in the rest.</p>
      <p>That’s why it is important to find out where the main blockage is and what caused it. Then, with simple knowledge and exercises, in the same way a helpful police officer would guid traffic at a congested intersection, you can restore the free flow of energy in your body.</p>
      <p>When the seven chakras are in balance, life feels good and all is as it should be.</p>
      <hr>
      <p><strong>35 Symptoms You Have A Blocked Chakra:35 Symptoms Have A Blocked Chakra</strong><br>
          <strong>The Root Chakra</strong> – Earth Element<br>
          The Root Chakra is represented by the color red and is located at the base of the spine.</p>
      <p>It governs survival and it’s blocked by unmanaged fear.</p>
      <p>When blocked, you feel the following symptoms:</p>
      <p>1. You feel sluggish and stuck in life.</p>
      <p>2. You often find yourself in a financial crisis.</p>
      <p>3. You have feelings of abandonment.</p>
      <p>4. You hate yourself for no important reason.</p>
      <p>5. You are afraid for security.</p>
      <p><strong>The Sacral Chakra</strong> – Water Element<br>
          The color orange represents the Sacral Chakra which is found below the belly button.</p>
      <p>It governs connection and it’s blocked by guilt.</p>
      <p>When there is a blockage in this chakra, you will suffer from the following symptoms:</p>
      <p>6. You are having trouble with intimacy.</p>
      <p>7. You feel being compulsive, abused, or you might be the one who does the abuse to yourself.</p>
      <p>8. You believe that sex is bad.</p>
      <p>9. You see yourself negatively.</p>
      <p>10. You lack connection with others.</p>
      <p><strong>The Solar Plexus Chakra</strong> – Fire Element<br>
          Yellow represents the Solar Plexus Chakra. It is located at the navel, just two inches below the breastbone.</p>
      <p>It governs power and it’s blocked by shame.</p>
      <p>When there is a blockage, you will suffer from the following symptoms:</p>
      <p>11. You feel like you are a victim of the world’s circumstances.</p>
      <p>12. You easily give in to the whims of other people.</p>
      <p>13. You lack self esteem and unable to go on with your dreams and passions.</p>
      <p>14. You seek approval of others.</p>
      <p>15. You associate your self worth with the value others give you.</p>
      <p><strong>The Heart Chakra</strong> – Air Element<br>
          The color green represents the Heart Chakra that is located at the center of the chest.</p>
      <p>It governs love and it’s blocked by grief.</p>
      <p>Once blocked, the following symptoms are imminent:</p>
      <p>16. You are afraid to commit yourself.</p>
      <p>17. You feel you have to guard yourself from love for the fear of getting hurt.</p>
      <p>18. You are resentful.</p>
      <p>19. You don’t feel a sense of purpose and meaning.</p>
      <p>20. You don’t feel joy.</p>
      <p><strong>The Throat Chakra</strong> – Sound Element<br>
          The color blue symbolizes the Throat Chakra that is located in the hollow of the throat.</p>
      <p>It governs expression and it’s blocked by lies.</p>
      <p>When there is a blockage, you are likely to suffer from the following symptoms:</p>
      <p>21. You find it hard to speak up for yourself and make your point.</p>
      <p>22. You try to please everyone.</p>
      <p>23. You feel frustrated when others seem not to listen to you.</p>
      <p>24. You lie often.</p>
      <p>25. You speak too fast or don’t know when to stop.</p>
      <p><strong>The Third Eye Chakra</strong> – Light Element<br>
          The Third Eye Chakra is symbolized by the indigo color and is located between the eyebrows.</p>
      <p>It governs perception and it’s blocked by illusions.</p>
      <p>You will suffer from the following problems when there is a blockage in that area.</p>
      <p>26. You find it difficult to find the meaning in your life.</p>
      <p>27. You can’t sense your intuition.</p>
      <p>28. You find making decisions a daunting task.</p>
      <p>29. You overthink.</p>
      <p>30. You can’t listen to your inner wisdom.</p>
      <p><strong>The Crown Chakra</strong> – Thought Element<br>
          Violet is the color of the Crown Chakra that is found at the top of the head.</p>
      <p>It governs ascension and it’s blocked by attachment.</p>
      <p>When it is blocked, the following symptoms are manifested:</p>
      <p>31. You feel disconnected from the spiritual world and more attracted to the material world.</p>
      <p>32. You don’t feel the guidance of the Higher energy.</p>
      <p>33. You often have headaches and migraines.</p>
      <p>34. You feel stuck at a pattern of bad decisions.</p>
      <p>35. You are scared of change.</p>
      <p>Bear in mind that an imbalance in one chakra affects the other chakras. This results to suffering from multiple blockages symptoms.</p>
      <p>To solve this, you need to find the primary blockage and restore its flow of energy. You can do this by developing spiritual knowledge in the healing processes.</p>
      <hr>
      <p><strong>Root Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Cold feet, eczema, constipation, anorexia, addictive behavior, kidney stones, frequent urination, migraines, hypertension, haemorrhoids, prostate/rectal cancer, skin disorders.</p>
      <p>Emotional – Fear, tension, rage, anger, fear of abandonment, uncertainty, anxiety, blaming others, inability to flow with life, afraid to let go, grudges, numbness.</p>
      <p><strong>Sacral Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Frigidity, menstrual problems, impotency, bedwetting, irritable bowel syndrome, cystitis, ovarian cysts, muscle cramps and spasms, miscarriages.</p>
      <p>Emotional – Neediness, rigid beliefs, tension, anger, feelings of repression, aches and pains, believing sex is bad, blaming others, punishing one’s mate, sexual frustration, bitterness, inadequacy.</p>
      <p><strong>Solar Plexus Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Fatigue, gas, food allergies, hepatitis, shingles, jaundice, anemia, gastritis, abdominal cramps, hyper acidity, peptic ulcers, gall stones.</p>
      <p>Emotional – Low self-esteem, chronic complaining, feelings of rejection, shame, powerlessness, finding fault in others constantly, justifying bad behavior, fear, lack of belief in oneself, feelings of dread and doom.</p>
      <p><strong>Heart Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – High blood pressure, pneumonia, asthma, hyperventilation, sleep disorders, fatigue, breast cancer, bronchitis, immune disorders.</p>
      <p>Emotional – Self-victimization, grief, hopelessness, desperation, difficulty in giving and receiving, despair, suppression of crying, world-wariness, feeling stifled.</p>
      <p><strong>Throat Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Stiff neck, hearing problems, hay fever, hoarseness, teeth and gum problems, tonsillitis, asthma, bronchitis, ear infections, colds, thyroid issues.</p>
      <p>Emotional – Social anxiety, repressed emotions, self-victimization, stubbornness, persecution-complex, erupting emotions, resentment, bitterness, anger, stress, stifled creativity.</p>
      <p><strong>Third Eye Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Chronic fatigue, dizziness, hormonal imbalance, anxiety disorders, headaches, high blood pressure, cataracts, dyslexia, insomnia, amnesia, body-image disorders, sinus problems, mental fogginess.</p>
      <p>Emotional – Depression, anger, feelings of isolation, emotional instability, self-centeredness, grudge-holding, self-criticism, inability to cope with stress.</p>
      <p><strong>Crown Chakra</strong><br>
          Signs of imbalance:</p>
      <p>Physical – Insomnia, depression, Alzheimer’s disease, neurosis, psychosis, headaches, schizophrenia, cancer, epilepsy, dizziness, light sensitivity.</p>
      <p>Emotional – Existential depression, cynicism, self-righteousness, mistrust, fear, hatred, aimlessness, narrow-mindedness, god-complex.</p>
      <hr>
      <p>The system of chakras in the human body is quite important as it is a channel through which we can clearly understand the interconnectedness of the physical body and spiritual body.<br>
          The English word for the Sanskrit word chakra is ‘wheel’. Such a name is given because every connection of chakra is in turn linked to the next in a manner that it creates a loop of energy surrounding the body.</p>
      <p>When you are troubled by illness in some part of your body, then there will be a correlated block or weakness in your chakras. If you are aware of the connections of the body parts with the chakras, you can better address the energy source of physical and emotional ailments.</p>
      <p>Here is how to recognize if a chakra is blocked:</p>
      <p><strong>1. Root Chakra</strong><br>
          Color: Red</p>
      <p>Element: Earth</p>
      <p>Position: Base of the spine</p>
      <p>How to identify blockage:</p>
      <p>If you feel stuck and sluggish, then your root chakra is closed.<br>
          You are facing unending financial problems.<br>
          You feel abandoned by your parents.<br>
          You hate your own self.<br>
          <strong>2. Sacral Chakra</strong><br>
          Color: Orange</p>
      <p>Element: Water</p>
      <p>Position: Below the belly button</p>
      <p>How to identify blockage:</p>
      <p>You are facing trouble in being sexually intimate.<br>
          You feel abused and confused.<br>
          You think that sex is bad<br>
          You see yourself in a negative light<br>
          <strong>3. Solar Plexus Chakra</strong><br>
          Color: Yellow</p>
      <p>Element: Fire</p>
      <p>Position: Above the navel, two inches below breastbone</p>
      <p>How to identify blockage:</p>
      <p>You always feel like a victim to the situations in the world.<br>
          You give away your powers to others<br>
          You find it difficult to follow your dreams and passions due to lack of self-esteem.<br>
          <strong>4. Heart Chakra</strong><br>
          Color: Green</p>
      <p>Element: Air</p>
      <p>Position: Center of chest</p>
      <p>How to identify blockage:</p>
      <p>You are afraid of commitment<br>
          You have been hurt in the relationships previously and now you always think about guarding yourself.<br>
          A weak heart chakra can also be a root of heart diseases.<br>
          <strong>5. Throat Chakra</strong><br>
          Color: Blue</p>
      <p>Element: Sound</p>
      <p>Position: Hollow of Throat</p>
      <p>How to identify blockage:</p>
      <p>You are afraid of speaking up and making your point.<br>
          You try to please everyone and thus go along with everything.<br>
          You feel that others do not listen to you and thus you feel frustrated.<br>
          <strong>6. Third Eye Chakra</strong><br>
          Color: Indigo</p>
      <p>Element: Light</p>
      <p>Position: Between the eyebrows</p>
      <p>How to identify blockage:</p>
      <p>You struggle to find meaning in your life and often ask yourself, “Why am I here?”<br>
          You do not feel any intuition.<br>
          You have trouble making decisions.<br>
          <strong>7. Crown Chakra</strong><br>
          Color: Violet</p>
      <p>Element: Thought</p>
      <p>Position: Top of the head</p>
      <p>How to identify blockage:</p>
      <p>You feel strong attraction towards material things and feel disconnected from the spiritual world.<br>
          You do not feel the presence of the higher guiding energy.<br>
          You often suffer from headaches and migraines.<br>
          It is pertinent to note that if one primary chakra experiences imbalance, then all other chakras gets affected as well. So, do not get overwhelmed if you have symptoms of multiple blockages. The reason for many symptoms is that one chakra is blocked and others are also affected by it.</p>
      <p>So, the main goal should be to find that primary blockage. Spiritual knowledge and exercises can help to restore the flow of energy.</p>
      <p>&nbsp;</p>
      <p></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
