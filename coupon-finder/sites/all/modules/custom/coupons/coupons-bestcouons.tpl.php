<?php
$url_path = rawurlencode(drupal_get_path_alias());
global $base_url;
/*if ($row->Successful=="1") {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image"> <img src="'.$image_right.'"  width="100%" /> </span>';
}else {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u71_normal.png";
  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image red">This coupon does not work for your product</span>';
}*/
$nid = arg(1);
?>
<div class="search_listing_right">
  <div class="search_listing_row__<?php print $row->counter; ?> copy_coupon_row">
    <?php if ($row->url): ?>

	 	<?php

	/* GETTING USERS OS*/

	$os = 'unknown';
	$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if (strpos($user_agent,'android') > 1) {
		$os = 'android';
	} else {
		if (strpos($user_agent,'iphone') > 1) {
			$os = 'iphone';
		}else{
			if (strpos($user_agent,'ipad') > 1) {
				$os = 'ipad';
			}else{
				if (strpos($user_agent,'windows') > 1) {
					$os = 'windows';
				} else {
					if (strpos($user_agent,'blackberry') > 1) {
						$os = 'blackberry';
					} else {
						if (strpos($user_agent,'linux') > 1) {
							$os = 'linux';
						} else {
							$os = 'others';
						}
					}
				}
			}
		}
	}

	/* GETTING USERS SOURCE*/

	$original_source = 'Direct_Traffic';
	if (!isset($_COOKIE['traffic_source12'])) {
		$original_source = 'Direct_Traffic';
	} else {
		$original_source = $_COOKIE['traffic_source12'];
	}
	$add_tracking = rawurlencode($os.'-'.$original_source);
	?>
    <a href="<?php print $base_url ?>/coupon-redirect?l=bc&os=<?php print $add_tracking;?>&nid=<?php print $nid;?>&c=<?php print $row->couponCode; ?>&p=<?php print $url_path; ?>&s=<?php print urlencode($row->url);?>" target="_blank" class="unlock_best_coupon unlock_coupon" rel="best_<?php print $row->counter; ?>" data-clipboard-text="<?php echo $row->couponCode?>" >
      <span class="copy_coupon">Buy Now</span><span></span>
    </a>
    <?php else : ?>
    <a href="javascript:" class="unlock_best_coupon unlock_coupon" rel="best_<?php print $row->counter; ?>">
      <span class="copy_coupon">Buy Now</span><span></span>
    </a>
    <?php endif; ?>
  </div>
</div>

