<?php

$results = db_query("SELECT distinct nid from coupon_finder.domain_access where realm='domain_id' and nid = 2476883");

	$nodesProcessed = 0;
//$file = fopen('domain.txt', 'a+');
var_dump($results);
exit;
/*foreach ($results as $result) {
	echo 'inside loop';
	echo $result->nid;

    print "\r\n\r\nNode being processed = $result->nid";
    fwrite($file, "\r\n\r\nNode being processed = $result->nid");
    exit; 
print 'na';
    // Check if entry exists in domain_access.
    $ifDomainExists = db_select('domain_access', 'da')->condition('gid', 3)->condition('realm', 'domain_id')
            ->condition('nid', $result->nid)->countQuery()->execute()->fetchField();

    if ($ifDomainExists == 0) {
        // Insert into Domain Access Table
        db_insert('domain_access')
                ->fields(array(
                    'nid' => $result->nid,
                    'gid' => 3,
                    'realm' => 'domain_id'
                ))
                ->execute();
        print "\r\nData added for domain_access table for NID = $result->nid";
        fwrite($file, "\r\nData added for domain_access table for NID = $result->nid");
    }
    
    // Check if entry exists in node_access.
    $ifNodeExists = db_select('node_access', 'na')->condition('gid', 3)->condition('realm', 'domain_id')
            ->condition('nid', $result->nid)->countQuery()->execute()->fetchField();
    
    if ($ifNodeExists == 0) {
        // Insert into Node Access Table
        db_insert('node_access')
                ->fields(array(
                    'nid' => $result->nid,
                    'gid' => 3,
                    'realm' => 'domain_id',
                    'grant_view' => 1,
                    'grant_update' => 1,
                    'grant_delete' => 1
                ))
                ->execute();
        print "\r\nData added for node_access table for NID = $result->nid";
        fwrite($file, "\r\nData added for node_access table for NID = $result->nid");
    }
	print "\r\n\r\nCurrent Nodes Processed = $nodesProcessed";
	print "\r\n\r\n";
    
    $nodesProcessed++;
}
print "\r\n\r\nTotal Nodes Processed = $nodesProcessed";
print "\r\n\r\n";
fwrite($file, "\r\n\r\nTotal Nodes Processed = $nodesProcessed");
fclose($file);*/
?>
