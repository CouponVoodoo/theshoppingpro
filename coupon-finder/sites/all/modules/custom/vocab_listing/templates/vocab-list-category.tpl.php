<p></p>
<h3 style="font-size: 13px;"> Click on a category to find coupons, offers & deals available at major online stores like Flipkart, Snapdeal, Jabong, Amazon, Myntra etc.</h3>
<div class="vocab-list vocab-list-category">
<?php
$row = 0;
$mname = array();
$ignore_tids = array(83, 47, 57, 82, 25, 37, 69, 70, 73, 16, 19, 21, 95, 18,22,23,87,7400);
foreach ($terms as $term) {
  if (in_array($term->tid, $ignore_tids)) {
  
  $mname[$term->tid]=$term->name;
    continue;
  }
  if (in_array(0, $term->parents)) {
    if ($row == 0) {
	
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
$Pname = $term->name;
$Pnamealias=str_replace('--','-',str_replace(' ','-',str_replace('&','',trim($term->name))));
if ($Pname!='Electronics') {
$name= $Pname."'s".' Fashion';
}
$cname='Popular offers and coupons for '.$name;
echo '<div class="m-logo"><img src="'.$Curl.'" alt="'.$cname.'" ></div>';
echo '<div class="m-cpn"><p class="ofr-descp">'.$cname.'</p> </div>';

  //echo t('%name\'s Fashion', array('%name' => $term->name));
  
?>
</h2>
<?php
  } else { 
  
  
  if ($term->parents) {
  //echo $term->parents[0];
  //echo 'out';
    if (in_array($term->parents[0], $ignore_tids)) {
	//echo $term->name.'__'.$term->parents[0];
	
	if (!empty($mname[$term->parents[0]])){
	  $MnameAlias=str_replace('--','-',str_replace(' ','-',str_replace('&','',trim($mname[$term->parents[0]]))));
	  }
	  else $MnameAlias='';
	  //echo $MnameAlias;
	  
	}
	else $MnameAlias='';
  }
  
  
  $alias=$Pnamealias.'-'.$MnameAlias.'-'.str_replace('--','-',str_replace(' ','-',str_replace(',','',str_replace('&','',trim($term->name)))));
  //echo $alias;
  //exit;
  $url="http://plugin.theshoppingpro.com/banners/men-fashion/".$term->tid.".png";
?><div class="imges"> <img src=<?php print $url;?> alt=<?php print $term->name .'coupons, offers & deals';?> >
  <div class="vocab-list-term"><?php echo l($term->name, 'ccp/'.trim(str_replace('--','-',$alias)).'/coupons-offers', array('query' => array('field_offer_type_tid' => 'All'))); ?>
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