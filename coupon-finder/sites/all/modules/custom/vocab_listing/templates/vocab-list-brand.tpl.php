<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 
 /*$result = db_query('SELECT Brand,BrandId from coupon_finder.BrandCoupons');
  // echo 'cxdcadcd';
  // var_dump($result);
  $fullJSON='';
foreach ($result as $record) {
//var_dump($record);
$element = json_encode(array($record));
//var_dump($element);
    $fullJSON = $fullJSON.$element;
	}
	$fullJSON = str_replace("][",",",$fullJSON);
	
	$resultsArr = json_decode($fullJSON, true);
//var_dump($resultsArr);
 foreach($resultsArr as $datarow)
  {//echo $datarow['Brand']; 
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
  //$rurl='bcp/'.$datarow['Brand'].'/coupons-offers';
  $rurl='bcp/coupons-offers';
  echo 'http://offers.couponvoodoo.com/term/brand/list';
  echo $rurl;
  print '<div class="vocab-list-term"><a href="'.$rurl.'" target="_blank">'.'ksd'. '</a></div>';

  //}
?>
</div>