<?php

$pulse = array(
	'right' => array(
		array(
			'tw' => array('name' => 'Adrenals/Thyroid', 'key' => 'tw', 'type' => 'superficial'),
			'p' => array('name' => 'Sex Organs', 'key' => 'p', 'type' => 'deep')
		),
		array(
			'st' => array('name' => 'Stomach', 'key' => 'st', 'type' => 'superficial'),
			'sp' => array('name' => 'Spleen', 'key' => 'sp', 'type' => 'deep')
		),
		array(
			'li' => array('name' => 'Large Intestine', 'key' => 'li', 'type' => 'superficial'),
			'lu' => array('name' => 'Lungs', 'key' => 'lu', 'type' => 'deep')
		)
	),
	'left' => array(
		array(
			'k' => array('name' => 'Kidney', 'key' => 'k', 'type' => 'deep'),
			'ub' => array('name' => 'Urinary Bladder', 'key' => 'ub', 'type' => 'superficial')
		),
		array(
			'liv' => array('name' => 'Liver', 'key' => 'liv', 'type' => 'deep'),
			'gb' => array('name' => 'Gall Bladder', 'key' => 'gb', 'type' => 'superficial')
		),
		array(
			'h' => array('name' => 'Heart', 'key' => 'h', 'type' => 'deep'),
			'si' => array('name' => 'Small Intestine', 'key' => 'si', 'type' => 'superficial')
		)
	)
);
$quality = array(
	array('label' => '++', 'name' => 'pp'),
	array('label' => '+', 'name' => 'p'),
	array('label' => '+-', 'name' => 'pm'),
	array('label' => '-', 'name' => 'm'),
	array('label' => '--', 'name' => 'mm'),
);
?>