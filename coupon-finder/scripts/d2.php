<?php

$results = db_query("SELECT distinct nid from coupon_finder.domain_access where realm='domain_id' and nid = 2476883");

	$nodesProcessed = 0;
//$file = fopen('domain.txt', 'a+');
var_dump($results);
exit;

?>
