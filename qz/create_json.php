<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsView = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM qz_questions LEFT JOIN qz_issue_mbe_essay on qz_questions.laws = qz_issue_mbe_essay.issue_id WHERE qz_questions.category_id = %s ORDER BY qz_issue_mbe_essay.issue_key", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsCat = "-1";
if (isset($_GET['cat_id'])) {
  $colname_rsCat = (get_magic_quotes_gpc()) ? $_GET['cat_id'] : addslashes($_GET['cat_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCat = sprintf("SELECT * FROM qz_categories WHERE cat_id = %s", $colname_rsCat);
$rsCat = mysql_query($query_rsCat, $conn) or die(mysql_error());
$row_rsCat = mysql_fetch_assoc($rsCat);
$totalRows_rsCat = mysql_num_rows($rsCat);

mysql_select_db($database_conn, $conn);
$query_rsIssues = "SELECT * FROM qz_issue_mbe_essay";
$rsIssues = mysql_query($query_rsIssues, $conn) or die(mysql_error());
$row_rsIssues = mysql_fetch_assoc($rsIssues);
$totalRows_rsIssues = mysql_num_rows($rsIssues);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Json</title>
</head>

<body>
<p>Create Json For Category &quot;<?php echo $row_rsCat['category']; ?>&quot;</p>
<?php 
$issues = array();
do {
if (empty($row_rsIssues['issue_key'])) continue;

$issues[$row_rsIssues['issue_id']] = $row_rsIssues['issue_key'];
} while ($row_rsIssues = mysql_fetch_assoc($rsIssues)); 

$questions = array();
do {
$x = explode(',', $row_rsView['laws']);
$x = array_filter($x);
if (!empty($x)) {
	foreach ($x as $k => $v) {
		$questions[$issues[$v]][$row_rsView['id']] = $row_rsView;
	}
} else {
	$questions[0][$row_rsView['id']] = $row_rsView;
}
} while ($row_rsView = mysql_fetch_assoc($rsView)); 

?><?php
$key = '';
?>
<?php 
foreach ($questions as $k => $v) {
?>
<?php echo $k; ?>

[
<?php 
foreach ($v as $k1 => $row_rsView) {
?>
<?php
$answers = json_decode($row_rsView['answers']);
$tmp = explode("\n", $row_rsView['explanation']);
$q_desc = empty($row_rsView['q_desc']) ? $tmp[0] : str_replace("\n", "<br />", $row_rsView['q_desc']);
?>
{
	"key": "rule<?php echo $row_rsView['id']; ?>",
	"name": "Rule <?php echo $row_rsView['id']; ?>: <?php echo $row_rsView['issue_key']; ?>",
	"description": "<?php echo $q_desc; ?> (Ref: <?php echo $row_rsView['id']; ?> / <?php echo $row_rsView['category_id']; ?>)",
	"examples": [
		{
			"question": "<?php echo $row_rsView['id']; ?>. <?php echo str_replace("\n", "<br />", $row_rsView['question']); ?>",
			"answerOptions": [
				"<?php echo $answers[0]; ?>",
				"<?php echo $answers[1]; ?>",
				"<?php echo $answers[2]; ?>",
				"<?php echo $answers[3]; ?>"
			],
			"correct": <?php echo $row_rsView['correct']; ?>,
			"subtopic": "<?php echo $row_rsView['topic']; ?>",
			"explanation": "<?php echo str_replace("\n", "<br />", $row_rsView['explanation']); ?>"
		}
	]
},
<?php //print_r($row_rsView); print_r($answers);print_r($desc); ?>
<?php } ?>
]
<?php } ?></body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsCat);

mysql_free_result($rsIssues);
?>
