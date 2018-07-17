<?php
if (!isset($_SESSION)) {
  session_start();
}
include('../init.php');

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
  <h1 class="page-header">Seven Chakras & Endocrinology</h1>
<audio controls class="my-audio">
  <source src="audio/seven_chakras.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p><strong>Seven Chakras</strong> are:</p>
      <ol>
          <li><strong><a href="#root">Root chakra</a></strong> (<a href="chakras_root.php">Muladhara</a>) — base of the spine — <strong>red</strong> <br>
              The first one to the perineum, in the coccyx area</li>
          <li><strong><a href="#sacral">Sacral chakra</a></strong> (<a href="chakras_sacral.php">Svadhishthana</a>) — just below the navel — <strong>orange</strong> <br>
The second one to the lower belly, seen a few inches below the navel </li>
          <li><strong><a href="#solarplexus">Solar Plexus chakra</a></strong> (<a href="chakras_solarplexus.php">Manipura</a>) — stomach area — <strong>yellow</strong> <br>
The third one to the solar plexus (actually few inches below real solar plexus) </li>
          <li><strong><a href="#heart">Heart chakra</a></strong> (<a href="chakras_heart.php">Anahata</a>) — center of the chest — <strong>green</strong> <br>
The fourth one to the center of the chest, slightly to the left of the physical heart</li>
          <li><strong><a href="#throat">Throat chakra</a></strong> (<a href="chakras_throat.php">Vishuddha</a>) — base of the throat — <strong>blue</strong> <br>
The fifth one to the throat, at the carotid plexus </li>
          <li><strong><a href="#thirdeye">Third Eye chakra</a> </strong> (<a href="chakras_thirdeye.php">Ajna</a>) — forehead, just above area between the eyes — <strong>indigo</strong> <br>
The sixth one to the point between the eyebrows or “third eye” </li>
          <li><strong><a href="#crown">Crown chakra</a></strong> (<a href="chakras_crown.php">Sahasrara</a>) — top of the head — <strong>violet</strong> <br>
The seventh one to the top of the cranium</li>
          </ol>
      <p><a href="#opening">Opening Your Chakras </a>(<a href="chakras_opening.php">Another Link</a>) </p>
      <hr>
      <p><img src="images/seven-chakras.jpg" class="img-responsive"></p>
      <p><img src="images/endocrine-system1-.jpg" class="img-responsive"></p>
      <p><img src="images/chakraendocrine.PNG" class="img-responsive"></p>

      <hr>
      <p>&nbsp;</p>
      <p>The 7 chakras are part of the most commonly known chakra system made of seven energy centers located along the spine and ending in the brain, from the perineum area to the top of the head.</p>
      <p>A chakra blockage and imbalance in one or several of 7 chakras can initiate mental, emotional, physical and/or spiritual ailments. Regardless of whether you use chakra stones, crystals, reiki, or another form of vibrational healing to restore chakra balance, being well-versed about chakra systems, their function, and the areas they govern can be invaluable.</p>
      <p>Balancing chakras and healing with the chakra energy system requires a working knowledge of chakras and their functions.</p>
      <p><strong>Want Healthier and Happier Chakras?</strong><br>
          When properly balanced each of your 7 Chakras work together to create an optimal life. If you are like most of us your energetic ecosystem could use some help.</p>
      <hr>
      <p><strong>ROOT CHAKRA</strong><a name="root"></a></p>
	  <p>Located between the genitals and the anus, the Root Chakra deals with the issues surrounding identity, survival, connection to Earth, and tribal issues. When this chakra is imbalanced, there are fears around survival, being provided for, and financial and family (or group) security.</p>
	  <p>

Blockage in this area often happens following traumatic events, family problems, and major life changes. There may also be chronic lower back pain, sciatica, immune-related disorders, addictions, varicose veins, constipation, diarrhea, rectal/anal problems, impotence, water retention, and problems with groin, hips, legs, knees, calves, ankles, and feet.</p>
	  <p>

When Reiki is performed at the Root Chakra, we have a better sense of feeling grounded and supported and begin to find relief from many of these chronic ailments.</p>
	<hr />
      <p><br>
          A. ROOT CHAKRA BASICS<br>
          B. ROOT CHAKRA SYMBOL<br>
          C. OVERACTIVE ROOT CHAKRA<br>
          D. BLOCKED ROOT CHAKRA<br>
          E. OPENING YOUR ROOT CHAKRA<br>
          F. ROOT CHAKRA HEALING<br>
      </p>
      <p>A. ROOT CHAKRA BASICS</p>
      <p><a href="images/Root-Chakra-Healing-1.jpg" target="_blank"></a><br>
          The root chakra is the first chakra. Its energy is based on the earth element. It’s associated with the feeling of safety and grounding. It’s at the base of the chakra system and lays the foundation for expansion in your life.</p>
      <p>Where is the Root Chakra?<br>
          The first chakra or root chakra is located at the base of the spine. The corresponding body locations are the perineum, along the first three vertebrae, at the pelvic plexus. This chakra is often represented as a cone of energy starting at the base of the spine and going downward and then slight bent up.</p>
      <p>Key characteristics of the root chakra<br>
          The first chakra is associated with the following functions or behavioral characteristics:</p>
      <p>Security, safety<br>
          Survival<br>
          Basic needs (food, sleep, shelter, self-preservation, etc.)<br>
          Physicality, physical identity and aspects of self<br>
          Grounding<br>
          Support and foundation for living our lives<br>
          The root chakra provides the foundation on which we build our life. It supports us in growing and feeling safe into exploring all the aspects of life. It is related to our feeling of safety and security, whether it’s physical or regarding our bodily needs or metaphorical regarding housing and financial safety. To sum it up, the first chakra questions are around the idea of survival and safety. The root chakra is where we ground ourselves into the earth and anchor our energy into the manifest world.<br>
      </p>
      <p>&nbsp;</p>
      <p>What happens when the first chakra is imbalanced<br>
          At the emotional level, the deficiencies or imbalance in the first chakra are related to:<br>
      </p>
      <p>Excessive negativity, cynicism<br>
          Eating disorders<br>
          Greed, avarice<br>
          Illusion<br>
          Excessive feeling of insecurity, living on survival mode constantly<br>
          For a person who has imbalance in the first chakra, it might be hard to feel safe in the world and everything looks like a potential risk. The desire for security dominates and can translate into concerns over the job situation, physical safety, shelter, health. A blocked root chakra may turn into behaviors ruled mainly by fear.</p>
      <p>On the same line, when the root chakra is overactive, fear might turn into greed and paranoia, which are extreme forms of manifestation of imbalance in the first chakra. Issues with control over food intake and diet are related to it.</p>
      <p>&gt;&gt; Find out more ideas for healing the root chakra</p>
      <p>Opening the root chakra<br>
          There are many ways to open your root chakra. For example, you can engage more in grounding and earth-related activities (for example, connection with nature, gardening, cooking healthy, hiking).</p>
      <p>&nbsp;</p>
      <p>The main idea is to work at growing your ”roots” in a safe and comfortable environment (i.e., surround yourself with earth colors, objects reminding you of nature, stability; or on the contrary, if you wish to feel less stuck, do the opposite).<br>
          Yoga for the root chakra can be a more physical way to bridge the body and mind and restore a more balanced energy flow.</p>
      <p>What’s in the Muladhara or root chakra name?<br>
          The first chakra is referred to as:</p>
      <p>Root chakra<br>
          Muladhara<br>
          Adhara<br>
          Its sanscrit name is ”muladhara” can signify “base”, ‘foundation”, “root support”.</p>
      <p>The first chakra is associated with the Earth element.</p>
      <p>Chakra colors: The red chakra<br>
          The typical color used to represent the root chakra is a rich vermilion red. This is the color used on its symbol to fill its petals. Traditionally, it is also associated with the color yellow or gold (this is the color of its element as opposed to its petals). In the spectrum of chakra colors, red symbolizes strength, vitality, and stimulates our instinctual tendencies.</p>
      <p>Root chakra symbol<br>
          The symbol of the root chakra is composed of a four-petaled lotus flower, often stylized as a circle with four petals with a downward-pointing triangle.</p>
      <p>The downward-pointing triangle is a symbol of spirit connecting with matter, grounding on the earth and our earthly existence, in our bodies. It’s seen as the center of our vital life force and is the seat where kundalini stays coiled, dormant, until is wakes up to distribute its energy through all the other chakras.<br>
      </p>
      <p>B. ROOT CHAKRA SYMBOL<br>
          The intricate symbol for the root chakra or Muladhara in Sanskrit contains multiple images with linear meanings. Always illustrated as red — the color of vitality and awakening — it is governed by the element of earth and Lord Shiva, the Hindu god of vitality, destruction, and regeneration. Depicted as the “Master of Animals,” Lord Shiva governs the root chakra with the help of wise, powerful animals.</p>
      <p>Animal symbolism associated with the root chakra<br>
          Historically revered as a symbol meaning wisdom and strength, the elephant represents the root, or Muladhara, chakra. In various spiritual traditions, from Hinduism to Shamanism, the elephant is symbolic of compassion, intelligence, confidence, and ancient wisdom. All of which are representative of the base chakra and the Kundalini energy it houses.</p>
      <p>&nbsp;</p>
      <p>The image within the first chakra symbol, the elephant possesses seven trunks — each symbolizing the seven treasures of the earth — as recognized by Ayurveda, the system of Hindu medicine. The seven treasures, crucial to sustaining life, are:<br>
          Rasa (plasma)<br>
          Rakta (blood)<br>
          Mamsa (muscles)<br>
          Meda (fat)<br>
          Ashti (bone)<br>
          Majja (bone marrow)<br>
          Shukra (semen)</p>
      <p>&nbsp;</p>
      <p>The serpent is most the widely recognized image associated with the root chakra. As a symbol meaning wisdom and power, the serpent rests within the chakra coiled upon itself three and a half times. The three coils may represent the three states of consciousness as well as the past, present, and future. The half coil represents transcendent consciousness or time, depending on which interpretation you go with.<br>
          Symbols of the Awakening the Mind<br>
          Two remaining elements of the Muladhara chakra symbol are the lotus flower and inverted triangle.</p>
      <p>The root chakra image is surrounded by four red lotus petals — each representing a different element of the human psyche, which are:</p>
      <p>mind<br>
          intellect<br>
          consciousness<br>
          ego<br>
          Housed within the root chakra symbol is an upside down triangle with a dualistic meaning. The most common explanation is the downward cone shape is indicative of the funneling of knowledge to the seed (the triangle’s point) out of which wisdom and spiritual awakening sprouts. From the other direction, the triangle’s sides are symbolic of the broadening of one’s consciousness.<br>
      </p>
      <p>C. OVERACTIVE ROOT CHAKRA<br>
          When your root chakra is in overdrive, the one thing you abhor is change. The key is to familiarize yourself with the signs and symptoms of an overactive first chakra. Once you recognize what is amiss, the next step is learning about root chakra healing techniques to restore balance and foster your overall well-being.</p>
      <p>Risks of Excess of Energy in the Root Chakra<br>
          As the chakra located at the base of the spine, your first energy center is home to the raw, static energy of life. Raising and channeling this energy not only boosts your overall health, but plays a pivotal role in spiritual awakening.</p>
      <p>As the chakra of grounding, the first chakra governs your inner sense of security and place in this world. An overactive root chakra can trigger extreme feelings of insecurity. In an effort to rekindle the security you once felt within the core of your being, you now cling to outside influences to compensate or fill the void.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>The color red is associated with the first chakra for more than one reason. Yes, red is the color of energy, love, and power. However, it is also associated with negativity, which can come out in full force when the root chakra is overactive.</p>
      <p>Signs of Overactivity in the Root Chakra<br>
          Symptoms of an overactive root chakra can adversely affect your physical, emotional, and spiritual well-being. When the root chakra is balanced you are grounded, in control, and at ease. When the chakra is imbalanced, it is not uncommon to become easily annoyed with people and situations, lash out at others, or become materialistic.</p>
      <p>If this chakra is overly open, excessive attachments may develop and lead to rigidity in our body and behavior. “We may be obsessed with money and possessions or our health, unable to allow change or to let go, and as a result we get stuck in the same routines, same old job, same old patterns”  (Anodea Judith on excess in the root chakra).</p>
      <p>Physical symptoms of over-activity can include bladder problems, constipation, fatigue, and anemia.</p>
      <p>Among the most common non-physical signs the root chakra is too active include:</p>
      <p>anger<br>
          short temper<br>
          greediness<br>
          belligerence<br>
          impatience<br>
          feeling stuck</p>
      <p>Cleansing and Balancing an Overactive Root Chakra<br>
          If your first energy center is over-active, chakra healing for the root chakra can help alleviate issues and restore energy balance.</p>
      <p>Depending on the severity of the chakra imbalance, simply adjusting your diet, getting enough exercise, and incorporating meditation into your routine can restore chakra balance. Yoga benefits the root chakra and its overall balance, especially when dealing with an overly active center. Calming and low impact exercise tends to counter-balance the excess of energy. Energy healing, such as Reiki, sound therapy or using chakra stones, can also help the process along.</p>
      <p>What Others Say About Having An Excessive Root Chakra<br>
          Abandonment during the formative years often results in an excessive first chakra— one that overcompensates by clinging to security, food, loved ones, or routines.</p>
      <p>Source: Judith, Anodea (2011-03-16). Eastern Body, Western Mind: Psychology and the Chakra System As a Path to the Self.</p>
      <p>There may be a hardness about the person’s character. He likes routine, security, and possessions, and may be driven toward financial achievement. He may appear cynical about spiritual subjects, preferring the concrete. His appearance may be meticulous, well-dressed, and well-groomed. Movements, when they occur, may be repetitive or compulsive. His boundaries are overformed, more like brick walls. He complains about being stuck.</p>
      <p>Judith, Anodea (2011-03-16). Eastern Body, Western Mind: Psychology and the Chakra System As a Path to the Self</p>
      <p>More Resources About The Root Chakra<br>
          Want to learn more about how the root chakra works and dive deeper in understanding how this energy center impacts your life? Here are more resources to help along the way. Enjoy!</p>
      <p>&nbsp;</p>
      <p>D. BLOCKED ROOT CHAKRA<br>
          When your root chakra is blocked you don’t feel at home… anywhere. As the base chakra, it significantly impacts your sense</p>
      <p>of security in life. When this energy center is open and balanced you feel at home, stable, and able to take on life’s challenges. You have clear focus, a sense of purpose, and are always “present” in the moment. However, if this chakra is blocked, the security gives way to doubt, fear, and your emotional and physical well-being suffers.</p>
      <p>Symptoms of Blockage in the Root Chakra<br>
          A blocked root chakra not only creates an imbalance in energy flow throughout the body, but it can also instigate feelings of restlessness. You may feel like you’re constantly searching for an elusive something that you can’t even identify.</p>
      <p>Individuals with a blocked root chakra find it difficult to “settle down” with anything, including where they want to live and work. Even their personal relationships are impacted.</p>
      <p>&nbsp;</p>
      <p>Characteristics common to those with a blocked root chakra are:<br>
          lack of focus<br>
          co-dependency<br>
          restlessness<br>
          feeling abandoned<br>
          In addition to the vagabond-like mentality a blocked root chakra creates is the issue of the physical and emotional toll the blockage takes.</p>
      <p>Common physical signs of blockage involve the lower parts of the body, especially legs and genital area. The root chakra primarily governs the reproductive organs and lower extremities, including the lower spine, legs, and feet. The chakra blockage will often replicate itself manifesting as constipation, kidney stones, circulatory issues, and leg weakness. Additional physical signs can include:</p>
      <p>sciatica<br>
          hypertension<br>
          impotence<br>
          colitis<br>
          eating disorders<br>
          prostate issues in men</p>
      <p>Common non-physical signs of blockage include:<br>
          depression<br>
          anxiety<br>
          fearfulness<br>
          guilt<br>
          resentment<br>
          Solutions for opening a closed Root Chakra<br>
          Techniques for opening a blocked root chakra can range from physical activity to meditation and energy healing.</p>
      <p>Any physical activity can help unblock this energy center, from walking to doing chores around the house, and even yoga and dancing. Beneficial yoga poses for the root chakra engage your legs and muscles around the perineum. For example, “Standing Forward Bend” (or “Uttanasana” in Sanskrit) stretches the legs and hips fostering a more stable grounding and opening of the root chakra. Remember, no matter which physical activity you chose, the key is to be present in the moment and aware of your movement.</p>
      <p>Meditating on the root chakra can also open this energy center. There are numerous meditation resources available online.</p>
      <p>Check out our healing tips for the root chakra or seek assistance from an energy healer to supplement your clearing efforts. The chakra energy test will also help pinpoint blockages and imbalances.</p>
      <p>What Others Say About Blockages In The Root Chakra<br>
          Here are selected quotes to shed light on what it means when imbalance takes place in this chakra.</p>
      <p>When a young infant faces danger or neglect, it forces him to fall back on himself— an independence which is developmentally impossible. Instead the child falls into an intolerable pit of fear and helplessness— the experience of having no ground. When this happens, the downward current of energy is blocked. Instead, the life force moves toward the upper chakras, which feel safer. The upward movement then becomes habitual, depleting the lower chakras and sending the system out of balance.</p>
      <p>Source: Judith, Anodea (2011). Eastern Body, Western Mind: Psychology and the Chakra System As a Path to the Self. Potter/TenSpeed/Harmony.</p>
      <p>The Mūlādhāra Chakra is the seat of the unconscious. It is like a dark, locked cellar whose hidden contents we have only a vague idea about. Perhaps there are precious stones, or perhaps poisonous scorpions or snakes. When a snake is sleeping, therefore in an unconscious state, it appears to be peaceful and harmless, but in a wakeful state it can be extremely menacing and dangerous. (…) One question that is often raised is whether it would be better to allow the unconscious to remain buried rather than to stir it up. The answer is that we can only attain freedom when everything that we have carried with us since the beginning of our existence is brought up into the light. Further spiritual development is only possible when everything we have amassed has been processed and purified, and all obstacles from the past removed; it is only when our vision is clear that we are able to recognise the path that will lead us towards realisation.</p>
      <p>Source: Paramhans Swami Maheshwarananda (2012). The Hidden Power in Humans – Chakras and Kundalini.  International Sri Deep Madhavananda Ashram Fellowship.</p>
      <p>Related Searches<br>
          Want to learn more about how the root chakra works and dive deeper in understanding how this energy center impacts your life? Here are additional resources to help on the way.</p>
      <p>E. OPENING YOUR ROOT CHAKRA<br>
          The root chakra or Muladhara is home to your primal energy. Located at the base of the spine, it is associated with your most basic survival needs.</p>
      <p>The first chakra governs the bladder, kidneys, lower extremities, and spine. When there is an imbalance, you can experience physical symptoms that include:</p>
      <p>constipation<br>
          weight issues<br>
          fatigue<br>
          back pain<br>
          Emotionally speaking, when the first chakra is in need of healing, you may find you’re short-tempered and unusually aggressive. Other signs you need to open up the root chakra are:</p>
      <p>&nbsp;</p>
      <p>insecurity<br>
          poor decision making<br>
          anxiety<br>
          detachment<br>
          Symbolized by the color red, the root chakra fosters confidence and security when it is opened and balanced. However, when it is in need of healing, there are several simple exercises and steps you can take to restore balance.</p>
      <p>Stand<br>
          When you’re feeling less than grounded stand with your feet shoulder-width apart and relax your upper body. Let your arms rest comfortably at your sides and allow your hips to rest slightly forward. Breathe deeply and with each exhale feel your connection to the earth deepen.</p>
      <p>Rinse Off<br>
          Simply taking a shower can help cleanse and balance the root chakra. Be aware of your physical body as you bathe, Mindful awareness is a tremendous tool for healing the first chakra.</p>
      <p>Get Moving</p>
      <p>Everyday physical movement, from running to completing chores around the house, is a great way to heal your root chakra. The key is to be aware of your body and feel the sensation of movement. Awareness is crucial to healing.<br>
          Mindful Walking<br>
          Whether you are walking out in nature or down a crowded city street, be aware of every step you take. Concentrate on your breath and every footfall. With every step take note of the sensation you feel each time your foot touches the ground. Mindfulness of something as mundane as walking can activate the root chakra and ground you to the earth.</p>
      <p>Visualize Red<br>
          Wearing the color red or incorporating it into the decor of your home environment or workspace is a gentle reminder to be aware of the primal, core energy of your root chakra. You can even take this one step further by visualizing, or meditating on, the color red. For instance, take a few seconds or even a few minutes to visualize a radiant, red ball of energy at the base of your spine. See it brighten and radiate downward as it illuminates your lower extremities and grounds you.</p>
      <p>Strike a Pose<br>
      </p>
      <p>Dancing is a great way to open up your root chakra. Whether you dance in public or behind closed doors, the key is to let the rhythm guide you. Allowing the body to be free to move uninhibited will dispel negativity, open and balance the first chakra.<br>
          Stretch and Don’t Forget to Breathe<br>
          Adopting a regular yoga routine is another great tool to open up, heal, and balance the root chakra. Introducing simple forward bends and standing positions can help stretch your legs, back and spine giving you a strong foundation. To ground yourself and activate your root chakra, try these poses to foster balance and focus:</p>
      <p>Tree (Vrksasana)<br>
          Eagle (Garudasana)<br>
          Mountain (Tadasana)<br>
          Downward-Facing Dog (Adho Mukha Svanasana)<br>
          Wide-Legged Forward Bend (Prasarita Padottanasana)<br>
      </p>
      <p>F. ROOT CHAKRA HEALING<br>
          6 Simple Root Chakra Healing Techniques</p>
      <p><a href="images/Root-Chakra-Healing-1.jpg" target="_blank"><img src="images/Root-Chakra-Healing-1.jpg" alt="Root Chakra"  class="img-responsive"></a></p>
      <p>Root chakra healing fosters proper energy flow throughout the body giving the chakra system a firm foundation on which the other energy centers may function. When the first chakra is blocked or somehow off balance, it is not uncommon to exhibit uncharacteristic behaviors, like paranoia, being short-tempered or aggressive. Healing your root chakra empowers you to confidently face whatever life may bring.</p>
      <p>&nbsp;</p>
      <p>In this article, you’ll learn about:<br>
          Understanding the root chakra<br>
          Why healing your first chakra?<br>
          Healer’s cheat sheet<br>
          Common symptoms addressed by root chakra healing<br>
          How to heal the root chakra<br>
          Key steps for in-depth healing of the root chakra<br>
          Useful questions to guide the process<br>
          References and quotes<br>
          Understanding The Root Chakra<br>
          The root chakra is sometimes referred to as the Muladhara chakra — for its feminine energy. Known as the seat for raw energy, known as Kundalini, the Muladhara chakra is the first of seven chakras located at the base of the spine.</p>
      <p>It governs the functioning of the lower part of the body, including the bladder, kidneys, lower spine and back. Psychologically, it governs confidence and survival instincts, like “fight or flight.”</p>
      <p>Red is the widely accepted chakra color associated with the root chakra. According to energy healers, the root chakra may also be associated with the colors brown, black, and gray.</p>
      <p>Why Healing The Root Chakra?<br>
          When the root chakra is functioning optimally, you feel grounded, secure, and at ease with the world. But when it is imbalanced or blocked several signs can manifest, from constipation to back pain and fatigue.</p>
      <p>Additional physical and psychological signs can include:</p>
      <p>Feelings of insecurity<br>
          Aggressiveness<br>
          Sexual dysfunction<br>
          Anger<br>
          Restlessness<br>
          Eating disorders</p>
      <p>Root Chakra Healing Cheat Sheet</p>
      <p><img src="images/root-chakra-healing-chart.jpg" alt="Cheat Sheet" class="img-responsive"></p>
      <p>Common Symptoms Addressed By Root Chakra Healing<br>
          1. Being constantly challenged in getting your primary needs met</p>
      <p>Having enough money to get food or pay this month’s bills, having stable housing… If getting these basic needs met is a constant struggle for you, chances are that your root chakra will benefit from healing work. Root chakra healing focuses on getting you out of the detrimental cycle of behaviors and beliefs dominated by lack and scarcity.</p>
      <p>2. Looming feelings of insecurity</p>
      <p>If your first chakra is out of balance, you will notice that it is hard for you to feel safe in the world. This feeling of insecurity can manifest through constant worries about finances, health, where the world is going. You might even feel paranoid about every little thing.</p>
      <p>We’re not talking about transitory concerns associated with circumstances that deserve your immediate attention, so you can address the issue at hand effectively. First chakra concerns are more deeply rooted in your psyche and tend to persist over time, acting as a lingering feeling of insecurity.</p>
      <p>Root chakra healing consists in remedying these fears by allowing more supportive energy to come into your life and providing a solid foundation on which you can rest.</p>
      <p>3. Fear is your main motivating factor<br>
          If you notice that your life is based on fear, root chakra healing could help. It aims at bringing a more balanced perspective, so your decision-making is more well-rounded and not based exclusively on survival instinct or “fight or flight” responses.</p>
      <p>First chakra preoccupations regarding survival can often spin out of control when your support system and resources are not strong enough. By working at reinforcing your foundations and rooting yourself in stronger perceptions of safety, your can gain a greater awareness of your real needs and aspirations, and what needs to be done in order to fulfill them.</p>
      <p><img src="images/Root-Chakra-Healing-2.jpg" alt="mantra" class="img-responsive"></p>
      <p>Key steps for in-depth healing of the root chakra<br>
          1. Anchoring yourself in your environment</p>
      <p>Root chakra preoccupations relate to feeling safe in the world. Developing a harmonious relationship with your environment is key in fostering safety. How you feel in your immediate surroundings, from your home to your neighborhood and region matters in supporting the first chakra balance.</p>
      <p>2. Connecting intimately with the earth</p>
      <p>In order to heal root chakra imbalance, it’s important to connect directly to the earth. Go outside and walk on unpaved paths, dig your hands in the earth, plant seeds… These are all examples of personal connections with the earth element that will support the opening of the root chakra to a more grounded, sustainable energy flow.</p>
      <p>If you do not have access to garden, walking outside to a park and pay attention to every step you make, feeling the contact of your feet to the ground. Make it a daily practice. The presence of plants in your immediate surrounding can also be helpful to bring the earth closer to you. Another way to connect with this elemental energy is to imagine grounding yourself deep into the earth by visualizing a grounding cord made a burgundy red light, uniting your root chakra to the center of the earth.</p>
      <p>3. Physical activity promotes root chakra health</p>
      <p>Let’s face it, the root chakra governs the quality of our physical presence and feeling of aliveness in our body. Physical activity, no matter big or small, supports root chakra healing. Any movement involving your feet and legs will be particularly helpful. When you feel your vital force, you connect with the strength of root chakra energy and grounded in your life.</p>
      <p>4. Overcoming feelings of insecurity by learning self-reliance</p>
      <p>To counter the tendency to worry about safety and well-being, an element characteristic of first chakra imbalance, long-lasting healing consists in reinforcing your belief that you’re OK in this world and can get what you need when you need it. Working on self-reliance, confidence, perceptions about resourcefulness in your life are key in healing the root chakra.</p>
      <p>5. Discovering your true needs and aspirations</p>
      <p>To heal the first chakra, you need to know what your true needs and aspirations are. This generally helps guide your course of action and decisions with regards to the place you want to live in, the work you want to do, and the people you want to surround yourself with. Without this awareness, you have more chances to be swayed by others’ opinions or circumstances, and miss the opportunity to meet your deepest needs.</p>
      <p>Introspection and clarity are therefore keys to healing the root chakra. This is no small task, but with some time given to personal reflection and friendly advice, you will get in the right direction. Pay attention to limiting beliefs about yourself, and trust possibilities towards a better life.</p>
      <p>6. Going from a psychology of scarcity to personal abundance</p>
      <p>Remember that a psychology of lack and scarcity tends to self-perpetuate and reinforces limiting beliefs about your chances of success. Healing your root chakra aims at restoring confidence in your ability to provide for yourself and meet your basic needs easily.</p>
      <p>An important step in healing root chakra concerns is to re-center the notion of material abundance on inner and non-material abundance. For instance, instead of assessing your level of wealth just base on your bank account, consider all the other types of riches you have in your life, from friendships to enjoyment of everyday pleasures. In the process, you will like have to reconsider personal beliefs about money and physical safety.</p>
      <p>7. The root chakra and embodying the energy of manifestation</p>
      <p>When healing the root chakra, it’s important to remember that the outer world is often a reflection of what is happening inside you. Your notion about what it means to be abundant in the material world is affected and affects your notion of inner balance and resourcefulness. In other words, your state of being translates into your ability to manifest in the material world.</p>
      <p>How To Heal Your Root Chakra<br>
          Several steps may be taken to heal an imbalance or blockage in the root chakra. Depending on the severity of the blockage, you may opt to use chakra healing meditation, yoga poses, or even a variety of forms of energy healing, from reiki to acupuncture and sound therapy — such as the use of chakra tuning forks.</p>
      <p>Aromatherapy For The First Chakra</p>
      <p>Aromatherapy is another useful tool for first chakra balancing. To heal the root chakra, consider using flowering, earthy-scented essential oils to ground and balance, including;</p>
      <p>ylang-ylang<br>
          rosemary<br>
          patchouli<br>
          sandalwood<br>
          myrrh<br>
          rosemary<br>
          When exploring every day steps you can take to restore balance to your chakra system, consider adding healing food to your diet.</p>
      <p>Root Chakra Healing Foods<br>
      </p>
      <p>Just as each chakra has its own vibrational frequency, color, and function, so too are there foods that help bolster individual chakra function.<br>
          When concentrating on the root chakra, consider adding naturally red-colored foods, root vegetables, and animal protein such as:</p>
      <p>parsnips<br>
          soy<br>
          tofu<br>
          eggs<br>
          beans<br>
          meat<br>
          rainbow chard<br>
          beets<br>
          Root Chakra Healing Stones</p>
      <p>The use of chakra crystals and healing stones for chakra cleansing is also common.</p>
      <p>Healing stones’ vibrational frequencies can help restore balance when there is a deficiency or excess of energy leading to a blocked or overactive root chakra. Like the chakras, each stone has its own frequency.</p>
      <p>Although it is common practice to choose stones of the same color as their corresponding chakra, it isn’t always necessary — shades of the same color will also work. The key is that the stone has the same vibrational frequency as its associated chakra.</p>
      <p>When choosing red stones to heal the root chakra, some choices are red jasper, bloodstone, red carnelian, and garnet. Other options for stones include:</p>
      <p>Hematite<br>
          Rhodochrosite<br>
          Jet<br>
          Smokey quartz<br>
          Useful questions to guide first chakra healing<br>
          Do you feel you have all you need to live comfortably?<br>
          How are you doing financially? Are you constantly struggling or do you have strong foundations?<br>
          How are your current living conditions? Do you feel supported enough?<br>
          Do you feel connected to the natural environment around you?<br>
          Do you feel threatened by looming fears about the end of the world? Or do you trust that no matter what happens, you and your family will be OK?<br>
          How resourceful do you feel when you meet life challenges (whether they are financial, health-related, job-related, etc.)?<br>
          Do you find yourself in situations that others deemed right for you, but do not truly meet your deepest needs and aspirations?<br>
          Do you feel you have enough support where you live?<br>
          Are your roots strong enough to support you wherever you are?</p>
      <p></p>
      <hr>
      <p><strong>SACRAL CHAKRA</strong><a name="sacral" id="sacral"></a></p>
	  <p>This chakra is located about 1-2 inches below the navel. It is the chakra that deals with sex, power, money, gender, emotions, creativity, and procreation. When this chakra is imbalanced, there may lower back, pelvic, or hip problems, ob/gyn imbalances (including fibroids, cysts, etc.), issues around sexual potency, relationships, abundance, power and control.</p>
	  <p>

This chakra is also linked to how we express our creativity, and is also related to the Throat Chakra. Sexual abuse or trauma can create an energy block in this chakra. Reiki can help bring these deeply suppressed emotions to the surface (especially anger) and allow us to finally, fully heal.</p>
<hr>
      <p>A. SACRAL CHAKRA BASICS<br>
          B. SACRAL CHAKRA SYMBOL<br>
          C. OVERACTIVE SACRAL CHAKRA<br>
          D. BLOCKED SACRAL CHAKRA<br>
          E. OPENING YOUR SACRAL CHAKRA<br>
          F. SACRAL CHAKRA HEALING<br>
      </p>
      <p>A. SACRAL CHAKRA BASICS</p>
      <p>The sacral chakra is the second chakra. It is associated with the emotional body, sensuality, and creativity. Its element is water and as such, its energy is characterized by flow and flexibility. The function of the sacral chakra is directed by the principle of pleasure. Let’s have a look at this energy center’s basics, including its location, color, symbol, potential signs of imbalance, and what to do heal your sacral chakra.</p>
      <p>Sacral chakra location<br>
          The most common location for the sacral chakra is about three inches below the navel, at the center of your lower belly. In the back, it’s located at the level of the lumbar vertebrae.</p>
      <p>Other noteworthy locations described in different systems, expand its location to the genital area, especially at the level of ovaries for women and the testicles for men.</p>
      <p>&nbsp;</p>
      <p>It is associated with the lymphatic system.<br>
          Behavioral characteristics of the sacral chakra<br>
          The sacral chakra is associated with the following psychological and behavioral functions:</p>
      <p>Emotions, feelings<br>
          Relationships, relating<br>
          Expression of sexuality, sensual pleasure<br>
          Feeling the outer and inner worlds<br>
          Creativity<br>
          Fantasies<br>
          The sacral chakra is associated with the realm of emotions. It’s the center of our feelings and sensations. It’s particularly active in our sexuality and the expression of our sensual and sexual desires.</p>
      <p>Motivated by pleasure, it’s the driving force for the enjoyment of life through the senses, whether it’s auditory, through taste, touch, or sight. Opening your sacral chakra allows you to “feel” the world around and in us. As such, it’s an important chakra at the foundation of our feeling of well-being.<br>
      </p>
      <p>The second chakra is instrumental in developing flexibility in our life. Associated with the water element, it’s characterized by movement and flow in our emotions and thoughts. It supports personal expansion and the formation of identity through relating to others and to the world.<br>
      </p>
      <p>Sacral chakra imbalance<br>
          When the sacral chakra is balanced, the relationship with the world and other people is centered around nurturing, pleasure, harmonious exchange.</p>
      <p>Imbalance in the sacral chakra can manifest as:</p>
      <p>Dependency, co-dependency with other people or a substance that grants you easy access to pleasure<br>
          Being ruled by your emotions<br>
          The opposite: Feeling numb, out of touch with yourself and how you feel<br>
          Overindulgence in fantasies, sexual obsessions<br>
          Or the opposite: Lack of sexual desire or satisfaction<br>
          Feeling stuck in a particular feeling or mood<br>
      </p>
      <p>Sacral chakra meaning<br>
          The second chakra is referred to as:</p>
      <p>Sacral chakra<br>
          Svadhisthana<br>
          Adhishthan<br>
          Shaddala<br>
      </p>
      <p>The most common Sanskrit name for the sacral chakra is “Svadhisthana”, which means “your own place”.<br>
          Sacral chakra color<br>
          The sacral chakra is most commonly represented with the color orange. However, since it’s associated with the element of water, it could also take the color of very light blue or white in more rare occasions.</p>
      <p>The orange of the second chakra is translucent and has a transparent quality.</p>
      <p>Sacral chakra symbol<br>
          The symbol of the sacral chakra is composed of:</p>
      <p>A circle with six petals<br>
          A moon crescent<br>
          The circle represents the elements of water. Typically, the moon crescent is colored in silver and represents the connection of the energy of the moon with water. These symbols point to the close relationship between the phases of the moon and the fluctuations in the water and the emotions.</p>
      <p>Furthermore, the symbolism of the moon relates to the feminine menstrual cycle that takes the same number of days to complete and the connection of the sacral chakra with sexual organs and reproduction.</p>
      <p>&nbsp;</p>
      <p>B. SACRAL CHAKRA SYMBOL<br>
          An explanation of the sacral chakra‘s symbol meaning is best conveyed as the energy and strength necessary to nurture and sustain life.</p>
      <p>Symbol of the Maiden, Mother, Wise Woman<br>
          The sacral chakra is governed by the Hindu goddess, Parvati. As represented by her devotion to her husband, the Lord Shiva, Parvati is the goddess of power, fertility, and fidelity.</p>
      <p>All aspects of the goddess figure are encompassed in the second energy center — which is home to the energies directly associated with the development of life. From young maiden and sexual being to nurturing mother and wise woman, the image of the goddess figure embodies the sacral chakra’s attributes of creativity, sexuality, pleasure, and relationships.</p>
      <p>&nbsp;</p>
      <p>Symbol Meaning<br>
          The second chakra, also known as the Swadhisthana chakra, which is Sanskrit for “vital force,” is usually symbolized by a 16-petal lotus flower. It is important to note that in some depictions of the chakra symbol, a 6-petal lotus flower is used instead. Traditionally, the lotus flower image is symbolic of the cycle of birth, death, and rebirth.</p>
      <p>Regardless of the number of lotus petals in its image, all sacral chakra symbols are in agreeance on the color — which is varying shades of orange, from its brightest hue to rustic orange with red undertones.</p>
      <p>Symbolic Animal Associations</p>
      <p>Due to the feminine quality of sacral chakra energy it is frequently associated with the element of water. That being said, the sacral chakra symbol is often represented by water-dwelling animals, like fish or the crocodile.<br>
          According to Hindu tradition, the sacral chakra is governed by the alligator. Revered as an elder of the animal kingdom, the alligator is represents the duality of strength and weakness in all living creatures — including humans. Its outer scales may be rock-solid, but the alligator’s underbelly is one of its most sensitive, vulnerable areas.</p>
      <p>The alligator offers lessons in what it means to be patient and wise when it comes to making decisions. Its clear, sharp vision is a nice metaphor for the necessity of venturing forth with confidence beyond the comfort of self-imposed boundaries to pursue dreams and embrace change in order to grow.</p>
      <p>Additional symbolic meanings of the alligator include:</p>
      <p>resilience<br>
          strength<br>
          intuitiveness<br>
          honor<br>
          bravery<br>
          creation<br>
      </p>
      <p>C. OVERACTIVE SACRAL CHAKRA<br>
          If your sacral chakra is overactive your life may be rife with issues of excess and conflict, from thriving on drama to problems with addiction and unhealthy relationships.The key to restoring balance is to familiarize yourself with the signs of an overactive second chakra. When you recognize and understand the issues, learning how to balance the overabundance of chakra energy is made easier.</p>
      <p>Signs of Overactivity in the Sacral Chakra<br>
          Although signs of an overactive sacral chakra generally manifest in non-physical ways, physical symptoms can occur. For instance, you may experience a persistent sensation of warmth in your lower abdomen when energy flow through the chakra is excessive. An overactive sacral chakra can also significantly impact the function of the reproductive organs, bladder, and lower back. Among the most common physical ailments are:</p>
      <p>&nbsp;</p>
      <p>cysts<br>
          urinary issues<br>
          kidney problems<br>
          lower back pain<br>
          gynecological problems<br>
          When your sacral chakra is overwhelmed, you yourself may feel overwhelmed. You may experience emotions more deeply than normal, have severe mood swings, or seemingly thrive on conflict and drama. Oftentimes, the excess of emotions can also lead to poor personal boundaries making you overly dependent on others or even obsessive.</p>
      <p>Non-physical signs of an overactive sacral chakra can include:</p>
      <p>anxiety<br>
          mania<br>
          aggressiveness<br>
          arrogance</p>
      <p>Considering the sacral chakra influences sexuality, an overactive sacral energy center can contribute to promiscuity, sex addiction, and feelings of detachment or viewing others as mere objects to achieve sexual gratification.<br>
          Individuals with an overactive sacral chakra may also develop addiction to alcohol, drugs, or other unhealthy substances or engage in high-risk behaviors. Additional issues can include excessive eating and an unhealthy focus on one’s body image.</p>
      <p>Cleansing an overactive sacral chakra<br>
          Located in the lower abdomen, the sacral, or navel, chakra rules your ability to relate to the world around you. It governs your ability to interact with others and develop, nurture and maintain healthy relationships. Being mindful of making the right choices to curb unhealthy behaviors helps cleanse and heal the sacral chakra.</p>
      <p>Because of its close association with the digestive system, adopting a healthy diet and getting plenty of exercise might be particularly helpful in balancing the second chakra’s energy flow.</p>
      <p>The chakra is aptly associated with the color orange, a hue representing energy, creativity, and pleasure. To balance an overactive sacral chakra, you may surround yourself with its opposite color, blue.</p>
      <p>If, after making lifestyle changes, you still feel out-of-balance, consider incorporating other energy healing techniques, such as aromatherapy, yoga, meditation, or Tai Chi. Long-standing and severe energy imbalance can necessitate consulting with an energy healer to help restore balance and healing.</p>
      <p>&nbsp;</p>
      <p>D. BLOCKED SACRAL CHAKRA<br>
          A blocked sacral chakra can make you feel like you’ve lost control of your life and unable to retake hold of the reins. Sacral chakra energy is directly related to, and is nurtured by, that of the root chakra. Considered feminine in quality, sacral chakra energy — located in the lower abdomen — is what gives you the ability to be open with and nurture yourself and others.</p>
      <p>When your second chakra energy is blocked<br>
          As it governs your ability to relate to other people and the world around you, the sacral chakra also helps keep your emotions and ability to cope with life on an even keel. When sacral energy flow is blocked, you can become unemotional and experience uncertainty, insecurity, and an inability to cope with life’s changes.</p>
      <p>&nbsp;</p>
      <p>Feeling detached and rigid in your routine to the point you’re unable ride out life’s ups and downs is a sure sign the sacral chakra is blocked and in need of clearing and healing. A lack of self-esteem or self-worth stemming from a sacral chakra imbalance can also contribute to finding one’s self in unhealthy, and sometimes abusive, relationships.<br>
      </p>
      <p>Symptoms of Sacral Chakra Blockage<br>
          Physically speaking, when your sacral chakra is blocked you may experience a range of symptoms that are generally confined to the lower abdomen, back, and reproductive and digestive organs.</p>
      <p>Among the most common physical symptoms:</p>
      <p>constipation<br>
          back pain<br>
          urinary and kidney infections<br>
          gynecological cysts<br>
          abnormal menstruation<br>
          infertility<br>
          impotence<br>
          Sacral chakra imbalance frequently manifests as emotional and psychological difficulties, including:</p>
      <p>depression<br>
          low self-esteem<br>
          insecurity<br>
          detachment<br>
          jealousy<br>
          fear</p>
      <p>&nbsp;</p>
      <p>Considering the sacral chakra directly influences sexuality, it is not unheard of for a decline in sexual interest and performance to become an issue. Sexual dysfunction, including premature ejaculation, an inability to achieve orgasm, and low or nonexistent libido, is a good indicator there is an imbalance of the sacral chakra.<br>
          Clearing Sacral Chakra Blockages<br>
          In addition to adopting healthy lifestyle changes, such as a healthy diet and regular exercise, incorporating some form of energy healing can be beneficial for restoring balance to the sacral chakra.</p>
      <p>Introducing essential oils associated with the sacral chakra, such as Ylang-Ylang or Sandalwood, to your home or personal space can offer a boost to sacral chakra healing.</p>
      <p>Regularly meditating on the sacral chakra and/or the color orange can also help clear negativity and restore balance to the energy center.</p>
      <p>If you feel drawn to the use of crystals to restore balance, consider introducing orange carnelian, citrine, or amber jewelry to your wardrobe.</p>
      <p>When the sacral chakra is balanced, you feel in harmony with life. You are able to express yourself creatively and to mature with each new experience life offers — both good and bad.</p>
      <p>&nbsp;</p>
      <p>E. OPENING YOUR SACRAL CHAKRA</p>
      <p>The sacral chakra is the seat of emotion. Associated with the color orange, the sacral chakra (taken from the Sanskrit word svadhisthana, meaning “dwelling place of the self”) governs our ability to initiate, nurture and maintain healthy interpersonal relationships.Located in the lower abdomen, it is the hub of our creativity and guides us see beyond the mundane to embrace our dreams and desires. A balanced sacral chakra offers balance, grounding, and strength.</p>
      <p>When it’s time to open the second chakra energy flow<br>
          If your sacral chakra is out of balance it can initiate a range of physical symptoms, including:</p>
      <p>premenstrual syndrome<br>
          anemia<br>
          hypoglycemia (low blood sugar)<br>
          lower back pain<br>
          joint problems<br>
          spleen and kidney issues<br>
          low energy<br>
      </p>
      <p>On a non-physical level, a imbalance of the sacral chakra can contribute to:<br>
          depression<br>
          poor boundaries<br>
          overly sensitive, indulgent or aggressive<br>
          fear and/or anxiety<br>
          detachment<br>
          co-dependency<br>
          manipulation<br>
          panic attacks<br>
          If you feel your second chakra is in need of opening and healing, there are a number of things you can do to balance and strengthen it.</p>
      <p>Simple ways to open your second chakra<br>
          Find Your Groove<br>
          One way of opening the sacral chakra is to dance. Moving your body helps heal the second chakra by getting your body’s energy flowing, which activates the chakra and removes blockages.<br>
      </p>
      <p>Awaken Your Senses<br>
          Essential oils are a great, simple way to open up blocked chakras. Try introducing pleasant scents associated with the sacral chakra to your home, office, and other personal spaces. From citrusy and floral to more subtle, earthy fragrances, adding a hint of scent can make a world of difference in helping to open, cleanse, and balance the second chakra. To help heal chakra imbalance, consider using one or more of these essential oils:<br>
          Patchouli<br>
          Ylang-Ylang<br>
          Bergamot<br>
          Sandalwood<br>
          Clary Sage<br>
          Jasmine<br>
          Orange<br>
          Rose<br>
          Think (and See) Orange<br>
          Introduce subtle to bright shades of orange to your office and home decor to help heal, activate and open up energy flow through the second chakra. Add a touch of warming orange to your wardrobe and maybe introduce some healing, earthy orange tones to your jewelry and accessories.</p>
      <p>Meditating on the color orange is another great way to not only heal and activate the sacral chakra, but also improve your focus and concentration.</p>
      <p>Unpack Your Bags</p>
      <p>Learning to let go can be difficult. Emotional baggage, even if it’s just the size of a carry-on, can weigh you down. Consider journaling or simply talking with a close friend about all that’s bothering you. It’s amazing how much better you feel when you vocalize and let go of repressed emotions and experiences.</p>
      <p>&nbsp;</p>
      <p>Open Up the Hips<br>
          The sacral chakra is directly tied to our ability to experience pleasure and express our emotions in a healthy way. Learning how to open and strengthen our second chakra through exercise can also help heal imbalance.</p>
      <p>When exploring options for exercises that benefit the sacral chakra, consider yoga.</p>
      <p>To open up, activate, and heal the sacral chakra, start with these yoga poses:</p>
      <p>Open angle pose ( Upavistha Konasana)<br>
          Cow face pose (Gomukhasana)<br>
          One-legged king pigeon pose (Eka Pada Rajakapotasana)<br>
          Reclining bound angle pose (Supta Baddha Konasana)<br>
          Half frog pose (Ardha Bhekasana)<br>
          Fire log pose (Agnistambhasana)</p>
      <p>F. SACRAL CHAKRA HEALING</p>
      <p>Here’s an in-depth look at disturbances that can affect the second chakra, commonly known as the sacral chakra and to how perform chakra healing to restore optimum balance and aliveness in your everyday life.</p>
      <p>A look at what’s inside</p>
      <p>Understanding the sacral chakra<br>
          Why healing your second chakra?<br>
          Sacral chakra healing cheat sheet<br>
          Common symptoms addressed by sacral chakra healing<br>
          How to heal the second chakra<br>
          Key steps for in-depth healing of the sacral chakra<br>
          Useful questions to guide second chakra healing<br>
          Supporting references and quotes from chakra experts<br>
          Understanding The Sacral Chakra<br>
          The sacral chakra, or Swadhisthana in Sanskrit, is located in the lower abdomen just below the coccyx or tailbone. The chakra color of the second chakra is orange, and its element is water. It is associated primarily with emotional responses and regulation and is often referred to as the seat of emotions. It is also associated with the sense of taste and with reproductive function.</p>
      <p>Close neighbor to the Muladhara chakra or root chakra, it is one step removed from preoccupations about survival, safety, and instinctual sensory perception of the world. It allows us to creatively deal with what emerges from our experience and develop a response informed by our emotional patterns and intelligence.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Because of its close physical connection with the pelvis area and the reproductive organs, this chakra is also the center of the search for pleasure, whether sensual or through your daily life experiences. Abundant creativity and strongly felt intuition are two additional facets of an open sacral chakra.<br>
          “I enjoy life fully” could be the sacral chakra’s motto. An open, balanced sacral chakra allows you to experience intimacy and love freely and fully, to be honest and non-judgmental about your desires, and to live as your authentic self without fear.<br>
      </p>
      <p>Why Heal Your Second Chakra?<br>
          A blockage in the second chakra can cause both physical and emotional distress if not healed. Chakras are points in the body that moderate energy, allowing it to flow freely and maintain health and vitality. Unfortunately, the chakras can develop blockages that limit that energy flow. Chakra healing aims at restoring balance and freeing any blockage or kink in your energy body that prevents it from functioning optimally.</p>
      <p>Chakras can become either over- or underactive, each leading to slightly different symptoms.</p>
      <p>An overactive sacral chakra can cause:</p>
      <p>Emotional overreactions<br>
          Excessive emotional attachment to people or objects; excessive neediness in relationships<br>
          Codependency<br>
          Muscle tension and abdominal cramps<br>
          An energy deficiency in the second chakra can cause:</p>
      <p>Fear of happiness or pleasure, self-sabotage<br>
          Lack of creativity and authenticity<br>
          Low libido<br>
          Pessimism, depression<br>
          Irregular menstrual cycle, urinary or bladder infections</p>
      <p>&nbsp;</p>
      <p>Common Symptoms Addressed By Sacral Chakra Healing<br>
          1. Getting lost in fantasies<br>
          A common symptom of second chakra imbalance is the tendency to get consumed in fantasies about life’s pleasures instead of enjoying them. For instance, you may lose yourself in sexual fantasies rather than connecting with an actual or potential partner or be obsessed with connecting sensually or sexually with every attractive person who crosses your path.</p>
      <p>2. Excessive Indulging and Addictive Behavior</p>
      <p>Getting into the habit of satisfying your desires by indulging could also indicate chakra imbalance, especially with regards to addictive behaviors, whether it’s with food, substances, television or games for instance. Knowing how to feel fulfilled and satisfied is part of sacral chakra healing.</p>
      <p>3. Lack of fulfillment and insatiable desires</p>
      <p>Deeply and honestly appreciating what you have and who you are is part of sacral chakra healing. Delighting yourself in the simple pleasures of life without getting overly attached to them is key in promoting a balanced second chakra.</p>
      <p>Pay attention to feel the satisfaction not only in your mind in an intellectual way, but also deeply as a sensation in your body, so the desire and its fulfillment are anchored in a fully rounded experience. This contributes to satiation and healing balance.</p>
      <p>4. Codependent Behavior</p>
      <p>Healing the sacral chakra often means bringing relationships to balance and harmony. Relationships can carry strong emotional charges and tie into the second chakra easily. Unfortunately, family dynamics are often source of disturbances, especially with regards to the sacral chakra.</p>
      <p>To balance and heal this chakra, it’s important to develop discrimination, especially with regards to energy drains from people and bad habits.</p>
      <p>5. Negative and Destructive Emotions</p>
      <p>Envy, jealousy, anger, rage are characteristics of an imbalanced second chakra. Of course, they are detrimental to our feeling of well-being and disempowering.</p>
      <p>If you notice you have tendency to overreact when someone challenges you or has differing opinions by going to rage easily or intense frustration, pay attention to techniques to manage emotions with more awareness and balance.</p>
      <p>6. Physical Health and the Sacral Chakra</p>
      <p>From a physical health perspective, healing your second chakra can also help heal or prevent more serious problems such as infertility, ectopic pregnancies or multiple miscarriages, prostate and testicular diseases, endometriosis and ovarian cysts.</p>
      <p>&nbsp;</p>
      <p>Tools And Techniques To Heal Your Second Chakra<br>
          A blockage of energy in the sacral chakra can be healed with regular practice designed to stimulate the chakra, which allows energy to flow into it and excess energy to dissipate. Chakra balancing can be helped along by a healer, but there are many things you can do on your own as well.</p>
      <p>Meditation<br>
          Meditation is very useful for chakra cleansing and balancing. For example, a simple sacral chakra healing meditation consists in envisioning an orange lotus or orange crescent moon in the area of the second chakra in the pelvis area. Hold that image in your mind for a few minutes while breathing deeply.<br>
      </p>
      <p>Sacral Chakra Healing foods<br>
          Dietary changes can also help cleanse your second chakra. Oranges, melons, coconuts and other sweet fruits are good sacral chakra healing food. Cinnamon is also useful, as is drinking plenty of water.</p>
      <p>Essential Oil For Chakra Healing<br>
          Sandalwood, patchouli, orange, rose and ylang-ylang essential oils can be used as aromatherapy for second chakra healing. These can be used alone, in meditation, and in conjunction with chakra crystals.</p>
      <p>Using Chakra Healing Stones<br>
          Sacral chakra healing stones include citrine, carnelian, orange calcite, and other orange stones. Moonstone can also be used because of this chakra’s association with water and the moon.</p>
      <p>Yoga poses to open the second chakra<br>
          Yoga for sacral chakra healing should focus on hip opening poses like Upavistha Konasana, or Open Angle Pose. Baddha Konasana, or Bound Angle Pose, is another simple but useful pose. Yoga practice for second chakra healing should be slow and relaxed rather than fast or overly challenging.</p>
      <p>Water, a Second Chakra Element<br>
          Since the sacral chakra’s element is water, getting outside and relaxing near open water can help open your second chakra. Lakes, rivers, streams or the ocean are all useful. If possible, wade in or dangle your feet in the water to help the energy flow. Taking a bath or a shower can also contribute to balancing your chakra while providing the relaxation needed to keep your emotions flowing.</p>
      <p>5 Key Steps For In-Depth Healing Of The Sacral Chakra<br>
          1. Sacral Chakra Healing And Overcoming The Challenge of Grasping<br>
          One of the main challenge for healing the sacral chakra is about maintaining balance. One can be easily taken by second chakra passions and sensations. But can you fully recognize and appreciate the experience in the moment?</p>
      <p>It’s sometimes difficult to fully welcome the pleasure of life’s experiences and sensations and maintain balance. The attraction to the source or cause of experience has a strong pull and one may have tendency to grasp the source of pleasure. This form of attachment might get in the way of a “healthy” flow and turn into insatiable, obsessive or hoarding behavior. To heal that type of imbalance, it becomes important to stay conscious or aware as one engages in the experience.</p>
      <p>2. Sacral Chakra Healing and Severing Draining Emotional Ties<br>
          Often, people play on emotions to manipulate each other. Second chakra drains can come from imbalanced family dynamics or power plays at work or example. In relationships, a lot is communicated through emotions – happiness, sadness, joy, disappointment, etc.</p>
      <p>When emotions are not fully expressed or expressed indirectly, such as in passive aggressive behaviors, the field might become obscured and the second chakra comes out of balance.</p>
      <p>3. Healing Shame in the Second Chakra<br>
          Some of us might also feel shame and guilt around pleasure due to strict education, contradictory values, or a traumatic experience. Repressed sexuality can lead to serious imbalances in the second chakra, whether it “shuts down” or becomes overactive.</p>
      <p>The energy of your second chakra can be shut down or blocked as a result of sexual repression, whether this movement of contraction has been influenced by the actions of someone in your life or is self-imposed. Chakra healing is important to restore a healthy image of sexuality and pleasure.</p>
      <p>Working on trust around sex and sensuality with your partner or sharing your concerns with a trusted friend or professional could be helpful. Going step by step, starting with small experiences of pleasure might pave the way to healing big wounds.</p>
      <p>4. Restoring a Balanced Enjoyment of Life’s Pleasures<br>
          Healing the shame or guilt in the second chakra helps refine your appreciation of the simple of life, as well as less ordinary experiences. Instead of numbing yourself by either blocking or saturating your experience with overwhelming sensations and emotions, you may enjoy the pleasure provided in the moment in full awareness.</p>
      <p>5. Laws of Attraction and The Sacral Chakra<br>
          The 2nd chakra magnetizes by the force of emotions, but also its energy that is half way between the survival preoccupations of the first or root chakra and the expression of will of the third or solar plexus chakra. Ideas and visions, when dressed up in human emotions and can come to life more easily. As such, the second chakra magnetizes experiences based on its state and the direction provided by the other chakras. Attraction and repulsions are strongly linked to the sacral chakra.</p>
      <p>Healing the second chakra therefore consists in being more mindful of one’s thoughts and intentions, as well as being more aware of the types of emotions arising at specific moments.</p>
      <p>Questions To Guide Your Chakra Healing<br>
          Self-inquiry is a useful tool to heal the sacral chakra. By understanding our emotions and reactions, we can better defuse the unconscious programming ruling our actions. This allows to choose how we react and see our emotions as useful indicators rather than being ruled by them.</p>
      <p>Ask yourself the following questions to assess your second chakra:</p>
      <p>What is attractive to you? What repels you? How does it guide the way you live your life?<br>
          How attractive do you feel?<br>
          Are you confident about your self-image? Or do you doubt yourself often?<br>
          Do you feel ruled by your emotions? Or are you emotionally aware and conscious?<br>
          Are you often indulging in life’s little pleasures to the point of losing balance (turning the quest for pleasure into an insatiable obsession)? Or do you enjoy each experiences through a healthy moderation and self-discipline ?<br>
          Can you balance passion and personal discipline?<br>
          Do you feel expressed in your passion for life?<br>
          Are you feeling alive most of the time? Or does life feel dull?<br>
          References &amp; Quotes<br>
          “The skill of learning how to enter into the sensation of enjoyment is required.<br>
          To experience pleasure is one thing, but to recognize the experience as enjoyable and then enter into the felt sense of appreciation of the moment-now that is an art.” Source: David Pond. Chakras for Beginners: A Guide to Balancing Your Chakra Energies.</p>
      <p>“Through work on the Svādhishthāna Chakra we are able to bring our basic instincts under control, transform them and ultimately transcend them.” Source: Paramhans Swami Maheshwarananda. The Hidden Power in Humans – Chakras and Kundalini. International Sri Deep Madhavananda Ashram Fellowship.</p>
      <p></p>
      <hr>
      <p><strong>SOLAR PLEXUS CHAKRA</strong><a name="solarplexus" id="solarplexus"></a></p>
	  <p>
	  Located 1-2 inches above the navel, the Solar Plexus Chakra is our power center, and where we are connected to our self-esteem and self-protection. When we feel scattered and direct our energies outward, it is usually a sign that we have given our power away. When this happens, sometimes one can feel discomfort, or a whirling sensation, in the Solar Plexus Chakra.</p>
	  <p>

Physical imbalances may manifest as anorexia or bulimia, liver or adrenal dysfunction, fatigue, stomach ulcers, diabetes, or indigestion. Emotionally, we may be afraid to step into our power, have issues around self-confidence, self-respect, feel easily intimidated, weak, closed, depressed. When Reiki is performed and these blockages are lifted, we've cleared the way to take action in our life.	  </p>
	  <hr>
      <p>A. SOLAR PLEXUS CHAKRA BASICS<br>
          B. SOLAR PLEXUS CHAKRA SYMBOL<br>
          C. OVERACTIVE SOLAR PLEXUS CHAKRA<br>
          D. BLOCKED SOLAR PLEXUS CHAKRA<br>
          E. OPENING YOUR SOLAR PLEXUS CHAKRA<br>
          F. SOLAR PLEXUS CHAKRA HEALING</p>
      <p>A. SOLAR PLEXUS CHAKRA BASICS<br>
          “Radiate your power in the world,” could say the solar plexus chakra. Characterized by the expression of will, personal power, and mental abilities, the energy of the third chakra or Manipura in Sanskrit is mobilized when we assert ourselves in the world. Discover its key characteristics and how to make the most of this powerful energy center.</p>
      <p>Introducing the Solar Plexus or Manipura chakra<br>
          Let’s start by exploring the basics, including the location, color, and symbol of the solar plexus chakra. Then, we are going to look at possible signs of imbalance in the third chakra and what to do to heal your solar plexus center and restore its balance to its optimal state.</p>
      <p>Chakra Key Elements<br>
          First, we’re going to look at the Solar Plexus chakra basics:</p>
      <p>Location: In the solar plexus area (upper part of the belly, where your diaphragm rests); it is the third chakra from the bottom in the traditional system counting 7 chakras<br>
          Color: Yellow (higher frequencies of this chakra can turn into golden yellow)<br>
          Symbol: A circle with 10 petals in which is inscribed a downward-pointing triangle<br>
          Original name in Sanskrit: Manipura<br>
          Element: Fire<br>
          Additional elements used in modern energy healing practices are healing crystals and aromatherapy. If you’re curious, here’s a list of the most common ones:</p>
      <p>Solar Plexus chakra healing stones: Citrine, tirger’s eye, yellow tourmaline<br>
          Essential oils: Chamomile, bergamot, cedarwood, rosemary are amongst the most popular soothing oils</p>
      <p>Main Chakra Meanings<br>
          The main meanings associated with the third chakra are:</p>
      <p>Will, personal power<br>
          Taking responsibility for one’s life, taking control<br>
          Mental abilities, the intellect<br>
          Forming personal opinions and beliefs<br>
          Making decisions, setting the direction<br>
          Clarity of judgments<br>
          Personal identity, personality<br>
          Self-assurance, confidence<br>
          Self-discipline<br>
          Independence<br>
          When the Solar Plexus chakra is open and the energy in this center is balanced, these functions naturally find a clear and effortless outlet. However, in case the flow of energy is disturbed, whether because the Manipura chakra is overactive or blocked, symptoms may range from energetic and emotional to physical.</p>
      <p>Chakra Element: Fire<br>
          The Manipura chakra is traditionally related to the element of fire, though some contemporary healing movements connect it to the element of air. It has a connection with the sun, heat, the energy of light, all forms of power.</p>
      <p>Chakra Color: Yellow<br>
          The Solar Plexus chakra is most commonly represented with the color yellow. Since it’s associated with the element of fire, it is also sometimes depicted with yellowish red.</p>
      <p>Chakra Location: Solar Plexus<br>
          The most commonly accepted location for the third chakra is at the solar plexus level, between the navel and the lower part of the chest. That’s why it’s often referred to as the “solar plexus chakra.” Some traditions place it more loosely in the navel area.</p>
      <p>Closely connected to the digestive system, especially the gastric and hypogastric plexi, its main function is to help transform matter into energy to fuel your body. It governs metabolism and is commonly associated with the pancreas.</p>
      <p>Chakra Symbol<br>
          The main elements of the Solar Plexus chakra symbol [LINK] are:</p>
      <p>A circle with ten petals<br>
          An downward-pointing triangle<br>
          The inverted triangle represents the fire element and the transformative power of this energy center. Fire turns matter into energy that can be used to propel, move forward. The ten petals are often represented with the color blue, like the blue color of the flame.</p>
      <p>What does Sanskrit name “Manipura” mean?<br>
          The most common Sanskrit name for the Solar Plexus chakra is “Manipura”, which means “city of jewels” or “seat of gems”.</p>
      <p>The third chakra is also referred to as:</p>
      <p>Solar Plexus chakra<br>
          Manipura<br>
          Manipurak<br>
          Nabhi<br>
          The “power chakra”<br>
          The word “nabhi” can be translated as “navel”.</p>
      <p>What the Solar Plexus chakra is known for<br>
          The Solar Plexus chakra is associated with the following psychological and behavioral functions:</p>
      <p>Expression of will<br>
          Intellectual abilities<br>
          The “accounting mind” that categorizes everything, assesses the pluses and minuses in life<br>
          Personal power<br>
          Ability to establish ideas and plans into reality<br>
          At higher levels, it conveys wisdom<br>
          The main function of this energy center is to provide actual momentum to move forward and realize personal desires and intentions in the world. It plays a fundamental role in the development of personal power. It feeds one’s direction in life and the actions taken in order to reach your goals. It influences preoccupations about social status and self-image.</p>
      <p>Signs your Solar Plexus chakra may be out of balance<br>
          On one side, a balanced solar plexus chakra makes it easy to find balance between your personal power and harmonious relationships with others; on the other side, an imbalanced third chakra could undermine your self-esteem and social life.</p>
      <p>When the Solar Plexus chakra is balanced, you may:</p>
      <p>Be assertive<br>
          Exert your will in a way that leads to the expected results somewhat effortlessly<br>
          Have harmonious relationships with your surrounding<br>
          Imbalances in the third chakra can manifest as:</p>
      <p>Excessive control and authority over your environment and people<br>
          Or the opposite in case of deficiency or blocked energy: Feeling of helplessness, irresponsibility<br>
          Being obsessed with minute details, seeing life through a filter of plus and minuses while losing sight of the whole picture<br>
          Being manipulative<br>
          Misusing your power<br>
          Lack of clear direction, lack of purpose or ambition<br>
          Making plans or having a lot of ideas without finding efficient ways to realize them<br>
      </p>
      <p>&nbsp;</p>
      <p>B. SOLAR PLEXUS CHAKRA SYMBOL<br>
          Each of the seven chakras is represented by a special image that symbolizes the essence of the chakra. For the solar plexus chakra, the image is of a red triangle facing downwards. The solar plexus, known as Manipura in Sanskrit,  is tied most closely to the sense of self, including self-control and self-confidence. This energy center is what allows people to set and maintain healthy boundaries, to know what they want, to assess their strengths and weaknesses accurately, and to control their impulses. It is known as Manipura in Sanskrit, which roughly translates to “city of jewels.”</p>
      <p>Solar Plexus Chakra Symbol Description<br>
          Each side of the solar plexus symbol’s triangle has a T-shaped arm stemming from the middle. This is a variation of the Hindu swastika, which is an ancient holy symbol that represents the sun. The red triangle is located in the center of a yellow circle surrounded by 10 darker petals, which calls to mind the lotus flower. Each petal is decorated with a symbol representing a different sound, each of which have symbolic meanings.</p>
      <p>The Meaning of the Symbol<br>
          The predominately yellow color of the symbol along with the red highlights are reminiscent of fire, which is the element associated with Manipura. Its lotus flower shape is a common one and can symbolize life, rebirth and spiritual awakening. The swastika imagery has a similar meaning, with the sun representing life and spiritual awakening.</p>
      <p>Each of the ten petals are emblazoned with a symbol. The symbols represent the Sanskrit syllables of pha, pa, na, dha, da, tha, ta, nna, ddha, and dda. Each of these symbols has a meaning. It is difficult to translate this symbol meaning directly, because the explanation often misses a great deal of cultural nuance. Essentially, each of these symbols corresponds to what could be called a vice, although it might more accurately be called a distraction or stumbling block. Respectively, the symbols on the petals represent sadness, foolishness, delusion, disgust, fear, shame, treachery, jealousy, ambition and ignorance in spiritual matters.</p>
      <p>The Manipura symbol represents the awakening into true being, blending the base human nature with spiritual awakening. It recognizes the faults everyone has, but represents the ability to rise above them. It symbolizes a holistic sense of self, recognizing instinct and emotion as valuable while still aspiring to enlightenment.<br>
      </p>
      <p>C. OVERACTIVE SOLAR PLEXUS CHAKRA<br>
          The solar plexus chakra, also known as the third chakra or Manipura, is closely tied to a strong sense of self.  An overactive solar plexus chakra can cause poor health and emotional distress, but there are ways to fix it.</p>
      <p>Symptoms of an Overactive Solar Plexus Chakra<br>
          Symptoms of an overactive third chakra include:</p>
      <p>Anger issues<br>
          Excessive stubbornness<br>
          Desire for control<br>
          Perfectionism<br>
          Being overly critical<br>
          Eating disorders<br>
          Ulcers or other digestive problems<br>
          Balanced chakras are essential to a healthy life. Difficult or traumatic experiences in life can cause certain chakras to become blocked, which in turn causes other chakras to compensate for them. Your third chakra might also go on overdrive when the neighboring energy centers, namely your second or sacral chakra and fourth or heart chakra, are disturbed.<br>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>How to Balance the Solar Plexus Chakra<br>
          Since an overactive chakra is compensating for blockage elsewhere, balancing it requires cleansing the blocked chakra. The solar plexus chakra is often linked to the brow chakra, which is associated with wisdom and spiritual insight. However, an overactive solar plexus chakra may be compensating for other chakras as well.</p>
      <p>In order to completely heal, look for signs and symptoms that may indicate which chakra is blocked. Alternatively, work on balancing all seven chakras. This can be done alone, but working with an energy healer or Reiki practitioner may speed up the process.<br>
      </p>
      <p>To soothe an overactive solar plexus chakra, try eating soothing foods or drinking soothing teas associated with it. Chamomile, mint and rosemary are soothing herbs. As a general rule, yellow foods are good for the solar plexus chakra, so bland, comforting food like pasta, bread and bananas are calming.<br>
          Some people find that surrounding themselves with the opposite color helps calm an overactive chakra. Purple is the opposite of yellow, so wearing purple, using lavender as aromatherapy, or burning purple candles may be soothing. However, this does not work for everyone. Try using purple one day and yellow the next. Pay attention to how you feel and how you react to situations as you go about your day to determine which approach works better for you.</p>
      <p>Meditation is an effective way to help soothe an overactive chakra. Soothing meditation is often best done in the dark or in dim light. Visualize a gently glowing yellow or purple ball of energy over your solar plexus. Hold the image in your mind for a few minutes as you feel the excess energy flowing out into the ball. Then take a deep breath, let it out, and feel the ball dissipate as the excess energy flows throughout your entire body and into the world around you.<br>
      </p>
      <p>D. BLOCKED SOLAR PLEXUS CHAKRA</p>
      <p>A blockage in the third chakra, also known as the solar plexus chakra or Manipura, can be especially serious because it is where our sense of self originates. Chakra imbalances are difficult to avoid. When you face a difficult or traumatic situation, the coping skills you develop to get through it may cause disruptions in your energy and prevent you from healing fully.</p>
      <p>Symptoms of a Blocked Solar Plexus Chakra<br>
          A healthy solar plexus chakra allows you to know yourself and live with confidence and strength. Someone with a balanced solar plexus chakra will be able to set boundaries and be assertive without being aggressive. It allows you to know yourself, judging yourself and others fairly but not critically.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Since it plays such a fundamental role in self-confidence, an imbalance in the third chakra can cause many problems. Some common symptoms of a blockage include:<br>
          Low self-esteem<br>
          Inability to set or maintain boundaries<br>
          Codependency<br>
          Lack of self-control<br>
          Depression or anxiety<br>
          Addiction<br>
          The solar plexus chakra is also important for physical health. It is closely tied to digestive health, but a blockage can cause an issue with other systems as well. Common physical symptoms of a blocked third chakra include:</p>
      <p>Ulcers<br>
          Poor digestion, gas, nausea<br>
          Hypoglycemia<br>
          Diabetes<br>
          Asthma and other respiratory problems<br>
          Arthritis<br>
          Organ problems, especially in the liver and kidneys<br>
          Nerve pain and fibromyalgia<br>
          Difficulty gaining or losing weight</p>
      <p>Solutions for a Blocked Solar Plexus Chakra<br>
          Clearing the blockage in your third chakra and allowing energy to flow freely through it will help return you to health. It is best to try to do daily healing work because falling back into old patterns can allow the blockage to form again.</p>
      <p>Working with a Reiki practitioner or other energy healer can be a good way to start your healing journey. They will be able to help break up the blockage and can help locate other blockages or imbalances in your energy.</p>
      <p>At home, meditation is the most effective way to break up a blockage. Everyone possesses healing energy, and you can harness it using visualization. The third chakra is associated with the color yellow and with fire, so imagine a golden healing flame just below your navel. As you breathe deeply, feel it dissolving any hurt or pain you are storing in your third chakra.</p>
      <p>Surrounding yourself with things associated with Manipura will help as well. Wearing yellow, eating yellow foods, and wearing gold jewelry or gold and yellow gemstones can help open your third chakra. Spending time in the sun and doing yoga exercises that strengthen your core are also good for healing Manipura.<br>
      </p>
      <p>E. OPENING YOUR SOLAR PLEXUS CHAKRA<br>
          The solar plexus chakra, also called Manipura, is center of strength and balance, both physical and emotional. When this chakra is open and the energy flows unhindered, it is responsible for a balanced self-esteem, willpower, and a strong sense of self. Opening the solar plexus chakra can take time and work, but there are some easy ways to get started and speed the process along.</p>
      <p>Use Healing Stones To Open Your Solar Plexus Chakra<br>
          The chakras are each tied to certain stones, and bringing those stones into your life can help heal them. Chakra healing stones can be worn as jewelry, held during meditation or carried in a pocket. Some people place them on their work desk or under their pillows at night.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>The solar plexus chakra is associated with the color yellow, and with yellow gemstones. These include:<br>
          citrine<br>
          amber<br>
          sunstone<br>
          yellow jasper<br>
          golden tiger eye<br>
          yellow jade<br>
          golden calcite<br>
          yellow topaz</p>
      <p>Opening the Solar Plexus Chakra With Healing Foods<br>
          Certain foods can be used to heal the solar plexus chakra. Adding these to your diet or increasing the amount you eat can help activate your chakra. The following foods are associated with Manipura:</p>
      <p>squash<br>
          sweet potatoes<br>
          pumpkins<br>
          lentils<br>
          yellow and orange peppers<br>
          lemons<br>
          corn<br>
          yellow pears<br>
          golden apples<br>
          brown rice<br>
          oats<br>
          spelt</p>
      <p>Healing The Third Chakra with Daily Affirmations<br>
          Affirmations are a simple, useful tool that can open up your solar plexus chakra. These can be said at a certain time every day, or at various times throughout the day. Many people write them down and put them in noticeable places to remind themselves. Starting the day with affirmations can put you in the right frame of mind without having to spend a lot of time on meditation exercises.</p>
      <p>Since the solar plexus chakra is closely tied with strength and a healthy sense of self, affirmations that focus on self-acceptance and boundaries are most useful. Some sample affirmations include:</p>
      <p>I love and accept myself.<br>
          I respect and honor myself.<br>
          I can achieve anything I desire.<br>
          I believe in myself.<br>
          I deserve to be loved and respected by those around me.</p>
      <p>How to Open the Solar Plexus Chakra with Essential Oils<br>
          Essential oils are an easy, subtle way to open your solar plexus chakra. They can be worn as perfume if diluted properly, or used in oil diffusers. A few drops in a hot bath can provide a relaxing location for meditation.</p>
      <p>The essential oils associated with Manipura are generally warm and a bit spicy. They include:</p>
      <p>chamomile<br>
          lemon<br>
          ginger<br>
          black pepper<br>
          cinnamon<br>
          clove<br>
          Simple Meditation Exercises for Healing The Third Chakra<br>
          Meditation is one of the most effective ways to activate your chakras. Short, simple meditation exercises can work well, especially for those who struggle with longer meditation. Since the goal is to have an opened and activated solar plexus chakra, try imagining a bright yellow flower opening over your navel. A glowing golden ball of light or a burning flame are also good meditations for opening Manipura. Imagine those for a few minutes at a time throughout the day while taking deep, calming breaths.</p>
      <p>People with an unbalanced solar plexus chakra may be unable to set boundaries, be unable to accept criticism and fear rejection. Lear more about how to heal your third chakra.</p>
      <p>&nbsp;</p>
      <p>F. SOLAR PLEXUS CHAKRA HEALING</p>
      <p>In Hindu tradition, the seven chakras govern energy flow through the body. A blockage or an unbalanced chakra can cause both physical and mental symptoms, including chronic illness or psychological disturbances. The solar plexus chakra is one of the most commonly blocked chakras and can be the root of a number of common complaints.</p>
      <p>Why Healing Solar Plexus Chakra Imbalances?<br>
          The solar plexus chakra, known in Sanskrit as Manipura, is the third chakra and is located in the area of the navel and solar plexus. It is the chakra primarily associated with self-esteem, confidence and willpower.</p>
      <p>A balanced Manipura chakra allows you to have control over your thoughts and emotional responses, set healthy boundaries, and be at peace with yourself. Its physical association is with digestive function.</p>
      <p>Symptoms of the Solar Plexus Imbalance<br>
      </p>
      <p>&nbsp;</p>
      <p>Chakra imbalances occur as either an excess of energy or an energy deficiency. Symptoms associated with excessive energy in the solar plexus chakra include:<br>
          Controlling, intolerant, or excessively competitive behavior<br>
          Overeating and overindulgence<br>
          Fatigue or excessive laziness<br>
          Symptoms of energy defiency include:</p>
      <p>Insecurity, anxiety and fear<br>
          Low body weight and poor appetite<br>
          Lack of confidence and poor self-image<br>
          Inability to focus and lack of organization<br>
          Stomach ulcers, indigestion, diabetes, eating disorders and other illnesses tied to the digestive system can also be symptoms of an unbalanced solar plexus chakra.</p>
      <p>How To Heal Your Solar Plexus Chakra<br>
          Healing the solar plexus chakra is a simple process, but it may take some practice. Most people have built up a blockage over many years, so chakra balancing will take time. There are some solar plexus chakra healing exercises that are easy to practice every day.<br>
      </p>
      <p>The chakra color associated with Manipura is yellow, which means that bananas, sunflower seeds, yellow peppers and cheeses are good solar plexus chakra healing food. Spices for the solar plexus chakra are ginger, chamomile, mint, and cumin.<br>
          Meditation can help with opening Manipura. A simple exercise is to simply envision a brilliant yellow sunflower over your solar plexus chakra. This can be even more effective with the use of chakra stones. Solar plexus chakra healing stones include yellow stones like citrine, amber, yellow tourmaline and tiger’s eye.</p>
      <p>Aromatherapy can also be helpful for Manipura chakra healing. It can be used while meditating or doing yoga, or by itself at any time. Citrusy essential oils like orange and grapefruit are good for healing the solar plexus chakra, as are chamomile, mint and ginger.</p>
      <p>Regular yoga practice is ideal for chakra balancing. Asanas that focus on core strength are perfect for Manipura healing. Warrior Pose is the easiest yoga asana for opening Manipura. Holding it for a few minutes every morning will begin to open your solar plexus. Other helpful asanas are Boat Pose (Navasana), which strengthens the core, and Sun Salutations (Surya Namaskar). Engaging in structured risk-taking during your yoga practice, like doing a challenging pose or gently pushing yourself a bit more, can also help balance Manipura.</p>
      <p>Finally, since the solar plexus chakra is associated with the sun and fire, simply getting outside can help. Meditating or doing yoga outdoors on sunny days will maximize your healing practice, but simply going outside for a walk or doing a little sunbathing will help open your solar plexus chakra.</p>
      <hr>
      <p><strong>HEART CHAKRA</strong><a name="heart" id="heart"></a></p>
	  <p>
	  Located at the center of the chest, the Heart Chakra is how we tap into our Higher Selves, self-love, divine love, and Christ Consciousness. When it is imbalanced, we may physically experience imbalances in that area of the body, such as: heart issues (like congestive heart failure or heart attacks), asthma/allergies, lung cancer, breast cancer, or bronchial pneumonia.</p>
	  <p>

Emotionally, we may feel lonely, disconnected from ourselves and others, resentful, depressed (due to lack of hope), grief, distrust in love, and lack of compassion. Reiki can not only help make us more compassionate, but by clearing these blockages we might also become more open to accepting love from others.	  </p>
	  <hr>
      <p><br>
          A. HEART CHAKRA BASICS<br>
          B. HEART CHAKRA SYMBOL<br>
          C. OVERACTIVE HEART CHAKRA <br>
          D. BLOCKED HEART CHAKRA<br>
          E. HEART CHAKRA PAIN<br>
          F. OPENING YOUR HEART CHAKRA<br>
          G. HEART CHAKRA HEALING</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>A. HEART CHAKRA BASICS<br>
          The heart chakra, or Anahata in its original Sanskrit name, colors our life with compassion, love, and beauty. Driven by the principles of transformation and integration, the fourth energy center is said to bridge earthly and spiritual aspirations. Explore what makes the essence of this chakra and how to unravel its powerful energy to enrich your life.</p>
      <p>Introducing the heart chakra or Anahata<br>
          Chakra key elements<br>
          First, we’re going to look at the heart chakra key attributes:</p>
      <p>Location: In the center of the chest (the energy center is not located where our actual heart organ lies; rather, the heart chakra is in the center of the chest area); it is the 4th chakra counting from the bottom of the spine in the traditional 7 chakra system.<br>
          Color: Green (higher energy frequencies can turn to pink)<br>
          Symbol: Two intersecting triangles forming a 6-pointed star in a circle with 12 petals<br>
          Original name in Sanskrit: Anahata<br>
          Element: Air</p>
      <p>Additional elements used in modern healing practices to balance the heart chakra are crystals or gemstones and aromatherapy. If you’re curious, here’s a list of the most common ones used to activate or balance the fourth chakra:</p>
      <p>Heart chakra healing stones: Pink quartz, clear quartz, jade, green calcite<br>
          Essential oils: Rose, geranium, neroli, ylang ylang, jasmine, bergamot<br>
          Other key elements associated with the heart chakra are:</p>
      <p>Glands or bodily functions: Thymus gland, responsible for hormone production and important in the regulation of the immune system.</p>
      <p>Heart Chakra Psychological Meanings<br>
          The main meanings or functions associated with the heart chakra are:</p>
      <p>Love for oneself and others<br>
          Relating, relationships<br>
          Compassion, empathy<br>
          Forgiveness, acceptance<br>
          Transformation, change<br>
          Ability to grieve and reach peace<br>
          Compassionate discernment<br>
          Center of awareness, integration of insights<br>
          When the heart chakra is open, you may feel being deeply connected, the harmonious exchange of energy with all that is around you, and the appreciation of beauty. However, when there’s a blockage in the heart chakra, you may experience difficulties in your relating with others, such as excessive jealousy, codependency, or being closed down, withdrawn.</p>
      <p>Heart Chakra Element: Air<br>
          The fourth chakra is related to the element of air. As such, its energy is associated to the breath and its movements, as well as the idea of spaciousness and connection with all things.</p>
      <p>Heart Chakra Color: Green<br>
          Even though most of us think about the pink color when thinking about the heart, this chakra is traditionally associated with the color green. The auric color of an active fourth chakra can also be seen as a pink or smoky pink, hence our popular representation of love as a pink heart.</p>
      <p>Chakra Location: The Chest<br>
          The most commonly accepted location for the fourth chakra is at the center of the chest, between the breasts. It’s slightly to the left of the actual organ of the heart. That’s why it’s often referred to as the “heart chakra”.</p>
      <p>As the fourth energy center, it’s important to remember that it is multidimensional and is energetically represented with a front going through the center of the chest, and a back going through the spine between the shoulder blades.</p>
      <p>Because of its location, the heart chakra is associated to the cardiac system and the lungs.  These organs are interdependent and rely on air and breathing to function properly. The gland associated with the heart chakra is the thymus, which is in charge of regulating the immune system.</p>
      <p>Chakra Symbol<br>
          The symbol for the heart chakra is traditionally composed of:</p>
      <p>A circle with twelve petals<br>
          An downward-pointing triangle interlaced with an upward-pointing triangle, forming a six-pointed star or hexagram<br>
          The intersecting triangles represent the air element and its all-encompassing quality. They also symbolize the union of seemingly opposite principles or types of energies, such as male and female, spirit and matter. The star that they form evokes the harmonious joining of forces and highlights the function of the heart chakra as a center of integration and connection. The twelve petals are often depicted with the color red.</p>
      <p>What does Anahata mean?<br>
          The fourth chakra is referred to as:</p>
      <p>Heart chakra<br>
          Anahata<br>
          Hritpankaja<br>
          Dbadasjadala<br>
          Chakra 4<br>
          The most common Sanskrit name for the heart chakra is “Anahata“, which means “unstruck.”</p>
      <p>What role the fourth chakra plays in our lives<br>
          The Heart chakra is associated with the following psychological and behavioral characteristics:</p>
      <p>Capacity to love<br>
          Integration, bridge between earthly and spiritual aspirations<br>
          Transcending personal identity and limitations of the ego<br>
          Experience of unconditional love and connection with all<br>
          Heart-centered discernment<br>
          Appreciation of beauty in all things<br>
          Experiencing deep and meaningful relationships<br>
          The fourth chakra connects the lower and upper chakras. In other words, the heart chakra acts as a center of integration of earthly matters and higher aspirations. Far from seeing these energies as separate, the experience of the heart integrates them effortlessly and harmoniously.</p>
      <p>The Heart chakra is all about connecting and relating. The emphasis here is on love, giving and receiving, and how open we are in relationships. Love is the energy that helps transfigure emotions and experiences. It’s an essential element in any relationship, whether it’s is with others or oneself.</p>
      <p>Love experienced through the fourth chakra is not just about romance, but about going beyond the limitations of the ego and personal preoccupations to open up more fully to compassion and acceptance of all that is, as it is. When we live from our heart and our heart energy is opened and balanced, we can see clearly and position ourselves in any situation, no matter how challenging it is, with discernment and compassion.</p>
      <p>The heart chakra is also a center through which we experience beauty in life. Seeing the world through a balanced fourth chakra is being in a state of openness and acceptance that brings us in touch with our world and ourselves in profound and fulfilling ways.</p>
      <p>Signs your fourth chakra may be out of balance<br>
          The heart chakra can become imbalanced as a result of life experiences that have a strong emotional charge, physical illments, or significant changes in your environment. It may manifests as a blockage in the energy flow or, on the contrary, a tendency to become overactive or have an excess of energy.</p>
      <p>You can see the following signs of imbalance in the heart chakra :</p>
      <p>Being overly defensive<br>
          Feeling closed down<br>
          Jealousy; fear of intimacy<br>
          Codependency, relying on other’s approval and attention, trying to please at all cost<br>
          Always putting oneself in the role of the savior or the rescuer; or on the contrary, falling into victimization<br>
          Excessive isolation, being recluse, antisocial<br>
          Holding grudges, not being to forgive<br>
          At the physical level, it can manifest as:</p>
      <p>Respiratory ailments, such as lung infection, bronchitis<br>
          Circulatory and heart-related issues<br>
          When the energy in your fourth chakra is blocked or hindered, you may experience what is sometimes referred to as heart chakra pain.</p>
      <p>Simple ideas to balance the heart chakra<br>
          To get started, try out these few simple practices:</p>
      <p>Work with the breath to balance your energy; observe it, play with it with breathing exercises<br>
          Cultivate your appreciation for beauty, whether it’s in nature, people or in the arts<br>
          Practice self-care and love your body up, from a good bath with rose essential oil to yoga poses opening the heart area<br>
          Cultivate self-compassion and acceptance, especially with regards to your emotions and body<br>
          Engage in activities that feed your heart<br>
          Focus on receiving if you are naturally inclined to be a giver; and on giving if you’re more inclined to receive all the time<br>
          Reflect on old wounds inherited from family relationships and come to terms with them compassionately; practice forgiveness deep within your heart<br>
          Express your gratitude, even if it’s in silence; you can be grateful for the presence of other people in your life or simply for good things that make your life easier and happier<br>
          Check out these resources to discover more ways to open and heal the heart chakra.<br>
      </p>
      <p>B. HEART CHAKRA SYMBOL</p>
      <p>By looking at the heart chakra symbol, we can start to better grasp in a symbolic form the meanings carried by the energy of the 4th chakra or Anahata. This symbol, also named “yantra” in some traditions, represents ideas, meanings, and energies in tangible, a graphical form. The symbolic elements and colors associated with the heart chakra can vary from one tradition to another. We’ll focus on the most common symbols. Let’s have a closer look at the philosophy and symbolism behind this chakra symbol.</p>
      <p>Anatomy of the heart chakra symbol<br>
          The symbol for the heart chakra is composed of the following elements:</p>
      <p>A six-pointed star or hexagram, also referred to as Shaktona;<br>
          Twelve petals positioned in circle, depicted with the a rich color red or vermilion; this part of the symbol is sometimes referred to as a twelve-petaled lotus flower;<br>
          In the Hindu tradition, the deity associated with the heart chakra is Vayu, who sits at the center of the symbol, riding an antelope or deer;<br>
          Inside the main circle, we can find another eight-petaled circle, also refered to as eight-petaled lotus (in the hindu tradition).</p>
      <p>Symbolic elements<br>
          The hexagram or six-pointed star symbolic of the heart chakra qualities<br>
          The hexagram is made of two interlaced triangles, one pointing up and one pointing down. They symbolize the power of spirit and the power of matter coming together, the feminine and masculine in harmony.<br>
      </p>
      <p>Symbolism of the twelve petals<br>
          On each petal is inscribed a Sanskrit syllable: syllables kam, kham, gam, gham, ngam, cham, chham, jam, jham, nyam, tam and tham. Energy flows in and out of the petals, carried by the syllable sound, in twelve directions. Each petal represents a plexus where the channels of energy also called “nadis” converge. The syllables symbolically represent the vital energy that comes from these points ( “The Encyclopedia of Tibetan Symbols and Motifs” by Robert Beér). These movements of energy are activated with each inhalation and exhalation and correspond to twelve mental states or “vritties”: fraud, lustfulness, indecision, hope, anxiety, repentance, possessiveness, incompetence, discrimination , impartiality, arrogance, and defiance. The list vary slightly from one tradition to another.</p>
      <p>The center of the heart chakra symbol: Deity, seed syllable, and animal<br>
          At the center of the heart chakra symbol, we can traditionally find a deity, an accompanying animal, and a seed syllable. The deity presiding the heart chakra has different names, depending on the tradition and translation. It is called Rudra or Ishana Rudra Shiva, and comes together with the goddess Kakini, considered as the doorkeeper of the Anahata chakra. The seed syllable for the heart chakra is “Yam” (sometimes also translated by “Yang”), carrying the meaning of the air or wind element. This sound or “mantra” is connected to the control over the air and the breath.</p>
      <p>The deer or antelope and the spirit of gentleness and grace<br>
          The deer or antelope is the carrier of the seed sound. This animal symbolizes the heart and its qualities mirror the type of energy or process we go through in the matters of the heart. For example, the antelope might be vigilant at all times and react to the slightest perceived threat. In our spiritual journey, we may be experiencing similar states, jumping or running away when scared. On the other side, the spirit of the deer or antelope is characterized by gentleness, grace, and innocence. These qualities can also be found in a person who’s living from the heart chakra.<br>
      </p>
      <p>C. OVERACTIVE HEART CHAKRA <br>
          An overactive heart chakra can lead to a lack of discernment in relationships. Located at the center of the chakra system, the Anahata or heart chakra is often seen as the point of integration of personal and altruistic aspirations through love and relating. When this energy center is going on overdrive, it can blur the boundaries between oneself and others to the point of losing your sense of identity and misusing the power of love.</p>
      <p>Symptoms of an overactive heart chakra<br>
          It is associated with how you relate to yourself and others. Since the heart chakra is tied to emotions and love, people with overactive heart chakras are ruled by their emotions. They may be unable to regulate them, or be unable to let go of past pain.</p>
      <p>Common symptoms of an overactive fourth chakra include:<br>
          Loving indiscriminately<br>
          Lack of proper boundaries in friendships and intimate relationships<br>
          Tolerating too much from others to the point of neglecting emotional self-care<br>
          Acceptance of others without discernment<br>
          Losing your sense of identity<br>
          Giving to others or to a cause without restraints<br>
          Saying yes to everything and everyone, even when it does not benefit you<br>
          Codependency<br>
          Physical symptoms of an overactive heart chakra may be:</p>
      <p>Heart and circulatory problems like high blood pressure, heart palpitations, and heart attack<br>
          Lung issues</p>
      <p>How to balance overactivity in the heart chakra<br>
          We encourage you to look at the heart chakra healing tips for comprehensive advice on how to restore balance in the heart chakra. When this energy center is weakened by circumstances or has not developped properly, it may have the tendency to become overactive or, on the contrary, blocked. These are imbalances that can be corrected by harmonizing the whole chakra system and supporting the heart chakra in developing a more healthy way to handle energy.</p>
      <p>Chakras become overactive because they are compensating for blocked energy in other chakras, so part of healing an overactive heart chakra is to learn which other chakras are blocked and work on opening them. This can be accomplished by working on all the chakras, or by going to an intuitive or energy healer to help locate and work on the blocked chakra. Balancing all seven chakras is always beneficial.</p>
      <p>During that process, focusing on the heart chakra alone will still help manage the symptoms. Meditation and energy healing focusing on the heart will help even out the flow of energy through it. The heart chakra is associated with the color green, so meditating on a green ball of energy in your chest or seeing green energy flow through your body can help balance your heart chakra.</p>
      <p>Going green to soothe hyperactivity in the heart chakra<br>
          Air is the element of the Anahata or heart chakra, so getting outdoors and into nature can also help manage an overactive heart chakra. Nature and its green allure are excellent support to harmonize imbalanced energy. Hiking through the forest or simply sitting outside on a nice day restores balance. Even opening a window and letting the fresh air blow through your home or office could give you a good start.</p>
      <p>Wearing green or pink, and surrounding yourself with these colors can also help balance the heart chakra. Wearing or meditating with healing crystals like rose quartz, jade, emerald, malachite and other green stones is also beneficial.</p>
      <p>&nbsp;</p>
      <p>D. BLOCKED HEART CHAKRA<br>
          The fourth chakra, also known as the heart chakra or Anahata, is the center of love and connection. A strong, balanced heart chakra allows you to live freely and openly from a place of compassion. However, a blocked heart chakra can interfere with your happiness and relationships in many ways.</p>
      <p>Symptoms of a Heart Chakra Imbalance<br>
          A blocked heart chakra manifests as a lack of love and compassion. Symptoms include:</p>
      <p>Loneliness<br>
          Shyness and social anxiety<br>
          Being overly critical towards yourself and others<br>
          Holding grudges<br>
          Inability to give or receive freely<br>
          Suspicion and fear, especially in friendships and romantic relationships<br>
      </p>
      <p>A blockage in the heart chakra can also lead to physical symptoms like poor circulation, heart troubles, and respiratory illness like asthma. If you consistently have an issue with these conditions in your life, clearing your heart chakra may help you recover from them and lead a healthy life, both emotionally and physically.<br>
          Symptoms of imbalance can also point to an overactive heart chakra, which is when the attributes associated with this energy center are expressed in excess.</p>
      <p>.<br>
      </p>
      <p>Tips for Healing the Fourth Chakra<br>
          There are many ways to help balance the fourth chakra. The simplest is to surround yourself with things that stimulate it. Its color is green, so wearing green clothing or jewelry and lighting green candles can help open and balance it. Chakra healing crystals are very useful for this. For opening the heart chakra, wearing green stones like emerald, malachite, jade and green tourmaline is best. If possible, wear them as a necklace so that the stone rests close to the heart chakra itself.</p>
      <p>Regular meditation and yoga practice is also useful for healing the chakras. Imagine a ball of green healing energy in your chest, gently removing the blockage and opening your heart. Since Anahata’s element is air, deep breathing or pranayama practice is ideal. Yoga asanas that open the chest like Eagle Pose and backbends are helpful as well.</p>
      <p>Since a blockage in the fourth chakra makes it difficult to give, getting out and volunteering can help release old fears. Choose a charity that speaks to you and that allows you to share your talents with others. Since being in the fresh air is healing, something that allows you to be outdoors is even better.</p>
      <p>Finally, practice letting go of anger or fear in your everyday life. When you find yourself holding onto a negative emotion, take a deep breath and imagine a green light pouring into your body and washing it away, filling you with love. With practice, this will help you avoid falling into those negative patterns and react from a place of compassion instead.<br>
      </p>
      <p>E. HEART CHAKRA PAIN<br>
          Have you ever felt pain in your heart chakra? Manifesting as emotional symptoms, such as sadness, moodiness, mistrust or being overly critical or possessive, pain in the sensitive heart chakra can lead to a whole range of adverse reactions. Physical imbalances in this chakra might include a cardiac or respiratory issue or a feeling of pain and heaviness in the heart.</p>
      <p>Heart Chakra Imbalance: Causes<br>
          Heart chakra pain is often associated with having a “broken heart,” from being let down in some way by someone you love or loved. Rejection, abuse, grief, trauma and loss are emotionally painful to experience and can leave an energetic imprint in the heart chakra.</p>
      <p>The heart chakra is located in the chest area and bridges the lower and upper chakras. In effect, it connects the physical with the spiritual. When the energy in this center is disturbed or blocked, you may experience a resurgence of painful or negative emotions.</p>
      <p>&nbsp;</p>
      <p>Heart Chakra Pain: Physical Issues<br>
          A blocked heart chakra hurts on an emotional level, but it can also lead to the manifestation of physical disease and illness if not addressed, cleared and healed. Heart disease, cardiovascular disease, coronary artery disease, abnormal heart rhythms, arrythmias and congenital heart disease are just some of the physical manifestations of heart chakra imbalance. Lung and respiratory issues including asthma, pulmonary disease, emphysema, chronic bronchitis and pneumonia can also arise. Breast cancer and upper back issues can result, and a disruption to the thymus gland can impede immune system functioning.</p>
      <p>Heart Chakra Blockage: Emotional Issues<br>
          Of all the chakras, the heart chakra is central to our ability to give and receive love. Emotions connected with the heart chakra include love, hate, anger, bitterness, resentment, grief, forgiveness, compassion, loneliness, self-centeredness, generosity, gratitude, commitment, trust, loyalty and the ability to follow one’s heart. Life experiences and issues that impact the fourth chakra include death of a loved one, divorce, rejection, breach of trust, adultery, abandonment, injustice and emotional abuse.</p>
      <p>Clearing and Healing Heart Chakra Pain or Imbalance<br>
          The heart chakra is central to our ability to give and receive love, and love is the base and source of all healing. Love comes from three main sources — from others, from within ourselves (self-love) and from a Universal source (Divine Love). All of these kinds of love register within the heart chakra, and all can have a profoundly healing effect. Loving and forgiving yourself and others is central to healing and releasing blockages of the heart chakra, since holding on to resentments from the past hurts yourself the most. Finding the lesson in a painful experience and releasing the grievance has tremendous healing effects.</p>
      <p>Practicing self-love and self-respect are key to heart chakra healing. This is best accomplished by tuning into the spiritual part of yourself — your soul or essence — and radiating love to the human part of yourself. Send love and gratitude toward what you appreciate about yourself, and forgiveness and compassion toward your shortcomings. Over time, you will develop a strong core of self-love which will radiate from your heart chakra and help keep it balanced.</p>
      <p>Another way to heal your heart chakra (or any of your chakras) is to receive regular chakra balancing treatments. Energy healing works at the level of Divine Love or Source as Universal energies are invited in to heal, restore and balance the chakras.</p>
      <p>&nbsp;</p>
      <p>A Heart Chakra Health Plan<br>
          Self-love. Meditate regularly and have the your spiritual self send love, appreciation, compassion and forgiveness to your human self. Visualize your heart chakra as a beautiful, radiant green orb glowing with unconditional love; imagine any past hurts or blockages healing and dissolving.<br>
          Keep a gratitude journal. At the end of each day, write down at least five things you were grateful for; when you wake up the next morning, read what you wrote the previous night. Breathe that feeling of gratitude in and out of your heart chakra as you begin your day.<br>
          Practice kindness. Try and make it a habit to send genuine good wishes to yourself and others. The Buddhist metta (lovingkindness) prayer is an excellent way to do this.<br>
          Maintain balance. Receive regular chakra balancing treatments from a qualified energy healing practitioner.<br>
      </p>
      <p>&nbsp;</p>
      <p>F. OPENING YOUR HEART CHAKRA<br>
          The heart chakra occupies a central place in the chakra system. Located between the three lower chakras and three upper ones, it is often seen as playing the role of bridge or center of transformation of energies between the physical and the spiritual. As the center of love, the heart chakra helps heal and transform the physical energies into spiritual energies and vice and versa, supporting harmonious integration of all aspects of oneself.</p>
      <p>How to open the heart chakra<br>
          There are many ways to open the heart chakra and restore balance in this energy center. We’ll review a few of them. The most accessible and first step to open your heart chakra is to turn within oneself and work towards self-acceptance. This is based on the principle that in order to love and open to love, one must feel at ease and loving within. The idea is that opening your heart chakra and keeping it open and balanced is supported by becoming more integrated. In order to open the heart chakra we can practice:</p>
      <p>Acknowledging different parts of yourself that are at play in our daily life; some easy to recognize, some may be hiding in our shadow with guilt and shame or anger;<br>
          Honoring and accepting the different aspects of our personality;<br>
          Learning how to provide self-love<br>
          Working out inner conflicts<br>
          Learning how to make workable alliances with parts of yourself that tend to resist<br>
          Taming our inner critic and be less judgmental towards oneself<br>
          Traditional psychotherapeutic or self-development approaches might be helpful in identifying and working with the areas of resistance of blockage affecting the opening of your heart chakra.</p>
      <p>Why Opening the Heart Chakra<br>
          Despite its name, the heart chakra is not solely focused on feelings and emotions associated with love. To simplify, the realm of emotions is typically more tightly associated with the second chakra or navel chakra. The heart chakra can be seen as the doorway to other dimensions of one’s experience of reality [Note: Barbara Brennan – Hands of Light], where we can experience more universal feeling of love that are less personalized. Therefore, opening the heart chakra refers to relaxing into a space where love and acceptance expand from individual preoccupation into a larger experience of love. By opening your heart chakra and anchoring yourself in its energy, you are going beyond the preoccupations typically associated with the lower three chakras. Concerns over safety and survival, emotions and sexuality, and the way others see you, social status or power do not disturb you any more. When the heart has been opened, one becomes naturally good to others and oneself. Having an open fourth chakra does not necessarily mean that have to be spiritual or that you’re a saint, but it supports love for all things and unconditional acceptance.<br>
      </p>
      <p>What You Can Expect When Your Heart Chakra Opens<br>
          When you open and balance your 4th energy center, you may experience the following heart chakra opening symptoms:</p>
      <p>Feeling love for others, for life in general<br>
          Being more compassionate<br>
          Being more acceptant with yourself<br>
          Feeling inclined to forgive<br>
          Better overall sense of balance and well-being<br>
          Integration between with physical and earthly plane needs and spiritual aspirations<br>
          Altruism, selflessness<br>
          Harmonious, balanced control of the senses and emotions (does not feel like constriction or excessive control)<br>
          Balance of female and male energies within oneself<br>
          Harmony in relationships<br>
          Opening the heart chakra is an essential practice in a number of spiritual traditions. The fourth chakra becomes the mediator for divine love and access to non-dual states where there is only love, where the one who loves and the object of love, the lover and the beloved are one. As a person living in your 4th chakra, you may start to see love in anything and everything, being at peace and centered in your heart no matter the circumstances. You may find yourself effortlessly trusting other and interacting with people in a loving and graceful way.<br>
      </p>
      <p>G. HEART CHAKRA HEALING</p>
      <p>Heart chakra healing might be needed when the heart center is closed and its energies are blocked or unbalanced. The heart chakra is like a conduit for a form of energy that is commonly associated with love. When the energy of the heart chakra does not flow, one may experience it at different levels, from physical and emotional to existential. By healing the heart chakra, one may experience a boost in energy, positivity, love, compassion, and increased sense of connectedness to life.</p>
      <p>What does healing the heart chakra mean?<br>
          Healing the heart chakra may mean several things and refers to many different techniques. We will cover the main ones and remain as practical as possible. Heart chakra healing is sometimes also referred to as balancing, opening, or clearing. The main idea behind healing the heart chakra is to restore flow of energy and overall balance.</p>
      <p>Why do we need heart chakra healing?<br>
          The heart chakra is particularly vulnerable to disturbances associated with relationships and love. We all have a history of relationships from the moment we’re born to now. During our history, there were many events and opportunities for positive or negative experiences regarding love and relating to others.<br>
          As we encounter life difficulties, we have two main ways to cope: We may shut down or decrease the energy that we dedicate to the situation, or we may boost or increase our energy to fight it. These defense mechanisms get anchored in our chakras.</p>
      <p>In the case of the heart chakra, we might have felt hurt during childhood or a recent breakup and closed our chakra to numb our pain and avoid suffering. Or on the opposite side, we may have opened and extended our heart energy to a demanding partner or parent in need, sometimes to the point of over-extending and being drained.<br>
      </p>
      <p>Over time, these defense mechanisms can cause imbalance in the heart chakra and other chakras, leading to an overactive, deficient or blocked chakra. One may tend to have excess or deficiency in the heart chakra, or both depending on the situation and coping mechanism.<br>
          When do you need to heal the heart chakra: Signals and Symptoms<br>
          When the heart chakra needs healing may be signaled by a variety of symptoms ranging from the physical to existential and spiritual.</p>
      <p>Physical heart chakra Signals<br>
          The 4th chakra is associated with the element of air and is located in the chest area. As a result, a lot of the physical symptoms of heart chakra imbalance are connected to the lungs, ribs, and heart. Look for the following: Hypertension, problems breathing, infection at the level of the lung, bronchitis, heart condition.</p>
      <p>Psychological and Emotional Heart Chakra Signals<br>
          When the heart chakra is deficient or closed, it may translate into the following psychological and emotional characteristics:</p>
      <p>&nbsp;</p>
      <p>Being withdrawn<br>
          Avoiding socializing, social interactions<br>
          Being overly critical of others and oneself<br>
          Lacking empathy<br>
          Feeling isolated<br>
          If the heart chakra is overly open, it may translate into:</p>
      <p>Being overly demanding of others, especially close family or partner<br>
          Extending yourself to fulfill other people’s perceived needs to the cost of one’s own balance<br>
          Tendency to feeling like a victim<br>
          Losing sense of personal boundaries in a way that is detrimental to your well-being<br>
          Balancing and Healing the Heart Chakra<br>
          When the heart chakra becomes unbalanced, this may lead to emotional, physical or even existential distress. The energy running though this chakra is not flowing freely and you may feel drained, depleted, stuck in thoughts or behavioral patterns.</p>
      <p>To overcome a blockage, excess or deficiency in the heart chakra, the energy needs to:</p>
      <p>Be able to move freely (one may need to loosen up constrictions or interferences, such as continuous stress, physical muscle tension, improper diet, negative influence of others, limiting beliefs or attitude)<br>
          Move in a patters that is suitable to this chakra<br>
          Be balanced with other energies (we need to take into consideration the whole chakra and energy system; for instance, stress or imbalance in neighboring chakras might influence the state of the heart chakra)<br>
      </p>
      <hr>
      <p><strong>THROAT CHAKRA</strong><a name="throat" id="throat"></a></p>
	  <p>
	  Located in the base of the throat, the Throat Chakra helps us to speak our truth. It deals with the issues of creativity, communication, and the will to live. Physical manifestation of this chakra's imbalances may show up as thyroid problems, TMJ, sore throat, swollen glands, or scoliosis.</p>
	  <p>

Emotionally, we are afraid of silence, fearful of being judged and rejected, and imbalances in this chakra can also be connected to addiction. When Reiki is performed to help clear this chakra, we become more able to express ourselves or follow our dreams.	  </p>
	  <hr>
      <p>A. THROAT CHAKRA BASICS<br>
          B. THROAT CHAKRA SYMBOL<br>
          C. BLOCKED THROAT CHAKRA<br>
          D. OPENING YOUR THROAT CHAKRA<br>
          E. OVERACTIVE THROAT CHAKRA<br>
          F. THROAT CHAKRA HEALING</p>
      <p>A. THROAT CHAKRA BASICS</p>
      <p>The Throat chakra is the fifth chakra. Located at the center of the neck at the level of the throat, it is the passage of the energy between the lower parts of the body and the head. The function of the Throat chakra is driven by the principle of expression and communication.</p>
      <p>Throat chakra meaning<br>
          The fifth chakra is referred to as:</p>
      <p>Throat chakra<br>
          Vishuddha<br>
          Kanth Padma<br>
          Shodash Dala</p>
      <p>The most common Sanskrit name for the Throat chakra is “Vishudda”, which means “pure” or “purification”.<br>
          This chakra is related to the element of sound. Through the throat, sound is propagated into the air and its vibration can be felt not just in our ears, but also in our whole body. It is an important instrument of communication and expression.</p>
      <p>Throat chakra color<br>
          The Throat chakra is most commonly represented with the color blue turquoise or aquamarine blue. The auric color of Throat chakra energy can also be seen as a smoky purple or turquoise.</p>
      <p>Throat chakra symbol<br>
          The symbol of the Throat chakra is composed of:</p>
      <p>A circle with sixteen petals<br>
          A crescent with a circle inside of it<br>
          Sometimes, it is symbolized by a circle containing a downward-pointing triangle in which is inscribed another circle</p>
      <p>The color of the petals is depicted as smoky purple or grayish lavender.</p>
      <p>Location of the Fifth Chakra<br>
          The most commonly accepted location for the fifth chakra is at the level of the throat. It’s important to remember that this chakra is multidimensional and is often represented as going out of the front of the throat, and going in the back at a slight upward angle.</p>
      <p>The Throat chakra is associated to the pharyngeal and brachial plexi and is connected to the mouth, jaws, tongue, pharynx and palate.  It’s is also linked to the shoulders and the neck. The gland associated with the fifth chakra is the thyroid, which regulates the processing of energy in the body through temperature, growth, and in large parts, metabolism.</p>
      <p>Behavioral characteristics of the Throat chakra<br>
          The Throat chakra is associated with the following psychological and behavioral characteristics:</p>
      <p>Expression, in particular ability to express your truth, to speak out<br>
          Communication, whether it’s verbal or non-verbal, external or internal<br>
          Connection with the etheric realm, the more subtle realms of spirit and intuitive abilities<br>
          Propensity to create, projecting ideas and blueprints into reality<br>
          Realizing your vocation, purpose<br>
          Good sense of timing<br>
          The Throat chakra is about the expression of yourself: Your truth, purpose in life, creativity. Note that this chakra has a natural connection with the second chakra or sacral chakra, center of emotions and creativity as well. The throat chakra’s emphasis is on expressing and projecting the creativity into the world according to its perfect form or authenticity.</p>
      <p>Another function of the throat chakra is to connect you to spirit. Because of its location, it’s often seen as the “bottleneck” of the movement of energy in the body.  It sits just before the upper chakras of the head. Opening the throat chakra can greatly help align your vision with reality and release pressure that may affect the heart chakra that is located just below.<br>
          The throat chakra is associated with the etheric body, which is said to hold the blueprint or perfect template of the other dimensions of the body. It’s an important reference point to align the energy through the whole chakra system.</p>
      <p>5th chakra imbalance<br>
          A blocked throat chakra can contribute to feelings of insecurity, timidity, and introversion. On the other end of the spectrum, an overactive throat chakra may also lead to gossiping, nonstop talking, and being verbally aggressive or mean. It can seem as though the filter between the discourse you have in your mind and what comes out of your mouth is not working, or missing entirely.</p>
      <p>When the throat chakra has an imbalance, it can manifest as:</p>
      <p>Lack of control over one’s speech; speaking too much or inappropriately;<br>
          Not being able to listen to others<br>
          Excessive fear of speaking<br>
          Small, imperceptible voice<br>
          Not being able to keep secrets, to keep your word<br>
          Telling lies<br>
          On the opposite side, a closed throat chakra might manifest as excessive secretiveness or shyness<br>
          Lack of connection with a vocation or purpose in life<br>
      </p>
      <p>B. THROAT CHAKRA SYMBOL</p>
      <p>The throat chakra’s symbol meaning is one of sound, wisdom, and consciousness. Associated with the element of ether (or Akasha), the throat chakra is governed by Brahma, the Hindu god of creation and wisdom.</p>
      <p>Throat Chakra Symbol Meanings<br>
          The crescent-shaped throat chakra image, imbedded in a white (or sometimes light blue) circle, is inspired by the moon, purity, and cosmic sound and is surrounded by lotus petals.</p>
      <p>One explanation of the significance of these elements is their relationship to the ultimate goal of meditation — to blend with Akasha to achieve higher consciousness. The transcendence of human consciousness is itself an act of purification. In order to achieve that level of purification, the throat chakra must be open and balanced.</p>
      <p>Symbol Color: Pure Blue<br>
          Positioned between the head and heart, linking feeling and thought, the throat chakra is tied directly to the purification of the body, mind, and spirit. The throat chakra symbol is oftentimes depicted as shades of radiant blue, the color of wisdom, faith, purification, and trust.</p>
      <p>Symbolic Animal Associations<br>
          Commonly known as the Vishuddha chakra, the fifth chakra is associated with the exalted white elephant. In Hindu tradition, the white elephant, Airavata, carries Indra, the god of thunder and rain. The white elephant is symbolic of:</p>
      <p>strength<br>
          prosperity<br>
          luck</p>
      <p>The Throat Chakra: A Symbol of Awakening<br>
          Brahma is said to have been born from a lotus flower positioned in the navel of Lord Vishnu. Similarly, Buddhist tradition states all souls come from the lotus. Therefore, it’s only fitting the lotus flower is representative of the development of human consciousness.</p>
      <p>Within the Hindu tradition, the lotus flower itself is associated with:</p>
      <p>beauty<br>
          fertility<br>
          spirituality<br>
          eternity<br>
          The sixteen lotus petals surrounding the throat chakra symbol are often inscribed with Sanskrit letters; namely, the vowels. Why vowels? They represent the breathy, airy elements of words — just like ether is the airy element of space.</p>
      <p>The inverted triangle of the throat chakra symbol is also symbolic of spiritual growth. The downward position is affiliated with the gathering of information, while the widening upward sides represent the blossoming knowledge leading to Enlightenment.<br>
      </p>
      <p>C. BLOCKED THROAT CHAKRA<br>
          A blocked throat chakra can significantly impact your ability to communicate effectively for fear of ridicule and judgement. A throat chakra blockage can also manifest as the inability to express and realize your truth in the world. When the fifth chakra is open and balanced, you are able to express yourself clearly and honestly in any situation with confidence.</p>
      <p>Common Signs of Throat Chakra Blockage<br>
          You may find yourself unable to speak your truth when you need it the most, or holding back on expressing your needs and desires. Perhaps, you long for realizing your dreams and living with a strong and clear purpose, but seem to not be able to quite get there. These are common signs that your throat chakra  does not function at its optimal level.</p>
      <p>Here are resources to help restoring balance in this chakra:</p>
      <p>Throat chakra healing<br>
          How to open the throat chakra</p>
      <p>&nbsp;</p>
      <p>Physical Symptoms of Blocked Energy in the Throat Chakra<br>
          When the throat chakra is blocked or otherwise imbalanced, energy flow is hindered and can lead to physical symptoms affecting the head, mouth, throat, and neck. It is not uncommon to experience neck pain, headaches, hoarseness, and sore throat when the flow of energy through the throat chakra is disrupted.</p>
      <p>Some common physical symptoms of blockage include:</p>
      <p>chronic sore throat<br>
          frequent headaches<br>
          dental issues<br>
          mouth ulcers<br>
          hoarseness<br>
          thyroid problems<br>
          laryngitis<br>
          Temporomandibular disorders of the jaw (commonly known as TMJ)<br>
          neck pain<br>
          Consequently, the blockage can also impact your physical health. When you experience such signs of physical discomfort, healing practices focusing on the upper body area, in particular your neck and shoulders, can bring relief and allow energy to move more freely. Of course, for serious and recurring symptoms, please consult a physician whom you trust.</p>
      <p>Emotional Signs of Throat Chakra Blockage<br>
          When the throat chakra is imbalanced, the blockage can also manifest through non-physical symptoms that may impact you at various levels from psychological and emotional, to psychically and spiritually.<br>
      </p>
      <p>Non-physical signs of blockage can be more prevalent. Among the more commons signs are:<br>
          fear of speaking<br>
          inability to express thoughts<br>
          shyness<br>
          inconsistency in speech and actions<br>
          social anxiety<br>
          inhibited creativity<br>
          stubbornness<br>
          detachment<br>
          For instance, perpetuated blockages that are fairly significant can cause one to become arrogant, deceptive, domineering, or manipulative. On the contrary, energy that flows freely through the throat chakra promotes effective, truthful communication. You are able to “find you.” You are confident, responsible, and can easily find the right words to express your thoughts.</p>
      <p>A blockage of the throat chakra can cause you to become stoic, quiet, and fearful. The imbalance may also create feelings of anxiety, insecurity, and shyness when it comes to self-expression and speaking to others. Public speaking can cause near paralysis when the issue is a blocked fifth chakra.</p>
      <p>An imbalance in the throat chakra can adversely affect many aspects of your personal and professional life. You may find you avoid social situations and are more comfortable alone. You may even become distrustful of your inner voice.</p>
      <p>What To Do About A Blocked Throat Chakra<br>
          Clearing the throat chakra involves learning to let go and trusting your inner voice. Not a small task for a lot of us! Check out the general guidelines for throat chakra healing for practical ideas on how to restore balance in this center.</p>
      <p>A few basic steps to clear this chakras include:<br>
          Working through and releasing all negative emotions, including guilt, hurt, and resentment can work wonders to restore energy balance in the throat chakra. Sometimes a good cry can also help alleviate a blockage of the fifth chakra.<br>
          Practicing mindful speech, action, and deeds can help you maintain throat chakra balance. For example, talk openly and honestly with others on a regular basis.<br>
          Meditating on and incorporating the throat chakra’s color, blue, into your life can also calm emotional upheaval. For instance, introduce blue-colored flowers or decor to your home environment.<br>
      </p>
      <p>&nbsp;</p>
      <p>D. OPENING YOUR THROAT CHAKRA</p>
      <p>The throat chakra is the energy center associated with self-expression and communication. Positioned at the base of the throat, the fifth chakra is also considered the “seat” of emotion. Life experiences may result in chakra imbalance and block the energy flowing through this energy center. Here are some tips to opening your throat chakra and restore balance.</p>
      <p>When do you need to open your throat chakra?<br>
          Known as the Vishuddha chakra, it governs all areas of the mouth, jaw, throat, and thyroid gland. When the throat chakra is imbalanced, you may experience:</p>
      <p>hoarseness<br>
          sore throat<br>
          thyroid problems<br>
          laryngitis<br>
          neck pain<br>
          Emotional signs your throat chakra may need opening can include:</p>
      <p>depression<br>
          inability to express yourself<br>
          anxiety<br>
          aggression<br>
          lack of self-esteem</p>
      <p>How to Open your Throat Chakra<br>
          Associated the the color blue, the throat chakra enables you to discover yourself and speak with wisdom and honesty regardless of the situation or company you are in. When the fifth chakra is in need of healing, there are several simple steps and exercises you can do to strengthen and restore chakra balance.</p>
      <p>Using Chakra Colors: Be Blue<br>
      </p>
      <p>Using chakra colors to support or stimulate the fifth chakra opens up a whole array of possibilities. For example, incorporating the color blue into your decor at home and work is a nice, subtle way to bring focus to the throat chakra. The calming effect of this color of wisdom and honesty can help open up and heal a blocked fifth chakra. Wearing precious or semi-precious blue stones is a great boost for chakra healing and balance. Meditating on the color blue also helps alleviate throat chakra imbalance.</p>
      <p>Cleanse with Water</p>
      <p>Make a conscious effort to drink more water throughout the day. Not only does water help keep you hydrated, it also helps to cleanse the throat chakra allowing for healthy energy flow.</p>
      <p>Eat More Fruit</p>
      <p>Add apples, peaches, lemons and limes to your diet to cleanse and activate the throat chakra.</p>
      <p>Clear the Air</p>
      <p>At-home aromatherapy can help dispel negativity and restore balance to the chakras. Consider introducing one or a combination of these scents to heal and activate your fifth energy center:</p>
      <p>jasmine<br>
          rosemary<br>
          sandalwood<br>
          calendula<br>
          ylang ylang<br>
          Talk It Out</p>
      <p>Talk openly with close friends and family. Make it a point to be open and honest with all you say. Simply speaking in a heartfelt way can work wonders to strengthen and balance the throat chakra.</p>
      <p>Write It Down</p>
      <p>Learning how to express yourself without censoring or editing can be valuable. Practice mindful self-expression by journaling. Get it all out on paper and let it sit, then revisit what you have written at a later time.<br>
          Sing</p>
      <p>As the chakra of self-expression, singing can help dispel blockages, activate, and balance the fifth chakra. If you are too shy, humming is also an option. Just be sure to get those vocal cords vibrating with sound.</p>
      <p>Let It Be</p>
      <p>Letting go is difficult. Holding on to things over which you have no control can lead to resentment, guilt, and anger — all of which contribute to an imbalance of the throat chakra.</p>
      <p>Opening Yoga Poses for the Throat Chakra<br>
          Yoga for the throat chakra primarily focuses on simple neck movements, such as moving you head from side to side, can help ease tension that can block the throat chakra.</p>
      <p>Believe it or not, throat chakra blockages can be initiated by or contribute to blockages elsewhere in the chakra system. Alleviate physical and emotional signs of throat chakra imbalance by doing simple yoga poses each day. To open up and activate the throat chakra, give one of these yoga poses a try:</p>
      <p>Camel (Ustrasana)<br>
          Plow (Halasana)<br>
          Bridge (Setu Bandha Sarvangasana)<br>
          Fish (Matsyasana)<br>
          Standing Forward Bend (Uttanasana)</p>
      <p>E. OVERACTIVE THROAT CHAKRA</p>
      <p>When your throat chakra is overactive, you are your own (and others’) worst critic.It is important to understand the signs associated with an overactive throat chakra. Being able to recognize throat chakra issues is key to cleansing and learning how to balance the fifth chakra.</p>
      <p>Signs of Overactivity in the Throat Chakra<br>
          Situated in the base of the throat, the fifth chakra is considered home to self-expression and your ability to communicate. It also serves as the “seat” of emotion.An overactive throat chakra can significantly impact your relationships and ability to function in life.</p>
      <p>Common physical symptoms of an overactive throat chakra can include mouth and jaw problems, chronic sore throat, and colds. Additional physical ailments associated with an overactive throat chakra include:</p>
      <p>ear aches<br>
          neck pain<br>
          laryngitis<br>
          When balanced, the throat chakra fosters clear, concise communication. You have no issues being honest regardless of the situation or company you’re in. However, when the throat chakra becomes too active the complete opposite happens.</p>
      <p>Speaking rudely, out of turn, or maliciously are common indicators your fifth chakra needs attention. Looking down on others, you become highly critical of minute details. The slightest, most innocent comment from someone may strike you as intentionally rude. You may even speak negatively about yourself, or others, to the point it borders on verbal abuse.</p>
      <p>Additional common non-physical signs of imbalance include:</p>
      <p>gossiping<br>
          non-stop talking<br>
          arrogance<br>
          condescension<br>
      </p>
      <p>Cleansing and Balancing An Overactive Throat Chakra<br>
          The calming color blue is commonly associated with confidence, truth, wisdom, and faith. All of which are also attributes tied directly and indirectly to characteristics associated with the throat chakra.</p>
      <p>In most cases, incorporating positive changes into your lifestyle can help immensely, including eating a healthy diet and exercising regularly. When simple lifestyle changes aren’t enough, consider introducing aromatherapy, yoga, or sound therapy, such as singing, to your situation — yes, singing — even if it’s just in the shower. Exercising the vocal cords can dispel blockages in the fifth chakra.</p>
      <p>Depending on the severity of your chakra imbalance, consulting with an energy healer is also something to consider.<br>
      </p>
      <p>F. THROAT CHAKRA HEALING</p>
      <p>Have you ever felt stifled creatively? Found yourself unable to communicate as clearly as you would like? Or have you experienced hoarseness, laryngitis or chronic fatigue? These are signs associated with throat chakra imbalance. Find out how to identify 5th chakra blockages and ways to do throat chakra healing.</p>
      <p>Getting to Know the Throat Chakra<br>
          The throat chakra, also known as the sacral chakra, is the fifth chakra of the human body. Located at the base of the throat, this energy center is associated with communication, creativity, and self-expression. According to some spiritual and religious traditions, the throat chakra is considered the seat, or home, of human emotion.</p>
      <p>Think about it. When we are emotionally upset, we often say we’re “choked up,” unable to speak clearly, which makes sense if the throat is the emotional hub. Yes?</p>
      <p>Known as Vishuddha in Hindu tradition, the throat chakra controls the thryroid gland and endocrine system. That means it is responsible for the regulation and flow of hormones and the function of all matters of the throat and head, including:<br>
          trachea<br>
          mouth<br>
          esophagus<br>
          teeth<br>
          nose<br>
          ears<br>
          carotid artieries</p>
      <p>Signs of Blockage of the 5th Chakra<br>
          When the fifth chakra is blocked there are several signs, both physical and non-physical, that can emerge. Physically speaking, an unbalanced fifth chakra can cause you to experience consistent fatique, headaches, and speech impairment. In some cases, it is not uncommon for even more serious physical effects to include tinnitius, autoimmune dysfunction, and hypothyroidism.<br>
      </p>
      <p>The effects of imbalanced chakras may also manifest in less physical ways. In the case of the throat chakra, a blockage can initiate behaviors indicative of insecurity and a lack of control, such as:<br>
          manipulativeness<br>
          lying<br>
          arrogance<br>
          anxiety and/or fear<br>
          diminished self-esteem<br>
          compulsive or excessive eating</p>
      <p>How to Balance the Throat Chakra?<br>
          Fifth chakra healing can involve the use of a variety of tools to achieve balance, from chakra healing stones and essential oils to healing foods, yoga asana (posture), meditation and cleansing. It is important to remember, the idea behind balancing is to eliminate the negativity that caused the imbalance; which is commonly an excess or deficiency of something.</p>
      <p>Among the most commonly used tools for throat chakra healing are throat chakra stones.</p>
      <p>So how do stones work exactly? It’s about vibration.</p>
      <p>We are all made of energy. Energy creates vibration. When chakras become unbalanced, a return to the right vibration is necessary. Chakra healing stones each have their own vibrational frequency. By placing throat chakra stones just above or on the area of imbalance, the stone’s vibration cleanses the negativity to restore balance.</p>
      <p>Healing the Throat Chakra with Color : True Blue<br>
          All seven human chakras have their own corresponding color. Blue is associated with the throat chakra. Considered a hue for cleansing and health, blue’s calming effect helps restore balance and eases physical and mental stresses often associated with throat chakra imbalance.</p>
      <p>Benefits of Fifth Chakra Balance<br>
          When the throat chakra is balanced, you not only feel it, but there are additional, subtle signs. You have more confidence and find you are a more effective communicator. Also, you may find that you have more vivid dreams and dream recall, are more sensitive to the energies put forth by others around you, and are more at ease with the world in general.</p>
      <hr>
      <p><strong>THIRD EYE CHAKRA<a name="thirdeye" id="thirdeye"></a></strong></p>
	  <p>
	  Located between the eyebrows, the Third Eye helps us see that which is not physical. This is where our intuition lies, as well as clairvoyance and psychic perception. When this chakra is imbalanced, this may physically manifest as brain issues, such as stroke, brain tumor/hemorrhage, neurological disturbances and seizures.</p>
	  <p>

Emotionally, we do not trust our insights or intuition, and may become afraid of it. Reiki can help unblock this chakra and allow us to hone in on the power of our intuition.	  </p>
	  <hr>
      <p>A. THIRD EYE CHAKRA BASICS<br>
          B. THIRD EYE CHAKRA SYMBOL<br>
          C. BLOCKED THIRD EYE CHAKRA<br>
          D. OPENING YOUR THIRD EYE CHAKRA<br>
          E. OVERACTIVE THIRD EYE CHAKRA<br>
          F. THIRD EYE CHAKRA HEALING</p>
      <hr>
      <p><strong>A. THIRD EYE CHAKRA BASICS</strong></p>
      <p>The third eye chakra is the sixth chakra. Located on the forehead, between the eyebrows, it is the center of intuition and foresight. The function of the third eye chakra is driven by the principle of openness and imagination.</p>
      <p>Third eye chakra meaning<br>
          The fifth chakra is referred to as:</p>
      <p>Third eye chakra<br>
          Brow chakra<br>
          Ajna chakra<br>
          Bhru Madhya<br>
          Dvidak Padma<br>
          The most common Sanskrit name for the Third eye chakra is “Ajna”, which means “command” and “perceiving”.</p>
      <p>This chakra is related to the “supreme element”, which is the combination of all the elements in their pure form.</p>
      <p>Yogic meaning of the 3rd eye chakra<br>
          In yogic metaphysics, the third eye or Ajna chakra, is the center where we transcend duality – the duality of a personal “I” separate from the rest of the world, of a personality that exists independently from everything else.</p>
      <p>As Harish Johari says, “a yogi who has passed through the Vishuddha Chakra at the throat to the Ajna Chakra transcends the five elements and becomes freed (mukta) from the bondage of time-bound consciousness. This is where the I-consciousness is absorbed into super-consciousness.” (Harish Johari: Chakras: Energy Centres of Transformation).</p>
      <p>Third eye chakra color<br>
          The third eye chakra is most commonly represented with the color purple or bluish purple. The auric color of third eye chakra energy can also be seen as translucent purple or bluish white.</p>
      <p>Rather than by its color, it is characterized by the quality of its luminescence or soft radiance that reminds us of the moon light.</p>
      <p>Third eye chakra symbol<br>
          The image of the Third Eye chakra symbol contains two elements frequently associated with wisdom: the upside down triangle and the lotus flower.</p>
      <p>Third eye chakra location<br>
          The most commonly accepted location for the sixth chakra is between the eyebrows, slightly above at the bridge of your nose. Contrary to a common misconception, it is not located in the middle of the forehead, but between the eyes where the eyebrows would meet. It can also be described as being located behind the eyes in the middle of the head. Note that secondary chakras run along the midline of the forehead, but the third eye chakra is typically located lower.<br>
      </p>
      <p>The Third eye chakra is associated to the pineal gland in charge of regulating biorhythms, including sleep and wake time. It’s a gland located in the brain that is a center of attention because of its relationship with the perception and effect of light and altered or “mystical” states of consciousness. It’s positioned close to the optical nerves, and as such, sensitive to visual stimulations and changes in lighting.</p>
      <p>Behavioral characteristics of the Third eye chakra<br>
          The third eye chakra is associated with the following psychological and behavioral characteristics:</p>
      <p>Vision<br>
          Intuition<br>
          Perception of subtle dimensions and movements of energy<br>
          Psychic abilities related to clairvoyance and clairaudience especially<br>
          Access to mystical states, illumination<br>
          Connection to wisdom, insight<br>
          Motivates inspiration and creativity<br>
          The third eye chakra is an instrument to perceive the more subtle qualities of reality. It goes beyond the more physical senses into the realm of subtle energies. Awakening your third eye allows you to open up to an intuitive sensibility and inner perception.</p>
      <p>Because it connects us with a different way of seeing and perceiving, the third eye chakra’s images are often hard to describe verbally. It puts us in touch with the ineffable and the intangible more closely. Third eye visions are also often more subtle than regular visions: They may appear a bit “blurry”, ghost-like, cloudy, or dream-like. Sometimes however, the inner visions might be clear like a movie playing in front of your eyes.</p>
      <p>Sustaining awareness of third eye chakra energy might require focus and the ability to relax into a different way of seeing. When we focus our mind and consciousness, we can see beyond the distractions and illusions that stand before us and have more insight to live and create more deeply aligned with our highest good.<br>
          The third eye chakra is associated with the archetypal dimensions, as well as the realm of spirits.</p>
      <p>Third eye chakra imbalance<br>
          When the Third eye chakra has an imbalance, it can manifest as:</p>
      <p>Feeling stuck in the daily grind without being able to look beyond your problems and set a guiding vision for yourself<br>
          Overactive third chakra without support from the rest of the chakra system may manifest as fantasies that appear more real than reality, indulgence in psychic fantasies and illusions<br>
          Not being able to establish a vision for oneself and realize it<br>
          Rejection of everything spiritual or beyond the usual<br>
          Not being able to see the greater picture<br>
          Lack of clarity<br>
      </p>
      <hr>
      <p><strong>B. THIRD EYE CHAKRA SYMBOL</strong></p>
      <p>The Third Eye chakra’s symbol meaning is profound in its simplicity. Governed by Krishna, the Hindu god of wisdom, the sixth chakra symbol is the Om positioned over an inverted triangle that is seated within a circle between two lotus petals. Taken individually, all these elements’ meanings are representative of wisdom.</p>
      <p>Associated with the element of ether (or Akasha), the sixth chakra’s symbol is dominated by the Om. Frequently included in everything from prayer to meditation and even the mundane, like yoga practice, it is a mantra of grounding, focus, and recognition of the Divine.</p>
      <p>The Image of the Third Eye Chakra Symbol<br>
          Generally, there is no animal associated with the Third Eye chakra. The explanation being, many energy healers and spiritual traditions do not consider the Third Eye as part of the physical body.</p>
      <p>The image of the Third Eye chakra symbol contains two elements frequently associated with wisdom: the upside down triangle and the lotus flower.</p>
      <p>Similar to the root and throat chakra symbols, the Third Eye symbol’s upside down triangle serves a dual purpose in its symbolism. The cone-shaped geometric figure is representative of the channeling of information to the seed (or point of the triangle) from which wisdom blossoms. Similarly, if you look at the triangle from the other direction, the widening sides are indicative of the growth of one’s wisdom that leads to enlightenment.</p>
      <p>The image of the lotus flower is a near-universal symbol meaning knowledge. Associated with Brahma, the Hindu god of creation, the lotus flower represents:</p>
      <p>prosperity<br>
          beauty<br>
          fertility<br>
          eternity</p>
      <p>Color and Mantra of The Third Eye Chakra Symbol<br>
          The Third Eye chakra is depicted in shades of indigo — a mixture of deepest blue and violet tones. Taken together these colors are representative of:</p>
      <p>wisdom<br>
          faith<br>
          mystery<br>
          loyalty<br>
          The sacred mantra “Om” (or Aum), is Sanskrit in origin and roughly translates to “the seed of all creation.” Its pronunciation is what one might imagine the hum of creation, or the universal life force, might sound like.</p>
      <p>Appropriately, the Om is representative of the Third Eye, or gateway to higher consciousness.</p>
      <hr>
      <p><strong>C. BLOCKED THIRD EYE CHAKRA</strong></p>
      <p>When your Third Eye chakra is blocked you lose your sense of direction in life and become stagnant. When the energy center of the Third Eye becomes blocked, you may start to distrust that inner voice. Your perception about life and where you’re headed can become negatively skewed and nearly unrecognizable. Unable to let go of the past and a fear of what the future holds makes you very dogmatic in your beliefs, daily routine, and how you view others.</p>
      <p>Symptoms of Blockage of the Third Eye Chakra<br>
          A blocked Third Eye can wreak havoc on your physical well-being. Since this energy center governs the pituitary gland and neurological function, your body’s ability to fight infection, regulate sleep, and maintain balanced metabolic function is compromised. As a result, you may find you are frequently sick, suffer with insomnia, or develop high blood pressure.</p>
      <p>Additional physical signs of a Third Eye chakra blockage are:<br>
          migraines<br>
          sinusitis<br>
          seizures<br>
          poor vision<br>
          sciatica<br>
          In extreme cases, there’s an increased risk for serious complications, such as stroke and blindness.</p>
      <p>Emotional signs of sixth chakra imbalance include:</p>
      <p>delusions<br>
          depression<br>
          anxiety<br>
          paranoia<br>
          It is not uncommon to also experience vivid dreams, nightmares, and heightened skepticism.</p>
      <p>Recommended Solutions for Clearing Your 3rd Eye Chakra<br>
          Foundationally speaking, the sixth chakra is about letting go of the ego. Embracing compassion and forgiveness is essential to successful clearing and healing of this energy center.</p>
      <p>Aptly named, the Third Eye is instrumental in your ability to visualize. So it only makes sense that one remedy for alleviating the issue of a Third Eye blockage is meditation.</p>
      <p>Incorporating healthy eating and some form of energy healing, such as aromatherapy, the use of chakra stones, or sound therapy, can also help restore balance to the Third Eye.</p>
      <p>What To Expect When The Third Eye Chakra Blockage Is Cleared</p>
      <p>As the seat of intuition and wisdom, an open and balanced Third Eye allows you to see life accurately. Taking things in stride, you know what you want in life and how you plan to get there. Depending on how open your sixth chakra is, you may also have heightened intuition that you’ve learned to trust.</p>
      <hr>
      <p><strong>D. OPENING YOUR THIRD EYE CHAKRA</strong><br>
          Ever wondered how to open your third eye, home to your “sixth sense?” Your intuition and higher wisdom come alive when this energy center is fully open and balanced. Unfortunately, for most of us, developing our third eye chakra and its abilities is challenging at best, and may even sometimes seem out of reach. Here are a few simple steps and recommendations to help.</p>
      <p>4 Proven strategies for awakening the third eye<br>
          First, we’re going to describe the most important guidelines that will help you develop your third eye.</p>
      <p>Cultivate silence<br>
          Foster the silence of the mind, whether it’s through meditation, just sitting calmly in nature, or being absorbed in your favorite art or sport practice.</p>
      <p>Why? Because third eye perception elevates your senses to more subtle levels. Some call it “the space in between”, psychic abilities, the realm of the invisible. To be able to listen to the messages and information that comes through your third eye, you should be ready to perceive the whisper of its wisdom. If your mind is busy or noisy, you might miss its main message.</p>
      <p>Hone your intuition<br>
          There are many ways to cultivate your intuition. The third eye is the center of insight, vision, and higher wisdom. So what about getting acquainted with your dreams and their meanings, perhaps giving a try at lucid dreaming, getting to know how to read a horoscope or tarot cards? Find new ways to intuit into your daily life activities.</p>
      <p>Why? Because the third eye is the main seat of higher levels of perception and intuition. One way to look at it can be “fake it until you make it.” In other words, be curious, learn about these intuitive techniques. In time, these otherwise esoteric practices will appear more familiar, and you will gain more confidence in your own abilities.</p>
      <p>You don’t need to take this seriously – actually, the opposite is recommended. Have fun, explore, and most importantly, keep your mind and chakras open to possibility and wonder.</p>
      <p>Nurture your creativity<br>
          Let your creativity flow freely by focusing on specific activities or letting your imagination loose. For instance, start learning a new art or craft; don’t try to be perfect, just let your inspiration run through your hands and be ready to be surprised by the results.</p>
      <p>Why? Creativity is a very efficient way to loosen your rational mind – you know, the mental chatter that comments every step you make to see whether it’s right or wrong, that tends to control every action with a specific agenda and intended outcome.</p>
      <p>When you calm the part of your mind that wants to be in charge of how reality should be and leverage your creativity to open up possibilities, your third eye capacity has more space to unfold and blossom.<br>
      </p>
      <p>Ground yourself to better soar<br>
          For most of us, it might not be obvious that in order to open our third eye abilities, we need to first land both our feet on the ground. Also note the importance of opening up gradually, building reliable foundations first that will allow you to have proper discernment and interpret your extrasensory perceptions with as much clarity as possible.</p>
      <p>Why? Because we need to have enough energy running through our whole body and energetic system to support a healthy opening of subtle channels of perception. When the third eye gets activated, the information that comes through might appear rather unusual, unfamiliar, or simply disturbing to the common mind.</p>
      <p>Being grounded and having enough energy allows us to expand into subtle dimensions of perception. It can help us open up unhindered and avoid the common negative symptoms of third eye opening, such as feeling disoriented or confused.</p>
      <p>How to exercise your 3rd eye chakra<br>
          Let’s explore simple yet efficient exercises to support the opening of your 3rd eye. Here’s a list of practices that will give a boost to your intuitive energy center.</p>
      <p>Exercise your intuition; it’s the main function of the third eye<br>
          Rest under the moon light and reflect; the moon light resembles the quality of light of your intuitive center<br>
          Nurture silence to hear the wisdom of the third eye; listen, the 3rd eye’s sound is more like a whisper<br>
          Strengthen the energy of your first chakra, as well as your throat chakra; both are useful anchors for unlocking the energy of your third eye in powerful and balanced ways<br>
          Divination practices<br>
          Dream work, dream interpretation, lucid dreaming<br>
          Visualizations<br>
          Guided meditation, silent meditation<br>
          Let your imagination loose<br>
          See, focus on the space “in between” things<br>
          Be curious about symbolic meanings, symbols around you in different cultures and time periods<br>
          Commune with nature and the energy of the elements<br>
          Enjoy creative crafts<br>
          Free flow<br>
          Working with inner guidance, spirit guides<br>
          Practice contemplation<br>
          Cultivate your psychic abilities<br>
          Feel free to try and enjoy the exploration. It’s the best way to get energy flowing in the third eye after all.</p>
      <p>How does the pineal gland impacts the awakening of the third eye?<br>
          Positioned between the brows and just above the eye level, the 3rd eye is associated with intuition and wisdom. In the human body, this energy center is traditionally associated with the pituitary gland, as well as the pineal gland.</p>
      <p>Glands and chakras are intimately related as they represent different levels of bodily functions, the first one being focused on the physical, the other on the subtle energetic level. The pituitary gland is considered to be the “master gland” in the human body because it controls most of the other glands and their hormone production.</p>
      <p>What about the pineal gland? The pineal gland is located in the middle of the brain, at the same level as the eyes. Its connection with the third eye chakra or Ajna in the Hindu system has long been investigated by yogic traditions and modern metaphysics alike. They view this gland as a possible seat of the soul and its development, a source for mystical experiences and extrasensory perception or psychic abilities.</p>
      <p>This gland is usually considered to be in charge of producing melatonin and regulating our sleep cycle and our sexual maturation. The ways it functions is closely connected to the cycles of light and darkness.</p>
      <p><img src="images/pineal-gland.jpg" class="img-responsive"></p>
      <p>To suport  your pineal gland and the awakening of your third eye, here’s what you can do:</p>
      <p>Go outside and get lots of natural light.<br>
          Eat foods or supplements that support a healthy activity of the pineal gland (and counter its calcification), such as iodine, chlorella, apple cider, Tamarind fruit (as it helps remove excess of fluoride involved in decreased pineal activity).<br>
          Meditate; meditation balances the activity of the nervous system and stimulates parts of the brain that help the pineal gland.<br>
          Spend time in complete darkness, as it stimulates a healthy activity in the gland and production of its associated hormones.</p>
      <p>Specific practices to activate the third eye chakra<br>
          A balanced and open third eye, also known as the Ajna, chakra fosters concentration, focus, and reliance on intuition. Here are more specific techniques for balancing its energy:</p>
      <p>Just Breathe<br>
          Mindful breathing can calm the mind and, in turn, cleanse and open the Third Eye. Being conscious of your breathing not only allows for cleansing, but also balances the chakra system.</p>
      <p>Add Third Eye Color<br>
          Associated with the color indigo, which is a combination of deepest blue and violet, the Third Eye chakra governs… Introduce blue and purple hues to your home and office decor. Surrounding yourself with subtle indigo tones can help heal the sixth chakra and boost energy flow. Add precious or semi-precious blue- and/or purple-stone jewelry to your wardrobe.</p>
      <p>Practice third eye meditation<br>
          Of all the exercises you can do for the sixth chakra, those that require you to actually engage the Third Eye are the best.</p>
      <p>Visualizing and meditating on the color blue or purple can help activate the sixth chakra. For instance, sit comfortably and with eyes closed, visualize a blue (or purple) ball of energy in the area of your Third Eye. Simply concentrating on and holding that image is enough to activate the sixth chakra. Concentrating on this image can not only open up the energy center, but it helps dispel imbalance and heal the chakra. There are many beneficial resources about chakra meditation online, so go explore!</p>
      <p><img src="images/third-eye-meditation.jpg" class="img-responsive"></p>
      <p>Dream it<br>
          The Third Eye is crucial in dreaming and dream recall. Engage and activate your Third Eye chakra by keeping a dream journal.</p>
      <p>Work your theta brainwaves<br>
          It could be useful to learn how to activate and maintain theta and alpha brainwaves. These foster frontal lobe activity and prepare your third eye and brain to be more receptive.</p>
      <p>Add some scent<br>
          Introduce essential oils to your home, bath, and body. Subtle fragrances can work wonders for opening, cleansing, and balancing the body’s chakras. To help heal and activate your sixth chakra, consider trying one or a combination of these essential oils:</p>
      <p>Sandalwood<br>
          Myrrh<br>
          Roman or German Chamomile<br>
          Grapefruit<br>
          Nutmeg<br>
          Eat (and Drink) Fruits and Veggies<br>
          Consuming beverages and foods with natural blue and purple hues can help bolster positive energy flow through the Third Eye chakra. Drink dark fruit juices, such as grape and blackberry. Consider adding the following fruits and vegetables to your grocery list:</p>
      <p>black currants<br>
          blueberries<br>
          blackberries<br>
          eggplant<br>
          prunes<br>
          rainbow chard<br>
          beets<br>
          Yoga for the third eye chakra<br>
          When learning how to open and heal the body’s energy centers, no conversation is complete without introducing the benefits of yoga. The practice’s elements of breath, focus, and physical movement, when taken together, are great tools for cleansing and balancing the chakras.</p>
      <p>To open and strengthen the Ajna chakra, give these yoga poses a try:</p>
      <p>Hero (Virasana)<br>
          Standing Half Forward Bend (Ardha Uttanasana)<br>
          Child’s Pose (Balasana)<br>
          Downward-Facing Dog (Adho Mukha Svanasana)<br>
          Supported Shoulderstand (Salamba Sarvangasana)</p>
      <hr>
      <p><strong>E. OVERACTIVE THIRD EYE CHAKRA</strong></p>
      <p>An overactive third eye chakra can be disorienting and cause of much psychological and psychic distress. When this energy center is on overdrive, you may feel like you are getting lost in an endless stream of phantasmagoric visions or being bombarded by nonsensical pieces of information. Having an overactive third eye might sweep you off your feet if you are not grounded enough.</p>
      <p>Signs Of An Overactive Third Eye Chakra<br>
          A common sign of hyperactivity in the third eye chakra is overindulging in a fantasy world while losing touch with reality. Another symptomatic manifestation is being overly concerned or fearful about the phantasmagorical visions passing before your mind’s eye. These are common symptoms when the third eye is opening without having enough overall balance and support from the lower chakras.</p>
      <p>When the Third Eye is balanced you see everything clearly. You function and make decisions with a sense of neutrality; meaning you are concerned, but not attached, to any single outcome. Highly focused, you can make the distinction between reality and dreams (or imagination).<br>
      </p>
      <p>When the third eye is in overdrive, so to speak, the constant flow of thoughts can be mentally exhausting.You may feel intimidated by having to make decisions that would normally be quite simple. That indecisiveness is oftentimes influenced by clouded judgement, lack of focus, and an inability to distinguish what is real — all signs your sixth chakra needs to be balanced.<br>
          Physical manifestations of an overactive third eye chakra include:</p>
      <p>headaches<br>
          vision problems<br>
          seizures<br>
          insomnia<br>
          nausea<br>
          sinus issues<br>
          Additional non-physical signs of an overactive third eye chakra include:</p>
      <p>hallucinations<br>
          being judgmental<br>
          anxiety<br>
          mental fog<br>
          feeling overwhelmed<br>
          paranoia and/or delusions</p>
      <p>When Your Third Eye Chakra Is Hyperactive…<br>
          If you feel the visions are too much for you to handle or the pieces of information are coming too fast, you can always ask for them to slow down. You might also thank the source of guidance you feel is involved then, and humbly say that you need a bit more time to be fully available to receive all the information.</p>
      <p>If you feel the visions and energies you experience are going out of control, firmly anchor yourself in your body and root yourself into the Earth as much as possible.</p>
      <p>You can also ask for protection and guidance to make your experience more comfortable. Ask to receive information in a way you can process or understand more easily.</p>
      <p>Healing Tip: Use Other Chakras To Balance A Third Eye Chakra On Overdrive<br>
          More than just the third eye chakra being over-activated, the issue may arise from a lack of overall balance in your energy system.</p>
      <p>The ability to apply discernment towards the information you receive through this energy center. You can use other chakras and their qualities, such as the second (sacral) or fourth chakra (heart). For example, the second chakra can help filter your intuitive hits and anchor them in your emotional and physical field. The heart chakra might bring a balanced and compassionate perspective to navigate through what may otherwise appear disincarnate or threatening.</p>
      <p>Of course, working on strengthening the energy of your root chakra is key is keeping your grounds while allowing the qualities of the third eye chakra to develop more fully. For instance, it’s important to ground yourself while opening up the third eye chakra. Without being properly grounded, your visions might sweep you off your feet. Far from being contradictory, the influence of the root chakra energy supports the activity of the third eye chakra. An important point to remember when opening your third eye!</p>
      <p>Other Cleansing and Balancing Recommendations For The Third Eye Chakra<br>
          To restore balance to the sixth chakra, incorporate subtle, positive lifestyle changes, such as introducing healthy, whole foods into your diet, and getting regular exercise. Energy healing, such as Reiki, aromatherapy, crystals, and sound therapy, can also help to restore chakra balance. These are high vibrational practices are particularly suitable to balance the third eye chakra. Make sure you focus on the intention of soothing and balancing this energy center. If the imbalance is significantly impacting your life, visiting a trusted energy healer may be something to consider.</p>
      <p>The third eye chakra is recognized as being represented by the color indigo, which is a combination of colors deepest blue and violet. Their combination is associated with wisdom and devotion. Both characteristics play an important role in the development of the sixth chakra.</p>
      <hr>
      <p><strong>F. THIRD EYE CHAKRA HEALING</strong></p>
      <p>An open third eye chakra enables you to see things as they truly are, but even the slightest imbalance can wreak havoc on your psychological, emotional, and physical health.</p>
      <p><strong>The 3rd Eye Chakra</strong><br>
          Positioned at the forehead, the Ajna chakra (as it is known in Sanskrit) is the sixth of seven basic chakras, or energy centers, in the human body. Sometimes referred to as the “conscience,” this chakra governs the pineal gland and your vision, intuition, memory, and imagination.</p>
      <p>Indigo is the most common chakra color associated with the Third Eye. Additionally, violet, silver and shades of darkest blue/purple may also be used.</p>
      <p><strong>Third Eye Imbalance</strong><br>
          When the Third Eye chakra produces an excess of energy the mind can go into overdrive. Consider how you feel after one too many cups of coffee and you get the idea. An overactive Ajna chakra can make it difficult to concentrate and, in some cases, can induce hallucinations.</p>
      <p>On the other end of the spectrum, an energy deficiency can also affect your ability to concentrate on, process, and remember information. An underactive Third Eye chakra can make you indecisive, procrastinate, or become fearful of the unknown. Extremely deficient Ajna chakra function can hinder your ability to focus, keep a cool head under pressure, or dream and recall your dreams.</p>
      <p>Additional issues that can arise from a blocked or imbalanced Third Eye chakra include:</p>
      <p>Insomnia<br>
          High blood pressure<br>
          Sciatica<br>
          Depression<br>
          Anxiety<br>
          Migraines</p>
      <p>How to Activate Your Third Eye Chakra<br>
          Chakra meditation is an integral part of opening the Ajna chakra.</p>
      <p>There are numerous online guides about how to activate your Third Eye Chakra using chakra healing meditation. Regardless of the method you choose, remember the key elements to successful chakra healing meditation and chakra awakening include being relaxed, visualization, and focus.</p>
      <p>The idea behind awakening the Third Eye, or brow, chakra is to see things more clearly (within and without the physical realm) and to awaken your intuition. Keep in mind, the Ajna chakra works in partnership with the crown chakra to complete the chakra “circuit.” And when the Ajna chakra is awakened and working in tandum with the crown chakra a new level of awareness can be accomplished.</p>
      <p>Third Eye Chakra Healing<br>
          Aside from chakra meditation, there are several ways to restore balance to your Third Eye chakra, including the use energy healing, such as Reiki, sound therapy, acupuncture or acupressure.</p>
      <p>If you are a yoga practitioner, there are asanas that can help with Third Eye chakra healing and balancing, including child’s pose, shoulder stands, and forward bends.</p>
      <p>Incorporating the use of essential oils, such as to anoint the forehead at the location of the Ajna chakra, can also assist with cleansing and balancing the Third Eye chakra. Consider using:</p>
      <p>Marjoram<br>
          Frankincense<br>
          Juniper<br>
          Clary Sage<br>
          Rosemary<br>
          Sandalwood<br>
          Use healing stones that possess the same vibrational frequency and chakra color as the Ajna chakra to clear away negativity and restore proper energy flow, such as:<br>
      </p>
      <p>Amethyst<br>
          Lapis Lazuli<br>
          Purple Flourite<br>
          Moonstone<br>
          Quartz<br>
          Chakra Healing Food for the Third Eye<br>
          Diet plays a vital role in your overall health, including your chakra system.</p>
      <p>To heal and maintain a healthy Ajna chakra, think purple. Naturally dark blue and purple-colored foods can boost Third Eye chakra function including:</p>
      <p>Eggplant<br>
          Plums<br>
          Blueberries<br>
          Purple peppers, cabbage, and kale</p>
      <hr>
      <p><strong>CROWN CHAKRA    </strong><a name="crown" id="crown"></a></p>
	  <p>
	  Located at the top and center of the head, this chakra is our connection to the Universe, our spirituality, and our trust in life. This is the chakra from which we receive divine guidance from Source/Goddess/Higher Power. When this chakra is imbalanced, this manifests physically as depression, or as chronic exhaustion that is not linked to physical disorders.</p>
	  <p>

Emotionally, we are unable to let go of anxiety and fear and there is a lack of trust in God or life.</p>
	  <p>

When Reiki is performed, this chakra becomes unblocked and allows us to be in more touch with Divine guidance, and have more trust in life.	  </p>
	  <hr>
          A. CROWN CHAKRA BASICS<br>
          B. CROWN CHAKRA SYMBOL<br>
          C. BLOCKED CROWN CHAKRA<br>
          D. OPENING YOUR CROWN CHAKRA<br>
          E. OVERACTIVE CROWN CHAKRA<br>
          F. CROWN CHAKRA HEALING
          <hr>
      <p><strong>A. CROWN CHAKRA BASICS</strong></p>
      <p>The crown chakra is the seventh chakra. Located at the top of the head, it gives us access to higher states of consciousness as we open to what is beyond our personal preoccupations and visions. The function of the Crown chakra is driven by consciousness and gets us in touch with the universal.</p>
      <p>Crown chakra meaning<br>
          The seventh chakra is referred to as:</p>
      <p>Crown chakra<br>
          Sahasrara<br>
          Shunnya<br>
          Niralambapuri</p>
      <p>The Sanskrit name “Sahasrara” is sometimes used to designate the seventh chakra. It can be translated as “Thousand petals”.<br>
          Crown chakra color<br>
          The crown chakra is most commonly represented with the color white, although it can also be depicted as deep purple. The auric color of crown chakra energy can also be seen as gold, white, or clear light.</p>
      <p>Crown chakra symbol<br>
          The symbol of the Crown chakra is composed of:</p>
      <p>A circle<br>
          A thousand petals<br>
          The dominating color of the crown chakra symbol is white. Its petals are multicolor, like a rainbow. The circle is sometimes compared to the symbol of the full moon.</p>
      <p>Crown chakra location<br>
          The most commonly accepted location for the seventh chakra is at the top of the head or slightly above the head. It sits like a crown, radiating upwards, hence its name.</p>
      <p>The Crown chakra is primarily associated to the pituitary gland, and secondarily to the pineal and the hypothalamus. The hypothalamus and pituitary gland work in pair to regulate the endocrine system.  Because of its location, the crown chakra is closely associated with the brain and the whole nervous system.</p>
      <p>Note that energetically, the seventh chakra has a connection with the first chakra, as they both are at the extremities of the chakra system.</p>
      <p>Crown Chakra</p>
      <p>Behavioral characteristics of the Crown chakra<br>
          The crown chakra is associated with the following psychological and behavioral characteristics:</p>
      <p>Consciousness<br>
          Awareness of higher consciousness, wisdom, of what is sacred<br>
          Connection with the formless, the limitless<br>
          Realization, liberation from limiting patterns<br>
          Communion with higher states of consciousness, with<br>
          Ecstasy, bliss<br>
          Presence<br>
          The crown chakra is associated with the transcendence of our limitations, whether they are personal or bound to space and time. It is where the paradox becomes norm, where seemingly opposites are one. The quality of awareness that comes with the crown chakra is universal, transcendent.</p>
      <p>As we are immersed in the energy of the crown chakra, we feel a state of blissful union with all that is, of spiritual ecstasy. This chakra allows access to the upmost clarity and enlightened wisdom.<br>
          Some describe this chakra as the gateway to the cosmic self or the divine self, to universal consciousness. It’s linked to the infinite, the universal.</p>
      <p>Crown chakra imbalance<br>
          When the Crown chakra has an imbalance, it can manifest as:</p>
      <p>Being disconnected to spirit, constant cynicism regarding what is sacred<br>
          On the opposite side, an overactive crown chakra could manifest as a disconnection with the body<br>
          Living in your head, being disconnected from your body and earthly matters<br>
          Obsessive attachment to spiritual matters<br>
          Closed-mindedness</p>
      <hr>
      <p><strong>B. CROWN CHAKRA SYMBOL</strong></p>
      <p>The 1,000-petaled lotus symbol associated with the crown chakra is one that possesses transcendental meaning.</p>
      <p>Also known as the Sahasrara chakra, the crown chakra is the energy center of spiritualism and universal knowledge that links you to the Divine.</p>
      <p>The crown chakra influences:</p>
      <p>the brain<br>
          the nervous system<br>
          emotions<br>
          enlightenment<br>
          understanding<br>
          Crown Chakra Symbol Meanings<br>
          Regardless of tradition or artist, the crown chakra symbol is depicted as a violet-colored 1,000-petaled lotus flower. The lotus flower is commonly associated with:</p>
      <p>purity<br>
          renewal<br>
          beauty</p>
      <p>Considering the crown chakra is itself the energy center of renewal and transcendence, the lotus flower is symbolically appropriate.<br>
          Some illustrations of the crown chakra symbol will include an “Om” image seated in the lotus’ center. Within Hinduism, the Om is symbolic of the Absolute — all that was, is, and will be — or Brahman. According to ancient tradition, to understand the incomprehensible is impossible for the human mind, therefore, representing the absolute in a single symbol makes things a bit easier.</p>
      <p>As the crown chakra ties you to the Divine and Brahman, it only makes sense for those symbols that depict the Om to be included in the symbol meaning.</p>
      <p>Crown Chakra Symbolism: Purity Through Color</p>
      <p>No explanation of the crown chakra symbol meaning would be complete without an exploration of the colors used to depict it — violet and white.<br>
          Violet is the traditional color associated with spiritualism and intuition, while white is commonly accepted as a hue of purity, forgiveness, and renewal. Taken together, these colors are a good marriage of hues for the energy center that governs your ability to forgive, awaken and hone your intuition, and also cleanse and renew yourself physically, emotionally, and spiritually.</p>
      <p>Symbolic Animal Associations<br>
          In many traditions, pack animals are associated with the crown chakra, including the elephant, wolf, and horse. Each is known to influence the human psyche and carries beneficial attributes of:</p>
      <p>renewal<br>
          change<br>
          vision<br>
          compassion<br>
          patience</p>
      <hr>
      <p><strong>C. BLOCKED CROWN CHAKRA</strong></p>
      <p>The crown chakra, known in Sanskrit as Sahasrara, is the seventh chakra and is located at the top of the head. It is the gateway to spiritual wisdom. It also connects the individual to the wider universe, helping each person feel their connection to the universal energy. A blocked crown chakra can limit spiritual growth and cause isolation and emotional distress.</p>
      <p>Symptoms of a Crown Chakra Blockage<br>
          An imbalance in the crown chakra leads to spiritual distress. Symptoms of a blockage in the seventh chakra include:</p>
      <p>Isolation and loneliness; inability to connect with others<br>
          Lack of direction<br>
          Inability to set or maintain goals<br>
          Feeling disconnected spiritually<br>
          Physical symptoms of a blocked crown chakra include:</p>
      <p>Neurological disorders<br>
          Nerve pain<br>
          Thyroid and pineal gland disorders<br>
          Alzheimer’s<br>
          Recurring headaches, migraines<br>
          Schizophrenia and delusional disorders<br>
          Insomnia<br>
          Depression</p>
      <hr>
      <p><strong>D. OPENING YOUR CROWN CHAKRA</strong><br>
          The crown chakra or Sahasara is located on the top of the head. It governs inner communication with our spiritual self. It allows for us to connect with the Universal Life Force which is dispersed through all seven chakras. It is the center of knowledge and enlightenment often being represented by a blooming lotus flower to express the evolution and growth of the spirit throughout a lifetime.</p>
      <p>Before Attempting To Open Your Crown Chakra</p>
      <p>The crown chakra is a very important chakra that helps the other six chakras stay open, however, it is just as important to note that you must balance your root chakra before attempting to balance your crown chakra as you need a good foundation to remain grounded. Be sure to work through all your chakras as well beginning with the root chakra and working to the crown chakra to help stimulate energy flow and harmony.</p>
      <p>Exercises to Open Your Crown Chakra</p>
      <p>Connect to your inner self through yoga, meditation and contemplation.<br>
          Repeat a mantra or affirmation that resonates with the crown chakra. The best mantra for the crown chakra is OM.<br>
          Turn off the TV, radio and computer so that you may be open to hearing the universe around you.<br>
          Take nature walks or mountain hikes to reconnect.<br>
          Use recommended essential oils to promote the healing and openness of your chakras<br>
          Keep a dream journal to write down your dreams and imaginations.<br>
          Wear the colors associated with the chakra. White and violet are connected with the crown chakra.<br>
          Carry a gemstone that resonates with you. Violet or clear gemstones like quartz crystal, diamond, amethyst are recommended for the crown chakra.</p>
      <p>Opening Your Crown Chakra With Affirmation</p>
      <p>You can use affirmations to inspire a shift in your attitude and energy that will contribute to the crown chakra opening. For example:<br>
      </p>
      <p>Om / Aum<br>
          I am divine.<br>
          I accept all that comes into my day with trust and selflessness.<br>
          I am selfless.<br>
          I honor all others.<br>
          Life will bring me many wonders today.<br>
          Today will bring me a new enthusiasm.<br>
          My crown chakra projects inspiration.</p>
      <p>Beneficial Essential Oils for Opening the Crown Chakra</p>
      <p>Lavender- helps you incorporate spirituality in your daily life.<br>
          Sandalwood- encourages deeper mediation and higher consciousness.<br>
          Rose- establishes angelic connection<br>
          Frankincense- helps you connect with the eternal and Divine.<br>
          Cedarwood- helps strengthen the Divine and universal connection<br>
          Myrrh- creates a bridge between the universe and earth plane.<br>
          Rosewood- promotes opening of the crown</p>
      <hr>
      <p><strong>E. OVERACTIVE CROWN CHAKRA</strong><br>
          An overactive crown chakra can make you feel out-of-sorts. When there is pronounced overactivity in the seventh energy center you may not only feel detached from the world around you, but you may also appear to others as flighty. Familiarizing yourself with symptoms of a crown chakra imbalance are necessary for cleansing and balancing this energy center.</p>
      <p><strong>Signs of An Overactive Crown Chakra</strong></p>
      <p>Seated at the top of your head, the crown, or Sahasrara, chakra links you with divine energy and blends the physical and non-physical realms. The seventh chakra also governs your consciousness and subconsciousness while it influences your spirituality, inner wisdom, and your ability to relate to your inner self and others.<br>
          When the crown chakra falls out of balance it affects how you function and relate to your environment. An overactive crown chakra can leave you vulnerable to a variety of physical and non-physical symptoms including:</p>
      <p>depression<br>
          lack of empathy<br>
          dizziness<br>
          confusion<br>
          mental fogginess<br>
          seizures<br>
          light sensitivity<br>
          In some cases, an overactive crown chakra may also create feelings of superiority toward others, and aggression, as well as a tendency to be judgemental and critical of others. It is not uncommon to be distrustful of others or to feel lost — as though you’re in the midst of a crisis or have lost your way in life — when the crown chakra is too active.</p>
      <p>In contrast, when the crown chakra is balanced you feel:<br>
          grounded<br>
          in control of your emotions<br>
          intuitive<br>
          connected to the divine</p>
      <p><strong>Balancing Crown Chakra Overactivity</strong></p>
      <p>Restoring balance to the seventh chakra is key to maintaining a healthy balance within your chakra system overall.</p>
      <p>Changing up your diet to include healthy, whole foods and adding regular exercise to your routine is sometimes enough to help restore balance. However, if the overactivity is prolonged or severe, energy healing may be necessary to get your chakra energy flow back on track. Incorporating the use of aromatherapy, chakra healing stones, Reiki, or even Tai Chi can help alleviate issues of chakra overactivity.</p>
      <p>It is important to remember energy healing takes time to work, so signs and symptoms of imbalance will not subside overnight.</p>
      <hr>
      <p><strong>F. CROWN CHAKRA HEALING</strong></p>
      <p>The seven chakras are the points that energy flows through in the body. When open and balanced, energy moves freely through them and spiritual and physical healing can occur. However, when the chakras become blocked, it can cause mental and physical disease. A blockage in the crown chakra can lead to spiritual malaise and other problems.</p>
      <p><strong>Understanding the Crown Chakra</strong><br>
          The crown chakra, known as Sahasrara in Sanskrit, is the seventh major chakra. It is located on the crown of the head and is associated with spirituality. The Sahasrara chakra is violet or white, and is represented by a lotus flower with a thousand petals. This chakra is what allows people to move beyond individual materialistic needs to connect with the universal whole. Opening the crown chakra brings spiritual insight, mindfulness and the ability to live with quiet self-confidence in all aspects of life.</p>
      <p><strong>Symptoms of Sahasrara Imbalance</strong><br>
          A deficiency in the crown chakra tends to cause subtle, systemic problems. These include:</p>
      <p>Depression and mental fog<br>
          Chronic fatigue<br>
          Migraines and other chronic headaches<br>
          Greed and materialism</p>
      <p>An excess of energy in the crown chakra can also cause problems including:<br>
          Sensitivity to light and sound<br>
          Neurological or endocrine disorders<br>
          Boredom and frustration<br>
          A sense of elitism or unearned accomplishment<br>
          An unbalanced crown chakra can also play a role in learning disabilities, comas, sleep disorders and mental illness.</p>
      <p><strong>Healing the Crown Chakra</strong></p>
      <p>The most powerful way to heal the crown chakra is through meditation. This is because of the ties between the crown chakra and spirituality. Regular meditation practice of all sorts is beneficial. For a meditation focused on Sahasrara, envision white light pouring into the top of your head, filling your body and connecting you with the world around you. If you only have a few moments to meditate, try imagining a violet lotus flower over your crown for a simple chakra meditation.</p>
      <p>Unlike other chakras, the crown chakra does not have any healing food specific to it. This is because of its role in spiritual nourishment. Nurturing the body with wholesome, healthy foods while focusing on spiritual things can help heal this chakra.<br>
      </p>
      <p>Silence is best for crown chakra activation, because it does not distract from spiritual practice. The sound of Om and deep, tonal sounds can also be healing music for Sahasrara because of their universal nature.<br>
          Most yoga asanas are useful for crown chakra balancing because of the meditative aspect. Slow practice that allows time for plenty of focus on the breath is ideal. This is not the time to push boundaries and strive to achieve difficult poses, but rather to work on mindfulness and meditation.</p>
      <p>Using chakra stones such as Selenite, Clear Quartz, Amethyst and Diamond can also be an effective way to heal the crown chakra.</p>
      <p>Aromatherapy for the crown chakra encompasses a wide range of scents. Flowery essential oils like jasmine, rose and lavender can soothe an overactive crown chakra, while more pungent essential oils like sandalwood, frankincense and myrrh can help stimulate an underactive or blocked Sahasrara.</p>
      <p>The crown chakra’s elements are thought and light, so spending time in the sunlight is good for opening the crown chakra. Reading or doing puzzles outside on a sunny day is an easy way to help heal the crown chakra.</p>
      <hr>
		<p><strong>OPENING YOUR CHAKRAS</strong><a name="opening"></a></p>
		<p><img src="images/Opening-Chakras-1.jpg" class="img-responsive"></p>
		<p>Opening the chakras can be done in several ways of various difficulties. Here’s are simple instruction explaining how to open your chakras in 3 steps:</p>
		<p>Step 1: Know your chakras<br>
		    Step 2: Identify the primary chakra or chakras you want to work at opening first<br>
		    Step 3: Activate the energy in the chakra you want to open<br>
		    There are numberous ways to open chakras, some are prescribed by traditional schools of thoughts associated with Eastern spirituality; some are more modern and are often derived from these more ancient practices. They were created by people interested today in psychology, healing, and holistic medicine with the purpose of helping us in our everyday lives. We will expose mostly contemporary ideas and techniques that you can easily apply on your own.</p>
		<p>Opening Chakras Step 1: Know your Chakras<br>
		    The first step to opening your chakras is to know them. These centers of energies have different qualities and characteristics that are useful to recognize in order to find a better balance overall. For instance, practices to open the root chakra will be different from the ones used to open the heart or third eye chakra.</p>
		<p>Action item: Know you chakras. Get online and learn more about the seven chakras and their individual characteristics.<br>
		    Opening Chakras Step 2: Identify which chakra needs most help<br>
		    The second step consists in identifying which chakra you want to work on first. The chakras are all connected. If one is imbalanced, whether it’s overactive and too open or deficient and “closed” or energy does not flow well through it, the neighboring chakras and the whole system may be affected as well. That’s why it might sometimes be difficult to pinpoint which chakra needs the most help.</p>
		<p>Here are a few pointers:</p>
		<p>Take the chakra test; it will help identify possible areas to focus on<br>
		    Check whether you have a localized physical pain; it might be related to the activity of the chakra corresponding to that area<br>
		    Look at what’s happening in your and what is most problematic or causes most concerns (e.g., a relationship, finances, feeling of safety, lack of motivation, emotional roller-coaster, etc.)<br>
		    Have a person who’s energy conscious do a checkup</p>
		<p>Action item: Identify one or two chakras to open first. Take a chakra test and check which chakra needs the most attention.</p>
		<p>Opening Chakras Step 3: Activate the energy to open your chakra<br>
		    The third step is to activate the energy in the chakra you want to open. It’s useful to think of it not just in terms of “opening” your chakra, but also restoring flow, increasing awareness of its state and variations, and balancing inflow and outflow of energy. The main principle at work when opening your chakras is the idea of balance or balancing.</p>
		<p>To activate the energy in the chakras you want to open, you may practice the following:</p>
		<p>Physical activity focused on the chakra’s location in the body<br>
		    Breathing exercises<br>
		    Meditation on a specific chakra<br>
		    Introspection and self-inquiry to address the psychological and emotion components of the blockage<br>
		    Self-healing hands-on techniques (e.g. massage, “chakra connection” technique)<br>
		    Healing session to balance your chakras		</p>
		<p>When you start activating energy in a chakra that had an imbalance, “stuff” may come up. In other words, the “stuff” that was contributing to closing the chakra might come to your awareness, so you have a chance to deal with it more consciously. Be mindful of taking good care of yourself, with enough rest, moments of reflection and introspection, as well as physical activity to keep things moving.</p>
		<p>Action item: Check which type of practice makes most sense or resonates with you: Is it a physical practice or meditative one? Can you make a little time to center yourself and reflect or do you prefer to schedule a one-hour healing session?</p>
		<p>Action item: Check the list of 7 chakras and corresponding pages to learn more about specific practices to open each individual chakra.</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="history-of-reiki.php" class="btn btn-primary">Previous</a>
		<a href="seven-chakras-short.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
