<?PHP
/**																			**\
* PROCESS HIGHLIGHT:
* - GET ENTITY ID INTO PREDICTOR TABLE USING BASEURL
* - CONVERT BRAND NAME TO BRAND ID IN PREDICTOR TABLE
* - UPDATE VALUE OF LOCATION IN PREDICTOR TABLE (TO BE USED FOR SITEMAP)
* - UPDATE APACHE SOLR CHANGE FREQ & LASTMOD
* - UPDATE ALL NODE VALUE FIELDS ONE BY ONE INCLUDING SETTING NODE STATUS TO 1

 
\**																			**/


echo "\n\n START - Entity Id Update \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.field_data_field_base_url ON coupon_finder.field_data_field_base_url.field_base_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl SET coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_base_url.entity_id ");
echo "\n\n END - Entity Id Update \n\n".time();

echo "\n\n BRAND - GETTING TID FROM NAME \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.taxonomy_term_data ON coupon_finder.taxonomy_term_data.name = coupon_finder.predictorCompiledResultTable.Brand SET coupon_finder.predictorCompiledResultTable.BrandId = coupon_finder.taxonomy_term_data.tid ");

echo "\n\n UPDATE LOCATION \n\n".time();
db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.loc = concat('node/',CAST(coupon_finder.predictorCompiledResultTable.entity_id as CHAR(50))) ");

echo "\n\n XML SITEMAP SOLR - LAST MODIFIED \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));

echo "\n\n XML SITEMAP SOLR - CHANGE FREQUENCY \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");

echo("\n\n CHANGED \n\n").time();
db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.changed = ".(time()+(4.5*3600)));

// echo("\n\n TITLE \n\n").time();
// db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.title = coupon_finder.predictorCompiledResultTable.pagetitle ");

echo("\n\n STATUS \n\n").time();
db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.status = 1 ");

echo("\n\n TIMESTAMP - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.timestamp = ".time());

// echo("\n\n TITLE - REVISION \n\n").time();
// db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.title = coupon_finder.predictorCompiledResultTable.pagetitle ");

echo("\n\n STATUS - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.status = 1 ");

echo("\n\n FIELD_CATEGORY_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_category INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_category.entity_id SET coupon_finder.field_data_field_category.field_category_tid = coupon_finder.predictorCompiledResultTable.Category ");

echo("\n\n FIELD_CATEGORY_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_category INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_category.entity_id SET coupon_finder.field_revision_field_category.field_category_tid = coupon_finder.predictorCompiledResultTable.Category ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_price INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_product_price.entity_id SET coupon_finder.field_data_field_product_price.field_product_price_value = coupon_finder.predictorCompiledResultTable.ListPrice ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_price INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_product_price.entity_id SET coupon_finder.field_revision_field_product_price.field_product_price_value = coupon_finder.predictorCompiledResultTable.ListPrice ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_mrpproductprice INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_mrpproductprice.entity_id SET coupon_finder.field_data_field_mrpproductprice.field_mrpproductprice_value = coupon_finder.predictorCompiledResultTable.MRP ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_mrpproductprice INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_mrpproductprice.entity_id SET coupon_finder.field_revision_field_mrpproductprice.field_mrpproductprice_value = coupon_finder.predictorCompiledResultTable.MRP ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer_product_name INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_retailer_product_name.entity_id SET coupon_finder.field_data_field_retailer_product_name.field_retailer_product_name_value = coupon_finder.predictorCompiledResultTable.ProductName ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer_product_name INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_retailer_product_name.entity_id SET coupon_finder.field_revision_field_retailer_product_name.field_retailer_product_name_value = coupon_finder.predictorCompiledResultTable.ProductName ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_image INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_product_image.entity_id SET coupon_finder.field_data_field_product_image.field_product_image_value = coupon_finder.predictorCompiledResultTable.ProductImage ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_image INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_product_image.entity_id SET coupon_finder.field_revision_field_product_image.field_product_image_value = coupon_finder.predictorCompiledResultTable.ProductImage ");

echo("\n\n FIELD_BRAND_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_brand INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_brand.entity_id SET coupon_finder.field_data_field_brand.field_brand_tid = coupon_finder.predictorCompiledResultTable.BrandId ");

echo("\n\n FIELD_BRAND_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_brand INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_brand.entity_id SET coupon_finder.field_revision_field_brand.field_brand_tid = coupon_finder.predictorCompiledResultTable.BrandId ");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_lastcheckedtime.entity_id SET coupon_finder.field_data_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime ");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_lastcheckedtime.entity_id SET coupon_finder.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime ");

echo("\n\n FIELD_AFFILIATEURL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_affiliateurl INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_affiliateurl.entity_id SET coupon_finder.field_data_field_affiliateurl.field_affiliateurl_value = coupon_finder.predictorCompiledResultTable.BaseUrl ");

echo("\n\n FIELD_AFFILIATEURL_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_affiliateurl INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_affiliateurl.entity_id SET coupon_finder.field_revision_field_affiliateurl.field_affiliateurl_value = coupon_finder.predictorCompiledResultTable.BaseUrl ");

echo("\n\n BODY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_body INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_body.entity_id SET coupon_finder.field_data_body.body_value = coupon_finder.predictorCompiledResultTable.ProductName ");

echo("\n\n BODY_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_body INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_body.entity_id SET coupon_finder.field_revision_body.body_value = coupon_finder.predictorCompiledResultTable.ProductName ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_couponcode.entity_id SET coupon_finder.field_data_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTable.BestCouponCode ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_couponcode.entity_id SET coupon_finder.field_revision_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTable.BestCouponCode ");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_description.entity_id SET coupon_finder.field_data_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTable.BestCouponDesc ");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_description.entity_id SET coupon_finder.field_revision_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTable.BestCouponDesc ");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_saving.entity_id SET coupon_finder.field_data_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTable.Saving ");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_saving.entity_id SET coupon_finder.field_revision_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTable.Saving ");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_data_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTable.NetPrice ");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE  - REVISION \n\n".time());
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_revision_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTable.NetPrice ");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_status.entity_id SET coupon_finder.field_data_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTable.BestCouponStatus ");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_status.entity_id SET coupon_finder.field_revision_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTable.BestCouponStatus");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_status_display.entity_id SET coupon_finder.field_data_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTable.BestCouponDisplay ");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_status_display.entity_id SET coupon_finder.field_revision_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTable.BestCouponDisplay");


echo("\n\n FIELD_BEST_COUPON_URL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_url INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_url.entity_id SET coupon_finder.field_data_field_best_coupon_url.field_best_coupon_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl ");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_url INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_url.entity_id SET coupon_finder.field_revision_field_best_coupon_url.field_best_coupon_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl ");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_info.entity_id SET coupon_finder.field_data_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result ");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_info.entity_id SET coupon_finder.field_revision_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result ");


echo("\n\n field_data_field_retailer \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_retailer.entity_id SET coupon_finder.field_data_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId");

echo("\n\n field_data_field_retailer - revision \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_retailer.entity_id SET coupon_finder.field_revision_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId");

echo("\n\n FLUSH ALL CACHE \n\n").time();
cache_clear_all();

echo "\n\n APACHE SOLR - STATUS \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.status = 1 ");

echo "\n\n APACHE SOLR - CHANGED \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.changed = ".(time()+(4.5*3600)));

echo("\n\n FINISHED \n\n").time();



/**                                              	**\

		TO MAKE ALL TARGET COLUMNS NULL FOR TESTING

\**													**/
/*
echo "\n\n START - Entity Id Update \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.entity_id = NULL");
echo "\n\n END - Entity Id Update \n\n".time();

echo "\n\n BRAND - GETTING TID FROM NAME \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.BrandId = NULL ");

echo "\n\n UPDATE LOCATION \n\n".time();
db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.loc = NULL ");

echo "\n\n XML SITEMAP SOLR - LAST MODIFIED \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap SET coupon_finder.xmlsitemap.lastmod = 1396942501");

echo "\n\n XML SITEMAP SOLR - CHANGE FREQUENCY \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap SET coupon_finder.xmlsitemap.changefreq = 604800 ");

echo "\n\n APACHE SOLR - STATUS \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node SET coupon_finder.apachesolr_index_entities_node.status = NULL ");

echo "\n\n APACHE SOLR - CHANGED \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node SET coupon_finder.apachesolr_index_entities_node.changed = NULL");

echo("\n\n CHANGED \n\n").time();
db_query ("UPDATE coupon_finder.node SET coupon_finder.node.changed = 1396942501");

echo("\n\n TITLE \n\n").time();
db_query ("UPDATE coupon_finder.node SET coupon_finder.node.title = 'abc' ");

echo("\n\n STATUS \n\n").time();
db_query ("UPDATE coupon_finder.node SET coupon_finder.node.status = 1 ");

echo("\n\n TIMESTAMP - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision SET coupon_finder.node_revision.timestamp = 1396942501");

echo("\n\n TITLE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision SET coupon_finder.node_revision.title = 'ABCD'");

echo("\n\n STATUS - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision SET coupon_finder.node_revision.status = 1 ");

echo("\n\n FIELD_CATEGORY_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_category SET coupon_finder.field_data_field_category.field_category_tid = NULL ");

echo("\n\n FIELD_CATEGORY_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_category SET coupon_finder.field_revision_field_category.field_category_tid = NULL ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_price SET coupon_finder.field_data_field_product_price.field_product_price_value = NULL ");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_price SET coupon_finder.field_revision_field_product_price.field_product_price_value = NULL ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_mrpproductprice SET coupon_finder.field_data_field_mrpproductprice.field_mrpproductprice_value = NULL ");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_mrpproductprice SET coupon_finder.field_revision_field_mrpproductprice.field_mrpproductprice_value = NULL ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer_product_name SET coupon_finder.field_data_field_retailer_product_name.field_retailer_product_name_value = NULL ");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer_product_name  SET coupon_finder.field_revision_field_retailer_product_name.field_retailer_product_name_value = NULL ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_image SET coupon_finder.field_data_field_product_image.field_product_image_value = NULL ");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_image SET coupon_finder.field_revision_field_product_image.field_product_image_value = NULL");

echo("\n\n FIELD_BRAND_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_brand SET coupon_finder.field_data_field_brand.field_brand_tid = NULL ");

echo("\n\n FIELD_BRAND_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_brand SET coupon_finder.field_revision_field_brand.field_brand_tid = NULL");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_lastcheckedtime SET coupon_finder.field_data_field_lastcheckedtime.field_lastcheckedtime_value = NULL");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_lastcheckedtime SET coupon_finder.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = NULL ");

echo("\n\n FIELD_AFFILIATEURL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_affiliateurl SET coupon_finder.field_data_field_affiliateurl.field_affiliateurl_value = NULL");

echo("\n\n FIELD_AFFILIATEURL_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_affiliateurl SET coupon_finder.field_revision_field_affiliateurl.field_affiliateurl_value = NULL ");

echo("\n\n BODY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_body SET coupon_finder.field_data_body.body_value = NULL ");

echo("\n\n BODY_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_body SET coupon_finder.field_revision_body.body_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_couponcode SET coupon_finder.field_data_field_best_coupon_couponcode.field_best_coupon_couponcode_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_couponcode SET coupon_finder.field_revision_field_best_coupon_couponcode.field_best_coupon_couponcode_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_description SET coupon_finder.field_data_field_best_coupon_description.field_best_coupon_description_value = NULL");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_description SET coupon_finder.field_revision_field_best_coupon_description.field_best_coupon_description_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_saving SET coupon_finder.field_data_field_best_coupon_saving.field_best_coupon_saving_value = NULL");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_saving SET coupon_finder.field_revision_field_best_coupon_saving.field_best_coupon_saving_value =NULL");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_netpriceafters SET coupon_finder.field_data_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE  - REVISION \n\n".time());
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_netpriceafters SET coupon_finder.field_revision_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status SET coupon_finder.field_data_field_best_coupon_status.field_best_coupon_status_value = NULL");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_url SET coupon_finder.field_data_field_best_coupon_url.field_best_coupon_url_value = NULL ");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status_display SET coupon_finder.field_data_field_best_coupon_status_display.field_best_coupon_status_value = NULL");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status_display SET coupon_finder.field_revision_field_best_coupon_status_display.field_best_coupon_status_value = NULL");


echo("\n\n FIELD_BEST_COUPON_URL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_url SET coupon_finder.field_data_field_best_coupon_url.field_best_coupon_url_value = NULL");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_url SET coupon_finder.field_revision_field_best_coupon_url.field_best_coupon_url_value = NULL");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_info SET coupon_finder.field_data_field_best_coupon_info.field_best_coupon_info_value = NULL");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_info SET coupon_finder.field_revision_field_best_coupon_info.field_best_coupon_info_value = NULL");

echo("\n\n field_data_field_retailer \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer SET coupon_finder.field_data_field_retailer.field_retailer_tid   = NULL");

echo("\n\n field_data_field_retailer - revision \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer SET coupon_finder.field_revision_field_retailer.field_retailer_tid   = NULL");

echo("\n\n FLUSH ALL CACHE \n\n").time();
cache_clear_all();

echo("\n\n FINISHED \n\n").time();
*/

/**                                              	**\

		TO LIMIT CHANGES TO ONE ROW FOR TESTING

\**													**/
/*
echo "\n\n START - Entity Id Update \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.field_data_field_base_url ON coupon_finder.field_data_field_base_url.field_base_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl SET coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_base_url.entity_id ");
echo "\n\n END - Entity Id Update \n\n".time();

echo "\n\n BRAND - GETTING TID FROM NAME \n\n".time();
db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.taxonomy_term_data ON coupon_finder.taxonomy_term_data.name = coupon_finder.predictorCompiledResultTable.Brand SET coupon_finder.predictorCompiledResultTable.BrandId = coupon_finder.taxonomy_term_data.tid ");

echo "\n\n UPDATE LOCATION \n\n".time();
db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.loc = concat('node/',CAST(coupon_finder.predictorCompiledResultTable.entity_id as CHAR(50))) ");

echo "\n\n XML SITEMAP SOLR - LAST MODIFIED \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600))." WHERE coupon_finder.predictorCompiledResultTable.loc = 'node/197758'");

echo "\n\n XML SITEMAP SOLR - CHANGE FREQUENCY \n\n".time();
db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 WHERE coupon_finder.predictorCompiledResultTable.loc = 'node/197758'");

echo "\n\n APACHE SOLR - STATUS \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.status = 1 WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo "\n\n APACHE SOLR - CHANGED \n\n".time();
db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.changed = ".(time()+(4.5*3600))." WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n CHANGED \n\n").time();
db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.changed = ".(time()+(4.5*3600))." WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n TITLE \n\n").time();
db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.title = coupon_finder.predictorCompiledResultTable.pagetitle WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n STATUS \n\n").time();
db_query ("UPDATE coupon_finder.node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node.nid SET coupon_finder.node.status = 1 WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n TIMESTAMP - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.timestamp = ".(time()+(4.5*3600))." WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n TITLE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.title = coupon_finder.predictorCompiledResultTable.pagetitle WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n STATUS - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.node_revision INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.node_revision.nid SET coupon_finder.node_revision.status = 1 WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_CATEGORY_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_category INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_category.entity_id SET coupon_finder.field_data_field_category.field_category_tid = coupon_finder.predictorCompiledResultTable.Category WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_CATEGORY_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_category INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_category.entity_id SET coupon_finder.field_revision_field_category.field_category_tid = coupon_finder.predictorCompiledResultTable.Category WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_price INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_product_price.entity_id SET coupon_finder.field_data_field_product_price.field_product_price_value = coupon_finder.predictorCompiledResultTable.ListPrice WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_PRODUCT_PRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_price INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_product_price.entity_id SET coupon_finder.field_revision_field_product_price.field_product_price_value = coupon_finder.predictorCompiledResultTable.ListPrice WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_mrpproductprice INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_mrpproductprice.entity_id SET coupon_finder.field_data_field_mrpproductprice.field_mrpproductprice_value = coupon_finder.predictorCompiledResultTable.MRP WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_MRPPRODUCTPRICE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_mrpproductprice INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_mrpproductprice.entity_id SET coupon_finder.field_revision_field_mrpproductprice.field_mrpproductprice_value = coupon_finder.predictorCompiledResultTable.MRP WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer_product_name INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_retailer_product_name.entity_id SET coupon_finder.field_data_field_retailer_product_name.field_retailer_product_name_value = coupon_finder.predictorCompiledResultTable.ProductName WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_RETAILER_PRODUCT_NAME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer_product_name INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_retailer_product_name.entity_id SET coupon_finder.field_revision_field_retailer_product_name.field_retailer_product_name_value = coupon_finder.predictorCompiledResultTable.ProductName WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_product_image INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_product_image.entity_id SET coupon_finder.field_data_field_product_image.field_product_image_value = coupon_finder.predictorCompiledResultTable.ProductImage WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_PRODUCT_IMAGE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_product_image INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_product_image.entity_id SET coupon_finder.field_revision_field_product_image.field_product_image_value = coupon_finder.predictorCompiledResultTable.ProductImage WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BRAND_TID \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_brand INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_brand.entity_id SET coupon_finder.field_data_field_brand.field_brand_tid = coupon_finder.predictorCompiledResultTable.BrandId WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BRAND_TID - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_brand INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_brand.entity_id SET coupon_finder.field_revision_field_brand.field_brand_tid = coupon_finder.predictorCompiledResultTable.BrandId WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_lastcheckedtime.entity_id SET coupon_finder.field_data_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_lastcheckedtime.entity_id SET coupon_finder.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_AFFILIATEURL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_affiliateurl INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_affiliateurl.entity_id SET coupon_finder.field_data_field_affiliateurl.field_affiliateurl_value = coupon_finder.predictorCompiledResultTable.BaseUrl WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_AFFILIATEURL_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_affiliateurl INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_affiliateurl.entity_id SET coupon_finder.field_revision_field_affiliateurl.field_affiliateurl_value = coupon_finder.predictorCompiledResultTable.BaseUrl WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n BODY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_body INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_body.entity_id SET coupon_finder.field_data_body.body_value = coupon_finder.predictorCompiledResultTable.ProductName WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n BODY_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_body INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_body.entity_id SET coupon_finder.field_revision_body.body_value = coupon_finder.predictorCompiledResultTable.ProductName WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_couponcode.entity_id SET coupon_finder.field_data_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTable.BestCouponCode WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_couponcode.entity_id SET coupon_finder.field_revision_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTable.BestCouponCode WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_description.entity_id SET coupon_finder.field_data_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTable.BestCouponDesc WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_description.entity_id SET coupon_finder.field_revision_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTable.BestCouponDesc WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_saving.entity_id SET coupon_finder.field_data_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTable.Saving WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_saving.entity_id SET coupon_finder.field_revision_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTable.Saving WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_data_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTable.NetPrice WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE  - REVISION \n\n".time());
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_revision_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTable.NetPrice WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_status.entity_id SET coupon_finder.field_data_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTable.BestCouponStatus WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_status.entity_id SET coupon_finder.field_revision_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTable.BestCouponStatus WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_status_display.entity_id SET coupon_finder.field_data_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTable.BestCouponDisplay  WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_status_display.entity_id SET coupon_finder.field_revision_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTable.BestCouponDisplay  WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_url INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_url.entity_id SET coupon_finder.field_data_field_best_coupon_url.field_best_coupon_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_URL_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_url INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_url.entity_id SET coupon_finder.field_revision_field_best_coupon_url.field_best_coupon_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_info.entity_id SET coupon_finder.field_data_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FIELD_BEST_COUPON_INFO_VALUE  - REVISION \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_info.entity_id SET coupon_finder.field_revision_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n field_data_field_retailer \n\n").time();
db_query ("UPDATE coupon_finder.field_data_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_retailer.entity_id SET coupon_finder.field_data_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n field_data_field_retailer - revision \n\n").time();
db_query ("UPDATE coupon_finder.field_revision_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_retailer.entity_id SET coupon_finder.field_revision_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId WHERE coupon_finder.predictorCompiledResultTable.entity_id = 197758");

echo("\n\n FLUSH ALL CACHE \n\n").time();
cache_clear_all();

echo("\n\n FINISHED \n\n").time();
*/
?>
