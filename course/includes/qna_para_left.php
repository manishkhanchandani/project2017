<?php //pr($record); 
$xtra1 = json_decode($record['xtra1'], true);
?>
<script>
function showSelected(k) {
	$('#qna-real-answer-'+k).show();
	$('#qna-q-'+k).addClass('quiz-selected');
	$('#qna-btns-close-'+k).show();
	$('#qna-btns-eye-'+k).hide();
}
function hideSelected(k) {
	$('#qna-real-answer-'+k).hide();
	$('#qna-q-'+k).removeClass('quiz-selected');
	$('#qna-btns-eye-'+k).show();
	$('#qna-btns-close-'+k).hide();
}
</script>
<p><strong>Read the following text and type it on the right hand side / or below.</strong></p>
<ul class="list-group">
	<?php foreach ($xtra1 as $k => $v) { ?>
		<li class="list-group-item"><span class=" errinput" id="qna-q-<?php echo $k; ?>"><?php echo $v['qna']; ?></span><span class="errspan3"><?php echo $k + 1; ?>.</span> <i class="fa fa-eye qna-btn" aria-hidden="true" id="qna-btns-eye-<?php echo $k; ?>" onclick="showSelected(<?php echo $k; ?>);"></i><i class="fa fa-times qna-btn" aria-hidden="true" onclick="hideSelected(<?php echo $k; ?>);" id="qna-btns-close-<?php echo $k; ?>" style="display:none;"></i>
		<div class="qna-real-answer" id="qna-real-answer-<?php echo $k; ?>" style="display:none;"><hr /><?php echo nl2br($v['qna_ans']); ?></div>
		</li>
	<?php } ?>
</ul>