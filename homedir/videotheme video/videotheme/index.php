<?php get_header() ?>

<?php while ( have_posts() ) : the_post() ?>
			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
            <div class="post-content">
          
            <div class="video-content" align="center">
			<?php 
			video_blog_function('450','366',get_the_ID());
			 ?>
             </div>

				<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'sandbox') . '&after=</div>') ?>
   <div class="post-footer"></div>
			</div><!-- .post -->
         
<div id="post-side" class="sidebar ">
				<div class="the-post">
               	<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
                <div class="entry-content">
<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>
</div>

 <div class="related_posts">
 <h3 class="entry-title">Related Posts</h3>
 <?php wp_related_posts() ?></div>
			
                </div>
                
                    <div class="entry-meta">
                   
					<span class="author vcard"><?php printf(__('By %s', 'sandbox'), '<a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="' . sprintf(__('View all posts by %s', 'sandbox'), $authordata->display_name) . '">'.get_the_author().'</a>') ?></span>
					 <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__(' on %1$s', 'sandbox'), the_date('', '', '', false), get_the_time()) ?></abbr></span>
					<br />
                    <span class="cat-links"><?php printf(__('Categorized: %s', 'sandbox'), get_the_category_list(', ')) ?></span>
                    
					<span class="meta-sep">|</span>
                    <span class="comments-link"><?php comments_popup_link(__('Comments (0)', 'sandbox'), __('Comments (1)', 'sandbox'), __('Comments (%)', 'sandbox')) ?></span>
					

					<?php the_tags(__('<span class="tag-links">Tagged: ', 'sandbox'), ", ", "</span>\n\t\t\t\t\t") ?>
<?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class=\"edit-link\">(", ")</span>\n\t\t\t\t\t"); ?>
					
		
                    
                     
                    </div>
<div class="post-side-footer-b"></div>

</div>
</div>

<div class="clear"></div>

<?php endwhile ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>



<?php // get_sidebar() ?>
<?php get_footer() ?>