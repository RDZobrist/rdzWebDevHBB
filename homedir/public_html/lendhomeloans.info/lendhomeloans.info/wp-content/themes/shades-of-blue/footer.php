<div class="clear"></div>

</div>

<div id="footer">

    <div class="footer1">
        <ul id="footerwidgeted-1">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #1') ) : ?>
			<li id="link-list-1">
                <h4><?php _e("Footer #1 Widget", 'studiopress'); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'studiopress'); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer2">
        <ul id="footerwidgeted-2">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #2') ) : ?>
			<li id="link-list-2">
                <h4><?php _e("Footer #2 Widget", 'studiopress'); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'studiopress'); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer3">
        <ul id="footerwidgeted-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #3') ) : ?>
			<li id="link-list-3">
                <h4><?php _e("Footer #3 Widget", 'studiopress'); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'studiopress'); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer4">
        <ul id="footerwidgeted-4">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #4') ) : ?>
			<li id="link-list-4">
                <h4><?php _e("Footer #4 Widget", 'studiopress'); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'studiopress'); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>
    
<div class="clear"></div>
    
</div>
                
<div id="copyright">

    <div class="copyright">
		<p>&copy; <?php echo date('Y'); ?> <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a> &middot; <a href="http://www.studiopress.com/themes/shades">Shades of Blue</a> <?php _e("theme by", 'studiopress'); ?> <a href="http://www.studiopress.com" >StudioPress</a> &middot; <a href="http://wordpress.org">WordPress</a> &middot; <?php wp_loginout(); ?></p>
    </div>
    
</div>
                                    
<?php do_action('wp_footer'); ?>

<?php // begin code for the javascript which is necessary for the dropdown menu to display properly in IE6 ?>    
	<script src="<?php bloginfo('template_url'); ?>/js/dropdown.js" type="text/javascript"></script>
<?php // end code  ?>

</body>
</html>