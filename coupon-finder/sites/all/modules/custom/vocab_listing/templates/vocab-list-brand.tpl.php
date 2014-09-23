<div class="vocab-list vocab-list-brand">
<?php
$row = 0;
$ignore_tids = array();
 $query = db_select('node', 'n');
        
$query->fields('n',array('BrandId'))//SELECT the fields from node
        
$result = $query->execute();
    while($record = $result->fetchAssoc()) {
        print_r($record);
    
 /* if (in_array($term->tid, $ignore_tids)) {
    continue;
  }*/
?>
  <div class="vocab-list-term"><?php print_r($record);//echo l($term->name, 'bcp/'.$term->tid.'/coupons-offers'); 
  ?></div>
<?php
  }
?>
</div>