<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
foreach ($terms as $term) { 
  if (in_array($term->tid, $ignore_tids)) {
    continue;
  }
  if (!trim($term->name)) {
    continue;
  }
?>
  <div class="vocab-list-term"><?php echo l($term->name, 'bcp/'.$term->tid.'/coupons-offers'); ?></div>
<?php
  }
?>
</div>  