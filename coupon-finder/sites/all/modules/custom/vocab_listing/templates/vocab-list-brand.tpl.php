<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 $result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
  // echo 'cxdcadcd';
  // var_dump($result);
  $fullJSON='';
foreach ($result as $record) {
//var_dump($record);
$element = json_encode(array($record));
    $fullJSON = $fullJSON.$element;
	}
	$fullJSON = str_replace("][",",",$fullJSON);
	$resultsArr = json_decode($fullJSON, true);

 foreach($resultsArr as $datarow)
  {echo $datarow->Brand; 
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
  
?>
  <div class="vocab-list-term"><?php echo l($datarow->Brand, 'bcp/'.$datarow->BrandId.'/coupons-offers'); 
  ?></div>
<?php
  }
?>
</div>