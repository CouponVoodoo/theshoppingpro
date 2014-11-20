<?php
$i=1; 
while (1>0){
echo '---'.$i.'---';
$start = microtime(TRUE);
$a=main();
$taken = microtime(TRUE) - $start;
echo "Deleted 500 nodes in". $taken." \n";
$i=$i+1;
if ($a=='done'){
break;
}

}


function main(){
$results = db_query("select distinct(nid) as nid FROM node where type in ('retailer_coupon') order by nid desc LIMIT 500");


foreach ($results as $result) 
  {
    $nids[] = $result->nid;
	
  }
echo 'nid array';
//exit;

 if (!empty($nids)) 
  {
    node_delete_multiple($nids);
	echo 'nodes deleted';
	return 'not bne';
  }
  else {return 'done';}

  
  
  
  
  
  }


?>