<?php

/**
 * @file
 * Kalatheme's implementation to display a single Drupal page.
 *
 * The doctype, html, head, and body tags are not in this template. Instead
 * they can be found in the html.tpl.php template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $main_menu_expanded (array): An array containing 2 depths of the Main
 *   menu links
 *   for the site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on
 *   the menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node entity, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Kalatheme:
 * - $no_panels: A boolean that is true if the current page is not a panels page
 * - $always_show_page_title: A boolean that is true if we're to always print
 *   the page title, even on panelized pages.
 *
 * Regions:
 * - $page['content']: The main content of the current page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
		$path = "$_SERVER[REQUEST_URI]";          //finding the term id and then its name 
		$path_array = explode('/',$path);         
		$vid = $path_array[1];
		$tid = $path_array[2];
		$tid_ads = $path_array[3];
		//print($tid_ads);
		//Render state name which is selected
		$term_ads = taxonomy_term_load($tid);
		$term_name = $term_ads->name;
		//Now for render both term name and its parent (also we check the vocabulary name has to city-list)
		$term_tid_ads = taxonomy_term_load($tid_ads);
    // dsm($term_tid_ads);
		$termname_city = $term_tid_ads->name;
		$termname_voc = $term_tid_ads->vocabulary_machine_name;
		$term_parent = taxonomy_get_parents($tid_ads);
    // dsm($term_parent);
		$parent_id = db_query("SELECT `parent` FROM `taxonomy_term_hierarchy` WHERE `tid`='$tid_ads'")->fetchAll();
    // dsm(taxonomy_term_load($parent_id[0]->parent));
    $parent_name = taxonomy_term_load($parent_id[0]->parent)->name;

///////// SOC city name on classified ads category page ///////////////////////////

    $tid_ads_ad = $path_array[4];
    //Now for render both term name and its parent (also we check the vocabulary name has to city-list)
    $term_tid_ads_ad = taxonomy_term_load($tid_ads_ad);
    // dsm($term_tid_ads);
    $termname_city_ad = $term_tid_ads_ad->name;
    //dsm($termname_city_ad);
    $termname_voc_ad = $term_tid_ads_ad->vocabulary_machine_name;
    //dsm($termname_voc_ad);
    $term_parent_ad = taxonomy_get_parents($tid_ads_ad);
    // dsm($term_parent);
    $parent_id_ad = db_query("SELECT `parent` FROM `taxonomy_term_hierarchy` WHERE `tid`='$tid_ads_ad'")->fetchAll();
    // dsm(taxonomy_term_load($parent_id[0]->parent));
    $parent_name_ad = taxonomy_term_load($parent_id_ad[0]->parent)->name;
//dsm($parent_name_ad);
///////// EOC city name on classified ads category page ///////////////////////////
?>
<div id="page-wrapper"><div id="page">
   <!-- Page Header -->
  <header class="navbar navbar-default <?php if ($hide_site_name && $hide_site_slogan && !$logo && !$main_menu && !$secondary_menu) { print ' element-invisible'; } ?>">
    <div class="container">
<div class="topbar">
<div class="hublisting_service">
<span class="hublisting"><a href="/demo">HUB LISTING SERVICE</a></span>
<span class="salt">

<?php

if($vid == "city-list") 
{
print"$term_name";
}
elseif($termname_voc == "states")
{
print "$parent_name".", "."$termname_city";
}
elseif($termname_voc_ad == "states")
{
print "$parent_name_ad".", "."$termname_city_ad";
}

?>
</span>

</div>
<div class="salt_lake">

<?php


global $user;
if ($user->uid == 0) {


echo "<a href='/user/register' class='create_account'>Create Account</a>";
echo "<a href='/user/login' class='my_account'>My Account </a>";
}
else
{
echo "<a href='/user' class='my_account'>My Account </a>";
echo "<a href='/user/logout' class='sign_out'>sign out </a>";
}
?>
</div>
</div>
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="element-invisible">Toggle navigation</span>
          <span class="icon-bar" aria-hidden="true"></span>
          <span class="icon-bar" aria-hidden="true"></span>
          <span class="icon-bar" aria-hidden="true"></span>
        </button>
        <?php if ($logo): ?>
          <div class='brand navbar-brand'>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
            </a>
          </div>
        <?php endif; ?>

        <?php if ($site_name || $site_slogan): ?>
          <div id="site-name-slogan" class="brand navbar-brand <?php if ($hide_site_name && $hide_site_slogan) { print ' element-invisible'; } ?>">

            <?php if ($site_name): ?>
              <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
                <strong>
                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                </strong>
              </h1>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <div id="site-slogan" <?php if ($hide_site_slogan) { print 'class="element-invisible"'; } ?>>
                <?php print $site_slogan; ?>
              </div>
            <?php endif; ?>

          </div> <!-- /#name-and-slogan -->
        <?php endif; ?>
      </div><!-- /.navbar-header -->

      <nav class="collapse navbar-collapse <?php if (!$main_menu && !$secondary_menu) { print 'element-invisible'; } ?>" role="navigation">
        <?php
          $pri_attributes = array(
            'class' => array(
              'nav',
              'navbar-nav',
              'links',
              'clearfix',
            ),
          );
          if (!$main_menu) {
            $pri_attributes['class'][] = 'element-invisible';
          }
        ?>
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu_expanded,
          'attributes' => $pri_attributes,
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>

        <?php
          $sec_attributes = array(
            'id' => 'secondary-menu-links',
            'class' => array('nav', 'navbar-nav', 'secondary-links'),
          );
          if (!$secondary_menu) {
            $sec_attributes['class'][] = 'element-invisible';
          }
        ?>

        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => $sec_attributes,
          'heading' => array(
            'text' => t('Secondary menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>

    </div>
  </header>

  <!-- Page Main -->
  <div id="main-wrapper" class="clearfix">
    <main id="main" class="clearfix" role="main">
      <div id="top-content">
        <div class="column container">
          <a id="main-content"></a>
          <?php if (($no_panels || $always_show_page_title) && $title): ?>
            <h1 id="page-title" class="title">
              <?php print $title; ?>
            </h1>
          <?php endif; ?>

          <?php if ($messages): ?>
            <div id="messages">
              <?php print $messages; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($tabs['#primary']) || !empty($tabs['#secondary'])): ?>
            <div id="tabs">
              <?php print render($tabs); ?>
            </div>
          <?php endif; ?>

          <?php if ($action_links): ?>
            <div id="action-links">
              <?php print render($action_links); ?>
            </div>
          <?php endif; ?>
        </div>
      </div> <!-- /.section, /#top-content -->

      <div class="container">
        <div id="content">
          <div class="column <?php $no_panels ? print 'container' : ''; ?>">
             <?php print render($page['header']); ?>
            <?php print render($page['content']); ?>

          </div>
        </div>
      </div><!-- /.section, /#content -->

    </main><!-- /#main -->
  </div> <!-- /#main-wrapper -->

</div>
 <?php
 //$block = module_invoke('block', 'block_view', '5');    
 //print render($block['content']);
?>
<!-- <div class='footer'>
<div class ='container'>
<?php
// $view = views_get_view('footer_view_block');
  // $view->set_display('block');
  // //$view->set_arguments(array($tid));
  // // change the amount of items to show
  // //$view->set_items_per_page(4);
  // $view->pre_execute();
  // $view->execute();
  // print $view->render();
?>
</div>
</div> -->

<div class="powered">
<div class="container"><span class="copyright">2016 <a target="_blank" href="/">hublistingservice.com</a> powered by: <a target="_blank" href="http://www.humanbrainbox.com/">humanbrainbox.com</a> All Rights Reserved</span>
<ul>
<li><a target="_blank" href="/help">help</a></li> 
<li><a target="_blank" href="/faq">faq</a></li>
<li><a target="_blank" href="/abuse">abuse</a></li>
<li><a target="_blank" href="/legal">legal</a></li>
<li><a target="_blank" href="/terms-of-use">terms of use</a></li>
<li><a target="_blank" href="/privacy-policy">privacy policy</a></li>
<li><a target="_blank" href="/property-status">property status</a></li>
</ul>
</div>
</div>

</div>

 <!-- /#page, /#page-wrapper -->

