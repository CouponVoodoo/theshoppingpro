<?php
$url_path = rawurlencode(drupal_get_path_alias());
echo '-----'.arg(1);
$nid = arg(1);
// echo $nid;
global $base_url;
$node = node_load($nid);
$net_price = 100;
echo $node->field_product_price['und']['0'][value]);
// echo '----'.intval($row->Saving);
// $net_price = intval($node->field_product_price['und']['0']['value']) - intval($row->Saving);
if ($row->Successful=="1") {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";

  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon (Guaranteed To Work)</span>' : '<div class="coupon_status_guaranteed"><img src="'.$image_right.'"><span>Guaranteed To Work</span></div>';
}else {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u71_normal.png";
  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon (Guaranteed To Work)</span>' : '<span class="best_coupon_image red">This coupon does not work for your product</span>';
}
?>

<div class="search_listing_left">
  <div class="row_1">
 <!--   <div class='couponcode'>
      <label>Coupon Code:</label>
      <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->couponCode;?></div>
   </div>
-->
   <div class='description'>
      <label><?php echo get_label('Description:');?></label>
      <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->description;?></div>
    </div>
  </div>
  <div class="row_2">
    <?php if ($row->Successful=="1") : ?>
    <label><?php echo get_label('Savings:');?></label>
    <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row"><div class="saving"><?php print get_label('INR ').$row->Saving;?>
	</div><?php print $best_coupon; ?></div>
    <label><?php echo get_label('Net Price:');?></label>
    <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row"><div class="saving"><?php print get_label('INR ').$net_price;?>
	
    <?php else: ?>
        <label><?php echo get_label('Savings:');?></label>
	<div class="search_listing_row_<?php print $row->counter; ?> search_listing_row"><div class="saving"></div><?php print $best_coupon; ?></div>
    <?php endif; ?>
  </div>
  <?php if ($row->Successful != "1") : ?>
  <div class="row_3">
    <label><?php echo get_label('Response:');?></label>
    <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->Saving;?></div>
  </div>
  <?php endif; ?>
</div>

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


    <a href="<?php print $base_url ?>/coupon-redirect?l=oc&os=<?php print $add_tracking;?>&nid=<?php print $nid;?>&c=<?php print $row->couponCode; ?>&p=<?php print $url_path; ?>&s=<?php print urlencode($row->url);?>" target="_blank" class="unlock_coupon" rel="c_<?php print $row->counter; ?>" data-clipboard-text="<?php echo $row->couponCode?>">
      <span class="copy_coupon">Copy Coupon</span><span></span>
    </a>
    <?php else : ?>
    <a href="javascript:" class="unlock_coupon" rel="c_<?php print $row->counter; ?>">
      <span class="copy_coupon">Copy Coupon</span><span></span>
    </a>
    <?php endif; ?>
  </div>
</div>

