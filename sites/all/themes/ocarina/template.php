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
  if (arg(0)=="node" && arg(1) =="17609654") {
    $inline_script = <<<EOL
     <script type="text/javascript">
        var fb_param = {};
        fb_param.pixel_id = '6008135976203';
        fb_param.value = '0.00';
        (function(){
          var fpw = document.createElement('script');
          fpw.async = true;
          fpw.src = '//connect.facebook.net/en_US/fp.js';
          var ref = document.getElementsByTagName('script')[0];
          ref.parentNode.insertBefore(fpw, ref);
        })();
        </script>
     <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6008135976203&amp;value=0" /></noscript>
EOL;
    $element = array(
            '#type' => 'markup',
            '#markup' => $inline_script,
    );
    drupal_add_html_head($element, 'facebook_html_welcome_page');
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
