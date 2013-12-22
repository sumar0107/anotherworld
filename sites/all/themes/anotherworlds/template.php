<?php

/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see http://drupal.org/node/1728096
 */
/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
  function STARTERKIT_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
  }
  // */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */

  function anotherworlds_preprocess_html(&$variables, $hook) {
//drupal_add_js("
//    var _gaq = _gaq || [];
//  _gaq.push(['_setAccount', 'UA-26887948-2']);
//  _gaq.push(['_trackPageview']);
//
//  (function() {
//    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
//    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
//    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
//  })();
//", "inline");
  }
  // */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function anotherworlds_preprocess_page(&$variables, $hook) {
  global $theme_path;
  $variables['theme_path'] = $theme_path;
  
  $tabs = render($variables['tabs']);
  if (arg(2) == '' && !path_is_admin(current_path())) {
    if (function_exists('edit_trigger_link')) {
      $qedit = edit_trigger_link();
      $qedit = render($qedit);
      $tabs = preg_replace('~(<li)([^>]*)(><a[^>]*>' . t("Edit") . '</a></li>)~', '<li$2>' . $qedit . '</li>$1$2$3', $tabs);
      $variables['tabs'] = $tabs;
    }
  }

  global $user;
  $variables['user'] = $user;

  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    if ($term->vocabulary_machine_name == 'catelory' || $term->vocabulary_machine_name == 'tags') {
      $variables['title'] = '';
    }
  }
  if (isset($variables['node'])) {
    $variables['title'] = '';
    if (isset($variables['node']->field_category) && !empty($variables['node']->field_category['und'])) {
      $node_wrapper = entity_metadata_wrapper('node', $variables['node']);
      $class = '';
      if (function_exists('anotherworlds_css_class')) {
        $class = anotherworlds_css_class($node_wrapper->field_category->name->value());
      }
      $variables['category'] = '<div class="plash ' . $class . '"><span class="ico"></span>' . l($node_wrapper->field_category->name->value(), 'taxonomy/term/' . $node_wrapper->field_category->tid->value()) . '</div>';
    }
	
	if(arg(2) == '' && isset($variables['node']->field_img_front) && !empty($variables['node']->field_img_front['und'])){
	  $var = array(
		'style_name' => 'front_320',
		'path' => $variables['node']->field_img_front['und'][0]['uri'],
		'width' => 730,
		'height' => 400,
		'alt' => $variables['node']->title,
		'title' => $variables['node']->title,
		'attributes' => array(),
	  );
	  $variables['node_img'] = theme_image_style($var) ;
	}
  }

	if(arg(2) == '' && isset($variables['node']->field_ield_img_picture) && !empty($variables['node']->field_ield_img_picture['und'])){
	  $var = array(
		'style_name' => 'front_320',
		'path' => $variables['node']->field_ield_img_picture['und'][0]['uri'],
		'width' => 730,
		'height' => 400,
		'alt' => $variables['node']->title,
		'title' => $variables['node']->title,
		'attributes' => array(),
	  );
	  $variables['node_img2'] = theme_image_style($var) ;
	}


  if (drupal_is_front_page()) {
    $variables['title'] = '';
  }
  
  $variables['editor_admin_menu'] = str_replace('class="menu"', 'class="menu dropdown"', _anotherworlds_block('navigation', 'system'));
}

// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function anotherworlds_preprocess_node(&$variables, $hook) {
  $variables['elements']['body']['attributes'][] = array('class' => 'clearfix');
  $variables['title'] = $variables['node']->title;
  if (drupal_is_front_page()) {
    $variables['title'] = '';
  }
}

// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function anotherworlds_preprocess_comment(&$variables, $hook) {
  $variables['comment_body'] = str_replace("\n", "<br>", $variables['comment_body'][0]['value']);
  $variables['author'] = $variables['comment']->name;
  $variables['date'] = format_date($variables['comment']->created, 'custom', 'd.m.Y - H:i');
}

// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
  function STARTERKIT_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
  }
  // */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
  function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
  }
  // */

/*
 * return html block
 * 
 */
function _anotherworlds_block($bid, $module = 'block') {
  $block = block_load($module, $bid);
  $arr = _block_get_renderable_array(_block_render_blocks(array($block)));
  $output = drupal_render($arr);
  return $output;
}

function anotherworlds_links__system_secondary_menu(&$variables) {
  global $user;
  $html = "<div>\n";
  $html .= "  <ul>\n";
  $k = 0;
  foreach ($variables['links'] as $link) {
    $k++;
    $lable = '';
    if ($user->uid != 0 && $link['href'] == 'user') {
      $link['title'] = $user->name;
      $lable = 'Вы зашли как:&nbsp;&nbsp;&nbsp;';
    }
    $class = (count($variables['links']) == $k) ? ' class="last"' : '';
    $html .= "<li" . $class . ">" . $lable . l($link['title'], $link['href'], $link) . "</li>";
  }

  $html .= "  </ul>\n";
  $html .= "</div>\n";

  return $html;
}

function anotherworlds_form_alter(&$form, $form_state, $form_id) {
  if ($form_id == 'user_login_block') {
    $form['links']['#weight'] = -1;
  } elseif (strpos($form_id, 'comment_node') !== false) {
    $form['actions']['submit']['#value'] = 'Опубликовать';
  }
}

function anotherworlds_preprocess_taxonomy_term(&$variables, $hook) {
  $variables['class_h1'] = '';
  if (function_exists('transliteration_get')) {
    $variables['class_h1'] = str_replace(' ', '-', drupal_strtolower(transliteration_get($variables['term']->name)));
  }
}

function anotherworlds_preprocess_breadcrumb(&$variables, $hook) {

  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    if ($term->vocabulary_machine_name == 'catelory') {
      $variables['breadcrumb'] = array();
    }
  } elseif (arg(0) == 'node' && is_numeric(arg(1)) && arg(2) == '') {
    $variables['breadcrumb'] = array();
  }

  $variables['breadcrumb'] = array();
}

function anotherworlds_preprocess_field(&$variables, $hook) {
  if ($variables['element']['#field_name'] == 'field_funny_photo') {
    foreach ($variables['items'] as $i => $val) {
      $variables['items'][$i]['#path']['options'] = array('attributes' =>
          array('class' => array('colorbox'), 'rel' => 'gallery'));
    }
  }
}