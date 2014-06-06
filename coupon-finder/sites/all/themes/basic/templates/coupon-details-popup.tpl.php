<?php 
	global $base_url;
	$coupon_code = $_GET['coupon_code'];
	$redirect_path = $_GET['redirect_path'];
	$coupon_nid = db_query("SELECT MAX(entity_id) FROM field_data_field_coupon_code where field_coupon_code_value = '".$coupon_code."'")->fetchField();
	if($coupon_nid > 0){
		$coupon_retailer_id = db_query("SELECT MAX(field_retailer_tid) FROM field_data_field_retailer where entity_id = ".$coupon_nid)->fetchField();
	}
	// echo $coupon_retailer_id.'-'.$coupon_nid;
	switch ($coupon_retailer_id) {
		case 5:
			$how_url = 'http://www.couponvoodoo.com/content/how-use-coupon#Jabong';
			$coupon_retailer_name = 'Jabong';
		break;
		case 13419:
			$how_url = 'http://www.couponvoodoo.com/content/how-use-coupon#Flipkart';
			$coupon_retailer_name = 'Flipkart';
		break;				
		case 8:
			$how_url = 'http://www.couponvoodoo.com/content/how-use-coupon#Myntra';
			$coupon_retailer_name = 'Myntra';
		break;				
		case 14782:
			$how_url = 'http://www.couponvoodoo.com/content/how-use-coupon#Amazon';
			$coupon_retailer_name = 'Amazon';
		break;
		
		default:
			$how_url = 'http://www.couponvoodoo.com/content/how-use-coupon';
			$coupon_retailer_name = 'Others';
	}

?>
<div class="popup_coupon">	
<?php 
	if(strpos(strtolower($coupon_code), 'flipkart') > -1) { // checking if code if for flipkart as we will not show copy coupon here
?>
		<h4><?php echo get_label("BAZINGA! The following deal has been activated:");?></h4>
		<div class="popup_coupon_section">
		<?php
			echo "<div class='popup_coupon_code'> {$coupon_code} </div>";
			// echo "<div class='popup_copy_coupon'> <a id = 'copy_popup' href='' class='unlock_best_coupon unlock_coupon' data-clipboard-text='{$coupon_code}' >COPY COUPON</a></div>";
		?>
		</div>
		<?php
			echo "<div class='popup_coupon_details'> You do not need a coupon code to get this offer. Simply add the product to your cart and the discount will provided automatically.</div>";
	} else {
		drupal_add_js(($base_url.'/sites/all/themes/basic/js/zeroclipboard/ZeroClipboard.js'), array('scope' => 'footer'));
		drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array('scope' => 'footer'));
		drupal_add_js(($base_url.'/sites/all/themes/basic/js/popup_copy_coupon.js'), array('scope' => 'footer'));	
	?>
			
		<h4><?php echo get_label("KA-CHING! Your Coupon Code is Shown Below:");?></h4>
		<div class="popup_coupon_section">
		<?php
			echo "<div class='popup_coupon_code'> {$coupon_code} </div>";
			echo "<div class='popup_copy_coupon'> <a id = 'copy_popup' href='' class='unlock_best_coupon unlock_coupon' data-clipboard-text='{$coupon_code}' >COPY COUPON</a></div>";
		?>
		</div>
		<?php
			echo "<div class='popup_coupon_details'> Copy this coupon and paste it during the checkout section to avail additional discount</div>";
	}
	
?>
	<label class = "lose_text"> Got it? Go ahead and buy now!</label>
	<?php
	echo "<div class='popup_copy_coupon'> <a id = 'copy_popup' href='{$redirect_path}' class='product_link' target='_blank'>Visit the Product Page >> </a></div>";
	echo "<div class = 'how_to_link'> <a href='{$how_url}' target='_blank'>New to coupons? See how to apply</a></div>";
	?>
</div>