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
<title>Rei-ki : Heart Chakra </title>
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
  <h1 class="page-header">Heart Chakra </h1>

<audio controls class="my-audio">
  <source src="audio/chakras_heart.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Located at the center of the chest, the Heart Chakra is how we tap into our Higher Selves, self-love, divine love, and Christ Consciousness. When it is imbalanced, we may physically experience imbalances in that area of the body, such as: heart issues (like congestive heart failure or heart attacks), asthma/allergies, lung cancer, breast cancer, or bronchial pneumonia.</p>
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
      <p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="chakras_solarplexus.php" class="btn btn-primary">Previous</a>
		<a href="chakras_throat.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
