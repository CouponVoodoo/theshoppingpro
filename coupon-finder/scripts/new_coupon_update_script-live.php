<?php
/* START OF for updating coupon code and asscoiated field for mid day change in coupons */
echo "\n\n START - Entity Id Update \n\n".time();
		
		echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_couponcode.entity_id SET coupon_finder.field_data_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponCode ");

		echo("\n\n FIELD_BEST_COUPON_COUPONCODE_VALUE - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_couponcode INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_couponcode.entity_id SET coupon_finder.field_revision_field_best_coupon_couponcode.field_best_coupon_couponcode_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponCode ");

		echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_description.entity_id SET coupon_finder.field_data_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponDesc ");

		echo("\n\n FIELD_BEST_COUPON_DESCRIPTION_VALUE  - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_description INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_description.entity_id SET coupon_finder.field_revision_field_best_coupon_description.field_best_coupon_description_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponDesc ");

		echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_saving.entity_id SET coupon_finder.field_data_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTableFlipkart.Saving ");

		echo("\n\n FIELD_BEST_COUPON_SAVING_VALUE  - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_saving INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_saving.entity_id SET coupon_finder.field_revision_field_best_coupon_saving.field_best_coupon_saving_value = coupon_finder.predictorCompiledResultTableFlipkart.Saving ");

		echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_data_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTableFlipkart.NetPrice ");

		echo("\n\n FIELD_BEST_COUPON_NETPRICEAFTERS_VALUE  - REVISION \n\n".time());
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_netpriceafters INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_netpriceafters.entity_id SET coupon_finder.field_revision_field_best_coupon_netpriceafters.field_best_coupon_netpriceafters_value = coupon_finder.predictorCompiledResultTableFlipkart.NetPrice ");

		echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_status.entity_id SET coupon_finder.field_data_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponStatus ");

		echo("\n\n FIELD_BEST_COUPON_STATUS_VALUE  - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_status.entity_id SET coupon_finder.field_revision_field_best_coupon_status.field_best_coupon_status_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponStatus");

		echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_best_coupon_status_display.entity_id SET coupon_finder.field_data_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponDisplay ");

		echo("\n\n FIELD_BEST_COUPON_STATUS_DISPLAY_VALUE  - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_best_coupon_status_display INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_best_coupon_status_display.entity_id SET coupon_finder.field_revision_field_best_coupon_status_display.field_best_coupon_status_display_value = coupon_finder.predictorCompiledResultTableFlipkart.BestCouponDisplay");
        
		echo("\n\n FIELD_LASTCHECKEDTIME_VALUE \n\n").time();
		db_query ("UPDATE coupon_finder.field_data_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_data_field_lastcheckedtime.entity_id SET coupon_finder.field_data_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTableFlipkart.LastCheckTime ");

		echo("\n\n FIELD_LASTCHECKEDTIME_VALUE - REVISION \n\n").time();
		db_query ("UPDATE coupon_finder.field_revision_field_lastcheckedtime INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.field_revision_field_lastcheckedtime.entity_id SET coupon_finder.field_revision_field_lastcheckedtime.field_lastcheckedtime_value = coupon_finder.predictorCompiledResultTableFlipkart.LastCheckTime ");
		
		echo("\n\n FLUSH ALL CACHE \n\n").time();
		
		//cache_clear_all();
		drupal_flush_all_caches();
      /*  echo "\n\n APACHE SOLR - STATUS \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.status = 1 ");

		echo "\n\n APACHE SOLR - CHANGED \n\n".time();
		db_query ("UPDATE coupon_finder.apachesolr_index_entities_node INNER JOIN coupon_finder.predictorCompiledResultTableFlipkart ON coupon_finder.predictorCompiledResultTableFlipkart.entity_id = coupon_finder.apachesolr_index_entities_node.entity_id SET coupon_finder.apachesolr_index_entities_node.changed = ".(time()+(4.5*3600)));
		*/
		//drupal_flush_all_caches();


/* END OF for updating coupon code and asscoiated field for mid day change in coupons */
?>
