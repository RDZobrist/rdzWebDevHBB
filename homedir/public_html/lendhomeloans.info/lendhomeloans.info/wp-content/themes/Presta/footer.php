<?php global $theme; ?>

    <div id="footer">
    
        <div id="copyrights">
            <?php
                if($theme->display('footer_custom_text')) {
                    $theme->option('footer_custom_text');
                } else { 
                    ?> &copy; <?php echo date('Y'); ?>  <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a><?php
                }
            ?> 
        </div>
        
        <?php /* 
            All links in the footer should remain intact. 
            These links are all family friendly and will not hurt your site in any way. 
            Warning! Your site may stop working if these links are edited or deleted 
            
            You can buy this theme without footer links online at http://wordpressthemesbox.com/buy/?theme=presta
        */ ?>
        
        <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a></div><!-- #credits -->
        
    </div><!-- #footer -->
    
</div><!-- #container -->

<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>