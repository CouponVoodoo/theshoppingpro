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
$nid = arg(1);

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
    
    echo "<a target='_blank' class='view_store1' href='{$fields['field_affiliateurl']->content}' >".$fields['field_product_image']->content."</a>";
        
    //print ($fields['field_product_images']->content);
    $status = strip_tags($fields['field_best_coupon_status']->content);
  
        echo "<div class='d_view_store'><a target='_blank' class='view_store' href='{$fields['field_affiliateurl']->content}' >View Store</a></div>";
	
    ?>

	</div>


<div class="product-right-inner">
<h2> <?php print ($fields['field_retailer_product_name']->content); ?></h2>
<div class="custom_link">Last Checked : <?php echo strip_tags($fields['field_lastcheckedtime']->content); ?> | <a onclick="locader('<?php echo $base_root.base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>')" class="active">Recheck Now</a></div>

<div class="product-right">
<h4>Best Coupon</h4>
<div class="coupon_code1">
    <?php       
    $CouponStatus = trim(strip_tags($fields['field_best_coupon_status']->content));
	$Couponsavingcheck = trim(strip_tags($fields['field_best_coupon_saving']->content));
	    
    if( $CouponStatus == 1 ){
        print coupons_copy_best_coupon($nid);
    }else{
        echo "<div class='d_view_store'><a target='_blank' class='view_store' href='{$fields['field_affiliateurl']->content}' >View Store</a></div>";
		
    }
    ?>
</div>
<ul>

<li>
    <label>Coupon Status:</label>
    <?php
    $CouponStatus = trim(strip_tags($fields['field_best_coupon_status']->content));
    if( $CouponStatus == 1 ){
        echo "<div class='pro_coupons_found'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><div class='pro_coupons_text'>Coupons Found</div></div>";
    }else{
        echo "<div class='pro_no_coupons_found'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><div class='pro_no_coupons_text'>No Coupons Found</div></div>";
    }
    ?>
</li>


<li><label>List Price:</label>INR <?php
    $ProductPrice = explode('.', str_replace('INR', '' ,strip_tags($fields['field_product_price']->content) ) );
    print number_format($ProductPrice[0],0, '.', ',');
        
    ?>
</li>
<?php
    if( $Couponsavingcheck != 'INR 1.00') {
?>
	<li><label>Saving:</label> <?php
			$CouponSaving = explode('.', strip_tags($fields['field_best_coupon_saving']->content)  );
			if( $CouponStatus == 1 ){
			//print ' INR '. number_format($CouponSaving[0],0, '.', ',');
				print $CouponSaving[0];
			}else{
			print '-';
			}
	}
    ?>
</li>
<?php
//$netPrice = explode('.', str_replace('INR', '' ,strip_tags($fields['field_best_coupon_netpriceafters']->content) ) );
$netPrice = explode('.', strip_tags($fields['field_best_coupon_netpriceafters']->content));

?>
<li>
    <li><label>Price After Coupon:</label><?php print(($netPrice[0]));?></li>
<?php if( $CouponStatus == 1 ){?>
<li><label>Best Coupon:</label><?php print ($fields['field_best_coupon_description']->content); ?></li>
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
$product_description = 'Buy '.strip_tags($fields['field_retailer_product_name']->content).' at the lowest price with the latest discounts, coupons and offers brought to you by CouponVoodoo. View the list of discounts codes below and click "Copy Coupon" to get the code.';
print $product_description;
echo nl2br("\n");
echo nl2br("\n");
$product_description_links = 'You may also want to view discount codes and offers for all products from:';
print $product_description_links;
print $fields['field_retailer']->content;
$category = strip_tags($fields['field_category']->content);
$retailer = strip_tags($fields['field_brand']->content);
if ($category != 'Other') {Print $fields['field_category']->content;}
if ($retailer != 'Other') {Print $fields['field_brand']->content;}

?>

</div>
</div>

</div>
<h4> Results For All Coupons Of This Product</h4>
<?php

echo $coupon =  coupons_copy_coupon($nid);

/** Start of By Ashish to track for view store click on product page */		

		echo '<script type="text/javascript"> mixpanel.track_links(".d_view_store a", "Click View Store Product Page", {Page: "'.$mixpanel_urlAlias.'", Retailer: "'.$mixpanel_retailer.'", Brand: "'.$mixpanel_brand.'", Category: "'.$mixpanel_category.'", Product: "'.$mixpanel_product_name.'", BaseUrl: "'.$base_url.'"}); </script>';

/** End of By Ashish to track for view store click on product page */	

?>
