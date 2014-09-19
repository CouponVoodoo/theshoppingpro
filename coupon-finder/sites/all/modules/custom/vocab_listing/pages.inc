<?php

function _vocab_get_list() {
  switch(arg(1)) {
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
  $terms = taxonomy_get_tree($vid);
  return theme('vocab_list_category', array('terms' => $terms));
}