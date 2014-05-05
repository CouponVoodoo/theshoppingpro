<?PHP



$results = db_query("SELECT distinct entity_id from coupon_finder.priceHistory where updateDate = CURDATE()");

foreach ($results as $result) {
	echo 'inside loop';
	echo $result->entity_id;
	
	$entity_id = explode(",",$result->entity_id);

            $query = "update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus =1 where entity_id = :entity_id";
			$count = db_query($query, array(':entity_id' => $entity_id));
	}
	
$count=db_query("Insert into priceHistory select '',entity_id,BestCouponStatus,NetPrice,ListPrice,CURDATE(),0 from predictorCompiledResultTable where updatePriceHistoryStatus <> 1")	;
echo $count;
db_query("update coupon_finder.predictorCompiledResultTable set updatePriceHistoryStatus =0")	;

?>