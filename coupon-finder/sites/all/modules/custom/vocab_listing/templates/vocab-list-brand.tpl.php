<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 $result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
 foreach ($result as $record) {

$brandId=  $record->BrandId; 
$brand=  $record->Brand;

 /* if (in_array($term->tid, $ignore_tids)) {
    continue; 
  }*/
  echo 'a';
//  echo l('abcd', 'bcp/'.'test'.'/coupons-offers'); 
?>
  <div class="vocab-list-term"><?php echo l('abcd', 'bcp/'.'test'.'/coupons-offers'); ?></div>
<?php
  }
?>
</div>