<?php
/* START OF for updating coupon code and asscoiated field for mid day change in coupons */

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

		echo("\n\n FLUSH ALL CACHE \n\n").time();	
		cache_clear_all();

/* END OF for updating coupon code and asscoiated field for mid day change in coupons */
?>
