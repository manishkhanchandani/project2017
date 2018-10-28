
<script>
	
	function initMatchContent(content_id, desc) {
		var content = localStorage.getItem(content_id);
		$('#content_description').val(content);
		content = content.toLowerCase();
		content = strip_tags(content);
		desc = desc.toLowerCase();
		desc = strip_tags(desc);
		if (desc === content) {
			$('#write_para_right_content').show();
			$('#write_para_wrong_content').hide();
		} else {
			$('#write_para_wrong_content').show();
			$('#write_para_right_content').hide();
		}
	}
</script>

<textarea name="content_description" id="content_description" rows="5"></textarea>
<i class="fa fa-check errspanwritepara" id="write_para_right_content" aria-hidden="true" style="display:none;"></i><i class="fa fa-times errspanwritepara" id="write_para_wrong_content" aria-hidden="true"></i>
<script>
initMatchContent('<?php echo $record['content_id']; ?>', '<?php echo $record['content_description']; ?>');
		</script>
<script>

 	$(document).ready(function() {
        $('#content_description').summernote({
			height: 250						   
		});
		
		$( ".note-editable" ).keyup(function() {
			var content = $( ".note-editable" ).html();
			var input = content.toLowerCase();
			input = strip_tags(input);
			var v = '<?php echo $record['content_description']; ?>';
			var comparetext = v.toLowerCase();
			comparetext = strip_tags(comparetext);
			if (comparetext === input) {
			$('#write_para_right_content').show();
			$('#write_para_wrong_content').hide();
			} else {
			$('#write_para_wrong_content').show();
			$('#write_para_right_content').hide();
			}
			
			localStorage.setItem('<?php echo $record['content_id']; ?>', content);
		});
    });
</script>