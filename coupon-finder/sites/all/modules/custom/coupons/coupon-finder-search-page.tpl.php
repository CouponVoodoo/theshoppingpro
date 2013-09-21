<?php
global $base_url;
$image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
$image_wrong = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
$best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image"><img src="'.$image_right.'"  width="100%" /></span>';
?>
<div class="search_listing_left">
  <div class="row_1">
    <label>Description:</label>
    <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->description;?></div>
  </div>
  <div class="row_2">
    <label>Savings:</label>
    <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row">INR <?php print $row->Saving;?><?php print $best_coupon; ?></div>
    
  </div>
</div>

<div class="search_listing_right">
  <div class="search_listing_row__<?php print $row->counter; ?> copy_coupon_row"><a href="<?php print $base_url ?>/coupon-redirect?s=<?php print urlencode($row->url); ?>" target="_blank" class="unlock_coupon" rel="c_<?php print $row->counter; ?>"><span class="copy_coupon">Copy Coupon</span><span></span></a></div>
</div>

