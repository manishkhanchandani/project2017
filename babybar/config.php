<?php
$webReference = 'calbabybar.com';
define('WEBREFERENCE', $webReference);
define('LOCAL_FOLDER', '/project2017/babybar/');
define('SERVER_FOLDER', '/');
define('FIREBASE_BASEPATH', 'babybarphp');

$nodeTypes = array('defs' => array('name' => 'Definitions', 'flashcard' => true), 'casebriefs' =>  array('name' => 'Case Briefs', 'flashcard' => false),'midterma' =>  array('name' => 'Mid Term A', 'flashcard' => false), 'midtermb' =>  array('name' => 'Mid Term B', 'flashcard' => false), 'issues' =>  array('name' => 'Issues', 'flashcard' => true), 'essays' =>  array('name' => 'Essays', 'flashcard' => false), 'mbe' =>  array('name' => 'MBE', 'flashcard' => false),  'assignments' =>  array('name' => 'Assignments', 'flashcard' => false),  'quizes' => array('name' => 'Quizes', 'flashcard' => false), 'practice' => array('name' => 'Practice', 'flashcard' => true));


$barSubjects = array(
	1 => array('subject' => 'Contracts', 'year' => '1L', 'url' => 'contracts', 'id' => 1),
	3 => array('subject' => 'Torts', 'year' => '1L', 'url' => 'torts', 'id' => 3),
	4 => array('subject' => 'Criminal', 'year' => '1L', 'url' => 'criminal', 'id' => 4),
	5 => array('subject' => 'Agency and Partnership', 'year' => '2L', 'url' => 'agency_partnership', 'id' => 5),
	6 => array('subject' => 'Criminal Procedure', 'year' => '2L', 'url' => 'criminal_procedure', 'id' => 6),
	7 => array('subject' => 'Real Property', 'year' => '2L', 'url' => 'real_property', 'id' => 7),
	8 => array('subject' => 'Remedies', 'year' => '2L', 'url' => 'remedies', 'id' => 8),
	9 => array('subject' => 'Civil Procedure', 'year' => '3L', 'url' => 'civil_procedure', 'id' => 9),
	10 => array('subject' => 'Constitutional law', 'year' => '3L', 'url' => 'constitutional_law', 'id' => 10),
	11 => array('subject' => 'Corporations', 'year' => '3L', 'url' => 'corporations', 'id' => 11),
	12 => array('subject' => 'Evidence', 'year' => '3L', 'url' => 'evidence', 'id' => 12),
	13 => array('subject' => 'Administrative Law', 'year' => '4L', 'url' => 'administrative_law', 'id' => 13),
	14 => array('subject' => 'Community Property', 'year' => '4L', 'url' => 'community_property', 'id' => 14),
	15 => array('subject' => 'Professional Responsibility', 'year' => '4L', 'url' => 'professional_responsibility', 'id' => 15),
	16 => array('subject' => 'Trusts', 'year' => '4L', 'url' => 'trusts', 'id' => 16),
	17 => array('subject' => 'Wills', 'year' => '4L', 'url' => 'wills', 'id' => 17)
);

?>