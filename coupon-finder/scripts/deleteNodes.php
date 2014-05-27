<?php
$results = db_query("select b1.entity_id as nid FROM field_data_field_base_url b1, field_data_field_base_url b2 WHERE b1.entity_id > b2.entity_id and b1.field_base_url_value=b2.field_base_url_value
");
$i=1
foreach ($results as $result) {
$nid=$result->nid;
echo $nid.'--'.$i.'==';
//exit;
$i=$i+1;
  node_delete($nid);
}
?>