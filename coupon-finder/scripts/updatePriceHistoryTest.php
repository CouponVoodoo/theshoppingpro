<?PHP


$freq=150;

$update = db_query("update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus=1 where entity_id is null");
$results = db_query("SELECT distinct entity_id from coupon_finder.priceHistory where updateDate = CURDATE()");



foreach ($results as $result) {
	echo 'inside loop';
	echo $result->entity_id;
	
	$entity_id = explode(",",$result->entity_id);

            $query = "update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus =1 where entity_id = :entity_id";
			$count = db_query($query, array(':entity_id' => $entity_id));
			//$update=1;
	}
	
	$result = db_query('SELECT status FROM coupon_finder.1Variables n where Serial=3');
foreach(
$result as $item) {
  $updateCount= $item->status;
}
echo 'updating Count '.$updateCount;
	if ($updateCount < $freq){
	echo 'updating table';
$count=db_query("Insert into priceHistory select 0,entity_id,BestCouponStatus,NetPrice,ListPrice,CURDATE(),0,BestCouponCode from predictorCompiledResultTable where updatePriceHistoryStatus <> 1")	;
$count=db_query("Insert into priceHistoryBatchData select 0,entity_id,BestCouponStatus,NetPrice,ListPrice,CURDATE(),0,BestCouponCode from predictorCompiledResultTable where updatePriceHistoryStatus <> 1")	;

echo $count;
db_query("update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus =0")	;
db_query("update coupon_finder.1Variables set status = status+1 where Serial=3")	;

$total_count = db_query("SELECT count( distinct entity_id) FROM `priceHistory` where `updateDate` = CURDATE()")->fetchField();
$result = 'No. of url updated for price history :'.$total_count;
mail('team@theshoppingpro.com', 'Update Price History : ', $result);	
}
else {echo 'in else loop';
//db_query("Truncate table priceHistoryBatchData")	;
db_query("Insert into priceHistory select 0,entity_id,BestCouponStatus,NetPrice,ListPrice,CURDATE(),0,BestCouponCode from predictorCompiledResultTable where updatePriceHistoryStatus <> 1")	;
$count=db_query("Insert into priceHistoryBatchData select 0,entity_id,BestCouponStatus,NetPrice,ListPrice,CURDATE(),0,BestCouponCode from predictorCompiledResultTable where updatePriceHistoryStatus <> 1")	;
db_query("update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus =0")	;
db_query("update coupon_finder.1Variables set status = 0 where Serial=3")	;
}
?>