<?php

/**
 * @file
 * Advanced aggregation css compression module.
 */

/**
 * Implement hook_advagg_get_css_aggregate_contents_alter().
 */
function advagg_css_compress_advagg_get_css_aggregate_contents_alter(&$data, $files, $aggregate_settings) {
  if (empty($aggregate_settings['variables']['advagg_css_compressor'])) {
    return;
  }

  if ($aggregate_settings['variables']['advagg_css_compressor'] == 2) {
    advagg_css_compress_yui_cssmin($data);
  }
}

/**
 * Use the CSSmin library from YUI to compress the CSS.
 */
function advagg_css_compress_yui_cssmin(&$data) {
  // Only include CSSMin.inc if the CSSmin class doesn't exist.
  if (!class_exists('CSSmin')) {
    include(drupal_get_path('module', 'advagg_css_compress') . '/yui/CSSMin.inc');
  }

  $cssmin = new CSSmin(FALSE);
  // Compress the CSS splitting lines after 4k of text
  $data = $cssmin->run($data, 4096);
}


