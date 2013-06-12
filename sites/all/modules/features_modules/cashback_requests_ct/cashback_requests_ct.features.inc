<?php
/**
 * @file
 * cashback_requests_ct.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function cashback_requests_ct_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  list($module, $api) = func_get_args();
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function cashback_requests_ct_node_info() {
  $items = array(
    'cashback_requests' => array(
      'name' => t('Cashback Requests'),
      'base' => 'node_content',
      'description' => t('cashback requests'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
