<?php 
/** 
 * @file 
 * Primary pre/preprocess functions and alterations.
 */

/**
 * Implements hook_form_FORM_ID_alter()
 *
 * Set custom text on the user password reset form.
 */
function hub_listing_form_user_pass_reset_alter(&$form, &$form_state, $form_id) {
  
  $form['messages']['#markup'] = "<p>Your custom text goes here.................................</p>";
  $form['help']['#markup'] = "<p>This is another line of custom text..................</p>";

  // If you prefer, you can just delete the second line of markup with:
  // unset($form['help']);
}

function hub_listing_preprocess_page(&$vars, $hook) {
  if ($vars['node']->type != "") {
    $vars['template_files'][] = "page-type-" . $vars['node']->type;
  }
}