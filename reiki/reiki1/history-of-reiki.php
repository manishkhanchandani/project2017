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
<title>Rei-ki : History of Reiki</title>
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
  <h1 class="page-header">History of Reiki ?</h1>
<audio controls class="my-audio">
  <source src="audio/history-of-reiki.ogg" type="audio/ogg">
  <source src="audio/history-of-reiki.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<hr />
  <div>
      <p>Reiki was first used by Buddha and then Jesus</p>
      <p>Rediscovered by Dr Usui in about 1922 (end of nineteenth century)</p>
      <p>The history of Usui Reiki begins with its founder, Dr. Mikao Usui. Sometimes called the Usui Sensei, Dr. Mikao Usui was born to a wealthy Buddhist family in 1865. Dr. Usui’s family was able to give their son a well-rounded education for the time. As a child, Dr. Usui studied in a Buddhist monastery where he was taught martial arts, swordsmanship, and the Japanese form of Chi Kung, known as Kiko.</p>
      <p>Throughout his education, Dr. Usui had an interest in medicine, psychology and theology. It was this interest that prompted him to seek a way to heal himself and others using the laying on of hands. It was his desire to find a method of healing that was unattached to any specific religion and religious belief, so that his system would be accessible to everyone.</p>
      <p>Dr. Usui traveled a great deal during his lifetime. He studied healing systems of all types and held different professions including reporter, secretary, missionary, public servant and guard. Finally, he became a Buddhist priest/monk and lived in a monastery.</p>
      <p><strong>Spiritual Awakening and Development of Reiki</strong><br>
          Sometime during his years of training in the monastery, Dr. Usui attended his own training rediscovery course in a cave on Mount Kurama. For 21 days, Dr. Usui fasted, meditated and prayed. On the morning of the twenty-first day, Dr. Usui experienced an event that would change his life forever. He saw ancient Sanskrit symbols that helped him develop the system of healing he had been struggling to invent. Usui Reiki was born.</p>
      <p>After his spiritual awakening on Mount Kurama, Dr. Usui established a clinic for healing and teaching in Kyoto. As the practice of Usui Reiki was spreading, Dr. Usui became known for his healing practice.</p>
      <p>Mikao Usui founded his first Reiki clinic and school in Tokyo in 1922. Before he died, Dr. Usui taught several Reiki masters to ensure that his system would not be forgotten. Among them was Dr. Chujiro Hayashi, a former naval officer who set up a Reiki clinic in Tokyo.</p>
      <p>Dr. Hayashi is credited with further developing the Usui system of Reiki by adding hand positions to more thoroughly cover the body. Dr. Hayashi also changed and refined the attunement process. Using his improved system, Dr. Hayashi trained several more Reiki Masters, including a woman named Hawayo Takata. Mrs. Takata was a Japanese-American woman who originally went to Dr. Hayashi for healing. Upon learning the system herself, Mrs. Takata took Reiki home to the United States.</p>
      <p><strong>Spread of Reiki to the West</strong><br>
          Hawayo Takata was Tokyo in 1935. Mrs. Takata was very ill and in need of surgery, but she strongly felt through her instinct that she didn’t need that surgery to be healed. After asking her doctor about alternative treatments for her condition, she was told about the Reiki practitioner in town. Mrs. Takata had never heard of Reiki, but she made an appointment, even though she was slightly skeptical. Following her initial meeting with Dr. Hayashi, Mrs. Takata saw Dr. Hayashi on a daily basis. She found the sessions to be relaxing and pleasant and, ultimately, healing.</p>
      <p>As time passed, Mrs. Takata learned Reiki One and Reiki Two. When she returned to the United States, Mrs. Takata continued to practice Reiki and eventually became a Reiki Master. Much of this happened near the beginning of World War II.</p>
      <p>Mrs. Takata wanted to spread her system of healing to others. She made changes to her Reiki practice, then used Reiki to help heal others in the United States.</p>
      <p>Before he died, Dr. Hayashi managed to impart all of Dr. Usui’s teachings onto Mrs. Takata. She continued to practice Reiki for many years. When she died, she had attuned 22 Reiki masters.</p>
      <p>Today, people who practice Reiki use the methods developed by Dr. Usui, the founder of Usui Reiki. The genius of Reiki is that practitioners can utilize Reiki to help heal themselves and for their own wellness and enhanced well-being. In fact, working on self-healing is a prerequisite for offering Reiki healing to others. Modern Reiki masters can offer the Reiki energy to others through gentle static light pressure touch using the specific traditional Reiki hand positions and even over long distances like prayer is offered. Reiki healing complements many medicinal therapies and traditional medicine and can be used to help assist in the potential healing of  people suffering from pain, illness, disease and more.</p>
      <p>Modern Reiki is becoming more popular as time goes on, and the lineage of Reiki masters is growing every day. With the return to Usui Reiki, many people are using this traditional hands on therapy to heal themselves and others.</p>
      <hr>
      <p><strong>The History of Reiki 1865 - 1926</strong><br>
          Mikao Usui was born on August 15, 1865 in the village of Yago in the Gifu Prefecture, where his ancestors had lived for eleven generations. His family belonged to the Tendai sect of Buddhism and so aged four, he was sent to a Tendai Monastery to receive his primary education.</p>
      <p>Usui was a good student and very bright. He went on to pursue higher education and received a doctorate in literature. He spoke numerous languages and became well versed in medicine, theology and philosophy. Like many intellectuals of his day, Usui was fascinated with the new science coming from the West. During this time (1880s and 90s), the Meiji emperor had begun a new regime that overthrew the Shoguns and Japan¹s feudal states, now relocated in Tokyo, were brought under the direct control of the central government. Under this new regime, the old ideas¹ were discarded in favour of modernisation and the country was opened to westerners for the first time, encouraging a frenzy to replace the traditional modes of daily life with occidental fashions, which were identified with civilisation. In every department of social and political life, men furnished with some knowledge of modern science were promoted. Men of new knowledge¹ were almost idolised and the ambition of every young man was to read the horizontal writings of occidental books. The nation as a whole asked eagerly for the benefits of the new civilisation. The motto of the era was Enlightenment and Civilisation.</p>
      <p>Usui's father, Uzaemon, was an avid follower of the new regime and adopted progressive political views. Usui had great respect for his father and was very influenced by this national obsession to become westernised¹. Whilst continuing to study science and medicine, Usui befriended several Christian missionaries who had studied medicine at Harvard and Yale. During this time, when Japan was opening its doors to the West, the first arrivals were the missionaries, both Catholic and Protestant. They set up their operations in three main areas. One was in Yokohama, under the influence of Rev. John Ballagh. Here they started their medical work and brought with them knowledge of western medical science. These missionaries became very influential leaders and formed the first Japanese Christian church in 1872.</p>
      <p>Throughout Usui¹s early adulthood, he lived in Kyoto with his wife, Sadako Sizuki, and two children, a son and a daughter. He was a businessman and had varying degrees of success. Usui did encounter some difficulties, but his strong determination and positive outlook on life helped him to overcome all obstacles. He continued his religious study and became involved with a group named ORei Jyutsu Ka¹. This group had a centre at the base of the holy mountain, Kurama Yama, north of Kyoto. There is an ancient Buddhist temple, Kurama-dera on the 1,700 ft mountain which has a large statue of Amida Buddha and houses many artefacts that are part of the National Treasure. Built in 770C.E., the temple belonged to the Tendai sect of esoteric Buddhism. By 1945 the temple had evolved into an independent Buddhist sect. For centuries, Kurama Yama has been regarded as a power spot and many famous sages, as well as Emperors, go there to pray. The temple and surrounding areas are kept in their natural state and the mountain itself is the spiritual symbol of Kurama temple. Steps lead down to the base where one can sit and meditate. Nearby is a waterfall. Usui went to this area frequently to meditate.</p>
      <p>It was during 1888 that Usui contracted cholera as an epidemic swept through Kyoto. He had a profound near death experience in which he received visions of Mahavairochana Buddha and received direct instructions from him. This was a pivotal experience for Usui that caused him to make a major reassessment of his life. He developed a keen interest in the esoteric science of healing as taught by Buddha, and he developed the compassionate wish that he might learn these methods in order to benefit mankind. When Usui recovered from his near fatal illness, he began to discuss his experiences with his family and family priest. They were outraged at his claims of seeing enlightened deities and the Tendai priest beat him over the head and chased him out of the Temple.</p>
      <p>Determined to find the answers to his questions about this vision, Usui eventually met a Shingon Bonze, Watanabe Senior, who recognised Usui¹s tremendous spiritual potential and took him on as a student. Usui then became a devout Shingon Buddhist, which outraged his family even more and they removed him from the family ancestry, regarding him as a traitor. To this day, relatives refuse to talk about him, saying that it is against the will of their ancestors to speak his name. Even his daughter wrote a clause in her Will to the effect that her father¹s name should never be spoken in her home.</p>
      <p>Mikao Usui spent a great deal of time and money pursuing his new found spiritual path by studying and collecting Buddhist scriptures. In particular, he studied Buddhist healing techniques and invested heavily in collecting old medical texts. Usui had good political and academic connections and made many contacts in various countries in his search for texts. For example, in Bombay, India, merchants travelling along the silk route through Tibet to China were given gold to find secret Buddhist healing texts. Usui was particularly interested in obtaining texts from Tibet.</p>
      <p>Kyoto was home to many large and extensive Buddhist libraries and monasteries that had collections of ancient texts. Usui did much of his research there. For many years, Usui continued to collect, study and practice these medical texts. He became an advanced practitioner and meditation master. His closest friend, Watanabe Kioshi Itami, the son of his Buddhist teacher, became his most devout student. Over time, Usui became a respected and learned Buddhist teacher with a following of devoted students. They met regularly and Usui would teach from the texts that he had been collecting. The focus of his teachings was on healing and benefiting humankind through healing. They practised elaborate rituals for averting newly created diseases that were ravaging Japan, as well as esoteric practices for healing every type of illness.</p>
      <p>Mikao Usui was truly a man ahead of his time. He went against the social norms of his day, which were very sectarian and class oriented. Usui believed that everyone should have access to the Buddhist healing methods, regardless of religious beliefs. He wanted to find a way to offer these powerful methods to the common man, with no need for long, arduous practice. Out of his great compassion and determination, he vowed that he would some day find a way to develop a healing that would cure every type of disease and could be taught to anyone, regardless of background, education or religious beliefs.</p>
      <p>It was during the late 1890s that Usui came across a box containing manuscripts that set out the methods he had sought so assiduously for so many years. Therein lay the Tantra of the Lightning Flash, the secret transmission for healing all illnesses of body, speech and mind. This Tantra provided the information that he had been looking for and presented a comprehensive healing method derived from esoteric Buddhism as practised in Tibet. The text dated back to the 7th Century and was brought to Japan by Kobo Daishi, the founder of Shingon Buddhism. Current research determines the Tantra holds a direct lineage to the Historical Buddha (563-480 B.C.E.).</p>
      <p>Dr. Usui went to Mt. Kurama Yama (a holy mountain in Japan) on a short retreat to contemplate this material, to review the miraculous healing from his illness and to discover why it was he who had received the Medicine Tantra. At the completion of his time on Kurama Yama he gained an understanding of these methods and received insight into these Buddhist practices. After much contemplation and careful consideration he decided to share these teachings with others. Through the distillation of years of study and practice, Usui was able to perceive a method for bringing the essence of these Buddhist practices to the masses. Usui called this healing method Rei Ki.</p>
      <p>Usui first practised his newly discovered method on his family and friends. Then he began to offer this healing method to the lower class district of Kyoto. Kyoto is a religious centre and the people in the streets are taken in and cared for, with each family looking after its own. Usui opened his home to many and for seven years he brought Reiki to them. This gave him the opportunity to perfect and refine his new healing method. Meanwhile, he continued to hold regular classes for his growing Ocircle¹ of Buddhist followers, and further developed and refined his system.</p>
      <p>In 1921, Usui moved to Tokyo where he worked as the secretary to Pei Gotoushin, the Prime Minister of Tokyo. He opened a Reiki clinic outside Tokyo, in Harajuku, and began to inaugurate classes and teach his system of Reiki. Some of his foremost students, who received the teachings, include:</p>
      <p>* Watanabe Kioshi Itami, his long time friend and student from Kyoto. It<br>
          was Watanabe who inherited all of Usui¹s notes and the collection of<br>
          Buddhist tantras when Usui died;<br>
          * Taketomi, who was a naval officer;<br>
          * Wanami;<br>
          * Five Buddhist nuns;<br>
          * Kozo Ogawa. Ogawa opened a Reiki clinic in Shizuoka City. He was very active in the administration of the Reiki society. He passed on his work to his relative, Fumio Ogawa, who is still alive today.<br>
          In 1922, Usui founded the Reiki society, called Usui Reiki Ryoho Gakkai, and acted as its first president. This society was open to those who had studied Usui¹s Reiki. This society still exists today and there have been six presidents since Usui:</p>
      <p>Mr. Jusaburo Ushida 1865-1935,<br>
          Mr. Kanichi Taketomi 1878-1960,<br>
          Mr. Yoshiharu Watanabe (? - 1960),<br>
          Mr. Hoichi Wanami 1883-1975,<br>
          Ms. Kimiko Koyama 1906-1999,<br>
          and the current president Mr. Masayoshi Kondo<br>
          This society started a new religion¹, or spiritual organisation, which was a common practice at this time in Japan.</p>
      <p>On September 1, 1923 the devastating Kanto earthquake struck Tokyo and surrounding areas. Most of the central part of Tokyo was levelled and totally destroyed by fire. Over 140,000 people were killed. In one instance, 40,000 people were incinerated when a fire tornado swept across an open area where they had sought safety. These fires were started because the quake hit at midday, when countless hibachi charcoal grills were ready to cook lunch. The wood houses quickly ignited as they collapsed from the tremors. Three million homes were destroyed leaving countless homeless and over 50,000 people suffered serious injuries. The public water and sewage systems were destroyed and it took years for rebuilding to take place.</p>
      <p>In response to this catastrophe, Usui and his students offered Reiki to countless victims. His clinic soon became too small to handle the throng of patients, so in February of 1924, he built a new clinic in Nakano, outside Tokyo. His fame spread quickly all over Japan and he began receiving invitations from all over the country to come and teach his healing methods</p>
      <p>Usui was awarded a Kun San To from the Emperor, which is a very important award (much like an honorary doctorate), given to those who have done honourable work. His fame soon spread throughout the region and many prominent healers and physicians began requesting teachings from him.</p>
      <p>Just prior to this devastating earthquake in 1923, Usui had begun teaching a simplified form of Reiki to the public in order to meet increasing demand. Usui saw that his method of healing had tremendous potential so out of compassion, to aid all sentient beings, he developed a non-religious Reiki form to suit everyone. This form is the foundation of what is now known as Western Reiki. Two of his most notable students included:</p>
      <p>* Toshihiro Eguchi, who studied with Usui in 1923. Eguchi was the most prominent of his students who reportedly taught thousands of students before the war. It is largely through Eguchi that Reiki has continued to flourish in Japan;</p>
      <p>* Chujiro Hayashi who studied with Usui from 1922. Hayashi was one of the first of Usui¹s non-Buddhist students. Hayashi was a Methodist Christian, had very strong beliefs, and was not open to the esoteric nature of what Usui was teaching. Usui eventually sent Hayashi on his way. Hayashi used the knowledge learned from Usui to open a clinic in Tokyo. He replaced some of the format of Usui¹s teachings and created a system of Odegrees¹. He also developed a more complex set of hand positions suitable for clinic use. Hayashi¹s clinic employed a method of healing that required several practitioners to work on one client at the same time to maximise the energy flow. Hayashi encouraged practitioners to his clinic by offering to give Level 1 empowerments in return for a three-month commitment as unpaid help. At the end of this stint he would offer the more accomplished students the second Level in return for a further nine-month commitment. Those who completed this had the chance of receiving the Master symbol or third degree. After two years further commitment (which involved assisting Hayashi in the classroom), practitioners were taught the empowerments and were allowed to teach. No money exchanged hands in this training ­ practitioners simply had to work an eight hour shift once a week for the duration of their commitment. Hayashi subsequently passed his knowledge to Mrs. Takata, who was responsible for bringing Reiki to America in the 1970s. It should be stressed that the actual content of the Reiki system known in the west today is but a fragment of Usui¹s actual Reiki system. Usui taught a simplified form of Reiki to Hayashi and in turn, Hayashi introduced new elements and structures to the Reiki system. Mrs. Takata further changed and added material to the system, so that when Reiki finally came to the West, the Usui system had altered quite significantly and bore little resemblance to its original roots.</p>
      <p>Usui quickly became very busy as requests for teachings of Reiki continued to grow. He travelled throughout Japan (not an easy undertaking in those days), to teach and give Reiki empowerments. This started to take its toll on his health and he began experiencing mini-strokes from stress. Knowing that his death was imminent, one day, while in his office in Tokyo, he gathered all of his documents and materials on Reiki. All his class notes, his diary and the collection of sacred Buddhist texts were placed in a large lacquered box. He gave this to Watanabe, whom he considered his foremost student and dearest friend. Usui then left for a teaching tour in the western part of Japan. Finally, on March 9, 1926, while in Fukuyama, Usui died of a fatal stroke. He was 62 years old.</p>
      <p>HawayoUsui¹s body was cremated and his ashes were placed in a temple in Tokyo. Shortly after his death, students from the Reiki society in Tokyo erected a memorial stone at Saihoji Temple in the Toyatama district in Tokyo. According to the inscription on his memorial stone, Usui taught Reiki to over 2,000 people. However, as written in Dr. Usui¹s personal notes, he clearly states that he had taught over 700 students. Perhaps the students who erected his memorial stone mentioned 2,000 to praise Dr. Usui¹s teaching efforts. Many of these students began their own clinics and founded Reiki schools and societies. By the 1940s there were about 40 Reiki schools spread all over Japan. Most of these schools taught the simplified method of Reiki that Usui had developed. Another more secret Reiki Society continued to maintain the esoteric tradition. These practitioners did not bring their work out to the public and upheld a deeply spiritual basis for their work. It is unlikely that many westerners have encountered this faction of the Reiki teachings in Japan.</p>
      <p>Hawayo Takata - features prominantly in Reiki history as the master who brought Reiki to the western world. She lived in Hawaii and before her death in the 1970's, had taught 22 Reiki masters. Most of the Reiki that we know and love in the western world comes through the Takata lineage.</p>
      <hr>
      <p>(no audio)</p>
      <p><strong>The Life of Dr Mikao Usui</strong><br>
          <br>
          Mikao Usui was born into a family that had been practising Zen Buddhism for eleven generations. As a youth Usui developed a fascination for all things Western. However, he never travelled outside Japan. After leaving school he went on to study allopathic medicine with several western allopathic physicians who had graduated from Yale and Harvard University.<br>
          When a cholera epidemic spread through Tokyo, Usui was struck down with the disease. During his hospitalisation as he was close to death he had a spiritual experience. This inspired Usui to study the ancient teachings of his ancestors. He joined a Zen monastery and began reading the ancient Sanskrit and Sutras.<br>
          After many years of study Usui found references to an ancient form of healing. Further study revealed methods, formulas and symbols that detailed exactly how to practice and master this art of hands on healing. However, although he had the technical knowledge to practise healing, he lacked the wisdom to turn the teachings into reality. He needed the key to turn on and activate the power. Usui decided to seek the final piece of the jigsaw through meditation.<br>
          <strong>Taking leave from the monastery, Usui set off for the holy mountain of Kurama. When he reached the top he picked up twenty-one pebbles and placed them in front of himself. He sat down and began his meditation. Each day he threw away one pebble. For twenty-one days he prayed, meditated, sang and read the Sutras.<br>
          On the last day as he prayed he ask God to show him the light. Suddenly, a bright light appeared in the sky and came rapidly towards him, hitting him on his forehead, at the third eye chakra. Usui was knocked unconscious, and whilst in this altered state he saw a vision of the same symbols he had earlier found in the Sutras.<br>
          This vision was the confirmation Dr. Usui needed. He now knew that he had found the keys to the ancient form of healing used by Buddha and Jesus. When Usui regained full consciousness, he proceeded to return down the mountain. On his descent, he stubbed and cut his toe, he instinctively placed his hand on the toe and the bleeding and pain stopped.<br>
          On arrival at a nearby village he stopped to eat and rest. He was able despite having fasted for 21 days; eat a healthy meal without any stomach pain. The girl who served Usui the meal was in great pain suffering from a toothache. Usui asked if he could place his hands on her swollen face, she agreed, and he was able to ease the swelling and the pain. Rested, Usui returned to the monastery. On Arrival he found his friend, the Abbot in bed suffering with severe arthritis. Once again Usui was able to alleviate the pain and suffering. Usui called this gift from God – Reiki, the Japanese word for universal life force.</strong><br>
          These experiences became known as the four miracles. Having demonstrated his knowledge and new ability to heal the Abbott advised Usui to take this special gift into the slums of Kyoto to heal the beggars. He was reminded that it is not enough to heal the body; it is of equal importance to heal the spirit and mind also. This lesson was brought home to him very abruptly seven years later. Having spent the time giving Reiki to beggars in the slums of Kyoto to get them working, he found them returning to him with the excuse that it was easier to beg.<br>
          Usui had forgotten a basic doctrine. Mortified he retreated to meditate once again. This time he was enlightened with the five principles of Reiki. The rest of Usui’s life was spent healing, teaching and developing the Usui Shiki Rhoyo method of healing. Usui had nineteen major students who were all either western allopathic or traditional Japanese in their practice. He knew he would have to develop a method that could be understood and accepted by any religion or culture. Reiki was fashioned by Usui to have no dogma or religious beliefs attached to it. This made Reiki universal.<br>
          Tenno, the Emperor of Japan honoured Usui’s work by awarding him a doctorate. By the time of his death in 1930, Dr Mikoa Usui had initiated all nineteen of his students to the level of Reiki Master/Teacher. <strong>Dr Chujiro Hayashi</strong> was chosen as the next Grand Master.<strong> It is important to note that Dr Usui taught all three degrees together.</strong> Dr Usui was cremated and his ashes placed in a Zen Monastery in Tokyo.<br>
hayashi.jpg<br>
Upon the death of Dr Usui, Hayashi took over the role of Grand Master. He was responsible for training a further sixteen Reiki Masters and creating a set formula for training.<br>
Chujiro Hayashi was born into an upper class Japanese family, and was a qualified physician and retired Marine commander.<br>
He set up a clinic near the Emperors palace in Tokyo called Shina No Macha. Each day his students held healing sessions at the clinic, or visited people in their homes in they were unable to travel.<br>
Hayashi went on to write many report on the systems he had developed to treat various ailments. Special diets were incorporated into his treatments to assist the healing process. Probably his greatest advancement for Reiki was to discover the importance of whole body treatment and how the universal life force would go wherever it was needed to heal. Providing of course you applied the full body treatment. This was needed to remove any emotional or physical blocks.<br>
takata.jpg<br>
Hawayo Kawamuru was born on the Island of Hawaii on 24th December 1900. At the age of seventeen she married Saichi Takata.<br>
They had a happy marriage with two daughters. Tragically, her husband died at the young age of thirty-two. After thirteen years of marriage Hawayo Takata was left to raise two small children on her own.<br>
The stress and pressure of the situation took toll on her health. Within five years of her husbands’ death she was diagnosed to be suffering from nervous exhaustion. Her health deteriorated to the point where she required surgery for a diseased gall bladder. However, she was also suffering from respiratory problems that meant the use of an anaesthetic during surgery could kill her.<br>
This was an extremely depressing and trying time in her life. Unfortunately there was more pain and suffering to come when her sister died. As her parents had returned to live in Tokyo, it was Hawayo Takata traditional responsibility to bring the news to them in person.<br>
After her arrival in Japan, she sought help at a hospital in Akasaka. It was discovered that she now had a tumour and appendicitis to add to her diseased gallbladder and respiratory problems. Her weight dropped dramatically and her doctor advised her to have immediate surgery.<br>
That night as she lay in bed she heard a voice saying, “The surgery is not necessary.” The next day as she was being prepared for surgery she heard the voice again saying, “The surgery was not necessary, ask - ask.” Takata asked the surgeon if there was another way she could be healed and he told her of the Reiki clinic run by Dr. Hayashi. The surgeon had a sister who had been there herself and had recovered fully from an illness.<br>
<strong>Madam Takata went to the clinic and received treatments regularly for four months and was completely healed.</strong> She decided that she also wanted to learn Reiki and set up her own practice in Hawaii. Against all tradition, she was eventually able to persuade Dr. Hayashi to allow her to work and train at the clinic for twelve months. At the end of this time it was felt that she had earned the <strong>privilege of receiving the second degree</strong> in Reiki – the advanced practitioners’ level.<br>
In the summer of 1937 Madam Takata returned to Hawaii and set up her own Reiki clinic. She spent her time healing and teaching Reiki. Dr Hayashi visited Madam Takata in February 1938 and invited her to become a Reiki Master. He said that she had gone through tests and had lived up to the Reiki Ideals and principles. She was the first woman and the first foreigner to be given this honour. Hayashi returned to Japan.<br>
At the beginning of 1940 Japan was close to war with America. Dr Hayashi was aware he would be called up to fight. As a man of healing and peace he decided the only honourable thing to do was to precipitate his transition. He put his affairs in order. Madam Takata woke up one morning and saw a vision of Dr Hayashi at the foot of her bed. She realised she must travel immediately to Japan. On arrival in Japan she met with Dr Hayashi and he explained his decision to leave this world. They spent many days planning the future.<br>
When Hayashi was satisfied he had safeguarded the future of Reiki he called all his students and friends together. At this point he declared Madam Takata his successor and the third Grand Master of Reiki. Dressed in traditional Japanese attire he lay down and allowed his spirit to leave his body. Madam Takata installed as the next Grand Master returned to Hawaii to continue her teaching and healing.<br>
This is when the history of Reiki was changed to portray Dr Mikao Usui as a Christian. Madam Takata realised that the American people and the Western world in general would hold certain bigotry towards the Japanese. So soon after the War it would be impossible to promote a method of healing with its roots firmly in Buddhism and Japan.<br>
<strong>Madam Takata went on to train a further twenty two Reiki Masters before her death in December 1980.</strong> There were two Grand Masters installed to continue Takata’s work. Phyllis Lei Furumoto, the granddaughter of Madam Takata and Dr Barbara Weber. This partnership was to run for only a year until for personal reasons they split up to continue the work separately.<br>
<br>
The Reiki Alliance was formed by Phyllis Lei Furumoto, while Dr Weber set up the A.I.R.A. (The American International Reiki Association).<br>
Unfortunately, like many special things in this world the human ego has taken hold. There are now several different associations throughout the world all fighting amongst each other; each claiming to have the only correct way of teaching Reiki.<br>
There is even a system of Reiki now being taught in eleven degrees. The latest rumours of an application to Copyright © Reiki seem to show how far this wonderful gift from God can be tainted.<br>
There is only one Reiki. No-one has the right to claim it as their own, it belongs to humanity and the universe. Our only wish for the future of Reiki is that instead of fighting and bickering everyone involved with Reiki can again come together in the true spirit of healing.<br>
Let’s share our experiences and skills so Reiki can be accepted universally as a natural treatment for the mind body and spirit. We need to work together to promote this cause. It is vital in our increasingly harsh and violent world that we change the whole psyche of humanity.<br>
Together we can bring this gift of healing to the world. We need Reiki practised and used in every hospital and clinic in the world. Let’s spread the word positively. Let’s make a difference. Let’s make Dr Usui, Dr Hayashi and Madam Takata Proud. Let’s honour their work and their memory. Let’s live and internalise the Reiki Principles. </p>
      <div>
		<a href="how-reiki-works.php" class="btn btn-primary">Previous</a>
		<a href="seven-chakras.php" class="btn btn-primary">Next</a>
		</div>
      <p>&nbsp;</p>
  </div>
<!-- InstanceEndEditable -->
</div>

  </div>
</div>
</body>
<!-- InstanceEnd --></html>
