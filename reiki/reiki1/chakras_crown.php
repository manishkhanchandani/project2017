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
<title>Rei-ki : Crown Chakra </title>
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
  <h1 class="page-header">Crown Chakra </h1>

<audio controls class="my-audio">
  <source src="audio/chakras_crown.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />
  <div id="content" class="visual">
      <p>Located at the top and center of the head, this chakra is our connection to the Universe, our spirituality, and our trust in life. This is the chakra from which we receive divine guidance from Source/Goddess/Higher Power. When this chakra is imbalanced, this manifests physically as depression, or as chronic exhaustion that is not linked to physical disorders.</p>
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
      <p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="chakras_thirdeye.php" class="btn btn-primary">Previous</a>
		<a href="chakras_opening.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
