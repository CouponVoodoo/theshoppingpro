<?php

/**
 * Here we override the default HTML output of drupal.
 * refer to http://drupal.org/node/550722
 */
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
    // Rebuild .info data.
    system_rebuild_theme_data();
    // Rebuild theme registry.
    drupal_theme_rebuild();
}

// Add Zen Tabs styles
if (theme_get_setting('basic_tabs')) {
    drupal_add_css(drupal_get_path('theme', 'basic') . '/css/tabs.css');
}

function basic_preprocess_html(&$vars) {
    global $base_url, $user;
    $settings = array(
        'CToolsModal' => array(
            'loadingText' => t('Loading...'),
            'closeText' => t(''),
            'closeImage' => theme('image', array(
                'path' => $base_url . "/" . drupal_get_path('theme', 'basic') . "/images/u6_normal.png",
                'title' => t('Close window'),
                'alt' => t('Close window'),
            )),
            'throbber' => theme('image', array(
                'path' => ctools_image_path('throbber.gif'),
                'title' => t('Loading...'),
                'alt' => t('Loading'),
            )),
            'modalSize' => array(
                'width' => '0.38',
                'height' => '0.8',
            ),
            'modalOptions' => array(
                'background' => '#333',
            )
        ),
    );

    drupal_add_js($settings, 'setting');

    // Add role name classes (to allow css based show for admin/hidden from user)
    foreach ($user->roles as $role) {
        $vars['classes_array'][] = 'role-' . basic_id_safe($role);
    }

    // HTML Attributes
    // Use a proper attributes array for the html attributes.
    $vars['html_attributes'] = array();
    $vars['html_attributes']['lang'][] = $language->language;
    $vars['html_attributes']['dir'][] = $language->dir;

    // Convert RDF Namespaces into structured data using drupal_attributes.
    $vars['rdf_namespaces'] = array();
    if (function_exists('rdf_get_namespaces')) {
        foreach (rdf_get_namespaces () as $prefix => $uri) {
            $prefixes[] = $prefix . ': ' . $uri;
        }
        $vars['rdf_namespaces']['prefix'] = implode(' ', $prefixes);
    }

    // Flatten the HTML attributes and RDF namespaces arrays.
    $vars['html_attributes'] = drupal_attributes($vars['html_attributes']);
    $vars['rdf_namespaces'] = drupal_attributes($vars['rdf_namespaces']);

    if (!$vars['is_front']) {
        // Add unique classes for each page and website section
        $path = drupal_get_path_alias($_GET['q']);
        list($section, ) = explode('/', $path, 2);
        $vars['classes_array'][] = 'with-subnav';
        $vars['classes_array'][] = basic_id_safe('page-' . $path);
        $vars['classes_array'][] = basic_id_safe('section-' . $section);

        if (arg(0) == 'node') {
            if (arg(1) == 'add') {
                if ($section == 'node') {
                    // Remove 'section-node'
                    array_pop($vars['classes_array']);
                }
                // Add 'section-node-add'
                $vars['classes_array'][] = 'section-node-add';
            } elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
                if ($section == 'node') {
                    // Remove 'section-node'
                    array_pop($vars['classes_array']);
                }
                // Add 'section-node-edit' or 'section-node-delete'
                $vars['classes_array'][] = 'section-node-' . arg(2);
            }
        }
    }
    //for normal un-themed edit pages
    if ((arg(0) == 'node') && (arg(2) == 'edit')) {
        $vars['template_files'][] = 'page';
    }

    // Add IE classes.
    if (theme_get_setting('basic_ie_enabled')) {
        $basic_ie_enabled_versions = theme_get_setting('basic_ie_enabled_versions');
        if (in_array('ie8', $basic_ie_enabled_versions, TRUE)) {
            drupal_add_css(path_to_theme() . '/css/ie8.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 8', '!IE' => FALSE), 'preprocess' => FALSE));
            drupal_add_js(path_to_theme() . '/js/selectivizr-min.js');
        }
        if (in_array('ie9', $basic_ie_enabled_versions, TRUE)) {
            drupal_add_css(path_to_theme() . '/css/ie9.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 9', '!IE' => FALSE), 'preprocess' => FALSE));
        }
        if (in_array('ie10', $basic_ie_enabled_versions, TRUE)) {
            drupal_add_css(path_to_theme() . '/css/ie10.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 10', '!IE' => FALSE), 'preprocess' => FALSE));
        }
    }
	  
/* BY ASHISH TO CHANGE THE PAGE TITLE OF WHITE LABEL DOMAIN*/
	$current_domain = get_current_domain();
	$content_type = arg(0);
	if ($current_domain == 'cuponation') {
		switch ($content_type) {
			case "taxonomy":
				$tid = arg(2);
				$taxonomy = taxonomy_term_load($tid);
				$taxonomy_name = $taxonomy->name;
				$vars['head_title'] = $taxonomy_name.' Coupons, Deals & Discounts | Cuponation';
			break;
			case "node":
				$nid = arg(1);
				$node = node_load($nid);
				if($node->type == '_product_and_coupon') {
				$mrp = $node->field_mrpproductprice['und'][0]['value'];
				$list_price = $node->field_product_price['und'][0]['value'];
				$non_coupon_saving = $mrp - $list_price;
				if ($node->field_best_coupon_saving['und']['0']['value'] > 1) {
					$node_title = 'Get INR '.$node->field_best_coupon_saving['und']['0']['value'].' off on '.$node->field_retailer_product_name['und']['0']['value'].' @ Rs. '.$node->field_best_coupon_netpriceafters['und']['0']['value'].' | CupoNation';
					$vars['head_title'] = $node_title;
					}
				else if ($non_coupon_saving>0) {
				$node_title = 'Get INR '.$non_coupon_saving.' off on '.$node->field_retailer_product_name['und']['0']['value'].' @ Rs. '.$node->field_best_coupon_netpriceafters['und']['0']['value'].' | CupoNation';
					$vars['head_title'] = $node_title;
				}	
				} else { 
					$variables = get_defined_vars();
					$vars['head_title'] = $variables[vars]['page']['content']['system_main']['nodes'][$nid]['#node']->title;
				}
			break;
			case "rcp":
				$retailer_name = str_replace('.com','',arg(1));
				$vars['head_title'] = 'Save Big Via '.$retailer_name.' Coupons | Cuponation';
			break;
		}
	} Else {
	switch ($content_type) {
			case "term":
				$vars['head_title'] = 'Latest coupons from leading online stores in India '.date("F Y").'  | Couponvoodoo';
			break;
			case "":
				$retailer_name = str_replace('.com','',arg(1));
				$vars['head_title'] = 'Latest '.$retailer_name.' Coupons - Save Upto 50% | Couponvoodoo';
			break;
			case "node":
				$nid = arg(1);
				$node = node_load($nid);
				$mrp = $node->field_mrpproductprice['und'][0]['value'];
				$list_price = $node->field_product_price['und'][0]['value'];
				$non_coupon_saving = $mrp - $list_price;
				if($node->type == '_product_and_coupon') {
					if ($node->field_best_coupon_saving['und']['0']['value'] > 0) {
                        $node_title = 'Save INR '.$node->field_best_coupon_saving['und']['0']['value'].' on '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.')| CouponVoodoo';
						$vars['head_title'] = $node_title;
					} 
					else if ($non_coupon_saving > 0){
						$node_title = 'Save INR '.$non_coupon_saving.' on '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.')| CouponVoodoo';
						
						$vars['head_title'] = $node_title;					
					}
					Else {
						$node_title = 'Todays coupons for '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.')| CouponVoodoo';
						$vars['head_title'] = $node_title;					
					}
				} else { 
					$variables = get_defined_vars();
					$vars['head_title'] = $variables[vars]['page']['content']['system_main']['nodes'][$nid]['#node']->title;
				}
			break;


		}
	}
}

/* BY ASHISH TO CHANGE THE META TAGS OF WHITE LABEL DOMAIN*/
function basic_html_head_alter(&$head_elements) {
	$current_domain = get_current_domain();
	$content_type = arg(0);
	if ($current_domain == 'cuponation') {
		switch ($content_type) {
			case "taxonomy":
				$tid = arg(2);
				$taxonomy = taxonomy_term_load($tid);
				$taxonomy_name = $taxonomy->name;
				$head_elements['metatag_description']['#value'] = 'Get '.$taxonomy_name.' products in India at great price with tested coupons, deals and offers from CupoNation';
				$head_elements['metatag_abstract']['#value'] = 'Get '.$taxonomy_name.' products in India at great price with tested coupons, deals and offers from CupoNation';
				$head_elements['rdf_node_title']['#attributes']['content'] = 'Get '.$taxonomy_name.' products in India at great price with tested coupons, deals and offers from CupoNation';
			break;
			case "node":
				$nid = arg(1);
				$variables = get_defined_vars();
				$node = node_load($nid);
				if($node->type == '_product_and_coupon') {
					// $node_title = 'ddd'.$node->field_retailer_product_name['und']['0']['value'].' @ Rs. '.$node->field_best_coupon_netpriceafters['und']['0']['value'].' | CupoNation';
					// $vars['head_title'] = $node_title;
					$node_product_name = $node->field_retailer_product_name['und']['0']['value'];
					$node_net_price = $node->field_best_coupon_netpriceafters['und']['0']['value'];
					$retailer = taxonomy_term_load($node->field_retailer['und']['0'][tid]);
					$retailer_name = $retailer->name;
					$head_elements['metatag_description']['#value'] = $node_product_name.' (CN'.$nid.')'.' is available for the best price of Rs. '.$node_net_price.' @ '.$retailer_name.' using Discount Coupons and Promo Codes from CupoNation';
					$head_elements['metatag_abstract']['#value'] = $node_product_name.' (CN'.$nid.')'.' is available for the best price of Rs. '.$node_net_price.' @ '.$retailer_name.' using Discount Coupons and Promo Codes from CupoNation';
					$head_elements['rdf_node_title']['#attributes']['content'] = $node_product_name.' (CN'.$nid.')'.' is available for the best price of Rs. '.$node_net_price.' @ '.$retailer_name.' using Discount Coupons and Promo Codes from CupoNation';
				} 
			break;
			case "rcp":
				$retailer_name = str_replace('.com','',arg(1));
				$head_elements['metatag_description']['#value'] = 'Save every time you shop via '.$retailer_name.' Coupons. Cuponation tests all '.$retailer_name.' coupons so they work without a glitch';
				$head_elements['metatag_abstract']['#value'] = 'Save every time you shop via '.$retailer_name.' Coupons. Cuponation tests all '.$retailer_name.' coupons so they work without a glitch';
				$head_elements['rdf_node_title']['#attributes']['content'] = 'Save every time you shop via '.$retailer_name.' Coupons. Cuponation tests all '.$retailer_name.' coupons so they work without a glitch';
			break;
		}
		$head_elements['metatag_author']['#value'] = '';
	} else{
		switch ($content_type) {
			case "rcp":
				$retailer_name = str_replace('.com','',arg(1));
				$head_elements['metatag_description']['#value'] = 'Now get the latest and tested '.$retailer_name.' coupons for via CouponVoodoo. Save every time you shop at '.$retailer_name;
				$head_elements['metatag_abstract']['#value'] = 'Now get the latest and tested '.$retailer_name.' coupons for via CouponVoodoo. Save every time you shop at '.$retailer_name;
				$head_elements['rdf_node_title']['#attributes']['content'] = 'Now get the latest and tested '.$retailer_name.' coupons for via CouponVoodoo. Save every time you shop at '.$retailer_name;
			break;
			case "node":
				$nid = arg(1);
				$variables = get_defined_vars();
				$node = node_load($nid);
				if($node->type == '_product_and_coupon') {
					// $node_title = $node->field_retailer_product_name['und']['0']['value'].' @ Rs. '.$node->field_best_coupon_netpriceafters['und']['0']['value'].' | CupoNation';
					// $vars['head_title'] = $node_title;
					$node_product_name = $node->field_retailer_product_name['und']['0']['value'];
					$node_net_price = $node->field_best_coupon_netpriceafters['und']['0']['value'];
					$retailer = taxonomy_term_load($node->field_retailer['und']['0']['tid']);
					$retailer_name = $retailer->name;
					if ($node->field_best_coupon_saving['und']['0']['value'] > 0) {
						$head_elements['metatag_description']['#value'] = 'Save INR '.$node->field_best_coupon_saving['und']['0']['value'].' on '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' via coupons by CouponVoodoo - the #1 destination for savings across brands and retailers';
						$head_elements['metatag_abstract']['#value'] = 'Save INR '.$node->field_best_coupon_saving['und']['0']['value'].' on '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' via coupons by CouponVoodoo - the #1 destination for savings across brands and retailers';
						$head_elements['rdf_node_title']['#attributes']['content'] = 'Save INR '.$node->field_best_coupon_saving['und']['0']['value'].' on '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' via coupons by CouponVoodoo - the #1 destination for savings across brands and retailers';
					} else {
						$head_elements['metatag_description']['#value'] = 'Now check the latest coupons for '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' with one click via CouponVoodoo - the #1 destination for savings across brands and retailers';
						$head_elements['metatag_abstract']['#value'] =  'Now check the latest coupons for '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' with one click via CouponVoodoo - the #1 destination for savings across brands and retailers';
						$head_elements['rdf_node_title']['#attributes']['content'] =  'Now check the latest coupons for '.$node->field_retailer_product_name['und']['0']['value'].' (CV'.$nid.') at '.$retailer_name.' with one click via CouponVoodoo - the #1 destination for savings across brands and retailers';
					}
				} 
			break;
		}
	}
}


function basic_preprocess_page(&$vars, $hook) {
    
    /*if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
        $tid = arg(2);
        $vid = db_query("SELECT vid FROM {taxonomy_term_data} WHERE tid = :tid", array(':tid' => $tid))->fetchField();
        $vars['theme_hook_suggestions'][] = 'page__vocabulary__' . $vid;
    }*/
    
    if (isset($vars['node_title'])) {
        $vars['title'] = $vars['node_title'];
    }
    // Adding classes whether #navigation is here or not
    if (!empty($vars['main_menu']) or !empty($vars['sub_menu'])) {
        $vars['classes_array'][] = 'with-navigation';
    }
    if (!empty($vars['secondary_menu'])) {
        $vars['classes_array'][] = 'with-subnav';
    }

    // Add first/last classes to node listings about to be rendered.
    if (isset($vars['page']['content']['system_main']['nodes'])) {
        // All nids about to be loaded (without the #sorted attribute).
        $nids = element_children($vars['page']['content']['system_main']['nodes']);
        // Only add first/last classes if there is more than 1 node being rendered.
        if (count($nids) > 1) {
            $first_nid = reset($nids);
            $last_nid = end($nids);
            $first_node = $vars['page']['content']['system_main']['nodes'][$first_nid]['#node'];
            $first_node->classes_array = array('first');
            $last_node = $vars['page']['content']['system_main']['nodes'][$last_nid]['#node'];
            $last_node->classes_array = array('last');
        }
    }

    // Allow page override template suggestions based on node content type.
    if (isset($vars['node']->type) && isset($vars['node']->nid)) {
        $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
        $vars['theme_hook_suggestions'][] = "page__node__" . $vars['node']->nid;
    }

    if (arg(0) == "coupon-redirect") {
        $vars['theme_hook_suggestions'][] = "page__coupon-redirect";
    }
}

function basic_preprocess_node(&$vars) {
    
    if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
        $tid = arg(2);
        $vid = db_query("SELECT vid FROM {taxonomy_term_data} WHERE tid = :tid", array(':tid' => $tid))->fetchField();
        $vars['theme_hook_suggestions'][] = 'page__vocabulary__' . $vid;
    }
    
    if (arg(0) == 'search' && arg(1) == 'site') {
        $vars['theme_hook_suggestions'][] = 'node__custom_search' ;
    }
    
    // Add a striping class.
    $vars['classes_array'][] = 'node-' . $vars['zebra'];

    // Add $unpublished variable.
    $vars['unpublished'] = (!$vars['status']) ? TRUE : FALSE;

    // Merge first/last class (from basic_preprocess_page) into classes array of current node object.
    $node = $vars['node'];
    if (!empty($node->classes_array)) {
        $vars['classes_array'] = array_merge($vars['classes_array'], $node->classes_array);
    }
}
/* COMMENTED OUT BY ASHISH AS IT WAS CREATING DUPLICATE JS CALL WHENEVER DRUPAL_ADD_JS WAS USED
function basic_preprocess_block(&$vars, $hook) {
    // Add a striping class.
    $vars['classes_array'][] = 'block-' . $vars['block_zebra'];

    // Add first/last block classes
    $first_last = "";
    // If block id (count) is 1, it's first in region.
    if ($vars['block_id'] == '1') {
        $first_last = "first";
        $vars['classes_array'][] = $first_last;
    }
    // Count amount of blocks about to be rendered in that region.
    $block_count = count(block_list($vars['elements']['#block']->region));
    if ($vars['block_id'] == $block_count) {
        $first_last = "last";
        $vars['classes_array'][] = $first_last;
    }
}
*/
/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function basic_breadcrumb($variables) {
    $breadcrumb = $variables['breadcrumb'];
    // Dirty code to wrap A href text in Span tag.
    $delimiter1 = '</a>';
    $delimiter2 = '>';
    foreach ($breadcrumb as $key => $bc) {
        if (preg_match('[</[a]>$]', $bc)) {
            // Remove '</a>' from the link
            $linkAndText = explode($delimiter1, $bc);
            // Get only text from the exploded array above
            $text = explode($delimiter2, $linkAndText[0]);
            $text[1] = '<span itemprop="title">' . $text[1] . '</span>';
            // Assign the current breadcrumb array key with updated value.
            $breadcrumb[$key] = $text[0] . ' itemprop="url" ' . $delimiter2 . $text[1] . $delimiter1;
        }
    }
    // Determine if we are to display the breadcrumb.
    $show_breadcrumb = theme_get_setting('basic_breadcrumb');
	$wrapDiv = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';	
    if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {
        // Optionally get rid of the homepage link.
        $show_breadcrumb_home = theme_get_setting('basic_breadcrumb_home');
        if (!$show_breadcrumb_home) {
            array_shift($breadcrumb);
        }

        // Return the breadcrumb with separators.
        if (!empty($breadcrumb)) {
            $breadcrumb_separator = theme_get_setting('basic_breadcrumb_separator');
            $trailing_separator = $title = '';
            if (theme_get_setting('basic_breadcrumb_title')) {
                $item = menu_get_item();
                if (!empty($item['tab_parent'])) {
                    // If we are on a non-default tab, use the tab's title.
                    $title = check_plain($item['title']);
                } else {
                    $title = drupal_get_title();
                }
                if ($title) {
                    $trailing_separator = $breadcrumb_separator;
                }
            } elseif (theme_get_setting('basic_breadcrumb_trailing')) {
                $trailing_separator = $breadcrumb_separator;
            }

            // Provide a navigational heading to give context for breadcrumb links to
            // screen-reader users. Make the heading invisible with .element-invisible.
            $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
            //return $heading . '<div class="breadcrumb">' . implode($breadcrumb_separator, $breadcrumb) . $trailing_separator . $title . '</div>';
			return $heading . '<div class="breadcrumb">' . $wrapDiv . implode($breadcrumb_separator . '</div>' . $wrapDiv, $breadcrumb) . $trailing_separator . $title . '</div></div>';
        }
    }
    // Otherwise, return an empty string.
    return '';
}
/*
function basic_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb"><li itemtype="http://data-vocabulary.org/Breadcrumb">' . implode(' </li> » <li itemtype="http://data-vocabulary.org/Breadcrumb">', $breadcrumb) . '</li></div>';
    return $output;
  }
}
*/
/**
 * Converts a string to a suitable html ID attribute.
 *
 * http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 * valid ID attribute in HTML. This function:
 *
 * - Ensure an ID starts with an alpha character by optionally adding an 'n'.
 * - Replaces any character except A-Z, numbers, and underscores with dashes.
 * - Converts entire string to lowercase.
 *
 * @param $string
 *  The string
 * @return
 *  The converted string
 */
function basic_id_safe($string) {
    // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
    $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
    // If the first character is not a-z, add 'n' in front.
    if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
        $string = 'id' . $string;
    }
    return $string;
}

/**
 * Generate the HTML output for a menu link and submenu.
 *
 * @param $variables
 *  An associative array containing:
 *   - element: Structured array data for a menu link.
 *
 * @return
 *  A themed HTML string.
 *
 * @ingroup themeable
 *
 */
function basic_menu_link(array $variables) {
    $element = $variables['element'];
    $sub_menu = '';

    if ($element['#below']) {
        $sub_menu = drupal_render($element['#below']);
    }
    
    //remove menu title
    $element['#localized_options']['attributes']['title'] = ''; 
    
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    // Adding a class depending on the TITLE of the link (not constant)
    $element['#attributes']['class'][] = basic_id_safe($element['#title']);
    // Adding a class depending on the ID of the link (constant)
    if (isset($element['#original_link']['mlid']) && !empty($element['#original_link']['mlid'])) {
        $element['#attributes']['class'][] = 'mid-' . $element['#original_link']['mlid'];
    }
    
    $popMenu = strip_tags($output);
      
    if( $element['#original_link']['mlid'] == 790 ){    
        $output  = '<span class="nolink" title="">'.$popMenu.'</span>';
    }
    
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Override or insert variables into theme_menu_local_task().
 */
function basic_preprocess_menu_local_task(&$variables) {
    $link = & $variables['element']['#link'];

    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link['localized_options']['html'])) {
        $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
    $link['title'] = '<span class="tab">' . $link['title'] . '</span>';
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function basic_menu_local_tasks(&$variables) {
    $output = '';

    if (!empty($variables['primary'])) {
        $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
        $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
        $variables['primary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['primary']);
    }
    if (!empty($variables['secondary'])) {
        $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
        $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
        $variables['secondary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['secondary']);
    }
    return $output;
}

/**
 * BY ASHISH to Change no result text.
 */

function basic_apachesolr_search_noresults(&$variables) {
  return t('</br> </br> </br> Whoops! No result found. Kindly: </br> </br><ul>
<li>Check spellings or remove filters</li>
<li>Remove special characters</li>
<li>Visit the <a href="/search/site">All Products Page</a></li>
</ul>');
}



