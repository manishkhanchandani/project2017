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
<title>Rei-ki : Third Eye Chakra</title>
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
  <h1 class="page-header">Third Eye  Chakra</h1>

<audio controls class="my-audio">
  <source src="audio/chakras_thirdeye.ogg" type="audio/ogg">
Your browser does not support the audio element.
</audio>
<hr />

  <div id="content" class="visual">
      <p>Located between the eyebrows, the Third Eye helps us see that which is not physical. This is where our intuition lies, as well as clairvoyance and psychic perception. When this chakra is imbalanced, this may physically manifest as brain issues, such as stroke, brain tumor/hemorrhage, neurological disturbances and seizures.</p>
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
      <p>&nbsp;</p>
		<p>&nbsp;</p>
		<div>
		<a href="chakras_throat.php" class="btn btn-primary">Previous</a>
		<a href="chakras_crown.php" class="btn btn-primary">Next</a>		</div>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
