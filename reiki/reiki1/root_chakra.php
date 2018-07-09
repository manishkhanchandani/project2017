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
<title>Rei-ki : Root Chakra</title>
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
  <h1 class="page-header">Root Chakra </h1>

  <div>
      <p><a href="images/Root-Chakra-Healing-1.jpg" target="_blank"><img src="images/Root-Chakra-Healing-1.jpg" width="300" height="300" border="0"></a></p>
      <p>Root chakra healing fosters proper energy flow throughout the body giving the chakra system a firm foundation on which the other energy centers may function. When the first chakra is blocked or somehow off balance, it is not uncommon to exhibit uncharacteristic behaviors, like paranoia, being short-tempered or aggressive. Healing your root chakra empowers you to confidently face whatever life may bring.</p>
      <p>In this article, you’ll learn about:</p>
      <ul>
          <li>Understanding the root chakra</li>
          <li>Why healing your first chakra?</li>
          <li>Healer’s cheat sheet</li>
          <li>Common symptoms addressed by root chakra healing</li>
          <li>How to heal the root chakra</li>
          <li>Key steps for in-depth healing of the root chakra</li>
          <li>Useful questions to guide the process</li>
          <li>References and quotes</li>
          </ul>
      <p><strong>Understanding The Root Chakra</strong></p>
      <p>The root chakra is sometimes referred to as the Muladhara chakra — for its feminine energy. Known as the seat for raw energy, known as Kundalini, the Muladhara chakra is the first of seven chakras located at the base of the spine.</p>
      <p>It governs the functioning of the lower part of the body, including the bladder, kidneys, lower spine and back. Psychologically, it governs confidence and survival instincts, like “fight or flight.”</p>
      <p>Red is the widely accepted chakra color associated with the root chakra. According to energy healers, the root chakra may also be associated with the colors brown, black, and gray.</p>
      <p><strong>Why Healing The Root Chakra?</strong><br>
          When the root chakra is functioning optimally, you feel grounded, secure, and at ease with the world. But when it is imbalanced or blocked several signs can manifest, from constipation to back pain and fatigue.</p>
      <p>Additional physical and psychological signs can include:</p>
      <ul>
          <li>Feelings of insecurity</li>
          <li>Aggressiveness</li>
          <li>Sexual dysfunction</li>
          <li>Anger</li>
          <li>Restlessness</li>
          <li>Eating disorders</li>
      </ul>
      <p><strong><br>
          Root Chakra Healing Cheat Sheet</strong></p>
      <p><img src="images/root-chakra-healing-chart.jpg" width="900" height="750"></p>
      <p>&nbsp;</p>
      <p><strong>Common Symptoms Addressed By Root Chakra Healing</strong></p>
      <p><strong>1. Being constantly challenged in getting your primary needs met</strong></p>
      <p>Having enough money to get food or pay this month’s bills, having stable housing… If getting these basic needs met is a constant struggle for you, chances are that your root chakra will benefit from healing work. Root chakra healing focuses on getting you out of the detrimental cycle of behaviors and beliefs dominated by lack and scarcity.</p>
      <p><strong>2. Looming feelings of insecurity</strong></p>
      <p>If your first chakra is out of balance, you will notice that it is hard for you to feel safe in the world. This feeling of insecurity can manifest through constant worries about finances, health, where the world is going. You might even feel paranoid about every little thing.</p>
      <p>We’re not talking about transitory concerns associated with circumstances that deserve your immediate attention, so you can address the issue at hand effectively. First chakra concerns are more deeply rooted in your psyche and tend to persist over time, acting as a lingering feeling of insecurity.</p>
      <p>Root chakra healing consists in remedying these fears by allowing more supportive energy to come into your life and providing a solid foundation on which you can rest.</p>
      <p><strong>3. Fear is your main motivating factor</strong><br>
          If you notice that your life is based on fear, root chakra healing could help. It aims at bringing a more balanced perspective, so your decision-making is more well-rounded and not based exclusively on survival instinct or “fight or flight” responses.</p>
      <p>First chakra preoccupations regarding survival can often spin out of control when your support system and resources are not strong enough. By working at reinforcing your foundations and rooting yourself in stronger perceptions of safety, your can gain a greater awareness of your real needs and aspirations, and what needs to be done in order to fulfill them.</p>
      <p><img src="images/Root-Chakra-Healing-2.jpg" width="626" height="700"></p>
      <p><strong>Root Chakra Healing</strong></p>
      <p>Key steps for in-depth healing of the root chakra<br>
          <strong>1. Anchoring yourself in your environment</strong></p>
      <p>Root chakra preoccupations relate to feeling safe in the world. Developing a harmonious relationship with your environment is key in fostering safety. How you feel in your immediate surroundings, from your home to your neighborhood and region matters in supporting the first chakra balance.</p>
      <p><strong>2. Connecting intimately with the earth</strong></p>
      <p>In order to heal root chakra imbalance, it’s important to connect directly to the earth. Go outside and walk on unpaved paths, dig your hands in the earth, plant seeds… These are all examples of personal connections with the earth element that will support the opening of the root chakra to a more grounded, sustainable energy flow.</p>
      <p>If you do not have access to garden, walking outside to a park and pay attention to every step you make, feeling the contact of your feet to the ground. Make it a daily practice. The presence of plants in your immediate surrounding can also be helpful to bring the earth closer to you. Another way to connect with this elemental energy is to imagine grounding yourself deep into the earth by visualizing a grounding cord made a burgundy red light, uniting your root chakra to the center of the earth.</p>
      <p><strong>3. Physical activity promotes root chakra health</strong></p>
      <p>Let’s face it, the root chakra governs the quality of our physical presence and feeling of aliveness in our body. Physical activity, no matter big or small, supports root chakra healing. Any movement involving your feet and legs will be particularly helpful. When you feel your vital force, you connect with the strength of root chakra energy and grounded in your life.</p>
      <p><strong>4. Overcoming feelings of insecurity by learning self-reliance</strong></p>
      <p>To counter the tendency to worry about safety and well-being, an element characteristic of first chakra imbalance, long-lasting healing consists in reinforcing your belief that you’re OK in this world and can get what you need when you need it. Working on self-reliance, confidence, perceptions about resourcefulness in your life are key in healing the root chakra.</p>
      <p><strong>5. Discovering your true needs and aspirations</strong></p>
      <p>To heal the first chakra, you need to know what your true needs and aspirations are. This generally helps guide your course of action and decisions with regards to the place you want to live in, the work you want to do, and the people you want to surround yourself with. Without this awareness, you have more chances to be swayed by others’ opinions or circumstances, and miss the opportunity to meet your deepest needs.</p>
      <p>Introspection and clarity are therefore keys to healing the root chakra. This is no small task, but with some time given to personal reflection and friendly advice, you will get in the right direction. Pay attention to limiting beliefs about yourself, and trust possibilities towards a better life.</p>
      <p><strong>6. Going from a psychology of scarcity to personal abundance</strong></p>
      <p>Remember that a psychology of lack and scarcity tends to self-perpetuate and reinforces limiting beliefs about your chances of success. Healing your root chakra aims at restoring confidence in your ability to provide for yourself and meet your basic needs easily.</p>
      <p>An important step in healing root chakra concerns is to re-center the notion of material abundance on inner and non-material abundance. For instance, instead of assessing your level of wealth just base on your bank account, consider all the other types of riches you have in your life, from friendships to enjoyment of everyday pleasures. In the process, you will like have to reconsider personal beliefs about money and physical safety.</p>
      <p><strong>7. The root chakra and embodying the energy of manifestation</strong></p>
      <p>When healing the root chakra, it’s important to remember that the outer world is often a reflection of what is happening inside you. Your notion about what it means to be abundant in the material world is affected and affects your notion of inner balance and resourcefulness. In other words, your state of being translates into your ability to manifest in the material world.</p>
      <p><strong>How To Heal Your Root Chakra</strong><br>
          Several steps may be taken to heal an imbalance or blockage in the root chakra. Depending on the severity of the blockage, you may opt to use chakra healing meditation, yoga poses, or even a variety of forms of energy healing, from reiki to acupuncture and sound therapy — such as the use of chakra tuning forks.</p>
      <p><strong>Aromatherapy For The First Chakra</strong></p>
      <p>Aromatherapy is another useful tool for first chakra balancing. To heal the root chakra, consider using flowering, earthy-scented essential oils to ground and balance, including;</p>
      <p>ylang-ylang<br>
          rosemary<br>
          patchouli<br>
          sandalwood<br>
          myrrh<br>
          rosemary<br>
          When exploring every day steps you can take to restore balance to your chakra system, consider adding healing food to your diet.</p>
      <p><strong>Root Chakra Healing Foods</strong></p>
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
          Smokey quartz</p>
      <p><br>
          <strong>Useful questions to guide first chakra healing</strong></p>
      <ul>
          <li>Do you feel you have all you need to live comfortably?</li>
          <li>How are you doing financially? Are you constantly struggling or do you have strong foundations?</li>
          <li>How are your current living conditions? Do you feel supported enough?</li>
          <li>Do you feel connected to the natural environment around you?</li>
          <li>Do you feel threatened by looming fears about the end of the world? Or do you trust that no matter what happens, you and your family will be OK?</li>
          <li>How resourceful do you feel when you meet life challenges (whether they are financial, health-related, job-related, etc.)?</li>
          <li>Do you find yourself in situations that others deemed right for you, but do not truly meet your deepest needs and aspirations?</li>
          <li>Do you feel you have enough support where you live?</li>
          <li>Are your roots strong enough to support you wherever you are?</li>
      </ul>
      <p>&nbsp;</p>
      <p>&nbsp;    </p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
