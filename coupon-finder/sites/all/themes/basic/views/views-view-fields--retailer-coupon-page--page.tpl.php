<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<div class="retailer_coupon_page_row">
	<div class="search_listing_left">
		<?php
			/* GETTING FIELD VALUES*/
			$title = $fields['title']->content;
			$nid = strip_tags($fields['nid']->content);
			$retailer = strip_tags($fields['field_retailer']->content);
			$offer_type = strip_tags($fields['field_offer_type']->content);
			$coupon_title = $fields['field_coupon_title']->content;
			$last_checked_time = strip_tags(($fields['field_field_coupon_expiry']->content));
			//$affiliate_url = strip_tags($fields['field_affiliate_url']->content); // UNCOMMENT ONCE CORRECTED
			$affiliate_url = 'http://track.in.omgpm.com/?AID=387355&MID=304697&PID=9170&CID=3697672&WID=43135&uid=homePage&r=http%3A%2F%2Fwww.jabong.com';
			$status = strip_tags($fields['field_status']->content);
			$weight = $fields['field_weight']->content;
			if ($offer_type == 'Coupons') {
				$coupon_code = $fields['field_coupon_code']->content;
			} else {
				$coupon_code = 'Deal';
			}
			/* CREATING REDIRECT PAGE PATH*/
			global $base_url;
			if (!isset($_COOKIE['CV_User_GUID'])) {
				$CV_User_GUID = 'NOT_SET';
			} Else {
				$CV_User_GUID = $_COOKIE['CV_User_GUID'];		
			}
			$coupon_display_url=$base_url."/coupon-redirect?guid=".$CV_User_GUID."&s=".rawurlencode($affiliate_url)."&c=".rawurlencode($coupon_code);
		?>
			<h2><a rel='no follow' target='_blank'href='<?php print $coupon_display_url ?>' ><?php print $title; ?></a></h2>
			<div >Status: 
			<?php if ($status == '2'){
				print 'Guaranteed to Work!';
			}else {
				if ($status == '1') {
					print 'Likely to Work';
				} else {
					print 'Unlikely to Work';
				}
			} ?></div>
			<div >Last Checked: <?php print $last_checked_time; ?></div>
			<div >Offer Type: <?php print $offer_type; ?></div>
			</br>
			


			
		<?php
				
			// echo "<div class='view_store_coupon_page'><a target='_blank' class='view_store_coupon_page' href='{$coupon_display_url}' >View Store</a></div>";
			
			$node = node_load($nid);
			$field_collection = $node->field_category_links_multi;
			if(!empty($field_collection)){
		?> <div class="search_listing_row">This coupon has been checked for the following categories @<?php print $retailer; ?>. so what will you buy today? :</div> 
			
		<?php
			foreach ($node->field_category_links_multi['und'] as $oneRow) {
				$row = field_collection_item_load($oneRow['value']);
				$fc_affiliate_url = strip_tags(trim($row->field_link_affiliate_url_multi['und']['0']['value']));
				$fc_category_id = $row->field_link_category_id_multi['und'][0][tid];
				/*CONVERTING ID TO NAME */
				$term = taxonomy_term_load($fc_category_id);
						$full_category_name = '';
						$parent_terms = taxonomy_get_parents_all($fc_category_id);
						foreach($parent_terms as $parent) {
						  $parent_parents = taxonomy_get_parents_all($parent->tid);
						  
						  $full_category_name = $parent->name.' > '.$full_category_name;
						  
						  /*if ($parent_parents != false) {
							//this is top parent term
							$top_parent_term = $parent;
						  }*/
						}
						  
				/*CREATING REDIRECT PAGE PATH FOR EACH CATEGORY */
				$fc_coupon_display_url = $base_url."/coupon-redirect?guid=".$CV_User_GUID."&s=".rawurlencode($fc_affiliate_url)."&c=".rawurlencode($coupon_code);		

		?>
				<div><a rel='no follow' target='_blank'href='<?php print $fc_coupon_display_url ?>' ><?php print $full_category_name ;?></a></div>
				
		<?php		
			  } 
			 
			}
		?>
	</div>
	<div class="search_listing_right">
	
		  <div class="search_listing_row__1 copy_coupon_row">
			
			<a href="<?php print $coupon_display_url?>" target="_blank" class="unlock_best_coupon unlock_coupon" rel="best_1">
				  <span class="copy_coupon">Show Coupon</span><span></span>
			</a>
			
		  </div>


		<?php
		drupal_add_js(array('coupon_code' => $coupon_code), 'setting');
			/* mixpanel */
		drupal_add_js("jQuery(document).ready(function($){
				  $('.unlock_best_coupon').click(function(){
				  //alert('test test');
			  coupon_code = Drupal.settings.coupon_code;
				  
					  $(this).html(coupon_code);
					  $(this).addClass('copied_coupon')
					 // var url = $(this).attr('href')+'&c='+coupon_code;
				  
					  // $(this).attr('href',url);

					// BY ASHISH: COMMENTED OUT TO PREVENT MULTI CLICK - THIS IS A HACK NEED TO TAKE A RELOOK TO SEE WHERE THE URL IS OPENING FROM	            
						  window.open($(this).attr('href'));
					return true;
				  });
				});", array('type' => 'inline', 'scope' => 'footer'));
		?>	
	</div>
	
</div>
