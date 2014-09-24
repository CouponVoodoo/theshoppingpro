<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array(16314,21399,16612,20561,2085621291,15913,16983,21734,21291);
$result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
  // echo 'cxdcadcd';
foreach ($result as $record) {
$brandId=  $record->BrandId; 
$brand=  $record->Brand;
//foreach ($terms as $term) { 
 if (in_array($brandId, $ignore_tids)) {
    continue;
  }
  if (!trim($brand)) {
    continue;
  }
?>
  <div class="vocab-list-term"><?php echo l($brand, 'bcp/'.$brandId.'/coupons-offers'); ?></div>
<?php
  }
?>
</div>  