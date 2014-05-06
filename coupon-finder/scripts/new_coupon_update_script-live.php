<?php
/* START OF for updating coupon code and asscoiated field for mid day change in coupons */

				$result = "Start Time: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
		echo "\n\n START - Entity Id Update \n\n".time();
		db_query("UPDATE coupon_finder.predictorCompiledResultTable LEFT JOIN coupon_finder.field_data_field_base_url ON coupon_finder.field_data_field_base_url.field_base_url_value = coupon_finder.predictorCompiledResultTable.BaseUrl SET coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_base_url.entity_id ");
		echo "\n\n END - Entity Id Update \n\n".time();
		$result = $result."Entity Update: ".gmdate('Y-m-d\TH:i:s\Z', (time()+(5.5*3600)))."\n\n";
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

		echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_data_field_lastcheckedtime.entity_id SET coupon_finder.field_data_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime ");

		echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.field_revision_field_lastcheckedtime.entity_id SET coupon_finder.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTable.LastCheckTime ");

		
		echo("\n\n FLUSH ALL CACHE \n\n").time();
		//cache_clear_all();
		drupal_flush_all_caches();

		echo "\n\n APACHE SOLR - STATUS \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.status = 1 ");

		echo "\n\n APACHE SOLR - CHANGED \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTable ON coupon_finder.predictorCompiledResultTable.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.changed = ".(time()+(4.5*3600)));



/* END OF for updating coupon code and asscoiated field for mid day change in coupons */
?>
