
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
			/* GETTING FIELD VALUES*/
			$url_path = rawurlencode(drupal_get_path_alias());
			$nid = strip_tags(($fields['nid']->content));
			$retailer = strip_tags(($fields['field_retailer']->content));
			$coupon_code = strip_tags(($fields['field_coupon_code']->content));
			$coupon_title = strip_tags(($fields['field_coupon_title']->content));
			$title = strip_tags(($fields['field_coupon_title']->content));
			$last_checked_time = strip_tags(($fields['field_field_coupon_expiry']->content));
             $brand=strip_tags(($fields['field_brand']->content));           
			$node = node_load($nid);
			$affiliate_url = $node->field_baseurl_coupon['und']['0']['value'];//strip_tags(($fields['field_baseurl_coupon']->content));
			global $base_url;
			
						
?>


<div class="retailer_coupon_page_row">
	<div class="search_listing_left">
		<?php

						
		if (!isset($_COOKIE['CV_User_GUID'])) {
				$CV_User_GUID = 'NOT_SET';
			} Else {
				$CV_User_GUID = $_COOKIE['CV_User_GUID'];		
			}
			$coupon_display_url=$base_url."/coupon-redirect?l=cp&nid=".$nid."&t=c&c=".rawurlencode($coupon_code)."&p=".$url_path."&s=".rawurlencode($affiliate_url);

		?>
			<h2><a rel='no follow' target='_blank'href='<?php print $coupon_display_url ?>' ><?php print $brand." Coupons : ".$title." @ ".$retailer; ?></a></h2>
			<div >



<?php
echo "<div class='coupon_status_likely'><img src='".base_path().path_to_theme()."/images/thumbs_up.png' /><span>Likely to Work</span></a></div>"; ?>
<div >Updated: <?php print $last_checked_time; ?></div>

		
	</div>
	
	</div>
	<div class="search_listing_right">
	
		  <div class="search_listing_row__1 copy_coupon_row">
			<?php $div_id='ccp_'.$nid ;?>
			<a href="<?php print $coupon_display_url?>" target="_blank"  class="unlock_best_coupon unlock_coupon" id =" <?php echo'ccp_'.$nid;?> rel="best_1" data-clipboard-text="<?php echo $coupon_code?>" >
			<?php echo"<span class='copy_coupon'>Copy Coupon</span><span></span></a>"?>
		  </div>
	</div>


<div class="product-bottom" >
	<div class="product-right-bottom" itemprop="description">
<?php
$retailer = $fields['field_retailer']->handler->view->result[0]->field_field_retailer[0]['rendered'];
if ($retailer['#type'] == 'link') {
    print '<div class="field-content">' . l(t('More '.strip_tags(($fields['field_retailer']->content)).' Coupons', $retailer['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
}
else {
    print $fields['field_retailer']->content;
}

$brand_check = strip_tags($fields['field_brand']->content);

if ($brand_check != 'Other') {
	$brand = $fields['field_brand']->handler->view->result[0]->field_field_brand[0]['rendered'];
	if ($brand_check['#type'] == 'link') {
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	print ' | <div class="field-content">' . l(t($brand['#title']), $brand['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
	}
	else {
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	print " | ".$fields['field_brand']->content;
	}
}

?>
</div>
</div>