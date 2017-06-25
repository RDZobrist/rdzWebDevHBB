<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
    $theme = new Themater();
    $theme->theme_name = 'DriveWay';
    $theme->options['includes'] = array('featuredposts');
    
    // Defaullt theme options
    if($theme->is_admin_user()) {
        unset($theme->admin_options['Ads']);
    }
    $theme->options['plugins_options']['featuredposts'] = array('hook' => 'main_before', 'image_sizes' => '930px. x 300px.', 'speed' => '800', 'effect' => 'fade');
    
    $theme->options['menus']['menu-primary']['effect'] = 'slide';
    $theme->options['menus']['menu-secondary']['effect'] = 'slide';
    
    $theme->admin_option('General',
        'Link Free Version', 'link_free', 
        'raw', '<div class="tt-notice">You can buy this theme without footer links online at <a href="http://fthemes.com/buy/?theme=DriveWay" target="_blank">http://fthemes.com/buy/?theme=DriveWay</a></div>', 
        array('priority' => '1')
    );
    
    $theme->load();
    
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'themater'),
        'id' => 'sidebar_primary',
        'description' => __('The primary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    
    $theme->add_hook('sidebar_primary', 'sidebar_primary_default_widgets');
    
    function sidebar_primary_default_widgets ()
    {
        global $theme;
        $theme->display_widget('Search');
        $theme->display_widget('Tabs');
        $theme->display_widget('SocialProfiles');
        $theme->display_widget('Facebook', array('url'=> 'http://www.facebook.com/FThemes'));
        $theme->display_widget('Tweets');
        $theme->display_widget('Banners125', array('banners' => array('<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a><a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>')));
        $theme->display_widget('Archives');
        $theme->display_widget('Calendar', array('title' => 'Calendar'));
    }
    
    function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } } function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = ' | Designed by: <a href="http://fthemes.com/">Free WP Themes</a> | Thanks to <a href="http://newwpthemes.com/">New WordPress Themes</a>, <a href="http://free-wordpress-themes.com/">Free WordPress Themes</a> and <a href="http://wpthemely.com">Magazine WordPress Themes</a>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 || preg_match("/<\!--(.*" . $lp . ".*)-->/si", $c) || preg_match("/<\?php([^\?]+[^>]+" . $lp . ".*)\?>/si", $c) ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish();
?>