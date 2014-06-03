<?php 
global $base_url;
drupal_add_js(($base_url.'/sites/all/themes/basic/js/zeroclipboard/ZeroClipboard.js'), array('scope' => 'footer'));
drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array('scope' => 'footer'));
drupal_add_js(($base_url.'/sites/all/themes/basic/js/popup_copy_coupon.js'), array('scope' => 'footer'));
?>


<div class="popup_coupon">
	<h4><?php echo get_label("KA-CHING! Your Coupon Code is Shown Below:");?></h4>
		<div class="popup_coupon_section">
		<?php
			$coupon_code = $_GET['coupon_code'];
			echo "<div class='popup_coupon_code'> {$coupon_code} </div>";
			echo "<div class='popup_copy_coupon'> <a id = 'copy_popup' href='' class='unlock_best_coupon unlock_coupon' data-clipboard-text='{$coupon_code}' >COPY COUPON</a></div>";
		?>
		</div>
		<?php
			echo "<div class='popup_coupon_details'> Copy this coupon and paste it during the checkout section to avail additional discount</div>";
		?>
</div>