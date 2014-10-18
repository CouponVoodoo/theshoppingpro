<?php

$results = db_query("SELECT distinct nid from coupon_finder.domain_access where realm='domain_id' and nid in (2476883,2476884,2476885)");

	$nodesProcessed = 0;
//$file = fopen('domain.txt', 'a+');
//var_dump($results);

foreach ($results as $result) {
	echo 'inside loop';
	echo $result->nid;
}

?>
