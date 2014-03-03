<?php

$results = db_select('node', 'n')->fields('n', array('nid'))
        ->condition('nid', 13825)
        ->execute()->fetchAll();
$nodesProcessed = 0;
foreach ($results as $result) {
    print "\r\n\r\nNode being processed = $result->nid";
    
    // Check if entry exists in domain_access.
    $ifDomainExists = db_select('domain_access', 'da')->condition('gid', 0)->condition('realm', 'domain_site')
            ->condition('nid', $result->nid)->countQuery()->execute()->fetchField();

    if ($ifDomainExists == 0) {
        // Insert into Domain Access Table
        db_insert('domain_access')
                ->fields(array(
                    'nid' => $result->nid,
                    'gid' => 0,
                    'realm' => 'domain_site'
                ))
                ->execute();
        print "\r\nData added for domain_access table for NID = $result->nid";
    }
    
    // Check if entry exists in node_access.
    $ifNodeExists = db_select('node_access', 'na')->condition('gid', 0)->condition('realm', 'domain_site')
            ->condition('nid', $result->nid)->countQuery()->execute()->fetchField();
    
    if ($ifNodeExists == 0) {
        // Insert into Node Access Table
        db_insert('node_access')
                ->fields(array(
                    'nid' => $result->nid,
                    'gid' => 0,
                    'realm' => 'domain_site',
                    'grant_view' => 1,
                    'grant_update' => 1,
                    'grant_delete' => 1
                ))
                ->execute();
        print "\r\nData added for node_access table for NID = $result->nid";
    }
    
    $nodesProcessed++;
}
print  "\r\n\r\nTotal Nodes Processsed = $nodesProcessed";
?>
