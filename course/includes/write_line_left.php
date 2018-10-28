<?php //pr($record); 
$xtra1 = json_decode($record['xtra1'], true);
?>
<p><strong>Read the following text and type it on the right hand side.</strong></p>
<ul class="list-group">
	<?php foreach ($xtra1 as $k => $v) { ?>
		<li class="list-group-item"><span class=" errinput"><?php echo $v; ?></span><span class="errspan3"><?php echo $k + 1; ?>.</span></li>
	<?php } ?>
</ul>