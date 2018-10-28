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
<title>Rei-ki : Sacral Chakra </title>
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
  <h1 class="page-header">Sacral Chakra      </h1>

<audio controls class="my-audio">
  <source src="audio/chakras_sacral.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
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
      <p>&nbsp;</p>
		<div>
		<a href="chakras_root.php" class="btn btn-primary">Previous</a>
		<a href="chakras_solarplexus.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
