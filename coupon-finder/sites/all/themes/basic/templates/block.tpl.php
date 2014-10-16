<?php ?>
<div id="block-<?php print $block->module .'-'. $block->delta ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="block-inner">

    <?php print render($title_prefix); ?>
    <?php if ($block->subject):
    if( $block->subject == 'Apache retailer products'){
      global $node;
      $node = node_load(arg(1));
       $RetailerTid = $node->field_retailer[und][0]['tid'];
       
    ?>
      <h2 class="block-title"<?php print $title_attributes; ?> >More From <?php echo coupons_get_taxonomy_url($RetailerTid, 'block') ?></h2>
    <?php }else{?>
      <h2 class="block-title"<?php print $title_attributes; ?>><?php print get_block_subject($block->subject); ?></h2>      
    <?php } 
    endif;?>
<?php if (arg(0) == 'search') { ?>
      <span class="filter-toggle-btn"></span>
<?php } ?>
	
	
    <?php print render($title_suffix); ?>


    <div class="content" <?php print $content_attributes; ?>>
      <?php print $content; ?>
    </div>

  </div>
</div> <!-- /block-inner /block -->
