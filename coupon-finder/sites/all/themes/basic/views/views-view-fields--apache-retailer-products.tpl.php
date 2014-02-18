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

global $base_url;
$nid = $row->entity_id;
$node = node_load($nid);
$mrp = $node->field_mrpproductprice['und']['0']['value'];
$list_price = $node->field_product_price['und']['0']['value'];
$net_price = $node->field_best_coupon_netpriceafters['und']['0']['value'];
$saving = $node->field_best_coupon_saving['und']['0']['value'];
$retailer = strip_tags($fields['field_retailer']->content);
$brand = strip_tags($fields['field_brand']->content);
$coupon_status = $node->field_best_coupon_status[und][0]['value'];
$image = $node->field_product_image['und']['0']['value'];
$node_url = $base_url.'/'.drupal_lookup_path('alias',"node/".$nid);
$product_name = $node->field_retailer_product_name['und']['0']['value'];
?>
<div class = "similar_name"><h3> <a href='<?php print $node_url;?>'><?php print $product_name;?></a></h3></div>

<div class = "similar_left">
<?php 
$img = "<div class='field field-name-field-product-images field-type-image field-label-above'>
			<div class='field-items'>
				<div class='field-item even product_img'>
					<a href='{$node_url}'><img src='{$image}' typeof='foaf:Image' alt='{$product_name}'></a>
				
				</div>";
echo  $img .=    "</div>
		</div>";


?>
</div>
<div class = "similar_right">
<?php

if ($coupon_status ==1){
	if ($saving > 1){
		//echo "<div class='coupons_found'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><div class='coupons_text'>Coupons</div></div>";
		echo "<div class='similar_coupons'>Coupons Found</div>";
		echo "<span class ='field-content'><strike>INR ".number_format($list_price,0, '.', ',')."</strike></span></br>";
		// echo "<span class ='field-content'>INR ".number_format($saving,0, '.', ',')."</span></br>";
		echo "<span class ='field-content'>INR ".number_format($net_price,0, '.', ',')."</span></br>";
	} else {
		echo "<div class='similar_coupons'>Offers Found</div>";
		echo "<span class ='field-content'>INR ".number_format($list_price,0, '.', ',')."</span></br>";	
	}
} elseif ($mrp > $list_price) {
//	echo "<div class='coupons_found'><img src='".base_path().path_to_theme()."/images/thumbs_up.png' /><div class='savings_text'>Discounts</div></div>";
	echo "<div class='similar_savings'>Savings Found</div>";
	echo "<span class ='field-content'><strike>INR ".number_format($mrp,0, '.', ',')."</strike></span></br>";
	echo "<span class ='field-content'>INR ".number_format($list_price,0, '.', ',')."</span></br>";
} else {
	//echo "<div class='no_coupons_found'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><div class='no_coupons_text'>No Discounts</div></div>";
	echo "<div class='similar_no_coupons'>No Savings</div>";
	echo "<span class ='field-content'>INR {$list_price}</span>";
}
echo "<div class='d_view_store'><a  href='{$node_url}'>View</a></div>";

?>

</div>



<?php //foreach ($fields as $id => $field): ?>
  <?php //if (!empty($field->separator)): ?>
    <?php //print $field->separator; ?>
  <?php //endif; ?>
  <?php //print $field->wrapper_prefix; ?>
    <?php //print $field->label_html; ?>
    <?php //print $field->content; ?>
  <?php //print $field->wrapper_suffix; ?>
<?php //endforeach; ?>

