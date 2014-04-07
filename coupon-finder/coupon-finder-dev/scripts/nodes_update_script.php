<?PHP
//db_query("SELECT GROUP_CONCAT(CONCAT(lc.`entity_id`,':',lc.`field_lastcheckedtime_value`) SEPARATOR  ',' ) last_checked_time,GROUP_CONCAT( i.`field_no_index_value` SEPARATOR  ',' ) index_check,COUNT( pn.`entity_id` ) num, GROUP_CONCAT( pn.`entity_id` SEPARATOR  ',' ) NIDlist, pn.`field_retailer_product_name_value` , r.`field_retailer_tid` FROM  {field_data_field_retailer_product_name} pn INNER JOIN {field_data_field_retailer} r ON pn.`entity_id` = r.`entity_id` inner join {field_data_field_lastcheckedtime} lc on lc.`entity_id` = r.`entity_id` left join {field_data_field_no_index}  i on lc.`entity_id` = i.`entity_id` where  i.`field_no_index_value` is null or i.`field_no_index_value` = 0  GROUP BY pn.`field_retailer_product_name_value` , r.`field_retailer_tid` HAVING num >1");
echo 'start';

// db_query("UPDATE {predictorCompiledResultTable} LEFT JOIN {field_data_field_base_url} ON field_data_field_base_url.field_base_url_value = predictorCompiledResultTable.BaseUrl SET predictorCompiledResultTable.entity_id = field_data_field_base_url.entity_id Where predictorCompiledResultTable.BaseUrl = 'http://www.myntra.com/casual-shoes/puma/puma-men-grey-lazy-slip-on-casual-shoes/244952/buy' ");

$return = db_query("SELECT * FROM {predictorCompiledResultTable} LIMIT 1");

var_dump($return->fetchAll());

echo 'end';

?>
