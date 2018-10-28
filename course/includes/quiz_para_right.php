<?php
$xtra1 = json_decode($record['xtra1'], true);
?>
<?php if (!empty($xtra1['qz_explanation'])) { ?>
<div class="qz-explanation" style="display:none;">
<h3>Explanation</h3>
<div><?php echo $xtra1['qz_explanation']; ?></div>
</div>
<?php } ?>