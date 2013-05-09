<?php
/**
 * @file
 * user_profile_fields.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function user_profile_fields_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_financial_details|user|user|form';
  $field_group->group_name = 'group_financial_details';
  $field_group->entity_type = 'user';
  $field_group->bundle = 'user';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Bank Account Details',
    'weight' => '8',
    'children' => array(
      0 => 'field_account_holder_name',
      1 => 'field_account_number',
      2 => 'field_bank',
      3 => 'field_ifsc_code',
      4 => 'field_micr_code',
      5 => 'field_bank_address',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'label' => 'Bank Account Details',
      'instance_settings' => array(
        'required_fields' => 1,
        'classes' => '',
        'description' => 'Please add the account where you would
like you cashback to be credited:',
      ),
      'formatter' => 'collapsible',
    ),
  );
  $export['group_financial_details|user|user|form'] = $field_group;

  return $export;
}
