<?php
global $base_url;
$title="Let Coupons Find You!";
if ($row->Successful=="1") {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
}else {
  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u71_normal.png";
}

$best_coupon = !empty($row->BestCoupon) ? '<span class="best_coupon">Best Coupon</span>' : '<span class="best_coupon_image"> <img src="'.$image_right.'"  width="100%" /> </span>';
?>

<div class="search_listing_left">
  <div class="row_1">
    <label>Description:</label>
    <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->description;?></div>
  </div>
  <div class="row_2">
    <label>Savings:</label>
    <?php if ($row->Successful=="1") : ?>
    <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row"><div class="saving">INR <?php print $row->Saving;?></div><?php print $best_coupon; ?></div>
    <?php else: ?>
    <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row"><div class="saving"> - </div><?php print $best_coupon; ?></div>
    <?php endif; ?>
  </div>
  <?php if ($row->Successful != "1") : ?>
  <div class="row_3">
    <label>Response:</label>
    <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->Saving;?></div>
  </div>
  <?php endif; ?>
</div>

<div class="search_listing_right">
  <div class="search_listing_row__<?php print $row->counter; ?> copy_coupon_row">
    <?php if ($row->url): ?>
    <a href="<?php print $base_url ?>/coupon-redirect?s=<?php print urlencode($row->url); ?>" target="_blank" class="unlock_coupon" rel="c_<?php print $row->counter; ?>">
      <span class="copy_coupon">Copy Coupon</span><span></span>
    </a>
    <?php else : ?>
    <a href="javascript:" class="unlock_coupon" rel="c_<?php print $row->counter; ?>">
      <span class="copy_coupon">Copy Coupon</span><span></span>
    </a>
    <?php endif; ?>
  </div>
</div>

