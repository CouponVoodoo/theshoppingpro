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
?>
<div class="product-detail">

<div class="product-inner">
<div class="product-left">
    <?php
    
    print ($fields['field_product_image']->content);
        
    //print ($fields['field_product_images']->content);
    $status = strip_tags($fields['field_best_coupon_status']->content);
    if( $status == 0){
        echo "<div class='d_view_store'><a target='_blank' class='view_store' href='{$node->field_affiliateurl[und][0]['value']}'>View Store</a></div>";
    }
    //field_base_url
    //nid
    ?>
</div>


<div class="product-right-inner">
<h2> <?php print ($fields['field_retailer_product_name']->content); ?></h2>
<div class="custom_link">Last Checked : <?php echo strip_tags($fields['field_lastcheckedtime']->content); ?> | <a href="<?php echo base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>" class="active">Recheck Now</a></div>
<div class="product-right">
<h4>Best Coupon</h4>
<div class="coupon_code1">
    <?php       
    $CouponStatus = trim(strip_tags($fields['field_best_coupon_status']->content));
    
    if( $CouponStatus == 1 ){
        print coupons_copy_best_coupon($nid);
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
    print $ProductPrice[0];
        
    ?>
</li>
<li><label>Saving:</label> <?php
    $CouponSaving = explode('.', str_replace('INR', '' ,strip_tags($fields['field_best_coupon_saving']->content) ) );
    if( $CouponStatus == 1 ){
        print ' INR '. $CouponSaving[0];
    }else{
        print '-';
    }
    ?>
</li>
<?php
$netPrice = explode('.', str_replace('INR', '' ,strip_tags($fields['field_best_coupon_netpriceafters']->content) ) );
?>
<li><label>Price After Coupon:</label> INR <?php print($netPrice[0]); ?></li>
<?php if( $CouponStatus == 1 ){?>
<li><label>Best Coupon:</label><?php print ($fields['field_best_coupon_description']->content); ?></li>
<?php }?>
</ul>


<?php //} ?>
</div>
</div>
</div>
<div class="product-bottom">
<div class="product-left">
<ul>
<li><label>Retailer:</label><?php print ($fields['field_retailer']->content); ?></li>
<li><label>Brand:</label><?php print ($fields['field_brand']->content); ?></li>
<li><label>Category:</label><?php print ($fields['field_category']->content); ?></li>
</ul>
</div>
<div class="product-right-bottom">
<?php print ($fields['field_description']->content); ?>
</div>
</div>

</div>
<?php
echo $coupon =  coupons_copy_coupon($nid);

?>