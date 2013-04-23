<?php
/**
 * @file
 * omg_transaction_records_feature.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function omg_transaction_records_feature_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "feeds" && $api == "feeds_importer_default") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function omg_transaction_records_feature_node_info() {
  $items = array(
    'omg_transaction_records' => array(
      'name' => t('OMG_Transaction_Records'),
      'base' => 'node_content',
      'description' => t('OMG Transaction Records'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
