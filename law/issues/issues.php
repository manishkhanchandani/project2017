<?php require_once('../../Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO qz_template_issues (subject, issue, reference, hypo, solution) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['issue'], "text"),
                       GetSQLValueString($_POST['reference'], "text"),
                       GetSQLValueString($_POST['hypo'], "text"),
                       GetSQLValueString($_POST['solution'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "issues.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

ob_start();
include('../../functions.php');

$issuesContracts = array(
	'formation_of_contracts' => array(
		'title' => 'Formation of Contrats',
		'data' => array(
			'contract_intro' => array(
				'title' => 'Contracts Intro'
			),
			'is_ucc' => array(
				'title' => 'Is UCC?',
				'elements' => array(
					'sale of goods, movable things',
					'otherwise CL'
				)
			),
			'parties_merchant' => array(
				'title' => 'Are parties Merchant?',
				'elements' => array(
					'person who trades in or holds himself out',
					'by occupation or by knowledgeable about goods'
				)
			),
			'offer' => array(
				'title' => 'Offer',
				'elements' => array(
					'manifestion of present contractual intent',
					'communicated to offeree',
					'with definite terms',
					'objective person would believe that assent would form a bargain',
					'At Common Law:',
					'Terms required are Q-tips',
					'At UCC:',
					'Terms required are parties and quanity, rest are assumed by Gap Fillers'
				)
			),
			'mutual_assent' => array(
				'title' => 'Mutual Assent',
				'elements' => array(
					'offer posed by offeror',
					'accepted by offeree'
				
				)
			),
			'merchants_firm_offer' => array(
				'title' => 'Merchant\'s Firm Offer',
				'elements' => array(
					'ucc 2-205',
					'offer by merchant',
					'promise to leave offer open',
					'for stated period or reasonable period',
					'in writing',
					'cannot be revoked by offeror',
					'offeree can accept even offeror has revoked the offer'
				)
			),
			'unilateral_contract' => array(
				'title' => 'Unilateral Contract',
				'elements' => array(
					'offer that unequivocally indicated',
					'acceptance by completion of performance by offeree'
				)
			),
			'acceptance' => array(
				'title' => 'Acceptance',
				'elements' => array(
					'For Common law:',
					'under mirror image rule',
					'acceptance is unequivocal assent to an offer',
					'For UCC:',
					'under ucc 2-206',
					'not otherwise expressly conditioned',
					'in any reasonably manner',
					'including a promise to ship or shipment of confirming or non-conforming goods',
					'shipment of non-conforming goods as an express accomodation is not an acceptance',
					'ucc 2-207, allows acceptances with varying terms'
				)
			),
			'consideration' => array(
				'title' => 'Consideration',
				'elements' => array(
					'exchange of promises',
					'posing legal detriment'
				)
			),
			'varying_terms' => array(
				'title' => 'Varying Terms',
				'elements' => array(
					'ucc 2-207 talks about acceptance with varying terms',
					'contracts between merchants',
					'offer did not expressly require acceptance based on varying terms',
					'offeror does not object within reasonable time or 10 days',
					'varying terms are not material alteration of offer terms'
				)
			),
			'offer_lapsed' => array(
				'title' => 'Offer Lapsed',
				'elements' => array(
					'offer lapse in reasonable period of time',
					'cannot be accepted if it lapses'
				)
			),
			'effective_acceptance' => array(
				'title' => 'Effective Acceptance',
				'elements' => array(
					'acceptance effective when dispatched',
					'dispatched in manner specified in offer',
					'or same or faster means if not specified'
				)
			),
			'rejection' => array(
				'title' => 'Rejection',
				'elements' => array(
				
				)
			),
			'effective_rejection' => array(
				'title' => 'Effective Rejection',
				'elements' => array(
				
				)
			),
			'revocation' => array(
				'title' => 'Revocation',
				'elements' => array(
				
				)
			),
			'effective_revocation' => array(
				'title' => 'Effective Revocation',
				'elements' => array(
				
				)
			),
			'implied_in_fact' => array(
				'title' => 'Implied In Fact',
				'elements' => array(
				
				)
			),
			'writing_needed' => array(
				'title' => 'Is Writing Needed (SOF)',
				'elements' => array(
				
				)
			)
			
		)
	),
	'defenses' => array(
		'title' => 'Formation of Contrats',
		'data' => array(
		
		)	
	),
	'contract_terms' => array(
		'title' => 'Contract Terms',
		'data' => array(
		
		)	
	),
	'third_party' => array(
		'title' => 'Third Party Contract',
		'data' => array(
		
		)	
	),
	'breach' => array(
		'title' => 'Breach',
		'data' => array(
		
		)	
	),
	'remedies' => array(
		'title' => 'Remedies',
		'data' => array(
		
		)	
	
	),
);
$issuesCriminal = array(
	'inchoate_crime' => array(
		'title' => 'Inchoate Crime',
		'data' => array(
			'attempt' => array(
				'title' => 'Attempt',
				'elements' => array(
					'intent',
					'substantial step'
				)
			),
			'solicitation' => array(
				'title' => 'Solicitation'
			),
			'conspiracy' => array(
				'title' => 'Conspiracy',
				'elements' => array(
					'agreement between 2 or more people',
					'to work towards an illegal goal',
					'overt act is reqd.'
				)
			)
		)
	),
	'crime_against_home' => array(
		'title' => 'Crime Against Home',
		'data' => array(
			'arson' => array(
				'title' => 'Arson',
				'elements' => array(
					'common law arson: ',
					'malicious burning',
					'dwelling of another',
					'malice means wrongful intent',
					'modern law arson: ',
					'of any structure'
					
				)
			),
			'burglary' => array(
				'title' => 'Burglary'
			)
		)
	)
);
$issuesTorts = array(
	'intentional' => array(
		'title' => 'Intentional Torts',
		'data' => array(
			'intentional' => array(
				'title' => 'Intentional'
			),
			'assault' => array(
				'title' => 'Assault',
				'elements' => array(
					'intentional',
					'immediate apprehension',
					'of harmful or offensive touch'
				)
			),
			'battery' => array(
				'title' => 'Battery',
				'elements' => array(
					'intentional',
					'touching of person',
					'harm or offense to a person'
				)
			),
			'conversion' => array(
				'title' => 'Conversion',
				'elements' => array(
					'intentional',
					'interference with chattel',
					'substantial deprivation of possession'
				)
			),
			'false_imprisonment' => array(
				'title' => 'False Imprisonment',
				'elements' => array(
					'intentional',
					'confined to a defined area',
					'no means of escape',
					'P knows they are confined'
				)
			),
			'iied' => array(
				'title' => 'Intentional Infliction of Emotional Distress',
				'elements' => array(
					'intentional',
					'outrageous act',
					'causing severe emotional distress'
				)
			),
			'trespass_to_land' => array(
				'title' => 'Trespass to Land',
				'elements' => array(
					'intentional',
					'unauthorized entry',
					'onto, over, under land of another'
				)
			),
			'trespass_to_chattels' => array(
				'title' => 'Trespass to Chattels',
				'elements' => array(
					'intentional',
					'interference or damage to chattel of another'
				)
			),
			'transferred_intent' => array(
				'title' => 'Transferred Intent',
				'elements' => array(
					'commits intentional tort to one person',
					'liable for injury inflicted to everybody'
				)
			),
			'tort_damages' => array(
				'title' => 'Damages for Torts',
				'elements' => array(
					'special damages like monetory loss',
					'general damages like pain, suffering, anxiety, emotional distress',
					'punitive damage for intentional tort and gross negligence and recklessness',
					'P can waive and ask for restitution'
				)
			)
		)
	),
	'torts_defenses' => array(
		'title' => 'Torts Defenses',
		'data' => array(
			'torts_self_defense' => array(
				'title' => 'Self Defense',
				'elements' => array(
					'reasonable force',
					'person who is not an aggressor',
					'to protect their own safety'
				)
			),
			'torts_defense_of_necessity' => array(
				'title' => 'Defense of Necessity',
				'elements' => array(
					'reasonable force',
					'as necessary',
					'to protect self, protect others or protect property'
				)
			),
			'torts_defense_of_recapture' => array(
				'title' => 'Defense of Recapture',
				'elements' => array(
					'reasonable force',
					'they have asked for and refused',
					'fresh pursuit',
					'lost possession with no fault of their own'
				)
			),
			'torts_defense_of_discipline' => array(
				'title' => 'Defense of Discipline',
				'elements' => array(
					'positon of authority',
					'enforcing discipline or order'
				)
			),
			'torts_defense_of_authority_of_law' => array(
				'title' => 'Defense of Authority of Law',
				'elements' => array(
					'reasonable force',
					'prevent or stop felony or disturbance of peace',
					'in presence of them'
				)
			),
			'torts_defense_of_consent' => array(
				'title' => 'Defense of Consent',
				'elements' => array(
					'fully informed consent',
					'person with legal capacity',
					'not for battery'
				)
			),
			'torts_defense_of_property' => array(
				'title' => 'Defense of Property',
				'elements' => array(
					'reasonable force',
					'to protect the property',
					'Shopkeeper rule:',
					'reasonable force',
					'detain a plaintiff',
					'reasonable period of time',
					'reasonable suspicion about stolen goods on plaintiff'
				)
			),
			'torts_defense_of_others' => array(
				'title' => 'Defense of Others',
				'elements' => array(
					'reasonable force',
					'to defend others',
					'who are not aggressors'
				)
			),
			'torts_defense_of_infancy_insanity' => array(
				'title' => 'Defense of Insanity / Infancy',
				'elements' => array(
					'no defense'
				)
			)
		)
	),
	'negligence' => array(
		'title' => 'Negligence',
		'data' => array(
			'negligence' => array(
				'title' => 'Negligence',
				'elements' => array(
					'failure to exercise',
					'degree of care',
					'that reasonable prudent person would do in same situation',
					'to prevail, P has to prove duty, breach, causation and damages'
				)
			),
			'negligence_duty' => array(
				'title' => 'Duty',
				'elements' => array(
					'no duty to act to defend others',
					'duty arise in 5 situaitons',
					'SCRAP',
					'statute',
					'contract',
					'relationship',
					'assumption',
					'peril'
				)
			),
			'negligence_per_se' => array(
				'title' => 'Negligence Per Se',
				'elements' => array(
					'duty created by statute',
					'voilation of statute is breach',
					'purpose of statute is',
					'to protect the class of people to which plaintiff belongs',
					'preventing type of injury that plaintiff suffered'
				)
			),
			'negligence_duty_peril' => array(
				'title' => 'Duty based on PERIL',
				'elements' => array(
					'Peril Duty:',
					'D who creates foreseeable dangers to others',
					'have duty to act reasonably',
					'to protect others from those dangers',
					'Cardoza View: ',
					'D who create peril do not have duty outside zone of danger',
					'Zone of Danger: ',
					'is area with which D\'s actions created peril',
					'Andrews view: ',
					'D who create peril is liable to anyone actually and proximately got injured, even if outside zone of danger'
				)
			),
			'negligence_duty_premises' => array(
				'title' => 'Duty based on Premises Liability',
				'elements' => array(
					'occupier of land has duty who come to land and off the land',
					'this duty is based on relationship',
					'no duty to unknown trespassers',
					'Warn and protect licensees / known trespassers from known hidden dangers and artificial conditions',
					'note: licencees are people who come not for occupiers benefit',
					'Inspect land, warn and protect Invitees from known hidden dangers and artificial conditions',
					'note: invitees are people who come for occupiers benefit',
					'occupier has duty to conduct and control activities with due care to prevent injury to people off the land' 
				)
			),
			'negligence_attractive_nuisance' => array(
				'title' => 'Attractive Nuisance',
				'elements' => array(
					'occupier of land who knows',
					'children have or may in future trespass to land',
					'has strict duty to inspect and eliminate any condition posing dangers',
					'that children might not fully appreciate'
				)
			),
			'strict_liability' => array(
				'title' => 'Strict Liability',
				'elements' => array(
					'D engages in 3 types of activities',
					'- known, dangerous animal',
					'- exotic animal (not commonly domesticated)',
					'- ultra hazardous activities that pose extreme risk to others',
					'duty is presmed in above cases, and injury is breach of that duty'
				)
			),
			'negligence_rescuer_doctrine' => array(
				'title' => 'Rescuer Doctrine / Fireman\'s Rule',
				'elements' => array(
					'D who creates perilious situation',
					'is liable to rescuer\'s injury',
					'exception is for fireman if they get injured in rescue'
				)
			),
			'respondent_superior' => array(
				'title' => 'Respondent Superior',
				'elements' => array(
					'employer is vicariously liable for employee',
					'tort committed within scope of employment'
				)
			),
			'vicarious_liability' => array(
				'title' => 'Vicarious Liability for Joint Enterprise',
				'elements' => array(
					'each member of j. enterprise is vicariously liable',
					'tort committed by other member',
					'within the scope of enterprise relationship',
					'each member share equal benefit in joint enterprise'
				)
			),
			'independent_contractor_liability' => array(
				'title' => 'Vicarious Liability for Independent Contractor',
				'elements' => array(
					'D who hires Independent Contractor to perform non-delegable duties',
					'is not VICARIOUSLY LIABLE for tors committed by contractor',
					'they can liable for negligent selection or negligent entrustment'
				)
			),
			'negligence_breach' => array(
				'title' => 'Breach',
				'elements' => array(
					'D did not exercise DEGREE of CARE',
					'that a reasonable person would do in same circumstances',
					'Standard of care is the level of care based on experience and profession'
				)
			),
			'negligence_breach_res_ipsa_loquitur' => array(
				'title' => 'Breach Res Ipsa Loquitor',
				'elements' => array(
					'negligence by someone (facts)',
					'defendant had control on events',
					'plaintiff had no control on events'
				)
			),
			'negligence_breach_negligent_entrustment' => array(
				'title' => 'Breach Based on Negligent Entrustment',
				'elements' => array(
					'negligently entrust',
					'with resources or authority',
					'directly liable for injuries'
				)
			),
			'negligence_actual_cause' => array(
				'title' => 'Actual Cause',
				'elements' => array(
					'no injury but for acts of defendant',
					'or, 2 or more people negligent',
					'no injury if no one has acted',
					'cannot prove who\'s act causes injury',
					'each is substantial factor in injury'
				)
			),
			'negligence_proximate_cause' => array(
				'title' => 'Proximate Cause',
				'elements' => array(
					'injury by plaintiff is',
					'so direct, natural, foreseeable',
					'close in time and place',
					'from chain of causation by D\'s act',
					'unbroken by unforeseeable intervening events',
					'law will impose liablity'
				)
			),
			'negligence_egg_shell_plaintiff' => array(
				'title' => 'Egg Shell Plaintiff',
				'elements'  => array(
					'D is negligent and causes injury to P',
					'pre-existing condition in P',
					'P is vulunerable to injury',
					'D is liable for the injury'
				)
			),
			'negligence_general_damages' => array(
				'title' => 'General Damages',
				'elements' => array(
					'pain and suffering'
				)
			),
			'negligence_special_damages' => array(
				'title' => 'Special Damages',
				'elements' => array(
					'out-of-pocket costs'
				)
			),
			'negligence_contributory' => array(
				'title' => 'Contributory Negligence',
				'elements' => array(
					'P acted negligently',
					'P helped to cause the accident',
					'P is contributory negligent and bar to recovery'
				)
			),
			'negligence_last_clear_chance' => array(
				'title' => 'Last Clear Chance',
				'elements' => array(
					'D has last clear opportunity to avoid the accident'
				)
			),
			'negligence_comparative' => array(
				'title' => 'Comparative Negligence',
				'elements' => array(
					'P negligent to certain percentage',
					'P is bar to reccovery to reduced amt based on % of negligence'
				)
			),
			'negligence_assumption_of_risks' => array(
				'title' => 'Assumption of Risks',
				'elements' => array(
					'P deliberately puts themselves at risk',
					'with full awareness of risks',
					'a conscious acceptance of the risks'
				)
			),
			'negligence_nied' => array(
				'title' => 'NIED',
				'elements' => array(
					'bystander',
					'emotional distress',
					'nexus between the negligent act and injury based on proximity in time, place, relationship' 
				)
			)
		)
	),
	'products_liability' => array(
		'title' => 'Products Liability',
		'data' => array(
			'products_liability' => array(
				'title' => 'Products Liability',
				'elements' => array(
					'Products Liability: ',
					'person places unreasonably dangerous product',
					'into the stream of commerce',
					'liable for all injuries it causes',
					'5 Theories:',
					'Intentional', 
					'Breach of Express Warranty',
					'Breach of Implied warranty',
					'Negligence',
					'Strict Liability',
					'Unreasonably Dangerous Product:',
					'poses serious or likely dangers',
					'could be reduced or eliminated easily',
					'without damaging product utility',
					'else product utility does not justify the dangers posed',
					'Defect Types:',
					'design defect, product as designed but creates unreasonable dangers',
					'manufacturing defect, product different from the rest due to assembly, materials, or parts',
					'warning defect, dangers not apparent to customers'  
				)
			),
			'pl_intentional' => array(
				'title' => 'Products Liability Intentional',
				'elements' => array(
					'manufacturer, distributor, or supplier',
					'knew the product would cause harm'
				)
			),
			'pl_breach_exp_warranty' => array(
				'title' => 'Breach of Express Warranty',
				'elements' => array(
					'Product is sold with express representations',
					'Buyer relies on it',
					'Representations are incorrect',
					'Buyer is injured'
				)
			),
			'pl_breach_imp_warranty' => array(
				'title' => 'Breach of Implied Warranty',
				'elements' => array(
					'Product is unsafe',
					'For ordinary or known intended use',
					'Buyer relies on it',
					'Buyer is injured'
				)
			),
			'pl_negligence' => array(
				'title' => 'Negligence',
				'elements' => array(
					'Defendant has duty',
					'Not to place unreasonably dangerous goods',
					'Into the stream of commerce',
					'Plaintiff is foreseeable',
					'Proximately caused injury by negligent acts of defendant'
				)
			),
			'pl_strict_liability' => array(
				'title' => 'Strict Liability in Tort',
				'elements' => array(
					'Seller was commercial supplier',
					'Product was unreasonably dangerous when it left defendant\'s control',
					'Buyer is injured',
					'Only non economic damages'
				)
			),
		)
	),
	'defamation' => array(
		'title' => 'Defamation',
		'data' => array(
			'defamation' => array(
				'title' => 'Defamation',
				'elements' => array(
					'Defamation: ',
					'False statement of material fact',
					'Published to others about the plaintiff',
					'Causing damage to reputation',
					'Slander or Libel: ',
					'Slander, an oral statement',
					'Libel, a written statement',
					'Privileges: ',
					'Many false statements are privilged',
					'To defend private interest, group interest or public interest',
					'Does so without malice',
					'In a reasonable manner',
					'Calculated to defend that interest',
					'Without unnecessary harming the plaintiff',
					'Per Se:',
					'Injury to reputation is presumed',
					'Where there is Libel per se or Slander per se',
					'Slander per se is found where false statement alleges',
					'CLUB - Criminal behavior, Loathsome disease, Unchaste behavior, improper Business practices (Club)',
					'New York vs Progeny:',
					'Under New York Times and its progeny',
					'a Public figure plaintiff must prove actual malice',
					'that false statement was made with knowledge or reckless disregard of its falseness',
					'in order to recover in a defamation action',
					'Public Figure:',
					'A public figure is a person',
					'Who has acted to put themselves',
					'In a public spotlight',
					'Public Concern: ',
					'Where a matter of Public concern is at issue',
					'Or where plaintiff seeks punitive damages',
					'Plaintiff must at least prove Negligence'
				)
			)
		)
	),
	'invasion_of_privacy' => array(
		'title' => 'Invasion of Privacy',
		'data' => array(
			'false_light' => array(
				'title' => 'False Light',
				'elements' => array(
					'published false portrayal',
					'that causes embarrassment or inconvenience'
				)
			),
			'appropriation_of_likeness' => array(
				'title' => 'Appropriation of Likeness',
				'elements' => array(
					'unauthorized use',
					'of name and likeness',
					'that implies endorsement of a product',
					'but not mere publication of names and photos'
				)
			),
			'intrusion_into_solitude' => array(
				'title' => 'Intrusion Into Solitude',
				'elements' => array(
					'unreasonable intrusion',
					'into peace and solitude of plaintiff'
				)
			),
			'public_disclosure_private_facts' => array(
				'title' => 'Public Disclosure of Private Facts',
				'elements' => array(
					'unreasonable public disclosure',
					'of private facts',
					'reasonable person would find it embarrassing'
				)
			)
		)
	),
	'nuisance' => array(
		'title' => 'Nuisance',
		'data' => array(
			'private_nuisance' => array(
				'title' => 'Private Nuisance',
				'elements' => array(
					'unreasonable interference',
					'with person\'s use and enjoyment',
					'of their own land'
				)
			),
			'public_nuisance' => array(
				'title' => 'Public Nuisance',
				'elements' => array(
					'unreasonable interference',
					'with person\'s use and enjoyment',
					'of public resources'
				)
			)
		)
	),
	'misc' => array(
		'title' => 'Miscellaneous',
		'data' => array(
			'abuse_of_process' => array(
				'title' => 'Abuse of Process',
				'elements' => array(
					'person brings civil or criminal action',
					'with no legitimate basis',
					'out of malice or for an improper purpose'
				)
			),
			'illegal_interference' => array(
				'title' => 'Illegal Interference',
				'elements' => array(
					'unreasonably interfering',
					'with another persons business relationship'
				)
			),
			'malicious_prosecution' => array(
				'title' => 'Malicious Prosecution',
				'elements' => array(
					'instituted criminal prosecution',
					'out of malice',
					'action was terminated',
					'because of no probable cause'
				)
			),
			'deciet' => array(
				'title' => 'Fraud',
				'elements' => array(
					'false statement of material facts',
					'knowing it was false',
					'intent to deceive',
					'reasonably relied by P',
					'causing P injury'
				)
			),
			'nondisclosure' => array(
				'title' => 'Nondisclosure',
				'elements' => array(
					'duty to disclose material facts',
					'breach of duty',
					'reasonably reliance',
					'injury caused'
				)
			),
			'tort_restitution' => array(
				'title' => 'Tort Restitution',
				'elements' => array(
					'P can waive the tort',
					'and can seek legal restitution',
					'to prevent unjust enrichment'
				)
			)
		)
	)
);
$subjects = array(
	'torts' => array(
		'title' => 'Torts',
		'issues' => $issuesTorts
	),
	'contracts' => array(
		'title' => 'Contracts',
		'issues' => $issuesContracts
	),
	'criminal' => array(
		'title' => 'Criminal',
		'issues' => $issuesCriminal
	)
);

$rules = array();
if (!empty($_POST['MM_Insert1']) && !empty($_POST['issues'])) {
	foreach ($_POST['issues'] as $sub => $subDetails) {
		foreach ($subDetails as $k1 => $v1) {
			foreach ($v1 as $k => $v) {
				if (file_exists('./rules/'.$k.'.php')) {
					$obj = $subjects[$sub]['issues'][$k1]['data'][$k];
					$obj['k1'] = $k1;
					$obj['k'] = $k;
					$obj['sub'] = $sub;
					//getting the rules
					ob_start();
					$tmp = include('./rules/'.$k.'.php');
					$obj['rule'] = ob_get_clean();
					//end getting rules
					array_push($rules, $obj);
				}
			}
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Template Issues</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function flevToggleCheckboxes() { // v1.1
	// Copyright 2002, Marja Ribbers-de Vroed, FlevOOware (www.flevooware.nl/dreamweaver/)
	var sF = arguments[0], bT = arguments[1], bC = arguments[2], oF = MM_findObj(sF);
    for (var i=0; i<oF.length; i++) {
		if (oF[i].type == "checkbox") {if (bT) {oF[i].checked = !oF[i].checked;} else {oF[i].checked = bC;}}} 
}
//-->
</script>

<style type="text/css">
body {
	font-family: verdana;
    font-size: 12px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
}
.checkbox ol {
	list-style-position: inside;
}

.left-column {
	box-shadow: 0px 3px 5px 6px #ccc;
	padding-top: 15px;
}
li.active {
	font-weight: bold;
}
</style>
</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>First Year</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5 left-column">
			<a href="issues.php">Refresh Current Page</a>
			<?php if (!empty($_GET['addIssue'])) { ?>
            <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
				<h3>Add New Issue Reference</h3>
                <table>
                    <tr valign="baseline">
                        <td nowrap align="right">Subject:</td>
                        <td><input type="text" name="subject" value="<?php echo !empty($_GET['subject']) ? $_GET['subject']: ''; ?>" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Issue:</td>
                        <td><input type="text" name="issue" value="<?php echo !empty($_GET['issue']) ? $_GET['issue']: ''; ?>" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Reference:</td>
                        <td><input type="text" name="reference" value="" size="32"></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Hypo:</td>
                        <td><textarea name="hypo" cols="50" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Solution:</td>
                        <td><textarea name="solution" cols="50" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td><input type="submit" value="Insert record"></td>
                    </tr>
                </table>
                <input type="hidden" name="MM_insert" value="form2">
            </form>
            <?php } ?>
            <hr />
			<p><a href="#" onclick="flevToggleCheckboxes('form1',true,false)">Toggle Check Box</a></p> 
			<form id="form1" name="form1" method="post" action="">
			<?php foreach ($subjects as $sub => $subDetails) { 
				$issues = $subDetails['issues'];
			?>
					<h3 class="text-center"><?php echo $subDetails['title']; ?> Issues</h3>
					<?php
					foreach ($issues as $k1 => $v1) { 
					?>
					<p><b><?php echo $v1['title']; ?></b></p>
					<div style="text-indent: 20px;">
					<?php foreach ($v1['data'] as $k => $v) { ?>
					<div class="checkbox" >
						<label>
						  <input type="checkbox" class="chkbtn" ref="elements_<?php echo $k1; ?>_<?php echo $k; ?>" name="issues[<?php echo $sub; ?>][<?php echo $k1; ?>][<?php echo $k; ?>]" value="1" <?php if (!empty($_POST['issues'][$sub][$k1][$k])) { ?>checked<?php } ?> id="issue_<?php echo $k1; ?>_<?php echo $k; ?>" /> <?php echo $v['title']; ?> <a href="issues.php?addIssue=1&subject=<?php echo $sub;?>&issue=<?php echo $k;?>">( + )</a>
						</label>
						<div style="text-indent: 20px; <?php if (empty($_POST['issues'][$sub][$k1][$k])) { ?>display:none;<?php } ?>" id="elements_<?php echo $k1; ?>_<?php echo $k; ?>">
							<?php if (!empty($v['elements'])) { ?>
								<ol>
								<?php
								foreach ($v['elements'] as $k2 => $v2) { 
								$pos = strpos($v2, ':');
								$class = '';
								if ($pos > 0) {
									$class = 'active';
								}
								?>
								<li class="<?php echo $class; ?>">
									<input type="checkbox" name="elements[<?php echo $sub; ?>][<?php echo $k1; ?>][<?php echo $k; ?>][<?php echo $k2; ?>]" value="1" style="position:relative; margin-left: 0px;" <?php if (!empty($_POST['elements'][$sub][$k1][$k][$k2])) { ?>checked<?php } ?> /> <?php echo $v2; ?> 
								</li>
							<?php } ?>
							</ol>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
					</div>
                <?php } ?>
				<?php } ?>
				<hr />
				<div>
					<label>
					<input type="submit" name="Submit" value="Submit" />
					</label> 
			    </div>
				      <input name="MM_Insert1" type="hidden" value="1" /> 
			</form>
		</div>
		<div class="col-md-7">
			<h3>Result</h3>
			<?php if (!empty($rules)) { 
				foreach ($rules as $k => $v) {
			?>
			<div class="panel panel-primary">
			  <div class="panel-heading"><?php echo $v['title']; ?> </div>
			  <div class="panel-body">
			  	<?php if (!empty($v['elements'])) { ?>
				<p><strong>Elements To Prove</strong></p>
				<ol>
					<?php
					foreach ($v['elements'] as $k2 => $v2) { 
					$pos = strpos($v2, ':');
					$class = '';
					if ($pos > 0) {
						$class = 'active';
					}
					?>
					<li class="<?php echo $class; ?>">
						<?php echo $v2; ?> 
					</li>
					<?php } ?>
				</ol>
				<?php } ?>
				<?php echo $v['rule']; ?>
				<hr />
				<a href="issues.php?addIssue=1&subject=<?php echo $v['sub'];?>&issue=<?php echo $v['k'];?>" class="pull-right">Add New Template</a>
			  </div>
			</div>
			<?php }
			}
			?>
		</div>
	</div>
</div>


<script>
$( document ).ready(function() {
    $(".chkbtn").click(function(){
		var idName = '#' + $(this).attr('ref')+' input[type=checkbox]';
		if ($(this).is(':checked')) {
			$('#' + $(this).attr('ref')).show();
			$(idName).attr('checked', true);
		} else {
			$('#' + $(this).attr('ref')).hide();
			$(idName).attr('checked', false);
		}
	});
});
</script>
</body>
</html>
