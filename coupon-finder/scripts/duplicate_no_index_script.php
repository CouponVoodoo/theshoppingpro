<?PHP
$results = db_query("SELECT GROUP_CONCAT(CONCAT(lc.`entity_id`,':',lc.`field_lastcheckedtime_value`) SEPARATOR  ',' ) last_checked_time,GROUP_CONCAT( i.`field_no_index_value` SEPARATOR  ',' ) index_check,COUNT( pn.`entity_id` ) num, GROUP_CONCAT( pn.`entity_id` SEPARATOR  ',' ) NIDlist, pn.`field_retailer_product_name_value` , r.`field_retailer_tid` FROM  {field_data_field_retailer_product_name} pn INNER JOIN {field_data_field_retailer} r ON pn.`entity_id` = r.`entity_id` inner join {field_data_field_lastcheckedtime} lc on lc.`entity_id` = r.`entity_id` left join {field_data_field_no_index}  i on lc.`entity_id` = i.`entity_id` where  i.`field_no_index_value` is null or i.`field_no_index_value` = 0  GROUP BY pn.`field_retailer_product_name_value` , r.`field_retailer_tid` HAVING num >1");

foreach ($results as $result) {
	$i=0;
	echo "\n";
	echo 'counter: '.$i;
	echo "\n";
	echo 'counter: '.$i;
	echo "\n";
	echo 'counter: '.$i;
	echo "\n";
	echo '--------------------------------------------------';
	
	$sets = explode(",",$result->last_checked_time);
	// echo 'run:'.$i;
	// print_r($sets);
	$nid_last_checked_pairs = array();
	foreach ($sets as $set) {
		$split_array = explode(":",$set);
		$nid = $split_array[0];
		$last_checked_time = $split_array[1];
		$nid_last_checked_pairs[$nid] = $last_checked_time;
		// print_r ($array);
	}
	arsort($nid_last_checked_pairs);
	echo "\n";
	echo '--------------------------------------------------';
	echo 'nid_last_checked_pairs:';	
	print_r($nid_last_checked_pairs);
	$latest_nid = key($nid_last_checked_pairs);
	echo "\n";
	echo '--------------------------------------------------';
	echo 'latest nid:';
	echo "\n";
	print_r($latest_nid);
	$nids = array_keys($nid_last_checked_pairs);
	foreach ($nids as $nid) {
		if ($nid == $latest_nid) {
			echo 'ignore'.$nid;
			echo "\n";
			echo "\n";
		} else {
			echo 'modify'.$nid;
			echo nl2br("\n");
			$no_index_query = "SELECT * FROM {field_data_field_no_index} i where i.entity_id= :entity_id and i.bundle = '_product_and_coupon' and i.entity_type = 'node'";
			$count = db_query($no_index_query, array(':entity_id' => $nid));
			if($count->rowCount()==0){
				echo 'insert';
				echo "\n";
				echo "\n";
				$insertQuery = db_insert('field_data_field_no_index') // Table name no longer needs {}
					->fields(array(
					  'entity_type' => 'node',
					  'bundle' => '_product_and_coupon',
					  'deleted' => 0,
					  'entity_id' => $nid,
					  'revision_id' => $nid,
					  'language' => 'und',
					  'delta' => 0,
					  'field_no_index_value' => 1,
					))
					->execute();
				
				$insertQuery = db_insert('field_revision_field_no_index') // Table name no longer needs {}
					->fields(array(
					  'entity_type' => 'node',
					  'bundle' => '_product_and_coupon',
					  'deleted' => 0,
					  'entity_id' => $nid,
					  'revision_id' => $nid,
					  'language' => 'und',
					  'delta' => 0,
					  'field_no_index_value' => 1,
					))
					->execute();
					
					
					
			} else {
				echo 'update';
				echo "\n";
				db_update('field_data_field_no_index')
					->expression('field_no_index_value',1)
					->condition('entity_id', $nid)
					->execute();

				db_update('field_revision_field_no_index')
					->expression('field_no_index_value',1)
					->condition('entity_id', $nid)
					->execute();
			}
			$sitemap_removal_query = "SELECT * FROM {xmlsitemap} i where i.id= :entity_id and i.type = 'node' and i.subtype = '_product_and_coupon'";
			$sm_count = db_query($sitemap_removal_query, array(':entity_id' => $nid));
			if($sm_count->rowCount()==0){
				echo 'sm_insert';
				echo "\n";
				echo "\n";
				$insertQuery = db_insert('xmlsitemap') // Table name no longer needs {}
					->fields(array(
					  'id' => $nid,
					  'type' => 'node',
					  'subtype' => '_product_and_coupon ',
					  'loc' => 'node/'.$nid,
					  'language' => 'und',
					  'access' => 1,
					  'status' => 0,
					  'status_override' => 1,
					  // 'lastmod' =>  time(),
					  'priority' => 0.1,
					  'priority_override' => 1,
					  // 'changefreq' => 0,
					  // 'changecount' => 0,
					))
					->execute();
				
			} else {
				echo 'sm_update';
				echo "\n";
				echo "\n";
				db_update('xmlsitemap')
				  ->fields(array(
					'status' => 0,
					'status_override' => 1,
					'priority' => 0.1,
					'priority_override' => 1,
				  ))
				  ->condition('id', $nid)
				  ->execute();
			}
			$result_store_query = "SELECT * FROM {no_index_results} i where i.Modified_NID= :entity_id";
			$result_count = db_query($result_store_query, array(':entity_id' => $nid));
			if($result_count->rowCount()==0){
				echo 'result_insert';
				echo "\n";
				echo "\n";
				$insertQuery = db_insert('no_index_results') // Table name no longer needs {}
					->fields(array(
					  'Modified_NID' => $nid,
					  'Kept_NID' => $latest_nid,
					  'Modified_On' => time(),
					))
					->execute();
			} else {
				echo 'result_update';
				echo "\n";
				echo "\n";
					db_update('no_index_results')
					  ->fields(array(
						  'Modified_NID' => $nid,
						  'Kept_NID' => $latest_nid,
						  'Modified_On' => time(),
					  ))
					  ->condition('Modified_NID', $nid)
					  ->execute();
			}			
			
		
		}

	echo '--------------------------------------------------';
	echo "\n";
	echo "\n";
	$i=$i+1;
	if ($i>25){
		exit;
	}
}

	

}

?>
