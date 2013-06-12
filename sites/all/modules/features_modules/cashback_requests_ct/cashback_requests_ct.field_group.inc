<?php
/**
 * @file
 * cashback_requests_ct.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function cashback_requests_ct_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_admin_process|node|cashback_requests|form';
  $field_group->group_name = 'group_admin_process';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'cashback_requests';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'For Admin Process',
    'weight' => '6',
    'children' => array(
      0 => 'field_bank_amount_processed',
      1 => 'field_bank_name',
      2 => 'field_bank_transaction_id',
      3 => 'field_cashback_comment',
      4 => 'field_cashback_comment_cancellat',
      5 => 'field_bank_transaction_date',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => '',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_admin_process|node|cashback_requests|form'] = $field_group;

  return $export;
}
