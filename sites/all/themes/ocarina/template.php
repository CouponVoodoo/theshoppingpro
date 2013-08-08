<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 *
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
function ocarina_preprocess_html(&$vars) {
  $file = theme_get_setting('theme_color') . '-style.css';
  drupal_add_css(path_to_theme() . '/css/' . $file, array('group' => CSS_THEME, 'weight' => 115, 'browsers' => array(), 'preprocess' => FALSE));
  drupal_add_js(array(
      'CToolsModal' => array(
          'closeText'=> '',
          'closeImage' => theme('image', array(
          'path' => ctools_image_path('icon-close-window.png'),
          'title' => t('Close window'),
          'alt' => t('Close window'),
          ))
      )), 'setting');

  if (arg(0)=="node" && arg(1)=="17609566") {
    drupal_add_js("Drupal.behaviors.ModalClickCloseReload = {
                    attach: function(context, settings) {
                    jQuery('.close').bind('click', function() {
                                location.reload();
                            });
                    }
                    };",'inline');
  }

}


function ocarina_preprocess_page(&$variables) {
  drupal_add_js(path_to_theme() . '/js/colorbox.js');
  // Different template and additional stylsheet for colorbox content.
  if (isset($_GET['colorbox']) && $_GET['colorbox'] == TRUE) {
    $variables['theme_hook_suggestions'][] = 'page__embed';
    //drupal_add_css(path_to_theme() .'/iframe.css');
    $variables['styles'] = drupal_get_css();
  }
  if (arg(0)=="node" && drupal_get_path_alias(arg(0)."/".arg(1)) == "installation_page" && is_null(arg(2))) {
    $variables['theme_hook_suggestions'][] = 'page__installation_page';
  }

  #print_r($variables['theme_hook_suggestions']);exit;
}



function ocarina_theme(&$existing, $type, $theme, $path) {
  $hooks['user_login_block'] = array(
      'template' => 'templates/user-login-block',
      'render element' => 'form',
  );
  return $hooks;
}

function ocarina_preprocess_user_login_block(&$vars) {
  unset($vars['form']['links']);
  unset($vars['form']['#block']->subject);

  unset($vars['form']['name']['#title']);
  unset($vars['form']['pass']['#title']);

  $vars['form']['name']['#attributes']['placeholder'] = t('Username');
  $vars['form']['pass']['#attributes']['placeholder'] = t('Password');

  $vars['form']['name']['#size'] = 10;
  $vars['form']['pass']['#size'] = 10;
  $vars['form']['#block']->subject = '';
  $vars['name'] = render($vars['form']['name']);
  $vars['pass'] = render($vars['form']['pass']);
  $vars['submit'] = render($vars['form']['actions']['submit']);
  $vars['rendered'] = drupal_render_children($vars['form']);
}

/**
* Render Block.
*/

function block_render($module, $block_id) {

$block = block_load($module, $block_id);

$block_content = _block_render_blocks(array($block));

$build = _block_get_renderable_array($block_content);

$block_rendered = drupal_render($build);

return $block_rendered;

}

function get_microrelation_display_text($loop_id,$nid){
$output=db_query("SELECT *
FROM {field_data_field_display_text_rel} fdtr
INNER JOIN {field_data_field_micro_category} fmc ON fdtr.entity_id=fmc.entity_id
INNER JOIN {field_data_field_mc_retailer} fmr ON fmc.entity_id=fmr.entity_id
WHERE fmc.field_micro_category_tid=:mct AND fmr.field_mc_retailer_nid =:nid" ,array(':mct'=>$loop_id,':nid'=>$nid));

foreach ($output as $output_detail1):
$maincategory_out=$output_detail1->field_display_text_rel_value;
endforeach;
$row_count=$output->rowCount();

$data = array(
'maincategory_desc' => $maincategory_out,
'row_count' => $row_count,
);

return $data;

}