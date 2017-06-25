<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
 drupal_add_js("jQuery(document).ready(function(){
   var id = jQuery('.page-wrapper ul .current').attr('id');
  if (id < 7) {
    jQuery('.application-steps .steps .one').addClass('active');
  }
  if (id == 7) {
    jQuery('.application-steps .steps .two').addClass('active');
  }
  if (id == 8) {
    jQuery('.application-steps .steps .three').addClass('active');
  }
 });", "inline");
 
 ?>
<div class="application-steps row">
        <div class="steps col-sm-12">
          <div class="one step col-sm-4">
            <div class="step-num col-sm-3">1</div>
            <div class="col-sm-9 text">
              <div class="step-num-text">Step One:</div>
              <div class="step-text">Loan Application</div>
            </div>
          </div>
          <div class="two step col-sm-4">
            <div class="step-num col-sm-3">2</div>
            <div class="col-sm-9 text">
            <div class="step-num-text">Step Two:</div>
            <div class="step-text">Credit Authorization</div>
            </div>
          </div>
          <div class="three step col-sm-4">
            <div class="step-num col-sm-3">3</div>
            <div class="col-sm-9 text">
              <div class="step-num-text">Step Three:</div>
              <div class="step-text">Documentation</div>
            </div>
          </div>
        </ul>
      </div>
  </div>
  <div class="clearfix"></div>
  <div class="buttons">
<?php
  // Print out the progress bar at the top of the page
  // Alteration are made for mortgage application form.
  print drupal_render($form['actions']['draft']);
  print drupal_render($form['actions']['previous']);
  print drupal_render($form['actions']['next']);
  print drupal_render($form['actions']['submit']);
  ?>
  </div>
  <div class="clearfix"></div>
  <?php
  // Print out the preview message if on the preview page.
  if (isset($form['preview_message'])) {
    print '<div class="messages warning">';
    print drupal_render($form['preview_message']);
    print '</div>';
  }
  ?>
  <div class="row">
  <div class="col-sm-3">
  <?php 
    $block_content = module_invoke('block', 'block_view', '17');
    print drupal_render($form['progressbar']);
    print render($block_content['content']);
  ?>
  </div>
  <div class="col-sm-9">
  <?php
    print drupal_render($form['submitted']);
    print drupal_render_children($form);
  ?>
  </div>
  </div>
