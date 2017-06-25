<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
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
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<div id="page-wrapper"><div id="page">

  <header id="header" role="banner" class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>"><div class="section clearfix">
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img id="headlogo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
    </a>
    <div id="hbb-access-menu">
      <?php if ($logged_in): ?>
        <ul>
          <li><a href="/user">My Account</a></li>
          <li><a href="/user/logout">Log Out</a></li>
        </ul>
      <?php else: ?>
        <ul>
          <li><a href="/user/register">Sign Up</a></li>
          <li><a href="/user/login">Log In</a></li>
        </ul>
      <?php endif; ?>
      <br/>
      <p id="customer-service-info">Customer Service: <span class="service-number">801-930-0395</span></p>
    </div>

    <?php print render($page['header']); ?>

  </div></header> <!-- /.section, /#header -->

  <div id="hbb-main-menu">
    <ul>
      <li><a id="database-link" href="/database">Database</a></li>
      <li><a href="/websites">Websites</a></li>
      <li><a href="/sem-trainings">SEM Trainings</a></li>
      <li><a href="/sem-community">SEM Community</a></li>
      <li><a href="/pro-member">Pro Member</a></li>
      <li><a href="/contact">Contact Us</a></li>
    </ul>
  </div>

  <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>

  <div id="featured"><div class="section clearfix">
    <?php print render($page['featured']); ?>
    <?php print render($title_prefix); ?>

      <?php if ($is_front): ?>
        <p class="tagline">Search engine marketing brands a business as an industry leader while generating traffic to drive more sales.</p>
      <?php elseif ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
        <?php if ($tagline): ?>
        <p class="tagline">
          <?php print $tagline; ?>
        </p>
        <?php endif; ?>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
  </div></div> <!-- /.section, /#featured -->

  <div id="main-wrapper" class="clearfix"><div id="main" role="main" class="clearfix">

    <div id="content" class="column"><div class="section">
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>
      <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>

    <?php if ($is_front): ?>
    <div id="frontpage-text">
      <div class="frontpage-section"><h3 class="frontpage-h3"><a href="/database">Database</a></h3><p class="frontpage-p">Nurture leads through smart content.</p></div><div class="frontpage-section"><h3 class="frontpage-h3"><a href="/websites">Websites</a></h3><p class="frontpage-p">Convert visitors through education.</p></div><div class="frontpage-section"><h3 class="frontpage-h3"><a href="/sem-trainings">SEM Trainings</a></h3><p class="frontpage-p">Community of marketers on the web.</p></div>
      <div id="frontpage-ctas">
        <div id="trial-cta">
          <a href="/user/register">Create an Account</a>
        </div>
        <div id="demo-cta">
          <a href="contact"><img src="/sites/all/themes/brainy/demo-mr-einstein.png" /></a>
        </div>
      </div>
    </div>
      <?php else: ?>
      <?php print render($page['content']); ?>
    <?php endif; ?>

    </div></div> <!-- /.section, /#content -->

    <?php if ($page['sidebar_first']): ?>
      <div id="sidebar-first" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_first']); ?>
      </div></div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>
    
    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>

  </div></div> <!-- /#main, /#main-wrapper -->

  <div id="triptych-wrapper"><div id="triptych" class="clearfix">
    <div id="triptych-third"><div id="social-prompt">Let's be friends!</div><a href="https://www.facebook.com/HumanBrainBox" target="_blank"><img src="/sites/all/themes/brainy/social/facebook.png"class="social facebook" /></a><a href="https://www.linkedin.com/in/humanbrainbox" target="_blank"><img src="/sites/all/themes/brainy/social/linkedin.png" class="social linkedin" /></a><a href="https://twitter.com/humanbrainbox" target="_blank"><img src="/sites/all/themes/brainy/social/twitter.png" class="social twitter" /></a><a href="http://pinterest.com/humanbrainbox" target="_blank"><img src="/sites/all/themes/brainy/social/pinterest.png" class="social pinterest" /></a><a href="https://plus.google.com/u/0/101134828669612916946/posts" target="_blank"><img src="/sites/all/themes/brainy/social/googleplus.png" class="social googleplus" /></a><a href="https://www.youtube.com/user/HumanBrainBox" target="_blank"><img src="/sites/all/themes/brainy/social/youtube.png" class="social youtube" /></a>
    </div>
    <div id="triptych-first"><img id="footer-logo" src="/sites/all/themes/brainy/footerlogo.png" /><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">Home</a>  |  <a href="/contact">Contact Us</a>  |  <a href="/user/login">Log In</a><div id="copyright">Copyright © 2014 Human Brain Box, LLC. All Rights Reserved.</div></div>
    
  </div></div> <!-- /#triptych, /#triptych-wrapper -->

    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
    <div id="footer-wrapper"><div class="section">
      <div id="footer-columns" class="clearfix">
        <?php print render($page['footer_firstcolumn']); ?>
        <?php print render($page['footer_secondcolumn']); ?>
        <?php print render($page['footer_thirdcolumn']); ?>
        <?php print render($page['footer_fourthcolumn']); ?>
      </div> <!-- /#footer-columns -->
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <footer id="footer" role="contentinfo" class="clearfix">
        <?php print render($page['footer']); ?>
      </footer> <!-- /#footer -->
    </div></div> <!-- /.section, /#footer-wrapper -->
    <?php endif; ?>

</div></div> <!-- /#page, /#page-wrapper -->
