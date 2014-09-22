<div class="vocab-list vocab-list-retail">
<?php
$row = 0;
$ignore_tids = array();
foreach ($terms as $term) {
  if (in_array($term->tid, $ignore_tids)) {
    continue;
  }
  if (in_array(0, $term->parents)) {
    if ($row == 0) {
      echo '<div class="vocab-list-parent">';
      $row++;
    } else {
      echo '</div><div class="vocab-list-parent">';
      $row++;
    }
?>
<h2>
<?php
  echo t('%name', array('%name' => $term->name));
?>
</h2>
<?php
  } else {
    $img = drupal_realpath($term->field_retailer_logo['und'][0]['uri']);
?>
  <div class="vocab-list-term">
    <a href="<?php echo url('rcp/'.$term->name.'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?>">
      <img src="<?php echo $img; ?>" alt="<?php echo $term->name; ?>" />
    </a>
  </div>
<?php
  }
}
if ($row != 0) {
  echo '</div>';
}
?>
</div>