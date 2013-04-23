<?php
/**
 * @file
 * omg_transaction_records_feature.feeds_importer_default.inc
 */

/**
 * Implements hook_feeds_importer_default().
 */
function omg_transaction_records_feature_feeds_importer_default() {
  $export = array();

  $feeds_importer = new stdClass();
  $feeds_importer->disabled = FALSE; /* Edit this to true to make a default feeds_importer disabled initially */
  $feeds_importer->api_version = 1;
  $feeds_importer->id = 'omg_transaction_records';
  $feeds_importer->config = array(
    'name' => 'OMG_Transaction_Records',
    'description' => 'OMG Transaction Records',
    'fetcher' => array(
      'plugin_key' => 'FeedsFileFetcher',
      'config' => array(
        'allowed_extensions' => 'txt csv tsv xml opml',
        'direct' => 0,
      ),
    ),
    'parser' => array(
      'plugin_key' => 'FeedsCSVParser',
      'config' => array(
        'delimiter' => ',',
        'no_headers' => 0,
      ),
    ),
    'processor' => array(
      'plugin_key' => 'FeedsNodeProcessor',
      'config' => array(
        'content_type' => 'omg_transaction_records',
        'expire' => '-1',
        'author' => '1',
        'authorize' => 1,
        'mappings' => array(
          0 => array(
            'source' => 'Row #',
            'target' => 'field_omg_row',
            'unique' => FALSE,
          ),
          1 => array(
            'source' => 'Click Time',
            'target' => 'field_omg_click_time:start',
            'unique' => FALSE,
          ),
          2 => array(
            'source' => 'Transaction Time',
            'target' => 'field_omg_transaction_time:start',
            'unique' => FALSE,
          ),
          3 => array(
            'source' => 'Transaction ID',
            'target' => 'field_omg_transaction_id',
            'unique' => FALSE,
          ),
          4 => array(
            'source' => 'UID',
            'target' => 'field_drupal_uid',
            'unique' => FALSE,
          ),
          5 => array(
            'source' => 'UID2',
            'target' => 'field_omg_plugin_guid_sid_uid2',
            'unique' => FALSE,
          ),
          6 => array(
            'source' => 'MID',
            'target' => 'field_omg_mid',
            'unique' => FALSE,
          ),
          7 => array(
            'source' => 'Merchant',
            'target' => 'field_omg_merchant',
            'unique' => FALSE,
          ),
          8 => array(
            'source' => 'PID',
            'target' => 'field_omg_pid',
            'unique' => FALSE,
          ),
          9 => array(
            'source' => 'Product',
            'target' => 'field_omg_product',
            'unique' => FALSE,
          ),
          10 => array(
            'source' => 'Referrer',
            'target' => 'field_omg_referrer',
            'unique' => FALSE,
          ),
          11 => array(
            'source' => 'SR',
            'target' => 'field_omg_sr',
            'unique' => FALSE,
          ),
          12 => array(
            'source' => 'VR',
            'target' => 'field_omg_vr',
            'unique' => FALSE,
          ),
          13 => array(
            'source' => 'NVR',
            'target' => 'field_omg_nvr',
            'unique' => FALSE,
          ),
          14 => array(
            'source' => 'Status',
            'target' => 'field_omg_status',
            'unique' => FALSE,
          ),
          15 => array(
            'source' => 'Paid',
            'target' => 'field_omg_paid',
            'unique' => FALSE,
          ),
          16 => array(
            'source' => 'Completed',
            'target' => 'field_omg_completed',
            'unique' => FALSE,
          ),
          17 => array(
            'source' => 'UKey',
            'target' => 'field_omg_ukey',
            'unique' => FALSE,
          ),
          18 => array(
            'source' => 'Transaction Value',
            'target' => 'field_omg_transaction_value',
            'unique' => FALSE,
          ),
          19 => array(
            'source' => 'Drupal Processing Status',
            'target' => 'field_drupal_processing_status',
            'unique' => FALSE,
          ),
          20 => array(
            'source' => 'Transaction ID',
            'target' => 'nid',
            'unique' => 1,
          ),
        ),
        'update_existing' => '2',
        'input_format' => 'plain_text',
        'skip_hash_check' => 1,
      ),
    ),
    'content_type' => '',
    'update' => 0,
    'import_period' => 1800,
    'expire_period' => 3600,
    'import_on_create' => TRUE,
    'process_in_background' => FALSE,
  );
  $export['omg_transaction_records'] = $feeds_importer;

  return $export;
}
