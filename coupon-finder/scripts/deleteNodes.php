<?php
$i=1; 
while (1>0){
echo '---'.$i.'---';
$a=main();
$i=$i+1;
if ($a=='done'){
break;
}
}


function main(){
$results = db_query("select top 100 distinct(b1.entity_id) as nid FROM field_data_field_base_url b1, field_data_field_base_url b2 WHERE b1.entity_id > b2.entity_id and b1.field_base_url_value=b2.field_base_url_value
");


foreach ($results as $result) 
  {
    $nids[] = $result->nid;
  }

//exit;

 if (!empty($nids)) 
  {
    node_delete_multiple($nids);
	return 'not bne';
  }
  else {return 'done'}

?>