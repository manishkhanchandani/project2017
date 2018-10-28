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

  <div id="content" class="visual">
      <p><strong>Seven Chakras</strong> are:</p>
      <ol>
          <li><strong><a href="#root">Root chakra</a></strong> (Muladhara) — base of the spine — <strong>red</strong> <br>
              The first one to the perineum, in the coccyx area (<a href="root_chakra.php" target="_blank">more</a>)          </li>
          <li><strong>Sacral chakra</strong> (Svadhishthana) — just below the navel — <strong>orange</strong> <br>
The second one to the lower belly, seen a few inches below the navel </li>
          <li><strong>Solar Plexus chakra</strong> (Manipura) — stomach area — <strong>yellow</strong> <br>
The third one to the solar plexus (actually few inches below real solar plexus) </li>
          <li><strong>Heart chakra</strong> (Anahata) — center of the chest — <strong>green</strong> <br>
The fourth one to the center of the chest, slightly to the left of the physical heart</li>
          <li><strong>Throat chakra</strong> (Vishuddha) — base of the throat — <strong>blue</strong> <br>
The fifth one to the throat, at the carotid plexus </li>
          <li><strong>Third Eye chakra </strong> (Ajna) — forehead, just above area between the eyes — <strong>indigo</strong> <br>
The sixth one to the point between the eyebrows or “third eye” </li>
          <li><strong>Crown chakra</strong> (Sahasrara) — top of the head — <strong>violet</strong> <br>
The seventh one to the top of the cranium</li>
          </ol>
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
      <p>The root chakra is the first chakra. Its energy is based on the earth element. It’s associated with the feeling of safety and grounding. It’s at the base of the chakra system and lays the foundation for expansion in your life.</p>
      <p><strong>Where is the Root Chakra?</strong><br>
          The first chakra or root chakra is located at the base of the spine. The corresponding body locations are the perineum, along the first three vertebrae, at the pelvic plexus. This chakra is often represented as a cone of energy starting at the base of the spine and going downward and then slight bent up.</p>
      <p><strong>Key characteristics of the root chakra</strong><br>
          The first chakra is associated with the following functions or behavioral characteristics:</p>
      <ul>
          <li>Security, safety</li>
          <li>Survival</li>
          <li>Basic needs (food, sleep, shelter, self-preservation, etc.)</li>
          <li>Physicality, physical identity and aspects of self Grounding</li>
          <li>Support and foundation for living our lives</li>
      </ul>
      <p>The root chakra provides the foundation on which we build our life. It supports us in growing and feeling safe into exploring all the aspects of life. It is related to our feeling of safety and security, whether it’s physical or regarding our bodily needs or metaphorical regarding housing and financial safety. To sum it up, the first chakra questions are around the idea of survival and safety. The root chakra is where we ground ourselves into the earth and anchor our energy into the manifest world.</p>
      <p><strong>What happens when the first chakra is imbalanced</strong><br>
          At the emotional level, the deficiencies or imbalance in the first chakra are related to:</p>
      <ul>
          <li>Excessive negativity, cynicism</li>
          <li>Eating disorders</li>
          <li>Greed, avarice</li>
          <li>Illusion</li>
          <li>Excessive feeling of insecurity, living on survival mode constantly</li>
      </ul>
      <p>For a person who has imbalance in the first chakra, it might be hard to feel safe in the world and everything looks like a potential risk. The desire for security dominates and can translate into concerns over the job situation, physical safety, shelter, health. A blocked root chakra may turn into behaviors ruled mainly by fear.</p>
      <p>On the same line, when the<strong> root chakra is overactive</strong>, fear might turn into greed and paranoia, which are extreme forms of manifestation of imbalance in the first chakra. Issues with control over food intake and diet are related to it.</p>
      <p><strong>Opening the root chakra</strong></p>
      <p>          There are many ways to open your root chakra. For example, you can engage more in grounding and earth-related activities (for example, connection with nature, <strong>gardening</strong>, <strong>cooking healthy</strong>, <strong>hiking</strong>). Or <strong>REIKI</strong> TO ROOT CHAKRA </p>
      <p>The main idea is to work at growing your ”roots” in a safe and comfortable environment (i.e., surround yourself with earth colors, objects reminding you of nature, stability; or on the contrary, if you wish to feel less stuck, do the opposite).</p>
      <p>The root chakra or Muladhara is home to your primal energy. Located at the base of the spine, it is associated with your most basic survival needs.</p>
      <p><strong>The first chakra</strong> governs the bladder, kidneys, lower extremities, and spine. When there is an imbalance, you can experience physical symptoms that include:</p>
      <p>constipation<br>
          weight issues<br>
          fatigue<br>
          back pain<br>
          Emotionally speaking, when the first chakra is in need of healing, you may find you’re <strong>short-tempered and unusually aggressive</strong>. Other signs you need to open up the root chakra are:</p>
      <p>insecurity<br>
          poor decision making<br>
          anxiety<br>
          detachment<br>
          Symbolized by the color red, the root chakra fosters confidence and security when it is opened and balanced. However, when it is in need of healing, there are several simple exercises and steps you can take to restore balance.</p>
      <p><strong>Stand</strong><br>
          When you’re feeling less than grounded stand with your feet shoulder-width apart and relax your upper body. Let your arms rest comfortably at your sides and allow your hips to rest slightly forward. Breathe deeply and with each exhale feel your connection to the earth deepen.</p>
      <p><strong>Rinse Off</strong><br>
          Simply taking a shower can help cleanse and balance the root chakra. Be aware of your physical body as you bathe, Mindful awareness is a tremendous tool for healing the first chakra.</p>
      <p><strong>Get Moving</strong></p>
      <p>Everyday physical movement, from running to completing chores around the house, is a great way to heal your root chakra. The key is to be aware of your body and feel the sensation of movement. Awareness is crucial to healing.<br>
          <strong>Mindful Walking</strong><br>
          Whether you are walking out in nature or down a crowded city street, be aware of every step you take. Concentrate on your breath and every footfall. With every step take note of the sensation you feel each time your foot touches the ground. Mindfulness of something as mundane as walking can activate the root chakra and ground you to the earth.</p>
      <p><strong>Visualize Red</strong><br>
          Wearing the color red or incorporating it into the decor of your home environment or workspace is a gentle reminder to be aware of the primal, core energy of your root chakra. You can even take this one step further by visualizing, or meditating on, the color red. For instance, take a few seconds or even a few minutes to visualize a radiant, red ball of energy at the base of your spine. See it brighten and radiate downward as it illuminates your lower extremities and grounds you.</p>
      <p><strong>Strike a Pose</strong></p>
      <p>Dancing is a great way to open up your root chakra. Whether you dance in public or behind closed doors, the key is to let the rhythm guide you. Allowing the body to be free to move uninhibited will dispel negativity, open and balance the first chakra.<br>
          <br>
          <strong>Stretch and Don’t Forget to Breathe</strong><br>
          Adopting a regular yoga routine is another great tool to open up, heal, and balance the root chakra. Introducing simple forward bends and standing positions can help stretch your legs, back and spine giving you a strong foundation. To ground yourself and activate your root chakra, try these poses to foster balance and focus:</p>
      <p>Tree (Vrksasana)<br>
          Eagle (Garudasana)<br>
          Mountain (Tadasana)<br>
          Downward-Facing Dog (Adho Mukha Svanasana)<br>
          Wide-Legged Forward Bend (Prasarita Padottanasana)</p>
      <p><strong>What’s in the Muladhara or root chakra name?</strong><br>
          The first chakra is referred to as:</p>
      <p>Root chakra<br>
          Muladhara<br>
          Adhara<br>
          Its sanscrit name is ”muladhara” can signify “base”, ‘foundation”, “root support”.</p>
      <p>The first chakra is associated with the Earth element.</p>
      <p><strong>Chakra colors: The red chakra</strong><br>
          The typical color used to represent the root chakra is a rich vermilion red. This is the color used on its symbol to fill its petals. Traditionally, it is also associated with the color yellow or gold (this is the color of its element as opposed to its petals). In the spectrum of chakra colors, red symbolizes strength, vitality, and stimulates our instinctual tendencies.</p>
      <p><strong>Root chakra symbol</strong><br>
          The symbol of the root chakra is composed of a four-petaled lotus flower, often stylized as a circle with four petals with a downward-pointing triangle.</p>
      <p>The downward-pointing triangle is a symbol of spirit connecting with matter, grounding on the earth and our earthly existence, in our bodies. It’s seen as the center of our vital life force and is the seat where kundalini stays coiled, dormant, until is wakes up to distribute its energy through all the other chakras.</p>
      <hr>
      <p><strong>SACRAL CHAKRA</strong></p>
	  <p>This chakra is located about 1-2 inches below the navel. It is the chakra that deals with sex, power, money, gender, emotions, creativity, and procreation. When this chakra is imbalanced, there may lower back, pelvic, or hip problems, ob/gyn imbalances (including fibroids, cysts, etc.), issues around sexual potency, relationships, abundance, power and control.</p>
	  <p>

This chakra is also linked to how we express our creativity, and is also related to the Throat Chakra. Sexual abuse or trauma can create an energy block in this chakra. Reiki can help bring these deeply suppressed emotions to the surface (especially anger) and allow us to finally, fully heal.</p>
<hr>
      <p>The sacral chakra is the second chakra. It is associated with the emotional body, sensuality, and creativity. Its element is water and as such, its energy is characterized by flow and flexibility. The function of the sacral chakra is directed by the principle of pleasure. Let’s have a look at this energy center’s basics, including its location, color, symbol, potential signs of imbalance, and what to do heal your sacral chakra.</p>
      <p><strong>Sacral chakra location</strong><br>
          The most common location for the sacral chakra is about three inches below the navel, at the center of your lower belly. In the back, it’s located at the level of the lumbar vertebrae.</p>
      <p>Other noteworthy locations described in different systems, expand its location to the genital area, especially at the level of ovaries for women and the testicles for men.</p>
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
      <p>The second chakra is instrumental in developing flexibility in our life. Associated with the water element, it’s characterized by movement and flow in our emotions and thoughts. It supports personal expansion and the formation of identity through relating to others and to the world.</p>
      <p><strong>Sacral chakra imbalance</strong><br>
          When the sacral chakra is balanced, the relationship with the world and other people is centered around nurturing, pleasure, harmonious exchange.</p>
      <p>Imbalance in the sacral chakra can manifest as:</p>
      <p>Dependency, co-dependency with other people or a substance that grants you easy access to pleasure<br>
          Being ruled by your emotions<br>
          The opposite: Feeling numb, out of touch with yourself and how you feel<br>
          Overindulgence in fantasies, sexual obsessions<br>
          Or the opposite: Lack of sexual desire or satisfaction<br>
          Feeling stuck in a particular feeling or mood<br>
          Sacral Chakra</p>
      <p><strong>Sacral chakra meaning</strong><br>
          The second chakra is referred to as:</p>
      <p>Sacral chakra<br>
          Svadhisthana<br>
          Adhishthan<br>
          Shaddala</p>
      <p>The most common Sanskrit name for the sacral chakra is “Svadhisthana”, which means “your own place”.<br>
          <strong>Sacral chakra color</strong><br>
          The sacral chakra is most commonly represented with the color orange. However, since it’s associated with the element of water, it could also take the color of very light blue or white in more rare occasions.</p>
      <p>The orange of the second chakra is translucent and has a transparent quality.</p>
      <p><strong>Sacral chakra symbol</strong><br>
          The symbol of the sacral chakra is composed of:</p>
      <p>A circle with six petals<br>
          A moon crescent<br>
          The circle represents the elements of water. Typically, the moon crescent is colored in silver and represents the connection of the energy of the moon with water. These symbols point to the close relationship between the phases of the moon and the fluctuations in the water and the emotions.</p>
      <p>Furthermore, the symbolism of the moon relates to the feminine menstrual cycle that takes the same number of days to complete and the connection of the sacral chakra with sexual organs and reproduction.</p>
      <hr>
      <p><strong>Overactive Sacral Chakra</strong></p>
      <p>If your sacral chakra is overactive your life may be rife with issues of excess and conflict, from thriving on drama to problems with addiction and unhealthy relationships.The key to restoring balance is to familiarize yourself with the signs of an overactive second chakra. When you recognize and understand the issues, learning how to balance the overabundance of chakra energy is made easier.</p>
      <p><strong>Signs of Overactivity in the Sacral Chakra</strong></p>
      <p>Although signs of an overactive sacral chakra generally manifest in non-physical ways, physical symptoms can occur. For instance, you may experience a persistent sensation of warmth in your lower abdomen when energy flow through the chakra is excessive. An overactive sacral chakra can also significantly impact the function of the reproductive organs, bladder, and lower back. Among the most common physical ailments are:</p>
      <p>cysts<br>
          urinary issues<br>
          kidney problems<br>
          lower back pain<br>
          gynecological problems</p>
      <p><br>
          When your sacral chakra is overwhelmed, you yourself may feel overwhelmed. You may experience emotions more deeply than normal, have severe mood swings, or seemingly thrive on conflict and drama. Oftentimes, the excess of emotions can also lead to poor personal boundaries making you overly dependent on others or even obsessive.</p>
      <p>Non-physical signs of an overactive sacral chakra can include:</p>
      <p>anxiety<br>
          mania<br>
          aggressiveness<br>
          arrogance</p>
      <p>&nbsp;</p>
      <p>Considering the sacral chakra influences sexuality, an overactive sacral energy center can contribute to promiscuity, sex addiction, and feelings of detachment or viewing others as mere objects to achieve sexual gratification.<br>
          Individuals with an overactive sacral chakra may also develop addiction to alcohol, drugs, or other unhealthy substances or engage in high-risk behaviors. Additional issues can include excessive eating and an unhealthy focus on one’s body image.</p>
      <p><strong>Cleansing an overactive sacral chakra</strong></p>
      <p>Located in the lower abdomen, the sacral, or navel, chakra rules your ability to relate to the world around you. It governs your ability to interact with others and develop, nurture and maintain healthy relationships. Being mindful of making the right choices to curb unhealthy behaviors helps cleanse and heal the sacral chakra.</p>
      <p>Because of its close association with the digestive system, adopting a healthy diet and getting plenty of exercise might be particularly helpful in balancing the second chakra’s energy flow.</p>
      <p>The chakra is aptly associated with the color orange, a hue representing energy, creativity, and pleasure. To balance an overactive sacral chakra, you may surround yourself with its opposite color, blue.</p>
      <p>If, after making lifestyle changes, you still feel out-of-balance, consider incorporating other energy healing techniques, such as aromatherapy, yoga, meditation, or Tai Chi. Long-standing and severe energy imbalance can necessitate consulting with an energy healer to help restore balance and healing.</p>
      <hr>
      <p><strong>SOLAR PLEXUS CHAKRA</strong></p>
	  <p>
	  Located 1-2 inches above the navel, the Solar Plexus Chakra is our power center, and where we are connected to our self-esteem and self-protection. When we feel scattered and direct our energies outward, it is usually a sign that we have given our power away. When this happens, sometimes one can feel discomfort, or a whirling sensation, in the Solar Plexus Chakra.</p>
	  <p>

Physical imbalances may manifest as anorexia or bulimia, liver or adrenal dysfunction, fatigue, stomach ulcers, diabetes, or indigestion. Emotionally, we may be afraid to step into our power, have issues around self-confidence, self-respect, feel easily intimidated, weak, closed, depressed. When Reiki is performed and these blockages are lifted, we've cleared the way to take action in our life.	  </p>
	  <hr>
      <p>“Radiate your power in the world,” could say the solar plexus chakra. Characterized by the expression of will, personal power, and mental abilities, the energy of the third chakra or Manipura in Sanskrit is mobilized when we assert ourselves in the world. Discover its key characteristics and how to make the most of this powerful energy center.</p>
      <p>Introducing the Solar Plexus or Manipura chakra<br>
          Let’s start by exploring the basics, including the location, color, and symbol of the solar plexus chakra. Then, we are going to look at possible signs of imbalance in the third chakra and what to do to heal your solar plexus center and restore its balance to its optimal state.</p>
      <p><strong>Chakra Key Elements</strong><br>
          First, we’re going to look at the Solar Plexus chakra basics:</p>
      <p>Location: In the solar plexus area (upper part of the belly, where your diaphragm rests); it is the third chakra from the bottom in the traditional system counting 7 chakras<br>
          Color: Yellow (higher frequencies of this chakra can turn into golden yellow)<br>
          Symbol: A circle with 10 petals in which is inscribed a downward-pointing triangle<br>
          Original name in Sanskrit: Manipura<br>
          Element: Fire<br>
          Additional elements used in modern energy healing practices are healing crystals and aromatherapy. If you’re curious, here’s a list of the most common ones:</p>
      <p>Solar Plexus chakra healing stones: Citrine, tirger’s eye, yellow tourmaline<br>
          Essential oils: Chamomile, bergamot, cedarwood, rosemary are amongst the most popular soothing oils</p>
      <p><strong>Main Chakra Meanings</strong><br>
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
      <p><strong>Chakra Element:</strong> Fire<br>
          The Manipura chakra is traditionally related to the element of fire, though some contemporary healing movements connect it to the element of air. It has a connection with the sun, heat, the energy of light, all forms of power.</p>
      <p><strong>Chakra Color:</strong> Yellow<br>
          The Solar Plexus chakra is most commonly represented with the color yellow. Since it’s associated with the element of fire, it is also sometimes depicted with yellowish red.</p>
      <p><strong>Chakra Location: </strong>Solar Plexus<br>
          The most commonly accepted location for the third chakra is at the solar plexus level, between the navel and the lower part of the chest. That’s why it’s often referred to as the “solar plexus chakra.” Some traditions place it more loosely in the navel area.</p>
      <p>Closely connected to the digestive system, especially the gastric and hypogastric plexi, its main function is to help transform matter into energy to fuel your body. It governs metabolism and is commonly associated with the pancreas.</p>
      <p><strong>Chakra Symbol</strong><br>
          The main elements of the Solar Plexus chakra symbol [LINK] are:</p>
      <p>A circle with ten petals<br>
          An downward-pointing triangle<br>
          The inverted triangle represents the fire element and the transformative power of this energy center. Fire turns matter into energy that can be used to propel, move forward. The ten petals are often represented with the color blue, like the blue color of the flame.<br>
      </p>
      <p><strong>Solar Plexus Chakra</strong></p>
      <p>What does Sanskrit name “Manipura” mean?<br>
          The most common Sanskrit name for the Solar Plexus chakra is “Manipura”, which means “city of jewels” or “seat of gems”.</p>
      <p>The third chakra is also referred to as:</p>
      <p><strong>Solar Plexus chakra</strong><br>
          Manipura<br>
          Manipurak<br>
          Nabhi<br>
          The “power chakra”<br>
          The word “nabhi” can be translated as “navel”.</p>
      <p><strong>What the Solar Plexus chakra is known for</strong><br>
          The Solar Plexus chakra is associated with the following psychological and behavioral functions:</p>
      <p>Expression of will<br>
          Intellectual abilities<br>
          The “accounting mind” that categorizes everything, assesses the pluses and minuses in life<br>
          Personal power<br>
          Ability to establish ideas and plans into reality<br>
          At higher levels, it conveys wisdom<br>
          The main function of this energy center is to provide actual momentum to move forward and realize personal desires and intentions in the world. It plays a fundamental role in the development of personal power. It feeds one’s direction in life and the actions taken in order to reach your goals. It influences preoccupations about social status and self-image.</p>
      <p><strong>Signs your Solar Plexus chakra may be out of balance</strong><br>
          On one side, a balanced solar plexus chakra makes it easy to find balance between your personal power and harmonious relationships with others; on the other side, an imbalanced third chakra could undermine your self-esteem and social life.</p>
      <p><strong>When the Solar Plexus chakra is balanced, you may:</strong></p>
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
          Making plans or having a lot of ideas without finding efficient ways to realize them</p>
      <hr>
      <p>HEART CHAKRA</p>
	  <p>
	  Located at the center of the chest, the Heart Chakra is how we tap into our Higher Selves, self-love, divine love, and Christ Consciousness. When it is imbalanced, we may physically experience imbalances in that area of the body, such as: heart issues (like congestive heart failure or heart attacks), asthma/allergies, lung cancer, breast cancer, or bronchial pneumonia.</p>
	  <p>

Emotionally, we may feel lonely, disconnected from ourselves and others, resentful, depressed (due to lack of hope), grief, distrust in love, and lack of compassion. Reiki can not only help make us more compassionate, but by clearing these blockages we might also become more open to accepting love from others.	  </p>
	  <hr>
      <hr>
      <p>THROAT CHAKRA</p>
	  <p>
	  Located in the base of the throat, the Throat Chakra helps us to speak our truth. It deals with the issues of creativity, communication, and the will to live. Physical manifestation of this chakra's imbalances may show up as thyroid problems, TMJ, sore throat, swollen glands, or scoliosis.</p>
	  <p>

Emotionally, we are afraid of silence, fearful of being judged and rejected, and imbalances in this chakra can also be connected to addiction. When Reiki is performed to help clear this chakra, we become more able to express ourselves or follow our dreams.	  </p>
	  <hr>
      <hr>
      <p>THIRD EYE CHAKRA</p>
	  <p>
	  Located between the eyebrows, the Third Eye helps us see that which is not physical. This is where our intuition lies, as well as clairvoyance and psychic perception. When this chakra is imbalanced, this may physically manifest as brain issues, such as stroke, brain tumor/hemorrhage, neurological disturbances and seizures.</p>
	  <p>

Emotionally, we do not trust our insights or intuition, and may become afraid of it. Reiki can help unblock this chakra and allow us to hone in on the power of our intuition.	  </p>
	  <hr>
      <hr>
      <p>CROWN CHAKRA    </p>
	  <p>
	  Located at the top and center of the head, this chakra is our connection to the Universe, our spirituality, and our trust in life. This is the chakra from which we receive divine guidance from Source/Goddess/Higher Power. When this chakra is imbalanced, this manifests physically as depression, or as chronic exhaustion that is not linked to physical disorders.</p>
	  <p>

Emotionally, we are unable to let go of anxiety and fear and there is a lack of trust in God or life.</p>
	  <p>

When Reiki is performed, this chakra becomes unblocked and allows us to be in more touch with Divine guidance, and have more trust in life.	  </p>
	  <hr>
      <hr>
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
