<?PHP

echo 'start';
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");

// db_query("UPDATE {predictorCompiledResultTable} LEFT JOIN {field_data_field_base_url} ON field_data_field_base_url.field_base_url_value = predictorCompiledResultTable.BaseUrl SET predictorCompiledResultTable.entity_id = field_data_field_base_url.entity_id Where predictorCompiledResultTable.BaseUrl = 'http://www.myntra.com/casual-shoes/puma/puma-men-grey-lazy-slip-on-casual-shoes/244952/buy' ");

$return = db_query("SELECT * FROM {coupon_finder_march2nd.predictorCompiledResultTable} LIMIT 1");
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");

// db_select('predictorCompiledResultTable', 'pcrt')->fields('pcrt')->execute()->fetchAll();

var_dump($return->fetchAll());
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");

echo 'without fetchall';
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");
echo nl2br("/n");
var_dump($return);
echo nl2br("/n");
echo nl2br("/n");


?>
