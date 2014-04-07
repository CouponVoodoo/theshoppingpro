<?PHP

echo 'start';

// db_query("UPDATE {predictorCompiledResultTable} LEFT JOIN {field_data_field_base_url} ON field_data_field_base_url.field_base_url_value = predictorCompiledResultTable.BaseUrl SET predictorCompiledResultTable.entity_id = field_data_field_base_url.entity_id Where predictorCompiledResultTable.BaseUrl = 'http://www.myntra.com/casual-shoes/puma/puma-men-grey-lazy-slip-on-casual-shoes/244952/buy' ");

// $return = db_query("SELECT * FROM {predictorCompiledResultTable} LIMIT 1");

db_select('predictorCompiledResultTable', 'pcrt')->fields('pcrt')->execute()->fetchAll();

//var_dump($return->fetchAll());

echo 'end';

?>
