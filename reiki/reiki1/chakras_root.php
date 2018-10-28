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
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
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
<title>Rei-ki : Root Chakra </title>
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
  <h1 class="page-header">Root Chakra </h1>

<audio controls class="my-audio">
  <source src="audio/chakras_root.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
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
      <p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="seven-chakras.php" class="btn btn-primary">Previous</a>
		<a href="chakras_sacral.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
