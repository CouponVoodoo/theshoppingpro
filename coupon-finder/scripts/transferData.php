<?php
$i = 0;
	$tables = array("predictorCompiledResultTable", "predictorCompiledResultTableAmazon", "predictorCompiledResultTableFlipkart", "predictorCompiledResultTableSnapdeal");
	
	for($x=0;$x<count($tables);$x++) {
	
	$table=$tables[$x];
	echo $table;
	$Query = db_select('1Variables', 'b')
				 ->fields('b', array('Status') )
				 ->condition('b.Variable', 'Insert_'.$table, '=');
	$run_check = $Query->execute();
	$run_check_fetch = $run_check->fetch();
	$isFirstRun = $run_check_fetch->Status;
	
 
	$run = 1;
    echo $isFirstRun;
	If ($isFirstRun == 1) {
	    $dmp=$table."Dmp";
		db_query("Truncate table coupon_finder.".$dmp);
		db_query("insert into coupon_finder.".$dmp." select * from coupon_finder.".$table);
		db_query("Truncate table coupon_finder.".$table);
		db_query("UPDATE coupon_finder.1Variables SET Status = 2, Ref_Value = '".gmdate('Y-m-d\TH:i:s\Z', time())."' WHERE Variable = 'Insert_'".$table);
	}

	
	If ($isFirstRun == 2  ) {
	    
		return 'dont run';
		exit;
	}
	
	while ($run ==1) {
		$i++;
		$url = "http://54.243.150.171/cpnVodo/SimulationWithoutAutomatn/pustToMySql.php?q=".$table; //The API TO GET ALL RETAILER COUPON DATA 
		$json = drupal_http_request($url, array('timeout' => 1200.0));
		//var_dump($json);
		$json = $json->data;
		if ($json != 'null') {
			if ($i == 1) {mail('team@theshoppingpro.com', 'Data Push Start for '.$table, gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600))));}
			$jsonArr = json_decode($json,true);
			foreach($jsonArr as $json){ 
				$json = json_encode($json); 
				$jsonData = preg_replace("/[\\n\\r]+/", " ", $json);
				$jsonArray = json_decode($jsonData);
			
				$id= trim($jsonArray->id);
				$baseUrl= trim($jsonArray->BaseUrl);
				$listPrice= trim($jsonArray->listPrice);
				$MRP= trim($jsonArray->MRP);
				$Saving= trim($jsonArray->Saving);
				$NetPrice= trim($jsonArray->NetPrice);
				$BestCouponCode= trim($jsonArray->BestCouponCode);
				$BestCouponDesc= trim($jsonArray->BestCouponDesc);
				$result= trim($jsonArray->result);
				$entity_id= null;
				$brand= trim($jsonArray->brand);
				$ProductName= trim($jsonArray->ProductName);
				$ProductImage= trim($jsonArray->ProductImage);
				$Category= trim($jsonArray->Category);
				$LastCheckTime= trim($jsonArray->LastCheckTime);
				$pagetitle= trim($jsonArray->pagetitle);
				$BestCouponStatus= trim($jsonArray->BestCouponStatus);
				$BrandId= null;
				$loc= null;
				$retailer= trim($jsonArray->retailer);
				$retailerId= trim($jsonArray->retailerId);
				$bestCouponDisplay= trim($jsonArray->bestCouponDisplay);
				$uniq=trim($jsonArray->uniq);
				$nid = db_insert('predictorCompiledResultTable') // Table name no longer needs {}
				->fields(array(
				  'id' => $id,
				  'BaseUrl' => $baseUrl,
				  'ListPrice' => $listPrice,
				  'MRP' => $MRP,
				  'Saving' => $Saving,
				  'NetPrice' => $NetPrice,
				  'BestCouponCode' => $BestCouponCode,
				  'BestCouponDesc' => $BestCouponDesc,
				  'Result' => $result,
				  'entity_id' => $entity_id,
				  'Brand' => $brand,
				  'ProductName' => $ProductName,
				  'ProductImage' => $ProductImage,
				  'Category' => $Category,
				  'LastCheckTime' => $LastCheckTime,
				  'pagetitle' => $pagetitle,
				  'BestCouponStatus' => $BestCouponStatus,
				  'BrandId' => $BrandId,
				  'loc' => $loc,
				  'Retailer' => $retailer,
				  'RetailerId' => $retailerId,
				  'BestCouponDisplay' => $bestCouponDisplay,
				  'uniq'=>$uniq,
				))
				->execute();
				
			}
		} Else {
			// no urls to process
			$run = 0;
			if($i!=1) {
				mail('team@theshoppingpro.com', 'Data Push Ended With '.$i.' loops', gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600))));
				db_query("UPDATE coupon_finder.1Variables SET Status = 1, Ref_Value = '".gmdate('Y-m-d\TH:i:s\Z', time())."' WHERE Variable = 'Update_'".$table);
				db_query("UPDATE coupon_finder.1Variables SET Status = 3, Ref_Value = '".gmdate('Y-m-d\TH:i:s\Z', time())."' WHERE Variable = 'Insert_'".$table); 
		//		exit;
			} else {
				//mail('team@theshoppingpro.com', 'Data Push Did Not Run', gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600))));
			}
		}
}
}