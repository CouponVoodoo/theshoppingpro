<?php
$i=1; 
while (1>0){
echo '---'.$i.'---';
$start = microtime(TRUE);
$a=main();
$taken = microtime(TRUE) - $start;
echo "Deleted 1000 nodes in". $taken." \n";

if ($a=='done'){
break;
}

}


function main(){
$results = db_query("select distinct(b1.entity_id) as nid FROM field_data_field_base_url b1, field_data_field_base_url b2 WHERE b1.entity_id > b2.entity_id and b1.field_base_url_value=b2.field_base_url_value LIMIT 1000");

$i=1;
foreach ($results as $result) 
  {
    $nids = $result->nid;
	echo '--'.$nids.'=='.$i.'..';
	node_delete($nids);
	$i=$i+1;
  }
  
  
  
  
  
  }


?>