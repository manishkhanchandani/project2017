<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once('../init.php');

$defendant = (!empty($_GET['defendant'])) ? $_GET['defendant'] : 'Contractor';
$plaintiff = (!empty($_GET['plaintiff'])) ? $_GET['plaintiff'] : 'Pam';
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/babybarV2.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="UTF-8">
<meta name="theme-color" content="#000000">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/dashboard.css">
<link rel="stylesheet" href="<?php echo HTTP_PATH; ?>css/NavMulti.css">

<script src="<?php echo HTTP_PATH; ?>js/jquery.min.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/bootstrap.min.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-auth.js"></script>
<script src="<?php echo HTTP_PATH; ?>js/firebase/5.2.0/firebase-database.js"></script>

<link href="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.css" rel="stylesheet">
<script src="<?php echo HTTP_PATH; ?>library/wysiwyg/summernote.js"></script>
<?php include('../head.php'); ?>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.content {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
<!-- InstanceEndEditable -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<?php include('../NavMulti.php'); ?>
<div class="container-fluid">
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="row content">
	<div class="col-sm-3 col-md-2 sidebar">
	    <p>Fill in the blanks	  </p>
	    <form name="form1" method="get" action="">
	        <strong>Defendant:</strong><br> 
	   
	        <input name="defendant" type="text" id="defendant" value="<?php echo $defendant; ?>">
	
                <p><strong>Plaintiff:</strong><br> 
                    <input name="plaintiff" type="text" id="plaintiff" value="<?php echo $plaintiff; ?>">
                </p>
                <p>
                    <label>
                    <input type="submit" name="Submit" value="Submit">
                    </label>
                </p>
	    </form>
	    <p>&nbsp;</p>
	    <p>&nbsp;      </p>
	</div>
    
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h1 class="page-header">Strict Liability (Part 1)</h1>
	
		<div class="row">
			<div class="col-md-12 ">
			
		    <p>The facts of the question are designed to steer applicants awayfrom discussion of negligence, nuisance, or trespass to land and toward discussion of <strong>strict liability</strong> in tort for <strong>abnormally dangerous activity</strong> (as denominated by the Restatement (Second) of Torts) or ultrahazardous activity (the term used by the original Restatement of Torts) by declaring that Contractor, the only defendant referred to in the interrogatory, &quot;exercised reasonable care in all relevant respects.&quot; The question limits applicants to discussion of <i><?php echo $plaintiff; ?>'s</i> right to recover compensatory damages from <i><?php echo $defendant; ?></i>, thereby eliminating the need to discuss punitive damages or the rights or liabilities of the owner of the lot adjoining <i><?php echo $plaintiff; ?>'s</i> home.</p>
		    <p>The American Law Institute has restated the doctrine of strict liability in tort for abnormally dangerous activity in $5 519-524A of the Restatement (Second) of Torts (1977). It appears that Colorado common law (1) recognizes the doctrine of strict liability in tort for abnormally dangerous or ultrahazardous activity;</p>
		    <p>(2) might well apply the criteria of Restatement (Second) of Torts $ 520 for determining whether an activity is abnormally dangerous or ultrahazardous;</p>
		    <p>and (3) would likely hold Contractor strictly liable for blasting damage on these facts,</p>
		    <p><strong>II. Elements of the Prima Facie Case</strong></p>
		    <p>Plaintiff must establish duty and proximate cause, and thus foreseeability, to prevail on a claim of strict liability for abnormally dangerous or ultrahazardous activities. As contrasted with negligence, the duty owed is an absolute duty to make safe the abnormally dangerous condition, and liability is imposed for any injuries to persons or property resulting therefrom. <br>
		        Courts generally impose three requirements in finding an activity to be ultrahazardous:<br>
		        1. The activity must involve a risk of serous harm to persons or property;<br>
		        2. The activity must be one that cannot be performed without risk of serious harm no matter how much care is taken; and<br>
		        3. The activity must not be a commonly engaged-in activity by persons in the community.</p>
		    <p>The Restatement (Second) of Torts, which takes an approach followed by a minority of courts, additionally takes into accounts the value of the activity and its appropriateness to the location, declaring that, in determining whether an activity is abnormally dangerous, the following factors are considered:<br>
		        (a) existence of a high degree of risk of some harm to the person, land or chattels of others;<br>
		        (b) likelihood that the harm that results fiom it will be great;<br>
		        (c) inability to eliminate the risk by the exercise of reasonable care;<br>
		        (d) extent to which the activity is not a matter of common usage;<br>
		        (e) inappropriateness of the activity to the place where it is carried on; and<br>
		        (f) extent to which its value to the community is outweighed by its dangerous attributes.</p>
		    <p><strong>Restatement (Second) of Torts.</strong></p>
		    <p><br>
		        The American Law Institute notes that &quot;[iln determining whether the danger abnormal, the fictors listed in Clauses (a) to (f) of this Section are all to be considered, and are all of importance&quot; and that &quot;[a]ny one of them is not necessarily sufficient of itself in a particular case, and ordinarily several of them will be  required for strict liability.&quot;</p>
		    <p>An accurate and responsive applicant answer might plausibly make a good argument that each of the six factors cuts in hvor of Pam, the plaintiffclient, as follows:</p>
			<p>1. blasting in a residential suburb involves a high degree of risk of some harm to the person or property of others;</p>
			<p>2. it is likely that any harm which results from such blasting will be great, as there are many expensive homes in the area;</p>
			<p>3. as the present hcts demonstrate, the exercise of reasonable care in blasting does not eliminate the risk;</p>
			<p>4. blasting is not a matter of common usage because few people engage in that activity;</p>
			<p>5. blasting in a residential suburb is inappropriate to the place where it is canied on;</p>
			<p>6. the value of such blasting is outweighed by its dangerous attributes.</p>
			<p>In most states, including Colorado, the duty is owed only to &quot;foreseeable plaintiff,&quot; that is, persons to whom a reasonable person would have forseen a risk of harm under the circumstances. The Restatement suggests that two types of persons are disqualified from using strict liability in tort for an abnormally dangerous activity: (1) &quot;one who intentionally or negligently trespasses on land for harm done to him by an abnormally dangerous activity that the possessor carries on upon the land,&quot; Restatement (Second) of Torts 5 520B (1977) and (2) one who is harmed because he or she is canying on an &quot;abnormally sensitive&quot; activity, id., 1 524A. Pam Mls under neither category and is thus a proper plaintiff in the sense that she is entitled to use the theory of strict liability in tort for abnormally dangerous activity. </p>
			<p>The Restatement provides that &quot;[o]ne who carries on an abnormally dangerous activity is subject to liability for harm to the person, land or chattels of another resultingfrom the activity.&quot;</p>
			<p>Pam must thus establish a cause-in-fict relationship between Contractor's blasting and the structural harm to her home, which clearly exists under the ficts because &quot;an unexpectedly-strong concussion from detonation by Contractor of the explosives on the adjoining lot caused serious structural harm to Panlts home.&quot;</p>
			<p>Though Restatement (Second) $ 5 19 imposes strict liability, that strict liability &quot;is limited to the kind of harm, the possibility of which makes the activity abnormally dangerous.&quot; Id, $5 19(2). This proximate cause requirement is easily satisfied because Pam, a nextdoor-neighbor, suffered concussion damage to her property, which is probably the primary or most likely kind of harm, the possibility of which makes blasting in a residential suburb abnormally dangerous.</p>
			<p> The Restatement (Second) permits recovery for &quot;harm to the person, land or chattels of another,&quot; id., $5 19(1), which clearly reaches the &quot;serious structural harm to Pam's home.&quot; The harm must result from the kind of danger to be anticipated from the abnormally dangerous activity, that is, it must flow from the &quot;normally dangerous propensity&quot; of the condition or thing involved. In other words, strict liability has been confined to the consequences which lie within the extraordinary risk whose existence calls for such special responsibility. Walcott v. Total Petroleum, Inc., supra.</p>
			<p>&nbsp;</p>
			</div>
		</div>
	
	</div>
</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
