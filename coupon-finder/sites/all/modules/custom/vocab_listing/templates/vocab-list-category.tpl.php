<div class="vocab-list vocab-list-category">
<?php
$row = 0;
$ignore_tids = array(83, 47, 57, 82, 25, 37, 69, 70, 73, 16, 19, 21, 95, 18);
foreach ($terms as $term) {
  if (in_array($term->tid, $ignore_tids)) {
    continue;
  }
  if (in_array(0, $term->parents)) {
    if ($row == 0) {
	//var_dump($term);
      echo '<div class="vocab-list-parent"> <img src="http://www.couponvoodoo.com/sites/default/files/46.png" alt="Womens Fashion" >';
      $row++;
    } else {
      echo '</div><div class="vocab-list-parent">';
      $row++;
    }
?>
<h2>
<?php
  echo t('%name\'s Fashion', array('%name' => $term->name));
?>
</h2>
<?php
  } else {
?>
  <div class="vocab-list-term"><?php echo l($term->name, 'ccp/'.$term->tid.'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?></div>
<?php
  }
}
if ($row != 0) {
  echo '</div>';
}
?>
</div>