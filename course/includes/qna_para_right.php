<?php 
$xtra1 = json_decode($record['xtra1'], true);
?>
<script>
	function matchString(k, t, content_id) {
		var input = document.getElementById(t.id).value;		
		localStorage.setItem(content_id + '_' + k, input);
	}
	
	function initMatchContent(k, content_id) {
		var content = localStorage.getItem(content_id + '_' + k);
		$('#qna_' + k).val(content);
	}
</script>
<p><strong>Read the questions on left / top and answer it here?</strong></p>
<ul class="list-group">
	<?php foreach ($xtra1 as $k => $v) { ?>
		<li class="list-group-item" style="padding-left: 25px;"><textarea class="form-control" id="qna_<?php echo $k; ?>" name="qna_<?php echo $k; ?>" onkeyup="matchString('<?php echo $k; ?>', this, '<?php echo $record['content_id']; ?>');"></textarea><span class="errspanQna"><?php echo $k + 1; ?>.</span>
		<script>
			initMatchContent('<?php echo $k; ?>', '<?php echo $record['content_id']; ?>');
		</script>
		</li>
	<?php } ?>
</ul>