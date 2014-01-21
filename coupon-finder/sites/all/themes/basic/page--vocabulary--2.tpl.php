<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
<?php 

/** Start of modified by Ashish to Show offers in green ribbon when saving = 1 */

  if($node->field_best_coupon_saving['und'][0]['value'] > 1){ ?>
    <div class="ribbon-wrapper-green">
        <div class="ribbon-green">Save Rs <?php echo $node->field_best_coupon_saving['und'][0]['value']; ?></div>
  </div>
  		<?php } else if($node->field_best_coupon_saving['und'][0]['value'] == 1){ ?> 
    				<div class="ribbon-wrapper-green">
        			<div class="ribbon-green">Offers</div>
  			</div>
  <?php }  

/** End of modified by Ashish to Show offers in green ribbon when saving = 1 */

?>
  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <div class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </div>
      <?php endif; ?>

      <?php if ($unpublished): ?>
        <p class="unpublished"><?php print t('Unpublished'); ?></p>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <div class="content">
    <?php
      // We hide the comments to render below.
      hide($content['comments']);
      hide($content['links']);
      
      //echo "<div class='product_name'><a href='{$node->field_page_url[und][0]['value']}' >".substr($node->field_retailer_product_name[und][0]['value'], 0, 47)."</a></div>";
	
	if (!isset($_COOKIE['traffic_source8'])) {
	$original_source = 'Direct_Traffic';
	} else {
	$original_source = $_COOKIE['traffic_source8'];
	}
	
	$add_tracking = $original_source.'---'.urlencode(date('YmdHis')).'---'.urlencode($_SERVER['HTTP_USER_AGENT']);
	
	if( $node->field_best_coupon_status[und][0]['value'] == 1 ){
        echo "<div class='coupons_found'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><div class='coupons_text'>Coupons Found</div></div>";
	// $affiliate_url=urlencode($node->field_best_coupon_url['und']['0']['value']);
	// $affiliate_url_uncoded=$node->field_best_coupon_url['und']['0']['value'];
	$affiliate_url_uncoded = $node->field_best_coupon_url['und']['0']['value'];	
	}else{
        echo "<div class='no_coupons_found'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><div class='no_coupons_text'>No Coupons Found</div></div>";
	// $affiliate_url=urlencode($node->field_affiliateurl['und']['0']['value']);
	// $affiliate_url_uncoded=$node->field_affiliateurl['und']['0']['value'];
	$affiliate_url_uncoded = $node->field_affiliateurl['und']['0']['value'];
	}  
	/* BY ASHISH: REMOVED DUE TO LINK BREAKAGE */ 
	/*	if (strpos($affiliate_url_uncoded,'affiliates.tyroodr.com') > 1){
			// echo 'tyroo';
			if (strpos($affiliate_url_uncoded,'subid2') == false){
				// echo 'no subid2';
				$affiliate_url_uncoded = $affiliate_url_uncoded."&subid2=".$original_source."&subid3=".urlencode(date('YmdHis')).'---'.urlencode($_SERVER['HTTP_USER_AGENT']);
			}
		}
	
	if (strpos($affiliate_url_uncoded,'track.in.omgpm.com') > 1){
				// echo 'omg';
				$affiliate_url_uncoded = $affiliate_url_uncoded."&uid2=".$add_tracking;
		}
	*/
	$affiliate_url=urlencode($affiliate_url_uncoded);
	
 	global $base_url;
	// $urlAlias = $base_url.'/'.drupal_get_path_alias('node/'.$node->nid).'?width=600&height=600';
	$urlAlias = $base_url.'/'.drupal_get_path_alias('node/'.$node->nid)."?pop=1";
	$current_full_url = 'http://' .$_SERVER['HTTP_HOST'] .strtok($_SERVER["REQUEST_URI"],'?');
	
	/* BY ASHISH TO ENSURE POP UP ONLY COMES WHERE REQUIRED */
	if (!empty($_GET['popdisplay'])) {
	$popdisplay_value = $_GET['popdisplay']+1;
	$popup_url = $current_full_url.'?popdisplay='.$popdisplay_value.'&popurl='.urlencode($urlAlias);
	} else {
	$popup_url = $current_full_url.'?popdisplay=1&popurl='.urlencode($urlAlias);
	}
	
	
	$coupon_code=urlencode ($node->field_best_coupon_couponcode['und']['0'][value]);
	$coupon_display_url=$base_url."/coupon-redirect?s=".$affiliate_url."&c=".$coupon_code;
 	$uplImg = $node->field_product_images['und'][0]['uri'];
    $imgPath = $imgUri = image_style_url('200x200', $uplImg);
	$lightbox_url = $base_url."/node/".$node->nid."?pop=1";
	// $lightbox_url = $base_url."/node/".$node->nid;
		  
	  if($node->field_best_coupon_status[und][0]['value'] == 0){
	  $img = "<div class='field field-name-field-product-images field-type-image field-label-above'>
                    <div class='field-label'>Product images:&nbsp;</div>
                    <div class='field-items'>
                        <div class='field-item even product_img'>
							<a href='{$affiliate_url_uncoded}' onclick=window.open('{$popup_url}')//;return true;><img src='{$node->field_product_image['und'][0]['value']}' typeof='foaf:Image'></a>
                        </div>";
      echo  $img .=    "</div>
                </div>";

//	<a href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$affiliate_url_uncoded}')//;return true;><img src='{$node->field_product_image['und'][0]['value']}' typeof='foaf:Image'></a>

      echo "<div class='product_name'><a  href='{$affiliate_url_uncoded}' onclick=window.open('{$popup_url}')//;return true;>".substr($node->field_retailer_product_name[und][0]['value'], 0, 42)."</a></div>";
//	  echo "<div class='product_name'><a  href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$affiliate_url_uncoded}')//;return true;>".substr($node->field_retailer_product_name[und][0]['value'], 0, 42)."</a></div>";
	}
	  if($node->field_best_coupon_status[und][0]['value'] == 1){
	  $img = "<div class='field field-name-field-product-images field-type-image field-label-above'>
                    <div class='field-label'>Product images:&nbsp;</div>
                    <div class='field-items'>
                        <div class='field-item even product_img'>
							<a href='{$coupon_display_url}' onclick=window.open('{$popup_url}')//;return true;><img src='{$node->field_product_image['und'][0]['value']}' typeof='foaf:Image'></a>
                        
						</div>";
      echo  $img .=    "</div>
                </div>";
 //	<a href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$coupon_display_url}')//;return true;><img src='{$node->field_product_image['und'][0]['value']}' typeof='foaf:Image'></a>
  		  echo "<div class='product_name'><a href='{$coupon_display_url}' onclick=window.open('{$popup_url}')//;return true;>".substr($node->field_retailer_product_name[und][0]['value'], 0, 42)."</a></div>";
	    
//		  echo "<div class='product_name'><a href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$coupon_display_url}')//;return true;>".substr($node->field_retailer_product_name[und][0]['value'], 0, 42)."</a></div>";
	   }

 /** Start of modified by Ashish to Show reatiler name below product name */

      	$BrandTid = $node->field_brand[und][0]['tid'];
      	$RetailerTid = $node->field_retailer[und][0]['tid'];
      	$CategoryTid = $node->field_category[und][0]['tid'];


      	echo '<span style="color:blue; font-size:11px; color: #F7971C; line-height: 30px;">(</span>'.coupons_get_taxonomy_url($RetailerTid).'<span style="color:blue; font-size:11px; color: #F7971C">)</span>';
	echo "</br>";

 /** end of modified by Ashish to to Show reatiler name below product name*/
 
      echo $listPrice = "<div class='field field-name-field-product-price field-type-number-integer field-label-above'>
                        <div class='field-label'>List Price:&nbsp;</div>
                        <div class='field-items'>
                            <div class='field-item even'>INR ".number_format($node->field_product_price['und'][0]['value'],0, '.', ',')."</div>
                        </div>
                    </div>";
      $listPrice = "<div class='field field-name-field-best-coupon-saving field-type-number-integer field-label-above'>
                            <div class='field-label'>Savings:&nbsp;</div>
                            <div class='field-items'>
                                <div class='field-item even'>";
/** Start of modified by Ashish to Show coupon description instead of saving when saving = 1 */


                               if($node->field_best_coupon_saving['und'][0]['value']==0){
            $listPrice .=          '-';
                                }
                                else{ if($node->field_best_coupon_saving['und'][0]['value']==1){
            $listPrice .=          substr($node->field_best_coupon_description['und'][0]['value'], 0, 45).'...';
                                }
                                else{ 					
					
						$listPrice .=         'INR '. number_format($node->field_best_coupon_saving['und'][0]['value'],0, '.', ',');
                                }   }
 

 /** end of modified by Ashish to Show coupon description instead of saving when saving = 1 */

      echo $listPrice .=         "</div>
                            </div>
                        </div>";
						
	  if($node->field_best_coupon_saving['und'][0]['value'] != 1){
	  echo $listPrice = "<div class='field field-name-field-best-coupon-netpriceafters field-type-number-integer field-label-above'>
                            <div class='field-label'>Net Price:&nbsp;</div>
                            <div class='field-items'>
                                <div class='field-item even'>INR ".number_format($node->field_best_coupon_netpriceafters['und'][0]['value'],0, '.', ',')."</div>
                            </div>
                        </div>";       
	}
	
      if($node->field_best_coupon_status[und][0]['value'] == 1){
 
 	
//	 echo "<div class='d_view_store'> <a href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$coupon_display_url}')//;return true;>View Details</a></div>";
	 echo "<div class='d_view_store'> <a href='{$coupon_display_url}' onclick=window.open('{$popup_url}')//;return true;>View Details</a></div>";
	
	        }
      if($node->field_best_coupon_status[und][0]['value'] == 0){
        
//		echo "<div class='d_view_store'><a href='{$lightbox_url}' rel='lightframe[|width:980px; height: 1200px; scrolling: auto;]' onclick=window.open('{$affiliate_url_uncoded}')//;return true;}'>View Store</a></div>";
        echo "<div class='d_view_store'><a href='{$affiliate_url_uncoded}' onclick=window.open('{$popup_url}')//;return true;>View Details</a></div>";
        
		
		
      }           
      //$field_page_url = $node->field_page_url[und][0]['value'];
      //echo "<div class='page_url'><a href='$field_page_url'>See Other Coupons</a></div>";
     ?>
  </div> <!-- /content -->

  <?php if (!empty($content['links']['terms'])): ?>
    <div class="terms">
      <?php print render($content['links']['terms']); ?>
    </div> <!-- /terms -->
  <?php endif;?>

  <?php if (!empty($content['links'])): ?>
    <div class="links">
      <?php print render($content['links']); ?>
    </div> <!-- /links -->
  <?php endif; ?>

  <?php print render($content['comments']); ?>
</article> <!-- /article #node -->
