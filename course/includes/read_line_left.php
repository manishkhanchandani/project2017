<?php //pr($record); 
$xtra1 = json_decode($record['xtra1'], true);
?>
<ul class="list-group">
	<?php foreach ($xtra1 as $k => $v) { ?>
		<li class="list-group-item"><span><?php echo $v; ?></span></li>
	<?php } ?>
</ul>
<hr />
<div><?php echo $record['content_description']; ?></div>