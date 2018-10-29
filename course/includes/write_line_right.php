<?php //pr($record); 
$xtra1 = json_decode($record['xtra1'], true);
?>
<script>
	function matchString(k, v, t, content_id) {
		var input = document.getElementById(t.id).value;
		if (v.toLowerCase() === input.toLowerCase()) {
			$('#check_right_' + k).show();
			$('#check_wrong_' + k).hide();
		} else {
			$('#check_wrong_' + k).show();
			$('#check_right_' + k).hide();
		}
		
		localStorage.setItem(content_id + '_' + k, input);
	}
	
	function initMatchContent(id, k, v, content_id) {
		var content = localStorage.getItem(content_id + '_' + k);
		$('#' + id).val(content);
		if (v.toLowerCase() === content.toLowerCase()) {
			$('#check_right_' + k).show();
			$('#check_wrong_' + k).hide();
		} else {
			$('#check_wrong_' + k).show();
			$('#check_right_' + k).hide();
		}
	}
</script>
<p><strong>Read the text on left side (line by line) and type it here.</strong></p>
<ul class="list-group">
	<?php foreach ($xtra1 as $k => $v) { ?>
		<li class="list-group-item"><textarea class="form-control errinput" id="input_<?php echo $k; ?>" name="input_<?php echo $k; ?>" placeholder="Enter Text" value="" onkeyup="matchString('<?php echo $k; ?>', '<?php echo $v; ?>', this, '<?php echo $record['content_id']; ?>');"></textarea> <span class="errspan2"><?php echo $k + 1; ?>.</span><i class="fa fa-check errspan" id="check_right_<?php echo $k; ?>" aria-hidden="true" style="display:none;"></i><i class="fa fa-times errspan" id="check_wrong_<?php echo $k; ?>" aria-hidden="true"></i>
		<script>
			initMatchContent('input_<?php echo $k; ?>', '<?php echo $k; ?>', '<?php echo $v; ?>', '<?php echo $record['content_id']; ?>');
		</script>
		</li>
	<?php } ?>
</ul>