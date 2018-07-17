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
<title>Rei-ki : Solar Plexus Chakra</title>
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
  <h1 class="page-header">Solar Plexus Chakra</h1>

<audio controls class="my-audio">
  <source src="audio/chakras_solarplexus.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Located 1-2 inches above the navel, the Solar Plexus Chakra is our power center, and where we are connected to our self-esteem and self-protection. When we feel scattered and direct our energies outward, it is usually a sign that we have given our power away. When this happens, sometimes one can feel discomfort, or a whirling sensation, in the Solar Plexus Chakra.</p>
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
      <p>&nbsp;</p>
		<div>
		<a href="chakras_sacral.php" class="btn btn-primary">Previous</a>
		<a href="chakras_heart.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
