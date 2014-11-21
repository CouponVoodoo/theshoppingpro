
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
			//var_dump($fields['nid']);
			$retailerName = strip_tags(($fields['field_retailer']->content));
			$coupon_code = strip_tags(($fields['field_coupon_code']->content));
			$coupon_code = str_replace(" ","_",$coupon_code);
			$coupon_title = strip_tags(($fields['field_coupon_title']->content));
			$title = strip_tags(($fields['field_coupon_title']->content));
			$last_checked_time = strip_tags(($fields['field_field_coupon_expiry']->content));
            $cat = strip_tags(($fields['field_category']->content));
			//$cat=$view->get_title();
			echo "<pre>";
			//var_dump($fields['field_category']->handler->view->result[0]->_field_data['nid']['entity']->field_category['und'][0]['tid']);
			echo "</pre>";
			$catid=$fields['field_category']->handler->view->result[0]->_field_data['nid']['entity']->field_category['und'][0]['tid']; 
			//$cat=str_replace('Coupons, Discounts, Offers & Deals','',$cat);
			//$node = node_load($nid);
			$rurl='http://www.couponvoodoo.com/r/'.str_replace('.','',$retailerName).'-coupons?f[0]=im_field_category%3A'.$catid;
			//$Query=db_query('SELECT ttd.tid FROM {taxonomy_term_data} AS ttd WHERE ttd.vid = 2 and ttd.name = :retailer_name', array(':retailer_name' => $retailerName));
    //$Ruery = $Query->fetch();
    //$retailerId = $Ruery->tid;
	//$rurl="http://www.couponvoodoo.com/taxonomy/term/".$retailerId;
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
			<h2><a rel='no follow' target='_blank'href='<?php print $coupon_display_url ?>' ><?php print $cat." coupons : ".$title." @ ".$retailerName; ?></a></h2>
			<div >



<?php
echo "<div class='coupon_status_guaranteed'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><span>Guaranteed To Work</span></div>"; ?>
<div >Updated: <?php print $last_checked_time; ?></div>

		
	</div>
	
	</div>
	<div class="coupon_page_search_listing_right">
	
		  <div class="search_listing_row__1 copy_coupon_row">
			<?php $div_id='ccp_'.$nid ;?>
<a href="<?php print $coupon_display_url;?>" onclick=window.open('<?php echo coupon_popup_product_url($coupon_code, $coupon_display_url); ?>')//;return true; class="unlock_best_coupon unlock_coupon" rel="best_<?php print $nid; ?>" data-clipboard-text="<?php echo $coupon_code?>" >
			<span class="copy_coupon">Copy Coupon</span><span></span>
			</a>	
	
			<div class="product-bottom" >
	<div class="product-right-bottom" itemprop="description">



<?php
$retailer = $fields['field_retailer']->handler->view->result[0]->field_field_retailer[0]['rendered'];
if ($retailer['#type'] == 'link') {
   print '<div class="field-content"><a href="'.$rurl.'" target="_blank">'.$retailerName. '</a></div>';
   // print '<div class="field-content">' . l(t('More '.$retailer['#title']).' Coupons', $retailer['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
}
else {
    print $fields['field_retailer']->content;
}

$category_check = strip_tags($fields['field_category']->content);

if ($category_check != 'Other') {
	$category = $fields['field_category']->handler->view->result[0]->field_field_category[0]['rendered'];
	if ($category['#type'] == 'link') {
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	//$aliasPath=drupal_lookup_path example('source',
	$curl='c/'.arg(1).'-coupons';
	print ' | <div class="field-content">' . l(t($category['#title']), 'http://www.couponvoodoo.com/'.$curl, array('attributes' => array('target' => '_blank'))) . '</div>';
	}
	else {
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	print " | ".$fields['field_category']->content;
	}
}

?>

		  </div>
	</div>
</div>
</div>
<?php
if ($_GET['showpop'] == 1) {	
?>
		<div id="coupon_details_popup"><a href="<?php print coupon_popup_url($_GET['coupon_code'], $coupon_redirect_path); ?>" rel='lightframe[|width:600px; height:450px; scrolling: off;]' ></a></div>
<?php
		drupal_add_js ("jQuery(document).ready(function() { jQuery('#coupon_details_popup a').trigger('click'); });", array('type' => 'inline', 'scope' => 'footer'));
	}
	?>