<div class="eachRow" style="max-height: 1000px; opacity: 1;  transition: max-height .3s linear,opacity .5s;">
	<div style="color: #2f3033;     -webkit-box-orient: horizontal;  -webkit-box-direction: normal;     flex-direction: row;     border-radius: 4px;     padding: 28px;     background-color: #fff; margin-bottom: 8px;     border: 1px solid #e9eced; display: flex; 	    fill: #009fd9;  text-decoration: none;">
		<article style="    -webkit-box-flex: 1;flex: 1 1 100%;    margin-right: 24px;">
			<header style="display: flex; -webkit-box-align: center; align-items: center; margin-bottom: 16px; position: relative;">
				
				<div class="shortCode" style=" margin-right: 16px">
					<div style="background-color: #f27802;  width: 32px; height: 32px; display: flex; -webkit-box-align: center; align-items: center; -webkit-box-pack: center; justify-content: center; border-radius: 50%; font-weight: 700; color: #fff; font-size: 12px; line-height: 18px;">
						<?php
							$tmp = explode(' ', $row['display_name']);
							foreach ($tmp as $v) {
								echo strtoupper(substr($v, 0, 1));
							}
						?>
					</div>
				</div><!-- end div -->
				<div>
					<div><h1 style="display: flex; align-items: center; font-size: 14px; line-height: 20px; font-weight: 400;"><div><?php echo $row['display_name']; ?></div><div style="font-size: 10px; font-weight: 600; text-transform: uppercase; display: flex; -webkit-box-orient: horizontal; -webkit-box-direction: normal; flex-direction: row;"><div style="background-color: #e9eced; color: #676d73; margin-left: 8px; padding: 2px 4px;line-height: 1.4; border-radius: 2px;">Partial Match</div></div></h1><div style="color: #676d73; fill: #676d73; font-size: 12px; line-height: 18px;"><?php echo timeAgo($row['prof_created_dt']); ?> - <?php echo date('Y') - $row['birth_year']; ?> years old</div></div>
				</div><!-- end div -->
			</header><!-- end header -->
			<div style="    font-weight: 700;     margin-bottom: 8px;">
				Massage Exchange
			</div><!-- end div -->
			<div style="display: flex; -webkit-box-align: start;      align-items: start;     font-size: 14px; line-height: 20px;    margin-bottom: 5px;"><svg class="tp-margin-right--half" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="currentColor"><path d="M3.002 7.25c0 3.248 4.342 7.756 5.23 8.825l.769.925.769-.926c.888-1.068 5.234-5.553 5.234-8.824C15.004 4.145 13 1 9.001 1c-3.999 0-6 3.145-6 6.25zm1.993 0C4.995 5.135 6.176 3 9.001 3s4.002 2.135 4.002 4.25c0 1.777-2.177 4.248-4.002 6.59C7.1 11.4 4.995 9.021 4.995 7.25zM8.91 5.5c-.827 0-1.5.673-1.5 1.5s.673 1.5 1.5 1.5 1.5-.673 1.5-1.5-.673-1.5-1.5-1.5"></path></svg><span style="margin-left: 5px;"><?php echo $row['location']; ?></span></div><!-- end div -->
			<div style="display: flex; -webkit-box-align: start;      align-items: start;     font-size: 14px; line-height: 20px;   margin-bottom: 5px;"><svg class="tp-margin-right--half" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 18 18"><path fill-rule="evenodd" d="M9 5.25a.75.75 0 0 0-.75.75v2.25H6a.75.75 0 0 0 0 1.5h3.75V6A.75.75 0 0 0 9 5.25M9 15c-3.309 0-6-2.691-6-6s2.691-6 6-6c3.31 0 6 2.691 6 6s-2.69 6-6 6M9 1C4.589 1 1 4.589 1 9s3.589 8 8 8 8-3.589 8-8-3.589-8-8-8"></path></svg><span style="margin-left: 5px;"><strong>Gender:</strong> <?php echo $row['gender']; ?></span></div><!-- end div -->
			<div style="-webkit-box-pack: start; justify-content: flex-start; flex-wrap: wrap; align-items: flex-start; margin-top: 12px;     display: flex; -webkit-box-align: start;">
				<div class="individualItems"><strong>Preferred Gender</strong></div>
				<?php if ((int) $row['looking_gender_female'] === 1) { ?><div class="individualItems">Female</div><?php } ?>
				<?php if ((int) $row['looking_gender_male'] === 1) { ?><div class="individualItems">Male</div><?php } ?>
				<div class="individualItems"><strong>Massage Types</strong></div>
				<?php if ((int) $row['type_swedish'] === 1) { ?><div class="individualItems">Swedish</div><?php } ?>
				<?php if ((int) $row['type_deep'] === 1) { ?><div class="individualItems">Deep Tissue</div><?php } ?>
				<?php if ((int) $row['type_thai'] === 1) { ?><div class="individualItems">Thai</div><?php } ?>
				<?php if ((int) $row['type_sports'] === 1) { ?><div class="individualItems">Sports</div><?php } ?>
				<?php if ((int) $row['type_pregnancy'] === 1) { ?><div class="individualItems">Pregnancy</div><?php } ?>
				<?php if ((int) $row['type_reflexology'] === 1) { ?><div class="individualItems">Reflexology</div><?php } ?>
				<?php if ((int) $row['type_medical'] === 1) { ?><div class="individualItems">Medical</div><?php } ?>
				<?php if ((int) $row['type_hotstone'] === 1) { ?><div class="individualItems">Hot Stone</div><?php } ?>
				<div class="individualItems"><strong>Marital Status</strong></div>
				<div class="individualItems"><?php echo ucwords($row['marital_status']); ?></div>
				<?php if ((int) $row['isHost'] === 1) { ?><div class="individualItems">I can host an exchange</div><?php } ?>
				<?php if ((int) $row['massage_table'] === 1) { ?><div class="individualItems">I have a massage table</div><?php } ?>
				<?php if ((int) $row['qualification'] === 1) { ?><div class="individualItems">I have formal massage qualifications</div><?php } ?>
			</div><!-- end div -->
		</article><!-- end article -->
		<div class="rightSide"><div class="_19PyCahmpHER6M3eroFiyJ"><a href="detail.php?id=<?php echo $row['id']; ?>" style="margin-bottom: 16px;    font-size: 14px; line-height: 20px; padding-top: 8px; padding-bottom: 8px; min-height: 40px; background-color: #fff;border-color: #d3d4d5; color: #676d73; box-sizing: border-box; display: inline-block; vertical-align: middle; white-space: nowrap; font-family: inherit; cursor: pointer; margin: 0;     font-weight: 700; user-select: none; border-radius: 4px; padding: 12px 22px; overflow: visible;     border: 2px solid gray;">View Details</a></div><div style="    color: #676d73;margin-top: 16px;">Related Profiles</div></div><!-- end div -->
	</div>
</div>