<?php 
$complete_save_loc = ROOT_DIR.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."maps".DIRECTORY_SEPARATOR.$row_rsView['id'].".jpg";

if (!file_exists($complete_save_loc)) {
	$url_to_image = "https://maps.googleapis.com/maps/api/staticmap?center=".urlencode($row_rsView['location'])."&zoom=14&size=300x150&maptype=roadmap&markers=color:blue%7Clabel:".strtoupper(substr($row_rsView['display_name'], 0, 1))."%7C". $row_rsView['prof_lat'].",".$row_rsView['prof_lng']."&key=AIzaSyCWqKxrgU8N1SGtNoD6uD6wFoGeEz0xwbs";
	 
	$ch = curl_init($url_to_image);
	$fp = fopen($complete_save_loc, 'wb');
	 
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
}

?>

<style type="text/css">
.navbar {
	margin-bottom: 0px;
}

.RequestDetails-summary {
    text-align: center;
}

.RequestDetails-avatar {
    display: inline-block;
    margin-top: -44px;
    border-radius: 50%;
    border: 6px solid #fff;
}

.Avatar {
    position: relative;
    display: inline-block;
    vertical-align: bottom;
    font-weight: 700;
}

.Avatar--lg .Avatar__circle {
    width: 64px;
    height: 64px;
}
.Avatar__circle {
    border-radius: 50%;
    overflow: hidden;
    background-image: url(/media/primo/icons/user/100x100.png);
    background-position: 50%;
    background-repeat: no-repeat;
    background-size: cover;
}

.Avatar--lg .Avatar__initials {
    font-size: 25.6px;
}
.Avatar__initials {
    text-align: center;
    background: #676d73;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    color: #fff;
}
.Avatar__image, .Avatar__initials {
    width: 100%;
    height: 100%;
}
</style>
<div>



<div class="RequestDetails-summary">
	<div class="smap">
		<a href="https://www.google.com/maps/@<?php echo $row_rsView['prof_lat']; ?>,<?php echo $row_rsView['prof_lng']; ?>,17z" target="_blank"><img src="<?php echo HTTP_PATH.'img/maps/'.$row_rsView['id'].'.jpg'; ?>" class="img-responsive" /></a>
	</div>
	<div class="RequestDetails-customer">
		<div class="RequestDetails-avatar">
			<div class="Avatar Avatar--lg">
				<div class="Avatar__circle">
					<div class="Avatar__initials ">
						<?php
							$tmp = explode(' ', $row_rsView['display_name']);
							foreach ($tmp as $v) {
								echo strtoupper(substr($v, 0, 1));
							}
						?>
					</div>		
				</div>		
			</div>
		
		</div>
		<p class="RequestDetails-customer-name tp-title-4" style="font-size: 20px; line-height: 28px; font-weight: 700;">
			<?php echo $row_rsView['display_name']; ?>
		</p>
		<p class="RequestDetails-customer-info tp-body-2" style="color: #676d73; font-size: 14px; line-height: 20px;">
			<?php echo $row_rsView['location']; ?>
		</p>
	</div>
</div>






<div class="RequestDetails-metaDataCustomerContact
                        page-grid theme-full-bleed-at-sm" style="    padding: 16px;    text-align: center;    margin: 0 auto;    fill: #009fd9; margin: 0 auto;     font-size: 0;    display: block;    -webkit-box-flex: 1;    -ms-flex: 1 0 0px;    flex: 1 0 0;    max-width: 946px;    padding-left: 16px;    padding-right: 16px;">
	<div class="RequestDetails-metaDataCustomerContact-datum tp-body-1 column-lg-2" style="    width: 33.33333%;">
		<svg-icon type="quotes" size="sm" class="ng-scope theme-small IconContainer"><svg class="Icon" viewBox="0 0 16 16">
		<use xlink:href="#thumbprinticon-quotes_16"></use>
		</svg>
		</svg-icon>
		1
		<p class="RequestDetails-metaDataCustomerContact-description tp-body-3">
		pro contacted
		</p>
	</div>
	<div class="RequestDetails-metaDataCustomerContact-datum tp-body-1 column-lg-2" style="    width: 33.33333%;">
		<svg-icon type="expiration" size="sm" class="ng-scope theme-small IconContainer"><svg class="Icon" viewBox="0 0 16 16">
		<use xlink:href="#thumbprinticon-expiration_16"></use>
		</svg>
		</svg-icon>
		1h 50m
		<p class="RequestDetails-metaDataCustomerContact-description tp-body-3">
		avg pro response time
		</p>
	</div>
</div>



</div>