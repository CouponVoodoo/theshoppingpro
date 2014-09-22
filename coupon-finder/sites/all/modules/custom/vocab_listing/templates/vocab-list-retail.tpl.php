<div class="vocab-list vocab-list-retail">
<?php
$row = 0;
$ignore_tids = array();
foreach ($terms as $term) {
  if (in_array($term->tid, $ignore_tids)) {
    continue;
  }
  $img = image_style_url('retail_logo', $term->field_retailer_logo['und'][0]['uri']);
?>
  <div class="vocab-list-term">
    <a href="<?php echo url('rcp/'.$term->name.'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?>">
      <img src="<?php echo $img; ?>" alt="<?php echo $term->name; ?>" />
    </a>
  </div>
<?php  
  }
?>
</div>