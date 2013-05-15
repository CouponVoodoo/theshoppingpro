<?php

function _corp_enhancements_user_settings_form_alter(&$form, &$form_state) {
  $form['points_update_email'] = array(
      '#type' => 'fieldset',
      '#title' => t('Point update email'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => t('Enable and edit e-mail messages sent to users upon points update'),
      '#group' => 'email',
  );
  $form['points_update_email']['points_update_email_enable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable email.'),
      '#default_value' => variable_get('points_update_email_enable', TRUE),
  );
  $form['points_update_email']['settings'] = array(
      '#type' => 'container',
      '#states' => array(
      // Hide the additional settings when this email is disabled.
          'invisible' => array(
              'input[name="points_update_email_enable"]' => array('checked' => FALSE),
          ),
      ),
  );
  $form['points_update_email']['settings']['points_update_email_subject'] = array(
      '#type' => 'textfield',
      '#title' => t('User email subject'),
      '#default_value' => variable_get('points_update_email_subject', ''),
      '#maxlength' => 180,
  );
  $form['points_update_email']['settings']['points_update_email_body'] = array(
      '#type' => 'textarea',
      '#title' => t('User Email body'),
      '#default_value' => variable_get('points_update_email_body', ''),
      '#rows' => 15,
  );

   $form['points_update_email']['settings']['points_update_email_subject_referrer'] = array(
      '#type' => 'textfield',
      '#title' => t('Referrer email subject'),
      '#default_value' => variable_get('points_update_email_subject_referrer', ''),
      '#maxlength' => 180,
  );
  $form['points_update_email']['settings']['points_update_email_body_referrer'] = array(
      '#type' => 'textarea',
      '#title' => t('Referrer email body'),
      '#default_value' => variable_get('points_update_email_body_referrer', ''),
      '#rows' => 15,
  );
  

}

