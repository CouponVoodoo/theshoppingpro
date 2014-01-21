<?php
global $base_url;
if ($row->Successful=="1") {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image"> <img src="'.$image_right.'"  width="100%" /> </span>';
}else {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u71_normal.png";
  $best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image red">This coupon does not work for your product</span>';
}
?>
<div class="search_listing_right2">
  <div class="search_listing_row__<?php print $row->counter; ?> copy_coupon_row">
    <?php if ($row->url): ?>
    <a href="<?php print $base_url ?>/coupon-redirect?s=<?php print urlencode($row->url); ?>" target="_blank" class="unlock_coupon" rel="c_<?php print $row->counter; ?>">
      <span class="copy_coupon">Show Coupon</span><span></span>
    </a>
    <?php else : ?>
    <a href="javascript:" class="unlock_coupon" rel="c_<?php print $row->counter; ?>">
      <span class="copy_coupon">Show Coupon</span><span></span>
    </a>
    <?php endif; ?>
  </div>
</div>

