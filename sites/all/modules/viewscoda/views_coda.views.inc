<?php
// $Id: views_coda.views.inc,v 1.1 2010/05/18 16:52:23 cristhian Exp $

/**
 *  @file
 *  Defines coda view style plugins.
 */

/**
 * Implementation of hook_views_plugins()
 */
function views_coda_views_plugins() {
  return array(
    'style' => array(
      'coda' => array(
        'title' => t('Coda'),
        'help' => t('Display the results as a coda slider.'),
        'handler' => 'views_coda_plugin_style_default',
        'theme' => 'views_coda',
        'uses options' => TRUE,
        'uses row plugin' => TRUE,
        'type' => 'normal',
        'parent' => 'list',
      ),
    ),
  );
}

