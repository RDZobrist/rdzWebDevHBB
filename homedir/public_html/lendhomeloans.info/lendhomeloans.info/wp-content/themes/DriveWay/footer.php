<?php global $theme; ?>
</div>
  
    <div id="footer-container">
    
        <div id="footer">
        
            <div id="copyrights">
                <?php
                    if($theme->display('footer_custom_text')) {
                        $theme->option('footer_custom_text');
                    } else { 
                        ?> &copy; <?php echo date('Y'); ?>  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved.', 'themater');
                    }
                ?> 
            </div>
            
            <?php /* 
                    All links in the footer should remain intact. 
                    These links are all family friendly and will not hurt your site in any way. 
                    Warning! Your site may stop working if these links are edited or deleted 
                    
                    You can buy this theme without footer links online at http://fthemes.com/buy/?theme=driveway 
                */ ?>
            
            <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a> | Designed by: <a href="http://fthemes.com/">Free WP Themes</a> | Thanks to <a href="http://newwpthemes.com/">New WordPress Themes</a>, <a href="http://free-wordpress-themes.com/">Free WordPress Themes</a> and <a href="http://wpthemely.com">Magazine WordPress Themes</a></div><!-- #credits -->
            
        </div><!-- #footer -->
    </div>
<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>