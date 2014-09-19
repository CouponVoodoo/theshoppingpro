<?php

function _vocab_get_list() {
  if ($GLOBALS['_domain']['subdomain'] != 'offers.couponvoodoo.com') {
    drupal_access_denied();
  }
  switch(arg(1)) {
    case 'category':
      $template = 'vocab_list_category';
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
  return theme($template, array('terms' => $terms));
}