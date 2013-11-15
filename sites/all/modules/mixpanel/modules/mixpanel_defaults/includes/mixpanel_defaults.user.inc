<?php

/**
 * @file
 * Sends events related to users to Mixpanel.
 */

/**
 * Implements hook_user_insert().
 */
function mixpanel_defaults_user_insert(&$edit, $account, $category) {
  mixpanel_track("user-inserted", NULL, $account);
}

/**
 * Implements hook_user_cancel().
 */
function mixpanel_defaults_user_cancel($edit, $account, $method) {
  mixpanel_track("user-deleted", NULL, $acccount);
}

/**
 * Implements hook_user_login().
 */
function mixpanel_defaults_user_login(&$edit, $account) {
  mixpanel_track("user-login", NULL, $account);
}

/**
 * Implements hook_user_logout().
 */
function mixpanel_defaults_user_logout($account) {
  mixpanel_track("user-logout", NULL, $account);
}

/**
 * Submit function for contact_mail_user to track usage of the contact form.
 */
function mixpanel_defaults_contact_personal_form_submit($form, $form_state) {
  mixpanel_track("contact-form-user");
}

/**
 * Submit function for the user_profile_form to let us track user changes
 * to their accounts.
 */
function mixpanel_defaults_user_profile_form_submit($form, $form_state) {
  mixpanel_track("user-account-updated");

  // If a picture was uploaded, submit an event for that as well.
  if (!empty($form_state['values']['picture_delete']) || !empty($form_state['values']['picture_upload'])) {
    mixpanel_track("user-picture-changed");
  }
}

