<?PHP

echo 'start';
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");

db_query("UPDATE {coupon_finder_march2nd.predictorCompiledResultTable} LEFT JOIN {coupon_finder_march2nd.field_data_field_base_url} ON coupon_finder_march2nd.field_data_field_base_url.field_base_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl SET coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_base_url.entity_id Where coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl = 'http://www.jabong.com/macroman-Assorted-Boxer-468481.html' ");

//$return = db_query("SELECT * FROM {coupon_finder_march2nd.predictorCompiledResultTable} LIMIT 1");
echo 'END';
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
echo nl2br("\n");
// db_select('predictorCompiledResultTable', 'pcrt')->fields('pcrt')->execute()->fetchAll();


/*
// update entity id in predictor based on base url

UPDATE coupon_finder_march2nd.predictorCompiledResultTable
LEFT JOIN coupon_finder_march2nd.field_data_field_base_url
ON coupon_finder_march2nd.field_data_field_base_url.field_base_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl 
SET coupon_finder_march2nd.predictorCompiledResultTable.entity_id = 'coupon_finder_march2nd.field_data_field_base_url.entity_id'


// update mrp based on predictor table

UPDATE coupon_finder_march2nd.field_data_field_mrpproductprice
INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable
ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_mrpproductprice.entity_id 
SET coupon_finder_march2nd.field_data_field_mrpproductprice.field_mrpproductprice_value = coupon_finder_march2nd.predictorCompiledResultTable.MRP








*/


?>
