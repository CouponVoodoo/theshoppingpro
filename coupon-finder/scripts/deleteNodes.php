<?php
$q = db_query("select b1.entity_id FROM field_data_field_base_url b1, field_data_field_base_url b2 WHERE b1.entity_id > b2.entity_id and b1.field_base_url_value=b2.field_base_url_value
");
while ($nid = db_result($q)) {
echo $nid.'--'
  node_delete($nid);
}
?>