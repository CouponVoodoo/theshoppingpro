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
$url_path = rawurlencode(drupal_get_path_alias());
$nid = arg(1);
$node = node_load($nid);
$mrp = $node->field_mrpproductprice['und'][0]['value'];
$list_price = $node->field_product_price['und'][0]['value'];
$retailer = strip_tags($fields['field_retailer']->content);
$brand = strip_tags($fields['field_brand']->content);
$non_coupon_saving = $mrp - $list_price;
global $base_url;
$redirect_url = $base_url.'/coupon-redirect/?l=olp&nid='.$nid.'&c=Link_Click'.'&p='.$url_path;
/** Start of By Ashish to get mixpanel variables */		
global $base_url;
$mixpanel_urlAlias = $base_url.'/'.drupal_get_path_alias('node/'.$nid);
$mixpanel_retailer= strip_tags($fields['field_retailer']->content);
$mixpanel_brand= strip_tags($fields['field_brand']->content);
$mixpanel_category= strip_tags($fields['field_category']->content);
$mixpanel_product_name= strip_tags($fields['field_retailer_product_name']->content);
$mixpanel_base_url= strip_tags($fields['field_base_url']->content);
$mixpanel_type='Product Page View Store';
/** End of By Ashish to get mixpanel variables */			
?>
<div class="product-detail">

<div class="product-inner">
<div class="product-left">
    <?php
    
    echo "<a rel='nofollow' class='view_store1' href='{$redirect_url}' >".$fields['field_product_image']->content."</a>";
        
    //print ($fields['field_product_images']->content);
    $status = strip_tags($fields['field_best_coupon_status']->content);
  
//        echo "<div class='d_view_store'><a rel='nofollow' target='_blank' class='view_store' href='{$fields['field_affiliateurl']->content}' >View Store</a></div>";
	$product_link = '/search/site/'.str_replace('+at+'.$retailer,'',str_replace(' ','+',strip_tags($fields['field_retailer_product_name']->content)));
	 ?>
	
  <div class='blue_button'><a href="<?php echo $product_link;?>" class='d_view_store'><?php echo get_label('View More From ').substr($brand, 0, 40);?></a></div>
 
 	
	</div>


<div class="product-right-inner">
<h1> <?php 
	if ($current_domain =='cuponation'){
		echo "<meta itemprop='name' content ='".$node->field_retailer_product_name['und']['0']['value']."'/>".$node->field_retailer_product_name['und']['0']['value']." @ ".$retailer." For Rs. ".$node->field_best_coupon_netpriceafters['und']['0']['value']." Using Coupons & Discount Offers | CN".$nid; } 
	else { 
		echo "<meta itemprop='name' content ='".$node->field_retailer_product_name['und']['0']['value']."'/>".strip_tags($fields['field_retailer_product_name']->content)." | CV".$nid; }?></h1>

<?php 

$lastcheckedtime_check = strtotime(strip_tags($fields['field_lastcheckedtime']->content));
$current_time = round(microtime(true));
$time_gap = $current_time-$lastcheckedtime_check;

/* Commented out since recheck alert there below status too */
// if ( $time_gap > (1 * 27 * 3600)) {

if ($current_domain != 'cuponation'){
?>

<div class="custom_link">Last Checked : <?php echo strip_tags($fields['field_lastcheckedtime']->content); ?> | <a onclick="locader('<?php echo $base_root.base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>')" class="active">Recheck Now</a></div>
<?php } ?>

<div class="product-right">
<h4><?php echo get_label('Best Coupon Or Discounts');?></h4>
<div class="coupon_code1">
    <?php       
    $CouponStatus = trim(strip_tags($fields['field_best_coupon_status']->content));
	$Couponsavingcheck = trim(strip_tags($fields['field_best_coupon_saving']->content));
	    
    if( $CouponStatus == 1 ){
        print coupons_copy_best_coupon($nid);
    }else{
        echo "<div class='d_view_store'><a class='view_store' href='{$redirect_url}' >".get_label('Buy Now')."</a></div>";
		
    }
    ?>
</div>
<ul>

<li>
    <label>Status:</label>
    <?php

		if( $node->field_best_coupon_status[und][0]['value'] == 1 ){
        echo "<div class='pro_coupons_found'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><div class='pro_coupons_text'>".get_label('Coupons Found')."</div></div>";
		$affiliate_url_uncoded = $node->field_best_coupon_url['und']['0']['value'];	
		$coupon_code=rawurlencode ($node->field_best_coupon_couponcode['und']['0'][value]);
	}else{
		if ($non_coupon_saving > 0){
			echo "<div class='pro_coupons_found'><img src='".base_path().path_to_theme()."/images/thumbs_up.png' /><div class='pro_savings_text'>".get_label('Discount Found')."</div></div>";
			$affiliate_url_uncoded = $node->field_affiliateurl['und']['0']['value'];
			$coupon_code='Savings_Found';
		} Else {
		
				// echo "<div class='pro_no_coupons_found'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><div class='pro_no_coupons_text'>No Discounts</div></div>";
				echo "<div class='pro_no_coupons_found'><div class='pro_no_coupons_text'>".get_label('No Discounts')."</div></div>";
				$affiliate_url_uncoded = $node->field_affiliateurl['und']['0']['value'];
				$coupon_code='No_Discounts';
			}
	}  

    ?>
</li>
<?php if ( $time_gap > (1 * 27 * 3600)) {?>
	<div class="custom_link_inner"><span style= "color: red; font-weight: bold"><?php echo get_label('Data is more than 24hrs old: ');?></span><a onclick="locader('<?php echo $base_root.base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>')" class="active">Recheck Now</a></div>
<?php } ?>



<?php
	if ($node->field_best_coupon_saving['und'][0]['value'] == 1 && $node->field_best_coupon_status[und][0]['value'] == 1){
		echo "<li> <label>".get_label('List Price:')."</label><meta itemprop='currency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
		echo "<li> <label>".get_label('Savings:')."</label>See Best Coupon</li>";
		echo "<li> <label>".get_label('Offer:')."</label>See Best Coupon</li>";
	
	
	} else {
		if ($node->field_best_coupon_saving['und'][0]['value'] > 1 && $node->field_best_coupon_status[und][0]['value'] == 1){
				echo "<li> <label>".get_label('List Price:')."</label>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>".get_label('INR ').number_format($node->field_best_coupon_saving['und'][0]['value'],0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><meta itemprop='currency' content='INR' /><meta itemprop='price' content='".number_format($node->field_best_coupon_netpriceafters['und'][0]['value'],0, '.', ',')."'/>".get_label('INR ').number_format($node->field_best_coupon_netpriceafters['und'][0]['value'],0, '.', ',')."</li>";

		} else {
			if ($non_coupon_saving > 0){
				echo "<li> <label>".get_label('MRP:')."</label>".get_label('INR ').number_format($mrp,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>".get_label('INR ').number_format($non_coupon_saving,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><meta itemprop='currency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
					
			} else {
				echo "<li> <label>".get_label('MRP:')."</label>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>-</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><meta itemprop='currency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";	
			}
		}
	}
?>

<?php if( $CouponStatus == 1 ){?>
<li><label>Best Coupon:</label><?php 
/* PRINTING TITLE BASED ON WHETHER THE DOMAIN IS CUPONATION OR NOT*/
	if ($current_domain == 'cuponation'){
		$query = new EntityFieldQuery();
		$query->entityCondition('entity_type', 'node')
			->entityCondition('bundle', 'retailer_coupon_page')
			->fieldCondition('field_retailer', 'tid', $node->field_retailer['und']['0']['tid'], '=')
			->fieldCondition('field_coupon_code', 'value', $node->field_best_coupon_couponcode['und']['0']['value'], '=');
		$result = $query->execute();		
		$nids = array_keys($result['node']);
		$retailer_coupon = node_load($nids[0]);
		$cuponation_title = $retailer_coupon->field_cuponation_title['und']['0']['value'];
		if (!empty($result['node']) && !empty($cuponation_title)) {
			//echo $cuponation_title;
			echo"<span itemprop='offerDetails'>".$cuponation_title."</span>";
		} else {
			// print ($fields['field_best_coupon_description']->content); 
			echo"<span itemprop='offerDetails'>".strip_tags($fields['field_best_coupon_description']->content)."</span>";
		}	
	} else {
		// print ($fields['field_best_coupon_description']->content); 
		echo"<span itemprop='offerDetails'>".strip_tags($fields['field_best_coupon_description']->content)."</span>";
	}
	?></li>



<div class='blue_button'><a href="#All_Coupons" class='d_view_store'><?php echo get_label('View All Tested Coupons For Product '); ?></a></div>
<?php } else { ?>
<div class='blue_button'><a href="<?php echo '/rcp/'.str_replace(" ", "-", $retailer).'/coupons-offers';?>" class='d_view_store'><?php echo get_label('View All Tested Coupons For ').$retailer;?></a></div>
<?php }?>

</ul>


<?php //} ?>
</div>
</div>
</div>
<div class="product-bottom">
<?php /* ?> <div class="product-left">
<ul>
<li><label>Retailer:</label><?php print ($fields['field_retailer']->content); ?></li>
<li><label>Brand:</label><?php print ($fields['field_brand']->content); ?></li>
<li><label>Category:</label><?php print ($fields['field_category']->content); ?></li>
</ul>
</div>
*/ ?>

<div class="product-right-bottom">


<?php 
/* commented by ashish to hide description of product */
// print ($fields['description']->content); 
// print $fields['field_retailer']->content;

if (empty($_GET['pop'])) {
	if ($current_domain == 'couponvoodoo'){
		$product_description = 'Buy '.strip_tags($fields['field_retailer_product_name']->content).' (CV'.$nid.')'.' at the lowest price with the latest discounts, coupons and offers brought to you by CouponVoodoo. View the list of discount codes below and click "Copy Coupon" to get the code. Also see:';
	} else {
		$product_description = 'Find the best price for '.strip_tags($fields['field_retailer_product_name']->content).' (CN'.$nid.')'.' with the latest discounts, coupons & offers @ '.$retailer;	
	}
print $product_description;
// $product_description_links = 'You may also want to view discount codes and offers for all products from:';
echo nl2br("\n");
print $product_description_links;
$source = $_COOKIE['traffic_source'];


$retailer = $fields['field_retailer']->handler->view->result[0]->field_field_retailer[0]['rendered'];
if ($retailer['#type'] == 'link') {
    print '<div class="field-content">' . l(t($retailer['#title']), $retailer['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
}
else {
    print $fields['field_retailer']->content;
}

$category_check = strip_tags($fields['field_category']->content);
$brand_check = strip_tags($fields['field_brand']->content);
if ($category_check != 'Other') {
	$category = $fields['field_category']->handler->view->result[0]->field_field_category[0]['rendered'];
	if ($category['#type'] == 'link') {
	echo " | ";
	print '<div class="field-content">' . l(t($category['#title']), $category['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
	}
	else {
	echo " | ";
	print $fields['field_category']->content;
	}
}

if ($brand_check != 'Other') {
	$brand = $fields['field_brand']->handler->view->result[0]->field_field_brand[0]['rendered'];
	if ($brand['#type'] == 'link') {
		echo " | <meta itemprop='brand' content='".$brand_check."' />";
		print '<div class="field-content">' . l(t($brand['#title']), $brand['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
	}
	else {
		echo " | <meta itemprop='brand' content='".$brand_check."' />";
		print $fields['field_brand']->content;
	}
}
}
?>

</div>
</div>

</div>
<h4> <a id="All_Coupons"><?php echo get_label('Results For All Coupons Of This Product');?></a></h4>
<?php

echo $coupon =  coupons_copy_coupon($nid);

/** Start of By Ashish to track for view store click on product page */		

		echo '<script type="text/javascript"> mixpanel.track_links(".d_view_store a", "Click View Store Product Page", {Page: "'.$mixpanel_urlAlias.'", Retailer: "'.$mixpanel_retailer.'", Brand: "'.$mixpanel_brand.'", Category: "'.$mixpanel_category.'", Product: "'.$mixpanel_product_name.'", BaseUrl: "'.$base_url.'"}); </script>';

/** End of By Ashish to track for view store click on product page */	

?>
