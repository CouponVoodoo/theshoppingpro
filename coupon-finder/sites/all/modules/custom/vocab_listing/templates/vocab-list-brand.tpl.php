<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 $result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
   echo 'cxdcadcd';
foreach ($result as $record) {
$brandId=  $record->BrandId; 
$brand=  $record->Brand;
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
?>
  <div class="vocab-list-term"><?php echo $brandId;//echo l($term->name, 'bcp/'.$term->tid.'/coupons-offers'); 
  ?></div>
<?php
  }
?>
</div>