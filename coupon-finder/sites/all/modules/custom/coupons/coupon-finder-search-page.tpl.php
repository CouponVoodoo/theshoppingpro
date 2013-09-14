<?php
global $base_url;
$best_coupon = !empty($value->BestCoupon) ? '<div class="best_coupon">Best Coupon</div>' : '<div class="best_coupon">NON BEST</div>';
?>
<div class="search_listing_left">
  <label>Description:</label>
  <div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->description;?></div>
  <label>Savings;</label>
  <div class="search_listing_row_<?php print $row->counter; ?> search_listing_row">INR <?php print $row->Saving;?></div>
  <?php print $best_coupon; ?>
</div>
<div class="search_listing_right">
  <div class="search_listing_row__<?php print $row->counter; ?> search_listing_row copy_coupon"><a href="<?php print $base_url ?>/coupon-redirect?s=<?php print urlencode($row->url); ?>" target="_blank" class="unlock_coupon" rel="c_<?php print $row->counter; ?>"><span class="copy_coupon">Copy Coupon</span><span>*****</span></a></div>
</div>

