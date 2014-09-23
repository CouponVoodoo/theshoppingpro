<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 $result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
  // echo 'cxdcadcd';
  // var_dump($result);
foreach ($result as $record) {
//var_dump($record);

$brandId=  $record->BrandId; 
//var_dump($brandId);
$brand=  $record->Brand;
//echo $brand;
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
 echo '<div class="vocab-list-term">'.$brand.'</div>' ;
 }
?>
  
  </div>