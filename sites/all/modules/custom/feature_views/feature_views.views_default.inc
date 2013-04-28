<?php
/**
 * @file
 * feature_views.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function feature_views_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'partner_retailers_with_category';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Partner Retailers with categories';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Recommended';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['query']['options']['distinct'] = TRUE;
  $handler->display->display_options['query']['options']['pure_distinct'] = TRUE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Relationship: Content: Tracking URL (field_tracking_url) */
  $handler->display->display_options['relationships']['field_tracking_url_value']['id'] = 'field_tracking_url_value';
  $handler->display->display_options['relationships']['field_tracking_url_value']['table'] = 'field_data_field_tracking_url';
  $handler->display->display_options['relationships']['field_tracking_url_value']['field'] = 'field_tracking_url_value';
  $handler->display->display_options['relationships']['field_tracking_url_value']['delta'] = '-1';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['exclude'] = TRUE;
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  /* Field: Content: URL */
  $handler->display->display_options['fields']['field_url']['id'] = 'field_url';
  $handler->display->display_options['fields']['field_url']['table'] = 'field_data_field_url';
  $handler->display->display_options['fields']['field_url']['field'] = 'field_url';
  $handler->display->display_options['fields']['field_url']['exclude'] = TRUE;
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php']['id'] = 'php';
  $handler->display->display_options['fields']['php']['table'] = 'views';
  $handler->display->display_options['fields']['php']['field'] = 'php';
  $handler->display->display_options['fields']['php']['label'] = '';
  $handler->display->display_options['fields']['php']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php']['php_output'] = '<?php
global $user;
$node_data = node_load($data->nid);
$term_name = taxonomy_term_load($node_data->field_type[LANGUAGE_NONE][0][\'tid\']);
$term_name_country = taxonomy_term_load($node_data->field_country[LANGUAGE_NONE][0][\'tid\']);
$tracking_url_id = $node_data->field_tracking_url[LANGUAGE_NONE][0][\'value\'];
$term_tracking_url = entity_load(\'field_collection_item\', array($tracking_url_id));

if(isset($_GET[\'url\'])){
   $query_nid = db_select(\'field_data_field_url\', \'fdfu\');
   $query_nid->fields(\'fdfu\', array(\'entity_id\'))//SELECT the fields from node
           ->condition(\'fdfu.field_url_value\', $_GET[\'url\'], \'=\');
   $result = $query_nid->execute();
}
foreach ($result as $record) {
 $id = $record->entity_id;
}

if($term_name->name == \'Partner\') {
    if ($user->uid) {
          if(isset($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\'])) {
            $a = \'\';
            $url = urldecode($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\']);
          }
          else {
            $a = \'http:\\\\\' ;
            $url = urldecode($node_data->field_url[LANGUAGE_NONE][0][\'value\']);
          }
          $redirect = \'\';

          if($node_data->field_url[LANGUAGE_NONE][0][\'value\'] == $_GET[\'url\']) {
              $redirect = $_GET[\'redirect\'];

              $url_part1 = isset ($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part2 = isset ($term_tracking_url[$tracking_url_id]->field_url_part2[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part2[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part3 = isset ($term_tracking_url[$tracking_url_id]->field_url_part3[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part3[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part4 = isset ($term_tracking_url[$tracking_url_id]->field_url_part4[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part4[LANGUAGE_NONE][0][\'value\'] : \'\';

              $link = l($row->title, $a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\'], \'redirect\'=>$redirect . $url_part2 . $url_part3 . $url_part4), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE));
          }
          else{
             $link = l($row->title, $a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE));
          }
       print $link;
    }
    else {
      print l($row->title, \'login_register\', array(\'colorbox\'=>true, \'attributes\'=>array(\'class\'=>\'colorbox_form\', \'id\'=>\'colorbox_form\')));
    }

}
else {
     if($data->nid != $id) {
        if ($user->uid) {
          if(isset($data->field_field_url_part1[0][\'rendered\'][\'#markup\'])) {
            $a = \'\';
            $url = $data->field_field_url_part1[0][\'rendered\'][\'#markup\'];
          }
          else {
            $a = \'http:\\\\\' ;
            $url = urldecode($data->field_field_url[0][\'rendered\'][\'#markup\']);
          }
          print l($row->title, urldecode($a . $url), array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE));
          //print l($row->title . \' (\' . $term_name->name . \')\', \'http://\' . $data->field_field_url[0][\'rendered\'][\'#markup\'], array(\'query\' => array(\'url\' => $data->field_field_url[0][\'rendered\'][\'#markup\'], \'destination\' =>$data->field_field_url_part1[0][\'rendered\'][\'#markup\'], \'nid\' => $data->nid, \'uid\' => $user->uid), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE));
        }
        else {
          print l($row->title, \'login_register\', array(\'colorbox\'=>true, \'attributes\'=>array(\'class\'=>\'colorbox_form\', \'id\'=>\'colorbox_form\')));
        }
    }
    else {
         print $row->title;
      }
}
?>';
  $handler->display->display_options['fields']['php']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php']['php_click_sortable'] = '';
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php_2']['id'] = 'php_2';
  $handler->display->display_options['fields']['php_2']['table'] = 'views';
  $handler->display->display_options['fields']['php_2']['field'] = 'php';
  $handler->display->display_options['fields']['php_2']['label'] = '';
  $handler->display->display_options['fields']['php_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php_2']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php_2']['php_output'] = '<?php
global $user;
global $base_url;

$node_data = node_load($data->nid);
$term_name = taxonomy_term_load($node_data->field_type[LANGUAGE_NONE][0][\'tid\']);
$term_name_country = taxonomy_term_load($node_data->field_country[LANGUAGE_NONE][0][\'tid\']);
$tracking_url_id = $node_data->field_tracking_url[LANGUAGE_NONE][0][\'value\'];
$term_tracking_url = entity_load(\'field_collection_item\', array($tracking_url_id));

if(isset($_GET[\'url\'])){
   $query_nid = db_select(\'field_data_field_url\', \'fdfu\');
   $query_nid->fields(\'fdfu\', array(\'entity_id\'))//SELECT the fields from node
           ->condition(\'fdfu.field_url_value\', $_GET[\'url\'], \'=\');
   $result = $query_nid->execute();
}
foreach ($result as $record) {
 $id = $record->entity_id;
}

if($term_name->name == \'Partner\') {
    if ($user->uid) {
          if(isset($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\'])) {
            $a = \'\';
            $url = urldecode($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\']);
          }
          else {
            $a = \'http:\\\\\' ;
            $url = urldecode($node_data->field_url[LANGUAGE_NONE][0][\'value\']);
          }
          $redirect = \'\';

          if($node_data->field_url[LANGUAGE_NONE][0][\'value\'] == $_GET[\'url\']) {
              $redirect = $_GET[\'redirect\'];
                //print_r($term_tracking_url);
              $url_part1 = isset ($term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part1[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part2 = isset ($term_tracking_url[$tracking_url_id]->field_url_part2[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part2[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part3 = isset ($term_tracking_url[$tracking_url_id]->field_url_part3[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part3[LANGUAGE_NONE][0][\'value\'] : \'\';
              $url_part4 = isset ($term_tracking_url[$tracking_url_id]->field_url_part4[LANGUAGE_NONE][0][\'value\']) ? $term_tracking_url[$tracking_url_id]->field_url_part4[LANGUAGE_NONE][0][\'value\'] : \'\';
              $link = l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'"  width="100" height="100" typeof="foaf:Image"/>\', $a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\'], \'redirect\'=>$redirect . $url_part2 . $url_part3 . $url_part4), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
              $display_text = "CLICK & ".$node_data->field_display_text[LANGUAGE_NONE][0][\'value\'];
              $display_link = l($display_text,$a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\'], \'redirect\'=>$redirect . $url_part2 . $url_part3 . $url_part4), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
          }
          else{
             $link = l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'"  width="100" height="100" typeof="foaf:Image"/>\', $a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
              $display_text = "CLICK & ".$node_data->field_display_text[LANGUAGE_NONE][0][\'value\'];
              $display_link = l($display_text,$a . $url, array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
          }
       print $link;
 	print $display_link ;
    }
    else {
     print l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'" width="100" height="100" typeof="foaf:Image"/>\', \'modal_forms/nojs/login\', array(\'attributes\'=>array(\'class\'=>\'ctools-use-modal\'), \'html\' => TRUE));
 $display_text = $node_data->field_display_text[LANGUAGE_NONE][0][\'value\'];
print l($display_text, \'modal_forms/nojs/login\', array(\'attributes\' =>array(\'class\' => \'ctools-use-modal\'), \'html\' => TRUE));
    
}

}
else {
     if($data->nid != $id) {
        if ($user->uid) {
          if(isset($data->field_field_url_part1[0][\'rendered\'][\'#markup\'])) {
            $a = \'\';
            $url = $data->field_field_url_part1[0][\'rendered\'][\'#markup\'];
          }
          else {
            $a = \'http:\\\\\' ;
            $url = urldecode($data->field_field_url[0][\'rendered\'][\'#markup\']);
          }
          print l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'"  width="100" height="100" typeof="foaf:Image"/>\', urldecode($a . $url), array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
          $display_text = "CLICK & ".$node_data->field_display_text[LANGUAGE_NONE][0][\'value\'];
              $display_link = l($display_text, urldecode($a . $url), array(\'query\' => array(\'uid\'=>$user->uid, \'uid2\'=>$_GET[\'uid2\']), \'attributes\'=>array(\'target\'=>\'_blank\'), \'external\' => TRUE, \'html\' => TRUE));
}
        else {
         print l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'" width="100" height="100" typeof="foaf:Image"/>\', \'modal_forms/nojs/login\', array(\'attributes\'=>array(\'class\'=>\'ctools-use-modal\'), \'html\' => TRUE));
 $display_text = "LOGIN & ".$node_data->field_display_text[LANGUAGE_NONE][0][\'value\'];
       print l($display_text, \'modal_forms/nojs/login\', array(\'attributes\' =>array(\'class\' => \'ctools-use-modal\'), \'html\' => TRUE));
        }
    }
    else {
         print l(\'<img src="\' . render(file_create_url($node_data->field_image[\'und\'][0][\'uri\'])) . \'" width="100" height="100" typeof="foaf:Image"/>\', \'#\', array(\'html\' => TRUE));
      }
}
?>';
  $handler->display->display_options['fields']['php_2']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php_2']['php_click_sortable'] = '';
  /* Field: Field collection item: URL Part1 */
  $handler->display->display_options['fields']['field_url_part1']['id'] = 'field_url_part1';
  $handler->display->display_options['fields']['field_url_part1']['table'] = 'field_data_field_url_part1';
  $handler->display->display_options['fields']['field_url_part1']['field'] = 'field_url_part1';
  $handler->display->display_options['fields']['field_url_part1']['relationship'] = 'field_tracking_url_value';
  $handler->display->display_options['fields']['field_url_part1']['exclude'] = TRUE;
  /* Field: Field collection item: URL Part2 */
  $handler->display->display_options['fields']['field_url_part2']['id'] = 'field_url_part2';
  $handler->display->display_options['fields']['field_url_part2']['table'] = 'field_data_field_url_part2';
  $handler->display->display_options['fields']['field_url_part2']['field'] = 'field_url_part2';
  $handler->display->display_options['fields']['field_url_part2']['relationship'] = 'field_tracking_url_value';
  $handler->display->display_options['fields']['field_url_part2']['exclude'] = TRUE;
  /* Field: Field collection item: URL Part3 */
  $handler->display->display_options['fields']['field_url_part3']['id'] = 'field_url_part3';
  $handler->display->display_options['fields']['field_url_part3']['table'] = 'field_data_field_url_part3';
  $handler->display->display_options['fields']['field_url_part3']['field'] = 'field_url_part3';
  $handler->display->display_options['fields']['field_url_part3']['relationship'] = 'field_tracking_url_value';
  $handler->display->display_options['fields']['field_url_part3']['exclude'] = TRUE;
  /* Field: Field collection item: URL Part4 */
  $handler->display->display_options['fields']['field_url_part4']['id'] = 'field_url_part4';
  $handler->display->display_options['fields']['field_url_part4']['table'] = 'field_data_field_url_part4';
  $handler->display->display_options['fields']['field_url_part4']['field'] = 'field_url_part4';
  $handler->display->display_options['fields']['field_url_part4']['relationship'] = 'field_tracking_url_value';
  $handler->display->display_options['fields']['field_url_part4']['exclude'] = TRUE;
  /* Field: Content: Country */
  $handler->display->display_options['fields']['field_country']['id'] = 'field_country';
  $handler->display->display_options['fields']['field_country']['table'] = 'field_data_field_country';
  $handler->display->display_options['fields']['field_country']['field'] = 'field_country';
  $handler->display->display_options['fields']['field_country']['exclude'] = TRUE;
  /* Field: Content: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  /* Sort criterion: Weight: Weight */
  $handler->display->display_options['sorts']['weight']['id'] = 'weight';
  $handler->display->display_options['sorts']['weight']['table'] = 'weight_weights';
  $handler->display->display_options['sorts']['weight']['field'] = 'weight';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'retailers' => 'retailers',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Type (field_type) */
  $handler->display->display_options['filters']['field_type_tid']['id'] = 'field_type_tid';
  $handler->display->display_options['filters']['field_type_tid']['table'] = 'field_data_field_type';
  $handler->display->display_options['filters']['field_type_tid']['field'] = 'field_type_tid';
  $handler->display->display_options['filters']['field_type_tid']['value'] = array(
    13 => '13',
  );
  $handler->display->display_options['filters']['field_type_tid']['group'] = 1;
  $handler->display->display_options['filters']['field_type_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_type_tid']['vocabulary'] = 'type';
  /* Filter criterion: Content: Country (field_country) */
  $handler->display->display_options['filters']['field_country_tid']['id'] = 'field_country_tid';
  $handler->display->display_options['filters']['field_country_tid']['table'] = 'field_data_field_country';
  $handler->display->display_options['filters']['field_country_tid']['field'] = 'field_country_tid';
  $handler->display->display_options['filters']['field_country_tid']['value'] = array(
    0 => '4',
  );
  $handler->display->display_options['filters']['field_country_tid']['group'] = 1;
  $handler->display->display_options['filters']['field_country_tid']['expose']['operator_id'] = 'field_country_tid_op';
  $handler->display->display_options['filters']['field_country_tid']['expose']['label'] = 'Country (field_country)';
  $handler->display->display_options['filters']['field_country_tid']['expose']['operator'] = 'field_country_tid_op';
  $handler->display->display_options['filters']['field_country_tid']['expose']['identifier'] = 'field_country_tid';
  $handler->display->display_options['filters']['field_country_tid']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );
  $handler->display->display_options['filters']['field_country_tid']['vocabulary'] = 'country';
  /* Filter criterion: Content: Category (field_category) */
  $handler->display->display_options['filters']['field_category_tid']['id'] = 'field_category_tid';
  $handler->display->display_options['filters']['field_category_tid']['table'] = 'field_data_field_category';
  $handler->display->display_options['filters']['field_category_tid']['field'] = 'field_category_tid';
  $handler->display->display_options['filters']['field_category_tid']['value'] = array(
    22 => '22',
  );
  $handler->display->display_options['filters']['field_category_tid']['group'] = 1;
  $handler->display->display_options['filters']['field_category_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_category_tid']['vocabulary'] = 'category';
  /* Filter criterion: Content: Nid */
  $handler->display->display_options['filters']['nid']['id'] = 'nid';
  $handler->display->display_options['filters']['nid']['table'] = 'node';
  $handler->display->display_options['filters']['nid']['field'] = 'nid';
  $handler->display->display_options['filters']['nid']['operator'] = '!=';
  $handler->display->display_options['filters']['nid']['value']['value'] = '7';
  $handler->display->display_options['filters']['nid']['group'] = 1;
  /* Filter criterion: Content: Primary Category (field_primary_category) */
  $handler->display->display_options['filters']['field_primary_category_tid']['id'] = 'field_primary_category_tid';
  $handler->display->display_options['filters']['field_primary_category_tid']['table'] = 'field_data_field_primary_category';
  $handler->display->display_options['filters']['field_primary_category_tid']['field'] = 'field_primary_category_tid';
  $handler->display->display_options['filters']['field_primary_category_tid']['value'] = array(
    29 => '29',
    30 => '30',
  );
  $handler->display->display_options['filters']['field_primary_category_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_primary_category_tid']['vocabulary'] = 'category';
  /* Filter criterion: Global: PHP */
  $handler->display->display_options['filters']['php']['id'] = 'php';
  $handler->display->display_options['filters']['php']['table'] = 'views';
  $handler->display->display_options['filters']['php']['field'] = 'php';
  $handler->display->display_options['filters']['php']['use_php_setup'] = 0;
  $handler->display->display_options['filters']['php']['php_filter'] = 'return partner_retail_with_category_url_check();';

  /* Display: Block */
  $handler = $view->new_display('block', 'Block', 'block');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $export['partner_retailers_with_category'] = $view;

  return $export;
}
