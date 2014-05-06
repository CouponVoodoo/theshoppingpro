<?php
/* START OF for updating coupon code and asscoiated field for mid day change in coupons */

				$result = "Start Time: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		echo "\n\n START - Entity Id Update \n\n".time();
		db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.field_data_field_base_url ON coupon_finder.field_data_field_base_url.field_base_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl SET coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_base_url.entity_id ");
		echo "\n\n END - Entity Id Update \n\n".time();
		$result = $result."Entity Update: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		echo "\n\n BRAND - GETTING TID FROM NAME \n\n".time();
		db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.taxonomy_term_data ON coupon_finder.taxonomy_term_data.name = coupon_finder.predictorCompiledResultTable.Brand SET coupon_finder.predictorCompiledResultTable.BrandId = coupon_finder.taxonomy_term_data.tid ");
		$result = $result."Brand Update: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		echo "\n\n UPDATE LOCATION FOR NODE \n\n".time();
		db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.loc = concat('node/',CAST(coupon_finder.predictorCompiledResultTable.entity_id as CHAR(50))) ");
		echo "\n\n UPDATE LOCATION FOR BRAND \n\n".time();
		db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.Brand_Loc = concat('taxonomy/term/',CAST(coupon_finder.predictorCompiledResultTable.BrandId as CHAR(50))) ");
		echo "\n\n UPDATE LOCATION FOR CATEGORY \n\n".time();
		db_query ("UPDATE coupon_finder.predictorCompiledResultTable SET coupon_finder.predictorCompiledResultTable.Category_Loc = concat('taxonomy/term/',CAST(coupon_finder.predictorCompiledResultTable.Category as CHAR(50))) ");
		$result = $result."Location Update: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		// node sitemap update
		echo "\n\n XML SITEMAP - LAST MODIFIED \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));
		echo "\n\n XML SITEMAP - CHANGE FREQUENCY \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");
		// brand sitemap update
		echo "\n\n XML SITEMAP - LAST MODIFIED \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Brand_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));
		echo "\n\n XML SITEMAP - CHANGE FREQUENCY \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Brand_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");
		// category sitemap update
		echo "\n\n XML SITEMAP - LAST MODIFIED \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Category_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.lastmod = ".(time()+(4.5*3600)));
		echo "\n\n XML SITEMAP - CHANGE FREQUENCY \n\n".time();
		db_query ("UPDATE coupon_finder.xmlsitemap INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.Category_Loc = coupon_finder.xmlsitemap.loc SET coupon_finder.xmlsitemap.changefreq = 86400 ");
		$result = $result."Sitemaps Updated: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
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

		echo("\n\n field_data_field_retailer \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_retailer.entity_id SET coupon_finder.field_data_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId");

		echo("\n\n field_data_field_retailer - revision \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_retailer INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_retailer.entity_id SET coupon_finder.field_revision_field_retailer.field_retailer_tid   = coupon_finder.predictorCompiledResultTable.RetailerId");
	
		$result = $result."All Fields Except All COupon Info : ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
	
		echo("\n\n FIELD_BEST_COUPON_INFO_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_best_coupon_info.entity_id SET coupon_finder.field_data_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result ");
		
		$result = $result."All Coupon Info  : ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		
		echo("\n\n FIELD_BEST_COUPON_INFO_VALUE  - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_info INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_best_coupon_info.entity_id SET coupon_finder.field_revision_field_best_coupon_info.field_best_coupon_info_value = coupon_finder.predictorCompiledResultTable.Result ");

		$result = $result."All Coupon Info  Revision : ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";

		echo("\n\n FLUSH ALL CACHE \n\n").time();
		//cache_clear_all();
		drupal_flush_all_caches();

		echo "\n\n APACHE SOLR - STATUS \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.status = 1 ");

		echo "\n\n APACHE SOLR - CHANGED \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.changed = ".(time()+(4.5*3600)));



/* END OF for updating coupon code and asscoiated field for mid day change in coupons */
?>
