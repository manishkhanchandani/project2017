<?php
$xtra1 = json_decode($record['xtra1'], true);
?>
<h3><?php echo $xtra1['qz_question']; ?></h3>
<ul class="list-group" id="quiz_container">
	<?php foreach ($xtra1['qz_options'] as $k => $v) { ?>
		<li class="list-group-item" style="padding-left: 25px;"><input type="radio" id="quiz_<?php echo $k; ?>" name="quiz_ans" value="<?php echo $k; ?>" /> <span><?php echo $k + 1; ?>.</span> <span id="quiz-ans-<?php echo $k; ?>"><?php echo $v; ?></span>
		<?php if ((int) $xtra1['qz_correct'] === $k) { ?>
		<i class="fa fa-check quiz-check" aria-hidden="true" style="display:none;"></i>
		<?php } else { ?>
		<i class="fa fa-times quiz-check" aria-hidden="true" style="display:none;"></i>
		<?php } ?>
		</li>
	<?php } ?>
</ul>
<script>
$('#quiz_container input:radio').click(function() {
	console.log('l: ', $(this).val());
	$('.quiz-check').show();
	$('.qz-explanation').show();
	$('#quiz-ans-<?php echo $xtra1['qz_correct']; ?>').addClass( "quiz-selected" );
	<?php foreach ($xtra1['qz_options'] as $k => $v) { ?>
		$('#quiz_<?php echo $k; ?>').attr('disabled', true);
	<?php } ?>
});
</script>