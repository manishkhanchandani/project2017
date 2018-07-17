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
<title>Rei-ki : Throat Chakra</title>
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
  <h1 class="page-header"> Throat Chakra</h1>

<audio controls class="my-audio">
  <source src="audio/chakras_throat.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Located in the base of the throat, the Throat Chakra helps us to speak our truth. It deals with the issues of creativity, communication, and the will to live. Physical manifestation of this chakra's imbalances may show up as thyroid problems, TMJ, sore throat, swollen glands, or scoliosis.</p>
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
      <p>&nbsp;</p>
		<div>
		<a href="chakras_heart.php" class="btn btn-primary">Previous</a>
		<a href="chakras_thirdeye.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
