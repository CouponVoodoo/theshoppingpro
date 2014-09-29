<div class="vocab-list vocab-list-category">
<?php
$row = 0;
$ignore_tids = array(83, 47, 57, 82, 25, 37, 69, 70, 73, 16, 19, 21, 95, 18,22,23,87);
foreach ($terms as $term) {
  if (in_array($term->tid, $ignore_tids)) {
    continue;
  }
  if (in_array(0, $term->parents)) {
    if ($row == 0) {
	//var_dump($term);
      echo '<div class="vocab-list-parent"> ';
      $row++;
    } else {
      echo '</div><div class="vocab-list-parent">';
      $row++;
    }
?>
<h2>
<?php
$Curl="http://plugin.theshoppingpro.com/banners/men-fashion/".$term->tid.".png";
echo '<div class="m-logo"><img src="'.$Curl.'" alt="Womens Fashion" ></div>';
echo '<div class="m-cpn"><p class="ofr-descp">'.$term->name."'s".' Fashion</p> </div>';

  //echo t('%name\'s Fashion', array('%name' => $term->name));
  
?>
</h2>
<?php
  } else { 
  $url="http://plugin.theshoppingpro.com/banners/men-fashion/".$term->tid.".png";
?><div class="imges"> <img src=<?php print $url;?> alt="Womens Fashion" >
  <div class="vocab-list-term"><?php echo l($term->name, 'ccp/'.$term->tid.'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?>
  </div>
  </div>
<?php
  }
}
if ($row != 0) {
  echo '</div>';
}
?>
</div>