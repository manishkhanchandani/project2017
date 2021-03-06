<div style="margin:0px; padding:0px;">
<?php if ($images || $links || $videos) { ?>	
<hr />
<div><a onclick="toggleContent('content_<?php echo $node_id; ?>'); return false;">Toggle Media Content</a></div>	
<div id="content_<?php echo $node_id; ?>" style="display:;">
<?php if (!empty($images)) { ?>
<hr />
<h3 class="page-header">Images</h3>
<div class="row">
	<?php
	foreach ($images as $k => $v) {
	?>
		<div class="col-md-3"><img src="<?php echo $v; ?>" class="img-responsive" /></div>
	<?php
	}
	?>
</div>
<?php } ?>
<?php if (!empty($videos)) { ?>
<hr />
<h3 class="page-header">Videos</h3><div class="row">
	<?php
	foreach ($videos as $k => $v) {
	?>
		<div class="col-md-4">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="<?php echo str_replace('watch?v=', 'embed/', $v); ?>" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	<?php
	}
	?>
</div>
<?php } ?>
<?php if (!empty($links)) { ?>
<hr />
<h3 class="page-header">Links</h3>
	<div class="list-group">
		<?php
			foreach ($links as $k => $v) {
			?>
	  <a href="<?php echo $v; ?>" class="list-group-item" target="_blank"><?php echo $v; ?></a>
	  <?php
		}
	?>
	</div>
<?php } ?>

</div>
<?php } ?>
</div>