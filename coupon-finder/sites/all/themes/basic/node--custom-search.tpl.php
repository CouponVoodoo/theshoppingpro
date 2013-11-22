<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if($node->field_best_coupon_saving['und'][0]['value'] != 0){ ?>
    <div class="ribbon-wrapper-green">
        <div class="ribbon-green">Save <?php echo $node->field_best_coupon_saving['und'][0]['value']; ?></div>
  </div>
  <?php }?> 
  
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
      //echo "<div class='product_name'><a href='{$node->field_page_url[und][0]['value']}' >".$node->field_retailer[und][0]['value']."</a><div>";
      
      
      if( $node->field_best_coupon_status[und][0]['value'] == 1 ){
        echo "<div class='coupons_found'><img src='".base_path().path_to_theme()."/images/u67_normal.png' /><div class='coupons_text'>Coupons Found</div></div>";
      }else{
        echo "<div class='no_coupons_found'><img src='".base_path().path_to_theme()."/images/u6_normal.png' /><div class='no_coupons_text'>No Coupons Found</div></div>";
      }
      
      //$urlAlias =  base_path().drupal_get_path_alias('node/'.$node->nid);
      $urlAlias =  $node->field_affiliateurl['und'][0]['value'];
      
      $uplImg = $node->field_product_images['und'][0]['uri'];
      $imgPath = $imgUri = image_style_url('200x200', $uplImg);
      $img = "<div class='field field-name-field-product-images field-type-image field-label-above'>
                    <div class='field-label'>Product images:&nbsp;</div>
                    <div class='field-items'>
                        <div class='field-item even product_img'>
                            <a target='_blank'  href='{$urlAlias}'><img src='{$node->field_product_image['und'][0]['value']}' typeof='foaf:Image'></a>
                        </div>";
      echo  $img .=    "</div>
                </div>";
      
      echo "<div class='product_name'><a target='_blank'  href='{$urlAlias}' >".substr($node->field_retailer_product_name[und][0]['value'], 0, 47)."</a></div>";
      
      echo $listPrice = "<div class='field field-name-field-product-price field-type-number-integer field-label-above'>
                        <div class='field-label'>List Price:&nbsp;</div>
                        <div class='field-items'>
                            <div class='field-item even'>INR ".number_format($node->field_product_price['und'][0]['value'],2)."</div>
                        </div>
                    </div>";
      $listPrice = "<div class='field field-name-field-best-coupon-saving field-type-number-integer field-label-above'>
                            <div class='field-label'>Savings:&nbsp;</div>
                            <div class='field-items'>
                                <div class='field-item even'>";
                                if($node->field_best_coupon_saving['und'][0]['value']==0){
            $listPrice .=          '-';
                                }
                                else{
            $listPrice .=         'INR '. number_format($node->field_best_coupon_saving['und'][0]['value'],2);
                                }    
      echo $listPrice .=         "</div>
                            </div>
                        </div>";
      echo $listPrice = "<div class='field field-name-field-best-coupon-netpriceafters field-type-number-integer field-label-above'>
                            <div class='field-label'>Net Price:&nbsp;</div>
                            <div class='field-items'>
                                <div class='field-item even'>INR ".number_format($node->field_best_coupon_netpriceafters['und'][0]['value'],2)."</div>
                            </div>
                        </div>";                    
      //print render($content);
      
      $BrandTid = $node->field_brand[und][0]['tid'];
      $RetailerTid = $node->field_retailer[und][0]['tid'];
      $CategoryTid = $node->field_category[und][0]['tid'];
      
      echo coupons_get_taxonomy_url($BrandTid) .". | " . coupons_get_taxonomy_url($RetailerTid) .". | ". coupons_get_taxonomy_url($CategoryTid) . "." ;
      
      //echo 'brand - status '. $node->field_best_coupon_status[und][0]['value'];
      if($node->field_best_coupon_status[und][0]['value'] == 1){
        $copyCoupon =  coupons_copy_coupon_taxonomy($node->nid,4);
        print render($copyCoupon);
      }
      if($node->field_best_coupon_status[und][0]['value'] == 0){
        echo "<div class='d_view_store'><a target='_blank' class='view_store' href='{$node->field_affiliateurl[und][0]['value']}'>View Store</a></div>";
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

