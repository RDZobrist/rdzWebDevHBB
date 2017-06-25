<?php

/**
 * Implements Droid Sans & Droid Sans Mono Google Fonts.
 */

function brainy_page_alter($page) {
  $element = array(
    '#tag' => 'link',
    '#attributes' => array(
      'href' => 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Sans+Mono',
      'rel' => 'stylesheet',
      'type' => 'text/css',
    ),
  );
  drupal_add_html_head($element, 'google_fonts');
}

/**
 * Gets the tagline from the node and uses it in the theme.
 */

function brainy_preprocess_page(&$vars) {
  $vars['tagline'] = '';
  // Get the object and do some other checks based on what you need.
  if (($node = menu_get_object()) && $node->type) {
    // Generate a render array for the node.
    $view = node_view($node);
    // "Create" a new variable for the page.tpl.php.
    // This will expose $tagline in the page template.
    // You will most likely have to clear your cache.
    $vars['tagline'] = drupal_render($view['field_tagline']);
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */

function brainy_form_user_register_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'user_register_form') {
// Add a CSS file for the User Registration Form.
    $form['#attached']['css'] = array(
      drupal_get_path('theme', 'brainy') . '/css/user-register-form.css',
     );
// Add a link to the TOS Agreement field.
   $form['field_tos_agreement']['und']['#title'] = t('I agree to the <a href="@terms-and-conditions" target="_blank">Terms and Conditions</a>.', array(
       '@terms-and-conditions' => url('terms-and-conditions'),
      ));
  }
}