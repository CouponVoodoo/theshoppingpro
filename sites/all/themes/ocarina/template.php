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
/* Current Page URL */
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return $pageURL;
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
INNER JOIN {field_data_field_mc_landing_url} fmlu ON fmc.entity_id=fmlu.entity_id
WHERE fmc.field_micro_category_tid=:mct AND fmr.field_mc_retailer_nid =:nid" ,array(':mct'=>$loop_id,':nid'=>$nid));

foreach ($output as $output_detail1):
$maincategory_out=$output_detail1->field_display_text_rel_value;
$landing_url=$output_detail1->field_mc_landing_url_value;
endforeach;
$row_count=$output->rowCount();

$data = array(
'maincategory_desc' => $maincategory_out,
'row_count' => $row_count,
'landing_url' => $landing_url,
);

return $data;

}

function get_landing_url($loop_id,$nid){
$output=db_query("SELECT *
FROM {field_data_field_micro_category} fmc
INNER JOIN {field_data_field_mc_retailer} fmr ON fmc.entity_id=fmr.entity_id
INNER JOIN {field_data_field_mc_landing_url} fmlu ON fmc.entity_id=fmlu.entity_id
WHERE fmc.field_micro_category_tid=:mct AND fmr.field_mc_retailer_nid =:nid" ,array(':mct'=>$loop_id,':nid'=>$nid));

foreach ($output as $output_detail1):
$landing_url=$output_detail1->field_mc_landing_url_value;
endforeach;
$row_count=$output->rowCount();

$data = array(
'landing_url' => $landing_url,
);

return $data;

}


//Cash back url with sub id's for Retailer page and ter micro category page.
function get_corp_url($domain_value,$value_url){
global $user;
global $base_url;
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv" ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):
$node_load=node_load($output_detail1->entity_id);
$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];
$affiliate_id=$node_load->field_active_affiliate['und'][0]['tid'];


//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT *
FROM {field_data_field_url_part1} fup
INNER JOIN {field_data_field_url_part2} fup2 ON fup.entity_id=fup2.entity_id
WHERE fup.entity_id=:entity_id" ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;
$tracking_url_part2=$tracking_url->field_url_part2_value;
endforeach;
endforeach;

$single_decode=urldecode($value_url);
$redirect=urldecode($single_decode);
$url_part2 =urlencode($tracking_url_part2);
$redirect1=urlencode($redirect);
$redirect2 = $redirect1 . $url_part2;
if($affiliate_id==36):
$query ='&k='. $user->uid. '&t=' . $redirect2;
$final_url = $tracking_url_part1 . $query;
elseif($affiliate_id==19):
$query ='&uid='. $user->uid .'&redirect=' . $redirect2;
$final_url = $tracking_url_part1 . '?' . $query;
elseif($affiliate_id==33 || $affiliate_id==35):
$url_part2 =implode("/", array_map("rawurlencode", explode("/", $tracking_url_part2)));
$redirect1 =implode("/", array_map("rawurlencode", explode("/", $redirect)));
$redirect2 = $redirect1 . $url_part2;
$final_url = $tracking_url_part1 ."%2526subid1%253D". $user->uid .'&lnkurl=' . $redirect2;
elseif($affiliate_id==34):
$query ='&subid1=' . $user->uid .'&subid3=%TRANSACTION_ID%&lnkurl=' . $redirect2;
$final_url = $tracking_url_part1 . $query;
endif;

if($user->uid<>0):
return $final_url;
else:
$final_url=$base_url."/modal_forms/nojs/login?destination=".curPageURL();
return $final_url;
endif;
}


//Cash back url with out subid's for coupon finder.
function getcashbackurl($domain_value,$value_url){
global $user;
global $base_url;
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv" ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):
$node_load=node_load($output_detail1->entity_id);
$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];
$affiliate_id=$node_load->field_active_affiliate['und'][0]['tid'];


//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT *
FROM {field_data_field_url_part1} fup
INNER JOIN {field_data_field_url_part2} fup2 ON fup.entity_id=fup2.entity_id
WHERE fup.entity_id=:entity_id" ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;
$tracking_url_part2=$tracking_url->field_url_part2_value;
endforeach;
endforeach;

$single_decode=urldecode($value_url);
$redirect=urldecode($single_decode);
$url_part2 =urlencode($tracking_url_part2);
$redirect1=urlencode($redirect);
$redirect2 = $redirect1 . $url_part2;
if($affiliate_id==36):
$query ='&k=' . $redirect2;
$final_url = $tracking_url_part1 . $query;
elseif($affiliate_id==19):
$query ='&redirect=' . $redirect2;
$final_url = $tracking_url_part1 . '?' . $query;
elseif($affiliate_id==33 || $affiliate_id==35):
$url_part2 =implode("/", array_map("rawurlencode", explode("/", $tracking_url_part2)));
$redirect1 =implode("/", array_map("rawurlencode", explode("/", $redirect)));
$redirect2 = $redirect1 . $url_part2;
$final_url = $tracking_url_part1 . '&lnkurl=' . $redirect2;
elseif($affiliate_id==34):
$query ='&subid3=%TRANSACTION_ID%&lnkurl=' . $redirect2;
$final_url = $tracking_url_part1 . $query;
endif;

return $final_url;

}