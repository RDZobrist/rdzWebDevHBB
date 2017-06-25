<div id="sidebar">

	<ul id="sidebarwidgeted">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
    
        <li id="search" class="widget widget_search">
            <form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="hidden" for="s"><?php _e("Search for:", 'studiopress'); ?></label>
                <div><input type="text" value="" name="s" id="s" />
                <input type="submit" id="searchsubmit" value="Search" />
                </div>
            </form>
        </li>
    
        <li id="quick-search" class="widget">
            <h4><?php _e("Categories", 'studiopress'); ?></h4>
            <?php wp_dropdown_categories('show_option_none=Select Category&hierarchical=true'); ?>
            <script type="text/javascript"><!--
                var dropdown = document.getElementById("cat");
                function onCatChange() {
                    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                        location.href = "<?php echo get_option('home');
            ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
                    }
                }
                    dropdown.onchange = onCatChange;
            --></script> 
        </li>
        
		<li id="text-widget" class="widget">
            <h4><?php _e("Text Widget", 'studiopress'); ?></h4>
                <p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'studiopress'); ?>
</p>
		</li>	
            	
		<li id="recent-posts" class="widget">
            <h4><?php _e("Recent Posts", 'studiopress'); ?></h4>
                <ul>
                    <?php wp_get_archives('type=postbypost&limit=5'); ?> 
                </ul>
		</li>	
        
        <li id="archives" class="widget">
            <h4><?php _e("Archives", 'studiopress'); ?></h4>
                <ul>
					<?php wp_get_archives('type=monthly'); ?>
                </ul>
        </li>

		<li id="blogroll" class="widget">
            <h4><?php _e("Blogroll", 'studiopress'); ?></h4>
				<ul>
					<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
				</ul>
		</li>
        
		<li id="meta" class="widget">
            <h4><?php _e("Meta", 'studiopress'); ?></h4>
                <ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    <li><a href="http://www.wordpress.org/">WordPress</a></li>
                    <?php wp_meta(); ?>
                    <li><a href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
                </ul>
		</li>  
        		
	<?php endif; ?>
	</ul>
			
</div>