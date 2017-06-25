<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>



			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class(); ?>">
            <div class="post-content">
			
            <div class="video-content" align="center">
          <?php 
			video_blog_function('450','366',get_the_ID());
			 ?>
				</div>
				<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'sandbox') . '&after=</div>&next_or_number=number') ?>
                  <div class="post-footer"></div>
			</div><!-- .post -->
          

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&laquo;</span> %title') ?></div>
				<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&raquo;</span>') ?></div>
			</div>

<?php comments_template(); ?>

		</div><!-- #content -->
	</div><!-- #container -->
</div>
<div id="post-side" class="sidebar">
					<div class="the-post">
                    <h2 class="entry-title"><?php the_title(); ?></h2>
					<div class="entry-content">
					<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>
                    </div>
                    
                                         <div class="related_posts">
 <h3 class="entry-title">Related Posts</h3>
 <?php wp_related_posts() ?></div>
			
    
                    
                    </div>

                    <div class="entry-meta">
					<?php printf(__('By %1$s on <abbr class="published" title="%2$sT%3$s">%4$s</abbr>.<br />Categorized: %6$s%7$s.', 'sandbox'),
						'<span class="author vcard"><a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="' . sprintf(__('View all posts by %s', 'sandbox'), $authordata->display_name) . '">'.get_the_author().'</a></span>',
						get_the_time('Y-m-d'),
						get_the_time('H:i:sO'),
						the_date('', '', '', false),
						get_the_time(),
						get_the_category_list(', '),
						get_the_tag_list(' '.__('and tagged', 'sandbox').' ', ', ', ''),
						get_permalink(),
						wp_specialchars(get_the_title(), 'double'),
						comments_rss() ) ?>


<?php edit_post_link(__('Edit', 'sandbox'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>

				</div>
                <div class="post-side-footer-b"></div>

</div>
<?php get_sidebar() ?>
<?php get_footer() ?>