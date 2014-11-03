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
<?php
$current_domain = get_current_domain();
			/* GETTING FIELD VALUES*/
			$url_path = rawurlencode(drupal_get_path_alias());
			
			$nid = strip_tags($fields['nid']->content);
			$retailer = strip_tags($fields['field_retailer']->content);
			$offer_type = strip_tags($fields['field_offer_type']->content);
			$coupon_title = strip_tags($fields['field_coupon_title']->content);
			$coupon_code = str_replace(" ","_",$coupon_code);
			$last_checked_time = strip_tags(($fields['field_field_coupon_expiry']->content));
 			$node = node_load($nid);
			// $affiliate_url = strip_tags($fields['field_affiliate_url']->content);
			$affiliate_url = $node->field_affiliate_url['und']['0']['value'];
			// echo 'cuponation-title'.$node->field_cuponation_title['und']['0']['value'];
			if ($current_domain == 'cuponation' && !empty($node->field_cuponation_title['und']['0']['value'])){
				$title = $node->field_cuponation_title['und']['0']['value'];
				$display = 1;
			} else {
				if( $current_domain == 'couponvoodoo'){
					$title = $fields['title']->content;
					$display = 1;
				} else {
					$display = 0;
				}
			}
			
			
	If ($display ==1) {

?>


<div class="retailer_coupon_page_row">
	<div class="search_listing_left">
		<?php

			// $affiliate_url = 'http://track.in.omgpm.com/?AID=387355&MID=304697&PID=9170&CID=3697672&WID=43135&uid=homePage&r=http%3A%2F%2Fwww.jabong.com';
			$status = strip_tags($fields['field_status']->content);
			$weight = $fields['field_weight']->content;
			if ($offer_type == 'Coupons') {
				$coupon_code = strip_tags($fields['field_coupon_code']->content);
			} else {
				$coupon_code = 'Deal-Activated';
			}
			/* CREATING REDIRECT PAGE PATH*/
			global $base_url;
			if (!isset($_COOKIE['CV_User_GUID'])) {
				$CV_User_GUID = 'NOT_SET';
			} Else {
				$CV_User_GUID = $_COOKIE['CV_User_GUID'];		
			}
			$coupon_display_url=$base_url."/coupon-redirect?l=cp&nid=".$nid."&t=c&c=".rawurlencode($coupon_code)."&p=".$url_path."&s=".rawurlencode($affiliate_url);
		?>
			<h2><a rel='no follow' target='_blank'href='<?php print $coupon_display_url ?>' ><?php print $title; ?></a></h2>
			<div > 
			
					
			<?php 
				if ($status == '2'){
					echo "<div class='coupon_status_guaranteed'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><span>Guaranteed To Work</span></div>";
				}else {
						if (strtolower($retailer) == 'jabong.com' || strtolower($retailer) == 'myntra.com' || strtolower($retailer) == 'flipkart.com') {
								if ($status == '1') {
									echo "<div class='coupon_status_likely'><img src='".base_path().path_to_theme()."/images/thumbs_up.png' /><span>Likely to Work</span></a></div>";
								} else {
									echo "<div class='coupon_status_unlikely'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><span>Unlikely to Work</span></div>";
								}
						}
				} 
				?>
			</div>
			<div >Updated: <?php print $last_checked_time; ?></div>
			<div >Offer Type: <?php print $offer_type; ?></div>
	</div>

	<div class="search_listing_right">
	
		  <div class="search_listing_row__1 copy_coupon_row">
			<?php $div_id='rcp_'.$nid ;?>
			<a href="<?php print $coupon_display_url?>" target="_blank"  class="unlock_best_coupon unlock_coupon" id = <?php echo'rcp_'.$nid;?> rel="best_1" data-clipboard-text="<?php echo $coupon_code?>" >
				  
				 <?php if($offer_type == 'Coupons') {?>
					<span class="copy_coupon">Copy Coupon</span><span></span>
				<?php } else { ?>
					<span class="copy_coupon">Activate Deal</span><span></span>
				<?php }
				?>
			</a>
		  </div>
	</div>

	<?php 
	$enable = 'no'; // category display enabled?
	if ($current_domain == 'couponvoodoo' && $enable == 'yes') {
		if (strtolower($retailer) == 'jabong.com' || strtolower($retailer) == 'myntra.com' || strtolower($retailer) == 'flipkart.com') {
	?>

			<div class="retailer_coupon_category_list">
			<?php
							
						// echo "<div class='view_store_coupon_page'><a target='_blank' class='view_store_coupon_page' href='{$coupon_display_url}' >View Store</a></div>";
						
						$node = node_load($nid);
						$field_collection = $node->field_category_links_multi;
						if(!empty($field_collection)){ 
					?> <div class="category_list_message">This coupon has been checked for the following categories @ <?php print $retailer; ?>. So what will you buy today?</div> 
						
					<?php
					$men_categories = array();
					$women_categories = array();
						foreach ($node->field_category_links_multi['und'] as $oneRow) {
							$row = field_collection_item_load($oneRow['value']);
							$fc_affiliate_url = strip_tags(trim($row->field_link_affiliate_url_multi['und']['0']['value']));
							$fc_category_id = $row->field_link_category_id_multi['und'][0][tid];
							/*CONVERTING ID TO NAME */
							$term = taxonomy_term_load($fc_category_id);
							$term_name = $term->name;
							$fc_coupon_display_url = $base_url."/coupon-redirect?t=c&l=cpc&nid=".$nid."&s=".rawurlencode($fc_affiliate_url)."&c=".rawurlencode($coupon_code);
		//					$full_category_name = '';
									$parent_terms = taxonomy_get_parents_all($fc_category_id);
									foreach($parent_terms as $parent) {
										$parent_parents = taxonomy_get_parents_all($parent->tid);
		//							  	$full_category_name = $parent->name.' > '.$full_category_name;
									  
										  if ($parent_parents != false) {
											//this is top parent term
											$top_parent_term = $parent;
											$top_parent_name = $top_parent_term->name;
										  }
									}
									
		//					echo $top_parent_name;
							if (strtolower($top_parent_name) =='men'){
								$men_categories_element = array (
									"Term_Name" => $term_name,
									"Term_URL" => $fc_coupon_display_url,
									"Top_Parent_Name" => $top_parent_name
								);
		//						echo 'men';
								array_push($men_categories,$men_categories_element);
							} else {
								if (strtolower($top_parent_name) =='women'){
									$women_categories_element = array (
										"Term_Name" => $term_name,
										"Term_URL" => $fc_coupon_display_url,
										"Top_Parent_Name" => $top_parent_name
									);
		//							echo 'women';
									array_push($women_categories,$women_categories_element);
								}
							}
						//var_dump ($men_categories);
							}
							?> <div class="category_list_header"> Men Products: </div><?php
							foreach ($men_categories as $men){
								$term_name = $men['Term_Name'];
								$term_url = $men['Term_URL'];
								$term_top_parent = $men['Top_Parent_Name'];
								?>
										<div class="category_link_button"><a rel='no follow' target='_blank'href='<?php print $term_url ?>' ><?php print $term_name ;?></a></div> 
								<?php		
							}
							
							?> <div class="category_list_header"> Women Products: </div><?php
							foreach ($women_categories as $women){
								$term_name = $women['Term_Name'];
								$term_url = $women['Term_URL'];
								$term_top_parent = $women['Top_Parent_Name'];
								?>
									<div class="category_link_button"><a rel='no follow' target='_blank'href='<?php print $term_url ?>' ><?php print $term_name ;?></a></div> 
								<?php		
							}
						}							  
					?>
			</div>
	<?php
		}
	}
	?>
</div>
<?php  }?>