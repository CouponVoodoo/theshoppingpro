<div class="vocab-list vocab-list-retail">
<?php
$result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons where brandid in (7458,7476,7495,7502,7515,7543,7605,7608,7614,7622,7632,7636,7639,7659,7668,7826,7939,7980,8021,8232,8892,9613,10200,10320)');
  // echo 'cxdcadcd';
foreach ($result as $record) {
$brandId=  $record->BrandId; 
$brand=  $record->Brand;

  
  $img = 'http://plugin.theshoppingpro.com/banners/brandLogo/'.$brandId.'.jpg';
?>
  <div class="vocab-list-term">
   <a href="<?php echo url('bcp/'.$brandId.'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?>">
      <img src="<?php echo $img; ?>" alt="<?php echo $brand; ?>" />
    
    </a>
  </div>
<?php  
  }
?>
</div>

<div class="vocab-list vocab-list-brand">
<?php
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