<?PHP
/**															**\
		NEED TO WORK ON BRAND, SOLR, SITEMAP,  
\**															**/

echo "\n\n START - Entity Id Update \n\n";

// db_query("UPDATE {coupon_finder_march2nd.predictorCompiledResultTable} LEFT JOIN {coupon_finder_march2nd.field_data_field_base_url} ON coupon_finder_march2nd.field_data_field_base_url.field_base_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl SET coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_base_url.entity_id Where coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl = 'http://www.jabong.com/macroman-Assorted-Boxer-468481.html' ");

echo "\n\n END - Entity Id Update \n\n";

echo "\n\n APACHE SOLR - STATUS \n\n";
db_query ("UPDATE coupon_finder_march2nd.apachesolr_index_entities_node INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.apachesolr_index_entities_node.entity_id SET coupon_finder_march2nd.apachesolr_index_entities_node.status = 1 WHERE coupon_finder_march2nd.apachesolr_index_entities_node.entity_id = 173951 ");


echo "\n\n APACHE SOLR - CHANGED \n\n";
db_query ("UPDATE coupon_finder_march2nd.apachesolr_index_entities_node INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.apachesolr_index_entities_node.entity_id SET coupon_finder_march2nd.apachesolr_index_entities_node.changed = ".time()." WHERE coupon_finder_march2nd.apachesolr_index_entities_node.entity_id = 173951");




echo("\n\n CHANGED \n\n");
db_query ("UPDATE coupon_finder_march2nd.node INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node.nid SET coupon_finder_march2nd.node.changed = ".time()." WHERE coupon_finder_march2nd.node.nid = 173951");

echo("\n\n TITLE \n\n");
db_query ("UPDATE coupon_finder_march2nd.node INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node.nid SET coupon_finder_march2nd.node.title = coupon_finder_march2nd.predictorCompiledResultTable.pagetitle WHERE coupon_finder_march2nd.node.nid = 173951");

echo("\n\n STATUS \n\n");
db_query ("UPDATE coupon_finder_march2nd.node INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node.nid SET coupon_finder_march2nd.node.status = 1 WHERE coupon_finder_march2nd.node.nid = 173951");


echo("\n\n TIMESTAMP - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.node_revision INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node_revision.nid SET coupon_finder_march2nd.node_revision.timestamp = ".time()." WHERE coupon_finder_march2nd.node_revision.nid = 173951 ");

echo("\n\n TITLE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.node_revision INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node_revision.nid SET coupon_finder_march2nd.node_revision.title = coupon_finder_march2nd.predictorCompiledResultTable.pagetitle WHERE coupon_finder_march2nd.node_revision.nid = 173951");

echo("\n\n STATUS - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.node_revision INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.node_revision.nid SET coupon_finder_march2nd.node_revision.status = 1 WHERE coupon_finder_march2nd.node_revision.nid = 173951 ");


echo("\n\n FIELD_CATEGORY_TID \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_category INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_category.entity_id SET coupon_finder_march2nd.field_data_field_category.field_category_tid = coupon_finder_march2nd.predictorCompiledResultTable.Category WHERE coupon_finder_march2nd.field_data_field_category.entity_id = 173951 ");

echo("\n\n FIELD_CATEGORY_TID - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_category INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_category.entity_id SET coupon_finder_march2nd.field_revision_field_category.field_category_tid = coupon_finder_march2nd.predictorCompiledResultTable.Category WHERE coupon_finder_march2nd.field_revision_field_category.entity_id = 173951 ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_product_price INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_product_price.entity_id SET coupon_finder_march2nd.field_data_field_product_price.field_product_price_value = coupon_finder_march2nd.predictorCompiledResultTable.ListPrice WHERE coupon_finder_march2nd.field_data_field_product_price.entity_id = 173951 ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_product_price INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_product_price.entity_id SET coupon_finder_march2nd.field_revision_field_product_price.field_product_price_value = coupon_finder_march2nd.predictorCompiledResultTable.ListPrice WHERE coupon_finder_march2nd.field_revision_field_product_price.entity_id = 173951 ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_mrpproductprice INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_mrpproductprice.entity_id SET coupon_finder_march2nd.field_data_field_mrpproductprice.field_mrpproductprice_value = coupon_finder_march2nd.predictorCompiledResultTable.MRP WHERE coupon_finder_march2nd.field_data_field_mrpproductprice.entity_id = 173951 ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_mrpproductprice INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_mrpproductprice.entity_id SET coupon_finder_march2nd.field_revision_field_mrpproductprice.field_mrpproductprice_value = coupon_finder_march2nd.predictorCompiledResultTable.MRP WHERE coupon_finder_march2nd.field_revision_field_mrpproductprice.entity_id = 173951 ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_retailer_product_name INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_retailer_product_name.entity_id SET coupon_finder_march2nd.field_data_field_retailer_product_name.field_retailer_product_name_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductName WHERE coupon_finder_march2nd.field_data_field_retailer_product_name.entity_id = 173951 ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_retailer_product_name INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_retailer_product_name.entity_id SET coupon_finder_march2nd.field_revision_field_retailer_product_name.field_retailer_product_name_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductName WHERE coupon_finder_march2nd.field_revision_field_retailer_product_name.entity_id = 173951 ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_product_image INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_product_image.entity_id SET coupon_finder_march2nd.field_data_field_product_image.field_product_image_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductImage WHERE coupon_finder_march2nd.field_data_field_product_image.entity_id = 173951 ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_product_image INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_product_image.entity_id SET coupon_finder_march2nd.field_revision_field_product_image.field_product_image_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductImage WHERE coupon_finder_march2nd.field_revision_field_product_image.entity_id = 173951 ");

/*
echo("\n\n FIELD_BRAND_TID \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_brand INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_brand.entity_id SET coupon_finder_march2nd.field_data_field_brand.field_brand_tid = coupon_finder_march2nd.predictorCompiledResultTable. WHERE coupon_finder_march2nd.field_data_field_brand.entity_id = 173951 ");

echo("\n\n FIELD_BRAND_TID - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_brand INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_brand.entity_id SET coupon_finder_march2nd.field_revision_field_brand.field_brand_tid = coupon_finder_march2nd.predictorCompiledResultTable. WHERE coupon_finder_march2nd.field_revision_field_brand.entity_id = 173951 ");
*/

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_lastcheckedtime INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_lastcheckedtime.entity_id SET coupon_finder_march2nd.field_data_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder_march2nd.predictorCompiledResultTable.LastCheckTime WHERE coupon_finder_march2nd.field_data_field_lastcheckedtime.entity_id = 173951 ");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_lastcheckedtime INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_lastcheckedtime.entity_id SET coupon_finder_march2nd.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder_march2nd.predictorCompiledResultTable.LastCheckTime WHERE coupon_finder_march2nd.field_revision_field_lastcheckedtime.entity_id = 173951 ");

echo("\n\n FIELD_AFFILIATEURL_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_affiliateurl INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_affiliateurl.entity_id SET coupon_finder_march2nd.field_data_field_affiliateurl.field_affiliateurl_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl WHERE coupon_finder_march2nd.field_data_field_affiliateurl.entity_id = 173951 ");

echo("\n\n FIELD_AFFILIATEURL_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_affiliateurl INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_affiliateurl.entity_id SET coupon_finder_march2nd.field_revision_field_affiliateurl.field_affiliateurl_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl WHERE coupon_finder_march2nd.field_revision_field_affiliateurl.entity_id = 173951 ");

echo("\n\n BODY_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_body INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_body.entity_id SET coupon_finder_march2nd.field_data_body.body_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductName WHERE coupon_finder_march2nd.field_data_body.entity_id = 173951 ");

echo("\n\n BODY_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_body INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_body.entity_id SET coupon_finder_march2nd.field_revision_body.body_value = coupon_finder_march2nd.predictorCompiledResultTable.ProductName WHERE coupon_finder_march2nd.field_revision_body.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_couponcode INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_couponcode.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder_march2nd.predictorCompiledResultTable.BestCouponCode WHERE coupon_finder_march2nd.field_data_field_best_coupon_couponcode.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_couponcode INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_couponcode.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder_march2nd.predictorCompiledResultTable.BestCouponCode WHERE coupon_finder_march2nd.field_revision_field_best_coupon_couponcode.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_description INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_description.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_description.field_best_coupon_description_value = coupon_finder_march2nd.predictorCompiledResultTable.BestCouponDesc WHERE coupon_finder_march2nd.field_data_field_best_coupon_description.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_description INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_description.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_description.field_best_coupon_description_value = coupon_finder_march2nd.predictorCompiledResultTable.BestCouponDesc WHERE coupon_finder_march2nd.field_revision_field_best_coupon_description.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_saving INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_saving.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder_march2nd.predictorCompiledResultTable.Saving WHERE coupon_finder_march2nd.field_data_field_best_coupon_saving.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_saving INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_saving.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder_march2nd.predictorCompiledResultTable.Saving WHERE coupon_finder_march2nd.field_revision_field_best_coupon_saving.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_netpriceafters INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_netpriceafters.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder_march2nd.predictorCompiledResultTable.NetPrice WHERE coupon_finder_march2nd.field_data_field_best_coupon_netpriceafters.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_netpriceafters INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_netpriceafters.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder_march2nd.predictorCompiledResultTable.NetPrice WHERE coupon_finder_march2nd.field_revision_field_best_coupon_netpriceafters.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_status INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_status.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_status.field_best_coupon_status_value = coupon_finder_march2nd.predictorCompiledResultTable.BestCouponStatus WHERE coupon_finder_march2nd.field_data_field_best_coupon_status.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_url INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_url.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_url.field_best_coupon_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl WHERE coupon_finder_march2nd.field_data_field_best_coupon_url.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_url INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_url.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_url.field_best_coupon_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl WHERE coupon_finder_march2nd.field_data_field_best_coupon_url.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_url INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_url.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_url.field_best_coupon_url_value = coupon_finder_march2nd.predictorCompiledResultTable.BaseUrl WHERE coupon_finder_march2nd.field_revision_field_best_coupon_url.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_data_field_best_coupon_info INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_data_field_best_coupon_info.entity_id SET coupon_finder_march2nd.field_data_field_best_coupon_info.field_best_coupon_info_value = coupon_finder_march2nd.predictorCompiledResultTable.Result WHERE coupon_finder_march2nd.field_data_field_best_coupon_info.entity_id = 173951 ");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE  - REVISION \n\n");
db_query ("UPDATE coupon_finder_march2nd.field_revision_field_best_coupon_info INNER JOIN coupon_finder_march2nd.predictorCompiledResultTable ON coupon_finder_march2nd.predictorCompiledResultTable.entity_id = coupon_finder_march2nd.field_revision_field_best_coupon_info.entity_id SET coupon_finder_march2nd.field_revision_field_best_coupon_info.field_best_coupon_info_value = coupon_finder_march2nd.predictorCompiledResultTable.Result WHERE coupon_finder_march2nd.field_revision_field_best_coupon_info.entity_id = 173951 ");

?>
