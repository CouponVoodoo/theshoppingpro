<?php

function _vocab_get_list() {
  switch(arg(0)) {
    case 'category':
      $vid = 3;
      break;
    case 'brand':
      $vid = 4;
      break;
    case 'retail':
      $vid = 2;
      break;
    default:
      drupal_access_denied();
  }
  $result = db_query("SELECT * FROM {taxonomy_term_data} ttd INNER JOIN {taxonomy_term_hierarchy} tth ON 
    ttd.tid = tth.tid AND tth.parent = 0")->fetchAll();
  print '<pre>';
  print_r($result);
}