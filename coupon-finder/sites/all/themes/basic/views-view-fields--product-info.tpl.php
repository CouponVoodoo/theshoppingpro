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

<a id="price_summary"></a>


<?php
$current_domain = get_current_domain();
$url_path = rawurlencode(drupal_get_path_alias());
$nid = arg(1);
$node = node_load($nid);
$mrp = $node->field_mrpproductprice['und'][0]['value'];
$list_price = $node->field_product_price['und'][0]['value'];
$retailer = strip_tags($fields['field_retailer']->content);
$retailer_name_predictor = str_replace(".com", "", $retailer);
$brand = strip_tags($fields['field_brand']->content);
$category_id = $node->field_category['und'][0]['tid'];
$base_url_predictor = $node->field_base_url['und'][0]['value'];
$non_coupon_saving = $mrp - $list_price;
$lastcheckedtime_check = strtotime(strip_tags($fields['field_lastcheckedtime']->content));
$current_time = round(microtime(true));
$time_gap = $current_time-$lastcheckedtime_check;
$CouponStatus = strip_tags($fields['field_best_coupon_status']->content);
$coupon_saving = $node->field_best_coupon_saving['und'][0]['value'];
$best_coupon_description = trim(str_replace('+','',str_replace('&amp;nbsp;','',str_replace('amp;','',strip_tags($fields['field_best_coupon_description']->content)))));
$best_coupon_code = $node->field_best_coupon_couponcode['und']['0']['value'];
global $base_url;
$redirect_url = $base_url.'/coupon-redirect/?l=olp&nid='.$nid.'&c=Link_Click'.'&p='.$url_path;

/********** detecting if mobile **************/
$detect = mobile_detect_get_object();
$is_tablet = $detect->isTablet();
$is_mobile = $detect->isMobile();
/** Start of By Ashish to get mixpanel variables */		
// global $base_url;
// $mixpanel_urlAlias = $base_url.'/'.drupal_get_path_alias('node/'.$nid);
// $mixpanel_retailer= strip_tags($fields['field_retailer']->content);
// $mixpanel_brand= strip_tags($fields['field_brand']->content);
// $mixpanel_category= strip_tags($fields['field_category']->content);
// $mixpanel_product_name= strip_tags($fields['field_retailer_product_name']->content);
// $mixpanel_base_url= strip_tags($fields['field_base_url']->content);
// $mixpanel_type='Product Page View Store';
/** End of By Ashish to get mixpanel variables */			

// ECHO $nid.'   '.$time_gap.'   '.$category_id.'   '.$retailer_name_predictor;

/** Start of getting live coupon info from predictor */

//	$test_nid_array = array(184733, 175283);
//	if (in_array($nid, $test_nid_array)){
	$run = 0; //currently the predictor feature is disabled
		if ($time_gap > (1.5 * 24 * 3600) && $category_id != 7400 && $run ==1) {
			If ( strtolower($retailer_name_predictor) == 'jabong' || strtolower($retailer_name_predictor) == 'myntra') {
				if ($mrp == 0) {$mrp = $list_price;}
				$sid = $retailer_name_predictor.'-'.$brand.'-'.$category_id; 
				$predictor_result = predictor_json($retailer_name_predictor, $brand, $category_id, $mrp, $list_price, 'full');
				// echo 'predictor: '.$predictor_result;
				$predictor_array = json_decode($predictor_result,true);
				//  var_dump($predictor_array);
				// echo 'test for error'.$predictor_array['Error'];
				if ($predictor_result != 'error' && empty($predictor_array['Error'])){
					$predictor_status = 1;
					if($predictor_array[0]["Successful"]==1){
						$prediction_state = 'Coupon Found';
						$best_status_predictor = 1;
						$CouponStatus = $best_status_predictor; // overwriting database value
						// echo ' best_status_predictor: '.$best_status_predictor;
						$best_coupon_code_predictor = $predictor_array[0]["couponCode"];
						$best_coupon_code = $best_coupon_code_predictor;
						
						// echo ' best_coupon_code_predictor: '.$best_coupon_code_predictor;
						$saving_predictor = $predictor_array[0]["Saving"];
						$coupon_saving = $saving_predictor; // overwriting database value
						// echo 'saving predicted '.$coupon_saving;
						// echo ' saving_predictor: '.$saving_predictor;
						$coupon_description_predictor = $predictor_array[0]["description"];
						$best_coupon_description = $coupon_description_predictor; // overwriting database value
						// echo ' coupon_description_predictor: '.$coupon_description_predictor;
					} else {
						// echo 'no successful coupon';
						$best_status_predictor = 0;
						$prediction_state = 'Coupon Not Found';
					}
				} else {
					 // echo 'error';
					// mail('team@theshoppingpro.com','Prediction Error: '.$retailer_name_predictor,'NID: '.$nid.' TIME: '.time().' PATH: '.drupal_get_path_alias().' Json error: '.$predictor_array['Error'].' Predictor Function Error: '.$predictor_result. ' API URL: '.'http://plugin.theshoppingpro.com/cpnVodo/simulation/updateOldUrlsApi.php?sid='.urlencode($sid).'&mrp='.urlencode($mrp).'&listPrice='.urlencode($list_price).'&type=full'); 
					$best_status_predictor = 0;
					$predictor_status = 0;
					$prediction_state = 'API Error';
						
				}
			/** End of getting live coupon info from predictor */

		
	/** Pushing Predictor Status Into Google Analytics **/
	drupal_add_js(array('predictor' => array(			
			'Event_Id' => 'Predictor-'.uniqid(),
			'Event_Location' => 'http://plugin.theshoppingpro.com/cpnVodo/simulation/updateOldUrlsApi.php?sid='.urlencode($sid).'&mrp='.urlencode($mrp).'&listPrice='.urlencode($list_price).'&type=full',
			'Event_Page' => drupal_get_path_alias(),
			'Click_Time' => gmdate('Y-m-d\TH:i:s\Z', (time()-(5.5*3600))),
			'Retailer' =>  $retailer_name_predictor.'('.$node->field_retailer['und']['0'][tid].')',
			'Brand' => $brand.'('.$node->field_brand['und']['0'][tid].')',
			'Category' => $category_id,
			'Prediction_State' => $prediction_state,
			'Domain' => get_current_domain(),
			)), array('type' => 'setting', 'scope' => 'footer'));
	
	
	
	drupal_add_js("jQuery(window).load(function(){
				 ga('send', 'event', 'predictor', 'product-page', Drupal.settings.predictor.Event_Page,{
					'dimension5': Drupal.settings.predictor.Event_Location, 
					'dimension6': Drupal.settings.predictor.Event_Page, 
					'dimension7': Drupal.settings.predictor.Click_Time, 
					'dimension9': Drupal.settings.predictor.Retailer, 
					'dimension10': Drupal.settings.predictor.Brand, 
					'dimension11': Drupal.settings.predictor.Category, 
					'dimension13': Drupal.settings.predictor.Domain,
					'dimension14': Drupal.settings.predictor.Prediction_State,
					});
	        });", array('type' => 'inline', 'scope' => 'footer'));
	
			}
		}
?>


<!-- ********************* START OF CHART DATA FOR COUPON OVERVIEW ************************  -->
<!--
<script type="text/javascript" src="<?php //echo $base_url;?>/sites/all/libraries/Fusioncharts/FusionCharts.js"> </script>
-->
<?php
	/**************** HIDING GRAPH FROM MOBILE ********************************/
	if(!$is_mobile && !$is_tablet){
		$full_data_array_std_class = db_query("SELECT updateDate, couponStatus, BestCouponCode, NetPriceAfterSaving FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$full_data_array = json_decode(drupal_json_encode($full_data_array_std_class), true);
		$dates = array();
		$coupons = array();
		$price = array();
		$all_count = 0;
		$coupon_count = 0; 
		foreach($full_data_array as $array)
		{
			$dates[] = array('updateDate'=>$array['updateDate']);
			$price[] = array('NetPriceAfterSaving'=>$array['NetPriceAfterSaving']);
			$coupons[] = array('couponStatus'=>$array['couponStatus'],'BestCouponCode'=>$array['BestCouponCode']);
			$all_count++;
			if($array['couponStatus'] == 1){$coupon_count++;}
		}		
		// $dates = db_query("SELECT updateDate FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$dates_data = drupal_json_encode($dates);
		$dates_data = str_replace("updateDate","label",$dates_data);
		// $coupons = db_query("SELECT couponStatus, BestCouponCode FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$coupons_data = drupal_json_encode($coupons);
		$coupons_data = str_replace('"couponStatus":"0","BestCouponCode":""','"value":"0", "displayValue":"No Coupon Found","link":"N-'.$redirect_url.'", "tooltext":"No Coupon Found"',$coupons_data);
		$coupons_data = str_replace('"couponStatus":"1","BestCouponCode":"','"value":"1", "displayValue":"Coupon Found","link":"N-'.$redirect_url.'", "tooltext":"Coupon Found: ',$coupons_data);
		// $price = db_query("SELECT NetPriceAfterSaving FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$price_data = drupal_json_encode($price);		
		// start of get max value to create some gap on top of chart
			$json = json_decode($price_data,true);
			$max = max($json);
			$max_value = 1.20 * $max["NetPriceAfterSaving"];
		// end of get max value to create some gao on top of chart
		$price_data = str_replace('"NetPriceAfterSaving"','"link":"N-'.$redirect_url.'","value"',$price_data);
		// $all_count = db_query("SELECT COUNT(*) FROM {priceHistory} WHERE entity_id = ".$nid)->fetchfield();
		// $coupon_count = db_query("SELECT COUNT(*) FROM {priceHistory} WHERE CouponStatus = 1 AND entity_id = ".$nid)->fetchfield();
		$coupon_meter = $coupon_count/$all_count * 100;
		$coupon_meter = number_format($coupon_meter,2, '.', ',');
		
		$coupon_overview_json = '
			{
			  "chart": {
				"caption":"Coupon Meter",
				"subCaption":"Times Coupons Found In Past Weeks",
				"clickURL": "#price_history",
				"xaxisname": "",
				"manageresize": "1",
				"origw": "350",
				"origh": "200",
				"palette": "2",
				"bgalpha": "0",
				"bgcolor": "FFFFFF",
				"lowerlimit": "0",
				"upperlimit": "100",
				"numbersuffix": "%",
				"showborder": "0",
				"basefontcolor": "FFFFFF",
				"charttopmargin": "3",
				"captionPadding":"0",
				"chartbottommargin": "0",
				"tooltipbgcolor": "F7971C",
				"gaugefillmix": "{dark-10},{light-70},{dark-10}",
				"gaugefillratio": "3",
				"pivotradius": "8",
				"gaugeouterradius": "90",
				"gaugeinnerradius": "70%",
				"gaugeoriginx": "175",
				"gaugeoriginy": "170",
				"trendvaluedistance": "5",
				"tickvaluedistance": "3",
				"managevalueoverlapping": "1",
				"autoaligntickvalues": "1"
			  },
			  "colorrange": {
				"color": [
				  {
					"minvalue": "0",
					"maxvalue": "25",
					"code": "FF654F"
				  },
				  {
					"minvalue": "25",
					"maxvalue": "75",
					"code": "F6BD0F"
				  },
				  {
					"minvalue": "75",
					"maxvalue": "100",
					"code": "8BBA00"
				  }
				]
			  },
			  "dials": {
				"dial": [
				  {
					"value": "'.$coupon_meter.'",
					"rearextension": "10",
					"basewidth": "10"
				  }
				]
			  },
			  "annotations": {
				"groups": [
				  {
					"id": "Grp1",
					"showbelow": "1",
					"showshadow": "1",
					"items": [
					  {
						"type": "rectangle",
						"x": "$chartStartX+5",
						"y": "$chartStartY+5",
						"tox": "$chartEndX-5",
						"toy": "$chartEndY-5",
						"radius": "10",
						"fillcolor": "25ade3,25ade3",
						"showborder": "0"
					  }
					]
				  }
				]
			  },
			  "styles": {
				"definition": [
				  {
					"name": "RectShadow",
					"type": "shadow",
					"strength": "3"
				  },
				  {
					"name": "trendvaluefont",
					"type": "font",
					"bold": "1",
					"bordercolor": "FFFFDD"
				  }
				],
				"application": [
				  {
					"toobject": "Grp1",
					"styles": "RectShadow"
				  },
				  {
					"toobject": "Trendvalues",
					"styles": "trendvaluefont"
				  }
				]
			  }
			}
		';

		drupal_add_js(array('coupon_overview' => array('coupon_overview_json' => $coupon_overview_json)), array('type' => 'setting', 'scope' => 'footer', 'weight' => '-10'));
	}
?>
<!-- ********************* END OF CHART DATA FOR COUPON OVERVIEW ************************  -->

<!-- ********************* START OF FLOATING MENU ************************  --> 
<div class="float_bar back_button_bg">
<ul>
<li><a href="#price_summary"><img src="<?php echo $base_url;?>/sites/all/themes/basic/images/price_summary.png" width="48" height="48" border="0"/>Price Summary</a></li>
<li><a href="#All_Coupons"><img src="<?php echo $base_url;?>/sites/all/themes/basic/images/coupon_list.png" width="48" height="48" border="0"/>Coupon List</a></li>
<?php if ($all_count > 2) { ?>
	<li><a href="#price_history"><img src="<?php echo $base_url;?>/sites/all/themes/basic/images/price_history.png" width="48" height="48" border="0"/>Price History</a></li>
<?php } ?>
<li><a href="<?php echo $base_url;?>/search/site/<?php echo $node->field_retailer_product_name['und']['0']['value']; ?>" target = "_blank"><img src="<?php echo $base_url;?>/sites/all/themes/basic/images/all_similar_products.png" width="48" height="48" border="0"/><?php echo nl2br("\n");?>Similar Products</a></li>
<li><a href="<?php echo $base_url;?>/search/site/<?php echo $node->field_retailer_product_name['und']['0']['value']; ?>?f[0]=sm_field_best_coupon_status_disp%3AGuaranteed%20Coupons" target = "_blank"><img src="<?php echo $base_url;?>/sites/all/themes/basic/images/similar_with_coupons.png" width="48" height="48" border="0"/>Similar With Coupons</a></li>
</ul>
</div>
<!-- ********************* END OF FLOATING MENU ************************  --> 



<div class="product-detail" itemscope itemtype='http://schema.org/Product'>

<div class="product-inner">
<div class="product-left">
    <?php
		// echo "<a rel='nofollow' class='view_store1' href='{$redirect_url}' >".$fields['field_product_image']->content."</a>";
		echo "<div class='field-content product_img'><a href='".$redirect_url."' target = '_blank'><img  itemprop='image' src='".$node->field_product_image['und'][0]['value']."' alt='".$node->field_retailer_product_name['und']['0']['value']."' /></a></div>"; 
		//print ($fields['field_product_images']->content);
		$status = strip_tags($fields['field_best_coupon_status']->content);
		// echo "<div class='d_view_store'><a rel='nofollow' target='_blank' class='view_store' href='{$fields['field_affiliateurl']->content}' >View Store</a></div>";
		$product_link = '/search/site/'.str_replace('+at+'.$retailer,'',str_replace(' ','+',strip_tags($fields['field_retailer_product_name']->content)));
	?>

	<div id="coupon_meter"></div> 
	<?PHP
		if ($all_count > 2 && !$is_tablet && !$is_mobile) {
			drupal_add_js($base_url.'/sites/all/libraries/Fusioncharts/FusionCharts.js',  array('scope' => 'footer', 'weight' => '-10'));
			drupal_add_js("jQuery(window).load(function(){
				var myChart = new FusionCharts( 'AngularGauge', 'coupon_overview', '105%', '150', '1' );
				myChart.setJSONData(Drupal.settings.coupon_overview.coupon_overview_json);
				myChart.render('coupon_meter');
			});", array('type' => 'inline', 'scope' => 'footer', 'weight' => '-10'));
		} else {
	?>
	<div class='blue_button'><a href="<?php echo $product_link;?>" class='d_view_store'><?php echo get_label('View More From ').substr($brand, 0, 40);?></a></div>
	<?php } ?>
</div>


<div class="product-right-inner">
<h1> <?php 
	if ($current_domain =='cuponation'){
		echo "<meta itemprop='name' content ='".$node->field_retailer_product_name['und']['0']['value']."'/><meta itemprop='sku' content ='CN".$nid."'/><a href='".$redirect_url."' target = '_blank'>".$node->field_retailer_product_name['und']['0']['value']." @ ".$retailer." For Rs. ".$node->field_best_coupon_netpriceafters['und']['0']['value']." Using Coupons & Discount Offers | CN".$nid."</a>"; } 
	else { 
		echo "<meta itemprop='name' content ='".$node->field_retailer_product_name['und']['0']['value']."'/><meta itemprop='sku' content ='CV".$nid."'/><a href='".$redirect_url."' target = '_blank'>".strip_tags($fields['field_retailer_product_name']->content)." | CV".$nid."</a>"; }?></h1>

<?php 


/* Commented out since recheck alert there below status too */
// if ( $time_gap > (1 * 27 * 3600)) {

if ($current_domain != 'cuponation'){
?>
	<div class="custom_link">Last Checked : <?php echo strip_tags($fields['field_lastcheckedtime']->content); ?> | <a onclick="locader('<?php echo $base_root.base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>')" class="active">Recheck Now</a></div>
<?php } ?>

<div class="product-right" >
<h4><?php echo get_label('Best Coupon Or Discounts');?></h4>
<div class="coupon_code1">
    <?php       
    if( $CouponStatus == 1 ){
		/** start of changed to display copy coupon right here - uncomment print and comment rest if problem happens **/
         //print coupons_copy_best_coupon($nid);
		 
	?>	
	<div class="search_listing_right">
		<div class="search_listing_row__<?php print $row->counter; ?> copy_coupon_row">
			<a href="<?php print $base_url ?>/coupon-redirect?l=bc&nid=<?php print $nid;?>&c=<?php print $best_coupon_code; ?>&p=<?php print $url_path; ?>&s=<?php print $base_url_predictor;?>" target="_blank" class="unlock_best_coupon unlock_coupon" rel="best_<?php print $row->counter; ?>" data-clipboard-text="<?php echo $best_coupon_code?>" >
				<span class="copy_coupon">Copy Coupon</span><span></span>
			</a>
		</div>		
	</div>
		
	<?php	
		
		/** end of changed to display copy coupon right here - uncomment print and comment rest if problem happens **/
		
    }else{
        echo "<div class='d_view_store'><a class='view_store' href='{$redirect_url}' target='_blank'>".get_label('Buy Now')."</a></div>";
		
    }
    ?>
</div>
<ul>

<li>
    <label>Status:</label>
    <?php

		if($CouponStatus == 1 ){
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
<?php if ( $time_gap > (1.5 * 24 * 3600)) {?>
	<div class="custom_link_inner"><span style= "color: red; font-weight: bold"><?php echo get_label('Data is more than 24hrs old: ');?></span><a onclick="locader('<?php echo $base_root.base_path() ?>add-product/u/?url=<?php echo strip_tags($fields['field_base_url']->content);?>&recheck=1&id=<?php echo $fields['nid']->content; ?>')" class="active">Recheck Now</a></div>
<?php } ?>



<?php
	if ($node->field_best_coupon_saving['und'][0]['value'] == 1 && $CouponStatus == 1){
		echo "<li> <label>".get_label('List Price:')."</label><div itemscope itemtype='http://schema.org/Offer'><meta  itemprop='category' content='".strip_tags($fields['field_category']->content)."' /><meta itemprop='priceCurrency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</div></li>";
		echo "<li> <label>".get_label('Savings:')."</label>See Best Coupon</li>";
		echo "<li> <label>".get_label('Offer:')."</label>See Best Coupon</li>";
	
	
	} else {
		if ($coupon_saving > 1 && $CouponStatus == 1){
				echo "<li> <label>".get_label('List Price:')."</label>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>".get_label('INR ').number_format($coupon_saving,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><div class='net_price' itemprop='offers' itemscope itemtype='http://schema.org/Offer'><meta  itemprop='category' content='".strip_tags($fields['field_category']->content)."' /><meta itemprop='priceCurrency' content='INR' /><meta itemprop='price' content='".number_format(($list_price-$coupon_saving),0, '.', ',')."'/>".get_label('INR ').number_format($list_price-$coupon_saving,0, '.', ',')."</div></li>";

		} else {
			if ($non_coupon_saving > 0){
				echo "<li> <label>".get_label('MRP:')."</label>".get_label('INR ').number_format($mrp,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>".get_label('INR ').number_format($non_coupon_saving,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><div class='net_price' itemprop='offers' itemscope itemtype='http://schema.org/Offer'><meta  itemprop='category' content='".strip_tags($fields['field_category']->content)."' /><meta itemprop='priceCurrency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</div></li>";
					
			} else {
				echo "<li> <label>".get_label('MRP:')."</label>".get_label('INR ').number_format($list_price,0, '.', ',')."</li>";
				echo "<li> <label>".get_label('Savings:')."</label>-</li>";
				echo "<li> <label>".get_label('Net Price:')."</label><div class='net_price' itemprop='offers' itemscope itemtype='http://schema.org/Offer'><meta  itemprop='category' content='".strip_tags($fields['field_category']->content)."' /><meta itemprop='priceCurrency' content='INR' /><meta itemprop='price' content='".number_format($list_price,0, '.', ',')."'/>".get_label('INR ').number_format($list_price,0, '.', ',')."</div></li>";	
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
			->fieldCondition('field_coupon_code', 'value', $best_coupon_code, '=');
		$result = $query->execute();		
		$nids = array_keys($result['node']);
		$retailer_coupon = node_load($nids[0]);
		$cuponation_title = $retailer_coupon->field_cuponation_title['und']['0']['value'];
		if (!empty($result['node']) && !empty($cuponation_title)) {
			//echo $cuponation_title;
			echo $cuponation_title;
		} else {
			// print ($fields['field_best_coupon_description']->content); 
			echo $best_coupon_description;
		}	
	} else {
		// print ($fields['field_best_coupon_description']->content); 
		echo $best_coupon_description;
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
<div class="product-bottom" >
<?php /* ?> <div class="product-left">
<ul>
<li><label>Retailer:</label><?php print ($fields['field_retailer']->content); ?></li>
<li><label>Brand:</label><?php print ($fields['field_brand']->content); ?></li>
<li><label>Category:</label><?php print ($fields['field_category']->content); ?></li>
</ul>
</div>
*/ ?>

<div class="product-right-bottom" itemprop="description">


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
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	print ' | <div class="field-content">' . l(t($category['#title']), $category['#href'], array('attributes' => array('target' => '_blank'))) . '</div>';
	}
	else {
	// echo " | <div class='category_meta' itemscope itemtype='http://schema.org/offer'><meta  itemprop='category' content='".$fields['field_category']->content."' /></div>";
	print " | ".$fields['field_category']->content;
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
	/** If predictor then the other coupons comes via the predictor array**/
	$i = 0;
	if ($predictor_status == 1) {
		
	?>
	<ul id="coupon_search_listing" class="custom-coupon_search_listing"><li id="search_listing_li_row_1" class="search_listing_row_li first">
	<?php
		foreach($predictor_array as $predictor_set){
			$coupon_code_predictor = $predictor_array[$i]["couponCode"];
			$saving_predictor = $predictor_array[$i]["Saving"];
			$coupon_description_predictor = $predictor_array[$i]["description"];
			$successful_predictor = $predictor_array[$i]["Successful"];
			$i++;
					$net_price = $list_price - $saving_predictor;
					if ($successful_predictor=="1") {
					  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u67_normal.png";
					  $best_coupon = !empty($best_status_predictor) ? '<span class="best_coupon">Best Coupon (Guaranteed To Work)</span>' : '<div class="coupon_status_guaranteed"><img src="'.$image_right.'"><span>Guaranteed To Work</span></div>';
					}else {
					  $image_right = $base_url. "/". drupal_get_path('theme', 'basic')."/images/u71_normal.png";
					  $best_coupon = !empty($best_status_predictor) ? '<span class="best_coupon">Best Coupon (Guaranteed To Work)</span>' : '<span class="best_coupon_image red">This coupon does not work for your product</span>';
					}
				?>
			<li id="search_listing_li_row_<?php echo $i;?>" class="search_listing_row_li first">
				<div class="search_listing_left">
				  <div class="row_1">
				   <div class='description'>
					  <label><?php echo get_label('Description:');?></label>
					  <div class="search_listing_row_1 search_listing_row"><?php print $coupon_description_predictor;?></div>
					</div>
				  </div>
				  <div class="row_2">
					<?php if ($successful_predictor=="1") : ?>
						<label><?php echo get_label('Savings:');?></label>
						<div class="search_listing_row_1 search_listing_row"><div class="saving"><?php print get_label('This coupon helps you save ').get_label('INR ').$saving_predictor.get_label(' on ').strip_tags($fields['field_retailer_product_name']->content);?></div></div>
						<label><?php echo get_label('Net Price:');?></label>
						<div class="search_listing_row_1 search_listing_row"><div class="saving"><?php print get_label('INR ').number_format($net_price,0, '.', ',');?></div></div>
					<?php else: ?>
						<label><?php echo get_label('Savings:');?></label>
						<div class="search_listing_row_1 search_listing_row"><div class="saving"></div><?php print get_label('This coupon does not work for your product'); ?></div>
					<?php endif; ?>
				  </div>
				 <?php /* if ($row->Successful != "1") : ?>
				  <div class="row_3">
					<label><?php echo get_label('Response:');?></label>
					<div class="search_listing_row_<?php print $row->counter; ?>' search_listing_row"><?php print $row->Saving;?></div>
				  </div>
				  <?php endif; */?>
				</div>
			
				<div class="search_listing_right">
				  <div class="search_listing_row__1 copy_coupon_row">
					<a href="<?php print $base_url ?>/coupon-redirect?l=oc&nid=<?php print $nid;?>&c=<?php print $coupon_code_predictor; ?>&p=<?php print $url_path; ?>&s=<?php print urlencode($url_path);?>" target="_blank" class="unlock_coupon" rel="c_1" data-clipboard-text="<?php echo $coupon_code_predictor?>">
					  <span class="copy_coupon">Copy Coupon</span><span></span>
					</a>
				  </div>
				</div>
			</li>

<?php			
		}
?>
	</ul>

<?php
	} else {
		echo $coupon =  coupons_copy_coupon($nid);
		drupal_add_js(($base_url.'/sites/all/themes/basic/js/custom.js'), array('scope' => 'footer'));
?>
<!--		<script type="text/javascript" src="<?php //echo $base_url;?>/sites/all/themes/basic/js/custom.js"> </script> -->
		<div id="show_more" class="show_more"><a onclick="show_more_coupon_list();jQuery(this).hide();"> + Show All Coupons</a></div>
<?php
	}

/** Start of By Ashish to track for view store click on product page */		

		// echo '<script type="text/javascript"> mixpanel.track_links(".d_view_store a", "Click View Store Product Page", {Page: "'.$mixpanel_urlAlias.'", Retailer: "'.$mixpanel_retailer.'", Brand: "'.$mixpanel_brand.'", Category: "'.$mixpanel_category.'", Product: "'.$mixpanel_product_name.'", BaseUrl: "'.$base_url.'"}); </script>';

/** End of By Ashish to track for view store click on product page */	

?>

<!--              ********************* COUPON & PRICE HISTORY CHART *****************************    -->

	
<?php

		$full_data_array_std_class = db_query("SELECT updateDate, couponStatus, BestCouponCode, NetPriceAfterSaving FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$full_data_array = json_decode(drupal_json_encode($full_data_array_std_class), true);
		$dates = array();
		$coupons = array();
		$price = array();
		$all_count = 0;
		$coupon_count = 0; 
		
		foreach($full_data_array as $array)
		{
			$dates[] = array('updateDate'=>$array['updateDate']);
			$price[] = array('NetPriceAfterSaving'=>$array['NetPriceAfterSaving']);
			$coupons[] = array('couponStatus'=>$array['couponStatus'],'BestCouponCode'=>$array['BestCouponCode']);
			$all_count++;
			if($array['couponStatus'] == 1){$coupon_count++;}
		}		
		// $dates = db_query("SELECT updateDate FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$dates_data = drupal_json_encode($dates);
		$dates_data = str_replace("updateDate","label",$dates_data);
		// $coupons = db_query("SELECT couponStatus, BestCouponCode FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$coupons_data = drupal_json_encode($coupons);
		$coupons_data = str_replace('"couponStatus":"0","BestCouponCode":""','"value":"0", "displayValue":"No Coupon Found","link":"N-'.$redirect_url.'", "tooltext":"No Coupon Found"',$coupons_data);
		$coupons_data = str_replace('"couponStatus":"1","BestCouponCode":"','"value":"1", "displayValue":"Coupon Found","link":"N-'.$redirect_url.'", "tooltext":"Coupon Found: ',$coupons_data);
		// $price = db_query("SELECT NetPriceAfterSaving FROM {priceHistory} WHERE entity_id = ".$nid)->fetchAll();
		$price_data = drupal_json_encode($price);		
		// start of get max value to create some gap on top of chart
			$json = json_decode($price_data,true);
			$max = max($json);
			$max_value = 1.20 * $max["NetPriceAfterSaving"];
		// end of get max value to create some gao on top of chart
		$price_data = str_replace('"NetPriceAfterSaving"','"link":"N-'.$redirect_url.'","value"',$price_data);
		
		
		
		
		//echo $dates_data."\n\n\n".$coupons_data."\n\n\n".$price_data;

		if($node->type == '_product_and_coupon' && $all_count > 2 && !$is_mobile && !$is_tablet) {
?>

<h4> <a id="price_history"><?php echo get_label('Coupon & Price History For ')." ".$node->field_retailer_product_name['und']['0']['value'];?></a></h4>
<!-- <script type="text/javascript" src="<?php echo $base_url;?>/sites/all/libraries/Fusioncharts/FusionCharts.js"> </script> -->
<div id="coupon_price_history_graph"></div> 

<?php
		
			$all_data_json = '{
				  "chart": {
					"palette": "3",
					"caption": "",
					"pyaxisname": "",
					"syaxisname": "",
					"xaxisname": "",
					"animation": "1",
					"formatnumberscale": "0",
					"snumberprefix": "Rs. ",
					"labeldisplay": "STAGGER",
					"seriesnameintooltip": "0",
					"showToolTip": "1",
					"anchoralpha": "100",
					"anchorradius": "7",
					"placeValuesInside": "1",
					"rotatevalues": "1",
					"valuePosition": "ABOVE",
					"yaxisvaluespadding": "5",
					"showvalues": "0",
					"showYAxisValues": "0",
					"outCnvbaseFontColor": "009933",
					"outCnvbaseFontSize": "12",
					"outCnvbaseFont":"Arial",
					"yAxisNamePadding": "0",
					"canvaspadding": "20",
					"chartTopMargin":"10",
					"chartLeftMargin":"0",
					"SYAxisMaxValue":"'.$max_value.'",
					"valuepadding": "1"
				  },
				  "categories": [
					{
					  "category": '.$dates_data.'
					}
				  ],
				  "dataset": [
					{
					  "seriesname": "PRICE (After Coupons)",
					  "parentyaxis": "S",
					  "color": "357EC7",
					  "Thickness":"3",
					  "data": '.$price_data.'
					},
					{
					  "seriesname": "COUPON FOUND?",
					  "data": '.$coupons_data.'
					}
				  ],
				  "styles": {
					"definition": [
					  {
						"type": "font",
						"name": "CaptionFont",
						"size": "15",
						"color": "666666"
					  },
					  {
						"type": "font",
						"name": "SubCaptionFont",
						"bold": "0"
					  }
					],
					"application": [
					  {
						"toobject": "caption",
						"styles": "CaptionFont"
					  },
					  {
						"toobject": "SubCaption",
						"styles": "SubCaptionFont"
					  }
					]
				  },
					"trendlines":[{
					  "line":[{
						  "startvalue":"1.02",
						  "color":"009933",
						  "displayvalue":"C{br}O{br}U{br}P{br}O{br}N{br}S",
						  "showValues":"0",
						  "fontsize": "15",
						  "thickness":"3",
						  "dashed": "1",
						  "dashLen": "10",						  
						  "dashGap": "4"
						}
					  ]
					}
				  ]

				  
				}';
			
			//echo $all_data_json; die();

			// $coupon_data_json .= '"data" : '.$coupon_data.'}';
			drupal_add_js(array('all_data' => array('all_data_json_js' => $all_data_json)), array('type' => 'setting', 'scope' => 'footer', 'weight' => '-10'));
			drupal_add_js("jQuery(window).load(function(){
				var myChart = new FusionCharts( 'MSColumn3DLineDY', 'coupon_price_history', '100%', '400', '1' );
				myChart.setJSONData(Drupal.settings.all_data.all_data_json_js);
				myChart.render('coupon_price_history_graph');
			});", array('type' => 'inline', 'scope' => 'footer', 'weight' => '-10'));
		}
		
		/* EVENT TRACKING FOR SEARCH */
		
    if (isset($_SESSION['CvGa'])) {
		drupal_add_js(array('ga_search' => array(			
				'keyword' => $_SESSION['CvGa']['url']
			)), array('type' => 'setting', 'scope' => 'footer', 'weight' => '-10'));
		if($_SESSION['CvGa']['urlStatus'] == 0) {
			drupal_add_js("jQuery(window).load(function(){
				ga('send', 'event', 'site-search', 'keyword', Drupal.settings.ga_search.keyword);
				alert (Drupal.settings.ga_search.keyword);
			});", array('type' => 'inline', 'scope' => 'footer', 'weight' => '-20'));
		} else {	
			drupal_add_js("jQuery(window).load(function(){
				ga('send', 'event', 'site-search', 'url', Drupal.settings.ga_search.keyword);
				alert (Drupal.settings.ga_search.keyword);
			});", array('type' => 'inline', 'scope' => 'footer', 'weight' => '-20'));	
		}
		unset($_SESSION['CvGa']);
    }
?>