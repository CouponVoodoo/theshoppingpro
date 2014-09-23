<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 $result = db_query('SELECT BrandId from coupon_finder.BrandCoupons');
   
foreach ($result as $record) {
$brandId=  $record->BrandId; 
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
?>
  <div class="vocab-list-term"><?php print_r($record);//echo l($term->name, 'bcp/'.$term->tid.'/coupons-offers'); 
  ?></div>
<?php
  }
?>
</div>