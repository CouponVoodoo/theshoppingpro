<?php
/**
 * @file
 * views_slideshow_liquid_slider.views_slideshow.inc
 */

/**
 * Implements hook_views_slideshow_slideshow_info().
 */
function views_slideshow_liquid_slider_views_slideshow_slideshow_info() {
  return array(
    'views_slideshow_liquid_slider' => array(
      'name' => t('Liquid Slider'),
      'accepts' => array(),
      'calls' => array(),
    ),
  );
}

/**
 * Implements hook_views_slideshow_slideshow_type_form().
 */
function views_slideshow_liquid_slider_views_slideshow_slideshow_type_form(&$form, &$form_state, &$view) {
  if (!$library = _views_slideshow_liquid_slider_library_path()) {
    $form['views_slideshow_liquid_slider']['no_liquidslider_js'] = array(
      '#prefix' => '<div style="color: red">',
      '#suffix' => '</div>',
      '#markup' => _views_slideshow_liquid_slider_get_install_error_message(),
    );
  }

  $form['views_slideshow_liquid_slider']['autoslide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable/disable the auto slider functionality.'),
    '#default_value' => $view->options['views_slideshow_liquid_slider']['autoslide'],
  );
  $form['views_slideshow_liquid_slider']['autoslideinterval'] = array(
    '#type' => 'textfield',
    '#title' => t('Duration auto slide'),
    '#default_value' => $view->options['views_slideshow_liquid_slider']['autoslideinterval'],
    '#description' => t('The timer for the autoslide. 7000 = 7 seconds.'),
  );
  $form['views_slideshow_liquid_slider']['autoheight'] = array(
    '#type' => 'checkbox',
    '#title' => t('Auto adjusts the height to match the current panel.'),
    '#default_value' => $view->options['views_slideshow_liquid_slider']['autoheight'],
    '#description' => t('If false, the height stays at that of the highest panel.'),
  );
  $form['views_slideshow_liquid_slider']['autoheightmin'] = array(
    '#type' => 'textfield',
    '#title' => t('Auto Height Min'),
    '#default_value' => $view->options['views_slideshow_liquid_slider']['autoheightmin'],
    '#description' => t('You can set up a minimum height for the slider.'),
  );
  $form['views_slideshow_liquid_slider']['dynamicarrows'] = array(
    '#type' => 'checkbox',
    '#title' => t('Sets whether the arrows will be dynamically created or not.'),
    '#default_value' => $view->options['views_slideshow_liquid_slider']['dynamicarrows'],
  );

  $link_options = array('none' => t('None'));

  foreach ($view->display->handler->get_handlers('field') as $field => $handler) {
    $link_options[$field] = $handler->ui_name();
  }

  $form['views_slideshow_liquid_slider']['caption_field'] = array(
    '#type' => 'select',
    '#title' => t('Caption Field'),
    '#multiple' => FALSE,
    '#description' => t('Select a field to be used as an image caption.'),
    '#options' => $link_options,
    '#default_value' => $view->options['views_slideshow_liquid_slider']['caption_field'],
  );

}

/**
 * Form validation callback for the slideshow settings.
 */
function views_slideshow_liquid_slider_views_slideshow_options_form_validate(&$form, &$form_state, &$view) {
  $values = $form_state['values']['style_options']['views_slideshow_liquid_slider'];

  if (!is_numeric($values['autoslideinterval'])) {
    form_error($form['views_slideshow_liquid_slider']['autoslideinterval'], t('!setting must be numeric!', array('!setting' => 'Duration auto slide')));
  }

  if (!is_numeric($values['autoheightmin'])) {
    form_error($form['views_slideshow_liquid_slider']['autoheightmin'], t('!setting must be numeric!', array('!setting' => 'Auto Height Min')));
  }

}

/**
 * Implements hook_views_slideshow_option_definition().
 */
function views_slideshow_liquid_slider_views_slideshow_option_definition() {
  $options['views_slideshow_liquid_slider'] = array(
    'contains' => array(
      'caption_field' => array('none' => 'None'),
      'autoslide' => array('default' => 0),
      'autoslideinterval' => array('default' => 7000),
      'autoheight' => array('default' => 1),
      'autoheightmin' => array('default' => 0),
      'dynamicarrows' => array('default' => 1),
    ),
  );
  return $options;
}

/**
 * Implements hook_views_slideshow_skin_info().
 */
function views_slideshow_liquid_slider_views_slideshow_skin_info() {
  return array(
    'default' => array(
      'name' => t('Default'),
    ),
  );
}
