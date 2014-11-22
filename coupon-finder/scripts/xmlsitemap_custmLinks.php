
<?php
$row = 0;
$mname = array();
$terms = taxonomy_get_tree(3, 0, NULL, TRUE);
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
  
      $row++;
    }

$Curl="http://plugin.theshoppingpro.com/banners/men-fashion/".$term->tid.".png";
$Pname = $term->name;
$Pnamealias=str_replace('--','-',str_replace(' ','-',str_replace('&','',trim($term->name))));
if ($Pname!='Electronics') {
$name= $Pname."'s".' Fashion';
}
$cname='Popular offers and coupons for '.$name;

  //echo t('%name\'s Fashion', array('%name' => $term->name));
  
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
  $url ='ccp/'.trim(str_replace('--','-',$alias)).'/coupons-offers';
  echo $url;
$results = db_query("select count(*) as num FROM xmlsitemap where loc = '".$url."'");


foreach ($results as $result) 
  {
     $num= $result->num;
	
  }
  if ($num !=1 || $num !='1'){
  $link = array(
  'type' => 'custom',
  'id' => db_query("SELECT MAX(id) FROM {xmlsitemap} WHERE type = 'custom'")->fetchField() + 1,
  'loc' => $url,
  'priority' => '0.9',
  'language' => 'und',
  'changefreq' => '86400',
);
//xmlsitemap_link_save($link);
exit;
  }
  }
}