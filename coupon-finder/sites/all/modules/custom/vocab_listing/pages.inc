<?php

function _vocab_get_list() {
  if ($GLOBALS['_domain']['subdomain'] != 'offers.couponvoodoo.com' || $GLOBALS['_domain']['subdomain'] == 'buyonline.couponvoodoo.com') {
    drupal_access_denied();
  }
  $load_entities = FALSE;
  switch(arg(1)) {
    case 'category':
      $template = 'vocab_list_category';
      $vid = 3;
      break;
    case 'brand':
      $template = 'vocab_list_brand';
      $vid = 4;
      drupal_set_title('Top Brands');
      break;
    case 'retail':
      $template = 'vocab_list_retail';
      $vid = 2;
      $load_entities = TRUE;
      drupal_set_title('Top Online Retailers');
      break;
    default:
      drupal_access_denied();
  }
  $terms = taxonomy_get_tree($vid, 0, NULL, $load_entities);
  return theme($template, array('terms' => $terms));
}